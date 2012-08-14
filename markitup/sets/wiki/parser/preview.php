<?php
require_once(dirname(__FILE__) . '/wp.14/wikiParser.class.php');
$d = $_POST['data'];
$test = new wikiParser();
echo ($test->parse($d))
?> 
