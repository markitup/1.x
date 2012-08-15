<?php

class wikiParser
{
    private $parser_plugins = null;
    
    private static $config_ini     = null;
    
    public function __construct()
    {
        $this->parser_plugins = array();
        
        if(!is_dir(dirname(__FILE__) . '/plugins/'))
        {
            throw new Exception("Unable to Find:" . dirname(__FILE__) . '/plugins/');
        }
        
        $directory = opendir(dirname(__FILE__) . '/plugins/');
        
        if($directory === false)
        {
            throw new Exception("Unable to Read Directory:" . dirname(__FILE__) . '/plugins/');
        }
        
        $config = wikiParser::getConfigINI();
        $isEnabled = true;
        $plugin_list = array();
        
        if(array_key_exists('MAIN',$config) && array_key_exists('DEFAULT_MODE', $config['MAIN']) && strtoupper($config['MAIN']['DEFAULT_MODE']) == 'DISABLED')
        {
            $isEnabled = false;
        }
        
        if($isEnabled)
        {
            //So the Default is to enable plugins.
            if(array_key_exists('MAIN',$config) && array_key_exists('DISABLED_PLUGINS',$config['MAIN']) && is_array($config['MAIN']['DISABLED_PLUGINS']))
            {
                $plugin_list = $config['MAIN']['DISABLED_PLUGINS']; //List Of Disabled Plugins
            }
        }
        else
        {
            //So the defualt is to disable
            if(array_key_exists('MAIN',$config) && array_key_exists('ENABLED_PLUGINS',$config['MAIN']) && is_array($config['MAIN']['ENABLED_PLUGINS']))
            {
                $plugin_list = $config['MAIN']['ENABLED_PLUGINS']; //List Of Enabled Plugins
            }            
        }
        
        
        while(false !== ($file=readdir($directory))) 
        {
            if($file != "." && $file != ".." && $file != ".svn")
            {
                //Now we need to work out the class name.
                $class_name = explode(".",$file);
                $class_name = $class_name[0];

                //Ok Lets Check if it's enabled or disabled in the INI                
                if($isEnabled && !in_array($class_name, $plugin_list) || !$isEnabled && in_array($class_name, $plugin_list))
                {
                    //Defult Mode is Enabled and It's Not Expressly Disabled
                    //Or It's default is disabled but it's been enabled.
                    require_once(dirname(__FILE__) . '/plugins/' . $file);
                    $this->parser_plugins[] = new $class_name();
                }                
            }
        }
        closedir($directory);
    }
    
    public static function getConfigINI()
    {
        if(wikiParser::$config_ini === null)
        {
            wikiParser::$config_ini = parse_ini_file(dirname(__FILE__) ."/config.ini", true);
        }
        return wikiParser::$config_ini;
    }    
    
    public function parse($wiki_text)
    {
        //Parse Section
        //For each section on the config.ini
        $parser_order_config = wikiParser::getConfigINI();
        
        $file_parsing_order = $parser_order_config['FileParsingOrder'];
        ksort($file_parsing_order);
        
        foreach($file_parsing_order as $parsing_section_name)
        {
            if(strtoupper($parsing_section_name) == "LINE")
            {
                $line_parsing_order = $parser_order_config['LineParsingOrder'];
                ksort($line_parsing_order);
                
                $wiki_lines = explode("\n", $wiki_text);
                
                for($i = 0;$i < count($wiki_lines);$i++)
                {
                    foreach($line_parsing_order as $parsing_line_section_name)
                    {
                        $wiki_lines[$i] = $this->parseSection($parsing_line_section_name, $wiki_lines[$i]); 
                    }
                }
                
                $wiki_text = implode(PHP_EOL, $wiki_lines);
            }
            else
            {
                //Parse file
                $wiki_text = $this->parseSection($parsing_section_name, $wiki_text);
            }            
        }
        
        return $wiki_text;
    }

    // Ok this is fine for parse the whole file but not for each line.
    private function parseSection($section_name,$wiki_text)
    {        
        $parser_order_config = wikiParser::getConfigINI();
        $parser_order_int = array();
        
        foreach($parser_order_config[$section_name] as $priority => $plugin_name)
        {
            $parser_order_int[(int)$priority] = $plugin_name;
        }
        
        ksort($parser_order_int);
        
        foreach($parser_order_int as $priority => $plugin_name)
        {
            //Only Process those with a priority lower than 0
            if($priority > 0)
            {
                break;
            }
            
            foreach($this->parser_plugins as $plugin)
            {
                if($plugin instanceof $section_name && $plugin instanceof $plugin_name)
                {
                    $wiki_text = $plugin->$section_name($wiki_text);
                    break;
                }
            }                
        }
     
        //Process all the plugins we don't have a priority for (Equiv to them all having zero)
        $parsers = $this->parser_plugins;
        
        if(is_array($parser_order_config) && array_key_exists('ParsingDirection', $parser_order_config) && array_key_exists($section_name, $parser_order_config['ParsingDirection']) && strtolower($parser_order_config['ParsingDirection'][$section_name]) == 'reverse')
        {
            $parsers = array_reverse($this->parser_plugins);
        }
        
        foreach($parsers as $plugin)
        {
            if(!in_array(get_class($plugin), $parser_order_int) && $plugin instanceof $section_name)
            {
                //echo "Plugin Name:" . get_class($plugin) . " : " . $section_name . " : <-----\"" . $wiki_text . "\"----->\n\n"; 
                $wiki_text = $plugin->$section_name($wiki_text);                
            }
        }            
        
        foreach($parser_order_int as $priority => $plugin_name)
        {
            //Only Process those with a priority higher than 0
            if($priority <= 0)
            {
                continue;
            }
            
            foreach($this->parser_plugins as $plugin)
            {
                if($plugin instanceof $section_name && $plugin instanceof $plugin_name)
                {
                    $wiki_text = $plugin->$section_name($wiki_text);
                    break;
                }
            }                
        }
        return $wiki_text;
    }
        
}

?>