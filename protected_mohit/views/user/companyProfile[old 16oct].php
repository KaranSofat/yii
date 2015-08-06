
  <!-- services page start here -->
  <div class="profile_outer">
    
    <div class="detail_outer">
     <!-- <h4> Detail </h4> -->
      <div class="clear"> </div>
      <div class="profile_logo">
    <?php if(!empty($compDetail->company_logo)) { ?> 
                          <img src="<?php echo Yii::app()->request->baseUrl; ?>/banner/<?php echo $compDetail->company_logo;?>" width="90px" alt="certified">
                   
                   <?php } else { ?>
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/banner/download.jpg" width= "90px" alt="certified">
                   

                   <?php }?> 
     </div>
      <div class="detail_m">
        <div class="detail_in">
          <div class="d_col">
          <h4> Zip :</h4><h5><?php  echo $compDetail->zipcode;?></h5> </div>
           <div class="d_col col_right">
          <h4> City :</h4><h5><?php echo $compDetail->city;?></h5> </div>
           <div class="d_col">
          <h4> Jobs :</h4><h5><?php echo $compDetail->jobsdone;?></h5> </div>
           <div class="d_col col_right">
          <h4> Email :</h4><h5></h5><?php echo $compDetail->email;?> </div>
          
             
          
        </div>
        
      </div>
      <div class="clear"> </div>
      
      
      <h4> Review </h4>
     <div class="gallery">
        <div class="gallery_in">
      <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when <span> <a href="#">Lorem Ipsum </a></span> </p>
        </div>
        <div class="gallery_in">
      <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when <span> <a href="#">Lorem Ipsum </a></span> </p>
        </div>
                
     
    </div>
  </div>
</div></div>
<div class="clear"> </div>
