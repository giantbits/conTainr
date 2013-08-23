<?php
class ContainrMediaSelector extends CWidget
{
	public $model;
	public $attribute;
	public $type;

	private $mediaId;
	private $tempId;
    private $mediaModel = null;

    public function init()
    {

    	$this->mediaId = $this->model->{$this->attribute};
    	$this->tempId = 'cms_'.$this->mediaId;

        if($this->mediaId > 0)
            $this->mediaModel = ContainrMedia::model()->findByPK($this->mediaId);

        parent::init();
    }

    public function run()
    {

        if($this->mediaId > 0) {
            echo '<div class="containrMediaSelector" style="width: 100%; height: inherit; min-height: 220px;">';
        } else {
            echo '<div class="containrMediaSelector" style="width: 100%; height: inherit; min-height: 220px;" data-toggle="modal" data-target="#modMediaSelector_'.$this->attribute.'">';
        }

    	if($this->mediaId > 0){
            if($this->type != 'file')
                echo '<img data-toggle="   modal" data-target="#modMediaSelector_'.$this->attribute.'" id="prev'.get_class($this->model).'_'.$this->attribute.'" class="prevImage_'.$this->attribute.'" src="/containr/media/getmedia/mid/'.$this->mediaId.'" />';
            else
                echo $this->mediaModel->filename;

            echo '<a class="btn btn-danger btnRemoveImage pull-right" style="margin-left: -18px; position: absolute;"><i class="icon-trash"></i></a>';
        } else {
            if($this->type != 'file')
                echo '<img id="prev'.get_class($this->model).'_'.$this->attribute.'" src="" class="prevImage_'.$this->attribute.'" style="display: none;" />';
            else
                echo '<a class="btn">DATEI AUSWÄHLEN</a>';
        }

        echo '
    			<input type="hidden" id="'.get_class($this->model).'_'.$this->attribute.'" name="'.get_class($this->model).'['.$this->attribute.']" value="'.$this->mediaId.'" />
    		</div>

    		';

   		$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'modMediaSelector_'.$this->attribute, 'htmlOptions'=>array('style'=>'width: 680px;')));

		echo '
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h4>Select</h4>
			</div>

			<div class="modal-body" style="padding-left: 0px; padding-right: 0px; padding-top: 0px;">
				<iframe id="modFrame_modMediaSelector_'.$this->attribute.'" frameborder="0" scrolling="auto" width="100%" height="400" src="/containr/media/selector/"></iframe>
			</div>
	 	';

		$this->endWidget();


    	$cs = Yii::app()->getClientScript();

    	$js = '

        $(".btnRemoveImage").on("click","i", function(){
            $(this).parent().parent().find("img").attr("src","");
            $(this).parent().parent().find("input").val("");
            $(this).parent().hide();
        });

    	$("#modFrame_modMediaSelector_'.$this->attribute.'").load(function(){
    		$("#modFrame_modMediaSelector_'.$this->attribute.'").contents().on("click", ".btnChoose", function() {
                $("#'.get_class($this->model).'_'.$this->attribute.'").val($(this).attr("id"));
                $("#prev'.get_class($this->model).'_'.$this->attribute.'").attr("src","/containr/media/getmedia/?msize=thumb&mid=" + $(this).attr("id"));
                $(".prevImage_'.$this->attribute.'").show();
    			$("#modMediaSelector_'.$this->attribute.'").modal("hide");
    		});
		});

    	';

    	$cs->registerScript('containrMediaSelector_'.$this->attribute, $js, 4);

    }
}
