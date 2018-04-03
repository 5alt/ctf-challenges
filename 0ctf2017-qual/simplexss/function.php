<?php

function filter_xss($str){
	$bad = str_split('\'"`()>/;&#,.:[]{}?%@!$');
	return str_replace($bad, '', $str);
}

function add_html($str){
	$t = <<<EOF
<html>
 <head>
<meta charset="utf-8">
<title>XSS Test Page</title>
 </head>
 <body>
<p>
	%s
</p>
 </body>  
EOF;
	return sprintf($t, $str);
}
