
<?php
// Definimos la codificación de los caracteres
define("DB_ENCODE", "utf8");
// Definimos una constante como nombre del proyecto
define("PRO_NOMBRE", "cc");
// Datos de producción, descomentar para pasar
define("DB_HOST", "localhost");
// Nombre de la base de datos
define("DB_NAME", "mortalidad");
// Usuario de la base de datos
define("DB_USERNAME", "root");
// Contraseña del usuario de la base de datos
define("DB_PASSWORD", "root");

///////////////////////////////////////////////////////////////////////////

// Conexión a la database utilizando mysqli
$conexion = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Comprobar si la conexión a la base de datos tuvo errores
if ($conexion->connect_error) {
	die("Falló conexión a la base de datos: " . $conexion->connect_error);
}

///////////////////////////////////////////////////////////////////////////
// Obtener el método de solicitud HTTP
$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_method) {
	case 'GET':
	

		if (isset($_GET['average'])) {
			$sql = "SELECT AVG(valor) as average FROM zacatecas;";
		}elseif (isset($_GET['repeted'])){
			$sql = "SELECT indicador as repeated , COUNT(*) AS counts FROM zacatecas GROUP BY 1;";
		}elseif (isset($_GET['media'])){
		#SELECT AVG(valor) AS mediana_valor FROM ( SELECT valor, @rownum:=@rownum+1 as `row_number`, @total_rows:=@rownum FROM (SELECT valor FROM zacatecas ORDER BY valor) as tu_tabla_ordenada, (SELECT @rownum:=0) r ) as ordered WHERE `row_number` IN (FLOOR((@total_rows+1)/2), FLOOR((@total_rows+2)/2)); 
			$sql = "SELECT
						AVG(d.valor) as Median 
					FROM
						(SELECT @rowindex:=@rowindex + 1 AS rowindex,
								zacatecas.valor AS valor
						FROM zacatecas
						ORDER BY zacatecas.valor) AS d
					WHERE
					d.rowindex IN (FLOOR(@rowindex / 2), CEIL(@rowindex / 2)); 
					";
					$conexion->query("SET @rowindex := -1;");
		}else{
			// Consulta SQL para seleccionar todos los registros de la tabla "blogs"
			$sql = "SELECT id, cve_municipio, desc_municipio, id_indicador, indicador, ano, valor, unidad_medida FROM zacatecas;";
			// Ejecutar la consulta
		}
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
		
		break;


	default:
		echo 'Método de solicitud no definido';
		$conexion->close();
		break;
}

?>
