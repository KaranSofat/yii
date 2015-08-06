<script type="text/javascript">
/*code to filter the result on the basis of miles*/
$(document).ready(function(){
  
       $(".milesrange").change(function(){
        
        var mile=$(this).val();        
        
         //alert(mile)
              $.ajax({
                             type:'GET',  
                            url:"<?php echo Yii::app()->createUrl('user/SerachMiles')?>",
                            
                            data:{'mile':mile},
                             success:function(result)
                             {
                                
                               //alert(result);
                               ajaxindicatorstart('loading data.. please wait..');
                               ajaxindicatorstop();
                                    $("#filter").html(result);
                                //alert(result);
                                //location.reload()
                                //return true;
                               //alert(result);
                             
                             },
                             error: function (result) {
                             // alert("Error.")
                                
                                  return false;
                            }
                       }); 
           });


           $('a.popper').hover(function(){
            
            var id=$(this).attr('id');
            
            $.ajax({
                             type:'GET',  
                            url:"<?php echo Yii::app()->createUrl('user/AjaxPopUpDetailCompany')?>",
           
                            data:{'id':id},
                             success:function(result)
                             {
                                 
                                //alert(result);
                                $(".popbox").fadeIn('fast').html(result);
                               // $('.popbox').html(result);
                                 
                                return true;
                                                            
                             },
                             error: function (result) {
                             // alert("Error.")
                            
                                  return false;
                            }
                       });    

        },function(){ $(".popbox").fadeOut('fast');});   
});


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
       jQuery('#resultLoading').fadeIn(1000);
    jQuery('body').css('cursor', 'wait');
}

function ajaxindicatorstop()
{
    jQuery('#resultLoading .bg').height('100%');
       jQuery('#resultLoading').fadeOut(1600);
    jQuery('body').css('cursor', 'default');
}
</script>
 
  <label>Serach With in miles</label>
     <?php 
              $options = array ('5' => '5 Miles','6' => '6 Miles','7' => '7 Miles', '8' => '8 Miles','9'=>'9 Miles','10' => '10 Miles','11' => '11 Miles','12' => '12 Miles','13' => '13 Miles','14' => '14 Miles','15' => '15 Miles','20'=>'20 Miles');
              echo CHtml::dropDownList('Miles', ' ', $options,array('class'=>'milesrange','options'=>array($d=>array('selected'=>'selected'))));
             // echo $form->dropDownList($model,'noofhour',$options); 
        ?>  
    <!--<div class="cleaners"> -->
        
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
          <div class="row_outer">
           <h4 style="text-align:center;margin-top:5px;"> No Result Found</h4>
          </div>
      
           




  
   