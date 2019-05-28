<?php
//Hier word het tafelnummer opgehaald
//Als dat er niet is, kan er een keuze worden gemaakt voor een tafel
if (!isset($_GET['tafel'])){
    ?>
    <!-- Page Content  -->
    <div id="content">
        <h2>Bon</h2>
        <h5>Kies een tafel</h5>
        <a href="index.php?pages=bon&tafel=1"><button class="btn btn-primary">Tafel 1</button></a>
        <a href="index.php?pages=bon&tafel=2"><button class="btn btn-primary">Tafel 2</button></a>
        <a href="index.php?pages=bon&tafel=3"><button class="btn btn-primary">Tafel 3</button></a>
        <a href="index.php?pages=bon&tafel=4"><button class="btn btn-primary">Tafel 4</button></a>
        <a href="index.php?pages=bon&tafel=5"><button class="btn btn-primary">Tafel 5</button></a>
        <a href="index.php?pages=bon&tafel=6"><button class="btn btn-primary">Tafel 6</button></a>
        <a href="index.php?pages=bon&tafel=7"><button class="btn btn-primary">Tafel 7</button></a>
        <a href="index.php?pages=bon&tafel=8"><button class="btn btn-primary">Tafel 8</button></a>
        <a href="index.php?pages=bon&tafel=9"><button class="btn btn-primary">Tafel 9</button></a>
        <a href="index.php?pages=bon&tafel=10"><button class="btn btn-primary">Tafel 10</button></a>
    </div>
    <?php
} else {
    //Als er wel een tafelnummer is worden alle bijhorende gegevens opgehaald uit de database
    $tafel = $_GET['tafel'];
    try {
        $query = "SELECT * FROM Bestelling INNER JOIN MenuItem ON Bestelling.MenuCodeItem = MenuItem.MenuItemCode WHERE Tafel=$tafel";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    ?>
    <!-- Page Content  -->
    <div id="content">
        <h2>Bestellingen</h2>
        <h4>Tafel: <?php echo $_GET['tafel']; ?></h4>
        <br>
        <div class="tablecontainer">
            <table class="table">
                <?php
                //Hier worden alle bestelde gerechten getoont en word het totaal berekend
                $totaal = 0;
                foreach ($result as $row) {
                    echo '<tr class="table-light">';
                    echo '<td>' . $row['Aantal'] . 'x</td>';
                    echo '<td>' . $row['MenuItem'] . '</td>';
                    echo '<td>' . number_format($row['Prijs'],2, ',', ' ') . '</td>';
                    $rowTotal = $row['Prijs']*$row['Aantal'];
                    echo '<td>' . number_format($rowTotal, 2, ',', ' ') . '</td>';
                    echo '</tr>';
                    $totaal += $rowTotal;
                }
                ?>
                <tr class="table-light">
                    <td>Totaal</td>
                    <td></td>
                    <td></td>
                    <td><?php echo number_format($totaal, 2, ',', ' ')?></td>
                </tr>
            </table>
        </div>
    </div>
    <?php
}
?>
</body>
</html>