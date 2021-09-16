<?php
    session_start();
    require_once("../scripts/connexion_bdd.php");
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
        $sql="SELECT note.id, etudiant.nom as nom_etudiant, professeur.nom as nom_prof, note.note FROM note 
        INNER JOIN etudiant ON etudiant.id=note.id_etudiant 
        INNER JOIN professeur ON professeur.id=note.id_professeur 
        WHERE note.id_matiere=:id";
        $all_note = $bdd->prepare($sql);
        $all_note ->execute(array("id"=>$_POST['matiere']))
    ?> 
    <table>
        <thead>
            <td>Etudiant</td>
            <td>Professeur</td>
            <td>Note</td>
            <td>Action</td>
        </thead>
        <tbody>
            <?php 
                while($note=$all_note->fetch()){
                    echo "<tr>";
                    echo "<td>".$note["nom_etudiant"]."</td>";
                    echo "<td>".$note["nom_prof"]."</td>";
                    echo "<td>".$note["note"]."</td>";
                    echo "<td><form action='./crud/edit.php?id=".$note['id']."'><input type='submit' value='modifier'></form><form action='./crud/delete.php?id=".$note['id']."'><input type='submit' value='supprimer'></form></td>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>