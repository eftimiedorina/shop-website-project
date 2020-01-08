<?php
session_start();
include("conectare.php");
include("page_top.php");
include("meniu.php");

$id_produs = $_GET['id_produs'];
$sql = "SELECT nume_produs, descriere, pret from produs where id_produs=" . $id_produs;
include 'conectare.php';
$resursa = mysqli_query($con, $sql);
$row = mysqli_fetch_array($resursa);
?>

<td valing="top">
    <table>
        <tr>
            <td valing="top">
                <?php
                $adrimg = "poze/" . $id_produs . ".jpg";
                if (file_exists($adrimg)) {
                    print '<img src="' . $adrimg . '"width="250" height="290" hspace="5"><br>';
                } else {
                    print '<div style="width:75px; height:100px;border: 1px black solid; background-color:#cccccc">fara imagine</div>';
                }
                ?>
            </td>
            <td vailgn="top">
                <h1><?= $row['nume_produs'] ?></h1>
                <b>
                    <p><?= $row['descriere'] ?></p>
                    <p>Pret: <?= $row['pret'] ?>lei</p>
            </td>
        </tr>
    </table>


<!--pt a pune produsul in cos. se trimite o var de tip GET, $_GET['adauga'] -->
    <form action="cos.php?actiune=adauga" method="POST">
        <input type="hidden" name="id_produs" value="<?= $id_produs ?>">
        <input type="hidden" name="nume_produs" value="<?= $row['nume_produs'] ?>">
        <input type="hidden" name="pret" value="<?= $row['pret'] ?>">
        <input type="submit" value="Cumpara acum!">
    </form>

    <p><b>Opiniile cititorilor</b></p>
    <?php
                                                        $sqlComentariu = "SELECT * from comentariu where id_produs=" . $id_produs;
                                                        $sursaComentariu = mysqli_query($con, $sqlComentariu);
                                                        while ($row = mysqli_fetch_array($sursaComentariu)) {
                                                            print '<div style="width:400px; border:1px solid #ffffff; back-ground-color:#F9F1E7; padding:5px">
        <a href="mailto: ' . $row['email'] . '">' . $row['nume_utilizator'] . '</a><br>' . $row['comentariu'] . '</div>';
                                                        }
    ?>
    <br>
    <div style="width:400px; border:1px solid #632415; background-color:#F9F1E7">
        <b>Adauga opinia ta</b>

        <hr size="1">

        <form action="adauga_comentariu.php" method="POST" class="comment-form">
            Nume <input type="text" name="nume_utilizator">
            Email <input type="text" name="email"><br>

            Comentariu <br>

            <textarea name="comentariu" cols="45"></textarea>
            <br><br>
            <input type="hidden" name="id_produs" value="<?= $id_produs ?>">
            <center>
                <input type="submit" value="Adauga">
            </center>
        </form>
    </div>
</td>
<?php
                                                            include("page_bottom.php");
?>