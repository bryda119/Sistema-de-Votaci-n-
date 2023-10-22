<?php
include 'includes/session.php';
include 'includes/slugify.php';

if (isset($_POST['vote'])) {
    $sql = "SELECT * FROM positions";
    $query = $conn->query($sql);
    
    $errorMessages = [];
    $sql_array = [];

    while ($row = $query->fetch_assoc()) {
        $position = slugify($row['description']);
        $pos_id = $row['id'];

        if (isset($_POST[$position])) {
            $candidate = $_POST[$position];

            if (empty($candidate)) {
                $errorMessages[] = 'Por favor, seleccione un candidato para ' . $row['description'];
            } else {
                $sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) VALUES ('" . $voter['id'] . "', '$candidate', '$pos_id')";
            }
        }
    }

    if (empty($errorMessages)) {
        foreach ($sql_array as $sql_row) {
            $conn->query($sql_row);
        }

        unset($_SESSION['post']);
        $_SESSION['success'] = 'Papeleta de Votación enviada';
    } else {
        $_SESSION['error'] = $errorMessages;
    }
} else {
    $_SESSION['error'] = 'Por favor, selecciona un candidato para votar';
}

header('location: home.php');
?>
