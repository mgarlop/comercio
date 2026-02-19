<?php
    // Inserta el marco superior 
	require_once('marcosup.php');
?>      
      <div class="section">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h1 class="text-center text-primary">Consulta de la Tabla --NOMBRE DE LA TABLA--</h1>
              <hr>
            </div>	
          </div>		
          <div class="row">
			<?php
				// Seleccionamos la tabla con la que vamos a trabajar
				$tabla="";// Escribir entre comillas el nombre de la tabla a listar
				
				// Establecemos la sentencia SQL de la Consulta a realizar
				$sentencia="select * from $tabla";
				
				// Recopilar las filas almacenadas en la tabla
				$resultado=mysqli_query($c,$sentencia);
				
				// Recorremos $resultado mostrando cada fila de la tabla
				while ($registro = mysqli_fetch_row($resultado)){
					// Construimos la entrada para cada fila de la tabla
					echo '<div class="col-md-3 col-sm-3 border-0">';
                    echo '<p>Dato 1:'.$registro[1].'</p>';
                    echo '<p>Dato 2:'.$registro[0].'</p>';
					echo '<p>Dato 3:'.$registro[2].'</p>';
					echo '</div>';					
				}
			// Cerramos la conexión con la base de datos
            mysqli_close($c);			
			?>
          </div>
        </div>
      </div>
<?php
    // Inserta el marco inferior 
	require_once('marcoinf.php');
?>
