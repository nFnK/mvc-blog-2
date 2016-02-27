
	<tr class=<?php echo $class; ?>>
		<td><a href="?controller=product&action=view&id=<?php echo $product->id; ?>"><?php echo $product->title; ?></a></td>		
		<td><?php echo $product->status; ?></td>				
		<td><a href="?controller=product&action=edit&id=<?php echo $product->id; ?>">Edit</a></td>		
		<td><a href="?controller=product&action=delete&id=<?php echo $product->id; ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a></td>	
	</tr>
