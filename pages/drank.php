<?php
if (isset($_GET['id'])){

}
?>
<!-- Page Content  -->
<div id="content">
    <h2>Drank of gerecht toevoegen</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="categorie">Categorie:</label>
            <select required class="form-control" id="categorie" name="categorie">
                <option selected disabled>Kies een categorie</option>
                <option value="2">Dranken</option>
                <option value="3">Hapjes</option>
                <option value="4">Voorgerechten</option>
                <option value="5">Hoofgerechten</option>
                <option value="6">Nagerechten</option>
            </select>
        </div>
        <div class="form-group">
            <label for="subCategorie">Subcategorie:</label>
            <select required class="form-control" id="subCategorie" name="subCategorie">
                <option selected disabled>Kies een subcategorie</option>
                <option value="1">Warme dranken</option>
                <option value="2">Bieren</option>
                <option value="3">Huiswijnen</option>
                <option value="4">Frisdranken</option>
                <option value="5">Warme hapjes</option>
                <option value="6">Koude hapjes</option>
                <option value="7">Warme voorgerechten</option>
                <option value="8">Koude voorgerechten</option>
                <option value="9">Visgerechten</option>
                <option value="10">Vleesgerechten</option>
                <option value="11">Vegetarische gerechten</option>
                <option value="12">IJs</option>
                <option value="13">Mousse</option>
            </select>
        </div>
        <div class="form-group">
            <label for="naam">Naam:</label>
            <input required type="text" class="form-control" id="naam" name="naam" placeholder="Naam">
        </div>
        <div class="form-group">
            <label for="prijs">Prijs:</label>
            <input required type="number" step="0.05" name="prijs" class="form-control" placeholder="Prijs">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Toevoegen</button>
    </form>
</div>
</body>
</html>
<?php
if (isset($_POST['submit'])){
    $categorie = $_POST['categorie'];
    $subcategorie = $_POST['subCategorie'];
    $naam = $_POST['naam'];
    $prijs = $_POST['prijs'];
    try {
        $query = "SELECT MAX(CAST(MenuItem.MenuItemCode AS UNSIGNED)) AS HighestValue FROM MenuItem";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $menuitemcode = $result[0]["HighestValue"] + 1;

    try {
        $query = "INSERT INTO MenuItem (GerechtCode, SubgerechtCode, MenuItemCode, MenuItem, Prijs) VALUES (:gerechtcode, :subgerechtcode, :menuitemcode, :menuitem, :prijs);";
        $stmt = $db->prepare($query);
        $data = array(":gerechtcode" => $categorie, ":subgerechtcode" => $subcategorie, ":menuitemcode" => $menuitemcode, ":menuitem" => $naam, ":prijs" => $prijs);
        $stmt->execute($data);

        echo "<script>Swal.fire({title: 'Succesvol toegevoegd!' ,type: 'success', showConfirmButton: false, timer: 1000});</script>";
        echo "<script>setTimeout(function(){ location.href = 'index.php?pages=dranken'; }, 1200);</script>";
    } catch (PDOException $e) {
        echo '<script>alert("Er moet een categorie en subcategorie worden geselecteerd.")</script>';
    }
}
?>