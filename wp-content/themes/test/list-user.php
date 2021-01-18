<?php /*
 Template Name: list user Page
 */ 
?>

<?php 
	$array = array(
		'orderby' => 'id',
		'order' => 'DESC');
	$listUser = get_users($array);
?>	
<div class="sidebar-child">
	<div class="list-user">

			<table>
				<thead>
					<th>user_login</th>
					<th>user_pass</th>
					<th>user_nicename</th>
					<th>user_email</th>
					<th>display_name</th>
					<th>first_name</th>
					<th>user_name</th>
				</thead>
				<tbody>
				<?php foreach ($listUser as $key => $value) { ?>
					<tr>
						<td><?php echo $value->user_login; ?></td>
						<td><?php echo $value->user_pass; ?></td>
						<td><?php echo decrypt($value->user_nicename); ?></td>
						<td><?php echo decrypt(cutEmail($value->user_email)); ?></td>
						<td><?php echo decrypt($value->display_name); ?></td>
						<td><?php echo decrypt($value->first_name); ?></td>
						<td><?php echo decrypt($value->user_name); ?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>

	</div>
</div>