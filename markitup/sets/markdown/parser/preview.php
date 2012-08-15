<?php
include_once "phpmarkdown-1.0.1o/markdown.php";
$html = Markdown($_REQUEST['data']);
print $html;
?>
