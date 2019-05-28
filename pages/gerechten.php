<!-- Page Content  -->
<div id="content">
    <h2>Gerechten</h2>
    <?php
    // Haalt alle gerechten op
    try {
        $query = "SELECT MenuItem.MenuItem, MenuItem.MenuItemCode, MenuItem.Prijs, Subgerecht.Subgerecht FROM MenuItem INNER JOIN Subgerecht ON MenuItem.SubgerechtCode = Subgerecht.SubgerechtCode WHERE MenuItem.GerechtCode = '3' OR MenuItem.GerechtCode = '4' OR MenuItem.GerechtCode = '5' OR MenuItem.GerechtCode = '6' ORDER BY Subgerecht.Subgerecht";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    //Checkt of er wel gerechten zijn
    if (!empty($result)){

    ?>
    <table class="table">
        <thead>
        <tr>
            <th>Soort drank</th>
            <th>Naam</th>
            <th>Prijs</th>
            <th><a href="index.php?pages=drank"><button class="btn btn-sm btn-primary right">Toevoegen</button></a></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $soortDrank = 0;
        // Print alle gerechten op het scherm, gesorteerd op subcategorie.
        foreach ($result as $row) {
            echo '<tr>';
            if ($soortDrank !== $row['Subgerecht']){
                echo '<td><b>' . $row['Subgerecht'] . '</b></td>';
            } else {
                echo '<td></td>';
            }
            $soortDrank = $row['Subgerecht'];
            echo '<td>' . $row['MenuItem'] . '</td>';
            echo '<td>' . $row['Prijs'] . '</td>';
            echo "<td><a href='#'><i onclick='delDrank(\"". $row['MenuItemCode'] ."\")' style='color: red; margin-left: 15px' class='fa fa-trash-alt right' aria-hidden='true'></i></a></a>";
            echo "<a href='index.php?pages=editDrank&id=". $row['MenuItemCode'] ."'><i style='color: orange' class='fa fa-pencil-alt right' aria-hidden='true'></i></td>";
            echo '</tr>';
        }
        }
        ?>
        </tbody>
    </table>
</div>
<script>
    // Functie om een drank of gerecht te verwijderen.
    function delDrank(id) {
        //Laat een melding zien.
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
                // Voert een Ajax call uit zodat het gerecht verwijderd word.
                $.ajax({
                    url:"files/delDrank.php",
                    type:"POST",
                    data:{itemId:id},
                    success:function() {
                        //Laat een melding zien.
                        Swal.fire({
                            title: 'Verwijderd!',
                            text: "Gerecht is succesvol verwijderd",
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
</body>
</html>