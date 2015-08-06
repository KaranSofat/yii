<script type="text/javascript">

/*code to filter the result on the basis of miles*/
$(document).ready(function(){
  
       $("#Miles").change(function(){
        ajaxindicatorstart('loading data.. please wait..');
        var mile=$(this).val();        
       // alert(mile);
        //var requestCleaningPage= "<?php echo Yii::app()->session['CleaningReqst'];?>";
         
              $.ajax({
                             type:'GET',  
                            url:"<?php echo Yii::app()->createUrl('user/SerachMiles')?>",
                            
                            data:{'mile':mile},
                            global: false, 
                             success:function(result)
                             {

                                 $("#filter").html(result);
                                 //ajaxindicatorstart('loading data.. please wait..');
                                 ajaxindicatorstop();
                                //alert(result);
                                //location.reload()
                                return true;
                               //alert(result);
                             
                             },
                             error: function (result) {
                             // alert("Error.")
                            //ajaxindicatorstop();
                                  return false;
                            }
                       }); 
           });  

        $('a.popper').hover(function(){
            
            var id=$(this).attr('id');
            var pos = $("#map"+id).position().top;
            //alert(pos);
            //alert(pos)
            $.ajax({
                             type:'GET',  
                            url:"<?php echo Yii::app()->createUrl('user/AjaxPopUpDetailCompany')?>",
           
                            data:{'id':id},
                             success:function(result)
                             {
                                 
                                //alert(result);
                                $(".popbox").fadeIn('fast');
                                $('.popbox').html(result);
                                $(".popbox").css({top: pos});
                                 
                                return true;
                                                            
                             },
                             error: function (result) {
                             // alert("Error.")
                            
                                  return false;
                            }
                       });    

        },function(){ $(".popbox").fadeOut('fast');});    
});


/*
$(function() {
    var moveLeft = 0;
    var moveDown = 0;

    $('a.popper1').hover(function(e) {
         
        
        
        var target = '#' + ($(this).attr('data-popbox'));
       
        $(target).show();
        moveLeft = $(this).outerWidth();
        moveDown = ($(target).outerHeight() / 2);
    }, function() {
        var target = '#' + ($(this).attr('data-popbox'));
        $(target).hide();
    }); 
 
    $('a.popper1').mousemove(function(e) {
        var target = '#' + ($(this).attr('data-popbox'));
         
        leftD = e.pageX + parseInt(moveLeft);
        maxRight = leftD + $(target).outerWidth();
        windowLeft = $(window).width() - 40;
        windowRight = 0;
        maxLeft = e.pageX - (parseInt(moveLeft) + $(target).outerWidth() + 20);
         
        if(maxRight > windowLeft && maxLeft > windowRight)
        {
            leftD = maxLeft;
        }
     
        topD = e.pageY - parseInt(moveDown);
        maxBottom = parseInt(e.pageY + parseInt(moveDown) + 20);
        windowBottom = parseInt(parseInt($(document).scrollTop()) + parseInt($(window).height()));
        maxTop = topD;
        windowTop = parseInt($(document).scrollTop());
        if(maxBottom > windowBottom)
        {
            topD = windowBottom - $(target).outerHeight() - 20;
        } else if(maxTop < windowTop){
            topD = windowTop + 20;
        }
        $(target).css('top', topD).css('left', leftD);
        
        var id=$(this).attr('id');
        $.ajax({
                             type:'GET',  
                            url:"<?php echo Yii::app()->createUrl('user/AjaxPopUpDetailCompany')?>",
           
                            data:{'id':id},
                             success:function(result)
                             {
                                 
                                //alert(result);                                
                                $("#pop1").html(result);
                                return true;
                                                            
                             },
                             error: function (result) {
                             // alert("Error.")
                            
                                  return false;
                            }
                       });   
        





        
     
     
    });
 
}); */


