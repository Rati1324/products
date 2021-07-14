<?php 
	include("db.php");
	$db = new Database;
	
	if (isset($_POST['delete'])){
		foreach ($_POST as $id)
		    $db->delete_product($id);
	}
	$products = $db->get_all();
	$db->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles/index.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<title>Home</title>
</head>
<body>
	<header class="col-8">
		<h1>Product List</h1>
		<div class="buttons">
			<form action="add.php" method="get"> <button>Add</button> </form>
			<form id="del" method="post">
				<button name="delete" id="delete_btn" style="height:57%">Mass Delete</button>
			</form>
		</div>
	</header>
	<hr>
	<div class="products-container-inner">
		<div class="products-container col-8">
			<?php
				foreach ($products as $type){
					foreach($type as $p) { ?>
					<div>
						<div class="checkbox">
							<input name=<?=$p['id']?> form="del" value=<?=$p['id']?> type="checkbox" class="delete-checkbox" ?>
						</div>
						<div class="product-info">
							<?php 
								unset($p['id']);
								foreach ($p as $k => $v){ 
									if ($k === array_key_last($p))					
										echo "<span>" . htmlspecialchars($k) . ":" . htmlspecialchars($v) . "</span>";
									else echo "<span>" . htmlspecialchars($v) . "</span>";
								}
						echo "
						</div> 
						</div>";
					};
				}
			?>
		</div>
	</div>
	<hr>
	<div style="text-align: center">ScandiWeb test assignment</div>
</body>
</html>