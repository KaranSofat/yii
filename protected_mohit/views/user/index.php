<?php
/* @var $this UserController */

/*$this->breadcrumbs=array(
	'User',
);*/
?>
<script type="text/javascript">
$(document).ready(function(){

	//$("#quotes").validate({});

     $( "#datepicker" ).datepicker({
      minDate: 0,
      
    });

 /* $("#code").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        //$("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
*/

  $("#compare").click(function(){
   
        var isValid = true;

        $('input[type="text"]').each(function() {

            if ($.trim($(this).val()) == '') {

                isValid = false;

                $(this).css({

                    "border": "1px solid red",

                    "background": "#FFCECE"

                });

            }

            else {

                $(this).css({

                    "border": "",

                    "background": ""

                });

            }

        });

        if (isValid == false)

            e.preventDefault();

        else

           document.getElementById("quotes").submit();

  });

});

/*function myfunction()
{
     
	 document.getElementById("quotes").submit();
}*/
 $(function() {
       var js_array = [<?php echo '"'.implode('","', $Post).'"' ?>];

      //var availableTags = [];
        $( "#code" ).autocomplete({source: js_array});
});
</script>
<style>
.ui-autocomplete {
            max-height: 100px;
            overflow-y: auto;
            /* prevent horizontal scrollbar */
            overflow-x: hidden;
            /* add padding to account for vertical scrollbar */
            padding-right: 20px;
            font-weight: normal;
    }

 select#CleaningTime_noOfhour{   
background: none repeat scroll 0 0 #ffffff;
border: 1px solid #efefef;
border-radius: 4px;
box-shadow: 2px 0 2px #efefef inset;
color: #666;
float: left;
font-size: 17px;
margin-bottom: 13px;
padding: 12px 20px;
width: 100%;
font-family:Verdana,Arial,sans-serif;
}
select#CleaningTime_noOfCleaners
{
  background: none repeat scroll 0 0 #ffffff;
border: 1px solid #efefef;
border-radius: 4px;
box-shadow: 2px 0 2px #efefef inset;
color: #666;
float: left;
font-size: 17px;
margin-bottom: 13px;
padding: 12px 20px;
width: 100%;	 
font-family:Verdana,Arial,sans-serif !important;
}
.ui-menu-item
{
  width:100%; 
  color: #666;
  font-size: 17px;
  background:none repeat scroll 0 0 white;
}
.ui-menu-item.ui-status-focus
{
  
  background:none repeat scroll 0 0 white;
}
</style>