function ajaxindicatorstart(text)
{
  if(jQuery('body').find('#resultLoading').attr('id') != 'resultLoading'){
  jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/loader.gif"><div>'+text+'</div></div><div class="bg"></div></div>');
  }

  jQuery('#resultLoading').css({
    'width':'100%',
    'height':'100%',
    'position':'fixed',
    'z-index':'10000000',
    'top':'0',
    'left':'0',
    'right':'0',
    'bottom':'0',
    'margin':'auto'
  });

  jQuery('#resultLoading .bg').css({
    'background':'#000000',
    'opacity':'0.7',
    'width':'100%',
    'height':'100%',
    'position':'absolute',
    'top':'0'
  });

  jQuery('#resultLoading>div:first').css({
    'width': '250px',
    'height':'75px',
    'text-align': 'center',
    'position': 'fixed',
    'top':'0',
    'left':'0',
    'right':'0',
    'bottom':'0',
    'margin':'auto',
    'font-size':'16px',
    'z-index':'10',
    'color':'#ffffff'

  });

    jQuery('#resultLoading .bg').height('100%');
       jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}

function ajaxindicatorstop()
{
    jQuery('#resultLoading .bg').height('100%');
       jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}
</script>


<div class="title" id="service">
  <div class="wrap">
    <h2>Prices are fixed rated quotes only from trusted cleaning companies near you.</h2>
    
  </div>
  <div class="clear"> </div>
