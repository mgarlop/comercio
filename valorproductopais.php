<?php
    require_once('marcosup.php');
?>
   <div class="py-3 bg-warning" >
      <div class="container">
        <div class="row text-center">
              <div class="text-center mx-auto col-10">
               <?php
                $sentenc="select TOTALALMACEN() AS TOTAL";
                $result=mysqli_query($c,$sentenc);
                $reg=mysqli_fetch_array($result);
               ?>               
               <h2> VALOR ACTUAL DEL ALMACÉN: <?php echo $reg[0];?>€</h2>   
            </div>
           </div>       
        </div>  
        <div class="row text-center">   
            <div class="text-center mx-auto col-10">        
               <?php
               $tabla="procedencia";
               $sentencia="select * from $tabla";
               
               echo '<table class="table table-condensed">';
               $cabeceras=mysqli_query($c,"SHOW FIELDS FROM $tabla");
               
               echo "<tr class='table-info'>";
               while ($cab=mysqli_fetch_row($cabeceras)){
                  echo "<th>$cab[0]</th>";
               }
               echo "<th scope='col'>PRODUCTOS</th>";
               echo "</tr>";
               
               $resultado=mysqli_query($c,$sentencia);

            if (isset($_GET['pagina'])) { $pagina=$_GET['pagina']; } else { $pagina=1; } 
            $numreg=mysqli_num_rows($resultado);
            $numpag= ceil($numreg/6);    
            $inicio=($pagina-1)*6;
            
            $sentencia .=" limit ".$inicio.", 6";
            $resultado=mysqli_query($c,$sentencia);

               while ($registro = mysqli_fetch_row($resultado)){
                  echo "<tr>";
                  $i=0;
                  foreach ($registro as $fila){
                     echo "<td> $registro[$i]</td>";
                     $i++;
                  }
                    echo '<td>';
                    echo '<button class="btn btn-warning btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#detalles'.$registro[0].'">';
                    echo 'Ver';
                    echo '</button>';
                    echo '</td>';
                  echo "</tr>"; 

                  // Fila colapsable
                  echo '<tr class="collapse table-warning" id="detalles'.$registro[0].'">';
                  echo '<td colspan="4">'; // <--- CAMBIO 2: Ponemos un TD que cubra las 4 columnas
                    echo "<h4>Productos de $registro[0] actualmente en el Almacén</h4>";
                    
                    // IMPORTANTE: He cambiado el nombre de la columna a 'pais'. 
                    // Si en tu BD se llama 'procedencia_id' o algo así, cámbialo aquí abajo:
                    $consultaproductospais="select nombre_producto, precio, stock, precio*stock as valor, foto from producto where pais='$registro[0]'";
                    $R=mysqli_query($c, $consultaproductospais);
                   
                  echo '<table class ="table table-condensed table-striped w-90 mx-auto">';
                  echo "<tr class='table-dark'>";
                    echo "<th>PRODUCTO</th><th>PRECIO</th><th>STOCK</th><th>VALOR</th><th>FOTO</th>";
                  echo '</tr>';     
                
                  if($R){ // Solo recorremos si la consulta no da error
                      while ($regProd = mysqli_fetch_row($R)){
                       echo "<tr>";
                       $K=0;
                       foreach ($regProd as $filaProd){
                        echo "<td>";
                        if ($K == 4) echo "<img src='imagenes/$regProd[4]' height='50px'><br>$regProd[$K]";
                        else echo "$regProd[$K]";
                        echo "</td>";
                        $K++;
                       }
                       echo '</tr>';
                      }
                  }
                  echo '</table>';
                  echo '</td>'; // Cerramos el TD del colspan
                  echo '</tr>'; // Cerramos la fila colapsable
               }
               
               echo "</table>";

                    if ($pagina==1){ $anterior=1; } else { $anterior=$pagina-1; }
                    if ($pagina==$numpag){ $siguiente=$pagina; } else { $siguiente=$pagina+1; }
                    
                    echo "<div class='col-md-12 text-center'>";
                    echo '<ul class="pagination justify-content-center ">';
                    echo '<li class="page-item "><a class="page-link" href="valorproductopais.php?pagina='.$anterior.'">&laquo;</a></li>';
                    for ($i=1;$i<=$numpag;$i++) {
                        if($i==$pagina){ echo '<li class="page-item active"><a class="page-link" href="valorproductopais.php?pagina='.$i.'">'.$i.'</a></li>'; }
                        else { echo '<li class="page-item"><a class="page-link" href="valorproductopais.php?pagina='.$i.'">'.$i.'</a></li>'; }
                    }
                    echo '<li class="page-item "><a class="page-link" href="valorproductopais.php?pagina='.$siguiente.'">&raquo;</a></li>';
                    echo '</ul>';
                    
               mysqli_close($c);
               ?>       
            </div>       
        </div>
   </div>
<?php
    require_once('marcoinf.php')
?>