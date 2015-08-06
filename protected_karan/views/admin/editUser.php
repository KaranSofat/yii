<section>
			
			<div class="g12">
			<h1>Edit User</h1>
			
				<form id="form" action="<?php echo Yii::app()->request->baseUrl; ?>/index.php/admin/editUser/<?php echo $rec->id ?>" method="POST" autocomplete="off">
					<fieldset>
			
						<section><label for="text_tooltip">Name</label>
							<div><input type="text" id="text_tooltip" name="name" title="A Tooltip" value="<?php echo $rec->name ?>"
							<span>Just specify a title attribut to get a Tooltip</span>
							</div>
						</section>
						<section><label for="text_tooltip">Email</label>
							<div><input type="text" id="text_placeholder" name="email" placeholder="your placeholder text" value="<?php echo $rec->email ?>"
							<span>use the placeholder attribute <code>placeholder="your placeholder text"</code></span>
							</div>
						</section>
						<section><label for="textarea">State</label>
							<div><textarea id="textarea" name="state" rows="10"><?php echo $rec->state ?></textarea></div>
						</section>
						
						<section><label for="text_tooltip">City</label>
							<div><input type="text" id="text_placeholder" name="city" placeholder="your placeholder text" value="<?php echo $rec->city ?>"
							<span>use the placeholder attribute <code>placeholder="your placeholder text"</code></span>
							</div>
						</section>
						<section><label for="text_tooltip">Password</label>
							<div><input type="text" id="text_placeholder" name="password" placeholder="your placeholder text" value="<?php echo $rec->password ?>"
							</div>
						</section>
						
						
					</fieldset>
							<section>
							<div><button class="reset">Reset</button><button class="submit" name="submitbuttonname" value="submitbuttonvalue">Submit</button></div>
						</section>
				</form>	
				</div>
		</section><!-- end div #content -->

