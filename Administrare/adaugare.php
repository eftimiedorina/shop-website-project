<?php
session_start();
include("autorizare.php");
include("admin_top.php");
include("conectare.php");
?>
<style type="text/css">
    body {
        text-align: center;
    }

    input[type="submit"] {
        display: inline-block;
        padding: 0.3em 1.2em;
        margin: 0 0.3em 0.3em 0;
        border-radius: 2em;
        text-decoration: none;
        font-family: 'Roboto', sans-serif;
        font-weight: 300;
        color: #FFFFFF;
        background-color: #571C20;
        text-align: center;
        transition: all 0.2s;

    }

    input[type="submit"]:hover {
        background-color:#4095c6;
    }
</style>

<h2>Adaugare</h2>

<body>
    <b> Adauga Categorie </b>
    <form action="prelucrare_adugare.php" method="POST">
        Categorie noua: <input type="text" name="categorie_noua">
        <input type="submit" name="adauga_categorie" value="Adauga">
    </form><br>

    <b>Adauga Produs</b>
    <form action="prelucrare_adaugare.php" method="POST">
        <table align="center">
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
                <td>Denumire produs:</td>
                <td><input type="text" name="nume"></td>
            </tr>

            <tr>
                <td align="top">Descriere</td>
                <td><textarea name="descriere" rows="8">
         </textarea>
                </td>
            </tr>

            <tr>
                <td>Data:</td>
                <td><input type="date" name="datai"></td>
            </tr>

            <tr>
                <td>Pret: </td>
                <td><input type="text" name="pret"></td>
            </tr>

            tr>
            <td></td>
            <td><input type="submit" name="adauga_produs" value="Adauga"></td>
            </tr>

        </table>
    </form>
</body>
</html>