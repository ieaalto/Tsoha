<?php
require 'libs/common.php';
if (onKirjautunut()){
    naytaNakyma('merkinnat_view.php');
}else{
    header('Location:index.php');
}

