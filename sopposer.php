<?php
    session_start();
    include "db_conn.php";
    $id = $_POST['id'];
    $mail = $_SESSION['mail'];
    $comment = $_POST['comment'];
    $verif = "delete from participation where id=$id and mail='$mail' and vote='pour'";
    mysqli_query($conn,$verif);

    $sql = "insert into participation values ($id,'$mail','contre','$comment')";
    if (mysqli_query($conn,$sql)) {
        header("Location: petition.php?id=$id&success=Opposition faite avec succès !"); 
    }
    else {
        header("Location: petition.php?id=$id&error=Echec d'opposition !!"); 
    }
?>