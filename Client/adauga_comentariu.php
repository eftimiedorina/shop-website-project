<?php
if (
    $_POST['nume_utilizator'] == "" ||
    $_POST['email'] == "" ||
    $_POST['comentariu'] == ""
) {
    print "Trebuie sa completati toate campurile";
    exit;
}

include("conectare.php");

$nume = strip_tags($_POST['nume_utilizator']);
$email = strip_tags($_POST['email']);
$coment = strip_tags($_POST['comentariu']);

$sql="INSERT into comentariu(id_produs,nume_utilizator,email,comentariu) values(".$_POST['id_produs'].",'".$nume."','".$email."','".$coment."')";
mysqli_query($con,$sql);

$inapoi="produs.php?id_produs=".$_POST['id_produs'];
$id_produs=$_POST['id_produs'];
header("location: $inapoi");
?>
