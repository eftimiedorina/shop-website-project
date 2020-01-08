<?php
session_start();
include("conectare.php");
include("page_top.php");
include("meniu.php");
// primesc variabila de tip get
$actiune = $_GET['actiune'];

/* Dacă este setată variabila $_GET[‘actiune’] şi valoarea acesteia este "adaugă", se
execută următorul cod: */

if (isset($_GET['actiune']) && $_GET['actiune'] == "adauga") {
    $_SESSION['id_produs'][] = $_POST['id_produs'];
    $_SESSION['nr_buc'][] = 1;
    $_SESSION['nume_produs'][] = $_POST['nume_produs'];
    $_SESSION['pret'][] = $_POST['pret'];
}

/* Dacă este setată variabila $_GET[‘actiune’] şi valoarea acesteia este „Modifica", se execută
următorul cod: */
if (isset($_GET['actiune']) && $_GET['actiune'] == "modifica") {
    for ($i = 0; $i < count($_SESSION['id_produs']); $i++) { // pt fiecare produs setam noul nr de bucatati
        $_SESSION['nr_buc'][$i] = $_POST['noulNrBuc'][$i];
    }
}

?>

<td valign="top">
    <h2>Cosul de cumparaturi</h2>
    <form action="cos.php?actiune=modifica" method="POST">
        <table border="1" cellspacing="0" cellpading="4">
            <tr bgcolor="#F9F1E7">
                <td align="center"><b>Nr_buc</b></td>
                <td align="center"><b>Produs</b></td>
                <td align="center"><b>Pret</b></td>
                <td align="center"><b>Total</b></td>
            </tr>
            <?php
             $totalGeneral=0;
            for ($i = 0; $i < count($_SESSION['id_produs']); $i++) {
                if($_SESSION['nr_buc'][$i] !=0){
                print '<tr> 
                <td><input type="text" name="noulNrBuc[' . $i . ']" size="1" value="' . $_SESSION['nr_buc'][$i] . '"></td>
                <td><b>' . $_SESSION['nume_produs'][$i] . '</b></td>
                <td align="right">' . $_SESSION['pret'][$i] . ' lei</td>
                <td align="right">' . ($_SESSION['nr_buc'][$i] * $_SESSION['pret'][$i]) . ' lei</td>
                </tr>
                ';

                $totalGeneral = $totalGeneral + ($_SESSION['nr_buc'][$i] * $_SESSION['pret'][$i]);
                }
            }
            // afisam totalul general
            print '<tr>
          <td align="right" colspan="3"><b>Total in cos</b></td>
          <td align="right"><b>' . $totalGeneral . '</b>lei</td>
          </tr>
          ';
            ?>
        </table>
        
        <input type="submit" value="Modifica">
        <br><br>
        Introduceti <b>0</b> pentru produsele pe care doriti sa le scoateti din cos!
        <h2>Continuati</h2>
        <table>
            <tr>
                <td width="200" align="center">
                    <a href="index.php"> Continua cumparaturile</a></td>
                <td width="200" align="center">
                    <a href="casa.php">Mergi la casa</a></td>
            </tr>
        </table>
</td>
<?php 
include("page_bottom.php");
?>