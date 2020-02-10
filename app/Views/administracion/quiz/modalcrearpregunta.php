<!-- Create Modal -->
<div class="modal animated bounceInUp" id="modalCrearPregunta" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/" method="post" id="formCrearPregunta" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel"><i class="ti-marker-alt m-r-10"></i> Crear Pregunta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="namePregunta" name="namePregunta" placeholder="Nombre" aria-label="name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group mb-3">
                                <select id="selectnivel" name="selectnivel" class="form-control" required>
                                </select>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <div class="dropzone" id="dropzonepregunta" style="width: 100%">
                                    <div class="fallback" style="width: 100%">
                                        <input name="file" type="file" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <input type="hidden" id="urlfotoregistropregunta" name="urlfotoregistropregunta">
                                <button type="button" id="subirfotoPregunta" class="btn btn-success waves-effect waves-light"><i class="ti-upload"></i> Subir archivo</button>
                            </div>
                        </div>

                        <div class="card-body">
                            <h4 class="card-title m-b-40 text-center">Respuestas</h4>
                            <input type="hidden" name="tipodetab" id="tipodetab" value="1">
                            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                                <li class="nav-item text-center">
                                    <a class="nav-link show active text-center" id="home-tab" data-toggle="tab" href="#home5" role="tab" aria-controls="home5" aria-expanded="true" aria-selected="true">
                                        <span class="hidden-xs-down">Verdadero o Falso</span>
                                    </a>
                                </li>
                                <li class="nav-item text-center">
                                    <a class="nav-link show text-center" id="profile-tab" data-toggle="tab" href="#profile5" role="tab" aria-controls="profile" aria-selected="false">
                                        <span class="hidden-xs-down">Opción Multiple</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content tabcontent-border p-20" id="myTabContent">
                                <div role="tabpanel" class="tab-pane fade in active show" id="home5" aria-labelledby="home-tab">
                                    <div class="bt-switch">
                                        <div class="container-fluid">
                                            <div class="row justify-content-center align-content-center">
                                                <div class="row m-b-15">
                                                    <div class="col-sm-12">
                                                        <div class="form-group" name="btncheckbox">
                                                            <input type="checkbox" id="tipovalorcheck" name="tipovalorcheck" class="checkbox-switch" data-on-color="success" data-off-color="danger" data-on-text="Verdadero" data-off-text="Falso" checked value="1">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /////////////////////////////// -->
                                <div class="tab-pane fade" id="profile5" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="bt-switch">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="row m-b-15">
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="respuesta1" id="respuesta1" placeholder="Respuesta 1" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group" name="btnradio">
                                                            <input type="radio" name="respuestaradio" class="radio-switch" data-on-color="success" data-off-color="danger" data-on-text="Correcta" data-off-text="Incorrecta" checked value="1">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="row m-b-15">
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="respuesta2" id="respuesta2" placeholder="Respuesta 2" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group" name="btnradio">
                                                            <input type="radio" name="respuestaradio" class="radio-switch" data-on-color="success" data-off-color="danger" data-on-text="Correcta" data-off-text="Incorrecta" value="2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="row m-b-15">
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="respuesta3" id="respuesta3" placeholder="Respuesta 3" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group" name="btnradio">
                                                            <input type="radio" name="respuestaradio" class="radio-switch" data-on-color="success" data-off-color="danger" data-on-text="Correcta" data-off-text="Incorrecta" value="3">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="row m-b-15">
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="respuesta4" id="respuesta4" placeholder="Respuesta 4" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group" name="btnradio">
                                                            <input type="radio" name="respuestaradio" class="radio-switch" data-on-color="success" data-off-color="danger" data-on-text="Correcta" data-off-text="Incorrecta" value="4">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Cerrar</button>
                    <button type="submit" id="btnCrearPregunta" class="btn btn-success waves-effect waves-light"><i class="ti-save"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>