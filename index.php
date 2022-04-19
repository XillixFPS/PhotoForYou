<?php
include ('includes/header.php');
?>
<div class="container text-center">

  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-2" src="assets/icon.png" alt="logo photoforyou" width="10%" height="auto">
      <h1 class="display-5">PhotoForYou</h1>
        <p class="lead">Des pros au service des professionnels de la communication.</p>
  </div>

  <main>
    
      <!-- Carrousel -->
	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  		<div class="carousel-inner">
    		<div class="carousel-item active">
     			<img src="images/carrousel/carrousel1.png" class="d-block w-100" alt="...">
    		</div>
    		<div class="carousel-item">
      			<img src="images/carrousel/carrousel2.png" class="d-block w-100" alt="...">
    		</div>
    		<div class="carousel-item">
      			<img src="images/carrousel/carrousel3.png" class="d-block w-100" alt="...">
    		</div>
  		</div>
  		<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    		<span class="sr-only"></span>
  		</a>
  		<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    		<span class="carousel-control-next-icon" aria-hidden="true"></span>
    		<span class="sr-only"></span>
  		</a>
	</div>
	<div class="jumbotron ">
  		<p class="lead">Moins de temps à chercher. Plus de résultats.</p>
			<p class="lead">Découvrez les images qui vous aideront à vous démarquer.</p>
      <div class="d-grid gap-2 d-md-flex justify-content-md-center">
            <div class="modal fade" id="exampleModalToggle" role="dialog" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-5 shadow">
                  <div class="modal-header p-5 pb-4 border-bottom-0">
                      <h2 class="fw-bold mb-0">Connexion</h2>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div><!-- fin div modal-header -->
        
                  <div class="modal-body p-5 pt-0 text-center">
                    <img class="mb-4" src="assets/icon.png" alt="" width="72" height="57"><!-- Icône du site -->
                      <form method="POST" action="connexion.php"><!-- Formulaire de connexion -->
                        <div class="form-floating mb-3">
                          <input type="email" class="form-control rounded-4"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" name="email" id="floatingInput" placeholder="nom@exemple.fr">
                          <label for="floatingInput">Email</label><!-- Champs formulaire pour l'Email -->
                        </div><!-- fin div form-floating -->
                        <div class="form-floating mb-3">
                          <input type="password" class="form-control rounded-4" id="floatingPassword" placeholder="Mot de passe" name="mdp" >
                          <label for="floatingPassword">Mot de Passe</label><!-- Champs formualire pour le mots de passe -->
                        </div><!-- fin div form-floating -->
                        <div class="checkbox mb-3">
                          <label>
                            <input type="checkbox" value="remember-me"> Se Souvenir de moi
                          </label>
                        </div><!-- fin div form-floating -->
                          <button class="w-100 mb-2 btn btn-lg rounded-4 btn-primary" name="connexion" value="Valider" type="submit">Connexion</button><!-- Bouton de connexion -->
                          <p class="mt-5 mb-3 text-muted">&copy; 2021-2022</p>
                          <hr class="my-4">
                          <h2 class="fs-5 fw-bold mb-3">Ou créez-vous un compte</h2>
                          <a class="w-100 py-2 mb-2 btn btn-outline-dark rounded-4" href="form-inscription-client.php" role="button">Créer un Compte Client</a>
                          <a class="w-100 py-2 mb-2 btn btn-outline-dark rounded-4" href="form-inscription-photographe.php" role="button">Créer un Compte Photographe</a>
                      </form><!-- fin du formulaire -->
                  </div><!-- fin div modal-body -->
                </div><!-- fin div modal-content -->
              </div><!-- fin div modal-dialog -->
            </div><!-- fin div modal -->
            <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Inscrivez vous !</a>
          </div>
	</div>


    
    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

    </div><!-- /.container -->
  </main>
  </div>
<?php
include ('includes/footer.php'); 
?>

