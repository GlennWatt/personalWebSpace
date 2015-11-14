<H1>Decorator Pattern</H1>

<b>The Decorator Pattern:</b><br />
<p>Attaches additional responsibilities to an object dynamically. Decorators provide a flexible alternative to subclassing for extending functionality.<br />
- Head First Design Patterns<br /></p>

<b>What it means: </b><br />
<p>Take a given class and add to it by recursively calling decorators of the same super class.</p>
<br /><br />

<form id="drink_order" action="#">
<label>Coffee flavor: </label>
<input type=radio name="bev" value="house_blend" />House Blend  
<input type=radio name="bev" value="dark_roast" />Dark Roast  
<input type=radio name="bev" value="espresso" />Espresso  
<input type=radio name="bev" value="decaf" />Decaf  
<div id="condiments">
<label>Condiment 1: </label>
<input type=radio name="condiment0" value="mocha" />Mocha  
<input type=radio name="condiment0" value="latte" />Latte  
<input type=radio name="condiment0" value="soy" />Soy  
<input type=radio name="condiment0" value="whip" />Whip  
</div>
</form>
<a href="#" id="addCondiment">Add Condiment</a>
<br /><br />
<a id="decoratorSubmit" href="<?=$this->base_url?>design_patterns/decorator_xhr">Place Order</a>
<div class="contrast1" align="right" id="results"></div>