<?php

//echo str_word_count("Hello world!");

// $x = "Hello World!";
//echo substr($x, 6,6 );

// $x = "Hi, how are you?";
// echo strlen($x );
// echo substr($x, 5, -3);

// $x = "We are the so-called \"Vikings\" from the north.";
// echo $x;

// $c = "25";
// echo var_dump( $c );

// $a = 5;       // Integer
// $b = 5.34;    // Float
// $c = "hello"; // String
// $d = true;    // Boolean
// $e = NULL;    // NULL

// $a = (array) $a;
// $b = (string) $b;
// $c = (string) $c;
// $d = (string) $d;
// $e = (string) $e;

// //To verify the type of any object in PHP, use the var_dump() function:
// var_dump($a);
// var_dump($b);
// var_dump($c);
// var_dump($d);
// var_dump($e);


class Car {
  public $color;
  public $model;
  public function __construct($color, $model) {
    $this->color = $color;
    $this->model = $model;
  }
  public function message() {
    return "My car is a " . $this->color . " " . $this->model . "!";
  }
}

$myCar = new Car("red", "Volvo");

// $myCar = (array) $myCar;
var_dump($myCar);


?>