<?php
// A simple example
require_once('textile-2.0.0/classTextile.php');
$d = $_POST['data'];
$textile = new Textile();
echo $textile->TextileThis($d);
// For untrusted user input, use TextileRestricted instead:
// echo $textile->TextileRestricted($in);
?>
