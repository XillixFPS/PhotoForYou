<?php
include ('includes/header.php');
$req= "SELECT * FROM photo,users WHERE idphoto = ".$_GET["idphoto"]." AND users.iduser = photo.iduser";
$ins=$dbh->prepare($req);
$ins->execute();
$num = $ins->fetchAll();
?>
<main>
<section class="py-5">
    <form action="" method="post">
        <fieldset>
        <div class="row mt-5" style="width: 100%;">
            <div class="col-2"></div>
                <div class="col-8 mt-5 card p-5" style="border-radius:1em; box-shadow: 0px 0px 20px 0px rgba(255,255,255,0.4);">
        <?php
			foreach ($num as $value)
            echo  "
            <div class='row gx-4 gx-lg-5 align-items-center'>
            <div class='col-md-6'><img class='card-img-top mb-5 mb-md-0' src='images/photos/".htmlentities($value['nomimage'])."' oncontextmenu='return false' alt='...' /></div>
            <div class='col-md-6'>
                <div class='small mb-1'>Date de publication : ".$value["datePub"]."</div>
                <h1 class='display-5 fw-bolder'>".$value["libelle"]."</h1>
                <p class='lead'>Photographe: ".$value["nom"]."\t". $value["prenom"]."</p>
                <p class='lead'>Appartient à ".$_SESSION["prenom"]."\t". $_SESSION["nom"]."</p>
                <div class='d-flex'>
                    <a class='btn btn-outline-success flex-shrink-0' href='images/photos/".htmlentities($value['nomimage'])."' download='".$value['libelle']."'><i class='bi bi-download'></i> Télécharger l'image</a>
                </div>
                ";
		?>
		   </div>
        </div>
        </fieldset>
    </form>
</section>
<?php
include ('includes/footer.php'); 
?>