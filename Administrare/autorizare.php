<?php
//session_start();

if($_SESSION['key_admin']!=session_id()){
    print 'Acces neautorizat!';
    exit;
}
include("conectare.php");

$sql = "SELECT * FROM admin WHERE
nume_admin=' ". $_SESSION['nume_admin']." ' AND
parola_admin=' ". $_SESSION['parola_encriptata']." ' ";
$resursa=mysqli_query($con,$sql);

// if(mysqli_num_rows($resursa) != 1){
//     print "<b>Acces neautorizat!<br><b>";
//     print_r(mysqli_num_rows($resursa));
//     exit;
//     }
?>