<html>
<head>
</head>
<body>

<p>Dear Company <?php echo ucfirst($model->company_name);?> <?php //echo $model->email; ?>> welcome to Wow Cleans,</p>

<p>WowCleans is the most integrated platform for cleaning. 
It combines long Cleaning Experience companies 
to provide end-to-end Services for planning.</p>


<p>You have sucessfully booked customer <b><?php echo $cust['PaymentCustomerUser']['cname']; ?></b></p>

<p><b>Your booking Details are as follow:</b></p>
<?php foreach($detail['Cleaning'] as $k=>$v) { ?>
      
      <p><?php echo $k;?> : <?php echo $v;?></p>

<?php }?>

<?php foreach($adnl as $key=>$val) { 

         if($val!=0)
         {	
 ?>
      
      <p><?php echo $key;?> : <?php echo $val;?></p>

<?php } 
     }
?>
<p>Price:<?php echo $price;?></p>
<p>Transaction Id:<?php echo $trans;?></p>
<p>E-Mail......: info@wowCleans.com<br />
Telephone...: 123456<br />
Skype.......: wowCleans</p>

<p>We would like to welcome you aboard to Navigate your Experience and we wish you fair winds and new discoveries!</p>

<p>The wowCleans.com team</p>


</body>
</html>
