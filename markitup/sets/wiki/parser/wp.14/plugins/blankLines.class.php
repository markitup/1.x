<?php

require_once(dirname(__FILE__) . '/../interface/startOfLine.interface.php');

class blankLines implements startOfLine
{
    public function startOfLine($line) 
    {
        if(trim($line) === "")
        {
            return "<br />";
        }
        else
        {
            return $line;
        }
    }
}

?>