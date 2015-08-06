<html>
<head>
</head>
<body>

<p>Dear <?php echo $model->service['company_name']; ?> </p>

<p>Quotes has been chnaged for  Customer: <?php echo $model->customer['cname']."".$model->customer['clname']?></p>

<?php //echo "<pre>";print_r($model->companyRequests);?>

<p>Cleaning Time: <?php echo $model->companyRequests[0]['cleaningtime'];?></p>
<p>Cleaning Date: <?php echo date('Y/m/d',strtotime($model->companyRequests[0]['cleaningdate']));?></p>

<p>
<?php 
            $res=$model['cleaningDetail'];

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

        <?php 
            $res1=$model['additional'];

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





<p>E-Mail......: info@wowCleans.com<br />
Telephone...: 123456<br />
Skype.......: wowCleans</p>

<p>We would like to welcome you aboard to Navigate your Experience and we wish you fair winds and new discoveries!</p>

<p>The wowCleans.com team</p>


</body>
</html>
