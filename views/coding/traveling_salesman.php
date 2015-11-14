
This is the traveling salesman problem.<br />
Use the last 2 directories in the URL to cannote the two nodes to travel between. 
For instance to go from <i>c</i> to <i>d</i> use the url <a href='<?=$this->base_url."coding/traveling_salesman/c/d"?>'><?=$this->base_url."coding/traveling_salesman/c/d"?></a>
<br /><br /><br />
<?php


if (isset($this->route))
{
    $output = "";
    for ($i = 0; $i < count($this->route); $i++)
    {
        if ($i > 0)
            $output .= " -> ";
        $output .= $this->route[$i];
    }
    echo "The shortest route between " . $this->beg . " and " . $this->end . " is: " . $output . "<br />";
}

echo "<img src ='" . $this->base_url . IMG_DIR . "coding/traveling_salesman.png' alt='Traveling Salesman Graph'>";

?>
