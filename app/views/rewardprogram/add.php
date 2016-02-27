<?php render('_header',array('title'=>$title))?>
  
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#validity" ).datepicker();
  });
</script>
  
<form name="rewardprogram" method="post" action="?controller=rewardprogram&action=insert">
	<table style="width:100%;" cellspacing="3" cellpadding="3">
	
		<?php if(isset($rewardprograms['msg'])) { ?>
		<tr>
			<td colspan="2" class="align-center notification"><?php print($rewardprograms['msg']); ?></td>
		</tr>
		
		<?php } ?>
		<tr>
			<td colspan="2"><h2>Add a new Reward Program</h2></td>
		</tr>
		<tr>
			<td>Reward Program title *</td>
			<td><input type="text" name="title" value="<?php echo $rewardprograms['title']; ?>"></td>
		</tr>
		<tr>
			<td>Reward Program description</td>
			<td><textarea name="description" rows="10" cols="25"><?php echo $rewardprograms['description']; ?></textarea></td>
		</tr>
		<tr>
			<td>Reward Program type *</td>
			<td>
				<select name="type" id="type">
					<option value="">Select</option>
					<option value="Sale">Sale</option>
					<option value="Training">Training</option>
				</select>
			</td>
		</tr>
		<!--Hidden components -->
		<!--Qualifying products -->
		<tr id="Sale" class="type-sub" <?php if($rewardprograms['type']!="Sale") echo 'style="display: none;"'; ?> name="Sale">
			<td colspan="2">
				<br>
				<table width="100%" class="qitems" id="qitems">
					<tr>
						<td colspan="2"><b>Qualifying Product</b></td>
					</tr>
					<tr>
						<th>Product</th>
						<th>Reward Amount</th>
					</tr>
					<tr>
						<td>
							<select name="qproduct" id="qproduct">
								<option value="">Select</option>
								<?php for($i=0; $i<count($rewardprograms['qproducts']); $i++) { ?> 
								<option value="<?php echo $rewardprograms['qproducts'][$i]->id; ?>"><?php echo $rewardprograms['qproducts'][$i]->title; ?></option> 
								<?php } ?>
							</select>
						</td>
						<td><input type="text" name="product_reward_amount" id="product_reward_amount" value="<?php echo $rewardprograms['product_reward_amount']; ?>"> *</td>
					</tr>
				</table>
				<br>
			</td>
		</tr>
		<!--Qualifying products - end -->
		
		<!--Qualifying courses -->
		<tr id="Training" class="type-sub" <?php if($rewardprograms['type']!="Training") echo 'style="display: none;"'; ?> name="Training">
			<td colspan="2">
				<br>
				<table width="100%" class="qitems" id="qitems">
					<tr>
						<td colspan="2"><b>Qualifying Course</b></td>
					</tr>
					<tr>
						<th>Course</th>
						<th>Reward Amount</th>
					</tr>
					<tr>
						<td>
							<select name="qcourse" id="qcourse">
								<option value="">Select</option>
								<?php for($i=0; $i<count($rewardprograms['qcourses']); $i++) { ?> 
								<option value="<?php echo $rewardprograms['qcourses'][$i]->id; ?>"><?php echo $rewardprograms['qcourses'][$i]->title; ?></option> 
								<?php } ?>
							</select>
						</td>
						<td><input type="text" name="course_reward_amount" id="course_reward_amount" value="<?php echo $rewardprograms['course_reward_amount']; ?>"> *</td>
					</tr>
				</table>
				<br>
			</td>
		</tr>  
		<!--Qualifying products - end -->
		<!--Hidden components - end -->		
		<tr>
			<td>Reward Program valid untill *</td>
			<td>
				<input type="text" name="validity" id="validity" value="<?php echo $rewardprograms['validity']; ?>">
			</td>
		</tr>		
		<tr>
			<td>Reward Program status</td>
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

<?php if($rewardprograms['type']) { ?>
<script type="text/javascript">
  document.getElementById('type').value = "<?php echo $rewardprograms['type'];?>";
</script>
<?php } ?>

<?php if($rewardprograms['qproduct']) { ?>
<script type="text/javascript">
  document.getElementById('qproduct').value = "<?php echo $rewardprograms['qproduct'];?>";
</script>
<?php } ?>

<?php if($rewardprograms['qcourse']) { ?>
<script type="text/javascript">
  document.getElementById('qcourse').value = "<?php echo $rewardprograms['qcourse'];?>"; 
</script>
<?php } ?>

<?php if($rewardprograms['status']) { ?>
<script type="text/javascript">
  document.getElementById('status').value = "<?php echo $rewardprograms['status'];?>";
</script>
<?php } ?>

<script type="text/javascript">
$("#type").change ( function () {
    var targID  = $(this).val ();
    $("tr.type-sub").hide ();
	$("tr.type-sub :input").val("");
    $('#' + targID).show ();
} );
</script>

<?php render('_footer')?>