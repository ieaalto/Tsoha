<?php
require_once 'libs/common.php';
require 'libs/tietokantayhteys.php';
require_once 'libs/models/kalenteri.php';

$id = $_POST['tunnus'];
$sivu = 'julkinen_view.php';

if(!is_numeric($id) && isset($id)){
    naytaNakyma($sivu, array(virhe => 'Tarkista tunnus!'));
}

if(isset($id)){
    $kalenteri = Kalenteri::haeKalenteriTunnuksella($id);
    
    if($kalenteri == null || !$kalenteri->getJulkinen()){
        naytaNakyma($sivu, array(virhe => 'Kalenteria ei löydy!'));
    } else {
        header('Location: naytajulkinen.php?id='.$id);
    }
    
} else {
    naytaNakyma($sivu);
}
    


