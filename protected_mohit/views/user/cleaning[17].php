<script>
$(document).ready(function(){

     $(".compare").click(function(){
      //  document.getElementById("bookingForm").submit();
         var property=$("#property").val();
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

});
</script>
<div class="title" id="service">
  <div class="wrap">
    <h2>Our Cleaning Services</h2>
    
  </div>
  <div class="clear"> </div>
</div>
<div class="white" id="service">
<div class="wrap">
<div class="date_time">What do you want to clean?</div>
<p class="inclusive">We provide all the usual cleaning services. If you are looking for a regular home cleaning service, we will tailor it to ensure that rooms are given a deep clean on a rotational basis.</p>

<?php $form=$this->beginWidget('CActiveForm', array(
              'action'=> Yii::app()->createUrl('user/comparequote'),
          'id'=>'bookingForm',
          'enableClientValidation'=>true,
          'clientOptions'=>array(
          'validateOnSubmit'=>true,

          ),
        )); ?>

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
        </div>
        <?php $this->endWidget(); ?>
<div class="aditional">
<h2>Aditional Services</h2>
<ul class="extra">
        <li><input type="checkbox" class="regular-checkbox big-checkbox" id="checkbox-2-1"><label for="checkbox-2-1">fridge </label></li>
    <li><input type="checkbox" class="regular-checkbox big-checkbox" id="checkbox-2-2"><label for="checkbox-2-2">Dishwasher</label></li>
    <li><input type="checkbox" class="regular-checkbox big-checkbox" id="checkbox-2-3"><label for="checkbox-2-3">Washing Machine</label></li>
    <li><input type="checkbox" class="regular-checkbox big-checkbox" id="checkbox-2-4"><label for="checkbox-2-4">Oven</label></li>
        <li><input type="checkbox" class="regular-checkbox big-checkbox" id="checkbox-2-5"><label for="checkbox-2-5">Window</label></li>
         <li><input type="checkbox" class="regular-checkbox big-checkbox" id="checkbox-2-6"><label for="checkbox-2-6">Ironing service</label></li>
          <li><input type="checkbox" class="regular-checkbox big-checkbox" id="checkbox-2-7"><label for="checkbox-2-7">Carpets</label></li>
         <li><input type="checkbox" class="regular-checkbox big-checkbox" id="checkbox-2-8"><label for="checkbox-2-8">Kitchen</label></li>
        </ul>
        <input type="button" class="compare" value="compare Quotes">
        </div>

</div>
  <div class="clear"> </div>
</div>
</div>