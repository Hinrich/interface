<?php

$login = $_SESSION['zalogowany'];
$text= shell_exec("groups $login");
$wszyscy = split(" ", $text);
//echo $text;


//login użytkwnika
$text= shell_exec("finger $login");
$text2 = split("Login: ", $text);

$username = split("Name: ", $text2[1]);
//echo $username[0];

//ścieżka folderu domowego
$text = split("Directory: ", $username[1]);

$home= $text = split("Shell: ", $text[1]);
//echo $home[0];

$shell0 = split("On since ", $home[1]);
$shell1 = split("Last login ", $shell0[0]);
$shell2 = split("Never logged in.", $shell1[0]);
//echo $shell[0];

$lastlogin = split(" on pts",$shell1[1]);
//echo $lastlogin[0];
if($lastlogin[0]==null)
{
  $lastlogin[0]='Nigdy';
}
//echo $lastlogin[0];

echo "<table>";

echo "<tr> <td>Nazwa użytkownika: $username[0] </td></tr>";
echo "<tr> <td> Ścieżka folderu domowego: $home[0] </td></tr>";
echo "<tr> <td> Powłoka: $shell2[0] </td></tr>";
echo "<tr> <td> Ostatnio zalogowany: $lastlogin[0] </td></tr>";
echo "<tr><td>	Grupy w jakich obecnie sie znajdujesz to :\n</td><tr>";

for($i=2; $i <= count($wszyscy)-1 ; $i++)
{
	echo "<tr> <td> $wszyscy[$i] </td></tr>";
}
echo "</table>";



?>