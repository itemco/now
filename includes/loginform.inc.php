<!DOCTYPE html>
<form method="POST">
<head><title>AD-login</title></head>

<style>
* { font-family: Calibri, Tahoma, Arial, sans-serif; }

body {
text-align: center;
background: repeating-linear-gradient(-55deg, #eea236, #eea236 2px, #f0ad4e 2px, #f0ad4e 4px);
}

.errmsg {
color: red;
font-size: 90%;
}

#loginbox { font-size: 1em; }

.centered {
  position: fixed;
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%);
}

#box {
padding-top: 1em;
background-color: white;
  width: 20em;
  height: 12em;
-webkit-box-shadow: 0px 0px 10px 1px rgba(0,0,0,0.5);
-moz-box-shadow: 0px 0px 10px 1px rgba(0,0,0,0.5);
box-shadow: 0px 0px 10px 1px rgba(0,0,0,0.5);
border-radius: 5px 5px 5px 5px;
-moz-border-radius: 5px 5px 5px 5px;
-webkit-border-radius: 5px 5px 5px 5px;
}

table {
padding-top: 0.5em;
text-align: center;
position: fixed;
}

</style>

<body>

<div id="box" class="centered">
<div class="header"><img src="ad-login-pm-s.jpg"/></div>
<div class="content">
    <form id="login" method="post">
        <table width="100%">
            <tr>
                <td width="50%" align="right">Username:</td>
                <td width="50%" align="left"><input type="text" name="user" size="12" style="border: 1px solid #ccc;" autocomplete="off"/></td>
            </tr>
            <tr>
                <td width="50%" align="right">Password:</td>
                <td width="50%" align="left"><input type="password" name="pass" size="12" style="border: 1px solid #ccc;" autocomplete="off"/></td>
            </tr>
	    <tr>
                <td align="center" class="errmsg" colspan="2">&nbsp;<?php if(isset($error)) echo $error; ?>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2"><input class="button" type="submit" name="submit" value="Login" /></td>
            </tr>
          </table>
    </form>
</div>
</div>

</body>
</html>


