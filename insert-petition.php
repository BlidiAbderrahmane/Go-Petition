<?php
    session_start();
    include "db_conn.php";
    if (isset($_POST['titre']) && isset($_POST['description']) && isset($_SESSION['mail'])) {

        function validate($data){
    
           $data = trim($data);
    
           return $data;
    
        }
    
        $titre = validate($_POST['titre']);    
        $desc = validate($_POST['description']);
        $mail = $_SESSION['mail'];
        $date = date('Y-m-d');
    
        if (empty($titre)) {
    
            header("Location: creer-petition.php?error=Le titre est requis");
    
            exit();
    
        }else if(empty($desc)){
    
            header("Location: creer-petition.php?error=La description est requise");
    
            exit();
    
        }else{
    
            $sql = "INSERT INTO petition (titre,texte,mail,date) VALUES ('$titre','$desc','$mail','$date')";

            if (mysqli_query($conn, $sql)) {

                header("Location: creer-petition.php?success=Votre Pétition est ajoutée avec succès");
                exit();

            } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }


            mysqli_close($conn);
        }
    
    }else{
    
        header("Location: creer-petition.php");
    
        exit();
    
    }
?>