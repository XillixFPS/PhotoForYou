<!-- Cette page permet d'acheter des crédits, on propose trois options(10,50,100€) pour avoir des crédits -->

<?php
include('includes/header.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Acheter des crédits - PhotoForYou</title>
</head>
<div class="container py-3">
  <main>
    <form action="" method="post">
      <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
        <div class="col">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
              <h4 class="my-0 fw-normal">Option 1</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">10€</h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>500 crédits</li>
              </ul>
              <button type="submit" class="w-100 btn btn-lg btn-outline-primary" name="option1">Acheter</button>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
              <h4 class="my-0 fw-normal">Option 2</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">50€</h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>1500 crédits</li>
              </ul>
              <button type="submit" class="w-100 btn btn-lg btn-outline-primary" name="option2">Acheter</button>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
              <h4 class="my-0 fw-normal">Option 3</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">100€</h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>3500 crédits</li>
              </ul>
              <button type="submit" class="w-100 btn btn-lg btn-outline-primary" name="option3">Acheter</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </main>
</div>
<?php

//Requête pour ajouter 500 crédits au compte d'un utilisateur(option 1)
if(isset($_POST["option1"])){
  $newcredit = $_SESSION['credit']+500;
  $insertcredit = $dbh->prepare("UPDATE photoforyou.users SET credit = ? WHERE iduser = ?");
  $insertcredit->execute(array($newcredit, $_SESSION['id']));
  $_SESSION['credit']=$newcredit;
  echo '<script>location.href="credit.php";</script>';
}

//Requête pour ajouter 1500 crédits au compte d'un utilisateur(option 2)
if(isset($_POST["option2"])){
  $newcredit = $_SESSION['credit']+1500;
  $insertcredit = $dbh->prepare("UPDATE photoforyou.users SET credit = ? WHERE iduser = ?");
  $insertcredit->execute(array($newcredit, $_SESSION['id']));
  $_SESSION['credit']=$newcredit;
  echo '<script>location.href="credit.php";</script>';
}

//Requête pour ajouter 3500 crédits au compte d'un utilisateur(option 3)
if(isset($_POST["option3"])){
  $newcredit = $_SESSION['credit']+3500;
  $insertcredit = $dbh->prepare("UPDATE photoforyou.users SET credit = ? WHERE iduser = ?");
  $insertcredit->execute(array($newcredit, $_SESSION['id']));
  $_SESSION['credit']=$newcredit;
  echo '<script>location.href="credit.php";</script>';
}
?>
<?php
include('includes/footer.php');
?>