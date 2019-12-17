<td valign="top" width="125">
    <div style="width:120px; background-color: #f9f1e7; padding:4px; border: solid #632415 1px">

        <b>Categorie</b>
        <hr size="1">
        <?php
        include ("conectare.php");
        $sql = "SELECT * FROM categorie";
        $sursa = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_array($sursa)) {
            print '<a href="categorie.php?id_categorie='.$row['id_categorie'].'">'.$row['nume_categorie'].'</a><br>';
        }
        ?>

    </div>

    <!-- div pt cautare--->
    <div style="width:120px; background-color: #f9f1e7; padding:4px; border: solid #632415 1px">
        <form action="cautare.php" method="GET">
            <b>Cautare</b><br>
            <input type="text" name="cuvant" size="12"><br>
            <input type="submit" value="Cauta">
        </form>
    </div> <br>

    <div style="width:120px; background-color:#F9F1E7; padding:4px;border: solid #632415 1px">
        <b>Cos cumparaturi</b><br>

        <?php
        $nrProduse = 0;
        $totalValoare = 0;
        
        if(isset($_SESSION['nume_produs'])){
        for ($i = 0; $i < count($_SESSION['nume_produs']); $i++) {
            $nrProduse += $_SESSION['nr_buc'][$i];
            $totalValoare += $_SESSION['nr_buc'][$i] * $_SESSION['pret'][$i];
        }
    }
        ?>

        Aveti <b><?= $nrProduse ?></b> produse in cos, in valoare totala de
        <b><?= $totalValoare ?></b> lei.
        <a href="cos.php">Click aici pentru a vedea continutul cosului</a>
    </div>
</td>