<?php
$client = true;
include_once("header.php");
include_once("main.php");

$count=0;

$list=[];
$query="SELECT idclient FROM client WHERE idclient IN(SELECT idclient FROM commande WHERE commande.idclient=client.idclient)";
$pdostmt=$pdo->prepare($query);
$pdostmt->execute();
foreach(($pdostmt->fetchAll(PDO::FETCH_NUM)) as $tabvalues){
    foreach($tabvalues as $tabelements){
        $list[]=$tabelements;
    }
}

?>

    <h1 class="mt-5">Clients</h1>

    <a href="addclient.php" class="btn btn-primary" style="width:40px; float:right; margin-bottom:20px;">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"  width="16" height="16">
        <path d="M7.9 8.548h-.001a5.528 5.528 0 0 1 3.1 4.659.75.75 0 1 1-1.498.086A4.01 4.01 0 0 0 5.5 9.5a4.01 4.01 0 0 0-4.001 3.793.75.75 0 1 1-1.498-.085 5.527 5.527 0 0 1 3.1-4.66 3.5 3.5 0 1 1 4.799 0ZM13.25 0a.75.75 0 0 1 .75.75V2h1.25a.75.75 0 0 1 0 1.5H14v1.25a.75.75 0 0 1-1.5 0V3.5h-1.25a.75.75 0 0 1 0-1.5h1.25V.75a.75.75 0 0 1 .75-.75ZM5.5 4a2 2 0 1 0-.001 3.999A2 2 0 0 0 5.5 4Z">
        </path>
    </svg>
    </a>

    <?php
    $query="SELECT * FROM client";
    $pdostmt=$pdo->prepare($query);
    $pdostmt ->execute();
    // var_dump($pdostmt -> fetchAll(PDO::FETCH_ASSOC));
    ?>

    <table id="datatable" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>NOM</th>
            <th>VILLE</th>
            <th>TELEPHONE</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php while($ligne=$pdostmt->fetch(PDO::FETCH_ASSOC)):
            $count++;
            ?>

        <tr>
            <td><?php echo $ligne["idclient"]; ?></td>
            <td><?php echo $ligne["nom"]; ?></td>
            <td><?php echo $ligne["ville"]; ?></td>
            <td><?php echo $ligne["telephone"]; ?></td>

            <td>
            <a href="modifclient.php?id=<?php echo $ligne["idclient"]?>" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
            <path d="M11.013 1.427a1.75 1.75 0 0 1 2.474 0l1.086 1.086a1.75 1.75 0 0 1 0 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 0 1-.927-.928l.929-3.25c.081-.286.235-.547.445-.758l8.61-8.61Zm.176 4.823L9.75 4.81l-6.286 6.287a.253.253 0 0 0-.064.108l-.558 1.953 1.953-.558a.253.253 0 0 0 .108-.064Zm1.238-3.763a.25.25 0 0 0-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 0 0 0-.354Z">
            </path>
            </svg>
            </a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal"  <?php if(in_array($ligne["idclient"],$list)){echo "disabled";}?>
             data-bs-target="#deleteModal<?php echo $count ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                <path d="M16 1.75V3h5.25a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1 0-1.5H8V1.75C8 .784 8.784 0 9.75 0h4.5C15.216 0 16 .784 16 1.75Zm-6.5 0V3h5V1.75a.25.25 0 0 0-.25-.25h-4.5a.25.25 0 0 0-.25.25ZM4.997 6.178a.75.75 0 1 0-1.493.144L4.916 20.92a1.75 1.75 0 0 0 1.742 1.58h10.684a1.75 1.75 0 0 0 1.742-1.581l1.413-14.597a.75.75 0 0 0-1.494-.144l-1.412 14.596a.25.25 0 0 1-.249.226H6.658a.25.25 0 0 1-.249-.226L4.997 6.178Z"></path><path d="M9.206 7.501a.75.75 0 0 1 .793.705l.5 8.5A.75.75 0 1 1 9 16.794l-.5-8.5a.75.75 0 0 1 .705-.793Zm6.293.793A.75.75 0 1 0 14 8.206l-.5 8.5a.75.75 0 0 0 1.498.088l.5-8.5Z">
                </path>
            </svg>
            </button>
            </td>
        </tr>

<!-- Modal -->
<div class="modal fade" id="deleteModal<?php echo $count ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       Voulez-vous vraiment supprimer ce client ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <a href="delete.php?id=<?php echo $ligne["idclient"] ?> " class="btn btn-danger">Supprimer</a>
      </div>
    </div>
  </div>
</div>

        <?php endwhile; ?>
    </tbody>
</table>


<?php
include_once("footer.php")
?>