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
    header('Location: page-erreur.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Supprimer un tags</title>
</head>
<body>

<h3>Voulez vous supprimer cet tags ?</h3>
<form action="" method="post">

	<input type="hidden" name="idtags" value="<?php echo $data['idtags'] ?>" />
    <input type="hidden" name="active" value="<?php echo $data['activeTags'] ?>" />
	<button type="submit">Sauvegarder les changements</button>
	<a href="gerer-tags.php"><button type="button">Retour</button></a>
</form>
</body>

</html>

<?php
if($_POST) {
	$id = $_POST['idtags'];
    $active = $_POST['active'];
    if($active==0){
        $sql = $dbh->prepare("DELETE FROM tags WHERE idtags = {$id}");
    
    try
    {
        $sql->execute();
        header('Location: gerer-tags.php');
    }
    catch(PDOException $e)
    {
        echo"<br> Erreur:". $e->getMessage();
    }
	}
    else{
        echo"On ne peut pas supprimer un tags tant que le tags est actif. Si vous voulez supprimer un tags vous devez le désactiver d'abord";
    }
    
    }
	
?>
<?php
include ('includes/footer.php'); 
?>