<!-- Create Modal -->
<div class="modal animated bounceInUp" id="modalEditarPieza" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="formEditarPieza" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="ti-marker-alt m-r-10"></i> Editar Pieza</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-info waves-effect waves-light"><i class="ti-user text-white"></i></button>
                                <input type="hidden" name="idPiezaEditar" id="idPiezaEditar">
                                <input type="hidden" name="idImagenesEliminadas" id="idImagenesEliminadas">
                                <input type="text" class="form-control" id="namePiezaEditar" name="namePiezaEditar" placeholder="Nombre" aria-label="name">
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-info waves-effect waves-light"><i class="ti-user text-white"></i></button>
                                <select class="form-control" id="selectCategoriaPiezaEditar" name="selectCategoriaPiezaEditar" aria-label="categoria" required>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group mb-3">
                                <textarea class="form-control" rows="5" style="height: 223px;" name="descriptionPiezaEditar" id="descriptionPiezaEditar" placeholder="Descripción..."></textarea>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    <h3 class="text-center">Imagenes de la Pieza</h3>
                                </div>
                                <div class="input-group mb-3 card-hover">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-info bg-info">
                                            <thead class="text-white text-center">
                                                <tr>
                                                    <th scope="col">Imagen</th>
                                                    <th scope="col">Tipo</th>
                                                    <th scope="col">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="imagenesPiezaEditandoMostrar" class="text-center">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    <h3 class="text-center">Subir imagenes</h3>
                                </div>
                                <div class="dropzone" id="dropzonepiezaeditar" style="width: 100%">
                                    <div class="fallback" style="width: 100%">
                                        <input name="file" type="file" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <input type="hidden" id="urlfotoeditarpieza" name="urlfotoeditarpieza">
                                <button type="button" id="subirfotoPiezaEditar" class="btn btn-success waves-effect waves-light"><i class="ti-upload"></i> Subir archivos</button>
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