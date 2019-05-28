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
// Hier word gezorgt dat er van bepaalde constante gegevens al gebruik gemaakt kan worden
foreach ($result as $row) {}

?>
<!-- Page Content  -->
<div id="content">
    <form role="form" action="" method="post">
    <h2>Bon</h2>
    <p>Tafel: <?php echo $_GET['tafel']; ?></p>
    <p>Datum: <?php echo $row['Datum'];; ?></p>
    <p>Tijd: <?php echo $row['Tijd'];; ?></p>
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
                <input type="hidden" name="totaal" value="<?php echo number_format($totaal, 2, '.', ' ')?>">
            </tr>
            <tr class="table-light">
                <td>Betaald</td>
                <td></td>
                <td></td>
                <td><?php echo number_format($_GET['paid'], 2, ',', ' ')?></td>
            </tr>
            <tr class="table-light">
                <td>Terug</td>
                <td></td>
                <td></td>
                <td><?php echo number_format($_GET['back'], 2, ',', ' ')?></td>
            </tr>
        </table>
    </div>
        <?php
        //Hier wordt gecontroleerd of er is betaald, zoja dan wordt er een download pdf getoond
        //Anders
            if (!isset($_GET['paid'])) {
                ?>
                <div class="rekentool" id="rekentool">
                    <p>Betaald met:
                        <select id="selectBetaalmethode" class="form-control" name="betaalmethode" required>
                            <option name="betalen" value="0" disabled selected>Kies een afreken methode</option>
                            <option name="contant" value="contant">Contant</option>
                            <option name="pin" value="pin">Pin</option>
                        </select>
                    </p>
                    <input style="display: none" class="form-control" id="contantBedrag" name="contantBedrag"
                           placeholder="Bedrag contant">
                    <button class="btn btn-primary" type="submit" name="submit">Afrekenen</button>
                </form>
                </div>
            <?php
                } else {
                ?>
                    <a href="/TCPDF/pdf/pdfBon.php?tafel=<?php echo $tafel; ?>&paid=<?php echo $_GET['paid']; ?>&back=<?php echo $_GET['back']; ?>" target="_blank"><button class="btn btn-primary" type="button">Pdf downloaden</button></a>
                <?php
            }
            ?>
</div>
<?php
    }

    // Bekijkt of de bestelling word betaald
    if (isset($_POST['submit'])){
        $betaalmethode = $_POST['betaalmethode'];
        $totaal = $_POST['totaal'];
        $bedragContant = $_POST['contantBedrag'];
        $terug = $bedragContant - $totaal;


        // Check om de betaalmethode te beijken
        if ($betaalmethode === 'contant'){
            $url = 'index.php?pages=bon&tafel='. $_GET['tafel'] .'&paid='. $bedragContant .'&back='. $terug;
        } elseif ($betaalmethode === 'pin'){
            $url = 'index.php?pages=bon&tafel='. $_GET['tafel'] .'&paid='. $totaal .'&back='. 0;
        }

        //De afgerekende word nu in de database geplaatst
        try {
            $query = "INSERT INTO Bon (Tafel, Datum, Tijd, Betalingswijze) VALUES (:tafel, :datum, :tijd, :betalingswijze);";
            $stmt = $db->prepare($query);
            $data = array(":tafel" => $_GET['tafel'], ":datum" => $row['Datum'],  ":tijd" => $row['Tijd'], ":betalingswijze" => $betaalmethode);
            $stmt->execute($data);

            // Word een succes melding getoond.
            echo "<script>Swal.fire({title: 'Succesvol Afgerekend!' ,type: 'success', showConfirmButton: false, timer: 1000});</script>";
            echo '<script>setTimeout(function(){ window.location.replace("'.$url.'"); }, 1200);</script>';
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
?>
<script>
    // Als er contant word aangegeven kan dit worden ingevoerd zodat er op de bon staat wat er terug gegeven moet worden.
    $("#selectBetaalmethode").change(function(){
        if ($( "#selectBetaalmethode option:selected" ).val() === 'contant'){
            $('#contantBedrag').css('display', 'block');
        } else {
            $('#contantBedrag').css('display', 'none');
        }
    });
</script>
</body>
</html>