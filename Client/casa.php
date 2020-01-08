<?php
session_start();
include("conectare.php");
include("page_top.php");
include("meniu.php");
?>
<td valign="top">
    <h2>Casa</h2>
    Acestea sunt cartile comandate de dvs.:<br><br>
    <table border="1" cellspacing="0" cellpading="4">
        <tr>
            <td align="center"><b>Nr. buc</b>
            </td>
            <td align="center"><b>Produs</b></td>
            <td align="center"><b>Pret</b></td>
            <td align="center"><b>Total</b></td>

        </tr>
        <?php
        $totalGeneral = 0;
        for ($i = 0; $i < count($_SESSION['id_produs']); $i++) {
            if ($_SESSION['nr_buc'][$i] != 0) {
                print '<tr>
                <td align="center">' . $_SESSION['nr_buc'][$i] . '</td><td><b>'
                    . $_SESSION['nume_produs'][$i] . '</b></td>
                <td align="right>' . $_SESSION['pret'][$i] . ' lei</td>
                <td align="right>' . ($_SESSION['nr_buc'][$i] * $_SESSION['pret'][$i]) . ' lei</td>
                </tr>';
                $totalGeneral = $totalGeneral + ($_SESSION['nr_buc'][$i] * $_SESSION['pret'][$i]);
            }
        }

        //afisam totalul general
        print '<tr>
        <td align="right" colspan="3"><b>Total de plata</b></td>
        <td align="right"><b>' . $totalGeneral . '</b> lei</td>
        </tr>';
        ?>
    </table>
    Numele si adresa unde doriti sa primiti cartile cumparate:
    <h3>Detalii</h3>
    Introduceti numele si adresa unde doriti sa primiti cartile cumparate:
    <form action="prelucrare.php" method="POST">
        <table>
            <tr>
                <td><b>Numele:</b></td>
                <td><input type="text" name="nume"></td>
            </tr>
            <tr>
                <td valign="top"><b>Adresa:</b></td>
                <td><textarea name="adresa" rows="6"></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Trimite"></td>
            </tr>
        </table>
    </form>
</td>
<?php 
include("page_bottom.php");
?>