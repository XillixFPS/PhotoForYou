<!-- Page qui permet de désactiver un utilisateur (Admin) -->

<?php 
include("includes/header.php");

if($_GET['idtags']) {
	$id = $_GET['idtags'];

    $sql = "SELECT * from tags where idtags = $id";
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
	<title>Désactiver un tags(Admin) - PhotoForYou</title>
</head>
<body>

<h3>Voulez vous désactivez un tags ?</h3>
<form action="" method="post">

	<input type="hidden" name="idtags" value="<?php echo $data['idtags'] ?>" />
	<button type="submit">Sauvegarder les changements</button>
	<a href="gerer_tags"><button type="button">Retour</button></a>
</form>

</body>

</html>
<?php
include ('includes/footer.php'); 
?>
<?php
if($_POST) {
	$id = $_POST['idtags'];
    
    //Update le champs active à 0
	$sql = $dbh->prepare("UPDATE tags SET activeTags = 0 WHERE idtags = {$id}");
	try
    {
        $sql->execute();
        header('Location: gerer-tags');
    }
    catch(PDOException $e)
    {
        echo"<br> Erreur:". $e->getMessage();
    }
}
include ('includes/footer.php'); 
?>
