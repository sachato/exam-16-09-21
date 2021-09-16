<?php
    session_start();
    require_once("../../scripts/connexion_bdd.php");
    if(!empty($_POST["note"])){
        $sql='UPDATE note SET note.note = :note WHERE id=:id';
        $update = $bdd->prepare($sql);
        $update->execute(array("note"=>$_POST['note'],
                                "id"=>$_GET['id']));
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
    $sql="SELECT * FROM note WHERE id=:id";
    $note=$bdd->prepare($sql);
    $note->execute(array("id"=>$_GET['id']));
    ?>
    <fieldset>
        <legend>Quelle est la nouvelle note</legend>
        <form action="./edit.php?id=<?php echo($_GET['id']) ?>" method="post">
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