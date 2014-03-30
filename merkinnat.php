<?php
require 'libs/common.php';
if (onKirjautunut()){
    echo 'TODO: merkintälistaus.';
}else{
    header('Location:index.php');
}

