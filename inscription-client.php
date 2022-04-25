<?php

include ("includes/dbconnect.php");
if (isset($_POST['submit']))
{
  // Traitement de la photo
  if($_FILES)
  {
    $nomfichier = "profil.jpg";
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
        $nomfichier = $code_aleatoire.".".$extention;
        $fileName= $_FILES['photoUser']['name'];
        $tempName = $_FILES['photoUser']['tmp_name'];
        if(isset($fileName)){
          if(!empty($fileName)){
            $location = "images/profil/";
            move_uploaded_file($tempName, $location.$nomfichier);
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
    $mdp = hash("sha512",$_POST['motdepasse1']);

    $ok=TRUE;

    if(strlen($nom)<3 
    || strlen($nom)>45){
        $ok=FALSE;
    }

    if(strlen($prenom)<3 
    || strlen($prenom)>45){
        $ok=FALSE;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)
    || strlen($email)>45){
        $ok=FALSE;
    }

    if ($ok=TRUE){
    $sql = $dbh->prepare('INSERT INTO photoforyou.users(nom,prenom,email,mdp,dateNaiss,credit,active,categorie,photoUser) VALUES (InitCap(:nom),InitCap(:prenom),lower(:email),:mdp,:date,0,1,1,:photouser)');
    $sql->bindParam(':nom', $nom, PDO::PARAM_STR);
    $sql->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $sql->bindParam(':email', $email, PDO::PARAM_STR);
    $sql->bindParam(':mdp', $mdp, PDO::PARAM_STR);
    $sql->bindParam(':date', $date, PDO::PARAM_STR);
    $sql->bindParam(':photouser', $nomfichier, PDO::PARAM_STR);
    try
    {
        $sql->execute();
        header('Location:inscription-reussie');
    }
    catch(PDOException $e)
    {
      echo"<br> Erreur:". $e->getMessage();
    }
    }
    else
    {
      header("Location:formulaire-inscription-client");
    }
}
    else
    {
      header("Location:formulaire-inscription-client");
    }
   
}
?>