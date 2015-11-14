<?php

// The example used in the book is a starbucks program. I'll use the same drink model as the book uses.
abstract class beverage
{
    protected $descr = "Unknown Beverage";
    
    public function get_descr()
    {
        return $this->descr;
    }
    
    public abstract function cost();
}

abstract class condiment_decorator extends beverage
{
    //public abstract function get_descr();
}

class espresso extends beverage
{
    public function __construct()
    {
        $this->descr = 'Espresso : 1.99';
    }
    
    public function cost()
    {
        return 1.99;
    }
}

class dark_roast extends beverage
{
    public function __construct()
    {
        $this->descr = 'Dark Roast : .99';
    }
    
    public function cost()
    {
        return .99;
    }
}

class house_blend extends beverage
{
    public function __construct()
    {
        $this->descr = 'House Blend : .89';
    }
    
    public function cost()
    {
        return .89;
    }
}

class decaf extends beverage
{
    public function __construct()
    {
        $this->descr = 'Decaf : 1.05';
    }
    
    public function cost()
    {
        return 1.05;
    }
}

class mocha extends condiment_decorator
{
    protected $bev;
    public function __construct(beverage $bev)
    {
        $this->descr = '<br>Mocha : .20';
        $this->bev = $bev;
    }

    public function get_descr()
    {
        return $this->bev->get_descr() . $this->descr;
    }
    
    public function cost()
    {
        return .20 + $this->bev->cost();
    }
}

class latte extends condiment_decorator
{
    protected $bev;
    public function __construct(beverage $bev)
    {
        $this->descr = '<br>Latte : .10';
        $this->bev = $bev;
    }
    
    public function get_descr()
    {
        return $this->bev->get_descr() . $this->descr;
    }
    
    public function cost()
    {
        return .10 + $this->bev->cost();
    }
}

class soy extends condiment_decorator
{
    protected $bev;
    public function __construct(beverage $bev)
    {
        $this->descr = '<br>Soy : .15';
        $this->bev = $bev;
    }
    
    public function cost()
    {
        return .15 + $this->bev->cost();
    }
}

class whip extends condiment_decorator
{
    protected $bev;
    public function __construct(beverage $bev)
    {
        $this->descr = '<br>Whip : .10';
        $this->bev = $bev;
    }
    
    public function cost()
    {
        return .10 + $this->bev->cost();
    }
}

?>
