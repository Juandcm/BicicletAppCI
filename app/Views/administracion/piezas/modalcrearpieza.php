<!-- Create Modal -->
<div class="modal animated bounceInUp" id="modalCrearPieza" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/" method="post" id="formCrearPieza" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel"><i class="ti-marker-alt m-r-10"></i> Crear Pieza</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-info waves-effect waves-light"><i class="ti-user text-white"></i></button>
                                <input type="text" class="form-control" id="namePieza" name="namePieza" placeholder="Nombre" aria-label="name">
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-info waves-effect waves-light"><i class="ti-user text-white"></i></button>
                                <select class="form-control" id="categoriaPieza" name="categoriaPieza" aria-label="categoria" required>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group mb-3">
                                <textarea class="form-control" rows="5" style="height: 223px;" name="descriptionPieza" id="descriptionPieza" placeholder="Descripción..."></textarea>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <div class="dropzone" id="dropzonepieza" style="width: 100%">
                                    <div class="fallback" style="width: 100%">
                                        <input name="file" type="file" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <input type="hidden" id="urlfotoregistropieza" name="urlfotoregistropieza">
                                <button type="button" id="subirfotoPieza" class="btn btn-success waves-effect waves-light"><i class="ti-upload"></i> Subir archivos</button>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Cerrar</button>

                    <button type="submit" class="btn btn-success waves-effect waves-light"><i class="ti-save"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>