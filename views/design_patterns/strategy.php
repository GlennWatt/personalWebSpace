<H1>Strategy Pattern</H1>

<b>The Strategy Pattern:</b><br />
Defines a family of algorithms, encapsulates one, and makes them interchangeable. Strategy lets the algorithm vary independently from clients that us it.<br />
- Head First Design Patterns<br /><br /><br />

<b>What it means:</b><br />
All ducks types inherit from duck. All ducks may be called on to quack or fly or display. Quack and Fly have shared version and unique versions. These behaviours are encapsulated. Display is unique for each duck so it is implemented on the sub-class level.
<br /><br />

<table class="formatHack">
<tr>
<?php
for ($i = 0; $i < count($this->ducksDisp); $i++)
{
    if ($i % 3 == 0)
        echo "</tr><tr>";
    echo "<td>";
    
    $type = $this->ducksDisp[$i]['type'];
    echo $type . " options <br />";
    for ($ii=0;$ii<count($this->ducksDisp[$i]['action']);$ii++)
    {
        $action = $this->ducksDisp[$i]['action'][$ii];
        echo "<a class='designAction' href='".$this->base_url."design_patterns/strategy_xhr?type=".$type."&action=".$action."'>".$action."</a><br />";
    }
    echo "<br /><br />";
    echo "</td>";
}
?>
</tr>
</table>
<div id="resultsDiv" class="contrast1"></div>
