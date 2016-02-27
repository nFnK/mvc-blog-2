<table style="width:100%;" class="rrclass">
<?php for($i=0; $i<count($content);$i++) { ?>
<tr>
	<td style="width:70%;"><?php echo $content[$i]->title; ?><p><?php echo $content[$i]->description; ?></p></td>
	<td class="align-right"><a href="#reward-request?id=<?php echo $content[$i]->id; ?>" class="rr-button">Request Reward</a></td>
</tr>
<?php } ?>
</table>