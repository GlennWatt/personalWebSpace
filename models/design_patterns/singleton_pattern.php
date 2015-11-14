<?php
class singleton
{
    protected static $singleton;
    protected $element;
    
    private function __construct($text)
    {
        $this->element = $text;
    }
    
    public static function get_instance($text)
    {
        if (!isset(singleton::$singleton))
        {
            singleton::$singleton = new singleton($text);
        }
        return singleton::$singleton;
    }
    
    public function get_element()
    {
        return $this->element;
    }
    
}
?>
