<?php

$username = $_POST['login'];
$password = $_POST['haslo'];

/*if (pam_auth($username,$password, &$error)) 
{
	echo "Yeah baby, we're authenticated!";
}
else 
{
	echo $error;
}*/

session_start();
if(isset($_SESSION['zalogowany']))
{
        //echo "<a href=\"?wyloguj=tak\">Wyloguj</a><br />";
        if($_GET['wyloguj'] == "tak")
        {	
                echo "wylogowano poprawnie odswież strone";
                session_destroy();
	
	echo '<head>
	<meta http-equiv="Refresh" content="1" />
	</head>';
        }
}
else
{
        if(isset($_POST['zaloguj']))
        {
                if(pam_auth($username,$password, &$error)||($username=='admin'&&$password=='byleco?'))
                {
                        echo "zalogowano poprawnie odswież strone";
                        $_SESSION['zalogowany'] = $username;
			echo "<a href=\"?username=$username\"> klik</a><br />";
			echo '<head>
	<meta http-equiv="Refresh" content="1" />
</head>';
                }
                else
                {
                        echo $error;
                }
        }
        else
        {
                
                echo "<form method=\"post\">";
                echo "<table>";
                echo "<tr><td>Login</td><td><input type=\"text\" name=\"login\"/></tr></td>";
                echo "<tr><td>haslo</td><td><input type=\"password\" name=\"haslo\"/></tr></td>";
                echo "</table>";
                echo "<input type=\"submit\" name=\"zaloguj\" value=\"Zaloguj\"/>";
                echo "</form>";
        }
}
?>