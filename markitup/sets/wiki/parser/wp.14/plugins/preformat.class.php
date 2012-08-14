<?php

require_once(dirname(__FILE__) . '/../interface/startOfLine.interface.php');

class preformat implements startOfLine
{
    const regular_expression = '/^\s(.*?)$/i';
        
    public function __construct()
    {
        
    }
    
    public function startOfLine($line) 
    {
        //So although were passed a line of text we might not actually need to do anything with it.
        return preg_replace_callback(preformat::regular_expression,array($this,'replace_callback'),$line);
    }
    
    private function replace_callback($matches)
    {
        if(trim($matches[1]) == '')
        {
            return;
        }
        else
        {
            return '<pre>' . $matches[1] . '</pre>';
        }
    }
    
}

?>