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
    
    $tunnukset = array();
    foreach($kalenterit as $kalenteri){
        if($valittu == $kalenteri->getId() || $valittu == -1){
            $tunnukset[] = $kalenteri->getId();
        }
    }
    
    $merkinnat = Merkinta::haeMerkinnat($tunnukset, $aikavali);

    naytaNakyma('merkinnat_view.php', array(kalenterit=>$kalenterit, valittu=>$valittu, aikavali=>$aikavali, merkinnat => $merkinnat));
}else{
    header('Location:index.php');
}

