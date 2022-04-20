<!-- Cette page permet de gérér les comptes de utilisateurs, on peut les activer ou les désactiver
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
	<title>Gérer les Utilisateurs(Admin) - PhotoForYou</title>
</head>
<body>
<div class="container">
            <div class="jumbotron">
                <div class="row row-cols-1 row-cols-md-3 g-4">
				<table class="table">
  					<thead class="thead-dark" style="width:100%">
						<tr>
							<th scope="col">iduser</th>
							<th scope="col">Nom</th>
							<th scope="col">Prenom</th>
							<th scope="col">Email</th>
							<th scope="col">Date de Naissance</th>
							<th scope="col">Crédits</th>
							<th scope="col">Active</th>			
							<th scope="col">Catégorie</th>
							<th scope="col">PhotoUser</th>
							<th scope="col">telUser</th>
						</tr>
					</thead>
				<tbody>
			<?php
			$req= "SELECT * FROM users";
			$ins=$dbh->prepare($req);
			$ins->execute();
			$num = $ins->fetchAll();
			if($num > 0) {
				foreach ($num as $value){
					echo "<tr>
					<th scope='row'>".$value['iduser']."</th>
					<td>".$value['nom']."</td>
					<td>".$value['prenom']."</td>
					<td>".$value['email']."</td>
					<td>".$value['dateNaiss']."</td>
					<td>".$value['credit']."</td>
					<td>".$value['active']."</td>
					<td>".$value['categorie']."</td>
					<td><img width=35 height=35 src='images/profil/".$value['photoUser']."' ></td>
					<td>".$value['telUser']."</td>
					<td>
					<!--<a href=''><button type='button'>Editer</button></a>-->";
		if($value['active']==0)
		{
			echo "<a href='active-user?iduser=".$value['iduser']."'><button type='button' class='btn btn-success'>Activer</button></a>
			<a href='supr-user?iduser=".$value['iduser']."'><button type='button' class='btn btn-danger'>Supprimer</button></a>";
		}
		elseif($value['active']==1){
			echo "<a href='desac-user?iduser=".$value['iduser']."'><button type='button' class='btn btn-danger'>Désactiver</button></a>
			</td>
			</tr>";
		}
	}	
}			
		else {
			echo "<tr><td colspan='15'><center>Pas de Donnée</center></td></tr>";
		}
	

		?>
		</tbody>
	</table>
</div>
</div>
</div>

<?php
include ('includes/footer.php'); 
?>