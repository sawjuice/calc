<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Calc</title>
<style>

	table 
	{
		margin:0 auto;
	}

	button,
	input
	{
		display: block;	
		font-size: 2em;
		text-align: center; 
		margin:0 auto;
	}

	button 
	{
		width:  120px;
		height: 120px;
	}
	input 
	{
		padding: 10px;
		width: 700px;
	}
</style>
</head>
<body>

<div style="">
<table style="">
	<tr>
		<td colspan="5"><input type="text" id="input" disabled=""></td>
	</tr>
	<tr>
		<td><button data-val="9">9</button></td>
		<td><button data-val="8">8</button></td>
		<td><button data-val="7">7</button></td>
		<td><button data-val="plus">+</button></td>
		<td><button data-val="minus">-</button></td>
	</tr>
	<tr>
		<td><button data-val="6">6</button></td>
		<td><button data-val="5">5</button></td>
		<td><button data-val="4">4</button></td>
		<td><button data-val="multiply">*</button></td>
		<td><button data-val="division">/</button></td>
	</tr>
	<tr>
		<td><button data-val="1">1</button></td>
		<td><button data-val="2">2</button></td>
		<td><button data-val="3">3</button></td>
		<td><button id="result">=</button></td>
		<td><button type="reset" id="reset" value="C">C</button></td>
	</tr>
	<tr>
		<td><button data-val="0">0</button></td>
	</tr>
</table>
</div>
<script src="jquery-3.1.1.min.js"></script>
<script>
$(function(){

	var expression = [];
	var r = false;

	$('button#reset').on('click', function(e){
		resetInput();
		expression = [];
	});

	function resetInput(){
		$('input#input').val('');

	}

	$('button').on('click', function(e){
		if (r)
		{
			resetInput();
			r = false;	
		}
		var current = $('#input').val();
		buildExp($(this).data('val'), current);

	});
	
	$('button#result').on('click', function(e){

		if (expression != false)
		{
			expression.push($('input#input').val());

			$.ajax({
				url: "ajax.php",
				method: "post",

				data: {
					expression: expression
				},
				success: function(data){
					resetInput();
					expression = [];
					data = JSON.parse(data);
					if (data.result != 'dbz'){
						$('input#input').val(data.result);
					} else {
						$('input#input').val('деление на ноль');
					}
					r = true;
					console.log(data);
				}
			});
		}
	});

	function buildExp(val, current){

		if ($.isNumeric(val)){
			current += val;
			$('#input').val(current);
		}
		if (current != false) { 
			switch(val)
			{
				case 'plus':
					expression.push(current);
					expression.push(val);
					resetInput();
					console.log(expression);
				break;
				case 'minus':
					expression.push(current);
					expression.push(val);
					resetInput();
					console.log(expression);
				break;
				case 'multiply':
					expression.push(current);
					expression.push(val);
					resetInput();
					console.log(expression);
				break;
				case 'division':
					expression.push(current);
					expression.push(val);
					resetInput();
					console.log(expression);
				break;
			}
		}	
	}
});
</script>
</body>
</html>