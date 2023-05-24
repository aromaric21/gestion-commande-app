<?php
$article = true;
include_once("header.php");
include_once("main.php");

if(!empty($_POST["inputdescription"])&&!empty($_POST["inputprixunitaire"])){
    $query="INSERT INTO article(description,prix_unitaire) VALUES(:description, :prix_unitaire)";
    $pdostmt=$pdo->prepare($query);
    $pdostmt ->execute(["description"=>$_POST["inputdescription"], "prix_unitaire"=>$_POST["inputprixunitaire"]]);
    $pdostmt->closeCursor();
    header("Location:articles.php");
}
?>
    <h1 class="mt-5">Ajouter un article</h1>

 <form class="row g-3" method="POST">
  <div class="col-md-6">
  <label for="inputdescription">Description</label>
  <textarea class="form-control" placeholder="mettre la description de l'article" id="inputdescription" 
  name="inputdescription" required></textarea>
  </div>
  <div class="col-md-6">
    <label for="inputprixunitaire" class="form-label">Prix-Unitaire</label>
    <input type="text" class="form-control" id="inputprixunitaire" name="inputprixunitaire" required>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Ajouter</button>
  </div>
</form>

<?php
include_once("footer.php")
?>