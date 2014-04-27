<?php
require_once 'libs/common.php';
require 'libs/tietokantayhteys.php';
require_once "libs/models/kalenteri.php";

if(onKirjautunut()){
    $kalenteri = $_GET['kalenteri'];
    $kayttajat = Kalenteri::haeKalenterinKayttajat($kalenteri);
    naytaNakyma('naytakayttajat_view.php', array(kalenteri => $kalenteri, kayttajat => $kayttajat));
    
} else{
    header('Location:index.php');
}

