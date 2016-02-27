<?php render('_header',array('title'=>$title))?>

	<table style="width:100%;" cellspacing="3" cellpadding="3">
		<tr class="even">
			<td>Reward Program title</td>
			<td><?php echo $rewardprograms->title; ?></td>
		</tr>
		<tr>
			<td>Reward Program description</td>
			<td><?php echo $rewardprograms->description; ?></td>
		</tr>
		<tr class="even">
			<td>Reward Program type</td>
			<td><?php echo $rewardprograms->type; ?></td>
		</tr>	
		<tr>
			<td colspan="2">
				<br>
				<table width="100%" class="qitems">
					<tr>
						<td colspan="2"><b>Qualifying <?php if($rewardprograms->type=="Sale") echo "Product"; else echo "Course"; ?></b></td>
					</tr>
					<tr>
						<th>Item</th>
						<th>Reward Amount</th>
					</tr>
					<tr>
						<td><?php echo $rewardprograms->itemname; ?></td>
						<td><?php echo $rewardprograms->amount; ?></td>
					</tr>
				</table>
				<br>
			</td>
		</tr>				
		<tr>
			<td>Reward Program valid untill</td>
			<td><?php echo $rewardprograms->validity; ?></td>
		</tr>		
		<tr class="even">
			<td>Reward Program status</td>
			<td><?php echo $rewardprograms->status;?></td>
		</tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
			<td>&nbsp;</td>
			<td class="align-right">
			<a href="?controller=rewardprogram&action=edit&id=<?php echo $rewardprograms->id; ?>">Edit</a>&nbsp;&nbsp;
			<a href="?controller=rewardprogram">Back</a></td>
		</tr>		
	</table>

<?php render('_footer')?>