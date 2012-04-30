<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta http-equiv="Content-Language" content="pl" />
  <link rel="stylesheet" href="style.css" type="text/css" />
  <title>Grindziowy serwer</title>
</head>
<body>

<div id="container">

	<div id="logo"></div>	
	<div id="menu">
		<ul>
			<?php				 
		if(isset($_SESSION['zalogowany'])){ 
		      echo '<li><a href="index.php?group=main">Strona Główna</a></li>';
			if($_SESSION['zalogowany']=='admin'){ 
			echo '<li><a href="index.php?group=config">Zarządaj</a></li>';
			    }
			else{
			     echo '<li><a href="index.php?group=userinfo">Szczegóły użytkownika</a></li>';
			    }
		    }
		else{ 
		      echo'<li><a href="index.php?group=logowanie">Zaloguj</a></li>';
		    }	
			?>
		</ul>
	</div>
	<div id="srodek">

<?php

$login=$_SESSION['zalogowany'];

if(isset($_SESSION['zalogowany']))
{


  if($_GET['wyloguj']==tak){
  include('logowanie.php');
  }


  elseif($_GET['group']==userinfo){
  include('userinfo.php');
  }


  elseif($_GET['group']==config){
  include('config/mainconf.php');
  }

  else{
  //strona glowna
  echo "strona główna <br /> <br />";
  }
}
else{
  if($_GET['group']==logowanie){
  include('logowanie.php');
  }
}
?>





	</div>	
	<div id="stopka">
		<?php				 
		if(isset($_SESSION['zalogowany'])){
		 echo 'Zalogowany jako ';
		 echo $_SESSION['zalogowany'];
		 echo ' (<a href="index.php?wyloguj=tak">Wyloguj</a>)';
		}
		else{ echo'
			zaloguj - nie masz uprawnien';
		}
		?>
	</div>
</div>    
</body>
</html>