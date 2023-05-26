<?php

header('Content-Type: image/png');
require_once 'vendor/autoload.php';

if(isset($_GET['text'])){

    $size = isset($_GET['size'])?$_GET['size']:200;
    $padding = isset($_GET['padding'])?$_GET['padding']:10;

    $qr = new Endroid\QrCode\QrCode();

    $qr->setText('http://kiampava.000webhostapp.com');
    $qr->setSize(200);
    $qr->setPadding(10);

    $qr->render();
}