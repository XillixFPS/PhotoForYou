<!-- Cette page permet d'activer les tags qui sont désactiver par un admin -->

<?php 
include("includes/header.php");

//Il n'y a que les utilisateurs de types admin qui peuvent entrer sur la page
//L'autre son rediriger sur la page d'erreur
if($_SESSION['categorie']!=7)
{
    header('Location: page_erreur.php');
}

//On récupére l'id du tags qu'on veut activer
if($_GET['idtags']) {
	$id = $_GET['idtags'];

    $sql = "SELECT * from tags where idtags = $id";
    $req = $dbh->query($sql);
    $data = $result = $req->fetch();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Activer un tags(Admin) - PhotoForYou</title>
</head>
<body>

<h3>Voulez vous activer ce tag ?</h3>
<form action="" method="post">

	<input type="hidden" name="idtags" value="<?php echo $data['idtags'] ?>" />
	<button type="submit">Sauvegarder les changements</button>
</form>

</body>
</html>
<?php
include ('includes/footer.php'); 
?>
<?php
if($_POST) {
	$id = $_POST['idtags'];
    //Requête sql pour update l'activation d'un compte
	$sql = $dbh->prepare("UPDATE tags SET activeTags = 1 WHERE idtags = {$id}");
	try
    {
        $sql->execute();
        echo'<script>location.href="gerer-tags";</script>';
    }
    catch(PDOException $e)
    {
        echo"<br> Erreur:". $e->getMessage();
    }
}
?>