<div class="quote_outer_bg" id="home">
  <div class="wrap">
    <div class="quote_outer">
      <div class="cont">
        <div class="trans-buton">
          <h1> Compare cleaning 
            quotes and book now</h1>
        </div>
        <?php //echo "<pre>";print_r($cleanDetails);die;?>
        <div class="search_outer">

          <?php $form=$this->beginWidget('CActiveForm', array(
			        'action'=> Yii::app()->createUrl('user/service'),
					'id'=>'quotes',
					'enableClientValidation'=>true,
					'clientOptions'=>array(
					'validateOnSubmit'=>true,

					),
				)); ?>

				          <?php echo CHtml::textField('CleaningTime[PostCode]',isset($cleanDetails['CleaningTime']['PostCode']) ? $cleanDetails['CleaningTime']['PostCode'] : '',array('placeholder'=>'Property Post Code or Area' ,'class'=>'required','id'=>'code'));?>
				         
				          <?php echo CHTML::textField('CleaningTime[CleaningDate]',isset($cleanDetails['CleaningTime']['CleaningDate']) ? $cleanDetails['CleaningTime']['CleaningDate'] : '',array('placeholder'=>'Cleaning Date','id'=>'datepicker' ,'class'=>'required'));?>
                          
                          <?php foreach($list as $l) {   	?>
                           
                            <?php $t[]=$l->time; 

                                  $res=array_combine($t,$t);
                                  //echo "<pre>";print_r($res);
                            ?>

                            <?php } //die; ?>

                           <?php  echo $form->dropDownList($model,'time',$res,array('options'=>array(isset($cleanDetails['CleaningTime']['time']) ? $cleanDetails['CleaningTime']['time'] : ''=>array('selected'=>'selected')))); ?>
                           
                   <?php 
                          $options = array ('1.0' => '1 hour','2.0' => '2 hours','3.0' => '3 hours', '4.0'=>'4 hours','5.0' => '5 hours','6.0' => '6 hours','7.0' => '7 hours');
                          //echo CHtml::dropDownList('CleaningTime[noOfhour]', '12', $options,array('options'=>array(isset($cleanDetails['CleaningTime']['noOfhour']) ? $cleanDetails['CleaningTime']['noOfhour'] : ''=>array('selected'=>'selected'))));
                         // echo $form->dropDownList($model,'noofhour',$options); 
                    ?>
                     <?php 
                          $options = array ('1' => '1 Cleaner','2' => '2 Cleaners','3' => '3 Cleaners', '4' => '4 Cleaners','5'=>'5 Cleaners','6' => '6 Cleaners');
                          //echo CHtml::dropDownList('CleaningTime[noOfCleaners]', '12', $options,array('options'=>array(isset($cleanDetails['CleaningTime']['noOfCleaners']) ? $cleanDetails['CleaningTime']['noOfCleaners'] : ''=>array('selected'=>'selected'))));
                         // echo $form->dropDownList($model,'noofhour',$options); 
                    ?>      

				          <?php echo CHtml::button('Submit',array('class'=>'button' ,'value'=>'compare Quotes','id'=>'compare')); ?>
					          <!--<input type="text" placeholder="Property Post Code or Area">
					          <input type="text" placeholder="Cleaning Date" id="datepicker">
					          <input type="text" placeholder="Cleaning Time">
					          <input type="button" value="compare Quotes" class="button"> -->



          <?php $this->endWidget(); ?>
          

          <p class="script">Get fixed prices from Best cleaning companies (takes only 60 seconds?)</p>
        </div>
      </div>
    </div>
  </div>
  <div class="clear"> </div>
</div>
<!--Brands-->
<div class="wrap">
  <ul id="flexiselDemo3">

     <?php if(!empty($homeImage)) { 
            
            foreach($homeImage as $hImage)  { 
     ?> 
    <li> 
        <img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/HomeImages/<?php echo $hImage->image;?>" />

     </li>
     <?php } }   ?>
    
  </ul>
</div>
<!-- services -->
<div class="service" id="service">
  <div class="wrap">
    <h2>How To Use</h2>
    <div class="service_grids">
      <?php if(!empty($ht)) { 
             foreach($ht as $h)
             {
        ?>
      <div class="ser_grid">
        <div class="s_image"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/HowToUseImages/<?php echo $h->image?>" alt="Services" /></div>
        <h3><?php echo $h->title;?></h3>
        <!--<p>Choose the type of cleaning service you need from End of tenancy cleaning, house cleaning, office cleaning, carpet cleaning or any cleaning service you, if the service you need is not added in the form please contact us.</p>
        -->
        <?php echo $h->desc;?>
      </div>
      <?php } }?>
     <!-- <div class="ser_grid">
        <div class="s_image"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/price.png" alt="Services" /> </div>
        <h3>Compare prices</h3>
        <p>Compare fixed quotes and reviews from trusted Local cleaning companies. You can also add additional items and services in this page or the next page, all prices are fixed quotes based on the details you provid.</p>
      </div>
      <div class="ser_grid">
        <div class="s_image"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/book.png" alt="Services" /> </div>
        <h3>Book a company</h3>
        <p>Choose the company that suits you, your booking is secured once you paid the deposit, the cleaning company will get automated notification about the job. We manually contact the cleaning companies to be on the safe side. </p>
      </div>
      <div class="ser_grid">
        <div class="s_image"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/confirm.png" alt="Services" /> </div>
        <h3>Get confirmation</h3>
        <p>As soon as you chose the company and paid the deposit, you and the cleaning company both get the booking confirmation by email with the receipt of the payment, customers and cleaning companies can communicate within the website interior messaging service. </p>
      </div> -->
      <div class="cl"></div>
    </div>
  </div>
