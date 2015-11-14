<?php

    class road
    {
        function __construct($loc_a,$loc_b,$dist)
        {
            $this->loc_a = $loc_a;
            $this->loc_b = $loc_b;
            $this->dist = $dist;
        }

    }

    class traveling_salesman extends model
    {
        function __construct()
        {
            parent::__construct();
        
            $this->roads = new ArrayObject();
            $this->addRoad("a","b",1);
            $this->addRoad("a","d",1);
            $this->addRoad("a","f",1);
            $this->addRoad("b","d",1);
            $this->addRoad("b","e",1);
            $this->addRoad("c","e",1);
            $this->addRoad("d","f",1);
            $this->addRoad("e","f",1);
        }
        
        public function addRoad($loc_a,$loc_b,$dist)
        {
            $this->roads[count($this->roads)] = new road($loc_a,$loc_b,$dist);
        }
        
        public function &getRouteByJump($currLoc,$destLoc,$route)
        {
            // Create a copy of the object. This will allow concurrent objects 
            // identical origins.
            
            
            if (!isset($route))
                $route[0] = $currLoc;
            if ($currLoc == $destLoc)
                return $route;
            $neighbors =& $this->getNeighbors($currLoc);
            
            if (!isset($neighbors))
            {
                return NULL;
            }
            
            /* 
             * Iterate through each neighbor and recursively call the getRouteByJump
             * Ignore nodes already traveled to. When destination is reached pass the
             * route back to the caller. 
            */            
            for ($i = 0; $i < count($neighbors); $i++)
            {

                $branch = $route;
                if ($neighbors[$i] == $destLoc)
                {
                    $branch[count($branch)] = $neighbors[$i];
                    return $branch;
                }
                $new_node = true;
                for($ii = 0; $ii < count($branch); $ii++)
                {
                    if ($neighbors[$i] == $branch[$ii])
                        $new_node = false;
                }
                if ($new_node)
                {
                    $branch[count($branch)] = $neighbors[$i];
                    $new_route =& $this->getRouteByJump($neighbors[$i],$destLoc,$branch);
                    if (isset($new_route))
                        $routes[count($routes)] = $new_route;
                }
            }
            
            if (!isset($routes))
                return NULL;

            // Find the shortest route and return it.
            for ($i = 0; $i < count($routes); $i++)
            {
                if (isset($shortestRoute))
                {
                    if (count($routes[$i]) < count($shortestRoute))
                        $shortestRoute = $routes[$i];
                }
                else
                    $shortestRoute = $routes[$i];
            }
            return $shortestRoute;
        }
        
        private function &getNeighbors($loc)
        {
            $neighbors = new ArrayObject();
            for ($i = 0; $i < count($this->roads); $i++)
            {
                if ($loc == $this->roads[$i]->loc_a)
                {
                    $neighbors[count($neighbors)] = $this->roads[$i]->loc_b;
                }
                if ($loc == $this->roads[$i]->loc_b)
                {
                    $neighbors[count($neighbors)] = $this->roads[$i]->loc_a;
                }
                
            }
            return $neighbors;
        }
    }
    
        
    
?>
