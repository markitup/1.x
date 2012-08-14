<?php

require_once(dirname(__FILE__) . '/../interface/startOfLine.interface.php');
require_once(dirname(__FILE__) . '/../interface/endOfLine.interface.php');

class pmwiki_linebreaks implements startOfLine, endOfLine
{
    const regular_expression = '/^[^\!](.*?)(\\{1,3}|)$/i';
    
    private $paragraph_open = false;
    
    public function __construct()
    {
        
    }
    
    public function startOfLine($line) 
    {
        if(preg_match(pmwiki_linebreaks::regular_expression, trim(strip_tags($line)),$matches) && trim($line) != "" && !$this->paragraph_open)
        {
            $this->paragraph_open = true;
            return "<p>" . $line;
        }
        
        return $line;
    }

    public function endOfLine($line)
    {
        if(preg_match(pmwiki_linebreaks::regular_expression, $line,$matches) && $this->paragraph_open)
        {
            $this->paragraph_open = false;
            return $line . "</p>";
        }
        
        return $line;
    }
    
}

?>