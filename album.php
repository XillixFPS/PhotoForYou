<?php
include ('includes/header.php');
?>
<!--On affiche tous les tags si il est active (=1) -->
<?php 
$tags = $dbh -> query('SELECT * FROM tags WHERE activeTags=1 ORDER BY idtags DESC');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Album - PhotoForYou</title>
</head>
<body>

<main>
  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Album photo</h1>
        <p class="lead text-muted">Acheter des photos prises et vendu par des professionnels</p>
      </div><!-- fin div col-lg-6 -->
    </div><!-- fin div row -->
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <!-- On affiche les catégories, il y a une en brut (Toutes les photos) et les autres seront affichés grâce au PHP et une requête SQL -->
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <a style='color:#000000; text-decoration: none; text-align: center;' href='voir-photo.php'>
        <div class='col'>
            <div class='card shadow-sm'>
              <div class='card-body'>
                <h5 class='card-title'>Toutes les photos</h5>
              </div><!-- fin div card-body -->
            </div><!-- fin div card -->
        </div><!-- fin div col -->
      </a>
      <?php
        foreach ($tags as $value)
        echo"
        <a style='color:#000000; text-decoration: none; text-align: center;' href='voir-photo.php?idtags=".$value['idtags']."'>
        <div class='col'>
          <div class='card shadow-sm'>
            <div class='card-body'>
              <h5 class='card-title'>".$value["libelleTags"]."</h5>
            </div>
          </div>
        </div>
        </a>";
        ?>
      </div><!-- fin div row -->
    </div><!-- fin div container -->
  </div><!-- fin div album -->
</main>
<?php
include ('includes/footer.php'); 
?>