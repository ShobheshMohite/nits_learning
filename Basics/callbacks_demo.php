<!-- <?php
function myCallback($item)
{
  return strlen($item);
}

$string = ["apple", "orange", "banana"];
$lengths = array_map(("myCallback"), $string);
print_r($lengths);
?> -->

<!-- anonymus function -->
<?php
$strings = ["apple", "orange", "banana", "coconut"];
$lengths = array_map(function ($item) {
  return strlen($item);
}, $strings);
print_r($lengths);

?>