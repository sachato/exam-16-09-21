<?php
try{
     //Connexion à la base
     $bdd = new PDO('mysql:host=localhost;dbname=ecole;charset=utf8','root', '');
 } catch (PDOException $e){
     echo 'Erreur : ' . $e->getMessage();
     die();
 }
 ?>