<?php

include ("includes/dbconnect.php");
if (isset($_POST['submit']))
{
  // Traitement de la photo
  if($_FILES)
  {
    $nom_fichier = "profil.jpg";
    switch($_FILES['photoUser']['type'])
    {
      case 'image/jpeg': $extention = 'jpg'; break;
      case 'image/gif': $extention = 'gif'; break;
      case 'image/png': $extention = 'png'; break;
      case 'image/tif': $extention = 'tif'; break;
      case 'image/png': $extention = 'png'; break;
      default:          $extention=''; break;
    }
    if($extention && $_FILES['photoUser']['size']< 30 * 1024 * 1024)
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
        $fileName= $_FILES['photoUser']['name'];
        $tempName = $_FILES['photoUser']['tmp_name'];
        if(isset($fileName)){
          if(!empty($fileName)){
            $location = "images/profil/";
            if(move_uploaded_file($tempName, $location.$nom_fichier))
              {
                echo 'Image Envoyé';
              }
          }
          }
    }
    else
    {
      if(!$extention) echo $_FILES['photoUser']['name']."n'est pas accepté comme fichier image";
      else echo "L'image dépasse les 30 Mo";
    }
  }

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $date = $_POST['dateNaissance'];
    $siret = $_POST['siret'];
    $site = $_POST['siteWeb'];
    $mdp = hash("sha512",$_POST['motdepasse1']);

    $ok=TRUE;

    if(strlen($nom)<3 
    && strlen($nom)>45){
        $ok=FALSE;
    }

    if(strlen($prenom)<3 
    && strlen($prenom)>45){
        $ok=FALSE;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)
    && strlen($email)>45){
        $ok=FALSE;
    }

    if(strlen($siret)<14
    && strlen($siret)>14){
      $ok=FALSE;
    }

    if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$site))
    {
      $ok=FALSE;
    }

    if ($ok=TRUE){
    $sql = $dbh->prepare('INSERT INTO photoforyou.users(nom,prenom,email,mdp,dateNaiss,credit,active,categorie,photoUser, siteUser, siret) VALUES (InitCap(:nom),InitCap(:prenom),lower(:email),:mdp,:date,0,1,3,:photouser,lower(:site), :siret)');
    $sql->bindParam(':nom', $nom, PDO::PARAM_STR);
    $sql->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $sql->bindParam(':email', $email, PDO::PARAM_STR);
    $sql->bindParam(':mdp', $mdp, PDO::PARAM_STR);
    $sql->bindParam(':date', $date, PDO::PARAM_STR);
    $sql->bindParam(':photouser', $nom_fichier, PDO::PARAM_STR);
    $sql->bindParam(':site', $site, PDO::PARAM_STR);
    $sql->bindParam(':siret', $siret, PDO::PARAM_STR);
    try
    {
        $sql->execute();
        header('Location:inscription-reussie.php');
    }
    catch(PDOException $e)
    {
      echo"<br> Erreur:". $e->getMessage();
    }
    }
    else
    {
      header("Location:inscription.php");
    }
}
    else
    {
      header("Location:inscription.php");
    }

?>