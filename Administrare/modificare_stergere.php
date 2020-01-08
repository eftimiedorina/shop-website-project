<?php
session_start();
include("autorizare.php");
include("admin_top.php");
include("conectare.php");
?>
<style type="text/css">
    body {
        max-width: 500px;
        margin: auto;
    }
</style>

<body>
    <h2>Modificare sau stergere</h2>

    <p><b>Nota: </b>Nu veti puea sterge categorii care au produse in ele.<br> Inainte de a sterge categoria, modificati produsele din ea, astfel incat sa apartina altor categorii. <br></p>
    <div style="width:600px; border:3px solid #632415; 
    padding:5px">

        <b>Selecteaza categoria pe care doresti sa o modifici sau sa o stergi:</b>
        <hr size="1">
        <form action="formulare_modificare_stergere.php" method="POST">
            Categorie:
            <select name="id_categorie">
                <?php
                $sql = "SELECT * from categorie order by nume_categorie asc";
                $sursa = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($sursa)) {
                    print '<option value="' . $row['id_categorie'] . '">' . $row['nume_categorie'] . '</option>';
                }
                ?>
            </select>
            <input type="submit" name="modifica_categorie" value="Modifica">
            <input type="submit" name="sterge_categorie" value="Sterge">
        </form>
    </div>

    <div style="width:600px; border:3px solid #632415; 
  padding:5px">
        <b>Selecteaza domeniul si scrie produsul pe care doresti sa il modifici sau sa-l stergi:</b>
        <hr>
        <form action="formulare_modificare_stergere.php">
            <table>
                <tr>
                    <td>Categorie</td>
                    <td>
                        <select name="id_categorie">
                            <?php
                            $sql = "SELECT * from categorie order by nume_categorie asc";
                            $sursa = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($sursa)) {
                                print '<option value="' . $row['id_categorie'] . '">' . $row['nume_categorie'] . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Produs:</td>
                    <td><input type="text" name="nume"></td>
                </tr>
            </table>
            <input type="submit" name="modifica_produs" value="Modifica Produs">
            <input type="submit" name="sterge_produs" value="Sterge">

        </form>

    </div>
</body>

</html>