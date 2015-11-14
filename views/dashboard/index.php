<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

You can only see this if you are logged in.

<br />

<form id="randomInsert" action="<?php echo $this->base_url;?>dashboard/xhr_insert" method="POST">
    <input type="text" name="text" />
    <button type="submit" value="submit">Add Listing</button>
</form>

<br />

<div id="listInserts"></div>
<div id="clearList" style="display: none;">
    <form id="truncate" action="/dashboard/xhr_truncate" method=POST>
      <button type="submit" value="submit">Clear Listings</button>
    </form>
</div>

<br />

<!--div id="colorChange">
    <form id="changeColorBtn" action="#" method=POST>
      <button type="submit" value="submit">Change Color</button>
    </form>
    <br />
    <a href="#">test link</a>
    <br />
    regular text
    <br />
    <br />
    <br />
</div-->