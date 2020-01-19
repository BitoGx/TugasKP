<?php

require_once __DIR__ . '/vendor/autoload.php';

//Mengambil variabel yang dibutuhkan

$mpdf = new \Mpdf\Mpdf();

$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->Output();
?>