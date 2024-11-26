<?php

$cars = array("Volvo", "BMW", "Toyota");
array_splice($cars, 1, 2);

foreach ($cars as $car) {
  echo $car;
}



// $cars = array("Volvo", "BMW", "Toyota");
// foreach ($cars as &$x) {
//   $x = "Ford";
// }
// // unset($x);
// echo $x = 0;
// var_dump($cars);

// $arr = ["Shobhesh", "Shubham", "Saurabh"];

// foreach ($arr as $k => $v) {
//   echo "$k : $v <br>";
// }

// echo count($arr);
?>