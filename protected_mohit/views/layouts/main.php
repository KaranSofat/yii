<!DOCTYPE HTML>
<html>
<head>
<title>WOW Cleans - Best Cleaning Quotes</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui.css" rel="stylesheet" type="text/css" media="all" />

<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css" media="all" />
<!--<link href="<?php //echo Yii::app()->request->baseUrl; ?>/css/customerstyle.css" rel="stylesheet" type="text/css" media="all" />
 -->
 
 <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" rel="stylesheet" type="text/css" media="all" />

<link href="<?php //echo Yii::app()->request->baseUrl; ?>/css/jquery.rating.css" rel="stylesheet" type="text/css" media="all" />


<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.yiiactiveform.js"></script>
<script type="text/javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/js/menu.js"></script>
<script type="text/javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validate.min.js"></script>
<script type="text/javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.rating.js"></script>
<script type="text/javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.twbsPagination.min.js"></script>

<!-- start top js_button -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/easing.js"></script>
<!-- strat-slider -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.custom.28468.js"></script>
<!-- strat-slider -->
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/media.css" rel="stylesheet" type="text/css" media="screen" />
<script>
jQuery( document ).ready(function( $ ) {

    if ( jQuery( '#accordion' )[0] ){

        jQuery( '#accordion' ).find( 'p' ).click( function( e ){ //Click function to toggle extending lists

            e.preventDefault();     

            jQuery( this ).next().slideToggle( 'fast' ).css( 'zoom', '1' ); //Find the next element after the clicked element               
            jQuery( this ).parent( 'li' ).toggleClass( 'collapse' ); //Add a class for styling

        } );

        jQuery( '#accordion > li' ).each( function( $ ){ //Function initially hide lists with the override class of "extended"

            if ( !jQuery( this ).hasClass( 'extended' ) ){

                jQuery( this ).find( '.ans' ).slideUp( 'fast' ).css( 'zoom', '1' ); //hide all lists without a parent of "extended"
                jQuery( this ).toggleClass( 'collapse' ); //Add a class for styling

            }

        } );


    }

} );
</script>


</head>
<body>
<div class="chat"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/chat.png" width="50" height="180" alt="Live Chat" /></div>
<!-- start header -->

<div class="header_bg">
  <div class="wrap">
    <div id="content">
      <header id="topnav">
        <div class="header_right">
          <p class="phone">1 - 232 - 444 - 3354</p>
         <?php 

            $type =Yii::app()->session['type'];
             //$sesId= Yii::app()->user->getId();
             if($type=='customer' && !empty($type))
             {
               //echo Yii::app()->session['customername']; 
                              
           ?>  
             <a href="<?php echo Yii::app()->request->baseUrl; ?>/registration/registration/logout" class="login">Logout</a>  
			       <a href="<?php echo Yii::app()->request->baseUrl; ?>/registration/registration/customerdashboard" class="login">Welcome -<?php echo Yii::app()->session['customername']; ?></a>  
                
            

          <?php }  else if($type=='company' && !empty($type) ) {   // echo  Yii::app()->session['companyname']; ?> 
                 
              <a href="<?php echo Yii::app()->request->baseUrl; ?>/registration/registration/logout" class="login">Logout</a>  
             <a href="<?php echo Yii::app()->request->baseUrl; ?>/registration/registration/dashboard" class="login">Welcome -<?php echo  Yii::app()->session['companyname']; ?></a>  
             
        <?php } else { ?>
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/registration/registration/index" class="login">Login</a>   
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/registration/registration/registration" class="login">Signup</a>    
       

          <?php } ?> 
          
            
          </div>
        <div class="cl"> </div>
        <nav>
          <ul>
           <!-- <li class="active"><a href="#home" class="scroll">About us </a></li>
            <li><a href="#about" class="scroll">How to use </a></li>
            <li><a href="#ourteam" class="scroll">Contact Us</a></li> -->

            <?php /*$this->widget('zii.widgets.CMenu',array(
					'items'=>array(
						array('label'=>'About us', 'url'=>array('/user/index')),
						array('label'=>'How to use', 'url'=>array('/user/index')),
						array('label'=>'Contact Us', 'url'=>array('/user/index')),
											),
		       )); */?>

           <?php $this->widget('application.components.ActiveMenu',array(
                         
                          'items'=>array(
                                   array('label'=>'Contact Us', 'url'=>array('/user/contact')), 

                            ),

              )); ?>

            <div class="cl"></div>
          </ul>
        </nav>
        <?php if($type=='company' && !empty($type) ) { ?>
            <h1><a href="<?php echo Yii::app()->createUrl('registration/registration/dashboard')?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" /></a></h1>
 
        <?php }  else { ?>

             <h1><a href="<?php echo Yii::app()->createUrl('user/index')?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" /></a></h1>
 
        <?php } ?>


        <a href="#" id="navbtn">Nav Menu</a>
        <div class="cl"></div>
      </header>
      <!-- @end #topnav --> 
    </div>
  </div>
