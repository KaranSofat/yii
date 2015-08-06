<div class="title" id="service">
      <div class="wrap">
        <h2>Thank You : <?php echo $detail->customer['cname']." ".$detail->customer['clname']?></h2>
      </div>
  </div>
  
  
 <!-- <div class="clear"> </div> -->
  <div class="wrap">
  <div class="about_in">
       <div class="alldvs">
        <div class="infothanks">You have succesfully booked the company:<?php echo $detail->service['company_name'];?></div>  <b><?php //echo $detail->service['company_name'];?></b>
 
      <div class="thankpayment">
      <div class="infothanks"> Your Booking Details are as follow:</div>

      <?php 
            $res=$detail['cleaningDetail'];

            $r=explode(",",$res);

            foreach($r as $result)
            {
            	 $val=explode("-",$result);
            		
	            	 $no=$val[0];
	            	 $name=$val[1];
	             if(!empty($res))
	            { 
                 echo "<div class='labelname'>"; 
	            	     //echo "</br>".$name." : ".$no."</br>";
                       echo "<div class='setwdth'>"; 
                            echo $name ." : ";
                       echo "</div>";
                       
                       echo  "<div class='setval'>";
                              echo $no; 
                       echo  "</div>";


                 echo "</div>";
            	}
            } 	//echo "<pre>";print_r($final);die;
       ?>

        <?php 
            $res1=$detail['additional'];

            $r2=explode(",",$res1);

            foreach($r2 as $resul)
            {
            	 $val1=explode("-",$resul);
            	 
	            	 $n=$val1[0];
	            	 $nam=$val1[1];
	                if(!empty($res1))
	            	 {  
                       echo "<div class='labelname'>";
                       echo "<div class='setwdth'>"; 
                            echo $nam ." : ";
                       echo "</div>";
                         echo  "<div class='setval'>";
                              echo $n; 
                       echo  "</div>";
	            	             //echo "</br>".$nam." : ".$n."</br>";
                       echo "</div>";   
            	   }
            } 	//echo "<pre>";print_r($final);die;
       ?>
       <div class='labelname'> 
               <div class='setwdth'>
                   <b>Transaction Id:</b>
               </div>
              <div class='setval'>
                <?php echo $detail['trans_id']; ?>
              </div>  
       </div>
        
  </div>
 
   </div>
  </div>

  </div>

</div>

</div> 