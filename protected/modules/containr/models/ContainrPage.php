<?php

/**
 * This is the model class for table "containr_page".
 *
 * The followings are the available columns in table 'containr_page':
 * @property string $id
 * @property string $lft
 * @property string $rgt
 * @property integer $level
 * @property string $title
 * @property string $navTitle
 * @property string $code
 * @property string $metaDesctiption
 * @property string $metaKeywords
 * @property integer $state
 * @property integer $datePublishFrom
 * @property integer $datePublishTo
 * @property integer $dateCreated
 * @property integer $dateLastUpdate
 * @property integer $userLastUpdate
 * @property string $template
 * @property integer $accessRole
 * @property integer $visibleInNav
 * @property string $locale
 */
class ContainrPage extends CActiveRecord
{
	public $visibleForGroup=array(); //groupAccess
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ContainrPage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'containr_page';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, navTitle', 'required'),
			array('level, state, datePublishFrom, datePublishTo, dateCreated, dateLastUpdate, userLastUpdate, accessRole, visibleInNav', 'numerical', 'integerOnly'=>true),
			array('lft, rgt', 'length', 'max'=>10),
			array('title, navTitle, metaKeywords, template', 'length', 'max'=>128),
			array('code, metaDescription', 'length', 'max'=>255),
			array('locale', 'length', 'max'=>16),
			array('visibleForGroup','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, lft, rgt, level, title, navTitle, code, metaDescription, metaKeywords, state, datePublishFrom, datePublishTo, dateCreated, dateLastUpdate, userLastUpdate, template, accessRole, visibleInNav, locale', 'safe', 'on'=>'search'),
		);
	}

	public static function getTree($visibleOnly = true,$accessibleOnly=true) {
		if ($visibleOnly) {
			$tree = ContainrPage::model()->visibleOnly()->findAll(array('order'=>'lft'));
		} else {
			$tree = ContainrPage::model()->findAll(array('order'=>'lft'));
		}

		$level = 2;
		$rtn = self::parseTree($tree,$level,$accessibleOnly);

		return $rtn;
	}

	private static function parseTree(&$tree,$level,$accessibleOnly) {
		$rtn = array();
		while (count($tree)>0 && $tree[0]->level == $level) {
			$leaf = array_shift($tree);

			if ($accessibleOnly) {
				$accessible = ContainrUserGroup::checkPageAccessForCurrentUser($leaf);
				if (!$accessible) {
					continue;
				}
			}
			$newNode = array(
				'id'=>$leaf->id,
				'label'=>$leaf->navTitle,
				'lft'=>$leaf->lft,
				'rgt'=>$leaf->rgt,
				'level'=>$leaf->level,
				'url'=>Yii::app()->createUrl('page:'.$leaf->id),
			);
			if ($leaf->id == $_GET['contentPageId']) {
				$newNode['active']='true';
			}

			if (count($tree)>0 && $tree[0]->level > $level) {
				$newNode['items']=self::parseTree($tree,$tree[0]->level,$accessibleOnly);
				foreach ($newNode['items'] as $item) {
					if (isset($item['active']) && $item['active'] == 'true') {
						$newNode['active'] = 'true';
					}
				}
			}

			$rtn[] = $newNode;
		}

		return $rtn;
	}

	public function getBreadCrumb() {
		return ContainrPage::model()->findAll(array('order'=>'lft', 'condition'=>'lft<=:lft AND rgt>=:rgt', 'params'=>array(':lft'=>$this->lft,':rgt'=>$this->rgt)));
	}

	public function defaultScope()
    {
        return array(
            'order'=>"lft",
        );
    }

    public function scopes()
    {
        return array(
            'sortedTree'=>array(
            	'order'=>'lft',
            	'condition'=>'id > 1',
            ),
            'published'=>array(
            	'condition'=>'state = 1',
            ),
            'visibleOnly'=>array(
            	'condition'=>'visibleInNav = 1 AND level >= 2',
            ),
            'sorted'=>array(
            	'order'=>'lft',
            )
        );
    }

	public function behaviors()
	{
	    return array(
	        'nestedSetBehavior'=>array(
	            'class'=>'application.modules.containr.extensions.NestedSetBehavior',
	            'leftAttribute'=>'lft',
	            'rightAttribute'=>'rgt',
	            'levelAttribute'=>'level',
	        ),
	    );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'groupAccess' => array(self::HAS_MANY, 'ContainrGroupAccess', 'elementId', 'condition'=>'type="page"'),
			'cachedGroupAccess' => array(self::HAS_MANY, 'ContainrGroupAccessCache', 'elementId', 'condition'=>'type="page"'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'lft' => 'Lft',
			'rgt' => 'Rgt',
			'level' => 'Level',
			'title' => 'Title',
			'navTitle' => 'Nav Title',
			'code' => 'Code',
			'metaDescription' => 'Meta Desctiption',
			'metaKeywords' => 'Meta Keywords',
			'state' => 'State',
			'datePublishFrom' => 'Date Publish From',
			'datePublishTo' => 'Date Publish To',
			'dateCreated' => 'Date Created',
			'dateLastUpdate' => 'Date Last Update',
			'userLastUpdate' => 'User Last Update',
			'template' => 'Template',
			'accessRole' => 'Access Role',
			'visibleInNav' => 'Visible In Nav',
			'locale' => 'Labguage locale',
			'visibleForGroup' => 'Visible for group',
		);
	}

	public function beforeSave()
	{
		$this->code = $this->sanitize($this->navTitle,true,true);

		return true;
	}

	private function sanitize($string, $force_lowercase = true, $anal = false) {
	    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
	                   "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
	                   "â€”", "â€“", ",", "<", ".", ">", "/", "?");
	    $clean = trim(str_replace($strip, "", strip_tags($string)));
	    $clean = preg_replace('/\s+/', "-", $clean);
	    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
	    return ($force_lowercase) ?
	        (function_exists('mb_strtolower')) ?
	            mb_strtolower($clean, 'UTF-8') :
	            strtolower($clean) : $clean;
	}


	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('lft',$this->lft,true);
		$criteria->compare('rgt',$this->rgt,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('navTitle',$this->navTitle,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('metaDescription',$this->metaDescription,true);
		$criteria->compare('metaKeywords',$this->metaKeywords,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('datePublishFrom',$this->datePublishFrom);
		$criteria->compare('datePublishTo',$this->datePublishTo);
		$criteria->compare('dateCreated',$this->dateCreated);
		$criteria->compare('dateLastUpdate',$this->dateLastUpdate);
		$criteria->compare('userLastUpdate',$this->userLastUpdate);
		$criteria->compare('template',$this->template,true);
		$criteria->compare('accessRole',$this->accessRole);
		$criteria->compare('visibleInNav',$this->visibleInNav);
		$criteria->compare('lcoale',$this->locale);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function afterSave() {
		parent::afterSave();
		if (!is_array($this->visibleForGroup)) {
			$this->visibleForGroup = array();
		}
		$currentAccess = $this->groupAccess;
		foreach ($currentAccess as $ca) {
			if (in_array($ca->usergroup, $this->visibleForGroup)) { //skip groups that are already set
				unset($this->visibleForGroup[array_search($ca->usergroup, $this->visibleForGroup)]);
			} else { //delete groups that are no longer set
				$ca->delete();
			}
		}
		foreach ($this->visibleForGroup as $newGroup) { //create access for new groups
			$access = new ContainrGroupAccess();
			$access->elementId = $this->id;
			$access->type = 'page';
			$access->usergroup = $newGroup;
			$access->save();
		}
		$this->clearGroupAccessCache();
		$this->clearUrlCache();
	}

	public function afterDelete() {
		$this->clearGroupAccessCache();
		$this->clearUrlCache();
	}

	public function afterFind() {
		parent::afterFind();
		$this->visibleForGroup = array();
		if (count($this->groupAccess)>0) {
			foreach ($this->groupAccess as $access) {
				$this->visibleForGroup[] = $access->usergroup;
			}
		}
	}

	public function clearGroupAccessCache() {
		Yii::app()->db->createCommand()->delete(ContainrGroupAccessCache::model()->tableName(),'elementid IN (SELECT id FROM containr_page WHERE lft >= ' . $this->lft . ' AND rgt <= ' . $this->rgt .') AND type="page"');
	}

	public function clearUrlCache() {
		Yii::app()->db->createCommand()->delete(ContainrUrlCache::model()->tableName(),'pageid IN (SELECT id FROM containr_page WHERE lft >= ' . $this->lft . ' AND rgt <= ' . $this->rgt .')');
	}
}
