<?php render('_header',array('title'=>$title))?>

	<table style="width:100%;" cellspacing="3" cellpadding="3">
		<?php if(isset($msg)) { ?>
		<tr>
			<td colspan="2" class="align-center notification"><?php print($msg); ?></td>
		</tr>
		<tr><td colspan="2" class="clear"></td></tr>
		<?php } ?>
		
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
			<td>Pending requests</td>
			<td><?php echo Session::get('pending_requests'); ?></td>
		</tr>
		<tr class="even">
			<td>Last activity</td>
			<td><?php echo $users->last_activity; ?></td>
		</tr>		
		
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
			<td>&nbsp;</td>
			<td class="align-right"><a href="?controller=user&action=editprofile&id=<?php echo $users->id; ?>">Edit</a></td>
		</tr>		
	</table>

<?php render('_footer')?>