</div>
<div class="white" id="service">
<div class="date_time">Exact Prices From Trusted companies available on 25 aug 2014 at 7:00 pm<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/date.png" width="20" height="21" alt="Date"></div>
    <p class="inclusive">Prices are all inclusive based on the details you have provided, prices could increase near the cleaning date, so why not book now. </p>
  <div class="wrap">
  <div class="save">
   <a href="javascript: window.history.go(-1)" class="previous">Previous</a>
  <!-- <a href="#" class="save_quote">save quotes</a> -->
  </div>
  <div class="left_sidebar">
      <h5>Cleaning Summary</h5>
      <div class="inner">
       <h6>Your Home</h6>
       <div class="book-details">
                        <div class="selected-item"> 
                             
                             <?php 
                                    if(!empty($detailCleaning))
                                    {   
                                        foreach($detailCleaning as $key=>$value) { ?>
                                  <span class="bedroom-entry"><?php  echo $value;?>  <?php  echo $key;?>  </span> / 
                              <?php } } else { 

                                       if(!empty($requestCleaningPage['Cleaning']))
                                       {
                                      foreach($requestCleaningPage['Cleaning'] as $key=>$value) { 
                                ?>
                                    <span class="bedroom-entry"><?php  echo $value;?>  <?php  echo $key;?>  </span> /
                              <?php  } } } ?> 
                              <!--<span class="washroom-entry"><?php //echo $baths;?> bathrooms</span> --> 

                        </div>
                        <span class="frequency-entry">Every Other Week</span>
                        <div class="clean-entry">
                        </div>
                        
                     </div>
                      <h6>Aditional Items</h6>
                      <div class="book-details">
                        <div class="selected-item"> 
                            <?php 

                               if(!empty($values))
                               { 
                               foreach($values as $i=>$option) { 

                                   if($option!=0)
                                   {
                                
                             ?>
                              
                                      <span class="bedroom-entry"><!--Extra --> <?php echo $option." " .$i;?></span> /
                                      
                            <?php } } } else  { ?>

                                     
                                      <span class="bedroom-entry">No Extra added.</span>
                              
                                   
                            <?php } ?>
                            <!--<span class="washroom-entry">Extra Oven</span> -->
                         </div>
                        <span class="frequency-entry"><!--Every Other Week --></span>
                        <div class="clean-entry">
                        </div>
                        
                     </div>
                     <?php if(!empty($property)) { ?>
                      <h6>Property size</h6>
                      <div class="book-details">
                        <div class="selected-item"> <span class="property_size"><?php echo $property;?> square feet</span></div>
                       
                        <div class="clean-entry">
                        </div>
                        
                     </div>
                     <?php } ?>
      </div>
        <div class="clear"> </div>
     <h5>Select By Certificates</h5>
      <div class="inner">
      <ul class="certificates">
        <li><input type="radio"/><label>Blue </label></li>
    <li><input type="radio"/><label>Silver</label></li>
    <li><input type="radio"/><label>Gold</label></li>
        
    
        </ul>
      </div>
    </div>
    <div class="cleaners" id="filter">
    <?php /*if(!empty($CompanyName))
         {*/
     ?>        
    <label>Serach With in miles</label>

       <?php 
              $options = array ('5' => '5 Miles','6' => '6 Miles','7' => '7 Miles', '8' => '8 Miles','9'=>'9 Miles','10' => '10 Miles','11' => '11 Miles','12' => '12 Miles','13' => '13 Miles','14' => '14 Miles','15' => '15 Miles','20'=>'20 Miles');
              echo CHtml::dropDownList('Miles', ' ', $options);
             // echo $form->dropDownList($model,'noofhour',$options); 
        ?>
        <div id="dvLoading" style="display:none"></div>

       <?php //} ?>    
      <div class="row_outer row_outer_head">
        
        <div class="col1">
          <div class="row">Company</div>
        </div>
        <div class="col2">
          <div class="row">Certificate</div>
        </div>
        <div class="col2">
          <div class="row">Rating</div>
        </div>
        <div class="col3">
          <div class="row">Insured</div>
        </div>
        <div class="col4">
          <div class="row">Price</div>
        </div>
      </div>
      <?php if(!empty($CompanyName))
            { 

       foreach($CompanyName as $distance=>$name) { 
              $res=explode("+",$name);
              //echo "<pre>";print_r($res);
              if($distance<=5)
              { 
        ?>
      <div class="row_outer">
        <div class="col1">
         <div class="row" id="map<?php echo $res[1];?>">
            <!--
            <a href="<?php //echo Yii::app()->request->baseUrl; ?>/user/companyProfile/<?php //echo $res[1];?>" class="popper" data-popbox="pop" id="<?php echo $res[1];?>">
                <h4><?php //echo ucfirst($res[0]);?></h4>
            </a> -->
            <a href="javascript:void(0)" class="popper" data-popbox="pop" id="<?php echo $res[1];?>">
                <h4><?php echo ucfirst($res[0]);?></h4>
            </a>
            
            <p> <?php echo round($distance,2);?> Mile from your pick-up address</p>
          

          </div>
        </div>
        <div class="col2">
          <div class="row"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/certified.png" alt="certified"></div>
        </div>
        <?php 
            // echo "<pre>";print_r($sumArrayRatingAvg);die;
             foreach($sumArrayRatingAvg as $id=>$avgRate)
              {  

                    if($res[1]==$id)
                    {  
                        $star= ceil($avgRate);
                        //$a=1;
                        $stars=$star;
                        $path= Yii::app()->request->baseUrl."/themes/back/css/images/icons/dark/Places-favorites-icon.png";
                        for($j=0;$j<$stars;$j++)
                        {
                      
        ?> 
        <div class="col2 star">
          <div class="row">
                   <!--<div class="rating"> <img src="<?php //echo Yii::app()->request->baseUrl; ?>/images/rating.png" alt="Rating"> </div>
                   -->
                   <div class="rating">
                            <?php echo "<img src=".$path.">";?>
                   </div>
          </div>
        </div>
        <?php } } } ?>
        
       <!-- condition for empty stars div starts here to main tain the design-->
        <?php if(!array_key_exists($res[1],$sumArrayRatingAvg)) { ?>
            
         <div class="col2 star2" style="width:15%">
              <div class="row">
                      
                       <div class="rating">
                       </div>
              </div>
        </div>


        <?php } ?>

        <div class="col3">
          <div class="row">
            <div class="ensure"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/ensure.png" alt="Ensure"> </div>
          </div>
        </div>
    
        <!-- <div class="col4">
                <div class="row">
                  <span class="price">&pound;778</span>
                <span class="small_price">Pay Only &pound;33 Now </span>
                <a href="#" class="continue">Continue</a>
                 </div>
        </div> -->

        <div class="col4">
          
         <?php
         /*
                    foreach($userDetail as $priceAdmin)
             {
                  foreach($priceAdmin as $p)
                   {
                        //echo "<pre>";print_r($p->priceAdmins);
                        foreach($p->priceAdmins as $price)
                        {
                              // echo "<pre>";print_r($res[1]);
                              
                               if($price['service_id']==$res[1])
                              {       

                              $service_id=$price['service_id'];

                              $service_type_id=$price['service_type_id'];

                              $bedroom=$price['bedroom'];

                              $bathroom=$price['bathroom'];

                              $property=$price['property'];

                              $desk=$price['desk'];

                              $ar =array($service_type_id=>array($service_id=>array('Property'=>$property,'Desk'=>$desk,'Bedrooms'=>$bedroom,'Bathrooms'=>$bathroom))); 
                              foreach($ar as $r)
                              {
                                 $prop=$r[$service_id]['Property']*$_REQUEST['Cleaning']['Property'];
                                 $desk=$r[$service_id]['Desk']*$_REQUEST['Cleaning']['Desk'];
                                 $bed=$r[$service_id]['Bedrooms']*$_REQUEST['Cleaning']['Bedrooms'];
                                 $bath=$r[$service_id]['Bathrooms']*$_REQUEST['Cleaning']['Bathrooms'];

                                 $multiply=array($prop,$desk,$bed,$bath);
                                 $res1=array_sum($multiply);

                                 $price=array($service_id=>array($res1));
                                 
                                 //echo "<pre>";print_r($price);

                                   $res=explode("+",$name);
                                   //echo "<pre>";print_r($res);
                                  
                                    
                  
                                      foreach($price[$service_id] as $p)

                                    {

                                         //echo "<pre>";print_r($p);
                                         foreach($additionalPrice as $k=>$r)
                                      {
                                          
                                         $sum=array($k=>array_sum($r));
                                         //echo "<pre>";print_r($additionalPrice); 
                                         if($k==$res[1])
                                        {
       */   
       //echo "<PRE>";print_r($sums);die;
       ?>      
        
        <?php
              if(!empty($sums))
              {  
              foreach($sums as $key=>$s) { 
                 
               if($key==$res[1])
               { 
          ?>
           <div class="row">
                <!--  <span class="price" id="">&pound; <?php //if(!empty($sum)) { echo $p ."+". $sum[$k]."=". $p+$sum[$k];} else { echo $p; } ?></span>
                <span class="small_price">Pay Only &pound;33 Now </span>
                <a href="<?php //echo Yii::app()->createUrl('payment/payment',array('value'=>base64_encode($p+$sum[$k]),'service_id'=>$res[1]))?>" class="continue">Select</a> 
                 -->
                 
                  <span class="price" id="">&pound; <?php echo $s; ?></span>
                
                <a href="<?php echo Yii::app()->createUrl('payment/payment',array('value'=>base64_encode($s),'service_id'=>$res[1]))?>" class="continue">Select</a> 
          </div>                       
          
          <?php } } }  ?> 
          
       <?php /*
                 }
               }
                }
                              }  
                          }    
                            
                        }  
                         
                     
                       
                   } 
                          
             }//die;

          */

        ?>

        </div>
      </div>
      <?php } } } else { ?>             
          

          <div class="row_outer">
           <h4 style="text-align:center;margin-top:5px;"> No Result Found</h4>

          </div>
      
           
      <?php } ?>


      <!--Code for pop on hover the company starts here -->
      <div id="pop123" class="popbox">
        
      </div> 
      <!--Code for opo up hover the company ends here   -->


      <!--  <div class="row_outer">
        <div class="col1">
          <div class="row">
            <h4>Best Rate Cleaners</h4>
            <p>1 Mile from your pick-up address</p>
          </div>
        </div>
        <div class="col2">
          <div class="row"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/certified.png" alt="certified"></div>
        </div>
        <div class="col2">
          <div class="row">
            <div class="rating"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/rating.png" alt="Rating"> </div>
          </div>
        </div>
        <div class="col3">
          <div class="row">
            <div class="ensure"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/ensure.png" alt="Ensure"> </div>
          </div>
        </div>
        <div class="col4">
          <div class="row">
            <span class="price">&pound;778</span>
          <span class="small_price">Pay Only &pound;33 Now </span>
          <a href="#" class="continue">Continue</a> </div>
        </div>
      </div>
    <div class="row_outer">
        <div class="col1">
          <div class="row">
            <h4>Best Rate Cleaners</h4>
            <p>1 Mile from your pick-up address</p>
          </div>
        </div>
        <div class="col2">
          <div class="row"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/certified.png" alt="certified"></div>
        </div>
        <div class="col2">
          <div class="row">
            <div class="rating"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/rating.png" alt="Rating"> </div>
          </div>
        </div>
        <div class="col3">
          <div class="row">
            <div class="ensure"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/ensure.png" alt="Ensure"> </div>
          </div>
        </div>
        <div class="col4">
          <div class="row">
            <span class="price">&pound;778</span>
          <span class="small_price">Pay Only &pound;33 Now </span>
          <a href="#" class="continue">Continue</a> </div>
        </div>
      </div>
      <div class="row_outer">
        <div class="col1">
          <div class="row">
            <h4>Best Rate Cleaners</h4>
            <p>1 Mile from your pick-up address</p>
          </div>
        </div>
        <div class="col2">
          <div class="row"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/certified.png" alt="certified"></div>
        </div>
        <div class="col2">
          <div class="row">
            <div class="rating"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/rating.png" alt="Rating"> </div>
          </div>
        </div>
        <div class="col3">
          <div class="row">
            <div class="ensure"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/ensure.png" alt="Ensure"> </div>
          </div>
        </div>
        <div class="col4">
          <div class="row">
          <span class="price">&pound;778</span>
          <span class="small_price">Pay Only &pound;33 Now </span>
           <a href="#" class="continue">Continue</a> </div>
        </div>
      </div>
      <div class="row_outer">
        <div class="col1">
          <div class="row">
            <h4>Best Rate Cleaners</h4>
            <p>1 Mile from your pick-up address</p>
          </div>
        </div>
        <div class="col2">
          <div class="row"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/certified.png" alt="certified"></div>
        </div>
        <div class="col2">
          <div class="row">
            <div class="rating"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/rating.png" alt="Rating"> </div>
          </div>
        </div>
        <div class="col3">
          <div class="row">
            <div class="ensure"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/ensure.png" alt="Ensure"> </div>
          </div>
        </div>
        <div class="col4">
          <div class="row">
            <span class="price">&pound;778</span>
          <span class="small_price">Pay Only &pound;33 Now </span>
          <a href="#" class="continue">Continue</a> </div>
        </div>
      </div>
      <div class="row_outer">
        <div class="col1">
          <div class="row">
            <h4>Best Rate Cleaners</h4>
            <p>1 Mile from your pick-up address</p>
          </div>
        </div>
        <div class="col2">
          <div class="row"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/certified.png" alt="certified"></div>
        </div>
        <div class="col2">
          <div class="row">
            <div class="rating"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/rating.png" alt="Rating"> </div>
          </div>
        </div>
        <div class="col3">
          <div class="row">
            <div class="ensure"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/ensure.png" alt="Ensure"> </div>
          </div>
        </div>
        <div class="col4">
          <div class="row">
            <span class="price">&pound;778</span>
          <span class="small_price">Pay Only &pound;33 Now </span>
          <a href="#" class="continue">Continue</a> </div>
        </div>
      </div> -->
    </div>
    <div class="right_sidebar">
        <h5>FAQ</h5>
      <div class="inner faq">
      
