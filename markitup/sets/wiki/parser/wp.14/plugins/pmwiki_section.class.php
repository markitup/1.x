<?php

require_once(dirname(__FILE__) . '/../interface/startOfLine.interface.php');
require_once(dirname(__FILE__) . '/../interface/endOfFile.interface.php');

/*
 * Supporting Docs
 * http://www.pmwiki.org/wiki/PmWiki/MarkupMasterIndex
 */
class pmwiki_section implements startOfLine,  endOfFile
{
    const regular_expression = '/^(!{2,3})(.*?$)/i';
    private $sections = null;
        
    public function __construct()
    {
        $this->sections = array();
    }
    
    public function startOfLine($line) 
    {
        //So although were passed a line of text we might not actually need to do anything with it.
        return preg_replace_callback(pmwiki_section::regular_expression,array($this,'replace_callback'),$line);
    }
    
    private function replace_callback($matches)
    {
        $this->sections[] = trim(strip_tags($matches[2]));
        return '<h' . strlen($matches[1]) . '>' . $matches[2] . '</h' . strlen($matches[1]) . '>';
    }
    
    public function endOfFile($file_content) 
    {
        //(:toc:)
        $toc_html = "<ol>\n";
        
        foreach($this->sections as $section)
        {
            $toc_html .= "<li>" . $section . "</li>\n";
        }
        
        $toc_html .= "</ol>\n";
        
        return str_replace('(:toc:)', $toc_html, $file_content);
    }
    
}

?>