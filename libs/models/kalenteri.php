<?php
/*
 * Kalenteri-tauluun liittyvä malliluokka.
 */
class Kalenteri{
    private $id;
    private $nimi;
    private $omistaja;
    private $julkisuus;
    private $saaJakaa;
    
    function __construct($kalenteri) {
        if($kalenteri != null){
            $this->id = $kalenteri->id;
            $this->nimi = $kalenteri->nimi;
            $this->omistaja = $kalenteri->omistaja;
            $this->julkisuus = $kalenteri->julkinen;
            $this->saaJakaa = $kalenteri->saajakaa;
        }
    }
    /*
     * Hakee kaikki käyttäjään $kayttaja liittyvä kalenterit. $kayttaja on käyttäjätunnus(merkkijono).
     */
    public static function haeKayttajanKalenterit($kayttaja){
        $kalenterit = array();
        $yhteys = getTietokantayhteys();
        
        $sql = "select kalenteri from kayttajankalenteri where kayttaja = ?";
        $kysely = $yhteys->prepare($sql);
        $kysely->execute(array($kayttaja));
        $tulos = $kysely->fetchAll(PDO::FETCH_OBJ);
        
        foreach($tulos as $id){
            $sql = "select * from kalenteri where id=?";
            $kysely = $yhteys->prepare($sql);
            $kysely->execute(array($id->kalenteri)); 
            $taulu = $kysely->fetchAll(PDO::FETCH_OBJ);
            foreach($taulu as $kalenteri){
                $kalenterit[] = new Kalenteri($kalenteri);
            }            
        }
        
        return $kalenterit;
    }
    /*
     * Hakee kalenterin tunnuksella $id.
     */
    public static function haeKalenteriTunnuksella($id){
        $sql = "select * from kalenteri where id=?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id)); 
        $tulos = $kysely->fetchObject();
        
        if($tulos == null){
            return null;
        }
        
        return new Kalenteri($tulos);
    }
    
    /*
     * Hakee kalenterin $id arraysta $kalenterit. Huom. ei käytä tietokantaa.
     */
    public static function haeKalenteri($kalenterit, $id){
        foreach($kalenterit as $k){
            if($k->getId() == $id){
                return $k;                
            }            
        }
    }
    
    public static function luoKalenteri($nimi, $julkinen, $saaJakaa, $omistaja){
        $yhteys = getTietokantayhteys();
        $sql = "insert into Kalenteri(nimi,omistaja,julkinen,saajakaa) values(?, ?, ?, ?);";
        $kysely = $yhteys->prepare($sql);
        $kysely->execute(array($nimi, $omistaja, $julkinen, $saaJakaa));
        
        $sql2 = "select max(id) as max from kalenteri;";
        $kysely2 = $yhteys->prepare($sql2);
        $kysely2->execute();
        $max = $kysely2->fetchObject();
        $id = $max->max;
        
        $sql3 = "insert into kayttajankalenteri(kayttaja, kalenteri) values(?, ?);";
        $kysely3 = $yhteys->prepare($sql3);
        $kysely3->execute(array($omistaja, $id));             
    }
    
    public static function paivitaKalenteri($id,$nimi,$julkinen,$saaJakaa){
        $yhteys = getTietokantayhteys();
        $sql = "update kalenteri set nimi=?, julkinen = ?, saajakaa = ? where id=?;";
        $kysely = $yhteys->prepare($sql);
        $kysely->execute(array($nimi, $julkinen, $saaJakaa, $id));
    }
    
    public static function kalenterinOmistaja($id){
        $yhteys = getTietokantayhteys();
        $sql = "select * from kalenteri where id=?";
        $kysely = $yhteys->prepare($sql);
        $kysely->execute(array($id));
        $tulos = $kysely->fetchObject();
        return $tulos->omistaja;
    }
    
    public static function poistaKalenteri($id, $kayttaja){
        $omistaja = Kalenteri::kalenterinOmistaja($id);
        $yhteys = getTietokantayhteys();
        
        if($omistaja == $kayttaja){
            $sql = "delete from kayttajankalenteri where kalenteri=?;";
            $kysely = $yhteys->prepare($sql);
            $kysely->execute(array($id));
            
            $sql2 = "delete from kalenterinmerkinta where kalenteri=?;";
            $kysely2 = $yhteys->prepare($sql2);
            $kysely2->execute(array($id));
            
            $sql3 = "delete from kalenteri where id=? and omistaja=?;";
            $kysely3 = $yhteys->prepare($sql3);
            $kysely3->execute(array($id, $kayttaja));
            
        } else {
            $sql = "delete from kayttajankalenteri where kalenteri=? and kayttaja=?;";
            $kysely = $yhteys->prepare($sql);
            $kysely->execute(array($id, $kayttaja));
        }
    }
    
    public static function jaaKalenteri($id, $kayttaja){
        try{
            $sql = "insert into KayttajanKalenteri(kalenteri, kayttaja) values(?, ?);";
            $kysely = getTietokantayhteys()->prepare($sql);
            $kysely->execute(array($id, $kayttaja));
            return true;
        } catch(PDOException $e){
            return false;
        }
    }
    /*
     * Palauttaa arrayn käyttäjistä, joihin kalenteri $id liittyy. $id on kalenterin tunnus(kokonaisluku). Palautus arvo array 
     * käyttäjätunnuksista(merkkijonoja).
     */
    public static function haeKalenterinKayttajat($id){
        $yhteys = getTietokantayhteys();
        $kayttajat = array();
        $sql = "select kayttaja from kayttajankalenteri where kalenteri  = ? ;";
        $kysely = $yhteys->prepare($sql);
        $kysely->execute(array($id));
        $tulos = $kysely->fetchAll(PDO::FETCH_OBJ);
        foreach($tulos as  $kayttaja){
            $kayttajat[] = $kayttaja->kayttaja;
        }
        return $kayttajat;
    }
    
    public function getNimi(){
        return $this->nimi;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getOmistaja(){
        return $this->omistaja;
    }
    
    public function getJulkinen(){
        return $this->julkisuus;
    }
    
    public function getSaaJakaa(){
        return $this->saaJakaa;
    }
}

