<?php
//session_start();


function autorizat()
{
  include("conectare.php");
  $sql="select * from admin where nume_admin='".$_SESSION['nume_admin']."' and 
                                parola_admin='".$_SESSION['parola_encriptata']."'";
  $sursa=mysqli_query($conn, $sql);
  if($_SESSION['key_admin'] != session_id() || mysqli_num_rows($sursa) != 1)
  {
	return false;
  }
  else
  {
  	return true;
  }
}
?>