<?php
include('includes/header.php');
include("includes/dbconnect.php");
session_start();
if(isset($_POST('submit'))){
	$photo=array($_POST['idphoto']);
	$_SESSION['panier']=$photo;
}
?>
<?php
if(!empty($_SESSION['panier']))
{
// on extrait les id du caddie
$id_liste=implode(',',array_keys($_SESSION['panier']));
}

$sql = $dbh -> query("SELECT * FROM photo WHERE idphoto IN (".$id_liste.")"); 
$sql->execute();
$num = $sql ->fetchAll();
// on fait notre requête


// on boucle les infos retenues
foreach($num as $data)
{
// on clacule nos montants pour chaque article
$montant=$_SESSION['panier'][$id]*$data['prix'];

// on affiche chaque ligne (avec une mise en page et du html bien sûr)
echo $data['designation'],' - ',$_SESSION['panier'][$id],' - ',$data['prix'],' - ',$montant,'<br />';

// on additionne les montants pour notre total final
$total+=$montant;
}
echo 'Total du caddie : ',$total;
?>



<?php
include('includes/footer.php');
?>