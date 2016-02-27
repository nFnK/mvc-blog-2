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
		<tr id="Sale" class="type-sub" style="display: none;" name="Sale">
			<td colspan="2">
				<br>
				<table width="100%" class="qitems" id="qitems">
					<tr>
						<td colspan="3"><b>Qualifying Products</b></td>
					</tr>
					<tr>
						<th>Product</th>
						<th>Reward Amount</th>
						<th>&nbsp;</th>
					</tr>
					<tr>
						<td>
							<select name="qproduct0" id="qproduct0">
								<?php for($i=0; $i<count($rewardprograms['qproduct']); $i++) { ?> 
								<option value="<?php echo $rewardprograms['qproduct'][$i]->id; ?>"><?php echo $rewardprograms['qproduct'][$i]->title; ?></option> 
								<?php } ?>
							</select>
						</td>
						<td><input type="text" name="reward_amount0" id="reward_amount0" value=""></td>
						<td><input type="button" class="removerow" value="Remove"></td>
					</tr>
				</table>
				<table width="100%" class="qitems" id="addmore">
					<tr>	
					<tr>
						<td colspan="3"><input type="button" id="btAdd" name="addmore" value="Add Another Product"></td>
					</tr>
				</table>
				<br>
			</td>
		</tr>
		<script type="text/javascript">
		 $(document).ready(function() {
			 var option = "";
			 <?php for($i=0; $i<count($rewardprograms['qproduct']); $i++) { ?> 
			 option += '<option value="<?php echo $rewardprograms['qproduct'][$i]->id; ?>"><?php echo $rewardprograms['qproduct'][$i]->title; ?></option>';
			 <?php } ?>
		 
		 var iCnt = 0;
		 $('#btAdd').click(function() {
			 if (iCnt < 4) {
                iCnt = iCnt + 1;
				$("#qitems").append('<tr id=tr' + iCnt + ' ' + '><td><select name=qproduct' + iCnt + ' ' + ' id=qproduct' + iCnt + ' ' + '>' + option + '</select></td><td><input type="text" name=reward_amount' + iCnt + ' ' + ' id=reward_amount' + iCnt + ' ' + ' value=""></td><td><input type="button" class="removerow" value="Remove"></td></tr>');
			 } else {
				  $('#btAdd').attr('disabled', 'disabled');
				  $('#addmore tr td').append('<label style="color:red;">&nbsp;Reached the limit.</label>'); 
			 }
		 });
		 });
		  $(document).ready(function() {
		  $("input.removerow").click(function() {alert("here");
    
		  });});
		</script>
		
		<!--Qualifying products - end -->
		
		<!--Qualifying courses -->
		<tr id="Training" class="type-sub" style="display: none;" name="Training">
			<td>Qualifying Courses</td>
			<td>
				<?php if(!empty($rewardprograms['qcourse'])) { ?>
					<select name="qcourse" id="qcourse">
					  <?php for($j=0; $j<count($rewardprograms['qcourse']); $j++) { ?> 
					  <option value="<?php echo $rewardprograms['qcourse'][$j]->id; ?>"><?php echo $rewardprograms['qcourse'][$j]->title; ?></option> 
					  <?php } ?>
					</select>
				<?php } ?>
			</td>
		</tr>  
		<!--Qualifying products - end -->
		<!--Hidden components - end -->		
		<tr>
			<td>Reward Program valid untill</td>
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

<?php if($rewardprograms['status']) { ?>
<script type="text/javascript">
  document.getElementById('status').value = "<?php echo $rewardprograms['status'];?>";
</script>
<?php } ?>

<script type="text/javascript">
$("#type").change ( function () {
    var targID  = $(this).val ();
    $("tr.type-sub").hide ();
    $('#' + targID).show ();
} );
</script>

<?php render('_footer')?>