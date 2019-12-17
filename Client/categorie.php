<?php
session_start();
include("conectare.php");
include("page_top.php");
include("meniu.php");

$id_categorie = $_GET['id_categorie'];
$sqlNumeCategorie = "SELECT nume_categorie FROM categorie WHERE id_categorie =" . $id_categorie;
include 'conectare.php';
$sursaNumeCategorie = mysqli_query($con, $sqlNumeCategorie);

$row = mysqli_fetch_array($sursaNumeCategorie);
$numeCategorie = $row['nume_categorie'];
?>
<td valign="top">
    <h3>Categorie: <?= $numeCategorie ?></h3>
    <b>Produse din categoria:<u><i><?= $numeCategorie ?></i></u></b>
    <table cellpadding="5">
        <tr>
            <?php
                                    $sql = "SELECT id_produs,nume_produs,descriere,pret FROM produs,categorie where produs.id_categorie = categorie.id_categorie and categorie.id_categorie=" . $id_categorie;
                                    $sursa = mysqli_query($con, $sql);

                                    while ($row = mysqli_fetch_array($sursa)) {
            ?>

                <td align="center" style="width: 150px;">
                    <?php
                                        $adrimag = "poze/" . $row['id_produs'] . ".jpg";
                                        if (file_exists($adrimag)) {
                                            $adrimag = "poze/" . $row['id_produs'] . ".jpg";
                                            print '<img src="' . $adrimag . '" width="250" height="290"><br>';
                                        } else {
                                            /*daca nu exista fis specificat afisam layerul DIV in care scrie "fara imagine"*/
                                            print '<div style="width:75px; border: 1px black solid;
			background-color:#cccccc">fara imagine</div>';
                                        }
                    ?>
                    <br>
                    <b><a href="produs.php?id_produs=<?= $row['id_produs'] ?>">
                            <?= $row['nume_produs'] ?></a></b><br>

                    pret: <?= $row['pret'] ?> lei
                </td>

            <?php
                                                    }
            ?>
        </tr>
    </table>
</td>
<?php
                                                    include("page_bottom.php");
?>