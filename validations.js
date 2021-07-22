function valid_sku(sku){
	var msg = "";
	if (sku.length < 9 || sku.length > 9){
		console.log("here");
		msg = "Enter a 9 character SKU";
	}
	else if (!sku.match("^[A-Za-z0-9_-]*$")){
		msg = "You can only use numbers and letters";
	}
	$("#SKU_message").html(msg);
	return msg == "" ? 1 : 0;
}

function valid_name(name){
	var msg = "";
	$("#name_message").html(msg);
	return msg == "" ? 1 : 0;
}

function valid_number(num, input){
	var msg = "";
	if (isNaN(num)) msg = "Enter a valid number";
	else if (parseInt(num) <= 0) msg = "Enter a positive number";
	$("#" + input + "_message").html(msg);
	return msg == "" ? 1 : 0;
}
