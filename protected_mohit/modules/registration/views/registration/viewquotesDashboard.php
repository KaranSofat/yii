<div class="title" id="service">
  <div class="wrap">
    <h2>View Quotes:<?php echo $bookingRec->customer['cname']."".$bookingRec->customer['clname'];?></h2>
  </div></div>
  
  
  <div class="clear"> </div>
  <div class="wrap">
  <div class="about_in">

  <p >ServiceType:<?php echo $bookingRec->serviceType['service_name'];?></p>
  <p >Address:    <?php echo $bookingRec->customerAddress['address'];?></p>
  <p >Price:      <?php echo $bookingRec['price'];?></p>
  <p >Time:       <?php echo $bookingRec->companyRequests['cleaningtime'];?></p>
  <p>

        <?php 
            $res=$bookingRec['cleaningDetail'];

            $r=explode(",",$res);

            foreach($r as $result)
            {
            	 $val=explode("-",$result);
            		
	            	 $no=$val[0];
	            	 $name=$val[1];
	             if(!empty($res))
	            { 
	            	 echo "</br>".$name." : ".$no."</br>";
            	}
            } 	//echo "<pre>";print_r($final);die;
       ?>

  </p>
  <p>
          <?php 
            $res1=$bookingRec['additional'];

            $r2=explode(",",$res1);

            foreach($r2 as $resul)
            {
            	 $val1=explode("-",$resul);
            	 
	            	 $n=$val1[0];
	            	 $nam=$val1[1];
	                if(!empty($res1))
	            	 {  

	            	    echo "</br>".$nam." : ".$n."</br>";
            	     }
            } 	//echo "<pre>";print_r($final);die;
       ?>
  </p>
  </div></div>
</div>

</div>