<?php
include("includes/header.php");
include("includes/dbconnect.php");
if($_SESSION['login']!=true)
{
    header('Location: connexion.php');
}
switch($_SESSION['categorie'])
{
    case 1: $categorie="Client";break;
    case 3: $categorie="Photographe";break;
    case 7: $categorie="Administrateur";break;
}
$photo = $dbh -> query('SELECT * FROM photo,users WHERE users.iduser = photo.iduser AND photo.iduser = '.$_SESSION["id"].' ORDER BY idphoto DESC');
$photoacheter = $dbh -> query('SELECT * FROM acheter,tags,users,photo WHERE acheter.iduser = users.iduser AND acheter.idphoto = photo.idphoto AND tags.idtags = photo.idtags AND acheter.iduser = '.$_SESSION['id'].' ORDER BY photo.idphoto DESC');
$nombrephoto = $dbh -> query("SELECT nombre_photo(".$_SESSION['id'].")");
$nbr=$nombrephoto->fetch();
?>
<body>
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
              <?php echo "<img class='rounded-circle mt-5' width='150px' src='images/profil/".$_SESSION["photouser"]."'>
              <span class='font-weight-bold'>".htmlentities($_SESSION['prenom'])."\t".$_SESSION['nom']."</span>
              <span class='text-black-50'>".htmlentities($_SESSION['email'])."</span>
              <span> </span>";?>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <?php echo "<h4 class='text-right'>Profil de"."\t".$_SESSION['prenom']."\t".$_SESSION['nom']."</h4>"?>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Prenom</label><?php echo"<span class='form-control font-weight-bold'>"."\t".$_SESSION['prenom']."</span>";?></div>
                    <div class="col-md-6"><label class="labels">Nom</label><?php echo"<span class='form-control font-weight-bold'>"."\t".$_SESSION['nom']."</span>";?></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Statut</label><?php echo"<span class='form-control font-weight-bold'>"."\t".htmlentities($categorie)."</span>";?></div>
                    <div class="col-md-12"><label class="labels">Numéro de Téléphone</label><?php echo"<span class='form-control font-weight-bold'>"."\t".htmlentities($_SESSION['tel'])."</span>";?></div>
                    <div class="col-md-12"><label class="labels">Date de Naissance</label><?php echo"<span class='form-control font-weight-bold'>"."\t".htmlentities($_SESSION['date'])."</span>";?></div>
                    <div class="col-md-12"><label class="labels">Adresse</label><?php echo"<span class='form-control font-weight-bold'>"."\t".htmlentities($_SESSION['adresse'])."</span>";?></div>
            <?php 
            if($_SESSION['categorie']!=7 AND $_SESSION['categorie']!=1)
            {
            
              echo "<div class='col-md-12'><label class='labels'>Site</label><span class='form-control font-weight-bold'>"."\t".htmlentities($_SESSION['site'])."</span></div>
              <div class='col-md-12'><label class='labels'>SIRET</label><span class='form-control font-weight-bold'>"."\t".htmlentities($_SESSION['siret'])."</span></div>";
            }
            ?>
            </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><a class="btn btn-primary" href="editer-profil" role="button">Editer le profil</a></div><br>
                <div class="col-md-12"><label class="labels">Credit</label><?php echo"<span class='form-control font-weight-bold'>"."\t".htmlentities($_SESSION['credit'])." <i class='bi bi-coin'></i></span>";?></div> <br>
                <?php
                if($_SESSION['categorie']!=7 AND $_SESSION['categorie']!=1)
                {
                echo "<div class='col-md-12'><label class='label'>Nombre de Photos Posté</label><span class='form-control font-weight-bold'>$nbr[0]</span></div> </div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
if($_SESSION['categorie']!=7 AND $_SESSION['categorie']!=1)
{
?>

<section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Photo publiés par <?php echo $_SESSION['prenom']."\t".$_SESSION['nom']?></h1>
      </div>
    </div>
  </section>
  <div class='container px-4 px-lg-5 mt-5'>
    <div class='row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center'>
      <?php
        foreach ($photo as $value)
        echo"
        <div class='col mb-5'>
        <div class='card h-100'>
            <!-- Product image-->
            <img class='card-img-top' src='images/photos/".htmlentities($value['nomimage'])."' alt='...'/>
            <!-- Product details-->
            <div class='card-body p-4'>
                <div class='text-center'>
                    <!-- Product name-->
                    <h5 class='fw-bolder'>".$value["libelle"]."</h5>
                    <!-- Product price-->
                    ".$value["prix"]." <i class='bi bi-coin'></i> 
                    <br>
                    <small>".$value["prenom"]."\t". $value["nom"]."</small>
                    <br>
                </div>
            </div>
            <!-- Product actions-->
            <div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>
                <div class='text-center'><a class='btn btn-outline-dark mt-auto' href='photo?idphoto=".$value['idphoto']."'>Voir plus</a></div>
            </div>
        </div>
        </div>";
      ?>
    </div>
  </div>
<?php
};
?>

<?php
if($_SESSION['categorie']!=7 AND $_SESSION['categorie']!=3)
{
?>

<section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Photo acheter par <?php echo $_SESSION['prenom']."\t".$_SESSION['nom']?></h1>
      </div>
    </div>
  </section>
  <div class='container px-4 px-lg-5 mt-5'>
    <div class='row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center'>
      <?php
        foreach ($photoacheter as $value)
        echo"
        <div class='col mb-5'>
        <div class='card h-100'>
            <!-- Product image-->
            <img class='card-img-top' src='images/photos/".htmlentities($value['nomimage'])."' alt='...'/>
            <!-- Product details-->
            <div class='card-body p-4'>
                <div class='text-center'>
                    <!-- Product name-->
                    <h5 class='fw-bolder'>".$value["libelle"]."</h5>
                </div>
            </div>
            <!-- Product actions-->
            <div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>
                <div class='text-center'><a class='btn btn-outline-dark mt-auto' href='photo-acheter?idphoto=".$value['idphoto']."'>Voir plus</a></div>
            </div>
        </div>
        </div>";
      ?>
    </div>
  </div>
<?php
};
?>

<?php
include ('includes/footer.php'); 
?>