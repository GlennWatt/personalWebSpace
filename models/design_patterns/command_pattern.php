<?php

require WEB_DIR . MODELS_DIR . "design_patterns/command_libs/devices.php";

interface command
{
    public function __construct();
    public function on();
    public function off();
}

class appliance_control_command implements command
{
    protected $appliance;
    public $name;
    public function __construct() {
        $this->name = "Appliance Control";
        $this->appliance = new appliance_control();
    }
    
    public function on()
    {
        return $this->appliance->on();
    }
    public function off()
    {
        return $this->appliance->off();
    }
}

class stereo_command implements command
{
    protected $stereo;
    public $name;
    public function __construct()
    {
        $this->name = "Stereo";
        $this->stereo = new stereo();
    }
    
    public function on()
    {
        return $this->stereo->on();
    }
    
    public function off()
    {
        return $this->stereo->off();
    }
}

class faucet_control_command implements command
{
    protected $faucet_control;
    public $name;
    public function __construct()
    {
        $this->name = "Faucet Control";
        $this->faucet_control = new faucet_control();
    }
    
    public function on()
    {
        return $this->faucet_control->open_valve();
    }
    
    public function off()
    {
        return $this->faucet_control->close_valve();
    }
}

class hot_tub_command implements command
{
    protected $hot_tub;
    public $name;
    public function __construct() {
        $this->name = "Hot Tub";
        $this->hot_tub = new hot_tub();
    }
    
    public function on()
    {
        $output = $this->hot_tub->circulate();
        $output .= $this->hot_tub->jet_on();
        $output .= $this->hot_tub->set_temperature("soaking temp");
        return $output;
    }
    
    public function off()
    {
        $output = $this->hot_tub->jet_off();
        $output .= $this->hot_tub->set_temperature("resting temp");
        return $output;
    }
}

class thermostat_command implements command
{
    protected $thermostat;
    public $name;    
    public function __construct() {
        $this->name = "Thermostat";
        $this->thermostat = new thermostat();
    }
    
    public function on()
    {
        return $this->thermostat->set_thermostat("day time temp");
    }
    public function off()
    {
        return $this->thermostat->set_thermostat("night time temp");
    }
}

class security_control_command
{
    protected $security_control;
    public $name;
    public function __construct() {
        $this->name = "Security Control";
        $this->security_control = new security_control();
    }
    
    public function on()
    {
        return $this->security_control->arm();
    }
    public function off()
    {
        return $this->security_control->disarm();
    }
}

class light_command
{
    protected $light;
    public $name;
    public function __construct() {
        $this->name = "Light";
        $this->light = new light();
    }
    public function on()
    {
        return $this->light->on();
    }
    public function off()
    {
        return $this->light->off();
    }
}

class sprinkler_command
{
    protected $sprinkler;
    public $name;
    public function __construct() {
        $this->name = "Sprinker";
        $this->sprinkler = new sprinkler();
    }
    public function on()
    {
        return $this->sprinkler->water_on();
    }
    public function off()
    {
        return $this->sprinkler->water_off();
    }
}

class garden_light_command
{
    protected $garden_light;
    public $name;
    public function __construct() {
        $this->name = "Garden Light";
        $this->garden_light = new garden_light();
    }
    public function on()
    {
        return $this->garden_light->manual_on();
    }
    public function off()
    {
        return $this->garden_light->manual_off();
    }
}

class ceiling_fan_command
{
    protected $ceiling_fan;
    public $name;
    public function __construct() {
        $this->name = "Ceiling Fan";
        $this->ceiling_fan = new ceiling_fan();
    }
    public function on()
    {
        // I believe this code works correctly but the underlying get_speed function doesn't work
        // Don't feel the need to implement a database table for 1 field in a piece of example code
        switch($this->ceiling_fan->get_speed())
        {
            case "low": return $this->ceiling_fan->medium();
            case "medium": return $this->ceiling_fan->high();
            // default handles high and off
            default: return $this->ceiling_fan->low();
        }
    }
    public function off()
    {
        return $this->ceiling_fan->off();
    }
}

class garage_door_command
{
    protected $garage_door;
    public $name;
    public function __construct() {
        $this->name = "Garage Door";
        $this->garage_door = new garage_door();
    }
    public function on()
    {
        $output = $this->garage_door->light_on();
        $output .= $this->garage_door->up();
        // simulate wait
        $output .= "Wait 2 minutes<br />";
        $output .= $this->garage_door->light_off();
        return $output;
    }
    public function off()
    {
        $output = $this->garage_door->light_on();
        $output .= $this->garage_door->down();
        // simulate wait
        $output .= "Wait 2 minutes<br />";
        $output .= $this->garage_door->light_off();
        return $output;
    }
}

