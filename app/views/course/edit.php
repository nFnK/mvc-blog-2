<?php render('_header',array('title'=>$title))?>

<form name="course" method="post" action="?controller=course&action=update">
	<table style="width:100%;" cellspacing="3" cellpadding="3">
	
		<?php if(isset($courses->msg)) { ?>
		<tr>
			<td colspan="2" class="align-center notification"><?php print($courses->msg); ?></td>
		</tr>
		
		<?php } ?>
		<tr>
			<td colspan="2"><h2>Update Course</h2></td>
		</tr>
		<tr>
			<td>Course title *</td>
			<td><input type="text" name="title" value="<?php echo $courses->title; ?>"></td>
		</tr>
		<tr>
			<td>Course description</td>
			<td><textarea name="description" rows="10" cols="25"><?php echo $courses->description; ?></textarea></td>
		</tr>
		<tr>
			<td>Course status</td>
			<td>
				<select name="status" id="status">
					<option value="Active">Active</option>
					<option value="Inactive">Inactive</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="submit" value="Submit"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td class="align-right">* marked fields are mandatory</td>
		</tr>
	</table>
	<input type="hidden" name="id" value="<?php echo $courses->id;?>">
</form>

<?php if($courses->status) { ?>
<script type="text/javascript">
  document.getElementById('status').value = "<?php echo $courses->status;?>";
</script>
<?php } ?>

<?php render('_footer')?>