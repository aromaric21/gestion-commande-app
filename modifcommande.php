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

if(!empty($_POST["inputquantite"])&&!empty($_POST["inputdate"])){
  $query="UPDATE commande SET idclient=:idcli, date=:dat  WHERE idcommande=:idcmd";
  $pdostmt=$pdo->prepare($query);
  $pdostmt->execute(["idcli"=>$_POST["inputidclient"], "dat"=>$_POST["inputdate"], "idcmd"=>$_POST["cmd_id"]]);

  $query2="UPDATE ligne_commande SET idarticle=:idart, idcommande=:idcmd, quantité=:quantite WHERE idcommande=:idcmd";
  $pdostmt2=$pdo->prepare($query2);
  $pdostmt2->execute(["idart"=>$_POST["inputidarticle"],"idcmd"=>$_POST["cmd_id"],"quantite"=>$_POST["inputquantite"]]);
  $pdostmt2->closeCursor();
  header("Location:commandes.php");
}

  if(!empty($_GET["id"])){
    $query="SELECT * FROM commande,ligne_commande WHERE
      ligne_commande.idcommande=commande.idcommande AND
       commande.idcommande=:idcmd";
    $pdostmt=$pdo->prepare($query);
    $pdostmt->execute(["idcmd"=>$_GET["id"]]);
    $row=$pdostmt->fetch(PDO::FETCH_ASSOC);
?>
    <h1 class="mt-5">Modifier une commande</h1>

 <form class="row g-3" method="POST">
  <input type="hidden" name="cmd_id" value="<?php echo $_GET["id"]?>"/>
  <div class="col-md-6">
  <label for="inputidclient" class="form-label">ID-Client</label>
  <SELECT class="form-control" id="inputidclient" name="inputidclient" required>
    <?php
    foreach($objstmt->fetchALL(PDO::FETCH_NUM) as $tab){
      foreach($tab as $elmt){
        if($row["idclient"]==$elmt){
            $selected="selected";
        }else{
            $selected="";
        }
        echo "<option value=".$elmt." ".$selected.">".$elmt."</option>";
      }
    } 
     ?>
  </select>
  </div>
  <div class="col-md-6">
    <label for="inputdate" class="form-label">Date</label>
    <input type="date" class="form-control" id="inputdate" name="inputdate" 
    value="<?php echo $row["date"]?>" required>
  </div>

  <div class="col-md-6">
    <label for="inputidarticle" class="form-label">Article</label>
    <SELECT class="form-control" id="inputidarticle" name="inputidarticle" required>

     <?php
    foreach($objstmt2->fetchALL(PDO::FETCH_NUM) as $tab){
      foreach($tab as $elmt){
        if( $elmt==$row["idarticle"]){
            $selected="selected";
        }else{
            $selected="";
        }
        echo "<option value=".$elmt." ".$selected.">".$elmt."</option>";
      }
    }
     ?>
  </select>
  </div>

  <div class="col-md-6">
    <label for="inputquantite" class="form-label">Quantité</label>
    <input type="text" class="form-control" id="inputquantite" name="inputquantite"
    value="<?php echo $row["quantité"]?>" required>
  </div>

  <div class="col-12">
    <button type="submit" class="btn btn-primary">Modifier</button>
  </div>
</form>
<?php
$pdostmt->closeCursor();

?>
<?php
}
include_once("footer.php")
?>