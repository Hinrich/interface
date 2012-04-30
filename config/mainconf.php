<script type="text/javascript" src="config/menu.js"></script>
<?php

//zmiany po ostatnim
//tabela userów
$macro=$_GET['macro'];
$who=$_GET['user'];

$text= shell_exec("ls /home");
$wszyscy = split("\n", $text);
//echo $text;

//lista makr
$dir = opendir('macros');
  while(false !== ($file = readdir($dir)))
    if($file != '.' && $file != '..') 
    $files=$files.$file;
  $filesNames = split(".txt", $files);

/********************************************************************************************************/
//menu zarządania
echo '<div id="lewy">
<dl>
<dt>Szczegóły użytkowników</dt>
<dd>
<dl>
<dt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>Lista użytkowników</a></dt>';
for($i=0; $i < count($wszyscy)-1 ; $i++)
{
	echo "<dd><a href=\"index.php?group=config&&user=$wszyscy[$i]\">$wszyscy[$i]</a> </dd>";
}
echo '<dt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?group=config&&list=add">dodaj</a></dt>
	<dt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?group=config&&list=delete">usun</a></dt>
</dl>
</dd>
<dt>Makra</dt>
  <dd>
  <dl>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>Lista makr</a></dt>';
 for($i=0; $i < count($filesNames)-1 ; $i++){
    echo "<dd><a href=\"index.php?group=config&&macro=$filesNames[$i]\">$filesNames[$i]</a> </dd>";
  }
echo '
<dt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?group=config&&list=send_macro">dodaj</a></dt>
<dt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?group=config&&list=delete_macro">usuń</a></dt>
</dl>
</dd>
</dl>

<div id="bottom"></div>
 </div>';
?>

<script type="text/javascript">
// <![CDATA[
new Menu('lewy');
// ]]>
</script>

<?php
//INFO O USERZE
/********************************************************************************************************/
//tabela grup
$login = $who;
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
if($who!=null){
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

}
/**************************************************************************/


//PODGLAD MAKRA

/************************************************************************/
if($macro!=null){
  $macro=$macro.".txt";
  $content = file("./macros/$macro");

  echo '<textarea "wartość" name="pole2" style="width: 600px; height: 500px;">';
	foreach($content as $value) { 
	  // rozbijamy poszczególne linie na części 
	  $exp = explode("`",$value); 
	  // wyświetlamy rozbity tekst 
	  echo $exp[0].$exp[1]; 
        
}
  echo "</textarea>";
}

// add user
if($_GET['list']==add){
include('userconf/useradd.php');
}



//usuwanie userow
elseif($_GET['list']==delete){
include('userconf/userdel.php');
}

//dodanie macra
elseif($_GET['list']==send_macro){
include('macro/send_macro.php');
}

//usunięcie macra
elseif($_GET['list']==delete_macro){
include('macro/delete_macro.php');
}

?>