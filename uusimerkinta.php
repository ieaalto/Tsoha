<?php
require 'libs/common.php';
require 'libs/tietokantayhteys.php';
require 'libs/models/kalenteri.php';
require 'libs/models/merkinta.php';

if (onKirjautunut()){    
    $sivu="uusimerkinta_view.php";
    $kayttaja = $_SESSION['kayttaja'];
    $kalenterit = Kalenteri::haeKayttajanKalenterit($kayttaja);
    $aihe = htmlspecialchars($_POST["aihe"]);
    $pp = $_POST["pp"];
    $kk = $_POST["kk"];
    $vv = $_POST["vv"];
    $hh = $_POST["hh"];
    $mm = $_POST["mm"];
    $valitut = array();
    foreach($kalenterit as $kalenteri){
        if(isset($_POST[$kalenteri->getId()])){
            $valitut[] = $kalenteri->getId();
        }
    }
    if(isset($_POST['laheta'])){
        if(!tarkistaSyote($aihe, 32)){
            naytaNakyma($sivu, array(kalenterit => $kalenterit, virhe=>'Tarkista aihe! aihe saa olla enintään 32 merkkiä pitkä, eikä se saa sisältää erikoismerkkejä!'));
        } if(!checkdate($kk, $pp, $vv)){
            naytaNakyma($sivu, array(kalenterit => $kalenterit, virhe=>'Tarkista päivämäärä!', aihe => $aihe, pp => $pp, kk => $kk, vv => $vv, hh=>$hh, mm=>$mm));
        } if(!tarkistaKellonaika($hh, $mm)){
            naytaNakyma($sivu, array(kalenterit => $kalenterit, virhe=>'Tarkista kellonaika!', aihe => $aihe, pp => $pp, kk => $kk, vv => $vv, hh=>$hh, mm=>$mm ));
        } if(empty($valitut)){
            naytaNakyma($sivu, array(kalenterit => $kalenterit, virhe=>'Et valinnut yhtään kalenteria!', aihe => $aihe, pp => $pp, kk => $kk, vv => $vv, hh=>$hh, mm=>$mm));
        } 
        $pvm = $vv."-".$kk."-".$pp;
        $klo = $hh.":".$mm.":00";
        Merkinta::luoMerkinta($aihe, $pvm, $klo, $valitut);
        naytaNakyma($sivu, array(kalenterit => $kalenterit, ilmo=>"Merkintä tallennettu!"));
        
    }
    
    naytaNakyma($sivu, array(kalenterit => $kalenterit));
}else{
    header('Location:index.php');
}
    
