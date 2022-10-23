<?php 

session_start(); 

include "db_conn.php";

if (isset($_POST['mail']) && isset($_POST['password'])) {

    function validate($data){
       $data = trim($data);
       return $data;
    }

    $mail = validate($_POST['mail']);
    $pass=$_POST['password'];


    if (empty($mail)) {

        header("Location: login.php?error=Le champ d'email est vide");
        exit();

    }else if(empty($pass)){

        header("Location: login.php?error=Le champ de password est vide");
        exit();

    }else{

        $sqlm = "SELECT * FROM membre WHERE mail='$mail' AND password='$pass'";
        $resultm = mysqli_query($conn, $sqlm);

        $sqla = "SELECT * FROM admin WHERE mail='$mail' AND password='$pass'";
        $resulta = mysqli_query($conn, $sqla);

        if (mysqli_num_rows($resultm) === 1) {

            $row = mysqli_fetch_assoc($resultm);

            if ($row['mail'] === $mail && $row['password'] === $pass) {

                echo "Logged in!";

                $_SESSION['mail'] = $row['mail'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['nom'] = $row['nom'];
                $_SESSION['prenom'] = $row['prenom'];
                $_SESSION['type'] = $row['type'];
                if (!empty($row['imgName'])) {
                    $_SESSION['imgName'] = $row['imgName'];
                }             
                header("Location: profil.php");
                exit();

            }else{
                header("Location: login.php?error=L'email ou le password est incorrect");
                exit();
            }

        }
        else if(mysqli_num_rows($resulta) === 1) {

            $row = mysqli_fetch_assoc($resulta);

            if ($row['mail'] === $mail && $row['password'] === $pass) {

                echo "Logged in!";

                $_SESSION['mailadmin'] = $row['mail'];
                $_SESSION['password'] = $row['password'];

                header("Location: admin.php");
                exit();

            }else{  
                header("Location: login.php?error=L'email ou le password est incorrect");
                exit();
            }
            
        }
        else{
            header("Location: login.php?error=L'email ou le password est incorrect");
            exit();
        }

    }

}else{
    header("Location: login.php");
    exit();
}