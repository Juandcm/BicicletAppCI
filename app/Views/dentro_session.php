<?php
echo view('plantillas/dentro_session/header.php');
?>
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->

<div class="row">
	<!-- column -->
	<div class="col-lg-4">
		<div class="card card-hover" style="background:#e1dddd !important">
			<div class="card-header bg-success">
				<h4 class="m-b-0 text-white text-center">Administración</h4>
			</div>
			<div class="card-body">
				<div class="flex-column">
					<h3 class="text-center">Categorías de las Bicicletas</h3>
					<div class="text-center display-7">
						<a href="categorias">
							<div class="round align-self-center round-info waves-effect waves-light"><i class="icon-settings"></i></div>
						</a>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- column -->
	<div class="col-lg-4">
		<div class="card card-hover" style="background:#e1dddd !important">
			<div class="card-header bg-success">
				<h4 class="m-b-0 text-white text-center">Administración</h4>
			</div>
			<div class="card-body">
				<div class="flex-column">
					<h3 class="text-center">Foro</h3>
					<div class="text-center display-7">
						<a href="foro">
							<div class="round align-self-center round-info waves-effect waves-light"><i class="ti-comments"></i></div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- column -->
	<div class="col-lg-4">
		<div class="card card-hover" style="background:#e1dddd !important">
			<div class="card-header bg-success">
				<h4 class="m-b-0 text-white text-center">Administración</h4>
			</div>
			<div class="card-body">
				<div class="flex-column">
					<h3 class="text-center">Usuarios</h3>
					<div class="text-center display-7">
						<a href="usuarios">
							<div class="round align-self-center round-info waves-effect waves-light"><i class="icon-people"></i></div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- column -->
	<div class="container">
		<div class="row justify-content-center">

			<div class="col-lg-6">
				<div class="card card-hover" style="background:#e1dddd !important">
					<div class="card-header bg-success">
						<h4 class="m-b-0 text-white text-center">Administración</h4>
					</div>
					<div class="card-body">
						<div class="flex-column">
							<h3 class="text-center">Quiz de Preguntas y Respuestas</h3>
							<div class="text-center display-7">
								<a href="quiz">
									<div class="round align-self-center round-info waves-effect waves-light"><i class="icon-question"></i></div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- column -->
			<div class="col-lg-6">
				<div class="card card-hover" style="background:#e1dddd !important">
					<div class="card-header bg-success">
						<h4 class="m-b-0 text-white text-center">Administración</h4>
					</div>
					<div class="card-body">
						<div class="flex-column">
							<h3 class="text-center">Piezas de las Bicicletas</h3>
							<div class="text-center display-7">
								<a href="piezas">
									<div class="round align-self-center round-info waves-effect waves-light"><i class="ti-settings"></i></div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- column -->

		</div>
	</div>
</div>

<?php
echo view('plantillas/dentro_session/footer.php');
?>