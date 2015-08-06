<script>
$(document).ready(function(){
     
     $('.plus').click(function(){
     
       
        var res = parseInt($(this).next('.count1').val()) + 1;
         
        //var res = parseInt($(this).prev('.plus').val()) + 1;
         //alert(res)  
        $(this).next('.count1').attr('value',res);
  
       $(this).parent().find('.incre').text(res);
      
      
   });
     

   $('.minus').click(function(){
     
  
        var currentVal=$(this).parent().find('.count1').val();
        if(currentVal!=0)
        {
          var calVal=parseInt(currentVal)-1;
        }
         
       // alert(calVal)
        if(currentVal==0)
        {
           return flase;
        }  
         
        

        $(this).parent().find('.count1').attr('value',calVal);

        $(this).parent().find('.incre').text(calVal);
      
   });



     $(".compare").click(function(){

        var val = document.getElementById('AdditionalCustDetail_AdditionalCustDetail').value;

        if (/^\s*$/g.test(val) || val.indexOf('\n') != -1) 
        {
            $('#AdditionalCustDetail_AdditionalCustDetail').css({

                    "border": "1px solid red",

                    "background": "#FFCECE"

                });
            $("#detailAd").html("<b>Please give the additional details</b>");
            return false;
        }
        else
        {
            $('#AdditionalCustDetail_AdditionalCustDetail').css({

                    "border": "",

                    "background": ""

                });

             // ajax to set the session values
          
               
                var data=$("#bookingForm").serialize();
             //alert(data)
               $.ajax({
                               type: 'POST',
                                url: '<?php echo Yii::app()->createAbsoluteUrl("user/SesReqstCleaning"); ?>',
                               
                                data:data,
                                 success:function(data){

                                           //alert(data);
                                           document.getElementById("bookingForm").submit();
                                           return true;
                                          },
                               error: function(data) { // if error occured
                                    // alert(data);
                                     return false;
                                },
                             
                              dataType:'html'
                    }); 
             
            
           //document.getElementById("bookingForm").submit();
        } 
        
        
        /* var property=$("#property").val();
         var beds=$("#beds").val();
         var baths=$("#baths").val();

         if(property=='' || beds=='' || baths=='')
         {

              $("#property").css({"border": "1px solid red","background": "#FFCECE"});
              $("#beds").css({"border": "1px solid red","background": "#FFCECE"});
               $("#baths").css({"border": "1px solid red","background": "#FFCECE"});
            
                

         }    
         
         else if(property!='' && beds!='' && baths!='')
         {
              $("#baths").css({"border": "","background": ""});
            $("#property").css({"border": "","background": ""});
            $("#beds").css({"border": "","background": ""});
              document.getElementById("bookingForm").submit();          
         } 
         else
         {
            $("#baths").css({"border": "","background": ""});
            $("#property").css({"border": "","background": ""});
            $("#beds").css({"border": "","background": ""});

         }
           */

               // document.getElementById("bookingForm").submit();          
       
       

     });

     
     //ajax call for property starts here

     $("#property").change(function(){
          
          var serviceTypeId="<?php echo $_REQUEST['typeId'];?>";

          var propSize=$("#property").val();
          
          $.ajax({
                      type:'GET',  
                      url:"<?php echo Yii::app()->createUrl('user/ajaxPropertyChnage')?>",
           
                       data:{'serviceTypeId':serviceTypeId,'propSize':propSize},
                       success:function(result)
                       {
                        
                          if(result!='')
                          {   
                              $("#beds").html(result);
                           
                              return true;
                           }
                           else
                           {
                             location.reload();
                           }
                                                
                       },
                       error: function (result) {
                       // alert("Error.")
                      
                            return false;
                      }
             });


              $.ajax({
                      type:'GET',  
                      url:"<?php echo Yii::app()->createUrl('user/ajaxPropertyBaths')?>",
           
                       data:{'serviceTypeId':serviceTypeId,'propSize':propSize},
                       success:function(result)
                       {
                           if(result!='')
                           { 
                              $("#baths").html(result);                                                  
                              return true;
                           }  
                           else
                           {
                             location.reload();
                           }                   
                       },
                       error: function (result) {
                        //alert("Error.")
                      
                            return false;
                      }
             });


           
                                 

     });
     // ajax callfor property ends here



     //ajax call for beds change starts here

      $("#beds").change(function(){
          
          var serviceTypeId="<?php echo $_REQUEST['typeId'];?>";

          var beds=$("#beds").val();

          $.ajax({
                      type:'GET',  
                      url:"<?php echo Yii::app()->createUrl('user/ajaxBedsChnage')?>",
           
                       data:{'serviceTypeId':serviceTypeId,'beds':beds},
                       success:function(result)
                       {
                           if(result!='')
                           {
                               $("#property").html(result);
                               return true;                             
                           }
                           else
                           {
                             location.reload();

                           }
                                               
                       },
                       error: function (result) {
                           return false;
                      }
             });

           $.ajax({
                      type:'GET',  
                      url:"<?php echo Yii::app()->createUrl('user/ajaxBedsBathChnage')?>",
           
                       data:{'serviceTypeId':serviceTypeId,'beds':beds},
                       success:function(result)
                       {
                           if(result!=' ')
                           {
                               $("#baths").html(result);
                                return true;                            
                           }
                           else
                           {
                             location.reload();
                           }
                                                
                       },
                       error: function (result) {
                           return false;
                      }
             });

     });

     //ajax call for beds change ends here


     // ajax call for baths change starts here

      $("#baths").change(function(){
          
          var serviceTypeId="<?php echo $_REQUEST['typeId'];?>";

          var baths=$("#baths").val();

          $.ajax({
                      type:'GET',  
                      url:"<?php echo Yii::app()->createUrl('user/ajaxBathsChnage')?>",
           
                       data:{'serviceTypeId':serviceTypeId,'baths':baths},
                       success:function(result)
                       {
                           if(result!='')
                           {
                               $("#property").html(result);
                               return true;
                           }
                           else
                           {

                              location.reload();
                           }                    
                       },
                       error: function (result) {
                           return false;
                      }
             });

            $.ajax({
                      type:'GET',  
                      url:"<?php echo Yii::app()->createUrl('user/ajaxBathsBedChnage')?>",
           
                       data:{'serviceTypeId':serviceTypeId,'baths':baths},
                       success:function(result)
                       {
                           if(result!='')
                           {
                              $("#beds").html(result);
                              return true;                            
                           }
                           else
                           {
                             location.reload();
                           }
                                                
                       },
                       error: function (result) {
                           return false;
                      }
             });

         
                                 

     });



     // ajax call for baths chnage ends here

     // code to select the no of beds,baths etc


     $(".stepper-button-up").click(function(){
             var id=$(this).closest('.controlHolder').find("input[type='text']").attr('id');
      
             var val=$(this).closest('.controlHolder').find("input[type='text']").attr('value');
             /*if(id=='Cleaning_Bedrooms' || id=='Cleaning_Bathrooms' || id=='Cleaning_Desk')
             {
              if(val==10)
               return false; 
             } */
             if($("#"+id).val()!='')
             {
                var value = parseInt($("#"+id).val(), 10) + 1;
             }
             else
             {
                var value = 0;
             }
             
             $(this).closest('.controlHolder').find("input[type='text']").val(value);
                
    });

     $(".stepper-button-down").click(function(){

          var id=$(this).closest('.controlHolder').find("input[type='text']").attr('id');
      
             var val=$(this).closest('.controlHolder').find("input[type='text']").attr('value');
             if (val == 0)
             { 
              return false; 
             }
             else
             {
                var value = parseInt($("#"+id).val(), 10) - 1;
                $(this).closest('.controlHolder').find("input[type='text']").val(value);
             }  
     });


     


});
</script>

