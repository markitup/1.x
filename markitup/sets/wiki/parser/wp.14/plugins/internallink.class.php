<?php

require_once(dirname(__FILE__) . '/../interface/startOfLine.interface.php');

class internallink implements startOfLine
{
    const regular_expression = '/(\[\[(([^\]]*?)\:)?([^\]]*?)([\||\ ]([^\]]*?))?\]\]([a-z]+)?)/i';
    
    public function __construct()
    {
        
    }
    
    public function startOfLine($line) 
    {
        //So although were passed a line of text we might not actually need to do anything with it.
        return preg_replace_callback(internallink::regular_expression,array($this,'replace_callback'),$line);
    }
    
    private function replace_callback($matches)
    {
        //Url is in index 4
        $url        = $matches[4];
        $title      = "";
        $namespace  = "";
        
        if(array_key_exists(6, $matches) && $matches[6] !== "")
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
        
        if(array_key_exists(3, $matches))
        {
            $namespace = $matches[3];
        }
        
        //TODO: Image Namspace Support
        
        $config = wikiParser::getConfigINI();
        $default_format = '?><a href="http://localhost/wiki/index.php?<?php if($namespace != ""){?>namespace=<?php echo $namespace;?>&<?php }?>document_id=<?php echo $url;?>" target="_blank"><?php echo $title;?></a>';

        if(array_key_exists('INTERNAL_LINKS', $config) && array_key_exists('FORMATTED_URL', $config['INTERNAL_LINKS']))
        {
            $default_format = '?>' . $config['INTERNAL_LINKS']['FORMATTED_URL'];
        }
        
        ob_start();
        eval($default_format);
        $link_html = ob_get_contents();
        ob_end_clean();
        
        return $link_html;
    }
    
}

?>