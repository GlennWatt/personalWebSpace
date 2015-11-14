<?php

class subject extends design_patterns_model
{
    
    protected $subject;
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function register_observer($observer)
    {
        $query = "INSERT INTO observer_pattern (subject,observer) VALUES (:subject, :observer)";
        $pst = $this->db->prepare($query);
        $pst->execute(array(":subject"=>$this->subject,":observer"=>$observer));
    }
    
    public function remove_observer($observer)
    {
        $query = "DELETE FROM observer_pattern WHERE subject = :subject and observer = :observer";
        $pst = $this->db->prepare($query);
        $pst->execute(array(":subject"=>$this->subject, ":observer"=>$observer));
    }
    
    public function notify()
    {
        $rand = rand();
        foreach($this->get_observer_list() as $observer_name)
        {
            $observer = $this->observer_factory($observer_name["observer"]);
            $observer->update($this->get_time(),$rand);
        }
    }
    
    public function get_observer_list()
    {
        $query = "SELECT * FROM observer_pattern WHERE subject = :subject";
        $pst = $this->db->prepare($query);
        $pst->execute(array(":subject"=>$this->subject));
        return $pst->fetchall(PDO::FETCH_ASSOC);
    }
    
    public function get_time()
    {
        date_default_timezone_set("America/New_York");
        $time = strftime("%D %I:%M:%S",time());
        return "System default time - " . $time;
    }
    
    public function observer_factory($observer)
    {
        if ($observer == "thisGuy")
            return new thisGuy();
        else if ($observer == "thatGuy")
            return new thatGuy();
        else if ($observer == "thoseGals")
            return new thoseGals();
        else    
            return new observer();
    }
}

class observer extends design_patterns_model
{
    /*
     * The book implements this as 2 seperate interfaces. Since I am using a 
     * single data source and handling my true display in an MVC I'll be using 
     * this methodology to save some coding. Otherwise the classes implementing 
     * the interface would all carry the same code.
    */

    protected $observer;
    public function __construct()
    {
        parent::__construct();
    }
    public function update($time,$random_int)
    {
        $query = "SELECT * FROM ob_pattern_observer_object WHERE observer = :observer";
        $pst = $this->db->prepare($query);
        $pst->execute(array(":observer"=>$this->observer));
        if (count($pst->fetchall()) > 0)
        {
            $query = "UPDATE ob_pattern_observer_object SET ob_time= :ob_time, random_int = :random_int WHERE observer = :observer";
        }
        else
        {
            $query = "INSERT INTO ob_pattern_observer_object (ob_time,random_int,observer) VALUES (:ob_time,:random_int,:observer)";
        }
        $pst = $this->db->prepare($query);
        $pst->execute(array(":ob_time"=>$time,":random_int"=>$random_int,":observer"=>$this->observer));
    }
    
    public function display()
    {
        $query = "SELECT * FROM ob_pattern_observer_object WHERE observer = :observer";
        $pst = $this->db->prepare($query);
        $pst->execute(array(":observer"=>$this->displayElement));
        return $pst->fetchall(PDO::FETCH_ASSOC);
    }
}

class bigBen extends subject
{
    public function __construct() 
    {
        parent::__construct();
        $this->subject = "bigBen";
    }
    public function get_time() 
    {
        date_default_timezone_set("Europe/London"); 
        $time = strftime("%D %I:%M:%S",time());
        return "Big Ben Time - " . $time;
    }
    
}


class thatGuy extends observer
{
    public function __construct()
    {
        parent::__construct();
        $this->observer = 'thatGuy';
    }
}

class thisGuy extends observer
{
    public function __construct()
    {
        parent::__construct();
        $this->observer = 'thisGuy';
    }
}

class thoseGals extends observer
{
    public function __construct()
    {
        parent::__construct();
        $this->observer = 'thoseGals';
    }
}


?>
