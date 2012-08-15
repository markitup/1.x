<?php

require_once(dirname(__FILE__) . '/../interface/startOfLine.interface.php');

class pmwiki_links implements startOfLine
{
    const regular_expression = '/(\[\[(([^\]]*?)\:)?([^\]]*?)(\|([^\]]*?))?\]\]([a-z]+)?)/i';
    const external_protocol_regular_expression = '/^\[\[(http|https|mailto|ftp).*$/i';
    
    public function __construct()
    {
        
    }
    
    public function startOfLine($line) 
    {
        //So although were passed a line of text we might not actually need to do anything with it.
        return preg_replace_callback(pmwiki_links::regular_expression,array($this,'replace_callback'),$line);
    }
    
    private function replace_callback($matches)
    {
        //Url is in index 4
        $url        = $matches[4];
        $title      = "";
        $namespace  = "main";
        
        if(array_key_exists(6, $matches))
        {
            $title = $matches[6];
        }
        else
        {
            $title = $url;
            if(array_key_exists(7, $matches))
            {
                $title .= $matches[7];
            }
        }
        
        $title = preg_replace('/\(.*?\)/','',$title);
        $title = preg_replace('/^.*?\:/','',$title);
        
        if(array_key_exists(3, $matches) && $matches[3] != "")
        {
            $namespace = $matches[3];
        }
        
        //Link Type
        //PMWIKI Formats Internal And external Links the same.
        //If the $url starts with a valid protocal then we'll guess it's internal.
        $isInternalLink = true;
        
        if (preg_match(pmwiki_links::external_protocol_regular_expression, $matches[0])) 
        {
            //External_link
            $isInternalLink = false;
        }
        
        $config = wikiParser::getConfigINI();
        $default_format = '?><a href="http://localhost/wiki/index.php?<?php if($namespace != ""){?>namespace=<?php echo $namespace;?>&<?php }?>document_id=<?php echo $url;?>" target="_blank"><?php echo $title;?></a>';

        if($isInternalLink)
        {
            //PMWIKI Internal links automacically have the spaces removed.
            $url = str_replace(" ", "", $url);
            //Strip any markup (incase the formatting has markup inside)
            $url = strip_tags($url);
            if(array_key_exists('INTERNAL_LINKS', $config) && array_key_exists('FORMATTED_URL', $config['INTERNAL_LINKS']))
            {
                $default_format = '?>' . $config['INTERNAL_LINKS']['FORMATTED_URL'];
            }
        }
        else
        {
            $url = $matches[2] . $url;
            if(array_key_exists('EXTERNAL_LINKS', $config) && array_key_exists('FORMATTED_URL', $config['EXTERNAL_LINKS']))
            {
                $default_format = '?>' . $config['EXTERNAL_LINKS']['FORMATTED_URL'];
            }            
        }
        
        ob_start();
        eval($default_format);
        $link_html = ob_get_contents();
        ob_end_clean();
        
        return $link_html;
    }
    
}

?>