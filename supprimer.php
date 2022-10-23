<?php
    include "db_conn.php";
    $id = $_POST['deleteId'];
    $sql = "delete from petition where id='$id'";
    if (mysqli_query($conn,$sql)) {
        header("Location: admin.php?success=Suppression faite avec succès !"); 
    }
    else {
        header("Location: petition-admin.php?id=$id&error=Echec de suppression !"); 
    }
?>