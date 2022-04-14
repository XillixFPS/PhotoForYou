<!-- Cette page permet à un utilisateur d'éditer son profil -->

<?php
include("includes/header.php");
include("includes/dbconnect.php");

//Si on n'est pas connecté
if($_SESSION['login']!=true)
{
    //On redirige le visiteur sur la page de connexion
    header('Location: connexion.php');
}//fin if

//On va attribuer des valeurs aux nombres qui correspond aux catégories pour l'affichage
//On attibue à la valeur 1, la chaine de caractère Client
//On attribue à la valeur 3, la chaine de caractère Photographe;
//On attribue à la valeur 7, la chaine de caractère Administrateur
switch($_SESSION['categorie'])
{
    case 1: $categorie="Client";break;
    case 3: $categorie="Photographe";break;
    case 7: $categorie="Administrateur";break;
}//fin switch

//Si la variable $_SESSION['id'] est crée alors on fait les differentes requêtes pour modifier les informations du profils
if(isset($_POST['submit']))
{
    //On récupére toute les informations de l'utilisateur pour l'affichage
    $requser = $dbh->prepare("SELECT * FROM photoforyou.users WHERE iduser= ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();

    //Si on modifie le champs prenom du formulaire et qu'il change du prenom qui est stocké dans la base de données
    if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $user['prenom']) {
        $newprenom = htmlspecialchars($_POST['newprenom']);
        //Requête d'update de la base de données pour le prenom de l'utilisateur
        $insertprenom = $dbh->prepare("UPDATE photoforyou.users SET prenom = ? WHERE iduser = ?");
        $insertprenom->execute(array($newprenom, $_SESSION['id']));
        //On change le prenom dans la $_SESSION
        $_SESSION['prenom']=$newprenom;
        //On redirige l'utilisateur va la page de son profil
        //header('Location: voir-profil.php?id='.$_SESSION['id']);
    }//fin if prenom

    if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['nom']) {
        $newnom = htmlspecialchars($_POST['newnom']);
        $insertnom = $dbh->prepare("UPDATE photoforyou.users SET nom = ? WHERE iduser = ?");
        $insertnom->execute(array($newnom, $_SESSION['id']));
        $_SESSION['nom']=$newnom;
        //header('Location: voir-profil.php?id='.$_SESSION['id']);
    }//fin if nom

    if(isset($_POST['newtel']) AND !empty($_POST['newtel']) AND $_POST['newtel'] != $user['telUser']) {
        $newtel = htmlspecialchars($_POST['newtel']);
        $inserttel = $dbh->prepare("UPDATE photoforyou.users SET telUser = ? WHERE iduser = ?");
        $inserttel->execute(array($newtel, $_SESSION['id']));
        $_SESSION['tel']=$newtel;
        //header('Location: voir-profil.php?id='.$_SESSION['id']);
    }//fin if numéro de téléphone

    if(isset($_POST['newdate']) AND !empty($_POST['newdate']) AND $_POST['newdate'] != $user['dateNaiss']) {
        $newdate = htmlspecialchars($_POST['newdate']);
        $insertdate = $dbh->prepare("UPDATE photoforyou.users SET dateNaiss = ? WHERE iduser = ?");
        $insertdate->execute(array($newdate, $_SESSION['id']));
        $_SESSION['date']=$newdate;
        //header('Location: voir-profil.php?id='.$_SESSION['id']);
    }//fin if date de naissance

    if(isset($_POST['newadresse']) AND !empty($_POST['newadresse']) AND $_POST['newadresse'] != $user['adresse']) {
        $newadresse = htmlspecialchars($_POST['newadresse']);
        $insertadresse = $dbh->prepare("UPDATE photoforyou.users SET adressUser = ? WHERE iduser = ?");
        $insertadresse->execute(array($newadresse, $_SESSION['id']));
        $_SESSION['adresse']=$newadresse;
       //header('Location: voir-profil.php?id='.$_SESSION['id']);
    }//fin if adresse

    if(isset($_POST['newsite']) AND !empty($_POST['newsite']) AND $_POST['newsite'] != $user['site']) {
        $newsite = htmlspecialchars($_POST['newsite']);
        $insertsite = $dbh->prepare("UPDATE photoforyou.users SET siteUser = ? WHERE iduser = ?");
        $insertsite->execute(array($newsite, $_SESSION['id']));
        $_SESSION['site']=$newsite;
        //header('Location: voir-profil.php?id='.$_SESSION['id']);
    }//fin if site

}//fin if $_SESSION
?>
<!DOCTYPE html>
<html>
<head>
	<title>Editer le profil - PhotoForYou</title>
</head>
<body>
<form action="" method="post">
    <fieldset>
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
              <?php echo "<img class='rounded-circle mt-5' width='150px' src='images/profil/".($_SESSION["photouser"])."'>
                <label class='form-label'>Photo</label>
                <input class='form-control' type='file' id='disabledInput' name='newphoto' accept='image/jpeg, image/png, image/gif' disabled>
                <span class='font-weight-bold'>".($_SESSION['prenom'])."\t".($_SESSION['nom'])."</span>
                <span class='text-black-50'>".($_SESSION['email'])."</span>
                <span> </span>";?>
            </div><!-- fin div d-flex -->
        </div><!-- fin div col-md-3 -->
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Éditer le profile</h4>
                </div><!-- fin div d-flex -->
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Prenom</label><?php echo"<input type='text' class='form-control' placeholder='Prenom' name='newprenom' value='".$_SESSION["prenom"]."'>";?></div>
                    <div class="col-md-6"><label class="labels">Nom</label><?php echo"<input type='text' class='form-control' placeholder='Nom' name='newnom' value='".$_SESSION["nom"]."'>";?></div>
                </div><!-- fin div row -->
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Statut</label><?php echo"<input type='text' class='form-control' id='disabledInput' value='".$categorie."' disabled>";?></div>
                    <div class="col-md-12"><label class="labels">Numéro de Téléphone</label><?php echo"<input type='text' class='form-control' placeholder='Téléphone' name='newtel' value='".$_SESSION["tel"]."'>";?></div>
                    <div class="col-md-12"><label class="labels">Date de Naissance</label><?php echo"<input type='date' class='form-control' placeholder='Date de Naissance' name='newdate' value='".$_SESSION["date"]."'>";?></div>
                    <div class="col-md-12"><label class="labels">Adresse</label><?php echo"<input type='text' class='form-control' placeholder='Adresse' name='newadresse' value='".$_SESSION["adresse"]."'>";?></div>
                    <?php if($_SESSION['categorie']!=7 AND $_SESSION['categorie']!=1)
                    {
                    echo"<div class='col-md-12'><label class='labels'>Site</label><?php echo'<input type='text' class='form-control' placeholder='Site' name='newsite' value='".$_SESSION["site"]."'>?></div>
                    <div class='col-md-12'><label class='labels'>SIRET</label><input type='text' class='form-control' placeholder='Siret' value='".$_SESSION["siret"]."'></div>";
                    }
                    ?>
                </div><!-- fin div row -->
            
                <div class="mt-5 text-center"><input type="submit" value="Confirmer"  class="btn btn-primary" name="submit" /></div>
            </div><!-- fin div p-3 -->
        </div><!-- fin div col-md-5 -->
    </div><!-- fin div row -->
</div><!-- fin div container -->
</fieldset>
</form>
</body>
<?php
include ('includes/footer.php'); 
?>