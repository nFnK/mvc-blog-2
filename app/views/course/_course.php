
	<tr class=<?php echo $class; ?>>
		<td><a href="?controller=course&action=view&id=<?php echo $course->id; ?>"><?php echo $course->title; ?></a></td>		
		<td><?php echo $course->status; ?></td>				
		<td><a href="?controller=course&action=edit&id=<?php echo $course->id; ?>">Edit</a></td>		
		<td><a href="?controller=course&action=delete&id=<?php echo $course->id; ?>" onclick="return confirm('Are you sure you want to delete this course?')">Delete</a></td>	
	</tr>
