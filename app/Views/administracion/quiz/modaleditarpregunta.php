<!-- Create Modal -->
<div class="modal animated bounceInUp" id="modalEditarQuiz" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="formEditarQuiz" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="ti-marker-alt m-r-10"></i> Editar Quiz</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="input-group mb-3">
                                <input type="hidden" name="idQuizEditar" id="idQuizEditar">
                                <input type="hidden" name="fotoQuizEditar" id="fotoQuizEditar">
                                <input type="text" class="form-control" id="nameQuizEditar" name="nameQuizEditar" placeholder="Pregunta" aria-label="name">
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group mb-3">
                                <select class="form-control" id="selectNivelQuizEditar" name="selectNivelQuizEditar" aria-label="categoria" required>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    <h3 class="text-center">Imagen de la pregunta</h3>
                                </div>
                                <div class="input-group mb-3 card-hover">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-info bg-info">
                                            <thead class="text-white text-center">
                                                <tr>
                                                    <th scope="col">Imagen</th>
                                                    <th scope="col">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="imagenQuizEditar" class="text-center">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    <h3 class="text-center">Respuestas de la pregunta</h3>
                                </div>
                                <div class="input-group mb-3 card-hover">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-info bg-info">
                                            <thead class="text-white text-center">
                                                <tr>
                                                    <th>Respuesta</th>
                                                    <th>Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="respuestasQuizEditar" class="text-center">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Cerrar</button>

                    <button type="submit" class="btn btn-success waves-effect waves-light"><i class="ti-save"></i> Editar</button>
                </div>
            </form>
        </div>
    </div>
</div>