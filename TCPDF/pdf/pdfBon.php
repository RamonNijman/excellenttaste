<?php

// Include the main TCPDF library (search for installation path).
require_once('../../dbconfig.php');
require_once('tcpdf_include.php');

// Haalt alle gegevens op voor de bon
$tafel = $_GET['tafel'];
try {
    $query = "SELECT * FROM Bestelling INNER JOIN MenuItem ON Bestelling.MenuCodeItem = MenuItem.MenuItemCode WHERE Tafel=$tafel";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e->getMessage();
}

// Dit zorgt er voor dat er al variabelen gebruikt kunnen worden.
foreach ($result as $row){
}

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Excellent Taste');
$pdf->SetTitle('Afreken bon tafel: ' . $tafel);
$pdf->SetSubject('Afrekenbon');

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('helvetica', '', 12, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// De bon printen in het pdf
$html = '<h1>Restaurant Excellent Taste</h1>
<h2>Afrekenbon</h2>
<p style="font-size: 1em; font-weight: 300; line-height: 1.1em; margin-bottom: 0px;">Tafel: '. $row['Tafel'] .'</p>
<p style="font-size: 1em; font-weight: 300; line-height: 1.1em; margin-bottom: 0px;">Datum: '. $row['Datum'] .'</p>
<p style="font-size: 1em; font-weight: 300; line-height: 1.1em; margin-bottom: 0px;">Tijd: '. $row['Tijd'] .'</p>
<p></p>
        <table style="width: 100%; padding: 8px;">
            <thead>
                <tr style="padding-top: 12px; text-align: left; background-color: #d1d1d1; color: #444444;">
                    <th><b>Aantal</b></th>
                    <th><b>Gerecht</b></th>
                    <th><b>Prijs</b></th>
                    <th><b>Prijs</b></th>
                </tr>
            </thead>
            <tbody>';

        $totaal = 0;
        foreach ($result as $row) {
            $html .= '<tr>
            <td>' . $row['Aantal'] . 'x</td>
            <td>' . $row['MenuItem'] . '</td>
            <td>' . number_format($row['Prijs'], 2, ',', ' ') . '</td>';
            $rowTotal = $row['Prijs']*$row['Aantal'];
            $html .= '<td>' . number_format($rowTotal, 2, ',', ' ') . '</td>
            </tr>';
            $totaal += $rowTotal;
        }
            $html .= '
                <tr class="table-light">
                    <td>Totaal</td>
                    <td></td>
                    <td></td>
                    <td>'. number_format($totaal, 2, ',', ' ') .'</td>
                    <input type="hidden" name="totaal" value="25.80">
                </tr>
                <tr class="table-light">
                    <td>Betaald</td>
                    <td></td>
                    <td></td>
                    <td>'. number_format($_GET['paid'], 2, ',', ' ') .'</td>
                </tr>
                <tr class="table-light">
                    <td>Terug</td>
                    <td></td>
                    <td></td>
                    <td>'. number_format($_GET['back'], 2, ',', ' ') .'</td>
                </tr>
        </tbody></table>';

// Print text using writeHTMLCell()
$pdf->writeHTML($html, true, false, true, false, '');
// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('afrekenbon.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
