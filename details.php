<?php
$index = true;
include_once("header.php");
include_once("main.php");

$query= "SELECT idclient FROM client";
$objstmt=$pdo->prepare($query);
$objstmt-> execute();

$query2= "SELECT idarticle FROM article";
$objstmt2=$pdo->prepare($query2);
$objstmt2-> execute();

if($_POST){
    header("Location:index.php");
}

  if(!empty($_GET["id"])){
    $query="SELECT * FROM commande,ligne_commande,client WHERE
      commande.idclient=client.idclient AND
      ligne_commande.idcommande=commande.idcommande AND
      commande.idcommande=:idcmd";
    $pdostmt=$pdo->prepare($query);
    $pdostmt->execute(["idcmd"=>$_GET["id"]]);
    $row=$pdostmt->fetch(PDO::FETCH_ASSOC);
  
?>
    <h1 class="mt-5">Détails de la commande</h1>

 <form class="row g-3" method="POST">
  <input type="hidden" name="cmd_id" value="<?php echo $_GET["id"]?>"/>
  <div class="col-md-6">
  <label for="inputidclient" class="form-label">ID-Client</label>
  <SELECT class="form-control" id="inputidclient" name="inputidclient" desabled>
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
    value= "<?php echo $row["date"]?>"  desabled>
  </div>

  <div class="col-md-6">
    <label for="inputidarticle" class="form-label">Article</label>
    <SELECT class="form-control" id="inputidarticle" name="inputidarticle" desabled>

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
        value="<?php echo $row["quantité"]?>" desabled>
  </div>

  <div class="col-12">
    <button type="submit" class="btn btn-primary">Fermer</button>
  </div>
</form>
<?php
$pdostmt->closeCursor();

?>
<?php
}
include_once("footer.php")
?>