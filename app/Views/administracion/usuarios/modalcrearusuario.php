<!-- Create Modal -->
<div class="modal animated bounceInUp" id="createmodel" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/" method="post" id="formCrearUsuario" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel"><i class="ti-marker-alt m-r-10"></i> Crear usuario nuevo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-info waves-effect waves-light"><i class="ti-user text-white"></i></button>
                                <input type="text" class="form-control" id="nameRegistro" name="nameRegistro" placeholder="Nombre" aria-label="name">
                            </div>
                        </div>



                        <div class="row">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-info waves-effect waves-light"><i class="ti-email text-white"></i></button>
                                <input type="email" class="form-control" id="emailRegistro" name="emailRegistro" placeholder="Email" aria-label="no">
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-block-helper text-white"></i></button>
                                <input type="password" class="form-control" id="passwordRegistro" name="passwordRegistro" placeholder="Contraseña" aria-label="no">
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-info waves-effect waves-light"><i class="fas fa-phone text-white"></i></button>
                                <input type="text" class="form-control phone-inputmask" id="phoneRegistro" name="phoneRegistro" placeholder="Telefono" aria-label="no">
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-info waves-effect waves-light"><i class="ti-layout text-white"></i></button>
                                <select class="custom-select form-control required" id="selectRolRegistro" name="selectRolRegistro" aria-invalid="false">
                                    <option value="0">General</option>
                                    <option value="1">Administrador</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="dropzone" id="my-dropzone" style="width: 100%">
                                    <div class="fallback" style="width: 100%">
                                        <input name="file" type="file" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <input type="hidden" id="urlfotoregistro" name="urlfotoregistro">
                                <button type="button" id="subirfotoUser" class="btn btn-success waves-effect waves-light"><i class="ti-upload"></i> Subir archivos</button>
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