</div>
<!-- start slider -->
<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>




<!-- end contacts -->
<div class="footer">
  <div class="footer_top">
    <div class="wrap">
      <div class="footer_nav">
        <ul>
         <!-- <li class="active"><a href="#home" class="scroll">Home</a></li>
          <li><a href="#about" class="scroll" >About</a></li>
          <li><a href="#ourteam" class="scroll">our team</a></li>
          <li><a href="#portfolio" class="scroll">portfolio</a></li>
          <li><a href="#service" class="scroll">Services</a></li>
          <li><a href="#contact" class="scroll">Contact</a></li> -->
          <?php /*$this->widget('zii.widgets.CMenu',array(
          'items'=>array(
            array('label'=>'Home', 'url'=>array('user/index')),
            array('label'=>'About', 'url'=>array('/user/page', 'view'=>'about')),
            array('label'=>'our team', 'url'=>array('/user/index')),
            array('label'=>'portfolio', 'url'=>array('/user/index')),
            array('label'=>'Services', 'url'=>array('/user/service')),
            array('label'=>'Contact', 'url'=>array('/user/index')),
            ),
        )); */?>

        <?php
                
                $r= Yii::app()->params['MyArray'];  
                 foreach($r as $link)
                 { 
          ?>
                  <li><a href="<?php echo Yii::app()->createUrl('/user/pages',array('id'=>$link->id))?>" class="scroll"><?php echo $link->title;?></a></li>

          <?php }  ?> 

          <div class="clear"></div>
        </ul>
      </div>
      <p class="copy_right">Book Cleaner &#169; 2014 | All rights reserved.</p>
      <div class="social-icons">
        <ul>
          <li><a href="#" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/facbook.png" width="29" height="28" alt="Facebook"></a></li>
          <li><a href="#" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/email.png" width="29" height="28" alt="Facebook"></a></li>
          <div class="clear"></div>
        </ul>
      </div>
      <div class="clear"></div>
    </div>
  </div> 
  
</div>
<script type="text/javascript">
$(window).load(function() {
	$("#flexiselDemo1").flexisel();
	$("#flexiselDemo2").flexisel({
		enableResponsiveBreakpoints: true,
    	responsiveBreakpoints: { 
    		portrait: { 
    			changePoint:480,
    			visibleItems: 1
    		}, 
    		landscape: { 
    			changePoint:640,
    			visibleItems: 2
    		},
    		tablet: { 
    			changePoint:768,
    			visibleItems: 3
    		}
    	}
    });

	$("#flexiselDemo3").flexisel({
		visibleItems: 5,
		animationSpeed: 1000,
		autoPlay: true,
		autoPlaySpeed: 3000,    		
		pauseOnHover: true,
		enableResponsiveBreakpoints: true,
    	responsiveBreakpoints: { 
    		
    		portrait: { 
    			changePoint:480,
    			visibleItems: 1
    		}, 
    		landscape: { 
    			changePoint:640,
    			visibleItems: 2
    		},
    		tablet: { 
    			changePoint:768,
    			visibleItems: 3
    		}
    	}
    });
    
});
</script> 
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.flexisel.js"></script>
</body>
</html>
