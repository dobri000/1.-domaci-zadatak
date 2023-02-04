<?php

include "models/Tim.php";

$output = "";

$array = Tim::returnNameSuggest($_POST['name']);
if (count($array) == 0) {
    $output = "Nema predloga";
} else if (count($array) == 1) {
    $output = $array[0];
} else {
    $output = $array[0];
    for ($i = 1; $i < count($array); $i++) {
        $output .=", " . $array[$i];
    }
}

echo $output;

?>