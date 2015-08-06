<?php

class PostController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/

	//function to get the list for blog
	public function actionPostListing()
	{
		$model=new Post;
		$rec=Post::model()->findAll();
		//echo "<pre>";print_r($rec);die;
		$this->render('postlisting',array('model'=>$model,'list'=>$rec));
	}

	//function to add blog here 
	public function actionAddBlog()
	{
		$model=new Post;
		$rec=Lookup::model()->findAll(array('condition'=>'type=:t','params'=>array(

                           ':t'=>'PostStatus'
			            )


			));
		 $admin=Admin::model()->find();
		 $adminId=$admin->id;
		 foreach($rec as $type)
		 {
            $id[]    =$type->id;
            $name[]  =$type->name;
            $op    =array_combine($id,$name);
		 }	
		
         if(isset($_POST['Post']))
         {
         	  $model->attributes=$_POST['Post'];
         	  if($model->validate())
         	  {
         	  	 $model->author_id=$adminId;
                 if($model->save())
                 {
                 	$this->redirect(array('postlisting','id'=>$model->id));
                 }	
         	  }	
         	  else
         	  {
         	  	$errors=$model->getErrors();
         	  	//var_dump($errors);
         	  }
         }	


		$this->render('addblog',array('model'=>$model,'type'=>$op));
	}
	//function to delete the blog here

	public function actionDelete()
	{
		 $id=$_REQUEST['id'];
    	 $detail=Post::model()->findByAttributes(array('id'=>$id));
    	 $detail->delete();
    	 echo "success";
	} 

	// function to edit the blog

	public function actionEditBlog($id)
	{
		$model=new Post;
        $rec=Post::model()->findByPk($id);
        $r=Lookup::model()->findAll(array('condition'=>'type=:t','params'=>array(

                           ':t'=>'PostStatus'
			            )


			));
		 //echo "<pre>";print_r($r);die;
		 foreach($r as $type)
		 {
		 	 //echo "<pre>";print_r($type);
		 	 
             $i[]    =$type->id;
             $n[]  =$type->name;
            $op    =array_combine($i,$n);
		 }	//die;
        //echo "<pre>";print_r($rec);die;
		 if(isset($_POST['Post']))
		 {
                $model->attributes=$_POST['Post'];
                if($model->validate())
                {
                       $res=Post::model()->findByPk($id);
                       $res->title       =$_REQUEST['Post']['title'];
                       $res->content     =$_REQUEST['Post']['content'];
                       $res->tags        =$_REQUEST['Post']['tags'];
                       $res->status      =$_REQUEST['Post']['status'];
                       $res->update_time =date('Y-m-d');
                       if($res->save(false))
                       {
                       	  $this->redirect(array('postlisting'));
                       }	
                }
                else
				{
				 	$errors=$model->getErrors();
				}	
		 }	
		 
        $this->render('editblog',array('edit'=>$rec,'model'=>$model,'type'=>$op,'i'=>$i));
	}

	// function to view the blog detail
	public function actionViewBlog($id)
	{
        
        $rec=Post::model()->findByPk($id);
        //echo "<pre>";print_r($rec);die;
		$this->render('viewblog',array('view'=>$rec));
	}
	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$post=$this->loadModel();
		$comment=$this->newComment($post);

		$this->render('view',array(
			'model'=>$post,
			'comment'=>$comment,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
			{
				if(Yii::app()->user->isGuest)
					$condition='status='.Post::STATUS_PUBLISHED.' OR status='.Post::STATUS_ARCHIVED;
				else
					$condition='';
				$this->_model=Post::model()->findByPk($_GET['id'], $condition);
			}
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

}