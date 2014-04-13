<?php
require 'libs/common.php';
require 'libs/tietokantayhteys.php';
require 'libs/models/kalenteri.php';
require 'libs/models/merkinta.php';

if (onKirjautunut()){
    $kayttaja = $_SESSION['kayttaja'];
    $kalenterit = Kalenteri::haeKayttajanKalenterit($kayttaja);
    $poistettava = $_POST['poista'];
    if(isset($poistettava)){
        Merkinta::poistaMerkinta($poistettava);
        
    }
    if(isset($_POST["valittu"])){
        $valittu = $_POST["valittu"];
    } else {$valittu = -1;}
    if(isset($_POST["aikavali"])){
        $aikavali = $_POST["aikavali"];
    } else {$aikavali = "4";}
    $merkinnat = array();
    foreach($kalenterit as $kalenteri){
        if($valittu == $kalenteri->getId() || $valittu == -1){
            $taman =  Merkinta::haeMerkinnat($kalenteri->getId(), $aikavali);
            foreach($taman as $merkinta){
                $eivalittu = true;
                foreach($merkinnat as $valinta){
                    if($valinta->getId() == $merkinta->getId()){
                        $eivalittu = false;
                        break;
                    }
                }
                if($eivalittu){
                    $merkinnat[] = $merkinta;
                }
            }
        }
    }
    
    naytaNakyma('merkinnat_view.php', array(kalenterit=>$kalenterit, valittu=>$valittu, aikavali=>$aikavali, merkinnat => $merkinnat));
}else{
    header('Location:index.php');
}

