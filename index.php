<?php
$index = true;
include_once("header.php");
include_once("main.php");

$query= "SELECT c.nom, c.ville, c.telephone, cmd.date, art.description, art.prix_unitaire, lc.quantité 
FROM client AS c, commande AS cmd, article As art, ligne_commande AS lc 
WHERE c.idclient=cmd.idclient
AND cmd.idcommande=lc.idcommande
AND art.idarticle=lc.idarticle ";
$pdostmt=$pdo->prepare($query);
$pdostmt ->execute();
//var_dump($pdostmt -> fetchAll(PDO::FETCH_ASSOC));
?>  

    <h1 class="mt-5">Accueil</h1>
    <table id="datatable" class="display">
    <thead>
        <tr>
            <th></th>
            <th>NOM</th>
            <th>VILLE</th>
            <th>TELEPHONE</th>
            <th>DATE</th>
            <th>DESCRIPTION</th>
            <th>PRIX UNITAIRE</th>
            <th>QUANTITE</th>
        </tr>
    </thead>
    <tbody>
    <?php while($ligne=$pdostmt->fetch(PDO::FETCH_ASSOC)):?>
        <tr>
            <td>
                <a href="details.php?id=<?php echo $ligne["idcommande"];?>" >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                class="bi bi-eye-fill" viewBox="0 0 16 16">
                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                </svg></a>
            </td>
            <td><?php echo $ligne["nom"]; ?></td>
            <td><?php echo $ligne["ville"]; ?></td>
            <td><?php echo $ligne["telephone"]; ?></td>
            <td><?php echo $ligne["date"]; ?></td>
            <td><?php echo $ligne["description"]; ?></td>
            <td><?php echo $ligne["prix_unitaire"]; ?></td>
            <td><?php echo $ligne["quantité"]; ?></td>

            <?php endwhile; ?>
    </tr>
    </tbody>
</table>

<?php
$pdostmt->closeCursor();
include_once("footer.php")
?>