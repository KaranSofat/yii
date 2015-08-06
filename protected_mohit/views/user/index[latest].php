<?php
/* @var $this UserController */

/*$this->breadcrumbs=array(
	'User',
);*/
?>
<script type="text/javascript">
$(document).ready(function(){
     $( "#datepicker" ).datepicker({
      minDate: 0,
      
    });
});
</script>


<div class="quote_outer_bg" id="home">
  <div class="wrap">
    <div class="quote_outer">
      <div class="cont">
        <div class="trans-buton">
          <h1> Compare cleaning 
            quotes and book now</h1>
        </div>
        <div class="search_outer">
          <?php $form=$this->beginWidget('CActiveForm', array(
			        'action'=> Yii::app()->createUrl('user/compareQuotes'),
					'id'=>'quotes',
					'enableClientValidation'=>true,
					'clientOptions'=>array(
					'validateOnSubmit'=>true,

					),
				)); ?>

				          <?php echo CHtml::textField('PostCode','',array('placeholder'=>'Property Post Code or Area'));?>
				          <?php echo CHTML::textField('CleaningDate','',array('placeholder'=>'Cleaning Date','id'=>'datepicker'));?>
                          
                          <?php foreach($list as $l) { 

                                 // echo "<pre>";print_r($t);
                          	?>
                           
                            <?php $t[]=$l->time;?>
                            <?php } //die; ?>

                           <?php  echo $form->dropDownList($model,'time',$t,array('class'=>'')); ?>
                           

                           

				          <?php echo CHtml::button('Submit',array('class'=>'button' ,'value'=>'compare Quotes')); ?>
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
    <li> <img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/images/client1.jpg" /> </li>
    <li> <img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/images/client5.jpg" /> </li>
    <li> <img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/images/client2.jpg" /> </li>
    <li> <img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/images/client5.jpg" /> </li>
    <li> <img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/images/client4.jpg" /> </li>
    <li> <img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/images/client3.jpg" /> </li>
    <li> <img alt="" src="<?php echo Yii::app()->request->baseUrl; ?>/images/client4.jpg" /> </li>
  </ul>
</div>
<!-- services -->
<div class="service" id="service">
  <div class="wrap">
    <h2>How To Use</h2>
    <div class="service_grids">
      <div class="ser_grid">
        <div class="s_image"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/services.png" alt="Services" /></div>
        <h3>Choose a service</h3>
        <p>Choose the type of cleaning service you need from End of tenancy cleaning, house cleaning, office cleaning, carpet cleaning or any cleaning service you, if the service you need is not added in the form please contact us.</p>
      </div>
      <div class="ser_grid">
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
      </div>
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
        <h4>Welcome</h4>
        <p>Welcome to WOW Cleans, We are a comparison cleaning company where anyone can compare cleaning quotes for various cleaning services and book online.  This platform is the number one platform in the UK and it has not been used before. All companies registered with WOW Cleans are vetted, manually inspected to ensure our website users get the best experience on for their cleaning needs. Our aim is to provide all types of cleaning quotes and at the moment we are more focused on End of tenancy, office cleaning, domestic cleaning and Carpet cleaning. Always compare before you book a cleaning service.</p>
      </div>
      <div class="grid_of_1">
        <h4>Why Us</h4>
        <p>It's always essential to compare before you buy, we have created a platform where all professional cleaning companies have registered with us and they are competing in prices and in providing the highest quality cleaning service to their customers. There are many reasons why you should use our website to book your cleaning needs and the most important reason is that you are insured that the quality of service you receive will be outstanding, because if it's not then it will reflect the company's rating on the site. The other reason is prices are always cheaper on our website, because the companies don't have to do any marketing as we do book the jobs for them, so they always give lower prices than their normal price. </p>
      </div>
      <div class="grid_of_1">
        <h4>Our Services</h4>
        <h6>End of tenancy cleaning</h6>
        <p>Prices include cleaning all appliances in the house, including Kitchen appliances, Deep carpet cleaning, interior windows, cupboards etc.</p>
        <h6>Domestic cleaning</h6>
        <p>Prices include cleaning everything in the house, rooms, living rooms, bathrooms, kitchen appliances, windows inside, you can also choose ironing service per hour when filling in the form.</p>
        <h6>Office cleaning</h6>
        <p>Office cleaning prices are based on the size of the premises, and the number of desks, in another word, number of employees, please tell us the size of the office in square meter and number of desks,  Everything in the office will be cleaned including,  Bathrooms, Toilets, Floor, Tables, desks, chairs, curtains, walls etc. </p>
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

