<?php

$domain = $_POST['d'];
$url = 'https://intodns.com/'. $domain;

$content = file_get_contents($url);
$first_step = explode( '<div class="content">' , $content );
$second_step = explode("</div>" , $first_step[1] );

$remove_p = preg_replace('/<p\b[^>]*>(.*?)<\/p>/i', '', $second_step[0]);
$remove_a = preg_replace('/<a href="feedback\b[^>]*>(.*?)<\/a>/i', '', $remove_p);
$html = str_replace('cellspacing="1"', 'border="1"', $remove_a);

echo (strlen($html)>25) ? $html : $remove_p;
    
    
?>