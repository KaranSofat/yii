<!--Job Requests from customer starts here -->
        <?php 
              // echo "<pre>";print_r($companyRequest);die;
        foreach($companyRequest as $companyRequest) { ?>
        <div id="request" class="req<?php echo $companyRequest['id'];?>">
          <div class="active_left">
            <div class="left-1"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/banner/<?php echo $companyRequest->booking->serviceType['image']; ?>" alt=""> </div>
            <div class="right-2">
              <h4> <?php echo $companyRequest->booking->customer['cname']." ".$companyRequest->booking->customer['clname']?> </h4>
              <p><?php echo $companyRequest->service['city'];?> to <?php echo $companyRequest->booking->customerAddress['address'];?></p>
             <!-- <p><span>254 miles</span></p> -->
            </div>
          </div>
          <div class="active_left active_right">
            
            <div class="right-02">
               <p class="quote">
              
                  <?php if(empty($companyRequest->booking->additionalParticularPrices) && empty($companyRequest->booking->particularPrices))  { ?>
                   <a href="javascript:void(0)">
                      <span class="ng-binding">£<?php echo $companyRequest->booking['price'];?></span>
                   </a>
                  <?php } else {  

                           if(!empty($companyRequest->booking->additionalParticularPrices)) {
                         foreach(array_slice($companyRequest->booking->additionalParticularPrices,0,1) as $total)
                         {
                         	   $tot=$total['total_price'];
                        	
                         //echo "<pre>";print_r($tot);die;
                          
                          //echo "<pre>";print_r($companyRequest->booking->particularPrices[0]['particular_price']);die;
                  	?>
                            
                                 <a href="#">
                                     <span class="ng-binding">£<?php echo $tot; ?></span>
                                </a>
                              
                              
                                         
                                

                   <?php }  } else { ?>
                            <a href="#">
                                              <span class="ng-binding">£<?php echo $companyRequest->booking->particularPrices[0]['particular_price'];?></span>
                                         </a>
                   <?php } } ?>
               </p>
              <span class=""><?php //echo $companyRequest['cleaningtime'];?></span>
              <span class=""><?php //echo date('y-m-d',strtotime($companyRequest['cleaningdate']));?></span> 
              <!--<a class="login_in greenbtn MsgDetail" id="<?php //echo $companyRequest->booking['id'];?>" href="javascript:void(0)">Message</a>
               -->
              <a class="login_in greenbtn accept" href="javascript:void(0)" id="<?php echo $companyRequest['id'] ?>">Accept</a>
              <a class="login_in greenbtn decline" href="javascript:void(0)" id="<?php echo $companyRequest['id'] ?>">Decline</a> 
             <!-- <a class="login_in greenbtn viewQuotes" id="<?php //echo $companyRequest['id'];?>" href="<?php //echo Yii::app()->createUrl('registration/registration/chnagequotesDashboardSpeciUser',array('id'=>$companyRequest['id'],'booking_id'=>$companyRequest->booking['id']))?>">View Quotes</a>
              -->
              <input type ="hidden" name="bookingid" value="<?php echo $companyRequest['booking_id'];?>" class="msgbooklst<?php echo $companyRequest['id'];?>" id="<?php echo $companyRequest['booking_id'];?>">
              <a class="login_in greenbtn  jobsReq" id="<?php echo $companyRequest['id'];?>" href="javascript:void(0)">View Quotes</a>
                
              </div>
               
          </div>
            <div class="request" id="reqjob<?php echo $companyRequest['id'];?>" style="display:none;">  </div>

             <div id="msgrender<?php echo $companyRequest->booking['id'];?>" class="masgrender">
                               </div> 
            

        </div>
         
         
      
        <?php } ?>