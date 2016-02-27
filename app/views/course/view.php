<?php render('_header',array('title'=>$title))?>

	<table style="width:100%;" cellspacing="3" cellpadding="3">
		<tr class="even">
			<td>Course title</td>
			<td><?php echo $courses->title; ?></td>
		</tr>
		<tr>
			<td>Course description</td>
			<td><?php echo $courses->description; ?></td>
		</tr>
		<tr class="even">
			<td>Course status</td>
			<td><?php echo $courses->status;?></td>
		</tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
			<td>&nbsp;</td>
			<td class="align-right">
			<a href="?controller=course&action=edit&id=<?php echo $courses->id; ?>">Edit</a>&nbsp;&nbsp;
			<a href="?controller=course">Back</a></td>
		</tr>		
	</table>

<?php render('_footer')?>