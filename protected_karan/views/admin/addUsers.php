<section>
			
			<div class="g12">
			<h1>Add User</h1>
			
				<form id="form" action="<?php echo Yii::app()->request->baseUrl; ?>/index.php/admin/addData" method="POST" autocomplete="off" enctype="multipart/form-data">
					<fieldset>
			
						<section><label for="text_tooltip">Name</label>
							<div><input type="text" id="text_tooltip" name="name" title="A Tooltip">
							<span>Just specify a title attribut to get a Tooltip</span>
							</div>
						</section>
						<section><label for="text_tooltip">Email</label>
							<div><input type="text" id="text_placeholder" name="email" placeholder="your placeholder text">
							<span>use the placeholder attribute <code>placeholder="your placeholder text"</code></span>
							</div>
						</section>
						<section><label for="textarea">State</label>
							<div><textarea id="textarea" name="state" rows="10"></textarea></div>
						</section>
						
						<section><label for="text_tooltip">City</label>
							<div><input type="text" id="text_placeholder" name="city" placeholder="your placeholder text">
							<span>use the placeholder attribute <code>placeholder="your placeholder text"</code></span>
							</div>
						</section>
						<section><label for="text_tooltip">Password</label>
							<div><input type="text" id="text_placeholder" name="password" placeholder="your placeholder text">
							<span>use the placeholder attribute <code>placeholder="your placeholder text"</code></span>
							</div>
						</section>
							<section><label for="text_tooltip">Image</label>
							<div><input type="file" id="text_placeholder" name="image" placeholder="your placeholder text">
							<span>use the placeholder attribute <code>placeholder="your placeholder text"</code></span>
							</div>
						</section>
						
					</fieldset>
							<section>
							<div><button class="reset">Reset</button><button class="submit" name="submitbuttonname" value="submitbuttonvalue">Submit</button></div>
						</section>
				</form>	
				</div>
		</section><!-- end div #content -->

