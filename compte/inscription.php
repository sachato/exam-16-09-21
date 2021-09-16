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
        echo isset($_POST["nom"]);
        echo empty($_POST["nom"]);
        //verification des items envoyer du form
        if(!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["confirm_pass"])){
            if($_POST["password"] == $_POST["confirm_pass"]){
                $mdp = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $add_prof = "INSERT INTO professeur(nom, prenom, email, `password`) VALUES(:nom, :prenom, :email, :mdp);";
                $insert = $bdd->prepare($add_prof);
                $insert->execute(array("nom" => $_POST["nom"],
                                        "prenom" => $_POST["prenom"],
                                        "email" => $_POST["email"],
                                        "mdp" => $mdp));
            }
            else{
                echo("Les mots de passe ne sont pas identique");
            }
        }
        else{
            if(isset($_GET["envoie"])){
                echo("Il manque des champs");
            }
        }
    ?>

    <!-- /////////////////HTML FORM Inscription///////////////////// -->
    <h1>Formulaire d'inscription</h1>
    <fieldset>
        <form action="../compte/inscription.php?envoie=1" method="POST">
            <label for="nom">Nom: </label>
            <input id="nom" name="nom" type='text' placeholder="Ex: Terrieur">

            <label for="prenom">Prénom: </label>
            <input id="prenom" name="prenom" type='text' placeholder="Ex: Alain">

            <label for="email">Email: </label>
            <input id="email" name="email" type='email' placeholder="Ex: alain.terrieur@mail.com">

            <label for="password">Mot de passe: </label>
            <input id="password" name="password" type='password' placeholder="*******">

            <label for="confirm_pass">Confirmation du mot de passe: </label>
            <input id="confirm_pass" name="confirm_pass" type='password' placeholder="********">

            <input type='submit' value="Envoyer">
        </form>
    </fieldset>
</body>
</html>