<?php
$commande = true;
include_once("header.php");
include_once("main.php");

$count=0;

$list=[];
$query="SELECT idcommande FROM commande WHERE idcommande 
IN(SELECT idcommande FROM ligne_commande WHERE commande.idcommande=ligne_commande.idcommande)";
$pdostmt=$pdo->prepare($query);
$pdostmt->execute();
foreach(($pdostmt->fetchAll(PDO::FETCH_NUM)) as $tabvalues){
    foreach($tabvalues as $tabelements){
        $list[]=$tabelements;
    }
}
?>
    <h1 class="mt-5">Commandes</h1>

    <a href="addcommande.php" class="btn btn-primary" style="width:40px; float:right; margin-bottom:20px;">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
     <path d="M7.75 2a.75.75 0 0 1 .75.75V7h4.25a.75.75 0 0 1 0 1.5H8.5v4.25a.75.75 0 0 1-1.5 0V8.5H2.75a.75.75 0 0 1 0-1.5H7V2.75A.75.75 0 0 1 7.75 2Z">
    </path>
    </svg>
    </a>

    <?php
    $query="SELECT * FROM commande";
    $pdostmt=$pdo->prepare($query);
    $pdostmt ->execute();
    //var_dump($pdostmt -> fetchAll(PDO::FETCH_ASSOC));
    ?>
  <table id="datatable" class="display">
    <thead>
        <tr>
            <th>ID-COMMANDE</th>
            <th>ID-CLIENT</th>
            <th>DATE</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php while($ligne=$pdostmt->fetch(PDO::FETCH_ASSOC)):
            $count++;
            ?>

        <tr>
            <td><?php echo $ligne["idcommande"]; ?></td>
            <td><?php echo $ligne["idclient"]; ?></td>
            <td><?php echo $ligne["date"]; ?></td>

            <td>
            <a href="modifcommande.php?id=<?php echo $ligne["idcommande"]?>" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
            <path d="M11.013 1.427a1.75 1.75 0 0 1 2.474 0l1.086 1.086a1.75 1.75 0 0 1 0 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 0 1-.927-.928l.929-3.25c.081-.286.235-.547.445-.758l8.61-8.61Zm.176 4.823L9.75 4.81l-6.286 6.287a.253.253 0 0 0-.064.108l-.558 1.953 1.953-.558a.253.253 0 0 0 .108-.064Zm1.238-3.763a.25.25 0 0 0-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 0 0 0-.354Z">
            </path>
            </svg>
            </a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $count ?>">
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
       Voulez-vous vraiment supprimer cet article ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <a href="delete.php?idcmd=<?php echo $ligne["idcommande"] ?> " class="btn btn-danger">Supprimer</a>
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