<?php
    session_start();
    require_once("../scripts/connexion_bdd.php")
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
    

    <fieldset>
        <legend>Saisir une note</legend>
    <form action="saisir_note.php" method="post">
    <?php 
        $get_matiere="SELECT enseigne.id_matiere, matiere.nom FROM enseigne INNER JOIN matiere ON enseigne.id_matiere=matiere.id WHERE enseigne.id_professeur=:id;";
        $all_matiere = $bdd->prepare($get_matiere);
        $all_matiere->execute(array('id'=>$_SESSION['id']));
    ?>

    <select id="select" name="matiere">
        <option value="0">-- Selectionez une matiere--</option>
        <?php 
            while($matiere=$all_matiere->fetch()){
                echo("<option value=".$matiere['id_matiere'].">".$matiere['nom']."</option>");
            }
        ?>
    </select>
    <input type='submit' value="Envoyer">
    </form>
    </fieldset>

    <fieldset>
        <legend>Voir la note d'un etudiant</legend>
        <form action="./voir_note_etudiant.php" method="post">
        <?php 
            $get_etudiant = "SELECT * FROM etudiant;";
            $all_etudiant =$bdd->query($get_etudiant);
        ?>
            <select id="select" name="etudiant">
                <option value="0">-- Selectionez un etudiant--</option>
                <?php 
                    while ($etudiant=$all_etudiant->fetch()){
                        echo("<option value=".$etudiant['id'].">".$etudiant['prenom']." ".$etudiant['nom']."</option>");
                    }
                ?>
            </select>
            <input type='submit' value="Envoyer">
        </form>
    </fieldset>

    <fieldset>
        <legend>Voir les notes d'une matiere</legend>
        <form action="./voir_note_matiere.php" method="post">
            <?php 
                $get_matiere="SELECT enseigne.id_matiere, matiere.nom FROM enseigne INNER JOIN matiere ON enseigne.id_matiere=matiere.id WHERE enseigne.id_professeur=:id;";
                $all_matiere = $bdd->prepare($get_matiere);
                $all_matiere->execute(array('id'=>$_SESSION['id']));
            ?>

            <select id="select" name="matiere">
                <option value="0">-- Selectionez une matiere--</option>
                <?php 
                  while($matiere=$all_matiere->fetch()){
                      echo("<option value=".$matiere['id_matiere'].">".$matiere['nom']."</option>");
                  }
                ?>
            </select>
            <input type='submit' value="Envoyer">
        </form>
    </fieldset>
    <br>
    <br>
    <form action="../compte/deconexion.php" method="post">
        <input type="submit" value = "deconnexion">
    </form>
</body>
</html>