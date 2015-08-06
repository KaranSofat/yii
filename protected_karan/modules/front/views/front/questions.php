
<!--<?php
foreach($questions as $totalQuestion)
{
?>

<?php echo $totalQuestion['name'] ?>


<?php
}
?>-->

<div class="portlet-body" style="background:white !important; margin-bottom:10px;">
							<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 305px;"><div data-handle-color="#D7DCE2" data-rail-visible1="0" data-always-visible="1" style="height: 305px; overflow: hidden; width: auto;" class="scroller" data-initialized="1">
								<div class="general-item-list" style="margin: 6px 0 0 53px !important;">
								<?php
foreach($questions as $totalQuestion)
{
?>
									<div class="item">
										<div class="item-head">
											<div class="item-details">
										
												<img src="<?php echo Yii::app()->request->baseUrl; ?>/upload/<?php echo $totalQuestion['image'];?>" class="item-pic">
												<a class="item-name primary-link" href=""><?php echo $totalQuestion['name'] ?></a>
												<span class="item-label"> <?php echo $totalQuestion['creation_Datetime']  ?></span>
								<!--<?php	echo Yii::app()->format->date(strtotime($totalQuestion['creation_Datetime']));?>-->
						
												
											</div>
											<span class="item-status"><span class="badge badge-empty badge-success"></span> Open</span>
										</div>
										<div class="item-body">
										
										<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/front/front/questionDetail/<?php echo $totalQuestion['question_id'] ?>"><?php echo $totalQuestion['title'] ?></a>
										</div>
										<div>
										<p>Answers:<?php echo  $totalQuestion['totalAnswers'] ?></p>
										</div>
										
									</div>
								<?php
}
?>
								</div>
							</div><div class="slimScrollBar" style="background: rgb(215, 220, 226) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 122.401px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div></div>
						</div>
