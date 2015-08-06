<section>
		 <div class="g12">
			<h1>Manage Users</h1>
			<p style="float:right;"><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/addData">Add Users</a></p>

				 
			
			<table class="datatable">
				<thead>
					<tr>
						<th>id</th><th>Name</th><th>Email</th><th>Password</th><th>City</th><th>State</th><th>Status</th>Action<th>
					</tr>
				</thead>
				<tbody>
				
				<?php foreach($users as $user) { ?>
				
					<tr class="gradeX">
						<td><?php echo $user->id ?> </td><td><?php echo $user->name ?></td><td><?php echo $user->email ?></td><td class="c"><?php echo $user->password ?></td><td class="c"><?php echo $user->city ?></td><td class="c"><?php echo $user->state ?></td><td class="c"><?php echo $user->status ?></td><td><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/deleteData/<?php echo $user->id ?>">Delete</a>|
						
						<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/admin/viewData/<?php echo $user->id ?>">View</a>|<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/admin/editUser/<?php echo $user->id ?>">Edit</a>
						
						</td>
					</tr>
					<?php  } ?>
				</tbody>
			</table>
		</div>

			
		</section><!-- end div #content -->
