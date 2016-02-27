
	<tr class=<?php echo $class; ?>>
		<td><a href="?controller=user&action=view&id=<?php echo $user->id; ?>"><?php echo $user->firstname . " " . $user->lastname; ?></a></td>
		<td><?php echo $user->email; ?></td>
		<td><?php echo $user->company; ?></td>					
		<td><?php echo $user->status; ?></td>				
		<td><a href="?controller=user&action=edit&id=<?php echo $user->id; ?>">Edit</a></td>		
		<td><a href="?controller=user&action=delete&id=<?php echo $user->id; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a></td>	
	</tr>