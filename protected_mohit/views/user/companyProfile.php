<div class="profile_outer">
  <div class="detail_outer"> 
    <!-- <h4> Detail </h4> -->
    <div class="clear"> </div>
    <div class="detail_m">
      <h4>Profile</h4>
      <div class="detail_in">
        <div class="logo_img"> 
        <a href="#">

        <?php if(!empty($compDetail->company_logo)) { ?> 
                          <img src="<?php echo Yii::app()->request->baseUrl; ?>/banner/<?php echo $compDetail->company_logo;?>" width="90px" alt="certified">
                   
                   <?php } else { ?>
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/banner/download.jpg" width= "90px" alt="certified">
                   

                   <?php }?>  


         </a>
          <div class="star">
            <ul>
              <li><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/star-1.png" alt=""></a></li>
              <li><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/star-1.png" alt=""></a></li>
              <li><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/star-1.png" alt=""></a></li>
              <li><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/star-1.png" alt=""></a></li>
              <li><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/star-4.png" alt=""></a></li>
            </ul>
          </div></div>
          <div class="profile_col">
            <div class="d_col">
              <h4> ZipCode :</h4>
              <h5><?php  echo $compDetail->zipcode;?></h5>
            </div>
            <div class="d_col">
              <h4> City :</h4>
              <h5><?php  echo $compDetail->city;?></h5>
            </div>
            <div class="d_col">
              <h4> Jobs :</h4>
              <h5><?php  echo $compDetail->jobsdone;?></h5>
            </div>
            <div class="d_col">
              <h4> Email :</h4>
              <h5><?php echo $compDetail->email;?></h5>
            </div>
           
          </div>
        </div>
        <div class="clear"> </div>
        <h4> Recent reviews </h4>
        <div class="gallery">
          <div class="gallery_in">
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when <span> <a href="#">Lorem Ipsum </a></span> </p>
          </div>
          <div class="gallery_in">
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when <span> <a href="#">Lorem Ipsum </a></span> </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="clear"> </div>