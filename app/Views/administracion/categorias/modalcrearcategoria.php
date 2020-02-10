<!-- Create Modal -->
<div class="modal animated bounceInUp" id="modalCrearCategoria" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/" method="post" id="formCrearCategoria" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel"><i class="ti-marker-alt m-r-10"></i> Crear categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-info waves-effect waves-light"><i class="ti-user text-white"></i></button>
                                <input type="text" class="form-control" id="nameCategoria" name="nameCategoria" placeholder="Nombre" aria-label="name">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="dropzone" id="dropzonecategoria" style="width: 100%">
                                    <div class="fallback" style="width: 100%">
                                        <input name="file" type="file" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <input type="hidden" id="urlfotoregistrocategoria" name="urlfotoregistrocategoria">
                                <button type="button" id="subirfotoCategoria" class="btn btn-success waves-effect waves-light"><i class="ti-upload"></i> Subir archivos</button>
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