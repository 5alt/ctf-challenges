<?php
if(isset($_POST['submit']))
{
	$price_table = array(1999, 6990, 6088, 6988, 14288, 9288);
	$total = 0;
	for($i=0;$i<6;$i++){
		if(!empty($_POST[$i])){
			if(intval($_POST[$i]) < 0) die('No NEGATIVE amount!');
			$total += intval($_POST[$i]) * $price_table[$i];
		}
	}
	if(intval($total) === 0) echo 'Please BUY something!';
	else if(intval($total) === 1) echo file_get_contents('fl11l444444ggg.txt');
	else echo 'You ONLY have 1 RMB';
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<title>Apple Store</title> 
<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"></script> 
<script> 
$(function(){ 
$(".add").click(function(){ 
var t=$(this).parent().find('input[class*=text_box]'); 
t.val(parseInt(t.val())+1) 
setTotal(); 
}) 
$(".min").click(function(){ 
var t=$(this).parent().find('input[class*=text_box]'); 
t.val(parseInt(t.val())-1) 
if(parseInt(t.val())<0){ 
t.val(0); 
} 
setTotal(); 
}) 
function setTotal(){ 
var s=0; 
$("#tab td").each(function(){ 
s+=parseInt($(this).find('input[class*=text_box]').val())*parseInt($(this).find('span[class*=price]').text()); 
}); 
$("#total").html(s); 
} 
setTotal(); 

})
function check()
{
	if(parseInt(document.getElementById('total').textContent) > 1)
	{
		alert('Get out! You poor man! You only have 1 RMB in your account!');
		return false;
	}
	return true;
} 
</script> 
<style>
.text_box {width:20px; padding:3px 2px; } 
</style>
</head> 
<body> 
<h1>Shop Lists:</h1>
<form action="" method="POST">
<table id="tab"> 
<tr> 
<td> 
<span>iPod classic&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>price:&nbsp;<span></span><span class="price">1999</span> 
<input class="min" name="" type="button" value="-" /> 
<input class="text_box" name="0" type="text" maxlength="1" value="0" /> 
<input class="add" name="" type="button" value="+" /> 
</td> 
</tr> 
<tr> 
<td> 
<span>iPhone5s 64G&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>price:&nbsp;<span></span><span class="price">6990</span> 
<input class="min" name="" type="button" value="-" /> 
<input class="text_box" name="1" type="text" maxlength="1" value="0" /> 
<input class="add" name="" type="button" value="+" /> 
</td> 
</tr> 
<tr> 
<td> 
<span>iPhone5s 32G&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>price:&nbsp;<span></span><span class="price">6088</span> 
<input class="min" name="" type="button" value="-" /> 
<input class="text_box" name="2" type="text" maxlength="1" value="0" /> 
<input class="add" name="" type="button" value="+" /> 
</td> 
</tr> 
<tr> 
<td> 
<span>Macbook Air 13'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>price:&nbsp;<span></span><span class="price">6988</span> 
<input class="min" name="" type="button" value="-" /> 
<input class="text_box" name="3" type="text" maxlength="1" value="0" /> 
<input class="add" name="" type="button" value="+" /> 
</td> 
</tr> 
<tr> 
<td> 
<span>Macbook Pro Retina 15'</span>price:&nbsp;<span></span><span class="price">14288</span> 
<input class="min" name="" type="button" value="-" /> 
<input class="text_box" name="4" type="text" maxlength="1" value="0" /> 
<input class="add" name="" type="button" value="+" /> 
</td> 
</tr> 
<tr> 
<td> 
<span>Macbook Pro Retina 13'</span>price:&nbsp;<span></span><span class="price">9288</span> 
<input class="min" name="" type="button" value="-" /> 
<input class="text_box" name="5" type="text" maxlength="1" value="0" /> 
<input class="add" name="" type="button" value="+" /> 
</td> 
</tr> 
</table> 
<p>总价：<label id="total"></label></p> 
<input name="submit" type="submit" value="提交" onClick="return check()" /> 
</form>
</body> 
</html> 