<?php
echo view('plantillas/dentro_session/header.php');
echo view('administracion/usuarios/modalcrearusuario');
// echo $buscadorpalabra;
// echo $datosbuscador;
?>

<div class="container-fluid">
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Administracion buscador</h4>
					<h6 class="card-subtitle">About 14,700 result ( 0.10 seconds)</h6>
				</div>
			</div>
		</div>
	</div>

</div>

<?php
echo view('plantillas/dentro_session/footer.php');
?>