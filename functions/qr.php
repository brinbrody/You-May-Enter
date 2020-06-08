<?php
include('../vendor/phpqrcode/qrlib.php');
QRcode::png('http://brinbrody.com/You-May-Enter/functions/customer.php?userCode='.$_GET['id'].'_'.$_GET['name']);
?>