<?php
require 'libs/tietokantayhteys.php';
   
function etsiKayttaja($name, $passwd){
    $sql = "SELECT kayttajatunnus, salasana from kayttaja where kayttajatunnus = ? AND salasana = ? LIMIT 1";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($name, $passwd));
    $tulos = $kysely->fetchObject();
    
    if ($tulos == null) {
       return null;
    } else {
        return $tulos->kayttajatunnus;
    }
                
} 

function luoKayttaja($tunnus, $salasana){
    $sql = "insert into Kayttaja(kayttajatunnus, salasana) values(?, ?);";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($tunnus, $salasana));
}
    
function tunnusVapaa($name){
    $sql = "select kayttajatunnus from kayttaja where kayttajatunnus = ?";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($name));
        
    $tulos = $kysely->fetchObject();
    if ($tulos == null) {
         return true;
    }
        
    return false;
}
    

