<?php
require_once 'libs/common.php';
require_once "libs/models/kalenteri.php";

if(onKirjautunut()){
    $kayttaja = $_SESSION['kayttaja'];
    $kalenterit = Kalenteri::haeKayttajanKalenterit($kayttaja); 
    $valittu = $_POST['valittu'];
    $paivita = $_POST['paivita'];
    $poista = $_POST['poista'];
    $jaa = $_POST['jaa'];
    $kenelle = $_POST['kenelle'];
    if(isset($paivita)){
        $nimi = $_POST['nimi'];
        if(!Kalenteri::tarkistaKalenterinNimi($nimi)){
            naytaNakyma('kalenterinmuokkaus.php', array(kalenterit => $kalenterit, valittu => $paivita, virhe =>'Tarkista kalenterin nimi! Nimen tulee sisältää 1-24 merkkiä.'));
        }
        if(isset($_POST['julkinen'])){
            $julkinen = 1;
        } else{ $julkinen = 0;}
        if(isset($_POST['saajakaa'])){
            $saaJakaa = 1;
        } else{ $saaJakaa = 0;}
        Kalenteri::paivitaKalenteri((int)$paivita, $nimi, $julkinen, $saaJakaa);
    } else if(isset($poista)){
        Kalenteri::poistaKalenteri((int)$poista, $kayttaja);
    } else if(isset($jaa)){
        $onnistui = Kalenteri::jaaKalenteri($jaa, $kenelle);
        if($onnistui){
            $ilmo = 'Kalenteri jaettu onnistuneesti!';
            naytaNakyma('kalenterinmuokkaus.php', array(kalenterit => $kalenterit, valittu => $jaa , ilmo => $ilmo));
        } else {
            naytaNakyma('kalenterinmuokkaus.php', array(kalenterit => $kalenterit, valittu => $jaa , virhe =>
                'Jakaminen ei onnistunut. Tarkista, että käyttäjätunnus on oikein ja ettei käyttäjälle ole jo jaettu kalenteria-'));
        }
    }
    naytaNakyma('kalenterinmuokkaus.php', array(kalenterit => $kalenterit, valittu => $valittu, ilmo => $ilmo, paivita=>$paivita,poista => $poista));      
} else{
    header('Location:index.php');
}
