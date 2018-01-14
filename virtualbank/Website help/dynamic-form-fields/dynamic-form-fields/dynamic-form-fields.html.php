<?php
// Connect to the DB
$link = mysqli_connect("localhost","root","","test") or die("Error " . mysqli_error($link));

// store in the DB 
if(!empty($_POST['ok'])) {	
	// first delete the records marked for deletion. Why? Because we don't want to process them in the code below
	if( !empty($_POST['delete_ids']) and is_array($_POST['delete_ids'])) {
		// you can optimize below into a single query, but let's keep it simple and clear for now:
		foreach($_POST['delete_ids'] as $id) {
			$sql = "DELETE FROM products WHERE id=$id";
			$link->query($sql);
		}
	}

	// now, to edit the existing data, we have to select all the records in a variable.
	$sql="SELECT * FROM products ORDER BY id";
	$result = $link->query($sql);
	
	// now edit them
	while($product = mysqli_fetch_array($result)) {
		// remember how we constructed the field names above? This was with the idea to access the values easy now
		$sql = "UPDATE products SET qty='".$_POST['qty'.$product['id']]."', name='".$_POST['name'.$product['id']]."'
		WHERE id='$product[id]'";		
		$link->query($sql);
	}
	// (feel free to optimize this so query is executed only when a product is actually changed)
	
	// adding new products
	if(!empty($_POST['qty'])) {
		foreach($_POST['qty'] as $cnt => $qty) {
			$sql = "INSERT INTO products (qty, name) VALUES ('$qty', '".$_POST['name'][$cnt]."');";
			$link->query($sql);
		}
	}	
}

// select existing products here
$sql="SELECT * FROM products ORDER BY id";
$result = $link->query($sql);
?>

<html>
<head>
	<title>Simple example of dynamically adding rows with jQuery</title>
	<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
</head>

<body>

<div style="width:90%;margin:auto;">
	<h1>Simple example of dynamically adding rows with jQuery</h1>
	
	<form method="post">
	<div id="itemRows">
	
	Item quantity: <input type="text" name="add_qty" size="4" /> Item name: <input type="text" name="add_name" /> <input onclick="addRow(this.form);" type="button" value="Add row" /> (This row will not be saved unless you click on "Add row" first)
	
	<?php
	// let's assume you have the product data from the DB in variable called $products
	while($product = mysqli_fetch_array($result)): ?>
		<p id="oldRow<?=$product['id']?>">Item quantity: <input type="text" name="qty<?=$product['id']?>" size="4" value="<?=$product['qty']?>" /> Item name: <input type="text" name="name<?=$product['id']?>" value="<?=$product['name']?>" /> <input type="checkbox" name="delete_ids[]" value="<?=$product['id']?>"> Mark to delete</p>
	<?php endwhile;?>
	
	</div>
	
	<p><input type="submit" name="ok" value="Save Changes"></p>
	</form>
</div>

<script type="text/javascript">
var rowNum = 0;
function addRow(frm) {
	rowNum ++;
	var row = '<p id="rowNum'+rowNum+'">Item quantity: <input type="text" name="qty[]" size="4" value="'+frm.add_qty.value+'"> Item name: <input type="text" name="name[]" value="'+frm.add_name.value+'"> <input type="button" value="Remove" onclick="removeRow('+rowNum+');"></p>';
	jQuery('#itemRows').append(row);
	frm.add_qty.value = '';
	frm.add_name.value = '';
}

function removeRow(rnum) {
	jQuery('#rowNum'+rnum).remove();
}
</script>
</body>	
</html>