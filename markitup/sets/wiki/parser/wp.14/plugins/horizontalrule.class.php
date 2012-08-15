<?php

require_once(dirname(__FILE__) . '/../interface/startOfLine.interface.php');

class horizontalrule implements startOfLine
{
    const regular_expression = '/^----(\s*)$/';
        
    public function __construct()
    {
        
    }
    
    public function startOfLine($line) 
    {
        return preg_replace_callback(horizontalrule::regular_expression,array($this,'replace_callback'),$line);
    }
    
    private function replace_callback($matches)
    {
        return '<hr/>';
    }
    
}

?>
