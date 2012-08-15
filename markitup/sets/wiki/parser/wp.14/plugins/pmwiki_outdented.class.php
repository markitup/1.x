<?php

require_once(dirname(__FILE__) . '/../interface/startOfLine.interface.php');
require_once(dirname(__FILE__) . '/../interface/endOfLine.interface.php');

class pmwiki_outdented implements startOfLine, endOfLine
{
    const regular_expression = '/^-\</i';
    private $enabled = false;
    
    public function __construct()
    {
        
    }
    
    public function startOfLine($line) 
    {
        return preg_replace_callback(pmwiki_outdented::regular_expression,array($this,'replace_callback'),$line);
    }
    
    private function replace_callback($matches)
    {
        $this->enabled = true;
        return "<div class=\"outdent\">" . substr($matches[0],2);
    }
    
    public function endOfLine($line_of_text) 
    {
        if($this->enabled)
        {
            $this->enabled = false;
            return $line_of_text . "</div>";
        }
        else
        {
            return $line_of_text;
        }
    }
        
}

?>