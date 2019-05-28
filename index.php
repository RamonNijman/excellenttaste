<?php
    //dit start de sessie met gegevens en die wordt afgesloten als je pagina afsluit zo blijf je ingelogd
    session_start();

    //je koppelt de bestanden die nodig zijn voor de pagina
    include_once("dbconfig.php");
    include_once("header.php");

    //Haalt de pagina op voor de gebruiker
    if(isset($_GET["pages"])) {
        $page = $_GET["pages"];
    } else {
        $page = "dashboard";
    }

    //Laad de pagina in
    include("pages/" . $page . ".php");
?>