<ul id="accordion">
    <?php foreach($faq as $f) { ?>
    <li>

        <p> <span>Q:</span> <?php echo $f->question;?></p>
        <div class="ans"><span>Ans:</span> <?php echo strip_tags($f->answer);?>
        </div>

    </li>
    <?php } ?>
  <!--  <li>

       <p><span>Q:</span> How can i contact the cleaning compniey?</p>
      <div class="ans"><span>Ans:</span>After you paid the deposit and secured the cleaning company of your choice, Wow Cleans will send you the details of the cleaning, then you will be able to communicate with cleaning company, there you can give more details about getting the keys to the property or any other special requirements.
        </div>

    </li>
    <li>

        <p><span>Q:</span> Can i trust the companies on WOW Cleans?</p>

     <div class="ans"><span>Ans:</span>Absolutely yes. All the cleaning companies on Wow cleans have nee checked, pre-validated and met our minimum quality standards. To help you differentiate between companies, we have awarded each company with a quality certificate based on our assessment of the level of service they provide.

        </div>
        </li>
          <li>

     <p><span>Q:</span> What do your certification mean?</p>
      <div class="ans"><span>Ans:</span>Gold (Large Cleaning companies): Highest level of professional service. Fully insured. Highest ranking based on customer reviews.<br/>

