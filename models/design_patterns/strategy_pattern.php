<?php

class duck
{
    public $quackBehaviour;
    public $flyBehaviour;
    
    public function __construct()
    {
        $this->quackBehaviour = new quack();
        $this->flyBehaviour = new flap();
    }
    
    public function display ()
    {
        return "No duck selected.";
    }
    
    public function quack ()
    {
        return $this->quackBehaviour->quack();
    }
    
    public function fly ()
    {
        return $this->flyBehaviour->fly();
    }
    
}

class mallard extends duck
{
    public function __construct()
    {
        $this->flyBehaviour = new flap();
        $this->quackBehaviour = new quack();
    }
    
    public function display()
    {
        return "Looks like a mallard duck.";
    }
}

class rubber extends duck
{
    public function __construct()
    {
        $this->flyBehaviour = new noFly();
        $this->quackBehaviour = new squeak();
    }    
    
    public function display()
    {
        return "Looks like a rubber duck.";
    }
}

class rocket extends duck
{
    public function __construct()
    {
        $this->flyBehaviour = new rockets();
        $this->quackBehaviour = new silent();
    }    
    
    public function display()
    {
        return "Looks like a rocket duck.";
    }
}

class decoy extends duck
{
    public function __construct()
    {
        $this->flyBehaviour = new noFly;
        $this->quackBehaviour = new quack();
    }    
    
    public function display()
    {
        return "Looks like a decoy duck.";
    }
}


class duckFactory
{
    public static function createDuck($type)
    {
        if ($type == "mallard")
            return new mallard();
        if ($type == "rubber")
            return new rubber();
        if ($type == "rocket")
            return new rocket();
        if ($type == "decoy")
            return new decoy();
    }
}

interface quackBehaviour
{
    public function quack();
}

class quack implements quackBehaviour
{
    public function quack()
    {
        return "Quack quack";
    }
}

class squeak implements quackBehaviour
{
    public function quack()
    {
        return "Squeak Squeak";
    }
}

class silent implements quackBehaviour
{
    public function quack()
    {
        return "...";
    }
}

interface flyBhaviour
{
    public function fly();
}

class flap implements flyBhaviour
{
    public function fly()
    {
        return "The duck flaps away";
    }
}

class rockets implements flyBhaviour
{
    public function fly()
    {
        return "The duck rockets away";
    }
}

class noFly implements flyBhaviour
{
    public function fly()
    {
        return "The duck cannot fly";
    }
}

?>
