
		<script>
		
		function notAnswer()
		{
		
		alert("you have to login to answer this question")
		}
		
		function answer()
		{
		//alert(document.URL);
		
    var res = document.URL.split("http://localhost/mysite/index.php/front/front/questionDetail/"); 
    var qId =  res[1];
		
		  var value = $("#answerValue").val(); 
		  $.ajax({
               	url : '<?php echo Yii::app()->request->baseUrl; ?>/index.php/front/front/answer',
                type:'POST',
                data:{value:value,qId:qId},
                dataType:'html',   
                success:function(data){
              //  alert(data);
			            $("#result").html(data);
                location.reload(); 
               
                            }
            });
		 
		 
		}
		function votes(voteType)
		{
		
		  var  id = $("#userId").val();
		
		  
		  var res = document.URL.split("http://localhost/mysite/index.php/front/front/questionDetail/"); 
      var qId =  res[1];
		 
		  $.ajax({
               	url : '<?php echo Yii::app()->request->baseUrl; ?>/index.php/front/front/votes',
                type:'POST',
                data:{id:id,qId:qId,voteType:voteType},
                dataType:'html',   
                success:function(data){
                
                alert(data);
			          location.reload(); 
            
                            }
            });
		
		}
		
		</script>
		
		
		
		<?php foreach ($questionDetail as $questions) { ?>
		
<div class="portlet light">
						<div class="portlet-title">
							<div class="caption font-purple-plum" style="width:100% !important;">
								
						<form>
								<img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/up.png" style="width:30px;float: left;" onclick="votes('like')">
								<br>
								<div class="well" style="float: left;
    margin: 17px 0 0 -35px;">
								
									<address>
									<strong><?php echo $like ?></strong>
									</address>
								</div>
								
								
								 
   	<input type="hidden" value="<?php echo $questions['id'] ?>" id="userId">

   	
								<span class="caption-subject bold uppercase" style="float: left;
    margin-left: 15px;
    width: 84%;text-align: center;"> <?php echo $questions['title'] ?></span>
								
							
								
								 <img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/down.png" style="width:30px;float:right;margin: -17px 0 0;" onclick="votes('dislike')">	
								 <br>
								<div class="well" style="float:right; margin-left:42px;">
								
									<address>
									<strong><?php echo $dislike ?></strong>
									</address>
								</div>
								
								</form>
							</div>
						
						</div>
						<div class="portlet-body">
							<div id="context" data-toggle="context" data-target="#context-menu">
								<p>
									 <?php echo $questions['question'] ?>
								</p>
								<p style="float:right;font-weight:bold;">asked by: <?php echo $questions['name'] ?></p><br>
								
								
									<p style="float:right; margin: 0 -104px 14px 21px;"><?php echo $questions['creation_Datetime'] ?></p>
								
								
							</div>
							<p style="margin-top:10px; font-size:18px;">Answers</p>
							<hr>
							
							<div id="result"></div>
							<?php foreach($answers as $myanswer) { ?>
						<div class="well">
									<address>
								<?php echo $myanswer['answer'] ?>
								 </address>
									<address>
									<strong><?php echo $myanswer['name'] ?></strong><br>
									<a href="mailto:#">
							<?php echo $myanswer['creation_Datetime'] ?> </a>
									</address>
								</div>
							
							<?php } ?>
							
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="" id="form_sample_3" class="form-horizontal" method="post">
								<div class="form-body">
								
									<div class="alert alert-danger display-hide">
										<button class="close" data-close="alert"></button>
										You have some form errors. Please check below.
									</div>
									<div class="alert alert-success display-hide">
										<button class="close" data-close="alert"></button>
										Your form validation is successful!
									</div>
									
									
									<div class="form-group last">
										<label class="control-label col-md-3" style="font-size:18px; !important;font-weight:bold;">Your Answer <span class="required">
										</span>
										</label>
										<div class="col-md-9">
											<textarea class="" id="answerValue" name="question" rows="6" style="width:100%;"></textarea>
											
											
											<div id="editor2_error">
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
									
									<?php if(Yii::app()->session['userId'] == "") { ?>
									<div class="col-md-offset-3 col-md-9">
											<button type="button" class="btn green" onclick="notAnswer()">Post Your Answer</button>
										
										</div>
									
									<?php } else { ?>
									
								
										<div class="col-md-offset-3 col-md-9">
											<button type="button" class="btn green" onclick="answer()">Post Your Answer</button>
					<?php } ?>
										</div>
									</div>
								</div>
							</form>
							<!-- END FORM-->
						</div>
							
						</div>
					</div>
					
					<?php } ?>
					
					<style>
					.col-md-9
					{
					  width:100%; !important;
					
					}
					.col-md-3 {
        width: auto !important;
}
					</style>
					
