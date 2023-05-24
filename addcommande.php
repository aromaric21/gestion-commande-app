<?php
$commande = true;
include_once("header.php");
include_once("main.php");

$query= "SELECT idclient FROM client";
$objstmt=$pdo->prepare($query);
$objstmt-> execute();

$query2= "SELECT idarticle FROM article";
$objstmt2=$pdo->prepare($query2);
$objstmt2-> execute();

if(!empty($_POST["inputidclient"])&&!empty($_POST["inputdate"])){
    $query="INSERT INTO commande(idclient,date) VALUES(:idclient, :date)";
    $pdostmt=$pdo->prepare($query);
    $pdostmt ->execute(["idclient"=>$_POST["inputidclient"], "date"=>$_POST["inputdate"]]);
    //$pdostmt->closeCursor();

    $idcmd=$pdo->lastInsertId();

    $query2="INSERT INTO ligne_commande(idarticle,idcommande,quantité) VALUES(:idarticle,:idcmd,:quantite)";
    $pdostmt2=$pdo->prepare($query2);
    $pdostmt2 ->execute(["idarticle"=>$_POST["inputidarticle"], "idcmd"=>$idcmd,"quantite"=>$_POST["inputquantite"]]);
    $pdostmt2->closeCursor();
    header("Location:commandes.php");
}
?>
    <h1 class="mt-5">Ajouter une commande</h1>

 <form class="row g-3" method="POST">
  <div class="col-md-6">
  <label for="inputidclient" class="form-label">ID-Client</label>
  <SELECT class="form-control" id="inputidclient" name="inputidclient" required>
    <?php
    foreach($objstmt->fetchALL(PDO::FETCH_NUM) as $tab){
      foreach($tab as $elmt){
        echo "<option value=".$elmt.">".$elmt."</option>";
      }
    } 
     ?>
  </select>
  </div>
  <div class="col-md-6">
    <label for="inputdate" class="form-label">Date</label>
    <input type="date" class="form-control" id="inputdate" name="inputdate" 
    value="2023-04-18" min="2023-01-01" max="2030-12-12" required>
  </div>

  <div class="col-md-6">
    <label for="inputidarticle" class="form-label">Article</label>
    <SELECT class="form-control" id="inputidarticle" name="inputidarticle" required>
    <?php
    foreach($objstmt2->fetchALL(PDO::FETCH_NUM) as $tab){
      foreach($tab as $elmt){
        echo "<option value=".$elmt.">".$elmt."</option>";
      }
    } 
     ?>
  </select>
  </div>

  <div class="col-md-6">
    <label for="inputquantite" class="form-label">Quantité</label>
    <input type="text" class="form-control" id="inputquantite" name="inputquantite" required>
  </div>

  <div class="col-12">
    <button type="submit" class="btn btn-primary">Ajouter</button>
  </div>
</form>

<?php
include_once("footer.php")
?>