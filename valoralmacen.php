<?php
require_once('marcosup.php');
	
?>

    <div class="section">
      <div class="container">
        <div class="row text-center">++
		   <div class="text-center mx-auto col-10">
			<h2> VALOR ALMACEN</h2>
         <form method="GET" action="valoralmacen.php" class="form-inline mb-3">
</form>	
		   </div>		
		</div>	
		<div class="row text-center">	
			<div class="text-center mx-auto col-10">
				<center>
			<h2></h2>
            <?php
            
            // Seleccionamos la tabla con la que vamos a trabajar
            $tabla="valoralmacen";// Escribir entre comillas el nombre de la tabla a listar
            
            // Establecemos la sentencia SQL de la Consulta a realizar
           $sentencia="SELECT * FROM $tabla";
if (isset($_GET['buscar']) && !empty($_GET['buscar'])) {
    $busqueda = mysqli_real_escape_string($c, $_GET['buscar']);
    $sentencia .= " WHERE nombre LIKE '%$busqueda%'"; // Cambia 'nombre' por otro campo si lo necesitas
}

            // Dibujamos una tabla HTML para mostrar los valores almacenados
            echo '<table class="table table-condensed">';
            
            // Recopilar los nombres de las columnas de la tabla seleccionada
            $cabeceras=mysqli_query($c,"SHOW FIELDS FROM $tabla");
            
            // Construye la fila de cabeceras
            echo "<tr bgcolor='#f0f000'>";
            while ($cab=mysqli_fetch_row($cabeceras)){
				echo "<th>$cab[0]</th>";
			}
            echo "</tr>";
            
            // Recopilar las filas almacenadas en la tabla
            $resultado=mysqli_query($c,$sentencia);
            
//--------------------------------------------------------------------------------------------------
		// Primera parte. Preparación paginación. 
        // Este código hay que añadirlo tras ejecutar la sentencia para saber 
			// el total de registros de la consulta y poder calcular el número de páginas
			// --- --- --- --- --- --- --- --- --- --- --- ---
			// --- --- --- Preparamos la paginación -- --- --- 
			// comprueba si viene número de página   
			if (isset($_GET['pagina']))
				{
				$pagina=$_GET['pagina'];
				}
				else{
				$pagina=1;  
				} 
			// Calculamos el número de páginas que tenemos que usar para visualizar el resultado
			//$numreg=mysql_num_rows($resultado);
			$numreg=mysqli_num_rows($resultado);
			// Como vamos a usar 2 registros por página dividimos entre tres
			$numpag= ceil($numreg/2);    
			
			// Calcula cuál será el registro de inicio para construir la consulta
			$inicio=($pagina-1)*2;
			
			// Volvemos a ejecutar la sentencia pero fijando los límites.
			$sentencia .=" limit ".$inicio.", 2";
            $resultado=mysqli_query($c,$sentencia);
			//echo "<hr>$sentencia<hr>";
			// --- --- --- --- --- --- --- --- --- --- --- ---


            // Recorremos $resultado mostrando cada fila de la tabla
        while ($registro = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    foreach ($registro as $campo => $valor) {
        if ($campo === 'foto') {
            $ruta = "imagenes/" . htmlspecialchars($valor);
            if (!empty($valor) && file_exists($ruta)) {
                echo "<td><img src='$ruta' alt='foto' style='height:50px;'></td>";
            } else {
                echo "<td><em>Sin imagen</em></td>";
            }
        } else {
            echo "<td>" . htmlspecialchars($valor) . "</td>";
        }
    }
    echo "</tr>";
}
             // Fin de la tabla HTML
            echo "</table>";
            
//--------------------------------------------------------------------------------------------------
		// Segunda parte. Paginador.
		// Este código se añade al final de la consulta en la última sección row
		   // --- --- --- --- --- --- --- --- --- --- --- ---
			// --- Mostramos el paginador ---       
            // Calcula páginas anterior y siguiente
            if ($pagina==1){
                $anterior=1;
            }
            else{
                $anterior=$pagina-1;
            }
            if ($pagina==$numpag){
                $siguiente=$pagina;
            }
            else{
                $siguiente=$pagina+1;
            }
            
			echo "<div class='col-md-12 text-center'>"; // Fin de la capa row  
			echo '<ul class="pagination justify-content-center ">';
			echo '	<li class="page-item ">';
			$paramBusqueda = isset($_GET['buscar']) ? '&buscar=' . urlencode($_GET['buscar']) : '';
echo '	  <a class="page-link" href="valoralmacen.php?pagina='.$anterior.$paramBusqueda.'">&laquo;</a>';
			echo '	</li>';
			for ($i=1;$i<=$numpag;$i++)
            {
                if($i==$pagina){
						echo '	<li class="page-item active">';
						echo '	  <a class="page-link" href="valoralmacen.php?pagina='.$i.$paramBusqueda.'">'.$i.'</a>';
						echo '	</li>';						
					}
                    else{
						echo '	<li class="page-item"><a class="page-link" href="valoralmacen.php?pagina='.$i.'">'.$i.'</a></li>';
                    }
            }
			echo '	<li class="page-item ">';
			echo '	  <a class="page-link" href="valoralmacen.php?pagina='.$siguiente.$paramBusqueda.'">&raquo;</a>';
			echo '	</li>';
			echo '  </ul>';
			
			// --- Fin paginación ---
			// --- --- --- --- --- --- --- --- --- --- --- ---

            // Cerramos la conexión con la base de datos
            mysqli_close($c);
            
            ?>
            </center>
          </div>           
        </div> 
          <div class="row text-center">
		   <div class="col">
			<hr>	
		   </div>		
		</div>
      </div>
    </div>

<?php
	require_once('marcoinf.php');
?>	
