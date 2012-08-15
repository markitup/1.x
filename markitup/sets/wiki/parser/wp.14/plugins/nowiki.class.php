<?php

require_once(dirname(__FILE__) . '/../interface/preParsing.interface.php');
require_once(dirname(__FILE__) . '/../interface/postParsing.interface.php');

class nowiki implements preParsing, postParsing
{
    const remove_content_regular_expression = '/<nowiki>([\s\S]+?)<\/nowiki>/i';
    const replace_content_regular_expression = '/<nowiki><\/nowiki>/i';

    private $no_wiki_items = null;
    
    public function __construct()
    {
        $this->no_wiki_items = array();
    }
    
    public function preParsing($file_content)  
    {
        return preg_replace_callback(nowiki::remove_content_regular_expression,array($this,'remove_content'),$file_content);
    }

    private function remove_content($matches)
    {
        array_push($this->no_wiki_items,$matches[1]);
        return "<nowiki></nowiki>";        
    }
    
    public function postParsing($file_content) 
    {
        return preg_replace_callback(nowiki::replace_content_regular_expression,array($this,'replace_content'),$file_content);
    }

    private function replace_content($matches)
    {
        return array_shift($this->no_wiki_items);        
    }

}

?>