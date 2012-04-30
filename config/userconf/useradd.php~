<?php
?>
<form method="post">
<div id="prawy">
    <p> 
	   <label for="input_nazwa">Nazwa</label>	
	   <input id="input_nazwa" type="text" name="pole1">
    </p>
    <p>
	   <label for="input_haslo">Haslo</label>
	   <input id="input_haslo" type="password" name="pole2">
    </p>

    <p>
	  <label for="input_group" >Opcjonalne grupy</label>    
	  <input id="input_group" type="checkbox" name="nazwa" onclick="this.form.elements['grupa'].disabled = !this.checked"/>
	  <input type="text" name="grupa" disabled="disabled" />
    </p>

    <ul>
	   <input type="submit" value="dodaj">
    </ul>
  </div>
</form>


<?php

  if($_POST['pole1']!=null&&$_POST['pole2']!=null)
{
	   $grupa = $_POST['grupa'];
	    if($grupa==null){
		$stala1 = "sudo useradd -m -s /bin/bash ";
	      }
    
	     else{
	   $addgrp="-G $grupa";
	   $stala1 = "sudo useradd -m -s /bin/bash $addgrp ";
	      }

	   $nazwa = $_POST['pole1'];
	   $haslo = $_POST['pole2'];
	   $escaped_nazwa=escapeshellarg($nazwa);
	   $escaped_haslo=escapeshellarg($haslo);
	   $allin=$stala1.$escaped_nazwa;
	   if($nazwa!=null||$haslo!=null)

{
$last_line=system($allin,$retval);
if($retval==0)
{
echo 'poprawnie dodano użytkownika';
}	
elseif($retval==9){
echo 'użytkownik o podanej nazwie już instnieje';
}
else{
echo 'wystąpil błąd podczas dodawania użytkownika';
}
  $password="echo '$escaped_nazwa:$escaped_haslo' |sudo chpasswd"; 
system($password,$retval2);
}
}

elseif($_POST['pole1']!=null||$_POST['pole2']!=null) {
  echo 'Nie wszystkie dane zostały wpisane';
}
?>


