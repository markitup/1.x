<?php

require_once(dirname(__FILE__) . '/../interface/startOfFile.interface.php');

/*
 * Supporting Docs
 * http://www.pmwiki.org/wiki/PmWiki/MarkupMasterIndex
 */
class pmwiki_cF_escapedCode implements startOfFile
{
    const regular_expression = '/\[@([\s\S]*)@\]/i'; ///(\[\+\+.*?\+\+\]|\[\+.*?\+\]|\[--.*?--\]|\[-.*?-\]|@@.*?@@)
        
    public function __construct()
    {

    }
    
    public function startOfFile($line) 
    {
        //So although were passed a line of text we might not actually need to do anything with it.
        return preg_replace_callback(pmwiki_cF_escapedCode::regular_expression,array($this,'replace_callback'),$line);
    }
    
    private function replace_callback($matches)
    {
        return '<pre>' . substr($matches[0],2,-2) . '</pre>';
    }
    
}

?>