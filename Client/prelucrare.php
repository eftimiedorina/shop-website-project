<?php 
if($_POST['nume'] == ""){
    print 'Trebuie sa completati numele!<a href="cos.php">inapoi</a>';
}
if($_POST['adresa'] == ""){
    print 'Trebuie sa completati adresa!<a href="cos.php">inapoi</a>';
}
session_start();
$nrCarti = array_sum($_SESSION['nr_buc']);
if($nrCarti = 0){
    print 'Trebuie sa cumparati cel putin o carte!<a href="cos.php">inapoi</a>';
    exit;
}
include('conectare.php');

$sqlTranzactie = "insert into tranzactii (nume_cumparator,adr_cumparator) values('".$_POST['nume']."', '".$_POST['adresa']."')";
$resursaTranzactie = mysqli_query($con,$sqlTranzactie);
$id_tranzactie = mysqli_insert_id($con);

for($i=0; $i<count($_SESSION['id_produs']); $i++){
    if($_SESSION['nr_buc'][$i] > 0){
        $sqlVanzare = "insert into vanzari values('".$id_tranzactie."','".$_SESSION['id_produs'][$i]."',
        '".$_SESSION['nr_buc'][$i]."')";
        mysqli_query($con,$sqlVanzare);
    }
}

$emailDestinatar = "unemail@yahoo.com";
$subiect = "O noua comanda!";
$mesaj = "O noua comanda de la <b>".$_POST['nume']."</b><br>";
$mesaj .= "Adresa:".$_POST['adresa']."<br>";
$mesaj .= "Produsele comandate: <br><br>";
$mesaj .= "<table border='1' cellspacing='0' cellpadding='4'>";
$totalGeneral = 0;
for($i=0; $i<count($_SESSION['id_produs']); $i++){
    if($_SESSION['nr_buc'][$i] > 0){
        $mesaj .= "<tr><td>".$_SESSION['nume_produs'][$i]."</td><td>".$_SESSION['nr_buc'][$i]. "buc</td></tr>";
        $totalGeneral += ($_SESSION['nr_buc'][$i] * $_SESSION['pret'][$i]);
    }
}

$mesaj .= "</table>";
$mesaj .= "Total<b>".$totalGeneral."</b>";
$headers = "MIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-2\r\n";
@mail($emailDestinatar, $subiect, $mesaj, $headers);
session_unset();
session_destroy();
include("page_top.php");
include("meniu.php");
?>
<td valign="top">
<h1><Multumim!</h1>
Va multumim ca aţi cumpărat de la noi! Veţi primi comanda solicitata in cel mai scurt timp.
</td>
<?php
	include("page_bottom.php");
?>