<!-- Page Content  -->
<div id="content">
    <h2>Reserveringen</h2>
    <?php
    //Hier worden alle reserveringen opgehaald vanuit de database
    try {
        $query = "SELECT * FROM Reservering INNER JOIN Klant ON Klant.klantid = Reservering.KlantId ORDER BY Datum, Tijd";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    //Hier wordt gecontroleerd of er wel reserveringen zijn
    if (!empty($result)){

    ?>
    <table class="table">
        <thead>
        <tr>
            <th>Datum</th>
            <th>Tijd</th>
            <th>Tafel</th>
            <th>Naam</th>
            <th>Telefoon</th>
            <th>Aantal personen</th>
            <th><button class="btn btn-primary"><i class="fa fa-plus"></i></button></th>
        </tr>
        </thead>
        <tbody>
        <?php
        //Hier worden de reserveringen getoont
        foreach ($result as $row) {
            $datum = $row['Datum'];
            $datePieces = explode("-", $datum);
            $newDate = $datePieces[2] .'-'. $datePieces[1] .'-'. $datePieces[0];
            $date = new DateTime($newDate);
            $now = new DateTime();
            if ($date < $now){
                echo '<tr class="table-danger">';
            } else {
                echo '<tr>';
            }
            echo '<td onclick="document.location = \'index.php?pages=bestellingTafel&tafel='.$row['Tafel'] .'&datum='.$row['Datum'] .'&tijd='.$row['Tijd'] .'\';">' . $row['Datum'] . '</td>';
            echo '<td onclick="document.location = \'index.php?pages=bestellingTafel&tafel='.$row['Tafel'] .'&datum='.$row['Datum'] .'&tijd='.$row['Tijd'] .'\';">' . $row['Tijd'] . '</td>';
            echo '<td onclick="document.location = \'index.php?pages=bestellingTafel&tafel='.$row['Tafel'] .'&datum='.$row['Datum'] .'&tijd='.$row['Tijd'] .'\';">' . $row['Tafel'] . '</td>';
            echo '<td onclick="document.location = \'index.php?pages=bestellingTafel&tafel='.$row['Tafel'] .'&datum='.$row['Datum'] .'&tijd='.$row['Tijd'] .'\';">' . $row['Klantnaam'] . '</td>';
            echo '<td onclick="document.location = \'index.php?pages=bestellingTafel&tafel='.$row['Tafel'] .'&datum='.$row['Datum'] .'&tijd='.$row['Tijd'] .'\';">' . $row['Telefoon'] . '</td>';
            echo '<td onclick="document.location = \'index.php?pages=bestellingTafel&tafel='.$row['Tafel'] .'&datum='.$row['Datum'] .'&tijd='.$row['Tijd'] .'\';">' . $row['Aantal'] . '</td>';
            echo "<td><a href='#'><i onclick='delReservering(\"". $row['Tafel'] .'", "'. $row['Datum'] .'", "'. $row['Tijd']."\")' style='color: red' class='fa fa-trash-alt' aria-hidden='true'></i></a></td>";
            echo '</tr>';
        }
        }
        ?>
        </tbody>
    </table>
</div>
</body>
<script>
    //Hier word een confirm gevraagd of de reservering ook daadwerkelijk verwijderd moet worden.
    function delReservering(tafel, datum, tijd) {
        Swal.fire({
            title: 'Weet u dit zeker',
            text: "Het is niet mogelijk om dit ongedaan te maken",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Verwijderen',
            cancelButtonText: 'Annuleren'
        }).then((result) => {
            if (result.value) {
                //Hier wordt een ajax request uitgevoerd om de reservering te verwijderen
                $.ajax({
                    url:"files/delReservering.php",
                    type:"POST",
                    data:{tafel:tafel, datum:datum, tijd:tijd},
                    success:function() {
                        Swal.fire({
                            title: 'Verwijderd!',
                            text: "Reservering is succesvol verwijderd",
                            type: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function(){ window.location.reload(); }, 1200);
                    }
                });
            }
         })
    }
</script>
</html>