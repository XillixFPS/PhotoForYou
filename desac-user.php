<!-- Page qui permet de désactiver un utilisateur (Admin) -->

<?php 
include("includes/header.php");

if($_GET['iduser']) {
	$id = $_GET['iduser'];

    $sql = "SELECT * from users where iduser = $id";
    $req = $dbh->query($sql);
    $data = $result = $req->fetch();
}

if($_SESSION['categorie']!=7)
{
    header('Location: page-erreur');
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Désactiver un utilisateur(Admin) - PhotoForYou</title>
</head>
<body>

<h3>Voulez vous désactivez un utilisateur ?</h3>
<form action="" method="post">

	<input type="hidden" name="iduser" value="<?php echo $data['iduser'] ?>" />
	<button type="submit">Sauvegarder les changements</button>
	<a href="gerer_utilisateur"><button type="button">Retour</button></a>
</form>

</body>

</html>
<?php
include ('includes/footer.php'); 
?>
<?php
if($_POST) {
	$id = $_POST['iduser'];
    
    //Update le champs active à 0
	$sql = $dbh->prepare("UPDATE users SET active = 0 WHERE iduser = {$id}");
	try
    {
        $sql->execute();
        header('Location: gerer-utilisateur');
    }
    catch(PDOException $e)
    {
        echo"<br> Erreur:". $e->getMessage();
    }
}
include ('includes/footer.php'); 
?>
