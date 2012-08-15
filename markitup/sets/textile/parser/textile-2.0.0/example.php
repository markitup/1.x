<?php

// A simple example

require_once('classTextile.php');

$textile = new Textile();

$in = <<<EOF

A *simple* example.

EOF;

echo $textile->TextileThis($in);

// For untrusted user input, use TextileRestricted instead:
// echo $textile->TextileRestricted($in);


?>
