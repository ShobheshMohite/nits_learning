<?php
// $str = "Visit W3Schools";
// $pattern = "/w3schools/i";
// echo preg_match($pattern, $str);
$str = 'Which watch would you watch?';
$pattern = '/w/i';
echo preg_match_all($pattern, $str);
?>