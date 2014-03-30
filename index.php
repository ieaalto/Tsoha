<?php
require_once 'libs/common.php';
require_once 'libs/models/kayttaja.php';

$tunnus = $_POST["tunnus"];
$salasana = $_POST["salasana"];

if(empty($tunnus)&&empty($salasana)){
    naytaNakyma('kirjautuminen.php',array(virhe => '', tunnus => NULL));
    exit();
}

if(empty($tunnus)){
    naytaNakyma('kirjautuminen.php',array(virhe => 'Anna tunnus!', tunnus => NULL));
    exit();
}

if(empty($salasana)){
    naytaNakyma('kirjautuminen.php',array(virhe => 'Anna salasana!', tunnus=>$tunnus));
    exit();
}
$kayttaja = etsiKayttaja($tunnus,$salasana);


if($kayttaja != null){
    $_SESSION['kayttaja'] = $kayttaja;    
    header('Location: merkinnat.php');
} else{
    if(tunnusVapaa($tunnus)){        
        header('Location: rekisteroityminen.php');
    }
    else{
        naytaNakyma('kirjautuminen.php',array(virhe => 'Väärä salasana! Jos yritit rekisteröityä, haluamasi tunnus on jo käytössä.', tunnus=>$tunnus));  
        exit();
    }
}
