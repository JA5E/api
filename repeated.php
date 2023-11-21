<?php
require "conection.php";

$sql = "SELECT indicador as repeated , COUNT(*) AS counts FROM zacatecas GROUP BY 1;";


$result = $conexion->query($sql);

// Comprobar si la consulta tuvo resultados
if ($result) {
    if ($result->num_rows > 0) {
        // Iterar a través de los resultados y almacenarlos en un array
        $results = [];
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        // Assuming $results is an array containing your data
        $json_data = json_encode($results);

        // Set the appropriate Content-Type header to indicate that you are sending JSON
        header('Content-Type: application/json');

        // Output the JSON data
        echo $json_data;

    } else {
        echo "No se encontraron registros.";
    }
} else {
    echo "Error en la consulta: " . $conexion->error;
}
$conexion->close();

?>