<style>
.stepper-button-up:before {
content: '+';
top: .05em;
}
.stepper-button-down:before {
content: '-';
}
textarea#Cleaning_AdditionalCustDetail {
margin: 0 12% 2%;
}
 #bookingForm textarea {
    float: left;
    height: 1%;
    overflow: auto;
    right: 0;
    width: 80%;
    margin-bottom:9px;
    left:0%;
    font-family: "ubuntu";
    font-size: 17px;
    color: grey;
    margin-top:1%;
}
h2{padding: 0 0 0 !important;}
button.minus
{
  background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
  border-color: #ccc -moz-use-text-color #ccc #ccc;
  border-image: none;
  border-radius: 5px 0 0 5px;
  border-style: solid none solid solid;
  border-width: 1px medium 1px 1px;
  cursor: pointer;
  display: inline-block;
  float: left;
  font-size: 20px;
  /*margin: 14% 0 3%;*/
  width: auto;
  height: 42px;
}
button.plus
{
  background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
  border-color: #ccc #ccc #ccc -moz-use-text-color;
  border-image: none;
  border-radius: 0 5px 5px 0;
  border-style: solid solid solid none;
  border-width: 1px 1px 1px medium;
  cursor: pointer;
  display: inline-block;
  /*float: right;*/
  font-size: 20px;
  height: 42px;
 /* margin: 31px 46px 4% 3px;*/
  width:auto;
}
.count1 {
    font-size: 0.5em !important;
}
</style>

