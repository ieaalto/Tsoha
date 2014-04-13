<?php
require 'libs/common.php';
require 'libs/tietokantayhteys.php';
require 'libs/models/kalenteri.php';
require 'libs/models/merkinta.php';

if(onKirjautunut()){    
    $sivu = "muokkaamerkintaa_view.php";
    $kayttaja = $_SESSION['kayttaja'];
    $kalenterit = Kalenteri::haeKayttajanKalenterit($kayttaja); 
    if(!isset($_POST['laheta'])){
        $id = $_POST['merkinta'];
        $merkinta = Merkinta::haeMerkinta($id);
        $aihe = $merkinta->getAihe();
        $pvm = new DateTime($merkinta->getPvm());
        $p = $pvm->format('d');
        $k = $pvm->format('m');
        $v = $pvm->format('Y');  
        $klo = new DateTime($merkinta->getKlo());
        $h = $klo->format('H');
        $m = $klo->format('i');
        naytaNakyma($sivu, array(kalenterit=>$kalenterit, aihe=>$aihe, pp => $p, kk => $k, vv => $v, hh => $h, mm => $m, id => $id ));        
    } else {
        $id = $_POST['laheta'];
        $aihe = $_POST['aihe'];
        $pp = $_POST['pp'];
        $kk = $_POST['kk'];
        $vv = $_POST['vv'];
        $hh = $_POST['hh'];
        $mm = $_POST['mm'];
        $pvm = $vv."-".$kk."-".$pp;
        $klo = $hh.":".$mm;
        
        if(!tarkistaSyote($aihe, 32)){
            naytaNakyma($sivu, array(virhe => "Tarkista aihe! aihe saa olla enintään 32 merkkiä pitkä, eikä se saa sisältää erikoismerkkejä!", kalenterit=>$kalenterit, aihe=>$aihe, pp => $pp, kk => $kk, vv => $vv, hh => $hh, mm => $mm, id => $id  ));
        }        
        if(!checkdate($kk, $pp, $vv)){
            naytaNakyma($sivu, array(virhe => "Tarkista päivämäärä!", kalenterit=>$kalenterit, aihe=>$aihe, pp => $pp, kk => $kk, vv => $vv, hh => $hh, mm => $mm, id => $id  ));
        }
        if(!tarkistaKellonaika($hh, $mm)){
            naytaNakyma($sivu, array(virhe => "Tarkista kellonaika!", kalenterit=>$kalenterit, aihe=>$aihe, pp => $pp, kk => $kk, vv => $vv, hh => $hh, mm => $mm, id => $id  ));
        }
        
        Merkinta::muokkaaMerkintaa($id, $aihe, $klo, $pvm);
        header('Location: merkinnat.php');
    }
    
    
}else{
    header('Location:index.php');
}



