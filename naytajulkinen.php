<?php
require 'libs/common.php';
require 'libs/tietokantayhteys.php';
require 'libs/models/kalenteri.php';
require 'libs/models/merkinta.php';

$id = $_GET['id'];
$sivu = "naytajulkinen_view.php";

if(isset($_POST["aikavali"])){
        $aikavali = $_POST["aikavali"];
} else {$aikavali = "4";}

$kalenteri = Kalenteri::haeKalenteriTunnuksella($id);
$merkinnat = Merkinta::haeMerkinnat(array($id), $aikavali);  

if($kalenteri != null && $kalenteri->getJulkinen()){
    naytaNakyma($sivu, array(merkinnat => $merkinnat, aikavali => $aikavali));    
} else {
    header('Location:julkinen.php');
}