<?php 
/********************************************* 
* plik formularz.php 
*********************************************/ 
$pole1 = trim($_POST['pole1']);
$pole2 = trim($_POST['pole2']); 

if(empty($pole2)&&$pole1==null) { 
     
// prosty formularz zawierający dwa pola 
echo '<form action="" method="post">
<label for="nazwa">Podaj nazwe makra</label>	 
<input id="nazwa" type="text" name="pole1" style="width: 200px;" /><br /> 
<textarea "wartość" name="pole2" style="width: 600px; height: 500px;"> </textarea><br /> 
<input type="submit" value="Zapisz" /> 
</form>'; 
} 
elseif($pole1!=null&&$pole2!=null) 
     {

   $dir = opendir('macros');
  while(false !== ($file = readdir($dir)))
    if($file != '.' && $file != '..') 
    $files=$files.$file;

  $nameExist=true;
  $filesNames = split(".txt", $files);
  for($i=0; $i < count($filesNames)-1 ; $i++){
    if ($pole1==$filesNames[$i]){
$nameExist=false;
}
    }

    if($nameExist==true)
    {
      // dane pochodzące z formularza 
      $dane = $pole2."\n"; 
      // przypisanie zmniennej $file nazwy pliku 
      $file = $pole1.".txt"; 

      // uchwyt pliku, otwarcie do dopisania 
      $fp = fopen("./macros/$file", "a"); 

      // blokada pliku do zapisu 
      flock($fp, 2); 

      // zapisanie danych do pliku 
      fwrite($fp, $dane); 
  
      // odblokowanie pliku 
      flock($fp, 3); 

      // zamknięcie pliku 
      fclose($fp);       
    echo "Dane zostały zapisane!<br />";
    }
    else
    {
    echo "Podana nazwa  pliku już występuje. Proszę podać inną";
    }

}
else{
echo 'Niepoprawne dane'."\n"; 

} 

?>