Silver (recommended for small and medium size property cleans): High level of professional service. Fully insured. High ranking based on customer reviews <br/>

Blue (recommended for small cleaning services,): Great service, passes minimum quality standards. Fully insured, high rating based on customer reviews.  <br/>
Note: companies that provide low standard of cleaning service will be removed from our database, 


        </div>

    </li>
    
    <li>

        <p><span>Q:</span>What happens when I click on 'Book now'?</p>

     <div class="ans"><span>Ans:</span>Wow Cleans will instantly generate Cleaning quotes and cleaning plans (free of charge!). You will be able to save your cleaning date plan until you are ready to book. Once you are ready to book, you will be taken through to the payment page where you can pay a small deposit to secure your Cleaning Company for the time and date of your choosing. Wow Clean is totally free to use.

        </div>
        </li>
    
    
    
    
    
    <li>

        <p><span>Q:</span> How do i pay?</p>

     <div class="ans"><span>Ans:</span>You pay a small deposit on Wow Cleans to secure your chosen cleaner and secure your booking. The remaining balance is then paid directly to your cleaner who will contact you within 24 hours and will confirm you with their method of acceptance payment. Just to re-iterate, the prices shown on Wow Cleans are the final amount that you pay for the job. All prices are fixed prices with no additional cost.

        </div>
        </li>
        
        <li>

        <p><span>Q:</span> What if I need more help?</p>

     <div class="ans"><span>Ans:</span> You can always call our team to discuss any further details of if you need any help with filling the form, we are more than happy to help you over the phone and get you the prices and you can choose the cleaning company over the phone, our dedicated member of customer service team is on hand to help every step of the way. 


        </div>
        </li> -->
