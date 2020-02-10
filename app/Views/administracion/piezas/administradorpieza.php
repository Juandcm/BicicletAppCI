<?php
echo view('plantillas/dentro_session/header.php');
echo view('administracion/piezas/modalcrearpieza.php');
echo view('administracion/piezas/modaleditarpieza.php');
?>
<div class="container">
	<div class="row justify-content-center align-content-start">
		<div class="col-lg-6">
			<a href="#" data-toggle="modal" data-target="#modalCrearPieza">
				<div class="card card-hover" style="background:#e1dddd !important">
					<div class="card-header bg-success waves-effect waves-light">
						<h4 class="m-b-0 text-white text-center">Agregar Pieza</h4>
					</div>
				</div>
			</a>
		</div>
	</div>
</div>


<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 col-xl-12 col-md-12">

			<div class="card" id="primerCard">
				<div class="card-body">
					<div class="d-flex no-block align-items-center">
						<h2 class="card-title text-center">Piezas de las Bicicletas</h2>
						<div class="ml-auto">
							<div class="btn-group">
								<form id="buscarCategoria" class="btn-group">
									<input type="text" class="form-input quicksearch" placeholder="Buscar" />
									<button type="submit" class="btn btn-success waves-effect waves-light" style="margin-right: 20px">
										<i class="fa fa-search"></i>
									</button>
								</form>
							</div>
						</div>

					</div>
				</div>

				<div class="card-footer">
					<h3 class="card-title">Categorias: <span class="card-subtitle" class="filter-count" id="filter-count-new"></span></h3>

					<div class="button-group filters-button-group" id="botonesCategorias">
					</div>
					<hr>
					<div class="container-fluid">
						<div class="row el-element-overlay grid" id="contenidototalPiezas">
						</div>
					</div>
				</div>
			</div>

			<div class="card" id="CardCargando">
			</div>

			<div class="card" id="segundoCard">
				<div class="card-body">
					<div class="d-flex no-block align-items-center">
						<h2 class="card-title text-center" id="nombrePiezaDetalles"></h2>
						<div class="ml-auto">
							<div class="btn-group">
								<div class="btn-group">
									<button type="button" id="regresarCardPiezas" class="btn btn-success waves-effect waves-light" style="margin-right: 20px" data-toggle="tooltip" data-placement="top" title="Regresar">
										<i class="mdi mdi-backspace"></i>
									</button>
								</div>
							</div>
						</div>

					</div>
				</div>

				<div class="card-footer">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-body">
										<h2 class="card-title" id="categoriaPiezaDetalles"></h2>
										<div class="row">
											<div class="col-lg-3 col-md-3 col-sm-6">
												<div class="white-box text-center">
													<img class="img-responsive" id="imagenprincipalPiezaDetalles" src="" style="width: 100%;height: 425px;">
													<p>Imagen Principal</p>
												</div>
											</div>
											<div class="col-lg-9 col-md-9 col-sm-6">
												<div class="container-fluid">
													<div class="row">
														<div class="col-12">
															<p id="descripcionPiezaDetalles" class="text-justify"></p>
														</div>
													</div>
													<div class="row">
														<div class="col-12" id="mostrarImageneSecundarias">
															<div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
																<ol class="carousel-indicators" id="indicadoresCarrusel">
																</ol>

																<div class="carousel-inner" role="listbox" id="listboxCarrusel">
																</div>

																<a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
																	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
																	<span class="sr-only">Previous</span>
																</a>

																<a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
																	<span class="carousel-control-next-icon" aria-hidden="true"></span>
																	<span class="sr-only">Next</span>
																</a>
															</div>
															<p class="text-center">Imagenes Secundarias</p>
														</div>
													</div>
												</div>
											</div>

										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
echo view('plantillas/dentro_session/footer.php');
?>