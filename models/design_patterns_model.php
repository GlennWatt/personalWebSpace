<?php

class design_patterns_model extends model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function strategy($duckType, $action)
    {
        require WEB_DIR . MODELS_DIR . "design_patterns/strategy_pattern.php";
        $duck = duckFactory::createDuck($duckType);
        return $duck->$action();
    }
    
    public function observer($action,$observer=null)
    {
        require WEB_DIR . MODELS_DIR . "design_patterns/observer_pattern.php";
        $subject = new bigBen();

        if ($action=='notify')
            $subject->notify;
        else if ($action=='register')
            $subject->register_observer ($observer);
        else if ($action=='remove')
            $subject->remove_observer ($observer);
        else if ($action=='update')
            $subject->notify ();
        return $this->observer_display_all($subject);
    }
    
    private function observer_display_all($subject)
    {
        $query = 'SELECT	ob.observer,	ob.ob_time,	ob.random_int,	CASE WHEN op.observer IS NOT NULL THEN "y" ELSE "n" END AS subscription_status FROM 	ob_pattern_observer_object ob		LEFT JOIN observer_pattern op ON op.observer = ob.observer';
        $pst = $this->db->query($query);
        $pst->execute();
        return $pst->fetchall(PDO::FETCH_ASSOC);
    }
    
    public function decorator($drink_order)
    {
        require WEB_DIR . MODELS_DIR . "design_patterns/decorator_pattern.php";
        switch ($drink_order->bev)
        {
            case "house_blend":
                $bev = new house_blend();
                break;
            case "dark_roast":
                $bev = new dark_roast();
                break;
            case "espresso":
                $bev = new espresso();
                break;
            case "decaf":
                $bev = new decaf();
                break;
        }
        
        for ($i=0;$i<count($drink_order->condiments);$i++)
        {
            switch($drink_order->condiments[$i])
            {
                case "latte":
                    $bev = new latte($bev);
                    break;
                case "mocha":
                    $bev = new mocha($bev);
                    break;
                case "espresso":
                    $bev = new espresso($bev);
                    break;
                case "decaf":
                    $bev = new decaf($bev);
                    break;                
            }
        }
        return $bev->get_descr() . "<br>Total: $" . $bev->cost();
    }
    
    public function factory($pizza_store,$pizza_type)
    {
        require WEB_DIR . MODELS_DIR . "design_patterns/factory_pattern.php";
        $store = simple_pizza_store_factory::simple_pizza_store_factory($pizza_store);
        return $store->order_pizza($pizza_type);
    }
    
    public function singleton()
    {
        require WEB_DIR . MODELS_DIR . "design_patterns/singleton_pattern.php";
        $singleton = singleton::get_instance("got 'em");
        $singleton = singleton::get_instance("try again");
        return $singleton->get_element();
    }
    
    public function command($slot,$action,$device=null)
    {
        require WEB_DIR . MODELS_DIR . "design_patterns/command_pattern.php";
        if (isset($device))
        {
            $device_obj = simple_device_command_factory::get_device_command($device);
            $_SESSION["command_slot".$slot] = serialize($device_obj);
            $_SESSION["command_slot_label".$slot] = $device_obj->name;
            return $device_obj->name;
        } else {
            if (isset($_SESSION["command_slot".$slot]))
            {
                $device_obj = unserialize($_SESSION["command_slot".$slot]);
                if ($action == "on")
                    $res = $device_obj->on();
                else if ($action == "off")
                    $res =  $device_obj->off();
                else
                    return null;
                return $res;
            }
            return "Please assign a device to slot " . $slot;
        }
    }
}

?>
