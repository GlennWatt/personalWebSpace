<?php

class design_patterns extends http_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->view->js = array(VIEWS_DIR.'design_patterns/js/default.js');
    }
    
    public function index()
    {
        $this->view->render('design_patterns/index');
    }
    
    public function strategy()
    {
        $duckTypes = array(0=>'mallard',1=>'rubber',2=>'rocket',3=>'decoy');
        for($i=0;$i<count($duckTypes);$i++)
        {
            $this->view->ducksDisp[$i] = array(
                'type'=>$duckTypes[$i],
                'action'=> array(
                    0=>'quack',
                    1=>'fly',
                    2=>'display',
                ),
            );
        }
        $this->view->render('design_patterns/strategy');
    }
    
    public function strategy_xhr()
    {
        echo json_encode($this->model->strategy($_GET["type"],$_GET["action"]));
    }
    
    public function observer($action = null,$observer=null)
    {
        if (!$action)
            $this->view->observerDisp = $this->model->observer('');
        else if ($action=="register")
            $this->view->observerDisp = $this->model->observer('register',$observer);
        else if ($action=="remove") 
            $this->view->observerDisp = $this->model->observer('remove',$observer);
        else if ($action=="update") 
            $this->view->observerDisp = $this->model->observer('update');
        $this->view->js[count($this->view->js)] = VIEWS_DIR.'design_patterns/js/observer.js';
        $this->view->render("design_patterns/observer");
    }
    
    public function observer_xhr($action = null,$observer=null)
    {
        if (!$action)
            echo json_encode($this->model->observer(''));
        else if ($action=="register")
            echo json_encode( $this->model->observer('register',$observer));
        else if ($action=="remove") 
            echo json_encode( $this->model->observer('remove',$observer));
        else if ($action=="update") 
            echo json_encode( $this->model->observer('update'));
    }
    
    public function decorator()
    {
        $this->view->js[count($this->view->js)] = VIEWS_DIR.'design_patterns/js/decorator.js';
        $this->view->render("design_patterns/decorator");
    }
    
    public function decorator_xhr()
    {   
        $drink_order = $_POST["drink_order"];
        $drink_order = trim($drink_order,"'");
        echo json_encode($this->model->decorator(json_decode($drink_order)));
    }
    
    public function factory()
    {
        $this->view->js[count($this->view->js)] = VIEWS_DIR.'design_patterns/js/factory.js';
        $this->view->render("design_patterns/factory");
    }
    
    public function factory_xhr()
    {
        echo json_encode($this->model->factory($_POST["pizza_store"],$_POST["pizza_type"]));
    }

    public function singleton()
    {
        $this->view->singleton_data = $this->model->singleton();
        $this->view->render("design_patterns/singleton");
    }
    
    public function command()
    {
        $this->view->js[count($this->view->js)] = VIEWS_DIR.'design_patterns/js/command.js';
        $this->view->render("design_patterns/command");
    }
    
    public function command_xhr()
    {
        if ($_GET["action"] == "assign")
        {
            $res["label"] = $this->model->command($_GET["slot"],$_GET["action"],$_GET["device"]);
            $res["slot"] = $_GET["slot"];
        } else  {
            $res = $this->model->command($_GET["slot"],$_GET["action"]);
        }
        echo json_encode($res);
    }
}


?>
