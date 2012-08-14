<?php

require_once(dirname(__FILE__) . '/../interface/startOfLine.interface.php');

class externallink implements startOfLine
{
    const regular_expression = '/(\[([^\]]*?)(\s+[^\]]*?)?\])/i';
    private $external_links = null;
    
    public function __construct()
    {
        $this->external_links = array();
    }
    
    public function startOfLine($line) 
    {
        //So although were passed a line of text we might not actually need to do anything with it.
        return preg_replace_callback(externallink::regular_expression,array($this,'replace_callback'),$line);
    }
    
    private function replace_callback($matches)
    {
        $url    = "";
        $title  = "";
        
        if(array_key_exists(2,$matches))
        {
            $url = $matches[2];
        }

        if(array_key_exists(3,$matches))
        {
            $title = $matches[3];
        }
        else
        {
            $this->external_links[] = $url;
            $title = "[" . count($this->external_links) . "]";
        }
        
        $config = wikiParser::getConfigINI();
        $default_format = '?><a href="<?php echo $url;?>" target="_blank"><?php echo $title;?></a>';

        if(array_key_exists('EXTERNAL_LINKS', $config) && array_key_exists('FORMATTED_URL', $config['EXTERNAL_LINKS']))
        {
            $default_format = '?>' . $config['EXTERNAL_LINKS']['FORMATTED_URL'];
        }
        
        ob_start();
        eval($default_format);
        $link_html = ob_get_contents();
        ob_end_clean();
        
        return $link_html;
    }
    
}

?>