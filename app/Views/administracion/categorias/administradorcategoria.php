<?php
echo view('plantillas/dentro_session/header.php');
echo view('administracion/categorias/modalcrearcategoria.php');
echo view('administracion/categorias/modaleditarcategoria.php');
?>

<div class="container-fluid">
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->
	<div class="row">

		<div class="col-lg-12 col-xl-12 col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="d-flex no-block align-items-center m-b-30">
						<h4 class="card-title">Todas las categorias</h4>
						<div class="ml-auto">
							<div class="btn-group">
								<button type="button" class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#modalCrearCategoria">
									Crear categoria
								</button>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table id="categoriasDatatable" class="table table-bordered dt-responsive nowrap" style="width:100%">
							<thead>
								<tr>
									<th>Opciones</th>
									<th>Nombre categoria</th>
									<th>Foto</th>
									<th>Estado</th>
									<th>Creado</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

	</div>

</div>

<?php
echo view('plantillas/dentro_session/footer.php');
?>