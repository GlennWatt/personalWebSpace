<?php

abstract class ingredients
{
    protected $ingredient;
    public function __construct() {
    }
    
    public function get_ingredient()
    {
        return $this->ingredient;
    }
}
class mozzerella_cheese extends ingredients
{
    public function __construct() {
        parent::__construct();
        $this->ingredient = "Add Mozzerella Cheese<br />";
    }
}
class reggiano_cheese extends ingredients
{
    public function __construct() {
        parent::__construct();
        $this->ingredient = "Add Reggiano Cheese<br />";
    }
}
class marinara_sauce extends ingredients
{
    public function __construct() {
        parent::__construct();
        $this->ingredient = "Add Marinara Sauce<br />";
    }
}
class rich_marinara_sauce extends ingredients
{
    public function __construct() {
        parent::__construct();
        $this->ingredient = "Add Rich Marinara Sauce<br />";
    }
}
class thick_crust extends ingredients
{
    public function __construct() {
        parent::__construct();
        $this->ingredient = "Add Thick Crust<br />";
    }
}
class thin_crust extends ingredients
{
    public function __construct() {
        parent::__construct();
        $this->ingredient = "Add Thin Crust<br />";
    }
}
class pepperoni extends ingredients
{
    public function __construct() {
        parent::__construct();
        $this->ingredient = "Add Pepperoni<br />";
    }
}
class sausage extends ingredients
{
    public function __construct() {
        parent::__construct();
        $this->ingredient = "Add Sausage<br />";
    }
}
class pineapple extends ingredients
{
    public function __construct() {
        parent::__construct();
        $this->ingredient = "Add Pineapple<br />";
    }
}
class bacon extends ingredients
{
    public function __construct() {
        parent::__construct();
        $this->ingredient = "Add Bacon<br />";
    }
}
class canadian_bacon extends ingredients
{
    public function __construct() {
        parent::__construct();
        $this->ingredient = "Add Canadian Bacon</br />";
    }
}
class green_pepper extends ingredients
{
    public function __construct() {
        parent::__construct();
        $this->ingredient = "Add Green pepper<br />";
    }
}

interface ingredients_factory
{
    public function create_dough();
    public function create_sauce();
    public function create_cheese();
    public function create_pineapple();
    public function create_bacon();
    public function create_pepperoni();
}
class ny_pizza_ingredient_factory implements ingredients_factory
{
    public function create_dough() {
        $crust = new thin_crust();
        return $crust->get_ingredient();
    }
    public function create_sauce(){
        $sauce = new marinara_sauce();
        return $sauce->get_ingredient();
    }
    public function create_cheese()
    {
        $cheese = new reggiano_cheese();
        return $cheese->get_ingredient();
    }
    public function create_pineapple()
    {
        $pineapple = new pineapple();
        return $pineapple->get_ingredient();
    }
    public function create_bacon()
    {
        $bacon = new bacon();
        return $bacon->get_ingredient();
    }
    public function create_pepperoni()
    {
        $pepperoni = new pepperoni();
        return $pepperoni->get_ingredient();
    }
}
class chi_pizza_ingredient_factory implements ingredients_factory
{
    public function create_dough() {
        $crust = new thick_crust();
        return $crust->get_ingredient();
    }
    public function create_sauce(){
        $sauce = new rich_marinara_sauce();
        return $sauce->get_ingredient();
    }
    public function create_cheese()
    {
        $cheese = new mozzerella_cheese();
        return $cheese->get_ingredient();
    }
    public function create_pineapple()
    {
        $pineapple = new pineapple();
        return $pineapple->get_ingredient();
    }
    public function create_bacon()
    {
        $bacon = new canadian_bacon();
        return $bacon->get_ingredient();
    }
    public function create_pepperoni()
    {
        $pepperoni = new pepperoni();
        return $pepperoni->get_ingredient();
    }
}

abstract class pizza_factory
{
    protected $ingredient_factory;
    
