<?php
session_start();

function naytaNakyma($sivu, $data = array()) {
    $data = (object)$data;
    require 'views/pohja.php';
    exit();
}

function onKirjautunut(){
    if (isset($_SESSION['kayttaja'])) {
        return true;
    } else {
        return false;
    }
}