<!--Page d'ajout d'articles sur la page index (TEST)-->
<?php
include("includes/header.php");
include("includes/dbconnect.php");
$contenu = $dbh -> query('SELECT * FROM photo, users WHERE users.iduser = photo.iduser;');

if($_SESSION['categorie']!=3)
{
    header('Location: page_erreur.php');
}

$tags = $dbh -> query('SELECT * FROM tags')
?>
<div class="container">
<!--Début Formulaire-->
<form  class="need-validate" method="post" action="#" id="form" enctype="multipart/form-data" novalidate >
    <fieldset>
        <legend>Vendre photographie</legend>
    <div class="mb-3">
        <label for="titre" class="form-label">Titre</label>
        <input type="text" class="form-control" id="libelle" name="libelle" placeholder="Titre de votre photographie" required>
        <div class="invalid-feedback">
        Le champ est obligatoire
        </div>
    </div>

    <div class="mb-3">
        <label for="commentaire" class="form-label">Prix</label>
        <input type="integer" class="form-control" id="prix" name="prix" placeholder="Prix" required>
        <div class="invalid-feedback">
        Le champ est obligatoire
        </div>
    </div>
    <div class="form-group row">
      <div class="col-md-4 mb-3">
        <label class="form-label" for="nom">Photographie</label>
        <input class="form-control" type="file" onchange="actuPhoto(this)" id="nomimage" name="nomimage" accept="image/jpeg, image/png" required>
      </div>
    </div>
    <img src="" id="photo" style='width:50%'; height:'auto'; class="img-responsive float-right">
    <br>
    <div class="col-auto my-1">
      <label class="mr-sm-2" for="inlineFormCustomSelect">Choisir Tags de la Photo</label>
      <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="tags">
        <option selected></option>
        <?php
        foreach ($tags as $value)
        echo "<option value=".$value["idtags"].">".$value["libelleTags"]."</option>";
        ?>
      </select>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Confirmer</button>
    </fieldset>
</form>
<!--Fin Formulaire-->
</div>

<?php
include ('includes/footer.php'); 
?>

<script type="text/javascript" >
function actuPhoto(element)
{
  var image=document.getElementById("nomimage");
  var fReader = new FileReader();
  fReader.readAsDataURL(image.files[0]);
  fReader.onloadend = function(event)
  {
    var img = document.getElementById("photo");
    img.src = event.target.result;
  }
}

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
<?php
if($_FILES)
{
  switch($_FILES['nomimage']['type'])
  {
    case 'image/jpeg': $extention = 'jpg'; break;
    case 'image/gif': $extention = 'gif'; break;
    case 'image/png': $extention = 'png'; break;
    case 'image/tif': $extention = 'tif'; break;
    case 'image/png': $extention = 'png'; break;
    default:          $extention=''; break;
  }
  if($extention && $_FILES['nomimage']['size']< 30 * 1024 * 1024)
  {
      //Changer le nom de l'image
      $characts='abcdefghijklmnopqrstuvwxyz';
      $characts.='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $characts.='1234567890';
      $code_aleatoire='';
      for($i=0;$i<20;$i++)
      {
          $code_aleatoire .=substr($characts,rand()%(strlen($characts)),1);
      }
  
      $nom_fichier = $code_aleatoire.".".$extention;
      $fileName= $_FILES['nomimage']['name'];
      $sizePhoto= $_FILES['nomimage']['size'];
      $tempName = $_FILES['nomimage']['tmp_name'];
      $titre = $_POST['libelle'];
      $com = $_POST['prix'];
      $id = $_SESSION['id'];
      $tags = $_POST['tags'];

      $sql = $dbh->prepare('INSERT INTO photoforyou.photo(libelle,nomimage,prix,datePub,iduser,poids,photolargeur,idtags) VALUES (:libelle,:img,:prix,NOW(),:iduser, :poids, :largeur,:tags)');
      $sql->bindParam(':libelle', $titre, PDO::PARAM_STR);
      $sql->bindParam(':img', $nom_fichier, PDO::PARAM_STR);
      $sql->bindParam(':prix', $com, PDO::PARAM_INT);
      $sql->bindParam(':iduser', $id, PDO::PARAM_INT);
      $sql->bindParam(':poids', $sizePhoto, PDO::PARAM_INT);
      $sql->bindParam(':largeur', $widthPhoto, PDO::PARAM_INT);
      $sql->bindParam(':tags', $tags, PDO::PARAM_INT);
      try
      {
          $sql->execute();
          echo "<br>";
          echo "Photographie Ajouter";
      }
      catch(PDOException $e)
      {
          echo"<br> Erreur:". $e->getMessage();
      }
      if(isset($fileName))
      {
          if(!empty($fileName))
          {
            $location = "images/photos/";
            if(move_uploaded_file($tempName, $location.$nom_fichier))
              {
                echo 'Image Envoyé';
              }
          }
      }
    }
    else
    {
      if(!$extention) echo $_FILES['nomimage']['name']."n'est pas accepté comme fichier image";
      else echo "L'image dépasse les 30 Mo";
    }
  }


  
       
?>