    public function __construct()
    {
    }
    
    public abstract function prepare();
    
    public function bake()
    {
        return "Bake for 25 minutes at 350*<br />";
    }
    
    public function cut()
    {
        /* This is pretty hackey, but the books code didn't cover this case.
         * I considered a refactor but there were not enough cases to warrant
         * it for this example.                                             */
        if (is_a($this->ingredient_factory,"chi_pizza_ingredient_factory"))
                return "Cutting the pizza into squares<br />";
        return "Cutting the pizza into diagonal slices<br />";
    }
    
    public function box()
    {
        return "Place pizza in official PizzaStore box<br />";
    }
}
class cheese_pizza extends pizza_factory
{
    public function __construct(ingredients_factory $ingredient_factory) {
        parent::__construct();
        $this->ingredient_factory = $ingredient_factory;
    }
    
    public function prepare()
    {
        
        $output = $this->ingredient_factory->create_dough();
        $output .= $this->ingredient_factory->create_sauce();
        $output .= $this->ingredient_factory->create_cheese();
        return $output;
    }
}
class pepperoni_pizza extends pizza_factory
{
    public function __construct(ingredients_factory $ingredient_factory) {
        parent::__construct();
        $this->ingredient_factory = $ingredient_factory;
    }
    
    public function prepare()
    {
        $output = $this->ingredient_factory->create_dough();
        $output .= $this->ingredient_factory->create_sauce();
        $output .= $this->ingredient_factory->create_cheese();
        $output .= $this->ingredient_factory->create_pepperoni();
        return $output;
    }
}
class hawaiian_pizza extends pizza_factory
{
    public function __construct(ingredients_factory $ingredient_factory) {
        parent::__construct();
        $this->ingredient_factory = $ingredient_factory;
    }
    
    public function prepare()
    {
        $output = $this->ingredient_factory->create_dough();
        $output .= $this->ingredient_factory->create_sauce();
        $output .= $this->ingredient_factory->create_cheese();
        $output .= $this->ingredient_factory->create_pineapple();
        $output .= $this->ingredient_factory->create_bacon();
        return $output;
    }
}

abstract class pizza_store
{
    protected $ingredient_factory;
    
    public function __construct()
    {
    }
    
    public abstract function create_pizza($pizza_type);
    
    public function order_pizza($pizza_type)
    {
        $pizza = $this->create_pizza($pizza_type);
        $output = $pizza->prepare();
        $output .= $pizza->bake();
        $output .= $pizza->cut();
        $output .= $pizza->box();
        return $output;
    }
}
class ny_pizza_store extends pizza_store
{
    public function __construct() {
        parent::__construct();
        $this->ingredient_factory = new ny_pizza_ingredient_factory();
    }
    
    public function create_pizza($pizza_type)
    {
        switch ($pizza_type)
        {
            case "cheese":
                return new cheese_pizza($this->ingredient_factory);
            case "pepperoni":
                return new pepperoni_pizza($this->ingredient_factory);
            case "hawaiian":
                return new hawaiian_pizza($this->ingredient_factory);
        }
    }
}
class chi_pizza_store extends pizza_store
{
    public function __construct() {
        parent::__construct();
        $this->ingredient_factory = new chi_pizza_ingredient_factory();
    }
    
    public function create_pizza($pizza_type)
    {
        switch ($pizza_type)
        {
            case "cheese":
                return new cheese_pizza($this->ingredient_factory);
            case "pepperoni":
                return new pepperoni_pizza($this->ingredient_factory);
            case "hawaiian":
                return new hawaiian_pizza($this->ingredient_factory);
        }
    }
}

class simple_pizza_store_factory
{
    public function __construct() {
        ;
    }
    public static function simple_pizza_store_factory ($store_type)
    {
        switch ($store_type)
        {
            case "ny":
                return new ny_pizza_store();
            case "chi":
                return new chi_pizza_store();
        }
    }
}

?>
