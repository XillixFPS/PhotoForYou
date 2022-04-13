<?php
include ('includes/header.php');
?>
<section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Choisir le type d'inscription</h1>
        <p class="lead text-muted">Vous êtes un client ou un photographe ?</p>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <a style='color:#000000; text-decoration: none; text-align: center;' href='form-inscription-client.php'>
      <div class='col'>
          <div class='card shadow-sm'>
            <div class='card-body'>
              <h5 class='card-title'>Client</h5>
            </div>
          </div>
        </div>
      </a>

      <a style='color:#000000; text-decoration: none; text-align: center;' href='form-inscription-photographe.php'>
      <div class='col'>
          <div class='card shadow-sm'>
            <div class='card-body'>
              <h5 class='card-title'>Photographe</h5>
            </div>
          </div>
        </div>
      </a>
      </div>
</div>
</div>
<?php
include ('includes/footer.php'); 
?>