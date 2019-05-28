<?php
$page = $_GET["pages"];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Excellent Taste</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <!-- jQuery CDN) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</head>

<body>
<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Excellent Taste</h3>
        </div>

        <ul class="list-unstyled components">
            <li class="<?php if($page === 'dashboard') { echo 'active'; } ?>">
                <a href="index.php?pages=dashboard">Homepagina</a>
            </li>
            <li class="<?php if($page === 'bestellingen' || $page === 'bon' || $page === 'addBestelling') { echo 'active'; } ?>">
                <a href="#bestellingSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Bestellingen</a>
                <ul class="collapse list-unstyled" id="bestellingSubmenu">
                    <li>
                        <a href="index.php?pages=addBestelling">Bestelling invoeren</a>
                    </li>
                    <li>
                        <a href="index.php?pages=bon">Bon voor klant</a>
                    </li>
                </ul>
            </li>
            <li class="<?php if($page === 'reserveringen' || $page === 'bestellingTafel') { echo 'active'; } ?>">
                <a href="index.php?pages=reserveringen">Reserveringen</a>
            </li>
            <li class="<?php if($page === 'overzichten'|| $page === 'overzichtkok'|| $page === 'overzichtbarman') { echo 'active'; } ?>">
                <a href="#overzichtSubmenu" data-toggle="collapse" aria-expanded="<?php if($page === 'overzichten' || $page === 'overzichtkok'|| $page === 'overzichtbarman') { echo 'true'; } ?>" class="dropdown-toggle">Overzichten</a>
                <ul class="collapse list-unstyled <?php if($page === 'overzichten' || $page === 'overzichtkok'|| $page === 'overzichtbarman') { echo 'show'; } ?>" id="overzichtSubmenu">
                    <li class="<?php if($page === 'overzichten' || $page === 'overzichtkok') { echo 'active'; } ?>">
                        <a href="index.php?pages=overzichtkok">Overzicht kok</a>
                    </li>
                    <li class="<?php if($page === 'overzichten' || $page === 'overzichtbarman') { echo 'active'; } ?>">
                        <a href="index.php?pages=overzichtbarman">Overzicht barman</a>
                    </li>
                </ul>
            </li>
            <li class="<?php if($page === 'gegevens' || $page === 'dranken' || $page === 'drank' || $page === 'editDrank') { echo 'active'; } ?>">
                <a href="#gegevensSubmenu" data-toggle="collapse" aria-expanded="<?php if($page === 'gegevens' || $page === 'dranken'|| $page === 'gerechten') { echo 'true'; } ?>" class="dropdown-toggle">Gegevens</a>
                <ul class="collapse list-unstyled <?php if($page === 'gegevens' || $page === 'dranken'|| $page === 'gerechten') { echo 'show'; } ?>" id="gegevensSubmenu">
                    <li class="<?php if($page === 'gegevens' || $page === 'dranken') { echo 'active'; } ?>">
                        <a href="index.php?pages=dranken">Dranken</a>
                    </li>
                    <li class="<?php if($page === 'gegevens' || $page === 'gerechten') { echo 'active'; } ?>">
                        <a href="index.php?pages=gerechten">Gerechten</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>