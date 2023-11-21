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

  <br><br>
  <div id="averageText">
  </div>
  <br><br>


  <table>
    <thead>
      <tr>
        <th>Repeted data</th>
        <th>count</th>
      </tr>
    </thead>
    <tbody id="countT">
      <!-- Los resultados de la API se mostrarán aquí -->
    </tbody>
  </table>
  <br><br>

<!-- REQUESTS FOR THE DIFERENT DATA WE NEED -->
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
    <script>
      fetch('average.php')
      .then(response => response.json())
      .then(data => {

          const text = document.getElementById('averageText');
          text.innerHTML += `
                            <h2>Average of valor column: ${data[0].average}</h2>
                        `;
      })
      .catch(error => console.error('Error:', error));
    </script>
    <script>
        fetch('repeated.php')
          .then(response => response.json())
          .then(data => {
            const countBody = document.getElementById('countT');
            data.forEach(item => { 
              console.log(item);
              const row = document.createElement('tr');
              row.innerHTML = `
                <td>${item.repeated}</td>
                <td>${item.counts}</td>
              `;
              countBody.appendChild(row);
            });
          })
          .catch(error => console.error('Error:', error));
    </script>
    <script>
      fetch('median.php')
      .then(response => response.json())
      .then(data => {

          const text = document.getElementById('averageText');
          text.innerHTML += `
                            <h2>Median of valor column: ${data[0].Median}</h2>
                        `;
      })
      .catch(error => console.error('Error:', error));
    </script>



</body>
</html>