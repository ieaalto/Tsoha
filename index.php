<?php
require_once 'libs/common.php';
require_once 'libs/models/kayttaja.php';

if(!onKirjautunut()){
    $tunnus = htmlspecialchars($_POST["tunnus"]);
    $salasana = htmlspecialchars($_POST["salasana"]);

    if(empty($tunnus)&&empty($salasana)){
        naytaNakyma('kirjautuminen.php',array(virhe => '', tunnus => NULL));
    } if(empty($tunnus)){
        naytaNakyma('kirjautuminen.php',array(virhe => 'Anna tunnus!', tunnus => NULL));
    } if(empty($salasana)){
        naytaNakyma('kirjautuminen.php',array(virhe => 'Anna salasana!', tunnus=>$tunnus));
    }
    
    $kayttaja = etsiKayttaja($tunnus,$salasana);

    if($kayttaja != null){
        $_SESSION['kayttaja'] = $kayttaja;    
        header('Location: merkinnat.php');
    } else{
        if(tunnusVapaa($tunnus)){        
            naytaNakyma('kirjautuminen.php', array(virhe => 'Väärä tunnus!'));
        }
        else{
            naytaNakyma('kirjautuminen.php',array(virhe => 'Väärä salasana!', tunnus=>$tunnus));  
        }
    }
} else{
    header('Location: merkinnat.php');
}