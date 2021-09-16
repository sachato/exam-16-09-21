<?php
    session_start();
    require_once("../scripts/connexion_bdd.php");

    if(!empty($_POST["note"]) && !empty($_POST["etudiant"])){
        echo var_dump($_POST);
        $sql = "INSERT INTO note(id_professeur, id_etudiant, id_matiere, note) VALUES(:id_prof, :id_etudiant, :id_matiere, :note);";
        $insert = $bdd->prepare($sql);
        $insert->execute(array("id_prof"=>$_SESSION['id'],
                                "id_etudiant"=>$_POST['etudiant'],
                                "id_matiere"=>$_GET["matiere"],
                                "note"=>$_POST['note']));
        header("Location: ../administration/index.php");
    }
?>
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
        $sql = "SELECT nom FROM matiere WHERE id = :id;";
        $nom_matiere = $bdd->prepare($sql);
        $nom_matiere ->execute(array("id"=> $_POST['matiere']));
        $matiere = $nom_matiere->fetch();
        echo("<h1>".$matiere["nom"]."</h1>");

        $get_etudiant = "SELECT * FROM etudiant;";
        $all_etudiant =$bdd->query($get_etudiant);
    ?>
    <fieldset>
        <legend>Choisir un etudiant</legend>
        <form action="./saisir_note.php?matiere=<?php echo $_POST["matiere"] ?>" method="post">
            <select id="select_etudiant" name="etudiant">
                <option value="0">-- Selectionez un etudiant--</option>
                <?php 
                    while ($etudiant=$all_etudiant->fetch()){
                        echo("<option value=".$etudiant['id'].">".$etudiant['prenom']." ".$etudiant['nom']."</option>");
                    }
                ?>
            </select>
            <select id="select_note" name="note">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>
            <input type='submit' value="Envoyer">
        </form>
    </fieldset>


    
</body>
</html>