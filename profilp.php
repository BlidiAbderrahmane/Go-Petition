<?php
    include "db_conn.php";
    session_start();
    $nom= $_POST['nom'];
    $prenom= $_POST['prenom'];
    $mail= $_POST['mail'];
    $oldmail = $_SESSION['mail'];
    $password= $_POST['password'];
    $vpassword= $_POST['vpassword'];

    if(!empty($nom) && !empty($prenom) && !empty($mail) && !empty($password) && !empty($vpassword) ){
        if ($password !== $vpassword){
            header("Location: profil.php?error= vérifier les deux champs de mot de passe");
            exit();
        }
        else{
            
            $sql="UPDATE membre SET nom='$nom', prenom='$prenom', mail='$mail', password='$password' WHERE mail='$oldmail' " ;
            $query = mysqli_query($conn, $sql);
            if ($query) {
                $_SESSION['mail'] = $mail;
                $_SESSION['password'] = $password;
                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
                header("Location: profil.php?success= Votre compte est modifié avec succès !");
                exit();
            }
            else {
                header("Location: profil.php?error= la modification a échoué");
                exit();
            }
                
        }
    }    
    else {
        if(empty($nom)){
            header("Location: profil.php?error= Le nom est requis.");
            exit();    
        }
        if(empty($prenom)){
            header("Location: profil.php?error= Le prénom est requis.");
            exit();    
        }
        if(empty($mail)){
            header("Location: profil.php?error= L'adresse email est requise.");
            exit();    
        }
        if(empty($password)){
            header("Location: profil.php?error= Le mot de passe est requis.");
            exit();   
        }
        if(empty($vpassword)){
            header("Location: profil.php?error= La vérification de mot de passe est requise.");
            exit();    
        }
    }
  
?>