</ul>
         <div class="clear"> </div> 
      </div>
       <h5>Select Additional Services</h5>
      <div class="inner">
      <ul class="extra mhd">
       <?php //echo "<pre>";print_r($values['opt']);die;?>
         <?php if(!empty($values)) { 
               foreach($values as $i=>$option) {  
                      //echo "<pre>";print_r($i);
                      if($option!=0)
                      {
                 ?>
          <li>
              <input type="checkbox" id="checkbox-2-1" class="regular-checkbox big-checkbox" name="opt[]"  <?php echo ($option == $option) ? 'disabled="disabled"' : ''; ?> value= "<?php echo $option;?> " <?php echo ($option == $option) ? 'checked="checked"' : ''; ?>/>
              <label for="checkbox-2-1"><?php echo $option." " .$i;?> </label>
          </li>
           <?php } } } else {  ?>
           <li>No additional selected.</li>
           <?php } ?>

          
      
        </ul>
      </div>
    </div>
  </div>
  <div class="clear"> </div>
</div>
</div>


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
            <h5>John Doe</a></h5>
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
            <h5>John Doe</a></h5>
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
            <h5>John Doe</a></h5>
            <p>Company Name </p>
            <span>High Rise Apartment</span> </div>
        </div>
      </div>
      <div class="clear"> </div>
    </div>
  </div>
</div>
