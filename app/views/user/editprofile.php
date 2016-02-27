<?php render('_header',array('title'=>$title))?>

<form name="user" method="post" action="?controller=user&action=updateprofile">
	<table style="width:100%;" cellspacing="3" cellpadding="3">
	
		<?php if(isset($users->msg)) { ?>
		<tr>
			<td colspan="2" class="align-center notification"><?php print($users->msg); ?></td>
		</tr>
		
		<?php } ?>
		<tr>
			<td colspan="2"><h2>Update Profile</h2></td>
		</tr>
		<tr>
			<td>First Name *</td>
			<td><input type="text" name="firstname" value="<?php echo $users->firstname; ?>"></td>
		</tr>
		<tr>
			<td>Last Name *</td>
			<td><input type="text" name="lastname" value="<?php echo $users->lastname; ?>"></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type="text" name="email" value="<?php echo $users->email; ?>" disabled></td>
		</tr>
		<!--<tr>
			<td>Password *</td>
			<td><input type="password" name="pass" value=""></td>
		</tr>
		<tr>
			<td>Confirm Password *</td>
			<td><input type="password" name="cpass" value=""></td>
		</tr>-->
		<tr>
			<td>Company *</td>
			<td><input type="text" name="company" value="<?php echo $users->company; ?>"></td>
		</tr>
		<tr>
			<td>Date Format</td>
			<td>
				<select name="date_format" id="date_format">
					<option value="m-d-Y">m-d-Y</option>
					<option value="d-m-Y">d-m-Y</option>
					<option value="Y-m-d">Y-m-d</option>
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
	<input type="hidden" name="id" value="<?php echo $users->id;?>">
	<input type="hidden" name="email" value="<?php echo $users->email;?>">
</form>

<?php if($users->date_format) { ?>
<script type="text/javascript">
  document.getElementById('date_format').value = "<?php echo $users->date_format;?>";
</script>
<?php } ?>

<?php render('_footer')?>