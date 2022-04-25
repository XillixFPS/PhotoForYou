<!-- Cette page permet de gérér les catégories/tags qui sont crées, on peut les activer ou les désactiver
Quand un photographe crée un tag, il n'est pas activer de base
C'est l'administrateur qui peut l'activer
Cette page est accessible qu'aux administrateurs -->

<?php
include ('includes/header.php');

if($_SESSION['categorie']!=7)
{
    header('Location: page-erreur.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Gérer les Tags(Admin) - PhotoForYou</title>
</head>
<body>
<div class="container">
            <div class="jumbotron">
                <div class="row row-cols-1 row-cols-md-3 g-4">
				<table class="table">
  					<thead class="thead-dark" style="width:100%">
						<tr>
							<th scope="col">Id Tags</th>
							<th scope="col">Libelle du Tags</th>
							<th scope="col">Utilisateur</th>
							<th scope="col">Activer</th>
						</tr>
					</thead>
				<tbody>
			<?php
			$req= "SELECT * FROM tags,users WHERE tags.iduserTags=users.iduser ";
			$ins=$dbh->prepare($req);
			$ins->execute();
			$num = $ins->fetchAll();
			if($num > 0) {
				foreach ($num as $value){
					echo "<tr>
					<th scope='row'>".$value['idtags']."</th>
					<td>".$value['libelleTags']."</td>
					<td>".$value["prenom"]."\t". $value["nom"]."</td>
					<td>".$value['activeTags']."</td>
					<td>
					<!--<a href=''><button type='button'>Editer</button></a>-->";			
					if($value['activeTags']!=1)
					{
						echo "<a href='active-tags?idtags=".$value['idtags']."'><button type='button' class='btn btn-success'>Activer</button></a>
						<a href='supr-tags?idtags=".$value['idtags']."'><button type='button' class='btn btn-danger'>Supprimer</button></a>";
					}
					elseif($value['activeTags']!=0){
						echo "<a href='desac-tags?idtags=".$value['idtags']."'><button type='button' class='btn btn-danger'>Désactiver</button></a>
						</td>
						</tr>";
					}				
					else {
						echo "<tr><td colspan='15'><center>Pas de Donnée</center></td></tr>";
					}
		}
	}
else {
	echo "<tr><td colspan='15'><center>Pas de Tags</center></td></tr>";}
		?>
		</tbody>
	</table>
</div>
<a href="ajouter-tags"><button type="button" class="btn btn-info">Ajouter des Tags</button></a>
<a href="index"><button type="button" class="btn btn-primary">Retour</button></a>
</div>
</div>
<?php
include ('includes/footer.php'); 
?>