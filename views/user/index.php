<script>$(function(){get_users("<?=$this->base_url ?>user/")});</script>


<form action="<?=$this->base_url?>user/" method="post" name="new_user">
    <label>Username: </label><input type="text" name="user" id="user"/><br />
    <label>Email: </label><input type="text" name="email" id="email"/><br />
    <label>Password: </label><input type="password" name="password" id="password"/><br />
    <label>Confirm Password: </label><input type="password" name="password_confirm" id="password_confirm"/><br />
    <label>Birthdate: </label><input type="text" name="birthdate" id="birthdate"/><br />
    <input type="hidden" value="add" name="action" id="action"/>
    <button type="submit">Register</button>
</form>

<table id="usersTable" class="formatHack"></table>