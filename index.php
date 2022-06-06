<?php

session_start();

require('./html/index.html');

function connexion_bdd(){
$db_username = 'root';
$db_password = '';
$db_name = 'users';
$db_host = 'localhost';
$db = mysqli_connect($db_host, $db_username, $db_password, $db_name)
    or die('Connexion impossible à la base de données');
    return $db;
}

function verify_mail_mobile($mm){
    if(str_contains($mm, '@')){
        return "mail";
    }

    return "tel";
}

function est_dans_bdd($login, $motdepasse,$isMail){
    global $conn;

    if($isMail){
        $results = mysqli_query($conn,"select * from user_mail where mail='$login' and mdp='$motdepasse';");
    } else {
        $results = mysqli_query($conn,"select * from user_tel where tel='$login' and mdp='$motdepasse';");
    }

    if(!$results)
    return false;

    return true;
}

function est_dans_bdd_mail_mobile($login,$isMail){
    global $conn;

    if($isMail){
        $results = mysqli_query($conn,"select * from user_mail where mail='$login';");
    } else {
        $results = mysqli_query($conn,"select * from user_tel where tel='$login';");   
    }

    $num_rows = 0;

    while ($row = mysqli_fetch_array($results)){
   $num_rows++;

    if($num_rows>0){
    return true;
    }
}

    return false;
}

function connexion_utilisateur($login, $motdepasse){
    $isMail=verify_mail_mobile($login)=="mail";

    if (!est_dans_bdd($login,$motdepasse,$isMail)) 
        return false;
    
    return true;

}


function inscription_utilisateur($prenom,$nom,$mailMobile,$mdp,$dateNaissance,$sexe){
    Global $conn;
    
    $isMail=verify_mail_mobile($mailMobile)=="mail";
    
    if(est_dans_bdd_mail_mobile($mailMobile,$isMail)){
    return false;

    }


    if($isMail){
    $sql = "insert into user_mail values ('$prenom','$nom','$mailMobile','$mdp','$dateNaissance','$sexe');";
    if (mysqli_query($conn, $sql)) {
       return true;
    } else {
       echo "Error: " . $sql . ":-" . mysqli_error($conn);
       return false;
    }
}

else {
    $sql = "insert into user_tel values ('$prenom','$nom','$mailMobile','$mdp','$dateNaissance','$sexe');";
    if (mysqli_query($conn, $sql)) {
       return true;
    } else {
       echo "Error: " . $sql . ":-" . mysqli_error($conn);
       return false;
    }

}
    
}

function get_prenom_nom($login){
    Global $conn;

    $results = mysqli_query($conn,"select prenom,nom from user_tel where tel='$login';");
    $row = mysqli_fetch_row($results);

    return $row;


}

function submit(){
if(!empty($_POST))
{    
    $form = htmlspecialchars($_POST["form"]);
    
    $mailMobile = htmlspecialchars($_POST['mail-mobile']);
    $mdp = htmlspecialchars($_POST['mdp']);
   
    //inscription
    if($form=="inscription"){

    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $sexe = htmlspecialchars($_POST['sexe']);
    $dateNaissance = htmlspecialchars($_POST['annee']) . "-" .  htmlspecialchars($_POST['mois']) . "-" . htmlspecialchars($_POST['jour']);

        if(inscription_utilisateur($prenom,$nom,$mailMobile,$mdp,$dateNaissance,$sexe)){
            echo "Bienvenu parmi nous " . $prenom . ' ' . $nom;
        } else {
            echo "<script> alert('Le e-mail ou le mobile que vous avez renseigné est déjà utilisé.') </script>";
        }
    } else {  //connexion
       
        if (connexion_utilisateur($mailMobile,$mdp)){
            $noms = get_prenom_nom($mailMobile);
           echo "Bienvenu parmi nous " . $noms[0] . " " . $noms[1] ;
        } else {
            echo "<script> alert('Votre e-mail, mobile, ou mot de passe est faux. ') </script>";
        }

    }
}
}


$conn =  connexion_bdd();

submit();

mysqli_close($conn);


?>
