<H1>Observer Pattern</H1>

<b>The Observer Pattern:</b><br />
<p>Defines a one-to-many dependency between objects so that when on eobject changes state, all of its dependents are notified and updated automatically. <br />
- Head First Design Patterns<br /></p>

<b>What it means: </b><br />
<p>A subject class has a methods of maintaining a list of observer objects. These objects are called upon by the subject when needed. This is used in all subscription type scenarios.</p>
<p>My implementation of this pattern relies heavily on the database to simulate objects. As such the implementation isn't text book but I believe it still shows the major principles. Going a step further to create full-fledged PHP objects from the database models would provide the opportunity to handle everything at the php object layer but adds a lot of work without much reward.</p>
<p>The book pushes the idea of composition over inheritence. I'd like to come back to this and clean up some code to change the high level classes to interfaces in an effort to adhere to this concept. In addition the book utilized an additional interface to handle the display. Since I am already using a home cooked MVC to handle display I left this part out. 
<br /><br />

<table class="formatHack">
<tr>
<?php 
    for ($i=0; $i<count($this->observerDisp); $i++)
    {
        if ($i+1%3 == 0)
            echo "</tr></tr>";
?>
<td>
<h3><?=$this->observerDisp[$i]["observer"]?></h3>

<?php if ($this->observerDisp[$i]["subscription_status"] == "y"): ?>
<a class="observerAction" id="<?=$this->observerDisp[$i]["observer"]?>Subscribe" href="<?=$this->base_url?>design_patterns/observer_xhr/remove/<?=$this->observerDisp[$i]["observer"]?>">Unsubscribe</a><br />
<?php else: ?>
<a class="observerAction" id="<?=$this->observerDisp[$i]["observer"]?>Subscribe" href="<?=$this->base_url?>design_patterns/observer_xhr/register/<?=$this->observerDisp[$i]["observer"]?>">Subscribe</a><br />
<?php endif ?>
Time: <span id="<?=$this->observerDisp[$i]["observer"]?>Time"><?=$this->observerDisp[$i]["ob_time"]?></span><br />
Number: <span id="<?=$this->observerDisp[$i]["observer"]?>Num"><?=$this->observerDisp[$i]["random_int"]?><br />


</td>
<?php


    }
?>
</tr>
</table>

<a class="observerAction" href="<?=$this->base_url?>design_patterns/observer_xhr/update">Update Time</a>


<div id="resultsDiv"></div>