<?php render('_header',array('title'=>$title))?>

	<table style="width:100%;" cellspacing="3" cellpadding="3">
		<tr class="even">
			<td>Name</td>
			<td><?php echo $users->firstname . " " . $users->lastname; ?></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><?php echo $users->email; ?></td>
		</tr>
		<tr class="even">
			<td>Company</td>
			<td><?php echo $users->company;?></td>
		</tr>
		<tr>
			<td>Role</td>
			<td><?php echo $users->role; ?></td>
		</tr>	
		<tr class="even">
			<td>Member since</td>
			<td><?php echo $users->created; ?></td>
		</tr>
		<tr>
			<td>Last activity</td>
			<td><?php echo $users->last_activity; ?></td>
		</tr>		
		<tr class="even">
			<td>Status</td>
			<td><?php echo $users->status; ?></td>
		</tr>		
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
			<td>&nbsp;</td>
			<td class="align-right">
			<a href="?controller=user&action=edit&id=<?php echo $users->id; ?>">Edit</a>&nbsp;&nbsp;
			<a href="?controller=user">Back</a></td>
		</tr>		
	</table>

<?php render('_footer')?>