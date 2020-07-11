<?php

if(!isset($_GET["id"])) {
    exit("Can't Find page");
}

$id = $_GET["id"];
echo $id. "<br><br> Use this later for Database purpose";
?>