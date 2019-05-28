<!-- Page Content  -->
<div id="content">
    <div class="tablecontainer">
    <h2>Overzicht barman</h2>
    <?php
    // Alle bestelde dranken worden hier opgehaald
    try {
        $query = "SELECT Bestelling.Tafel, Bestelling.Datum, Bestelling.Tijd, Bestelling.MenuCodeItem, Bestelling.Aantal, Bestelling.Klaargemaakt, MenuItem.MenuItem FROM Bestelling INNER JOIN MenuItem ON Bestelling.MenuCodeItem = MenuItem.MenuItemCode WHERE MenuItem.GerechtCode = '2' OR MenuItem.GerechtCode = '3' ORDER BY Bestelling.Tijd, Bestelling.Tafel";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    //Hier wordt gecontroleerd of er wel bestellingen zijn met gerechten
    if (!empty($result)){

        ?>
        <?php
        $tafel = 0;
        foreach ($result as $row) {
            //Hier word gekeken of de bestelling al klaar gemaakt is.
            if ($row['Klaargemaakt'] === '0'){
                //De nog te maken bestellingen worden nu getoond.
                if ($tafel !== $row['Tafel']){
                    echo '<hr>';
                    echo '<form role="form" action="" method="post">';
                    echo '<input type="hidden" name="tafel" value="'. $row['Tafel'] .'">';
                    echo '<input type="hidden" name="datum" value="'. $row['Datum'] .'">';
                    echo '<input type="hidden" name="tijd" value="'. $row['Tijd'] .'">';
                    echo '<input type="hidden" name="menucodeitem" value="'. $row['MenuCodeItem'] .'">';
                    echo '<button style="float: right;" class="btn btn-primary" type="submit" name="submit">Staat klaar!</button>';
                    echo '<h4>Tafel: '. $row['Tafel'] .'</h4>';
                    echo '<h6>Tijd: '. $row['Tijd'] .'</h6>';
                }
                $tafel = $row['Tafel'];
                echo '<p>'. $row['Aantal'] .'x '. $row['MenuItem'] .'</p>';
                echo '</form>';
            }
        }
    }
    ?>
    </div>
    <div class="rekentool">
    <h2>Bestellingen afgerond</h2>
        <?php
        $tafel = 0;
        foreach ($result as $row) {
            //Hier word gekeken of de bestelling al klaar gemaakt is.
            if ($row['Klaargemaakt'] === '1'){
                //De afgeronde bestellingen worden nu getoond.
                if ($tafel !== $row['Tafel']){
                    echo '<hr>';
                    echo '<h4>Tafel: '. $row['Tafel'] .'</h4>';
                    echo '<h6>Tijd: '. $row['Tijd'] .'</h6>';
                }
                $tafel = $row['Tafel'];
                echo '<p>'. $row['Aantal'] .'x '. $row['MenuItem'] .'</p>';
            }
        }
        ?>
    </div>
</div>
</body>
</html>
<?php
//Checkt of er een bestelling word afgerond.
if (isset($_POST['submit'])){
    // Haalt alle gegevens op van de bestelling
    $tafel = $_POST['tafel'];
    $datum = $_POST['datum'];
    $tijd = $_POST['tijd'];
    $menuCodeItem = $_POST['menucodeitem'];

    // De bestelling word geüpdate zodat deze in de juiste lijst komt.
    try {
        $query = "UPDATE Bestelling SET Klaargemaakt=:klaargemaakt WHERE MenuCodeItem = :menucodeitem AND Tafel = :tafel AND Datum = :datum AND Tijd = :tijd";
        $stmt = $db->prepare($query);
        $data = array(":klaargemaakt" => 1, ":menucodeitem" => $menuCodeItem, ":tafel" => $tafel, ":datum" => $datum, ":tijd" => $tijd);
        $stmt->execute($data);

        // Hier wordt een melding getoond.
        // Ook word de pagina herladen.
        echo "<script>Swal.fire({title: 'Succesvol klaargezet' ,type: 'success', showConfirmButton: false, timer: 1000});</script>";
        echo "<script>setTimeout(function(){ location.href = 'index.php?pages=overzichtbarman'; }, 1200);</script>";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
