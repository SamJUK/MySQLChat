<form id="registerForm" method="post" action="confirmation.php"> 
    <input id="user" name="user" type="text" placeholder="Username"></input>
    <input id="email" name="email" type="email" placeholder="Email" onblur="validateEmail(this)"></input>
    <input id="pass" name="pass" type="password" placeholder="Password"></input>
    <input id="submit" type="submit"></input>
</form>