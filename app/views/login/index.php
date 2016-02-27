<?php render('_header',array('title'=>$title))?>

<table style="width:100%;">
	<?php if(isset($msg)) { ?>
		<tr>
			<td class="align-center notification"><?php print($msg); ?></td>
		</tr>
		<tr><td>&nbsp;</td></tr>
	<?php } ?>
	<tr>
		<td>
			<form name="login" method="post" action="?controller=login&action=login">
			<table style="width:100%; border:1px solid black;" cellspacing="5" cellpadding="5">
				<tr>
					<td>Username</td>
					<td><input type="text" name="username" value=""></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="password" value=""></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" name="submit" value="Login"></td>
				</tr>				
			</table>
			</form>
		</td>
	</tr>
</table>

<?php render('_footer')?>