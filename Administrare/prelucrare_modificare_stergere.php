<?php
  session_start();
  include("autorizare.php");
  include("admin_top.php");
  include("conectare.php");

/* modificare nume categorie */ 

if(isset($_POST['modifica_categorie']))
{
  /* Verificam daca noul nume de domeniu a fost introdus. */ 
  if($_POST['nume_categorie']=="")
  {
 	print "Nu ati introdus numele categoriei ! ";
  }
  else
  {
    $sql = "update categorie set nume_categorie='".$_POST['nume_categorie']."' 
				where id_categorie=".$_POST['id_categorie'];
	mysqli_query($con, $sql);
 	
 	print "numele categoriei a fost modificat!";
  }

  /* De ce nu am folosi exit in structura if(conditie) {codul de executat; exit}; ? Pentru 
  ca, daca nu se executa codul din if (conditie) {} , se executa codul din else {} si atunci 
  exit ar fi superfluu. */
}

/* stergere categorie */

if(isset($_POST['sterge_categorie']))
{
   $sql="delete from categorie where id_categorie=".$_POST['id_categorie'];
   mysqli_query($con, $sql);
   print "Categoria a fost stearsa!";
}

/* modificare nume autor */ 



/* Stergere autor */ 



/* Modificare informatii produs */ 

if(isset($_POST['modifica_produs']))
{
	/* Verificam daca toate datele au fost introduse corect. N-am vrea sa 
	introducem date eronate in tabela doar pentru ca a sarit pisica pe 
	tastatura si a apasat ENTER in timp ce introduceam datele. Daca, credeti  
	nu vi se poate intampla ... ei bine, din proprie experienta va spun ca se 
	ca poate. Vom folosi o structura  if  ... else if ... else: */

	if($_POST['nume'] == "")
	{
   		print "Nu ati introdus numele produsului !";
	}
    else if($_POST['descriere'] == "")
	{
    	print "Nu ati introdus descrierea !";
	}
    else if($_POST['pret'] == "")
	{
    	print "Nu ati introdus pretul !";
	}
    else if(!is_numeric($_POST['pret']))
	{
		print "Pretul trebuie sa fie numeric! Scrieti <b>1000</b>, nu <b>1000 lei</b>!";
	}
	else
	{
		$sql="update produs set 
			id_categorie=".$_POST['id_categorie'].",
			
			nume_produs='".$_POST['nume']."',
			descriere='".$_POST['descriere']."',
			pret=".$_POST['pret']."
			where id_produs=".$_POST['id_produs']; 
		 /*print '<br>'.$sql.'<br>';*/
		mysqli_query($con, $sql); 
		print "Informaliiile au fost modificate!";
  }
}

/* Stergere carte */

if(isset($_POST['sterge_produs']))
{
	$sqlCarte="delete from produs where id_produs=".$_POST['id_produs']; 
	mysqli_query($con, $sqlCarte); 
    $sqlComentarii="delete from comentariu where id_produs=".$_POST['id_produs']; 
	mysqli_query($con, $sqlComentarii);
    print "Produsul a fost stears din tabela!";
}

?> 

</body>
</html>
