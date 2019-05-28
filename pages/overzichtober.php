<!-- Toegevoegd n.a.v. ticketnummer [[0001] -->
<!-- Page Content  -->
<div id="content">
    <div class="tablecontainer">
        <h2>Overzicht Ober</h2>
        <h5>Overzicht dranken</h5>
        <?php
        // Alle bestelde dranken worden hier opgehaald
        try {
            $query = "SELECT Bestelling.Tafel, Bestelling.Datum, Bestelling.Tijd, Bestelling.MenuCodeItem, Bestelling.Aantal, Bestelling.Klaargemaakt, MenuItem.MenuItem, MenuItem.GerechtCode FROM Bestelling INNER JOIN MenuItem ON Bestelling.MenuCodeItem = MenuItem.MenuItemCode ORDER BY Bestelling.Tijd, Bestelling.Tafel, MenuItem.GerechtCode";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        //Hier wordt gecontroleerd of er wel bestellingen zijn met drankjes
        if (!empty($result)){

            ?>
            <?php
            $tafel = 0;
            foreach ($result as $row) {
                //Hier word gekeken of de bestelling al klaar gemaakt is.
                if ($row['Klaargemaakt'] === '1') {
                    //Hier word gekeken of de klaargemaakte bestelling een drank is.
                    if ($row['GerechtCode'] === '2') {
                        //De klaargemaakte bestellingen worden nu getoond.
                        if ($tafel !== $row['Tafel']) {
                            echo '<hr>';
                            echo '<h4>Tafel: ' . $row['Tafel'] . '</h4>';
                            echo '<h6>Tijd: ' . $row['Tijd'] . '</h6>';
                        }
                        $tafel = $row['Tafel'];
                        echo '<p>' . $row['Aantal'] . 'x ' . $row['MenuItem'] . '</p>';
                    }
                }
            }
        }
        ?>
    </div>
    <div class="rekentool">
        <h2><br></h2>
        <h5>Overzicht gerechten</h5>
        <?php
        $tafel = 0;
        foreach ($result as $row) {
            //Hier word gekeken of de bestelling al klaar gemaakt is.
            if ($row['Klaargemaakt'] === '1') {
                //Hier word gekeken of de klaargemaakte bestelling een gerecht is.
                if ($row['GerechtCode'] != '2') {
                    //De afgeronde bestellingen worden nu getoond.
                    if ($tafel !== $row['Tafel']) {
                        echo '<hr>';
                        echo '<h4>Tafel: ' . $row['Tafel'] . '</h4>';
                        echo '<h6>Tijd: ' . $row['Tijd'] . '</h6>';
                    }
                    $tafel = $row['Tafel'];
                    echo '<p>' . $row['Aantal'] . 'x ' . $row['MenuItem'] . '</p>';
                }
            }
        }
        ?>
    </div>
</div>
</body>
</html>