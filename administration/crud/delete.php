<?php 
session_start();
require_once("../../scripts/connexion_bdd.php");
$sql="DELETE FROM note WHERE id=:id";
$delete = $bdd->prepare($sql);
$delete->execute(array('id'=>$_GET['id']));
?>