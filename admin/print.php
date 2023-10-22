<?php
// Incluir el archivo de sesión si es necesario
include 'includes/session.php';

// Función para generar las filas de la tabla
function generateRow($conn){
    $contents = '';

    // Consultar las posiciones ordenadas por prioridad
    $sql = "SELECT * FROM positions ORDER BY priority ASC";
    $query = $conn->query($sql);
    
    // Recorrer las posiciones y sus candidatos
    while($row = $query->fetch_assoc()){
        $id = $row['id'];
        $contents .= '
            <tr>
                <td colspan="2" align="center" style="font-size:15px;"><b>'.$row['description'].'</b></td>
            </tr>
            <tr>
                <td width="80%"><b>Candidates</b></td>
                <td width="20%"><b>Votes</b></td>
            </tr>
        ';

        // Consultar los candidatos de la posición actual
        $sql = "SELECT * FROM candidates WHERE position_id = '$id' ORDER BY lastname ASC";
        $cquery = $conn->query($sql);

        // Recorrer los candidatos y contar los votos
        while($crow = $cquery->fetch_assoc()){
            $sql = "SELECT * FROM votes WHERE candidate_id = '".$crow['id']."'";
            $vquery = $conn->query($sql);
            $votes = $vquery->num_rows;

            $contents .= '
                <tr>
                    <td>'.$crow['lastname'].", ".$crow['firstname'].'</td>
                    <td>'.$votes.'</td>
                </tr>
            ';
        }
    }

    return $contents;
}

// Cargar la configuración del título desde un archivo de configuración
$parse = parse_ini_file('config.ini', FALSE, INI_SCANNER_RAW);
$title = $parse['election_title'];

// Configuración y creación del objeto PDF
require_once('../tcpdf/tcpdf.php');
$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Result: '.$title);

// Establecer la fuente y el tamaño de fuente para el título
$pdf->SetFont('times', 'B', 16);

// Agregar una página al documento
$pdf->AddPage();

// Agregar el logo en la esquina superior izquierda
$logo = '../images/sj.jpeg'; // Ruta a tu logo
$pdf->Image($logo, 10, 10, 25);

// Agregar espacio después del logo
$pdf->Ln(20);

// Título centrado en la página
$pdf->Cell(0, 10, $title, 0, 1, 'C'); // CeBntrado y con salto de línea

// Contenido de la tabla
$content = '
    <table border="1" cellspacing="0" cellpadding="3">
';
$content .= generateRow($conn);
$content .= '</table>';

// Agregar la tabla al PDF
$pdf->writeHTML($content);

// Generar el archivo PDF y mostrarlo en el navegador
$pdf->Output('election_result.pdf', 'I');
?>
