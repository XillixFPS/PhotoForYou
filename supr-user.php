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
    header('Location: page-erreur.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Supprimer un utilisateur</title>
</head>
<body>

<h3>Voulez vous supprimer cet utilisateur ?</h3>
<form action="" method="post">

	<input type="hidden" name="iduser" value="<?php echo $data['iduser'] ?>" />
    <input type="hidden" name="active" value="<?php echo $data['active'] ?>" />
	<button type="submit">Sauvegarder les changements</button>
	<a href="gerer-utilisateur.php"><button type="button">Retour</button></a>
</form>
</body>

</html>

<?php
if($_POST) {
	$id = $_POST['iduser'];
    $active = $_POST['active'];
    if($active==0){
        $sql = $dbh->prepare("DELETE FROM users WHERE iduser = {$id}");
    
    try
    {
        $sql->execute();
        header('Location: gerer-utilisateur.php');
    }
    catch(PDOException $e)
    {
        echo"<br> Erreur:". $e->getMessage();
    }
	}
    else{
        echo"On ne peut pas supprimer un compte d'un utilisateur tant que son compte est actif. Si vous voulez supprimer un compte vous devez le désactiver d'abord";
    }
    
    }
	
?>
<?php
include ('includes/footer.php'); 
?>