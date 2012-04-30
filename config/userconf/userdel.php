<?php
echo 'Podaj nazwe uzytkownika którego chcesz usunąć';
?>
<form method="post">
		   
		   <input type="text" name="pole3">
		   <input type="submit" value="usuń"> 
	      </form>
<?php
 	
	   $stala1 = 'sudo userdel ';
	   $stala2 = '| sudo rm -r /home/'; 
	   $nazwa = $_POST['pole3'];
	   $space =' ';
	   $escaped_nazwa=escapeshellarg($nazwa);

	   $allin=$stala1.$escaped_nazwa;
	   $allin=$allin.$space;
	   $allin=$allin.$stala2;
	   $allin=$allin.$escaped_nazwa;
	   if($nazwa!=null||$haslo!=null)
{
$last_line=system($allin,$retval);

if($retval==0)
{
echo 'poprawnie usunieto użytkownika wraz z jego folderem domowym';
}
elseif($retval==1)
{
echo 'podany użytkownik nie istanieje';
}	
else{
echo "wystąpil błąd podczas usuwania użytkownika $nazwa";
}
}

if($_GET['pole3']!=null){
include('usun.php');
}
?>

