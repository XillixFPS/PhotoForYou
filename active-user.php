<!-- Cette page permet d'activer les comptes des utilisateurs qui sont désactiver par un admin -->

<?php 
include("includes/header.php");

//Il n'y a que les utilisateurs de types admin qui peuvent entrer sur la page
//L'autre son rediriger sur la page d'erreur
if($_SESSION['categorie']!=7)
{
    header('Location: page_erreur.php');
}

//On récupére l'id de l'utilisateur qu'on veut activer
if($_GET['iduser']) {
	$id = $_GET['iduser'];

    $sql = "SELECT * from users where iduser = $id";
    $req = $dbh->query($sql);
    $data = $result = $req->fetch();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Activer un utilisateur(Admin) - PhotoForYou</title>
</head>
<body>

<h3>Voulez vous activer cet utilisateur ?</h3>
<form action="" method="post">

	<input type="hidden" name="iduser" value="<?php echo $data['iduser'] ?>" />
	<button type="submit">Sauvegarder les changements</button>
</form>

</body>
</html>
<?php
include ('includes/footer.php'); 
?>
<?php
if($_POST) {
	$id = $_POST['iduser'];
    //Requête sql pour update l'activation d'un compte
	$sql = $dbh->prepare("UPDATE users SET active = 1 WHERE iduser = {$id}");
	try
    {
        $sql->execute();
        echo'<script>location.href="gerer-utilisateur";</script>';
    }
    catch(PDOException $e)
    {
        echo"<br> Erreur:". $e->getMessage();
    }
}
?>
