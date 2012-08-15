<?php

require_once(dirname(__FILE__) . '/../interface/startOfLine.interface.php');

class lists implements startOfLine
{
    const regular_expression = '/^([\*\#]+)(.*?)$/i';
    private $current_lists = array();    
    
    public function __construct()
    {
        
    }
    
    public function startOfLine($line) 
    {
        $html = "";
        
        if (!preg_match(lists::regular_expression, $line)) 
        {
            $k = count($this->current_lists);
            
            for($i = 0;$i<$k;$i++)
            {
                $item = array_pop($this->current_lists);
                
                if($item === "#")
                {
                    $html .= "</ol>";
                }
                else
                {
                    $html .= "</ul>";
                }                
            }
        }
            
        return $html . preg_replace_callback(lists::regular_expression,array($this,'replace_callback'),$line);
    }
    
    private function replace_callback($matches)
    {
        //[1] is the list items.
        $list_items = str_split($matches[1]);
        
        $html = "";
        
        //If were too deep then step out.
        if(strlen($matches[1]) < count($this->current_lists))
        {
            $k = count($this->current_lists) - strlen($matches[1]);
            
            for($i = 0;$i<$k;$i++)
            {
                $item = array_pop($this->current_lists);
                
                if($item === "#")
                {
                    $html .= "</ol>";
                }
                else
                {
                    $html .= "</ul>";
                }                
            }
        }        
        
        foreach($list_items as $key => $value)
        {
            if(array_key_exists($key, $this->current_lists))
            {
                //The Array Exists But is it the right type?
                if(!$this->current_lists[$key] == $value)
                {
                    //It's the wrong type.
                    //We Need to Close The Existing Lists and Open A new one.
                    $tmp_current_items = count($this->current_lists);
                    for($k = $key;$k < $tmp_current_items;$k++)
                    {
                        $item = array_pop($this->current_lists);
                        
                        if($item === "#")
                        {
                            $html .= "</ol>";
                        }
                        else
                        {
                            $html .= "</ul>";
                        }
                    }                    
                }
            }
            else
            {
                //The item doesn't exist lets add it.
                if($value == "#")
                {
                    $html .= "<ol>";
                    $this->current_lists[] = '#';
                }
                else
                {
                    $html .= "<ul>";
                    $this->current_lists[] = '*';
                }
            }
        }
        
        
        return $html . "<li>" . $matches[2] . "</li>";
    }
        
}

?>