<?php
	include("db.php");
	$db = new Database;
	$old_input = ['SKU' => "", 'name' => "", 'price' => "", 
				'weight' => "", 'size' => "", 'height' => "", 
				'width' => "", 'length' => ""];
	foreach($_POST as $k => $v){
		$old_input[$k] = $v;
	}
	$messages = ['sku' => "", 'name' => "", 'price' => "", 
				'size' => "", 'weight' => "",  'height' => "",
				'width' => "", 'length' => ""];
	if (isset($_POST['submit'])){
		include("validation.php");
		if ($valid){	
			$db->insert_product($_POST);
			header("location: index.php");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles/add.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<title>Add</title>
</head>
<body>
	<header class="col-8">
		<h1>Product Add</h1>
		<div class="buttons">
			<button id="save" name="submit" type="submit" form="product-form">Save</button>
			<form action="index.php" method="get"><button>Cancel</button></form>
		</div>
	</header>
	<hr>
	<form method="post" class="col-8" id="product-form" autocomplete="off">
		<div>
			<label>SKU</label> 
			<input type="text" name="SKU" id="SKU" style="text-transform:uppercase" value=<?=$old_input['SKU']?>>
			<label class="message" name="message" id="SKU_message"><?=$messages['sku']?></label>
		</div>
		<div>
			<label>Name</label>
			<input type="text" name="name" id="name" value=<?=$old_input['name']?>>
			<label class="message" name="message" id="name_message"><?=$messages['name']?></label>
		</div>
		<div>
			<label>Price ($)</label>
			<input type="text" name="price" step="0.01" id="price" value=<?=$old_input['price']?>>
			<label class="message" name="message" id="price_message"><?=$messages['price']?></label>
		</div>
		<div>
			<label>Type</label>
			<select name="type" id="type">
				<option name="type" selected disabled>Type</option>
				<option value="1" name="type" id="DVD">DVD</option>
				<option value="2" name="type" id="Furniture">Furniture</option>
				<option value="3" name="type" id="Book">Book</option>
			</select>		
		</div>

		<div class="type_1" name="type_form">
			<span>Please provide capacity of the disk
			</span><br><br>
			<label>Size(MB)</label>
			<input type="text" name="size" id="size" step="0.01" value=<?=$old_input['size']?>>
			<label class="message" name="message" id="size_message"></label>
		</div>
		<div class="type_2" name="type_form">
			<span>Please provide dimensions in HxWxL format</span>
				<br><br>
				<label>Height (CM)</label>
				<input type="text" name="height" id="height" step="0.01" value=<?=$old_input['height']?>>
				<label class="message" name="message" id="height_message"></label>
				<br><br>
				<label>Width (CM)</label>
				<input type="text" name="width" id="width" step="0.01" value=<?=$old_input['width']?>>
				<label class="message" name="message" id="width_message"></label>
				<br><br>
				<label>Length (CM)</label>
				<input type="text" name="length" id="length" step="0.01" value=<?=$old_input['length']?>>
				<label class="message" name="message" id="length_message"></label>
		</div>
		<div class="type_3" name="type_form">
			<span>Please provide the weight</span>
			<div>
				<label>Weight (KG)</label>
				<input type="text" name="weight" id="weight" step="0.01" value=<?=$old_input['weight']?>> 
				<label class="message" id="weight_message"></label>
			</div>
		</div>
	</form>
	<hr>
	<div style="text-align: center">ScandiWeb test assignment</div>
	<script src="validations.js"></script>
	<script>
		var valid = 0;							
		$("#SKU").keyup((e) => {
			setTimeout(() => {	
				if (!valid_sku($(e.target).val(), 'sku')) {
					valid = 0;
				}
				else valid = 1;
			}, 1000);
		})
		
		var type_chosen = document.querySelector("#type")
		type_chosen.addEventListener('change', () => {type_switch(type_chosen)})
		
		var numbers_to_validate = [];
		function type_switch(type_chosen){
			var types = document.getElementsByName('type_form')
			var btn = document.getElementsByName('submit')[0] 
			types.forEach(element => {element.style.display = "none"});
			var type_form = document.querySelector('.type_' + type_chosen.value)
			
			type_form.style.display = "block";
			btn.style.display = "block";

			for (let i = 0; i < type_form.children.length; i++){
				let elem = type_form.children[i];
				if (elem.tagName == "INPUT"){
					numbers_to_validate.push({id: elem.id, value: ""})
					$("#" + elem.id).keyup(() => setTimeout(() => {
						if (!valid_number(elem.value, elem.id)) valid = 0;
						else valid = 1;
					}, 1000))
				}
			}
		}
		$("#price").keyup(() => setTimeout(() => {
			if (!valid_number($("#price").val(), "price")) valid = 0;
			else valid = 1;
		}, 1000))
		
		$("#save").click((e) => {
			for (let i of $("form :text")){
				if (i.value === "") {
					if (i.id == "SKU" || i.id == "name" || 
						i.id == "price" || in_numbers_to_validate(i.id)){
						$("#" + i.id + "_message").html("This field can't be empty")
					}
				}
				else $("#" + i.id + "_message").html("")
			}
			if (!valid)
				e.preventDefault();
		})
		function in_numbers_to_validate(id){
			var exists = 0
			numbers_to_validate.forEach(i => {if (i.id == id) exists = 1});
			return exists;
		}
	</script>

</body>
</html>