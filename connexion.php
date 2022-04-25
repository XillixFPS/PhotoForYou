<?php
include("includes/header.php");
include("includes/dbconnect.php");

//Tentative de connexion du formualaire de connexion présents sur le includes/header
if (isset($_POST['connexion']))
{
    $email = $_POST['email']; //On récupére l'adresse email 
    $mdp = hash('sha512',$_POST['mdp']); //On hash le mot de passe recupérer en sha512
    //Requête qui compare l'email du formualire avec celle présente dans la base de données
    //et on compare l'empreinte de hash du mot de passe stocké sur la base de données et le hash qu'on vient de récuperer
    //Si ils sont identiques alors l'utilisateur est connecté
    $sql = 'SELECT iduser from users where email = :email and mdp = :mdp and active > 0';
    $sql = $dbh->prepare($sql);
    $sql->bindParam(':email', $email, PDO::PARAM_STR);
    $sql->bindParam(':mdp', $mdp, PDO::PARAM_STR);
    $sql->execute();
    $num = $sql->fetchAll();
  if (count($num)>0)
  {
      // On atribue les différentes varibles $_SESSION
      //On dit que l'utilisateur est connecté
      $_SESSION['login'] = true;
      //On récupere toutes les informations qui viennent de l'utilisateur dans la base de données
      $sql1 = "SELECT * from users where email = '$email';";
      $req = $dbh->query($sql1);
      $result = $req->fetch();
      $_SESSION['id'] = htmlentities($result['iduser']); //ID de l'utilisateur
      $_SESSION['prenom'] = htmlentities($result['prenom']); //Prenom de l'utilisateur
      $_SESSION['nom'] = htmlentities($result['nom']); //Nom de famille de l'utilisateur
      $_SESSION['email'] = htmlentities($result['email']); //Email de l'utilisateur
      $_SESSION['categorie'] = htmlentities($result['categorie']); //Catégorie de l'utilisateur (1,3,7)
      $_SESSION['photouser']= htmlentities($result['photoUser']); //Photo de profil de l'utilisateur
      $_SESSION['date']= htmlentities($result['dateNaiss']); //Date de naissance de l'utilisateur
      $_SESSION['credit']= htmlentities($result['credit']); //Nombre de crédit que l'utilisateur a
      $_SESSION['tel'] = htmlentities($result['telUser']); //Numéro de téléphone de l'utilisateur
      $_SESSION['adresse'] = htmlentities($result['adressUser']); //Adresse de l'utilisateur
      $_SESSION['site'] = htmlentities($result['siteUser']); //Site de l'utilisateur (photographe)
      $_SESSION['siret'] = htmlentities($result['siret']); //SIRET de l'utilisateur (photographe)
   
      //On crée un cookie de connexion
      if(!empty($_POST["remember-me"])) {
				setcookie ("connexion_photoforyou",$_SESSION['login'] && $_SESSION['email'],time()+ (10 * 365 * 24 * 60 * 60));
			} else {
				if(isset($_COOKIE["connexion_photoforyou"])) {
					setcookie ("connexion_photoforyou","");
				}
			}
      unset($result);
      echo '<script>location.href="connexion-reussie";</script>';
  }
  else
  {
    $userInconnu = true;
  }

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Connexion - PhotoForYou</title>
</head>
<body class="text-center">
  <main class="form-signin">
      <form method="post" id="formId" novalidate>
        <img class="mb-4" src="assets/icon.png" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Connexion</h1>
    
        <div class="form-floating">
          <input type="email" class="form-control" placeholder="nom@exemple.fr" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" name="email" id="email">
          <label for="floatingInput">Adresse électronique</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" class="form-control" name="mdp" placeholder="Mot de Passe">
          <label for="floatingPassword">Mot de Passe</label>
        </div>
    
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me"> Se Souvenir de moi
          </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit" value="Valider" name="connexion">Connexion</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2021-2022</p>
      </form>
    
<?php
//Si l'utilisateur est inconnu alors on le revoie sur un formualire est on affiche une alert
if(isset($userInconnu)) {
  echo '
  <br>
  <div class="alert alert-danger" id="bloc" style="display:none role="alert">
  Email ou mot de passe incorrect.
  </div>
  <script>
  document.getElementById("bloc").style.display="block";
  setTimeout(function(){document.getElementById("bloc").style.display="none";},5000);
  </script>';
}
?>
  </main>
<?php
include ('includes/footer.php'); 
?>