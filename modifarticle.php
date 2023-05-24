<?php
$article = true;
include_once("header.php");
include_once("main.php");

if(!empty($_POST)){
  $query="UPDATE article SET description=:description, prix_unitaire=:prix_unitaire  WHERE idarticle=:id";
  $pdostmt=$pdo->prepare($query);
  $pdostmt->execute(["description"=>$_POST["inputdescription"], "prix_unitaire"=>$_POST["inputprixunitaire"], "id"=>$_POST["myid"]]);
  header("Location:articles.php");
}

if(!empty($_GET["id"])){
    $query="SELECT * FROM article WHERE idarticle=:id ";
    $pdostmt=$pdo->prepare($query);
    $pdostmt->execute(["id"=>$_GET["id"]]);
    while($row=$pdostmt->fetch(PDO::FETCH_ASSOC)):
?>
    <h1 class="mt-5">Modifier un client</h1>

 <form class="row g-3" method="POST">
  <input type="hidden" name="myid" value="<?php echo $row["idarticle"]?>"/>
  <div class="col-md-6">
  <label for="inputdescription">Description</label>
  <textarea class="form-control" placeholder="mettre la description de l'article" id="inputdescription" 
  name="inputdescription" required>"<?php echo $row["description"]?>"</textarea>
    </div>
  <div class="col-md-6">
    <label for="inputville" class="form-label">Prix-Unitaire</label>
    <input type="text" class="form-control" id="inputprixunitaire" name="inputprixunitaire" value="<?php echo $row["prix_unitaire"]?>" required>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Modifier</button>
  </div>
</form>
<?php
endwhile; 
$pdostmt->closeCursor();
}
?>

<?php
include_once("footer.php")
?>