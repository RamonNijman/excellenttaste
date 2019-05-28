<?php
// Het id van het gerecht ophalen.
if (isset($_GET['id'])){
    $gerechtid = $_GET['id'];
    // Alle informatie word opgehaald van het gerecht.
    try {
        $query = "SELECT * FROM MenuItem INNER JOIN Gerecht ON MenuItem.GerechtCode = Gerecht.Gerechtcode INNER JOIN Subgerecht ON MenuItem.SubgerechtCode = Subgerecht.SubgerechtCode WHERE MenuItem.MenuItemCode = $gerechtid";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    // De gegevens worden beschikbaar gemaakt.
    foreach ($result as $row){
    }
}
?>
<!-- Page Content  -->
<!-- Wordt gekeken welk gerechtcode het is en welk subgerechtcode -->
<div id="content">
    <h2>Drank of gerecht bewerken</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="categorie">Categorie:</label>
            <select required class="form-control" id="categorie" name="categorie">
                <option value="2" <?php $row['GerechtCode'] === '2' ? 'selected' : '' ?>>Dranken</option>
                <option value="3" <?php $row['GerechtCode'] === '3' ? 'selected' : '' ?>>Hapjes</option>
                <option value="4" <?php $row['GerechtCode'] === '4' ? 'selected' : '' ?>>Voorgerechten</option>
                <option value="5" <?php $row['GerechtCode'] === '5' ? 'selected' : '' ?>>Hoofgerechten</option>
                <option value="6" <?php $row['GerechtCode'] === '6' ? 'selected' : '' ?>>Nagerechten</option>
            </select>
        </div>
        <div class="form-group">
            <label for="subCategorie">Subcategorie:</label>
            <select required class="form-control" id="subCategorie" name="subCategorie">
                <option value="1" <?php $row['SubgerechtCode'] === '1' ? 'selected' : '' ?>>Warme dranken</option>
                <option value="2" <?php $row['SubgerechtCode'] === '1' ? 'selected' : '' ?>>Bieren</option>
                <option value="3" <?php $row['SubgerechtCode'] === '1' ? 'selected' : '' ?>>Huiswijnen</option>
                <option value="4" <?php $row['SubgerechtCode'] === '1' ? 'selected' : '' ?>>Frisdranken</option>
                <option value="5" <?php $row['SubgerechtCode'] === '1' ? 'selected' : '' ?>>Warme hapjes</option>
                <option value="6" <?php $row['SubgerechtCode'] === '1' ? 'selected' : '' ?>>Koude hapjes</option>
                <option value="7" <?php $row['SubgerechtCode'] === '1' ? 'selected' : '' ?>>Warme voorgerechten</option>
                <option value="8" <?php $row['SubgerechtCode'] === '1' ? 'selected' : '' ?>>Koude voorgerechten</option>
                <option value="9" <?php $row['SubgerechtCode'] === '1' ? 'selected' : '' ?>>Visgerechten</option>
                <option value="10" <?php $row['SubgerechtCode'] === '1' ? 'selected' : '' ?>>Vleesgerechten</option>
                <option value="11" <?php $row['SubgerechtCode'] === '1' ? 'selected' : '' ?>>Vegetarische gerechten</option>
                <option value="12" <?php $row['SubgerechtCode'] === '1' ? 'selected' : '' ?>>IJs</option>
                <option value="13" <?php $row['SubgerechtCode'] === '1' ? 'selected' : '' ?>>Mousse</option>
            </select>
        </div>
        <div class="form-group">
            <label for="naam">Naam:</label>
            <input required type="text" class="form-control" id="naam" name="naam" placeholder="Naam" value="<?php echo $row['MenuItem'] ?>">
        </div>
        <div class="form-group">
            <label for="prijs">Prijs:</label>
            <input required type="number" step="0.05" name="prijs" class="form-control" placeholder="Prijs" value="<?php echo $row['Prijs'] ?>">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>
</body>
</html>
<?php
// Wordt het opslaan afgevangen
if (isset($_POST['submit'])){
    // Worden de bewerkte gegevens opgehaald
    $categorie = $_POST['categorie'];
    $subcategorie = $_POST['subCategorie'];
    $naam = $_POST['naam'];
    $prijs = $_POST['prijs'];

    // Wordt het gerecht geüpdate.
    try {
        $query = "UPDATE MenuItem SET MenuItem=:menuitem, Prijs=:prijs WHERE MenuItemCode = $gerechtid";
        $stmt = $db->prepare($query);
        $data = array(":menuitem" => $naam, ":prijs" => $prijs);
        $stmt->execute($data);

        //Word een berciht getoond.
        echo "<script>Swal.fire({title: 'Succesvol geüpdate!' ,type: 'success', showConfirmButton: false, timer: 1000});</script>";
        echo "<script>setTimeout(function(){ location.href = 'index.php?pages=dranken'; }, 1200);</script>";
    } catch (PDOException $e) {
        echo '<script>alert("Er moet een categorie en subcategorie worden geselecteerd.")</script>';
    }
}
?>