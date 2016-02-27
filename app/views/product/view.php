<?php render('_header',array('title'=>$title))?>

	<table style="width:100%;" cellspacing="3" cellpadding="3">
		<tr class="even">
			<td>Product title</td>
			<td><?php echo $products->title; ?></td>
		</tr>
		<tr>
			<td>Product description</td>
			<td><?php echo $products->description; ?></td>
		</tr>
		<tr class="even">
			<td>Product status</td>
			<td><?php echo $products->status;?></td>
		</tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
			<td>&nbsp;</td>
			<td class="align-right">
			<a href="?controller=product&action=edit&id=<?php echo $products->id; ?>">Edit</a>&nbsp;&nbsp;
			<a href="?controller=product">Back</a></td>
		</tr>		
	</table>

<?php render('_footer')?>