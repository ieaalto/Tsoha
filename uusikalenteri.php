<?php
require 'libs/common.php';
require 'libs/models/kalenteri.php';
$sivu = 'uusikalenteri_view.php';
if (onKirjautunut()){
    if(isset($_POST['tallenna'])){
        $nimi = $_POST['nimi'];
        if(empty($nimi)){
            naytaNakyma($sivu, array(virhe => 'Anna kalenterille nimi!'));
        } else if(!Kalenteri::tarkistaKalenterinNimi($nimi)){
            naytaNakyma($sivu, array(virhe => 'Kalenterin nimen tulee olla enintään 24 merkkiä pitkä!'));
        }
        if(isset($_POST['julkinen'])){
            $julkinen = 1;
        } else{ $julkinen = 0;}
        if(isset($_POST['saaJakaa'])){
            $saaJakaa = 1;
        } else{ $saaJakaa = 0;}
        $omistaja = $_SESSION['kayttaja'];
        if(empty($nimi)){
            naytaNakyma($sivu, array(virhe => 'Anna kalenterille nimi!'));
        } else{
            Kalenteri::luoKalenteri($nimi, $julkinen, $saaJakaa, $omistaja);
            naytaNakyma($sivu, array(tallennettu => 'true'));
        }        
    }    
    naytaNakyma('uusikalenteri_view.php');
}else{
    header('Location:index.php');
}

