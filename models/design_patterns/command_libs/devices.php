<?php

class appliance_control
{
    public function on ()
    {
        return "Appliance On<br/ >";
    }
    public function off()
    {
        return "Appliance Off<br />";
    }
}

class stereo
{
    public function on ()
    {
        return "Stereo On<br/ >";
    }
    public function off()
    {
        return "Stereo Off<br />";
    }
    public function set_cd()
    {
        return "Stereo Set CD<br />";
    }
    public function set_dvd()
    {
        return "Stereo Set DVD<br />";
    }
    public function set_radio()
    {
        return "Stereo Set Radio<br />";
    }
    public function set_volume()
    {
        return "Stereo Set Volume<br />";
    }
}

class faucet_control
{
    public function open_valve()
    {
        return "Faucet Open Valve<br />";
    }
    public function close_valve()
    {
        return "Faucet Close Valve<br />";
    }
}

class hot_tub
{
    public function circulate()
    {
        return "Hot Tub Circulate<br />";
    }
    public function jet_on()
    {
        return "Hot Tub Jet On<br />";
    }
    public function jet_off()
    {
        return "Hot Tub Jet Off<br />";
    }
    public function set_temperature($temp)
    {
        return "Hot Tub Set Temperature: ". $temp ."<br />";
    }
}

class thermostat
{
    public function set_thermostat($temp)
    {
        return "Thermostat Set: ".$temp."<br />";
    }
}

class ceiling_light
{
    public function on()
    {
        return "Ceiling Light On<br />";
    }
    public function off()
    {
        return "Ceiling Light Off<br />";
    }
    public function dim()
    {
        return "Ceiling Light Dim<br />";
    }
}

class outdoor_light
{
    public function on()
    {
        return "Outdoor Light On<br />";
    }
    public function off()
    {
        return "Outdoor Light Off<br />";
    }
}

class tv
{
    public function on()
    {
        return "TV On<br />";
    }
    public function off()
    {
        return "TV Off<br />";
    }
    public function set_input_channel()
    {
        return "TV Set Input Channel<br />";
    }
    public function set_volume()
    {
        return "TV Set Volume<br />";
    }
}

class ceiling_fan
{
    protected $speed;
    public function __construct()
    {
        // To implement correct make new set_speed() method and write to database
        // Then when construction query from database for value.
        
        if (!isset($this->speed))
            $this->speed = "off";
    }
    
    public function high()
    {
        $this->speed = "high";
        return "Ceiling Fan High<br />";
    }
    public function medium()
    {
        $this->speed = "medium";
        return "Ceiling Fan Medium<br />";
    }
    public function low()
    {
        $this->speed = "low";
        return "Ceiling Fan Low<br />";
    }
    public function off()
    {
        $this->speed = "off";
        return "Ceiling Fan Off<br />";
    }
    
    // get_speed function doesn't work Don't feel the need to implement a database table for 1 field in a piece of example code
    public function get_speed()
    {
        $this->speed;;
    }
}

class garden_light
{
    public function set_dusk_time()
    {
        return "Garden Light Set Dusk Time<br />";
    }
    public function set_dawn_time()
    {
        return "Garden Light Set Dawn Time<br />";
    }
    public function manual_on()
    {
        return "Garden Light Manual On<br />";
    }
    public function manual_off()
    {
        return "Garden Light Manual Off<br />";
    }
}

class garage_door
{
    public function up()
    {
        return "Garage Door Up<br />";
    }
    public function down()
    {
        return "Garage Door Down<br />";
    }
    public function stop()
    {
        return "Garage Door Stop<br />";
    }
    public function light_on()
    {
        return "Garage Door Light On<br />";
    }
    public function light_off()
    {
        return "Garage Door Light Off<br />";
    }
}

class sprinkler
{
    public function water_on()
    {
        return "Sprinkler Water On<br />";
    }
    public function water_off()
    {
        return "Sprinkler Water Off<br />";
    }
}

class light
{
    public function on()
    {
        return "Light On<br />";
    }
    public function off()
    {
        return "Light Off<br />";
    }
}

class security_control
{
    public function arm()
    {
        return "Security Control Arm<br />";
    }
    public function disarm()
    {
        return "Security Control Disarm<br />";
    }
}

?>
