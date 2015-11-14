<H1>Command Pattern</H1>

<b>Command Pattern:</b><br />
<p><br />
- Head First Design Patterns<br /></p>

<b>What it means:</b><br />
<p></p>
<br /><br />

<form class="designActionForm" action="<?=$this->base_url?>design_patterns/command_xhr" method="get">
<label>Which slot do you wish to assign? </label>
<select name="slot">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
</select><br/>
<label>Which device do you wish to assign? </label>
<select name="device">
<option value="appliance_control">Appliance Control</option>
<option value="stereo">Stereo</option>
<option value="faucet_control">Faucet Control</option>
<option value="hot_tub">Hot Tub</option>
<option value="thermostat">Thermostat</option>
<option value="security_control">Security Control</option>
<option value="light">Light</option>
<option value="sprinkler">Sprinkler</option>
<option value="garden_light">Garden Light</option>
<option value="ceiling_fan">Ceiling Fan</option>
<option value="garage_door">Garage Door</option>
<option value="tv">TV</option>
<option value="ceiling_light">Ceiling Light</option>
<option value="outdoor_light">Outdoor Light</option>
</select><br />
<input type="hidden" name="action" value="assign" />
<button type="submit">Assign Slot</button>
</form>

<div id="commandDiv" class="contrast1">
<?php
for ($i=1;$i<8;$i++)
{
    $slot_label = "Slot " . $i . ":";
    if (isset($_SESSION["command_slot_label".$i]))
        $slot_label = $_SESSION["command_slot_label".$i];
?>

<span id="slot<?=$i?>_label" class="contrast2" ><?=$slot_label?></span>
 <a class="designAction" id="slot<?=$i?>_on" href="<?=$this->base_url?>design_patterns/command_xhr?slot=<?=$i?>&action=on">On</a>
 <a class="designAction" id="slot<?=$i?>_off" href="<?=$this->base_url?>design_patterns/command_xhr?slot=<?=$i?>&action=off">Off</a><br/><br />

<?php    
}
?>
</div>
<div id="resultsDiv" class="contrast1"></div>