<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        // PHP connextion a la bdd
        require_once("../scripts/connexion_bdd.php");
        echo var_dump($_POST);
        if(!empty($_POST["email"]) && !empty($_POST["password"])){
            $get_email_line = "SELECT id, nom, prenom, email, `password` as mdp FROM professeur WHERE email=:email";
            $professeur = $bdd->prepare($get_email_line);
            $professeur->execute(array("email" => $_POST["email"]));
            
            $professeur_info = $professeur->fetch();
            echo var_dump($professeur_info);
            if(empty($professeur_info)){
                echo("Email incorect");
            }
            else{
                if(password_verify($_POST["password"], $professeur_info["mdp"])){
                    session_start();
                    $_SESSION["nom"]=$professeur_info["nom"];
                    $_SESSION["prenom"]=$professeur_info["prenom"];
                    $_SESSION["email"]=$professeur_info["email"];
                    $_SESSION["id"]=$professeur_info["id"];
                    header("Location: ../administration/index.php");
                }
                else{
                    echo("mot de passe incorect");
                }
            }
        }

    ?>
    <!-- /////////////////HTML FORM Inscription///////////////////// -->
    <h1>Connexion à votre compte</h1>
    <fieldset>
        <form action="connexion.php?envoie=1" method="POST">
            <label for="email">Email: </label>
            <input id="email" name="email" type='email' placeholder="Ex: alain.terrieur@mail.com">

            <label for="password">Mot de passe: </label>
            <input id="password" name="password" type='password' placeholder="*******">

            <input type='submit' value="Envoyer">
        </form>
    </fieldset>

</body>
</html>