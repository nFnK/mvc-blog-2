<?php render('_header',array('title'=>$title))?>

<form name="product" method="post" action="?controller=product&action=insert">
	<table style="width:100%;" cellspacing="3" cellpadding="3">
	
		<?php if(isset($products['msg'])) { ?>
		<tr>
			<td colspan="2" class="align-center notification"><?php print($products['msg']); ?></td>
		</tr>
		
		<?php } ?>
		<tr>
			<td colspan="2"><h2>Add a new product</h2></td>
		</tr>
		<tr>
			<td>Product title *</td>
			<td><input type="text" name="title" value="<?php echo $products['title']; ?>"></td>
		</tr>
		<tr>
			<td>Product description</td>
			<td><textarea name="description" rows="10" cols="25"><?php echo $products['description']; ?></textarea></td>
		</tr>
		<tr>
			<td>Product status</td>
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
</form>

<?php if($products['status']) { ?>
<script type="text/javascript">
  document.getElementById('status').value = "<?php echo $products['status'];?>";
</script>
<?php } ?>

<?php render('_footer')?>