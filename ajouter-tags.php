<!-- Cette page permet d'ajouter des tags, pour que les photographes puisse catégoriser leurs photographies
Cette page est accesible par les photographes et les admins -->

<?php
include('includes/header.php');
include ("includes/dbconnect.php");

//Si on est client ou visteur, on est redirigé vers la page d'erreur
if($_SESSION['categorie']<2)
{
    header('Location: page-erreur.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ajouter une catégorie - PhotoForYou</title>
</head>
<body>

<div class="container">
  <div class="jumbotron">
    <form  method="post" action=""  id="form"  enctype="multipart/form-data" novalidate>
      <fieldset>
        <legend>Créer un tag</legend>
          <div class="form-group row">
            <div class="col-md-4 mb-3">
              <label for="prenom">Libellé du Tags</label>
                <input type="text" class="form-control" pattern="[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ-]+" minlength="3" maxlength="30" name="tag" id="tag" placeholder="Libellé du tag" required>
                <br><input type="submit" value="Confirmer" class="btn btn-info" name="submit" />
                <a href="gerer-tags.php"><input type="button" value="Retour" class="btn btn-primary"/></a>    
            </div>
          </div>
      </fieldset><!-- fin fieldset -->
    </form><!-- fin formulaire -->
  </div><!-- fin div jumbotron -->
</div><!-- fin div container -->

<?php
include ('includes/footer.php'); 

//Quand on appuye sur le bouton submit, on crée le tag et on l'ajoute dans la base de données
if (isset($_POST['submit']))
{
    $tag = $_POST['tag'];
    $ok=TRUE;

    if(strlen($tag)<3 && strlen($tag)>45 && !preg_match("[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ-]+", $tag)){
        $ok=FALSE;
    }
    if ($ok=TRUE){
        $sql = $dbh->prepare('INSERT INTO photoforyou.tags(libelleTags, activeTags, iduserTags) VALUES (:tag, 0, '.$_SESSION['id'].')');
        $sql->bindParam(':tag', $tag, PDO::PARAM_STR);
    try
    {
        $sql->execute();
    }
    catch(PDOException $e)
    {
      echo"<br> Erreur:". $e->getMessage();
    }
    }
}
?>

<!-- Script qui vérifie si tous les champs sont remplis -->
<script>
(function() {
  "use strict"
  window.addEventListener("load", function() {
    var form = document.getElementById("form")
    form.addEventListener("submit", function(event) {
      if (form.checkValidity() == false) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add("was-validated")
    }, false)
  }, false)

}())
</script>