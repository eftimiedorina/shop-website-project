<?php
  session_start();
  include("autorizare.php");
  include("admin_top.php");
  include("conectare.php");
  
if(isset($_POST['adauga_domeniu']))
{
 
  if($_POST['categorie_noua'] == "")
  {
	print 'Trbuie sa completati numele de domeniu! <br>
        <a href="adaugare.php">Back</a>';
        exit;
  }
  /*verificam daca nu exista deja in tabela*/

  $sql="select * from categorie where nume_categorie='".$_POST['categorie_noua']."'";
  $sursa=mysqli_query($con, $sql);

  if(mysqli_num_rows($sursa) != 0)
  {
	print 'Categoria <b>'.$_POST['categorie_noua'].'</b> exista deja in baza de date!<br>
               <a href="adaugare.php">Back</a>';
        exit;
  }

  $sql="insert into categorie(nume_categorie) values('".$_POST['categorie_noua']."')";
  mysqli_query($con, $sql);

  /*afisam utilizatorului un mesaj de confirmare*/   
	print 'Domeniul <b>'.$_POST['categorie_noua'].'</b> a fost adaugat in tabela!<br>
               <a href="adaugare.php">Back</a>';
        exit;
}

  /*acelasi script cu mici diferente il vom folosi pentru a adauga un autor nou*/

if(isset($_POST['adauga_produs']))
{
   	/*verificam daca titlul, descrierea sau pretul nu sunt goale*/

       if($_POST['nume'] == "" || $_POST['descriere'] == "" || $_POST['pret'] == "")
       {
	  print 'Trbuie sa completati toate campurile: nume, descriere, pret! <br><a href="adaugare.php">Back</a>';
          exit;
       }

       /*verificam daca valoarea introdusa in campul pret este de tip numeric*/

       if(!is_numeric($_POST['pret']))
       {
	  print 'campul pret trebuie sa fie de tip numeric!<br>
	         <a href="adaugare.php">Back</a>';
          exit;
       }
	  /*verificam daca aceasta carte nu exista deja in tabela*/

       $sql="select * from produs where id_categorie='".$_POST['id_categorie']."' and nume_produs='".$_POST['nume']."'";
       $sursa=mysqli_query($con, $sql);
       if(mysqli_num_rows($sursa) != 0)
       {
		print 'Aceast produs exista deja in baza de date! <br>
		<a href="adaugare.php">Back</a>';
  		exit;
       }

	  $sql="insert into produs(id_categorie,nume_produs,descriere,pret,datai) VALUES(
						     
						     '".$_POST['id_categorie']."',
						     '".$_POST['nume']."',
						     '".$_POST['descriere']."',
						     '".$_POST['pret']."',
						     '".$_POST['datai']."')";
	  mysqli_query($con, $sql);

	  print 'Produsul a fost adaugat in tabela!<br>
	  	 <a href="adaugare.php">Back</a>';
	  exit;
	}
?>
</body>
</html>