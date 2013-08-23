<?php
class ContainrPageUrlRule extends CBaseUrlRule {
    public $connectionID = 'db';

    public function createUrl($manager,$route,$params,$ampersand) {

        if (substr($route,0,5) == 'page:') {
            $pk = substr($route,5);
            $page = ContainrPage::model()->findByPk($pk);
            if ($page != null) {
                $url = array();
                $bc = $page->getBreadCrumb();
                foreach ($bc as $page) {
                    if ($page->level > 1) {
                        $url[] = $page->code;
                    }
                }
                return trim(Yii::app()->createUrl(implode('/',$url),$params),'/');
            }
        }

        return false;  // URL passt nicht, Regel nicht betroffen
    }

    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo) {

        if (substr($pathInfo,0,9)=='containr/') {
            return false;
        }

        $cache = $this->getCachedPage($pathInfo);

        if (!is_null($cache)) {
            $_GET['contentPageId'] = $cache->id;
            return 'site/index';
        }

        return parent::parseUrl($manager,$request,$pathInfo);
    }

    protected function getCachedPage($pathInfo) {
        $cache = ContainrUrlCache::model()->findByAttributes(array('pathinfo'=>$pathInfo));
        $page = null;

        if (is_null($cache)) {
            $pathArr = explode('/',$pathInfo);

            $possiblePages = ContainrPage::model()->findAllByAttributes(array('code'=>$pathArr[count($pathArr)-1]));

            foreach ($possiblePages as $possiblePage) {
                $breadCrumb = $possiblePage->getBreadCrumb();
                $bcCount = count($breadCrumb);
                for ($i=$bcCount-1;$i>=1;$i--) {

                    if (count($pathArr)-($bcCount-$i) < 0 || $breadCrumb[$i]->code != $pathArr[count($pathArr)-($bcCount-$i)]) {
                        continue;
                    }
                }
                $page = $possiblePage;
                break;

            }
            if (!is_null($page)) {
                $cache = new ContainrUrlCache;
                $cache->pageid = $page->id;
                $cache->pathinfo = $pathInfo;
                $cache->save();
            }
        } else {
            $page = ContainrPage::model()->findByPk($cache->pageid);
        }

        return $page;
    }
}
