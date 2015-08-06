<?php

Yii::import('zii.widgets.CMenu', true);

class FooterMenu extends CMenu
{
    public function init()
    {
        // Here we define query conditions.
        $criteria = new CDbCriteria;
        //$criteria->limit=2;
        $criteria->condition = '`status` = 1';
        //$criteria->order = '`position` ASC';

        $items = CmsPages::model()->findAll($criteria);
        //echo "items"."<pre>";print_r($items);die;
        foreach ($items as $item)
            $this->items[] = array('label'=>$item->title, 'url'=>Yii::app()->createUrl("user/pages",array('id'=>$item->id)));

        parent::init();
    }
}