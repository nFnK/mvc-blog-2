
	<tr class=<?php echo $class; ?>>
		<td><a href="?controller=rewardprogram&action=view&id=<?php echo $rewardprogram->id; ?>"><?php echo $rewardprogram->title; ?></a></td>		
		<td><?php echo $rewardprogram->type; ?></td>	
		<td><?php echo $rewardprogram->status; ?></td>				
		<td><a href="?controller=rewardprogram&action=edit&id=<?php echo $rewardprogram->id; ?>">Edit</a></td>		
		<td><a href="?controller=rewardprogram&action=delete&id=<?php echo $rewardprogram->id; ?>" onclick="return confirm('Are you sure you want to delete this reward program?')">Delete</a></td>	
	</tr>
