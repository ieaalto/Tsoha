<?php
require_once 'libs/common.php';
require_once 'libs/models/kayttaja.php';

if(!onKirjautunut()){
    $tunnus = htmlspecialchars($_POST["tunnus"]);
    $salasana = htmlspecialchars($_POST["salasana"]);
    $salasanauudelleen = htmlspecialchars($_POST["salasana2"]);

    if(empty($tunnus)&&empty($salasana)){
        naytaNakyma('rekisteroityminen_view.php',array(virhe => '', tunnus => NULL));
    } if(empty($tunnus)){
        naytaNakyma('rekisteroityminen_view.php',array(virhe => 'Anna tunnus!', tunnus => NULL));
    } if(empty($salasana)){
        naytaNakyma('rekisteroityminen_view.php',array(virhe => 'Anna salasana!', tunnus=>$tunnus));
    } if(empty($salasanauudelleen)){
        naytaNakyma('rekisteroityminen_view.php',array(virhe => 'Anna salasana uudelleen!', tunnus=>$tunnus));
    } if($salasana != $salasanauudelleen){
        naytaNakyma('rekisteroityminen_view.php', array(virhe => 'Salasanat eivät täsmää!', tunnus=>$tunnus));        
    } if(!tunnusVapaa($tunnus)){
        naytaNakyma('rekisteroityminen_view.php', array(virhe => 'Käyttäjätunnus on jo käytössä!', tunnus=>NULL));
    } if(!tarkistaSyote($tunnus, 24)){
        naytaNakyma('rekisteroityminen_view.php', array(virhe => 'Tunnus on liian pitkä!(max 24 merkkiä)', tunnus=>NULL));
    } if(!tarkistaSyote($salasana, 16) || tarkistaSyote($salasana, 7)){
        naytaNakyma('rekisteroityminen_view.php', array(virhe => 'Salasana ei kelpaa! Salasanan tulee olla 8-16 merkkiä pitkä.', tunnus=>$tunnus));
    } else {
        luoKayttaja($tunnus, $salasana);
        $_SESSION['kayttaja'] = $tunnus;
        header('Location: merkinnat.php');
    }

} else{
    header('Location: merkinnat.php');
}