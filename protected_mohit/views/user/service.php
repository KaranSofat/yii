<script>
$(document).ready(function(){

     $(".gmg").click(function(){

          var val=$(this).text();

          $("#type").val(val);

     });
     
});
</script>

<div class="title" id="service">
  <div class="wrap">
    <div class="save1">
   <a href="<?php echo Yii::app()->request->baseUrl; ?>/user/index" class="previous">Previous</a>
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
<div class="type_service">
<ul>
       <?php foreach($servicetype as $ser) { ?>  
        <li>
                     <div class="image_cleaning">
                      <a href="<?php echo Yii::app()->createUrl('/user/cleaning',array('typeId'=>$ser->id))?>" class="tenancy gmg">
                
                         <?php if(!empty($ser->image)) { ?>
                         
                          <img src="<?php echo Yii::app()->request->baseUrl; ?>/banner/<?php echo $ser->image;?>" alt="<?php echo $ser->image;?>">
            
                          <?php } else { ?>
                          <img src="<?php echo Yii::app()->request->baseUrl; ?>/banner/download.jpg" alt="<?php echo $ser->image;?>">
                           <?php } ?>   
                            </a>    
                            
                      </div>

            
           
            <a href="<?php echo Yii::app()->createUrl('/user/cleaning',array('typeId'=>$ser->id))?>" class="tenancy gmg"><?php echo $ser->service_name;?></a><div style="min-height: 220px; padding: 10px;"><?php echo $ser->desc;?></div>
        </li>

     <?php } ?>
       <!-- <li>
            <div class="image_cleaning">
            <img src="<?php //echo Yii::app()->request->baseUrl; ?>/images/home.png" alt="Domestic Cleaning">
            </div>
            <a href="<?php //echo Yii::app()->createUrl('/user/cleaning',array('typeId'=>'2'))?>" class="domestic gmg">Domestic cleaning</a>
        </li>
        <li>
            <div class="image_cleaning">
            <img src="<?php //echo Yii::app()->request->baseUrl; ?>/images/office.png" alt="Office Cleaning">
            </div>
            <a href="javascript:void(0)" class="office gmg">Office cleaning</a>
        </li> -->
        <input type="hidden" name="typeOfCleaning" value=" " id="type">
  </ul>
</div>
</div>
  <div class="clear"> </div>
</div>
</div>
