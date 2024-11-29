<!-- <?php
$age = array("Volvo", "BMW", "Toyota");

echo json_encode($age);
?> -->

<!-- decode -->
<?php
$jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';

var_dump(json_decode($jsonobj, true), );
?>