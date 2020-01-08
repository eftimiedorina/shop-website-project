<?php
 session_start();
 include("autorizare.php"); 
 include("admin_top.php");
 include("conectare.php");

 /* Modifica/sterge domeniu 

  modificare nume domeniu */

 if(isset($_POST['modifica_categorie']))
 {
    
   /* luam numele de domeniu din tabela deoarece ne-a fost trimis din formular doar  
      id_ul domeniului: 
   */

   $sql= "select nume_categorie from categorie where id_categorie='" . $_POST['id_categorie'] . "'";
   $resursa = mysqli_query($con, $sql);
   $row = mysqli_fetch_assoc($resursa);
   $categorie=$row['nume_categorie'];

   /* si afisam numele vechi de domeniu intr-un textbox pentru a fi modificat*/

?>

<h1>Modifica nume domeniu</h1>

<form action="prelucrare_modificare_stergere.php" method="POST">
    <INPUT type="text" name="nume_categorie" value="<?=$categorie?>">
    <INPUT type="hidden" name="id_categorie" value="<?=$_POST['id_categorie']?>">
    <INPUT type="submit" name="modifica_categorie" value="Modifica"> 
</form>

<?php

}

/*   Sterge domeniu */

/*include("sterge_domeniu.php");*/

 if(isset($_POST['sterge_categorie']))
 {
    print_r($_POST);
   /* verificam daca sunt carti in tabela care apartin acestui domeniu */

   $sql = "select nume_produs, nume_categorie from produs,categorie where categorie.id_categorie=produs.id_produs and categorie.id_categorie=" . $_POST['id_categorie'];
      
   $resursa = mysqli_query($con, $sql);   
   $nrProduse = mysqli_num_rows($resursa);

   /* daca sunt carti apartinand acestui domeniu afisam lista lor si un mesaj de eroare */

   if($nrProduse > 0)
   {
	print "<p>Sunt $nrProduse produse care apartin acestei categorii</p>";
	while($row = mysqli_fetch_array($resursa))
	{
  			print "<b>".$row['nume_produs']."</b> de ".$row['nume_categorie']."<br>";
	}
      print "<p>Nu puteti sterge aceasta categorie </p>";
   }
      /* iar daca nu sunt carti in acest domeniu cerem confirmarea pcntru stergere: */
    else{

?>

<h1>Sterge nume categorie</h1> 

	Esti sigur ca vrei sa stergi aceasta categorie?

<form action="prelucrare_modificare_stergere.php" method="POST">
   <INPUT type="hidden" name="id_categorie" value="<?=$_POST['id_categorie']?>">
   <INPUT type="submit" name="sterge_categorie" value="Sterge!"> 
</form>

<?php
 }
}

  /*modifica/sterge carte
  modificare nume carte */ 
  print_r($_POST);

 if(isset($_POST['modifica_produs']))
 {
    
      print "<h1>Modificare produs</h1>";

      /* cautam intai o carte care are titlul si id_autor specificate in formular*/

      $sqlProdus="select * from produs where nume_produs='".$_POST['nume']."' and 
					 id_categorie=".$_POST['id_categorie'];
      $resursaProdus=mysqli_query($con, $sqlProdus);

      /*daca nu s-a gasit nici o carte care sa corepunda datelor introduse, 
	afisam un mesaj de eroare*/

      if(mysqli_num_rows($resursaProdus) == 0)
      {
		print "Aceast produs nu exista in tabela";   
      }
	  else
	  {

        /* daca exista, atunci extragem informatiile din resursa, le punem intr-un array 
	  (nu folosim while deoarece este returnat un singur rand!) si le afisam in 
	  formular pentru a fi modificate*/

        $rowProdus = mysqli_fetch_array($resursaProdus);
	/*print_r($rowCarte);*/
?> 
	<form action="prelucrare_modificare_stergere.php" method="POST">
	<table>
  	<tr>
      	  <td>Categorie:</td>
      	  <td><SELECT name="id_categorie">
          <?php
           /* Luam numele de domenii din tabela si Ie afisam utilizatorului intr-o lista drop-   
              down. Observati folosirea lui if pentru a afisa ca selectat domeniul de care apartine  
              cartea
           */

           $sql="select * from categorie order by nume_categorie asc";
		   $resursa = mysqli_query($cnn, $sql);
           while($row=mysqli_fetch_array($resursa))
           {
				if($row['id_categorie'] == $rowProdus['id_categorie'])
				{
					print '<option SELECTED value="'.$row['id_categorie'].'">'.$row['nume_categorie'].'</option>';
				}
				else
				{
					print '<option value="'.$row['id_categorie'].'">'.$row['nume_categorie'].'</option>';
				}
           }

          ?>

    	 </select>
       </td> 
      </tr> 
     
     <tr> 
      <td>Produs:</td>
      <td> 
         <INPUT type="text" name="nume" value="<?=$rowProdus['nume_produs']?>">
      </td>
     </tr> 
     <tr> 
      <td valign = "top"> Descriere: </td>
      <td><textarea name = "descriere" rows="8"><?=$rowProdus['descriere']?>
          </textarea>
      </td>
     </tr> 
     <tr> 
      <td>Pret:</td>
      <td>
	<INPUT type="text" name="pret" value="<?=$rowProdus['pret']?>">
      </td>
     </tr>
   </table> 
    <INPUT type="hidden" name="id_produs" value="<?=$rowProdus['id_produs']?>">
    <INPUT type="submit" name="modifica_produs" value="Modifica"> 
 </form>

 <?php
 }
}
 /* si in final stergere carte */

 if(isset($_POST['sterge_produs']))
 {
   print "<h1>Sterge produs</h1>";

   /* cautam intai o carte in tabela care are titlul si id_autor specificate in 
      formular
   */

   $sqlProdus = "select * from produs where nume_produs='".$_POST['nume']."' and 
   				    id_categorie=".$_POST['id_categorie'];
 
   $resursaProdus = mysqli_query($con, $sqlCarte);

   /* daca nu s-a gasit nici o carte care sa corespunda datelor introduse afisam 
      un mesaj de eroare 
   */

   if(mysqli_num_rows($resursaProdus) == 0)
   {
		print "Aceast produs nu exista in tabela";
   }
   else
   {
        /* iar daca exista atunci extragem id_ul cartii din tabela si il vom folosi 
        intr-un camp ascuns din formularul de confirmare */

		$row = mysqli_fetch_assoc($resursaProdus);
		$id_produs=$row['id_produs'];
   ?>

  Esti sigur ca vrei sa stergi aceast produs ?

  <form action="prelucrare_modificare_stergere.php" method="POST">
    <INPUT type="hidden" name="id_produs" value="<?=$id_produs?>">
    <INPUT type="submit" name="sterge_produs" value="Sterge!"> 
  </form>

<?php
 }
}
?>

</body>
</html>
