<?php render('_header',array('title'=>$title))?>

<table style="width:100%;">
	<tr>
		<td>
			<form name="login" method="post" action="?controller=login&action=login">
			<table style="width:100%;">
				<tr>
					<td>Welcome <?php echo $user['brp_firstname'] . " " . $user['brp_lastname']; ?></td>
				</tr>	
				<tr>
					<td>Your last activity was on <?php echo $user['brp_last_activity']; ?></td>
				</tr>
			</table>
			</form>
		</td>
	</tr>
</table>

<?php render('_footer')?>