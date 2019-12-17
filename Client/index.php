<?php
session_start();
include ("conectare.php");
include ("page_top.php");
include ("meniu.php");
?>


<td valign="top">
    <h1>Prima pagina</h1>
    <b>Cele mai noi Produse</b>
    <table cellpaddind="5">
        <tr>
            <?php
            $sql = "SELECT id_produs,nume_produs,pret FROM produs ORDER BY datai";
          //  include 'conectare.php';
            $sursa = mysqli_query($con,$sql);

            while ($row = mysqli_fetch_array($sursa)) {
               
                print '<td align = "center" >';

                $adrimag = "poze/".$row['id_produs'].".jpg";

                if (file_exists($adrimag)) {
                    $adrimag = "poze/" . $row['id_produs'] . ".jpg";
                    print '<img src=" '.$adrimag.' " width="75" height="100"><br>';
                } else {
                    print '<div style="width:75px; height:100px; border: 1px black solid;background-color:#cccccc">Fara imagine</div>';
                }

                print '<b><a href="produs.php? id_produs='.$row['id_produs'].' ">'
                    . $row['nume_produs'] . '<br>'
                   // . $row['autor'] . '</i><br> pret: '
                    . $row['pret'] . ' lei</td>';
            }
            ?>
        </tr>
    </table>
    <?php
            include("page_bottom.php");
    ?>