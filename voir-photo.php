<?php
include ('includes/header.php'); 
if(isset($_GET['idtags'])){
  $photo = $dbh -> query('SELECT * FROM photo,users,tags WHERE photo.iduser = users.iduser AND tags.idtags = photo.idtags AND tags.idtags = '.$_GET['idtags'].' AND tags.activeTags=1 AND idphoto NOT IN (SELECT idphoto FROM acheter) ORDER BY idphoto DESC;');
}
else{
  $photo = $dbh -> query('SELECT * FROM photo,users,tags WHERE photo.iduser = users.iduser AND tags.idtags = photo.idtags AND tags.activeTags=1 AND idphoto NOT IN (SELECT idphoto FROM acheter) ORDER BY idphoto DESC;');
}

?>

<section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Album photo</h1>
        <p class="lead text-muted">Acheter des photos prises et vendu par des professionnels</p>
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
                            <img class='card-img-top' src='images/photos/".htmlentities($value['nomimage'])."' oncontextmenu='return false' alt='...'/>
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
                                    <small class='text-muted'>".$value["libelleTags"]."</small>
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
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Autre catégorie</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
       <?php
       $tags = $dbh -> query('SELECT * FROM tags WHERE activeTags=1 ORDER BY idtags DESC');
       foreach ($tags as $value)
       echo"
       <a style='color:#000000; text-decoration: none; text-align: center;' href='voir-photo?idtags=".$value['idtags']."'>
       <div class='col'>
         <div class='card shadow-sm'>
           <div class='card-body'>
             <h5 class='card-title'>".$value["libelleTags"]."</h5>
           </div>
         </div>
       </div>
       </a>";
       ?>
       </div>
       </div>
       </section>

    
<?php
include ('includes/footer.php'); 
?>