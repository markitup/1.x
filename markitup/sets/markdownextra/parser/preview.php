<?php
include_once "markdown-extra.php";
$html = Markdown($_REQUEST['data']);
print $html;
?>
