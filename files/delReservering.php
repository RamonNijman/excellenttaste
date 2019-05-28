<?php
include_once("../dbconfig.php");
//Verwijderen van een reservering
// Kijken of er wel een tafelnummer word mee gestuurd
if(isset($_POST["tafel"]))
{
    // Daadwerkelijk verwijderen van het gerecht.
    $query = "DELETE from Reservering WHERE Tafel=:tafel AND Datum=:datum AND Tijd=:tijd";
    $statement = $db->prepare($query);
    $statement->execute(
        array(
            ':tafel' => $_POST['tafel'],
            ':datum' => $_POST['datum'],
            ':tijd' => $_POST['tijd']
        )
    );
}

?>