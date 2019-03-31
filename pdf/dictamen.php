<?php
require 'vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf('L', 'A4', 'es', 'true', 'UTF-8');
$html2pdf->writeHTML('
<page>
    <h1>HOLA</h1>
</page>
');
$html2pdf->writeHTML('
<page>
    <h1>HOLA 2</h1>
</page>
');
$html2pdf->output('dictamen.pdf');
