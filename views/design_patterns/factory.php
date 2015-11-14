<H1>Factory Method Pattern</H1>

<b>Factory Method Pattern:</b><br />
<p>Defines an interface for creating an object, but lets subclasses decide which class to instantiate. Factory Method lets a class defer instantiation to subclasses.<br />
- Head First Design Patterns<br /></p>

<b>Abstract Factory Pattern:</b><br />
<p>Provides an interface for creating families of related or dependent objects without specifying their concrete classes.
- Head First Design Patterns<br /></p>

<b>What it means: </b><br />
<p>This implementation a factory method for the pizza style. It uses an abstract factory to create ingredient lists. Finally is uses the Simple factory methods was used for the creation of pizza stores. </p>
<br /><br />

<form action="<?=$this->base_url?>design_patterns/factory_xhr">
<label>Select a shop location</label><br />
    <input type="radio" name="pizza_store" value="ny" /> New York<br />
    <input type="radio" name="pizza_store" value="chi" /> Chicago<br />
<br />

<label>Select a pizza style</label><br />
    <input type="radio" name="pizza_type" value="cheese" /> Cheese<br />
    <input type="radio" name="pizza_type" value="pepperoni" /> Pepperoni<br />
    <input type="radio" name="pizza_type" value="hawaiian" /> Hawaiian<br />
<br />
<button name="submit">Order Pizza</button>
</form>

<div id="resultsDiv" class="contrast1"></div>