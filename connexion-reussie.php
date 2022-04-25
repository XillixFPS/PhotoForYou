<?php
include("includes/header.php");
include("includes/dbconnect.php");
if($_SESSION['login']!=true)
{
    header('Location: connexion.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Connexion Réussie - PhotoForYou</title>
</head>
<body>
    <div class="container">
    	<div class="jumbotron">
      		<h1 class="display-4">Page des utilisateurs de PhotoForYou</h1>
      		<?php echo '<p class="lead">Bonjour '.htmlentities($_SESSION['prenom']).' '.htmlentities($_SESSION['nom']).' comment allez vous ?</p>'?>
      		<hr class="my-4">
    </div>
	</div>
</body>
</html>
<?php
include ('includes/footer.php'); 
?>