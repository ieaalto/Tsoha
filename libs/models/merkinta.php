<?php
/*Merkinta-tauluun liittyvä malliluokka.
 */
class Merkinta{
    private $id;
    private $aihe;
    private $pvm;
    private $klo;
    
    function __construct($id, $aihe, $pvm, $klo) {
        $this->id = $id;
        $this->aihe = $aihe;
        $this->pvm = $pvm;
        $this->klo = $klo;        
    }
    
    /* Palauttaa arrayn muuttujan $kalenterit määrittelemiin kalentereihin liittyvistä merkinnistä. $kalenterit on array, joka sisältää kalentereiden 
     * tunnusluvut(kokonaislukuja), ei siis kalenteri-olioita. $aikavali on kokonaisluku 1-4.  
     */
    public static function haeMerkinnat($kalenterit, $aikavali){
        
        if(empty($kalenterit)){
            return array();
        }
        
        $valit = array( 1 => "pvm = current_date", 
                        2 => "pvm >= current_date and pvm <= current_date+interval '1 week'", 
                        3 => "pvm >= current_date and pvm <= current_date+interval '1 month'", 
                        4 =>  "pvm >= current_date");
        
        $ehto = "kalenteri = ? ";
        for( $i = 1; $i < count($kalenterit); $i++){
            $ehto = $ehto."or kalenteri = ? ";
        }
        
        $merkinnat = array();
        $sql = "select distinct id, aihe, to_char(pvm, 'DD.MM.YYYY') as pv, to_char(klo, 'HH24:MI') as kl, pvm, klo from merkinta, kalenterinmerkinta "
                    . "where merkinta = id and (".$ehto.") and ".$valit[$aikavali]." order by pvm, klo;";

        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute($kalenterit);
        $tulos = $kysely->fetchAll(PDO::FETCH_OBJ);
        foreach ($tulos as $rivi){
            $merkinnat[] = new Merkinta($rivi->id, $rivi->aihe, $rivi->pv, $rivi->kl);            
        }
        return $merkinnat;
    }
    /*Hakee merkinnän tunnusluvalla $id.
     */
    public static function haeMerkinta($id){
       $sql = "select aihe,  to_char(pvm, 'DD.MM.YYYY') as pv, klo from merkinta where id = ?";
       $kysely = getTietokantayhteys()->prepare($sql);
       $kysely->execute(array($id)); 
       $tulos = $kysely->fetchObject();
       return new Merkinta($id, $tulos->aihe, $tulos->pv, $tulos->klo);
        
    }
    /*Palauttaa ne kalenterit, joihin merkintää tunnuksella $id liittyy. Palautusarvo on array, jossa avaimena toimivat kalenterien tunnukset ja arvona 
     *totuusarvo.
     */
    public static function haeMerkinnanKalenterit($id){
       $sql = "select kalenteri from kalenterinmerkinta where merkinta = ?";
       $kysely = getTietokantayhteys()->prepare($sql);
       $kysely->execute(array($id)); 
       $tulos = $kysely->fetchAll(PDO::FETCH_OBJ);
       $kalenterit = array(); 
       foreach($tulos as $kalenteri){
           $kalenterit[$kalenteri->kalenteri] = true;
       }
       return $kalenterit; 
    }
    
    public static function poistaMerkinta($id){
        $yhteys = getTietokantayhteys();
        $sql = "delete from kalenterinmerkinta where merkinta = ?";
        $kysely = $yhteys->prepare($sql);
        $kysely->execute(array($id));
        
        $sql2 = "delete from merkinta where id = ?";
        $kysely2 = $yhteys->prepare($sql2);
        $kysely2->execute(array($id));
    }
    
    public static function luoMerkinta($aihe, $pvm, $klo, $kalenterit){
        $yhteys = getTietokantayhteys();
        $sql = "insert into merkinta(aihe, pvm, klo) values(?, ?, ?) ;";
        $kysely = $yhteys->prepare($sql);
        $kysely->execute(array($aihe,$pvm,$klo));
        
        $sql2 = "select max(id) as max from merkinta;";
        $kysely2 = $yhteys->prepare($sql2);
        $kysely2->execute();
        $max = $kysely2->fetchObject();
        $id = $max->max;
        
        $sql3 = "insert into kalenterinmerkinta(kalenteri, merkinta) values (?,?);";
        $kysely3 = $yhteys ->prepare($sql3);
        foreach($kalenterit as $kalenteri){            
            $kysely3->execute(array($kalenteri, $id));            
        }        
    }
    
    public static function muokkaaMerkintaa($id, $aihe, $klo, $pvm){
        $sql = "update merkinta set aihe = ?, klo = ?, pvm = ? where id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($aihe,$klo,$pvm,$id));
        
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getAihe(){
        return $this->aihe;
    }
    
    public function getPvm(){
        return $this->pvm;
    }
    
    public function getKlo(){
        return $this->klo;
    }
}
