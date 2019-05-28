<?php
include_once("../dbconfig.php");
//Verwijderen van een reservering
// Kijken of er wel een id word mee gestuurd
if(isset($_POST["itemId"]))
{
    // Daadwerkelijk verwijderen van het gerecht.
    $query = "DELETE from MenuItem WHERE MenuItemCode=:id";
    $statement = $db->prepare($query);
    $statement->execute(
        array(
            ':id' => $_POST['itemId']
        )
    );
}

?>