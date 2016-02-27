<?php render('_header',array('title'=>$title))?>

<table style="width:100%;">
	<?php if(isset($msg)) { ?>
		<tr>
			<td class="align-center notification"><?php print($msg); ?></td>
		</tr>
	<?php } ?>
	<tr>
		<td class="align-right"><a href="?controller=product&action=add">Add new product</a></td>
	</tr>
	<tr>
		<td>
			<table style="width:100%;" cellspacing="3" cellpadding="3">
				<tr class="tr-heading">
					<td>Title</td>
					<td>Status</td>
					<td colspan="2">Action</td>
				</tr>
				<?php render($products); ?>
			</table>
		</td>
	</tr>
</table>

<?php render('_footer')?>