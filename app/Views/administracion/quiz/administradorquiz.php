<?php
echo view('plantillas/dentro_session/header.php');
echo view('administracion/quiz/modalcrearnivel.php');
echo view('administracion/quiz/modaleditarnivel.php');
echo view('administracion/quiz/modalcrearpregunta.php');
echo view('administracion/quiz/modalverrespuestas.php');
echo view('administracion/quiz/modaleditarpregunta.php');
?>

<div class="card-body">
	<!-- title -->
	<div class="d-md-flex align-items-center">
		<div>
			<h4 class="card-title">Administración del Quiz de Preguntas y Respuestas</h4>
		</div>
		<div class="ml-auto d-flex align-items-center">
			<div class="dl">
				<div class="card card-hover waves-effect waves-light" data-toggle="modal" data-target="#modalCrearNivel">
					<div class="box bg-info text-center">
						<h6 class="text-white">Crear Nivel</h6>
					</div>
				</div>
				<div class="card card-hover waves-effect waves-light" id="btnModalCrearPregunta">
					<div class="box bg-info text-center">
						<h6 class="text-white">Crear Pregunta</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- title -->
	<ul class="nav nav-pills custom-pills m-t-40 card-header bg-faded text-center" id="pills-tab2" role="tablist">
		<li class="nav-item">
			<a class="nav-link show active" id="pills-profile-tab2" data-toggle="pill" href="#test12" role="tab" aria-selected="false">Preguntas de los Quiz</a>
		</li>
		<li class="nav-item">
			<a class="nav-link show" id="pills-home-tab2" data-toggle="pill" href="#test11" role="tab" aria-selected="true">Niveles de las preguntas</a>
		</li>
	</ul>

	<div class="tab-content m-t-20" id="pills-tabContent2">

		<div class="tab-pane fade" id="test11" role="tabpanel" aria-labelledby="pills-home-tab2">
			<div class="table-responsive">
				<table id="nivelDatatable" class="table table-bordered dt-responsive v-middle nowrap" style="width:100%">
					<thead>
						<tr>
							<th class="border-top-0">Opciones</th>
							<th class="border-top-0">Tipo de Nivel</th>
							<th class="border-top-0">Estado</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>

		<div class="tab-pane fade active show" id="test12" role="tabpanel" aria-labelledby="pills-profile-tab2">
			<div class="table-responsive">
				<table id="preguntaDatatable" class="table table-bordered dt-responsive v-middle nowrap" style="width:100%">
					<thead>
						<tr>
							<th class="border-top-0">Opciones</th>
							<th class="border-top-0">Pregunta</th>
							<th class="border-top-0">Foto</th>
							<th class="border-top-0">Fecha de Creación</th>
							<th class="border-top-0">Nivel de Dificultad</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>


<?php
echo view('plantillas/dentro_session/footer.php');
?>