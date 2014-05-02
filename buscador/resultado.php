<?php
include('includes/db.php');
			  if (isset($_GET['res'])){
			  ?>
			  <div id="contenido">No se obtuvo ningun refrán como resultado de esta búsqueda.</div>
			  <?php
			  }else if (isset($_SESSION['resultado'])){
			  $listaref = unserialize($_SESSION['resultado']);
			  unset($_SESSION['resultado']);
			  echo '<strong>Resultado de la búsqueda</strong></br></br>';
			  $total = $listaref->total();
			  if ($total > 1)			  
			  echo 'Total encontrado: <strong>'.$total.' refranes</strong>, ';
			  else if ($total == 1)
			  echo 'Total encontrado: <strong>'.$total.' refrán</strong>, ';
			  $cadref = "SELECT COUNT(*) AS cantref FROM refranes";
			  $resref = $db->sql_query($cadref);
			  $cantref = $db->sql_fetchfield('cantref', 0, $resref);
			  echo 'lo cual representa un <strong>'.number_format($total*100/$cantref, 2).'%</strong> del total.</br></br>';
			  $i = 0;
			  $listaref->ordenar();
			  $listaref->reset();
			while ($i < $total) {
			echo '<a href="fdetallerefran.php?refid='.$listaref->index().'" class="resultado">'.$listaref->desref($listaref->index()).'</a>';
			$listaref->next();
			$i += 1;
			}			
			}
			if (isset($_GET['q'])){
				$arrmarcar = explode(',', $_GET['q']);
				$i = 0;
				while ($i < count($arrmarcar)) {
					?>
					<script type="text/javascript">marca(<?php echo $arrmarcar[$i]; ?>);</script>
					<?php
					$i += 1;
				}
			}
			  ?>
