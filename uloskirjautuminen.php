<?php
require_once 'libs/common.php';
if(onKirjautunut()){
    unset($_SESSION["kayttaja"]);
}
header('Location: index.php');

