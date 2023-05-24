<?php
include_once("main.php");

if(!empty($_GET["id"])){
    $query= "DELETE FROM client WHERE idclient=:id";
    $objstmt=$pdo->prepare($query);
    $objstmt->execute(["id"=>$_GET["id"]]);
    $objstmt->closeCursor();
    header("Location:clients.php");
}

if(!empty($_GET["idarticle"])){
    $query= "DELETE FROM article WHERE idarticle=:id";
    $objstmt=$pdo->prepare($query);
    $objstmt->execute(["id"=>$_GET["idarticle"]]);
    $objstmt->closeCursor();
    header("Location:articles.php");
}

if(!empty($_GET["idcmd"])){
    $query= "DELETE FROM ligne_commande WHERE idcommande=:id";
    $objstmt=$pdo->prepare($query);
    $objstmt->execute(["id"=>$_GET["idcmd"]]);
    $objstmt->closeCursor();
    $query2= "DELETE FROM commande WHERE idcommande=:id";
    $objstmt2=$pdo->prepare($query2);
    $objstmt2->execute(["id"=>$_GET["idcmd"]]);
    $objstmt2->closeCursor();
    header("Location:commandes.php");
}

?>