class tv_command
{
    protected $tv;
    public $name;
    public function __construct() {
        $this->name = "TV";
        $this->tv = new tv();
    }
    public function on()
    {
        return $this->tv->on();
    }
    public function off()
    {
        return $this->tv->off();
    }
}

class ceiling_light_command
{
    protected $ceiling_light;
    public $name;
    public function __construct() {
        $this->name = "Ceiling Light";
        $this->ceiling_light = new ceiling_light();
    }
    public function on()
    {
        $this->ceiling_light->on();
    }
    public function off()
    {
        $this->ceiling_light->off();
    }
}

class outdoor_light_command
{
    protected $outdoor_light;
    public $name;
    public function __construct() {
        $this->name = "Outdoor Light";
        $this->outdoor_light = new outdoor_light();
    }
    public function on()
    {
        $this->outdoor_light->on();
    }
    public function off()
    {
        $this->outdoor_light->off();
    }
}

class simple_device_command_factory
{
    public function __construct()
    {}
    
    public static function get_device_command($device_command)
    {
        switch ($device_command)
        {
            case "appliance_control":
                return new appliance_control_command();
            case "stereo":
                return new stereo_command();
            case "faucet_control":
                return new faucet_control_command();
            case "hot_tub":
                return new hot_tub_command();
            case "thermostat":
                return new thermostat_command();
            case "security_control":
                return new security_control_command();
            case "light":
                return new light_command();
            case "sprinkler":
                return new sprinkler_command();
            case "garden_light":
                return new garden_light_command();
            case "ceiling_fan":
                return new ceiling_fan_command();
            case "garage_door":
                return new garage_door_command();
            case "tv":
                return new tv_command();
            case "ceiling_light":
                return new ceiling_light_command();
            case "outdoor_light":
                return new outdoor_light_command();
        }
        return null;
    }
}


/*
 * 
 * public function test()
    {
        $appliance = new appliance_control();
        $stereo = new stereo();
        $faucet = new faucet_control();
        $hot_tub = new hot_tub();
        $thermo = new thermostat();
        $security = new security_control();
        $light = new light();
        $sprink = new sprinkler();
        $garden_light = new garden_light();
        $ceiling_fan = new ceiling_fan();
        $garage = new garage_door();
        $tv = new tv();
        $ceiling_light = new ceiling_light();
        $outdoor_light = new outdoor_light();
        
        $output = $appliance->on();
        $output .= $appliance->off();
        
        $output .= $stereo->on();
        $output .= $stereo->off();
        $output .= $stereo->set_cd();
        $output .= $stereo->set_dvd();
        $output .= $stereo->set_radio();
        $output .= $stereo->set_volume();
        
        $output .= $faucet->close_valve();
        $output .= $faucet->open_valve();
        
        $output .= $hot_tub->circulate();
        $output .= $hot_tub->jet_on();
        $output .= $hot_tub->jet_off();
        $output .= $hot_tub->set_temperature();
        
        $output .= $thermo->set_thermostat();
        
        $output .= $security->arm();
        $output .= $security->disarm();
                
        $output .= $light->off();
        $output .= $light->on();
        
        $output .= $sprink->water_off();
        $output .= $sprink->water_on();
        
        $output .= $garden_light->manual_off();
        $output .= $garden_light->manual_on();
        $output .= $garden_light->set_dawn_time();
        $output .= $garden_light->set_dusk_time();
        
        $output .= $ceiling_fan->get_speed();
        $output .= $ceiling_fan->high();
        $output .= $ceiling_fan->low();
        $output .= $ceiling_fan->medium();
        $output .= $ceiling_fan->off();
        
        $output .= $garage->light_off();
        $output .= $garage->light_on();
        $output .= $garage->up();
        $output .= $garage->down();
        $output .= $garage->stop();
        
        $output .= $tv->off();
        $output .= $tv->on();
        $output .= $tv->set_input_channel();
        $output .= $tv->set_volume();
        
        $output .= $ceiling_light->dim();
        $output .= $ceiling_light->off();
        $output .= $ceiling_light->on();
        
        $output .= $outdoor_light->off();
        $output .= $outdoor_light->on();
        
        return $output;
    }
 */
?>
