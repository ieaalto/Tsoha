<?php
use Kayttaja;
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
    

