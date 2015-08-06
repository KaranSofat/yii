<script type="text/javascript">
/*code to filter the result on the basis of miles*/
$(document).ready(function(){
  
       $(".milesrange").change(function(){
        ajaxindicatorstart('loading data.. please wait..');
        var mile=$(this).val();        
        
         //alert(mile)
              $.ajax({
                             type:'GET',  
                            url:"<?php echo Yii::app()->createUrl('user/SerachMiles')?>",
                            
                            data:{'mile':mile},
                             success:function(result)
                             {
                                
                               //alert(result);
                               //ajaxindicatorstart('loading data.. please wait..');
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
            var pos = $("#map"+id).position().top;
            $.ajax({
                             type:'GET',  
                            url:"<?php echo Yii::app()->createUrl('user/AjaxPopUpDetailCompany')?>",
           
                            data:{'id':id},
                             success:function(result)
                             {
                                 
                                //alert(result);
                                $(".popbox").fadeIn('fast').html(result);
                               // $('.popbox').html(result);
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
 
});
*/
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
      <?php 
           //echo $d;
            if(!empty($CompanyName))
            {
              
               
       foreach($CompanyName as $distance=>$name) { 
              $res=explode("+",$name);
              
              //echo "<pre>";print_r($res);
             if($distance <= $d)
             {
        ?>
      <div class="row_outer" id="map<?php echo $res[1];?>">
        <div class="col1">
         <div class="row">
           <!-- 
            <a href="<?php //echo Yii::app()->request->baseUrl; ?>/user/companyProfile/<?php //echo $res[1];?>" class="popper" data-popbox="pop1" id="<?php echo $res[1];?>">
                <h4><?php //echo ucfirst($res[0]);?></h4>
            </a> -->
            <a href="javascript:void(0)" class="popper" data-popbox="pop1" id="<?php echo $res[1];?>">
                <h4><?php echo ucfirst($res[0]);?></h4>
            </a>
            
            <p> <?php echo round($distance,2);?> Mile from your pick-up address</p>
          

          </div>
        </div>
        <div class="col2">
          <div class="row"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/certified.png" alt="certified"></div>
        </div>
       <?php 
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
          
       
        
        <?php foreach($sums as $key=>$s) { 
                 
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
          
          <?php  } }  ?> 
          
              </div>
      </div>
      <?php } } }  else { ?>
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
      
           
      <?php }?>


      <!--Code for pop on hover the company starts here -->
     <div id="pop1" class="popbox">
        
      </div>
   
   <!-- </div> -->
  
   