<div class="title" id="service">
  <div class="wrap">
   <div class="save1">
   <a href="<?php echo Yii::app()->request->baseUrl; ?>/user/service" class="previous">Previous</a>
  <!-- <a href="#" class="save_quote">save quotes</a> -->
  </div>
    <h2>Our Cleaning Services</h2>
    
  </div>
  <div class="clear"> </div>
</div>
<div class="white" id="service">
<div class="wrap">
<div class="date_time">What do you want to clean?</div>
<p class="inclusive">We provide all the usual cleaning services. If you are looking for a regular home cleaning service, we will tailor it to ensure that rooms are given a deep clean on a rotational basis.</p>

<?php $form=$this->beginWidget('CActiveForm', array(
              'action'=> Yii::app()->createUrl('user/comparequotes'),
          'id'=>'bookingForm',
          'enableClientValidation'=>true,
          'clientOptions'=>array(
          'validateOnSubmit'=>true,

          ),
        )); ?>

<?php /*
<div class="container">
           <!-- <form id="bookingForm"> -->
                    
                    <div class="controlHolder">
                        <label class="tmDatepicker">
                            <!--<input type="text" placeholder="Property Size" name="Departure date" id="dp1409056714563" class="hasDatepicker"> -->
                             <?php foreach($values as $i=>$val) {  ?>
                              
                              <?php $prop[]=$val->property_size;

                                      $propRes=array_combine($prop,$prop);
                               ?>                             

                                <?php } ?>


                            <?php echo CHtml::dropDownList('property','',$propRes,array('empty' => 'Property Size','class'=>'same')); ?>  

                        </label>
                    </div>                 
                    <div class="controlHolder">
                         <div class="tmTextarea">
                          <!--<textarea placeholder="Bedrooms" name="Message" id="regula-generated-377271"></textarea> -->
                           
                           <?php foreach($values as $i=>$val) {  ?>
                              
                              <?php $beds[]=$val->no_of_beds;                                 
                                    $bedsRes=array_combine($beds,$beds);
                              ?>                             

                                <?php } ?>
                               
                              <?php echo CHtml::dropDownList('beds', '',$bedsRes,array('empty' => 'Bedrooms' ,'class'=>'same')); ?>
                        
                        </div>
                    </div>
                    <div class="controlHolder">
                        <div class="tmTextarea">
                             <!--<textarea placeholder="Bathrooms" name="Message" id="regula-generated-377271"></textarea> -->
                        
                              <?php foreach($values as $i=>$val) {  ?>
                              
                              <?php $baths[]=$val->no_of_baths;                                 
                                    $bathsRes=array_combine($baths,$baths); 
                              ?>                             

                                <?php } ?>
                               
                              <?php echo CHtml::dropDownList('baths', '',$bathsRes,array('empty' => 'Bathrooms','class'=>'m same')); ?>
                        


                        </div>
                    </div>
                    
                <!--</form> -->
        </div>  */ ?>
       
        <div class="container">
           <!-- <form id="bookingForm"> -->
           <div class="onediv">
                    <?php if($serName=='OFFICE CLEANING') { ?>
                    <div class="controlHolder">
                        <span class="types">Property Size(square feet)</span><br/>
                        <div class="btncss">
		                        <button class="stepper-button-down" data-direction="down" type="button"></button>
		                    
		                        <label class="tmDatepicker">
		                             <?php echo CHtml::textField('Cleaning[Property]','0',array('onkeyup'=>"this.value=this.value.replace(/[^\d]/,'')"));?>
		                 
		                        </label>
		                         <button class="stepper-button-up" data-direction="up" type="button"></button>
                         </div>  
                    </div> 

                    <div class="controlHolder">
                         <span class="types">No of Desk</span><br/>
                          <div class="btncss">
		                         <button class="stepper-button-down" data-direction="down" type="button"></button>
		                         
		                         <label class="tmDatepicker">
		                         
		                             <?php echo CHtml::textField('Cleaning[Desk]','0' ,array('min'=>0,'onkeyup'=>"this.value=this.value.replace(/[^\d]/,'')"));?>
		                            
		                        </label>
		                        <button class="stepper-button-up" data-direction="up" type="button"></button>
                        </div>
                    </div>

                    <!-- Extras ofc services starts here-->

                    <div class="controlHolder extra" >
                         <span class="types">No of Cupboards</span><br/>
                          <div class="btncss">
		                         <button class="stepper-button-down" data-direction="down" type="button"></button>
		                         
		                         <label class="tmDatepicker">                         
		                             <?php echo CHtml::textField('Cleaning[Cupboards]','0' ,array('min'=>0,'onkeyup'=>"this.value=this.value.replace(/[^\d]/,'')"));?>
		                         </label>
		                        <button class="stepper-button-up" data-direction="up" type="button"></button>
                        </div>
                    </div>

                    <div class="controlHolder extra">
                         <span class="types">No of kitchens</span><br/>
                          <div class="btncss">
		                         <button class="stepper-button-down" data-direction="down" type="button"></button>
		                         
		                         <label class="tmDatepicker">                         
		                             <?php echo CHtml::textField('Cleaning[Kitchen]','0' ,array('min'=>0,'onkeyup'=>"this.value=this.value.replace(/[^\d]/)"));?>
		                         </label>
		                        <button class="stepper-button-up" data-direction="up" type="button"></button>
                        </div>
                    </div>

                    <div class="controlHolder extra">
                         <span class="types">No of Staircases</span><br/>
                          <div class="btncss">
		                         <button class="stepper-button-down" data-direction="down" type="button"></button>
		                         
		                         <label class="tmDatepicker">                         
		                             <?php echo CHtml::textField('Cleaning[Staircases]','0' ,array('min'=>0,'onkeyup'=>"this.value=this.value.replace(/[^\d]/)"));?>
		                         </label>
		                        <button class="stepper-button-up" data-direction="up" type="button"></button>
                        </div>
                    </div>

                    <div class="controlHolder extra">
                         <span class="types">No of Elevator</span><br/>
                          <div class="btncss">
	                         <button class="stepper-button-down" data-direction="down" type="button"></button>
	                         
	                         <label class="tmDatepicker">                         
	                             <?php echo CHtml::textField('Cleaning[Elevator]','0' ,array('min'=>0,'onkeyup'=>"this.value=this.value.replace(/[^\d]/,'')"));?>
	                         </label>
	                        <button class="stepper-button-up" data-direction="up" type="button"></button>
                        </div> 
                    </div>
                    <!-- Extras ofc services ends here  --> 

                    <div class="controlHolder">
                         <span class="types">Bedrooms </span><br/>
                          <div class="btncss">
		                         <button class="stepper-button-down" data-direction="down" type="button"></button>
		                         
		                          <label class="tmDatepicker">
		                         
		                             <?php echo CHtml::textField('Cleaning[Bedrooms]','0' ,array('min'=>0,'onkeyup'=>"this.value=this.value.replace(/[^\d]/,'')"));?>
		                            
		                        </label>
		                        <button class="stepper-button-up" data-direction="up" type="button"></button>
                        </div>
                    </div>
                     
                    <div class="controlHolder">
                    <span class="types">Bathrooms</span><br/>
                       <div class="btncss">
		                    <button class="stepper-button-down" data-direction="down" type="button"></button>
		                        
		                         <label class="tmDatepicker">
		                            
		                             <?php echo CHtml::textField('Cleaning[Bathrooms]','0',array('min'=>0,'onkeyup'=>"this.value=this.value.replace(/[^\d]/,'')"));?>
		                 

		                        </label>
		                        <button class="stepper-button-up" data-direction="up" type="button"></button> 
                         </div>
                    </div>
                    <?php }  else { ?>

                          <div class="controlHolder">
                               <span class="types">Bedrooms</span><br/>
                                <div class="btncss">
		                               <button class="stepper-button-down" data-direction="down" type="button"></button>
		                               
		                                <label class="tmDatepicker">
		                               
		                                   <?php echo CHtml::textField('Cleaning[Bedrooms]','0' ,array('min'=>0,'onkeyup'=>"this.value=this.value.replace(/[^\d]/,'')"));?>
		                                  
		                              </label>
		                              <button class="stepper-button-up" data-direction="up" type="button"></button>
                              </div>  
                          </div>
                           
                          <div class="controlHolder">
                           <span class="types">Bathrooms</span><br/>
                                <div class="btncss">
			                          <button class="stepper-button-down" data-direction="down" type="button"></button>
			                              
			                               <label class="tmDatepicker">
			                                  
			                                   <?php echo CHtml::textField('Cleaning[Bathrooms]','0',array('min'=>0,'onkeyup'=>"this.value=this.value.replace(/[^\d]/,'')"));?>
			                       

			                              </label>
			                              <button class="stepper-button-up" data-direction="up" type="button"></button> 
                                </div>
                          </div>

                          <div class="controlHolder">
                            <span class="types">Living Rooms </span><br/>
                             <div class="btncss">
		                             <button class="stepper-button-down" data-direction="down" type="button"></button>
		                              <label class="tmDatepicker">
		                                  
		                                   <?php echo CHtml::textField('Cleaning[LivingRoom]','0',array('min'=>0,'onkeyup'=>"this.value=this.value.replace(/[^\d]/,'')"));?>
		                       

		                              </label>
		                              <button class="stepper-button-up" data-direction="up" type="button"></button> 
                              </div>
                          </div>

                          <div class="controlHolder">
                           <span class="types">Kitchen Staircases</span><br/>
                           <div class="btncss">
		                          <button class="stepper-button-down" data-direction="down" type="button"></button>
		                              
		                               <label class="tmDatepicker">
		                                  
		                                   <?php echo CHtml::textField('Cleaning[KitchenStaircases]','0',array('min'=>0,'onkeyup'=>"this.value=this.value.replace(/[^\d]/,'')"));?>
		                       

		                              </label>
		                              <button class="stepper-button-up" data-direction="up" type="button"></button> 
                             </div> 
                          </div>

                        <div class="controlHolder">
                              <span class="types">Carpets Interior Windows</span><br/>  
                           <div class="btncss">
		                          <button class="stepper-button-down" data-direction="down" type="button"></button>
		                              
		                               <label class="tmDatepicker">
		                                  
		                                   <?php echo CHtml::textField('Cleaning[CarpetsInteriorWindows]','0',array('min'=>0,'onkeyup'=>"this.value=this.value.replace(/[^\d]/,'')"));?>
		                       

		                              </label>
		                              <button class="stepper-button-up" data-direction="up" type="button"></button> 
                            </div>
                          </div>

                    <?php } 
                    
               			/*
					$options = array ('1.0' => '1 hour','2.0' => '2 hours','3.0' => '3 hours', '4.0'=>'4 hours','5.0' => '5 hours','6.0' => '6 hours','7.0' => '7 hours');
                          echo CHtml::dropDownList('CleaningTime[noOfhour]', '12', $options,array('options'=>array(isset($cleanDetails['CleaningTime']['noOfhour']) ? $cleanDetails['CleaningTime']['noOfhour'] : ''=>array('selected'=>'selected'))));
                         */
                         ?>
                         
                          <!--</form> -->
                </div>
                <!--<br/>
                <div>
                	<?php foreach($serviceDetails as $serviceDetail);echo  $serviceDetail->desc; ?>
                </div>
                <br/>-->
                 <div class="adnlDetails">
                           <div class="head"> <h2>Additional Details</h2></div>
                            <div class="textarea">
                             <?php echo CHtml::textArea('AdditionalCustDetail[AdditionalCustDetail]',' ',array('rows' => 6, 'cols' => 50));?>
                              <div class="clear"></div> 
                            <input type="button" class="compare" value="compare Quotes">
                            <div id="detailAd"></div>
                            </div>

                  </div>
        </div>
        
     <?php if(!empty($adnlService)) { ?>  
    <!--  <div class="adnlDetails">
                           <div class="headadnl"> <h2>Additional Details</h2></div>
                            <div class="textarea">
                             <?php //echo CHtml::textArea('AdditionalCustDetail[AdditionalCustDetail]',' ',array('rows' => 6, 'cols' => 50));?>
                              <div class="clear"></div> 
                            <input type="button" class="compare" value="compare Quotes">
                            </div>
                  </div> -->
     <div class="aditional">
          
            <h2>Aditional Services</h2>
            <ul class="extra">
                   <?php 
                         /* if($serName!='DOMESTIC CLEANING')
                         {
                                                      

                          foreach($adnlService as $i=>$service) {
                             
                                
                                    if($service->service_name == 'Ironing service')
                                    {
                                          
                                       unset($service->service_name);
                                      
                                    }                                   
                                   
                    ?>
                    <li class="<?php echo $service->service_name; ?> " id="<?php echo $service->id; ?>">
                        <button type="button" data-direction="down" class="minus">-</button>   <button type="button" data-direction="up" class="plus">+</button>
                      
                        <input type="text" class="regular-checkbox big-checkbox count1" id="checkbox-2-1 <?php echo $service->id;?>" name="Additional[<?php echo $service->service_name;?>]" value="0" >
                      
                       <label for="checkbox-2-1 <?php echo $service->id;?>" id="" class="count">   <?php echo $service->service_name;?>  </label> 
                         <div class="incre"></div>

                    </li>
                    <?php }  }    else {  ?>
                         
                          <?php foreach($adnlService as $service) { ?>

                          <li>
                        <button type="button" data-direction="down" class="minus">-</button>   <button type="button" data-direction="up" class="plus">+</button>
                      
                        <input type="text" class="regular-checkbox big-checkbox count1" id="checkbox-2-1 <?php echo $service->id;?>" name="Additional[<?php echo $service->service_name;?>]" value="0" >
                      
                       <label for="checkbox-2-1 <?php echo $service->id;?>" id="" class="count">   <?php echo $service->service_name;?>  </label> 
                         <div class="incre"></div>

                    </li>
                    <?php } ?>
               
                    <?php } */?>
                     
                      <?php foreach($adnlService as $service) { 

                             //echo "<pre>";print_r($service);
                        ?>
                          
                          <li>
                             <span class="mk"><?php echo $service->additional_service_name;?></span> <br/>
                              <div class="btncss">
                              <button type="button" data-direction="down" class="minus">-</button>  
                              <button type="button" data-direction="up" class="plus">+</button>
                              <!--<input type="text" class="regular-checkbox big-checkbox count1" id="checkbox-2-1 <?php //echo $service->id;?>" name="Additional[<?php //echo $service->id;?>]" value="0" >
                              -->
                                   
                                 <?php echo CHtml::textField('Additional['.$service->id.']','0',array('class'=>'count1','onkeyup'=>"this.value=this.value.replace(/[^\d]/,'')"));?>
                                 <label for="checkbox-2-1 <?php echo $service->id;?>" id="" class="count">  
                                  <?php //echo $service->additional_service_name;?>  
                                     <div class="incre" style="display:none"></div>
                                  </label> 
                                 </div> 
                               <!--<button type="button" data-direction="up" class="plus">+</button> -->
                               <!--<div class="incre"></div>-->

                        </li>
                    <?php } ?>

                    </ul>
                     

                  </div> 

             <!--
                  <div class="adnlDetails">
                           <div class="head"> <h2>Additional Details</h2></div>
                            <div class="textarea">
                             <?php //echo CHtml::textArea('AdditionalCustDetail[AdditionalCustDetail]',' ',array('rows' => 6, 'cols' => 50));?>
                              <div class="clear"></div> 
                            <input type="button" class="compare" value="compare Quotes">
                            </div>
                  </div>  -->
                <?php } /*else { ?>
              

                 <div class="adnlDetails" >
                          <div class="head"> <h2>Additional Details</h2></div>
                               <div class="textarea">
                               <?php echo CHtml::textArea('AdditionalCustDetail[AdditionalCustDetail]',' ',array('rows' => 6, 'cols' => 50));?>
                                <div class="clear"></div> 
                              <input type="button" class="compare" value="compare Quotes">
                              </div>
                  </div>


                <?php } */?>

   <?php $this->endWidget(); ?>
</div>
  <div class="clear"> </div>
</div>
</div>
