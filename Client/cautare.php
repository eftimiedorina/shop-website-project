<?php 
session_start();
include("conectare.php");
include("page_top.php");
include("meniu.php");
$cuvant = $_GET['cuvant'];
?>

<td valign = "top">
    <h1>Rezultatele cautarii</h1>
    <p>Textul cautat: <b><?=$cuvant?></b></p>
    <b>Produse</b>
    <blockquote>
        <?php 
        $sql = "SELECT id_produs,nume_produs from produs where nume_produs like '%".$cuvant."%'";
        $resursa = mysqli_query($con,$sql);
        if(mysqli_num_rows($resursa) == 0){
            print "<i>Niciun rezultat</i>";
        }

        while($row = mysqli_fetch_array($resursa)){
            $nume_autor = str_replace($cuvant,"<b>$cuvant</b>", $row['nume_produs']);
            print '<a href="produs.php?id_produs='.$row['id_produs'].'">'.$produs.'</a><br>';
        }
        ?>
    </blockquote>
   <b>Descrieri</b>
   <blockquote>
       <?php 
       $sql = "select id_produs,nume_produs, descriere from produs where descriere like '%".$cuvant."%'";
       $resura = mysqli_query($con,$sql);
       if(mysqli_num_rows($resursa) == 0){
           print "<i>Niciun rezultat</i>";
       }
       while($row = mysqli_fetch_array($resursa)){
           $descriere = str_replace($cuvant,"<b>$cuvant</b>",$row['descriere']);
           print '<a href="produs.php?id_produs='.$row['id_produs'].'">'.$row['nume_produs'].'</a><br>'.$descriere.'<br><br>';
       }
       ?>
   </blockquote>
</td>
<?php
include("page_bottom.php");
?>