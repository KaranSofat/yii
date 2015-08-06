<?php

/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

?>
        <!-- configuration to overwrite settings-->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/config.js"></script> 
		
	<!-- the script which handles all the access to plugins etc...  -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/script.js">
	</script>
	
	<script type="text/javascript">
				$(document).ready(function(){
					$("#side-1").addClass('active');
		               });
        </script>


	<?php // include('themes/views/layouts/left_sidebar.php'); ?>


	<section id="content">
      
	
	 <div>
				    <div class="g6 widgets">
		                    <div class="widget number-widget" id="widget_number">
				    <h3 class="handle">Quick overview </h3>

				      <?php 
  
                                    /*   $modelUser = User::model()->findAll();
                                       $modelPage = Page::model()->findAll(); 
				       $modelWork = Ourwork::model()->findAll();
                       */
                                        ?>
				<div>
                                <ul>

				<!--  code to count all the entities in admin section  -->	

		<li> <a  href="<?php //echo Yii::app()->baseUrl; ?>/user/admin"><img src="<?php  echo Yii::app()->request->baseUrl; ?>/images/icons/user.png"/><span><?php  //echo count($modelUser); ?></span> Users   </a> </li>

		<li> <a  href="<?php //echo Yii::app()->baseUrl; ?>/page/admin"><img src="<?php  echo Yii::app()->request->baseUrl; ?>/images/icons/category.png"/><span><?php //echo count($modelPage); ?></span> Pages </a> </li>	

<li> <a  href="<?php //echo Yii::app()->baseUrl; ?>/ourwork/admin"><img src="<?php  echo Yii::app()->request->baseUrl; ?>/images/icons/category.png"/><span><?php //echo count($modelWork); ?></span> Our work </a> </li>
				

				                </ul>
					        </div>
					        </div>
                                                </div>
                                                </div>


</section>
