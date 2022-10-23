<?php
    include "db_conn.php";
    $nom= $_POST['nom'];
    $prenom= $_POST['prenom'];
    $mail= $_POST['mail'];
    $password= $_POST['password'];
    $vpassword= $_POST['vpassword'];
    $type= $_POST ['RadioGroup1'];

    $sql = "SELECT * FROM membre WHERE mail='$mail' ";
    $result = mysqli_query($conn, $sql);

    if( !empty($nom) && !empty($prenom) && !empty($mail) && !empty($password) && !empty($vpassword) && !empty($type) ){
        if (mysqli_num_rows($result) === 1) {
            header("Location: login.php?error= Un utilisateur de cet email est déja inscrit");
            exit();
        }
        else if ($password !== $vpassword){
            header("Location: login.php?error= vérifier les deux champs de code");
            exit();
        }
        else{
            if(!file_exists($_FILES['avatar']['tmp_name']) || !is_uploaded_file($_FILES['avatar']['tmp_name'])) {
                $sqli="INSERT INTO membre (nom,prenom,mail,password,type) VALUES ( '$nom','$prenom','$mail','$password','$type')" ;
                $query = mysqli_query($conn, $sqli);
                if ($query) {
                    header("Location: login.php?success= Votre compte est ajouté avec succès !");
                    exit();
                }
                else {
                    header("Location: login.php?error= l'inscription a échoué");
                    exit();
                }
            }
            else {
                require_once 'db_conn_img.php'; 
                $fileName = basename($_FILES["avatar"]["name"]); 
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                $image = $_FILES['avatar']['tmp_name']; 
                $imgContent = addslashes(file_get_contents($image)); 
                $insert = $db->query("INSERT into membre (nom,prenom,mail,password,type,imgName,imgBin) VALUES ('$nom','$prenom','$mail','$password','$type','$fileName','$imgContent')");
                if ($insert) {
                    header("Location: login.php?success= Votre compte est ajouté avec succès !");
                    exit();
                }
                else {
                    header("Location: login.php?error= l'inscription a échoué");
                    exit();
                }
                
            }
        }
    }    
    else {
        if(empty($nom)){
            header("Location: login.php?error= Le nom est requis.");
            exit();    
        }
        if(empty($prenom)){
            header("Location: login.php?error= Le prénom est requis.");
            exit();    
        }
        if(empty($mail)){
            header("Location: login.php?error= L'adresse email est requise.");
            exit();    
        }
        if(empty($password)){
            header("Location: login.php?error= Le mot de passe est requis.");
            exit();   
        }
        if(empty($vpassword)){
            header("Location: login.php?error= La vérification de mot de passe est requise.");
            exit();    
        }
        if(empty($type)){
            header("Location: login.php?error= Le type est requis.");
            exit();    
        } 
    }
  
?>