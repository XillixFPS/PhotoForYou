<?php
include ('includes/header.php');
$req= "SELECT * FROM photo,users WHERE idphoto = ".$_GET["idphoto"]." AND users.iduser = photo.iduser";
$ins=$dbh->prepare($req);
$ins->execute();
$num = $ins->fetchAll();
$photo = $dbh -> query('SELECT * FROM photo,users,tags WHERE users.iduser = photo.iduser AND tags.idtags = photo.idtags AND tags.activeTags=1 AND idphoto != '.$_GET["idphoto"].' AND idphoto NOT IN (SELECT idphoto FROM acheter) ORDER BY idphoto DESC LIMIT 4');
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
                <div class='fs-5 mb-5'>
                    <span>".$value["prix"]." </span> <i class='bi bi-coin'></i>
                </div>
                <p class='lead'>Photographe: ".$value["nom"]."\t". $value["prenom"]."</p>
                <div class='d-flex'>";
                if(isset($_SESSION['login'])){
                    if($_SESSION['categorie']!=7 AND $_SESSION['categorie']!=3){
                        
                        echo "
                        <input name='idphotographe' type='hidden' value=".$value['iduser'].">
                        <input name='creditphotographe' type='hidden' value=".$value['credit'].">
                        <input name='prix' type='hidden' value=".$value['prix'].">
                        <button class='btn btn-outline-success flex-shrink-0' type='submit' name='acheter' value='acheter'>
                        <i class='bi-cart-fill me-1'></i>
                        Acheter cette photo !
                        </button>
                </div>
            </div>";
                }
                }
		?>
		   </div>
        </div>
        </fieldset>
    </form>
</section>
<?php
    if(isset($_POST['acheter'])){
        if($_SESSION['credit']<$_POST['prix']){
            echo "Vous n'avez pas assez de crédit";
        }
        else{
            $iduser = $_SESSION['id'];
            $idphoto = $_GET['idphoto'];
            $prix = $_POST['prix'];
            $newcredit_user = $_SESSION['credit']-$prix;
            $iduser_photographe = $_POST['idphotographe'];
            $newcredit_photographe = $_POST['creditphotographe']+$prix;

            $sql = $dbh->prepare('INSERT INTO photoforyou.acheter(iduser,idphoto) VALUES (:iduser, :idphoto)');
            $sql->bindParam(':iduser', $iduser, PDO::PARAM_STR);
            $sql->bindParam(':idphoto', $idphoto, PDO::PARAM_STR);
            $sql1 = $dbh->prepare('UPDATE photoforyou.users SET credit = credit - :prix WHERE iduser = :iduser');
            $sql1->bindParam(':iduser', $iduser, PDO::PARAM_STR);
            $sql1->bindParam(':prix', $prix, PDO::PARAM_STR);
            $_SESSION['credit']=$newcredit_user;
            $sql2=$dbh->prepare('UPDATE photoforyou.users SET credit = credit + :prix WHERE iduser =:iduser_photographe');
            $sql2->bindParam('iduser_photographe', $iduser_photographe, PDO::PARAM_STR);
            $sql2->bindParam(':prix', $prix, PDO::PARAM_STR);
              } 
            try
            {
                $sql->execute();
                $sql1->execute();
                $sql2->execute();
                echo '<script>location.href=".";</script>';
            }
            catch(PDOException $e)
            {
              echo"<br> Erreur:". $e->getMessage();
            }
        }
?>

<section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Celle-ci pourrait vous plaire !</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        <?php
        foreach($photo as $value)
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
</section>
</main>
</body>
    
<?php
include ('includes/footer.php'); 
?>