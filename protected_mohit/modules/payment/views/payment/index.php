<script type="text/javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.payment.js"></script>
  
<script>

$(document).ready(function(){

    var msg=$('.info').text();

     if(msg!='')
     {
       $(".box").css("border","1px solid red");
     }      

    $('.pinkbtn').click(function(){
          
           var msg=$('.info').text();

            if(msg!='')
             {
               $(".box").css("border","1px solid red");
               $( "#move" ).scroll(300);  
               /*$.scrollUp({
                    scrollName: 'move', // Element ID
                    topDistance: '300', // Distance from top before showing element (px)
                    topSpeed: 300, // Speed back to top (ms)
                    animation: 'fade', // Fade, slide, none
                    animationInSpeed: 200, // Animation in speed (ms)
                    animationOutSpeed: 200, // Animation out speed (ms)
                    scrollText: 'Scroll to top', // Text for element
                    activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
                  }); */
             }  
    });

    /* $("#payment").validate({

              rules:
              { 
                  'CustomerUser[cname]':{
                     
                     required:true,
                     
                  },
                  'CustomerUser[email]':{
                     
                     required:true,
                     email:true
                  }
              },
              
             messages:{

                   'CustomerUser[cname]':{
                     
                     required:"Please Enter the first name."
                     
                  }
   
             }


     }); */

     // ajax call for auto suggestion address
      $("#email").blur(function(){
              
               var email =$(this).val();
               var zip   =$("#zipcode").val();


              $.ajax({
                           type:'GET',  
                           url:"<?php echo Yii::app()->createUrl('payment/payment/ajaxAddress')?>",
             
                            data:{'email':email,'zip':zip},
                            dataType: 'json',
                                 success:function(result)
                                 {
                                     
                                    //alert(result);
                                    var tags=result;
                                    $( "#address" ).autocomplete({ source: tags });
                                    // $("#address").val(result);
                                    return true;
                                   //alert(result);
                                 
                                 },
                                 error: function (result) {
                                  alert("Error.")
                                
                                      return false;
                                }
               });

     });


   /* give back groun to all fields on submit click */
   $('#Pay').click(function(e) {
         /* var isValid = true;
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
              alert('Thank you for submitting');
      });*/
    
});

</script>

   <script>
    jQuery(function($) {
      $('[data-numeric]').payment('restrictNumeric');
      $('.cc-number').payment('formatCardNumber');
      $('.cc-exp').payment('formatCardExpiry');
      $('.cc-cvc').payment('formatCardCVC');

      $.fn.toggleInputError = function(erred) {
        this.parent('.form-group').toggleClass('has-error', erred);
        return this;
      };

      $('form').submit(function(e) {
       // e.preventDefault();

        var cardType = $.payment.cardType($('.cc-number').val());
        $('.cc-number').toggleInputError(!$.payment.validateCardNumber($('.cc-number').val()));
        $('.cc-exp').toggleInputError(!$.payment.validateCardExpiry($('.cc-exp').payment('cardExpiryVal')));
        $('.cc-cvc').toggleInputError(!$.payment.validateCardCVC($('.cc-cvc').val(), cardType));
        $('.cc-brand').text(cardType);

        $('.validation').removeClass('text-danger text-success');
        $('.validation').addClass($('.has-error').length ? 'text-danger' : 'text-success');
      }); 

    });
  </script>
 <style>
 .errorMessage
 {
   margin-bottom:-19px;
 }
 </style> 
<?php $form=$this->beginWidget('CActiveForm', array(
                        'action'=> Yii::app()->createUrl('payment/payment',array('value1'=>base64_encode($price),'service_id'=>$service_id)),
                        'id'=>'payment',
                        'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                        ),
             )); 
  ?>


  <div class="profile_outer">

    <div class="detail_outer sign_2">
     <!-- <h4> Detail </h4> -->
   
       
          
      <div class="detail_m">
	        <div class="left_form">
	              <?php echo $form->labelEx($model,'cname',array('label'=>'First Name')); ?>
	              <?php echo $form->textField($model,'cname',array('value'=>$customerDetail['cname'])); ?>
                <?php echo $form->error($model,'cname'); ?> 
	         </div>
	       <div class="right_form">
	              <?php echo $form->labelEx($model,'clname',array('label'=>'Last Name')); ?>
                <?php echo $form->textField($model,'clname',array('value'=>$customerDetail['clname'])); ?>
                <?php echo $form->error($model,'clname'); ?> 
	        </div>
	        <input type="hidden" name="service_id" value="<?php echo $service_id;?>">
          <div class="left_form"> 
                <?php echo $form->labelEx($model,'email',array('label'=>'Email')); ?>
                <?php echo $form->textField($model,'email',array('id'=>'email' ,'value'=>$customerDetail['email'])); ?>
                <?php echo $form->error($model,'email'); ?> 
           </div>
	        
           <?php $ses = Yii::app()->session['CleaningDetail']; 
              $zip=$ses['CleaningTime']['PostCode'];

                 if(!empty($ses))
                 {
           ?>
	        <div class="right_form"> 
	              <?php echo $form->labelEx($model,'zipcode',array('label'=>'Zip Code')); ?>
                <?php echo $form->textField($model,'zipcode',array('value'=>$zip,'readonly'=>'readonly','id'=>'zipcode')); ?>
                <?php echo $form->error($model,'zipcode'); ?> 
	        </div>
          <?php } else { ?>

            <div class="right_form"> 
                <?php echo $form->labelEx($model,'zipcode',array('label'=>'Zip Code')); ?>
                <?php echo $form->textField($model,'zipcode',array()); ?>
                <?php echo $form->error($model,'zipcode'); ?> 
          </div>


          <?php } ?>
	         <div class="right_form">
	              <?php echo $form->labelEx($model,'phone',array('label'=>'Phone')); ?>
                <?php echo $form->textField($model,'phone',array('value'=>$customerDetail['phone'])); ?>
                <?php echo $form->error($model,'phone'); ?> 
	        </div>
	        <div class="left_form"> 
                <?php echo $form->labelEx($model,'caddress',array('label'=>'Address')); ?>
                <?php echo $form->textField($model,'caddress',array('id'=>'address','value'=>$customerDetail['caddress'])); ?>
                <?php echo $form->error($model,'caddress'); ?> 
           </div>
          <?php if(!empty($town))  { ?> 
	        <div class="left_form"> 
		            <?php echo $form->labelEx($model,'city',array('label'=>'City')); ?>
                <?php echo $form->textField($model,'city',array('value'=>$town['town'],'readonly'=>'readonly')); ?>
                <?php echo $form->error($model,'city'); ?> 
	        </div>
	         <?php } else { ?>

           <div class="left_form"> 
                <?php echo $form->labelEx($model,'city',array('label'=>'City')); ?>
                <?php echo $form->textField($model,'city',array()); ?>
                <?php echo $form->error($model,'city'); ?> 
          </div>


           <?php } ?>
           
           <?php if(!empty($town))  { ?> 
          <div class="right_form"> 
                <?php echo $form->labelEx($model,'country',array('label'=>'Country')); ?>
                <?php echo $form->textField($model,'country',array('value'=>$town['county'],'readonly'=>'readonly')); ?>
                <?php echo $form->error($model,'country'); ?> 
          </div>
           <?php } else { ?>

           <div class="right_form"> 
                <?php echo $form->labelEx($model,'country',array('label'=>'Country')); ?>
                <?php echo $form->textField($model,'country',array()); ?>
                <?php echo $form->error($model,'country'); ?> 
          </div>


           <?php } ?>
           
        
      </div>
      <div class="clear"> </div>
     
  </div>
</div></div>
<div class="clear"> </div>

 <?php if(Yii::app()->user->hasFlash('ack')):?>
          <div class="info" style="text-align:center;color:red;">
              <?php echo Yii::app()->user->getFlash('ack'); ?>
          </div>
<?php endif; ?>

 <div class="profile_outer conform_1" id="move">
    <div class="detail_outer payment_outer">
    <?php 

      $value =base64_decode($_REQUEST['value']);
      $value1 =base64_decode($_REQUEST['value1']);
      if($value!=0){  ?>
      <h4>Accept £<?php echo $price; ?> quote </h4>
      <?php }  else if($value1!=' ') { ?> 
        <h4>Accept £<?php echo $value1; ?> quote </h4>  
       <?php  } else { ?>
        <h4>Accept £ 0 quote </h4>
      <?php } ?>
      <div class="conform_outer">
        <h4> To confirm your job simply pay the small deposit through our secure payment system. </h4>
        <div class="conform"> <span> <img src="<?php echo Yii::app()->baseUrl;?>/images/padlock-white.png"> </span>
          <h4> Pay deposit </h4>
        </div>
      </div>
      <div class="left-column">
        <div class="box">
          <h3>What happens now?</h3>
          <ul class="blue-numbers">
           <?php if($value!=0) { ?>
            <li><span>1</span> Pay a deposit of <strong>£<?php echo $price; ?></strong></li>
            <?php } else if($value1!=' ') { ?> 
             <li><span>1</span> Pay a deposit of <strong>£<?php echo $value1; ?></strong></li>
            
            <?php } else { ?>
            <li><span>1</span> Pay a deposit of <strong>£ 0</strong></li>
            <?php } ?>

            <!--<li><span>2</span> You will receive all the contact details for Remsquad</li>
            <li><span>3</span> Successfully carry out your WowClean job, hassle free!</li>
            <li><span>4</span> Pay the remaining <strong>£377.00</strong> to Remsquad's driver</li>
           -->
          </ul>
          <div class="logos">
            <div class="paypal"></div>
          </div>
        </div>
      </div>
      <div class="right-column">
  <div class="box">
   <?php if($value!=0) { ?>

    <h3>Deposit to pay now <span>£<?php echo $price; ?></span></h3>
    <?php } else if($value1 !=' ') { ?> 
           <h3>Deposit to pay now <span>£<?php echo $value1; ?></span></h3>
     <?php } else { ?>
     <h3>Deposit to pay now <span>£ 0</span></h3> 
    <?php } ?>

    <div id="payment-choices">
     <label id="paypoint-payment-label">
		        <input type="text" id="card" name="PaymentCustomerUser[cardDetail]" class="cc-number" style="">
		        Card Detail
      </label> 
      <label id="paypal_v2-payment-label">
           <select name="PaymentCustomerUser[cardType]" id="cardtype">
                   <option value="">Select</option>
                   <option value="visa">Visa</option>
                   <option value="MasterCard">Master Card</option>
                   <option value="AmericanExpress">American Express</option>

           </select>
           
                  <label>Select Card</label> 
       </label>
      <label id="paypal_v2-payment-label">
	        <input type="text" id="expire" name="PaymentCustomerUser[expire]" class="cc-exp" placeholder="mm/yy"  style="width:60px;">
	        Expiration
       </label>
        <label id="paypal_v2-payment-label">
	        <input type="text" id="codeSecurity" name="PaymentCustomerUser[code]" class="cc-cvc" style="width:50px;">
	        Security Code
        </label> 
        
         <?php echo CHtml::submitButton('PAY NOW',array('class'=>'payment-form-submit pinkbtn' ,'id'=>"Pay")); ?>
      </div>
   
    <!-- payment-wrap -->
    <div id="payment-spinner"></div>
  </div>
</div>
      
      
    </div>
  </div>
</div>
<div class="clear"> </div>

 <?php $this->endWidget(); ?>
