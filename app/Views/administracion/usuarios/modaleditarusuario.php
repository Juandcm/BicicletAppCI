<!-- Create Modal -->
<div class="modal animated bounceInDown" id="editarusermodal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/" method="post" id="formEditarUsuario" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="ti-marker-alt m-r-10"></i> Editar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-info waves-effect waves-light"><i class="ti-user text-white"></i></button>
                                <input type="text" class="form-control" id="nameEditar" name="nameEditar" placeholder="Nombre" aria-label="name">
                            </div>
                        </div>


                        <div class="row">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-info waves-effect waves-light"><i class="ti-email text-white"></i></button>
                                <input type="email" class="form-control" id="emailEditar" name="emailEditar" placeholder="Email" aria-label="no">
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-block-helper text-white"></i></button>
                                <input type="password" class="form-control" id="passwordEditar" name="passwordEditar" placeholder="Contraseña" aria-label="no" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-info waves-effect waves-light"><i class="fas fa-phone text-white"></i></button>
                                <input type="text" class="form-control phone-inputmask" id="phoneEditar" name="phoneEditar" placeholder="Telefono" aria-label="no">
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-info waves-effect waves-light"><i class="ti-layout text-white"></i></button>
                                <select class="custom-select form-control required" id="selectRolEditar" name="selectRolEditar" aria-invalid="false">
                                    <option value="0">General</option>
                                    <option value="1">Administrador</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="dropzone" id="my-dropzone-editar" style="width: 100%">
                                    <div class="fallback" style="width: 100%">
                                        <input name="file" type="file" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <input type="hidden" id="urlfotoEditar" name="urlfotoEditar">
                                <input type="hidden" id="iduserEditar" name="iduserEditar">
                                <input type="hidden" id="tipodeaccion" name="tipodeaccion">
                                <button type="button" id="subirfotoUserEditar" class="btn btn-success waves-effect waves-light"><i class="ti-upload"></i> Subir archivos</button>
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