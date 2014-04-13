<?php
session_start();

function naytaNakyma($sivu, $data = array()) {
    $data = (object)$data;
    require 'views/pohja.php';
    exit();
}

function onKirjautunut(){
    if (isset($_SESSION['kayttaja'])) {
        return true;
    } else {
        return false;
    }
}

function tarkistaSyote($nimi, $pituus){
        if(strlen($nimi) <= $pituus && strlen($nimi) > 0){
            return true;
        }
    }
    
function viikonpaiva(){
        $paivat = array('maanantai','tiistai','keskiviikko','torstai','perjantai','lauantai','sunnuntai');
        $pv = date('N');
        return $paivat[((int)$pv)-1];       
}

function tarkistaKellonaika($hh, $mm){
    if($hh >=  0 && $hh < 24 && $mm >= 0 && $mm <= 59){
        return true;
    }
}