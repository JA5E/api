<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>API</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h1>Tabla de Datos</h1>
  <table>
    <thead>
      <tr>
        <th>id</th>
        <th>municipio</th>
        <th>indicador</th>
        <th>year</th>
        <th>valor</th>
        <th>medida</th>
      </tr>
    </thead>
    <tbody id="tabla-body">
      <!-- Los resultados de la API se mostrarán aquí -->
    </tbody>
  </table>

  <script>
    // Realizar la solicitud GET a la API en PHP
    fetch('method.php')
      .then(response => response.json())
      .then(data => {
        const tablaBody = document.getElementById('tabla-body');
        data.slice(0, 10).forEach(item => { // Limit to 10 rows
          const row = document.createElement('tr');
          row.innerHTML = `
            <td>${item.id}</td>
            <td>${item.desc_municipio}</td>
            <td>${item.indicador}</td>
            <td>${item.ano}</td>
            <td>${item.valor}</td>
            <td>${item.unidad_medida}</td>
          `;
          tablaBody.appendChild(row);
        });
      })
      .catch(error => console.error('Error:', error));
  </script>
</body>
</html>