</div>
<!-- end services --> 
<!-- about us -->
<div id="about" class="about-grids">
  <div class="wrap">
    <div class="one-of-grid">
      <div class="grid_of_1">
        <?php if(!empty($wel)) { ?>
        <h4><?php echo $wel->title;?></h4>
        <!--<p>Welcome to WOW Cleans, We are a comparison cleaning company where anyone can compare cleaning quotes for various cleaning services and book online.  This platform is the number one platform in the UK and it has not been used before. All companies registered with WOW Cleans are vetted, manually inspected to ensure our website users get the best experience on for their cleaning needs. Our aim is to provide all types of cleaning quotes and at the moment we are more focused on End of tenancy, office cleaning, domestic cleaning and Carpet cleaning. Always compare before you book a cleaning service.</p>
        -->
        <?php echo $wel->desc;?>
        <?php } else { ?>
          <h4>Welcome</h4>
          <p>Coming Soon.</p>
             
        <?php } ?>
      </div>
      <div class="grid_of_1">
        <?php if(!empty($why)) { ?>
        <h4>Why Us</h4>
        <p>It's always essential to compare before you buy, we have created a platform where all professional cleaning companies have registered with us and they are competing in prices and in providing the highest quality cleaning service to their customers. There are many reasons why you should use our website to book your cleaning needs and the most important reason is that you are insured that the quality of service you receive will be outstanding, because if it's not then it will reflect the company's rating on the site. The other reason is prices are always cheaper on our website, because the companies don't have to do any marketing as we do book the jobs for them, so they always give lower prices than their normal price. </p>
        <?php } else { ?>
        <h4>Why Us</h4>
        <p>Coming Soon</p>

        <?php } ?>


      </div>
      <div class="grid_of_1">
        <h4>Our Services</h4>
        <?php if(!empty($Stypes)) { 
               
              foreach($Stypes as $stypes)
              { 
        ?> 
        <h6><?php echo $stypes->service_name;?></h6>
        <!--<p>Prices include cleaning all appliances in the house, including Kitchen appliances, Deep carpet cleaning, interior windows, cupboards etc.</p>
        -->
         <?php echo $stypes->desc;?>
        <?php } } else { ?>
        <?php } ?>
        <!--<h6>Domestic cleaning</h6>
        <p>Prices include cleaning everything in the house, rooms, living rooms, bathrooms, kitchen appliances, windows inside, you can also choose ironing service per hour when filling in the form.</p>
        <h6>Office cleaning</h6>
        <p>Office cleaning prices are based on the size of the premises, and the number of desks, in another word, number of employees, please tell us the size of the office in square meter and number of desks,  Everything in the office will be cleaned including,  Bathrooms, Toilets, Floor, Tables, desks, chairs, curtains, walls etc. </p>
        -->
      </div>
      <div class="cl"> </div>
    </div>
  </div>
</div>
<!-- end about us --> 

<!-- testimonials -->

<div class="testimonials" id="about">
  <div class="wrap">
    <h2>What our Customers Say?</h2>
    <div class="testimonals-row">
      <div class="col-testi">
        <div class="testimonals-details">
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.</p>
        </div>
        <div class="detail">
          <div class="img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/testi_42.jpg" width="100" height="100" alt="Testimonials"></div>
          <div class="name">
            <h5>John Doe</h5>
            <p>Company Name </p>
            <span>High Rise Apartment</span> </div>
        </div>
      </div>
      <div class="col-testi">
        <div class="testimonals-details">
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.</p>
        </div>
        <div class="detail">
          <div class="img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/testi_45.jpg" width="100" height="100" alt="Testimonials"></div>
          <div class="name">
            <h5>John Doe</h5>
            <p>Company Name </p>
            <span>High Rise Apartment</span> </div>
        </div>
      </div>
      <div class="col-testi">
        <div class="testimonals-details">
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.</p>
        </div>
        <div class="detail">
          <div class="img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/testi_48.jpg" width="100" height="100" alt="Testimonials"></div>
          <div class="name">
            <h5>John Doe</h5>
            <p>Company Name </p>
            <span>High Rise Apartment</span> </div>
        </div>
      </div>
      <div class="clear"> </div>
    </div>
  </div>
</div>
<!-- end testimonials --> 

