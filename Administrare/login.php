<?php 
session_start();

if($_POST['nume'] == "" || $_POST['parola'] == ""){
    print 'Trebuie sa completati amandoura randurile
    <a href="index.php">Back</a>';
	exit;
}

include("conectare.php");
mysqli_select_db($con,"shopdb");

$parolaEncriptata = md5($_POST['parola']);
$sql = "select * from admin where nume_admin='".$_POST['nume']."' and 
parola_admin='".$parolaEncriptata."'";
$resursa = mysqli_query($con,$sql);

if(mysqli_num_rows($resursa) != 1)
{
	print 'Nume sau parola eronata<br>
		<a href="index.php">Back</a>';
	exit;
	
}
//session_start();
$_SESSION['nume_admin'] = $_POST['nume']; 
 $_SESSION['parola_encriptata'] = $parolaEncriptata;
 $_SESSION['key_admin'] = session_id(); 
 include("admin.php");
 ?>
