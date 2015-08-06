<?php

Yii::import('zii.widgets.CMenu', true);

class ActiveMenu extends CMenu
{
    public function init()
    {
        // Here we define query conditions.
        $criteria = new CDbCriteria;
        $criteria->limit=2;
        $criteria->condition = '`status` = 1';
        //$criteria->order = '`position` ASC';

        $items = CmsPages::model()->findAll($criteria);
        //echo "items"."<pre>";print_r($items);die;
        foreach ($items as $item)
            $this->items[] = array('label'=>$item->title, 'url'=>Yii::app()->createUrl("user/pages",array('id'=>$item->id)));
          
        // footer
       /* $criteria1 = new CDbCriteria;
        
        $criteria1->condition = '`status` = 1';
        //$criteria->order = '`position` ASC';

        $footeritems = CmsPages::model()->findAll($criteria1);
        //echo "items"."<pre>";print_r($footeritems);die;
        foreach ($footeritems as $footer)
            $this->items[] = array('label'=>$footer->title, 'url'=>Yii::app()->createUrl("user/pages",array('id'=>$footer->id)));
         */


        parent::init();
    }
}