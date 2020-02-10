<?php
echo view('plantillas/dentro_session/header.php');
echo view('administracion/foro/modalcrearforo.php');
echo view('administracion/foro/modaleditarforo.php');
?>
<div class="row">
    <div class="col-12">
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Left Part  -->
            <!-- ============================================================== -->
            <div class="left-part bg-white fixed-left-part p-t-30 m-b-30">
                <!-- Mobile toggle button -->
                <a class="ti-menu ti-close btn btn-success show-left-part d-block d-md-none" href="javascript:void(0)"></a>
                <!-- Mobile toggle button -->
                <div class="p-t-30 m-t-30 text-center" style="margin-top: 90px;">
                    <h4>Lista de Foros</h4>
                    <a href="#" data-toggle="modal" data-target="#modalCrearForo">
                        <div class="card card-hover" style="background:#e1dddd !important">
                            <div class="card-header bg-success waves-effect waves-light">
                                <h4 class="m-b-0 text-white text-center">Crear foro</h4>
                            </div>
                        </div>
                    </a>
                </div>
                <hr>
                <div class="scrollable position-relative m-t-30" style="height:calc(100vh - 100px);">
                    <ul class="mailbox list-style-none">
                        <li>
                            <div class="message-center chat-scroll">
                                <!--  -->
                                <div class="card">
                                    <div class="comment-widgets" id="listadeForos" style="padding-bottom: 200px;">
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Left Part  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right Part  Mail Compose -->
            <!-- ============================================================== -->
            <div class="right-part" style="margin-top: -100px;" id="mensajeriaForolleno">
                <div class="p-20">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-subtitle p-0 m-0">Mensajes del Foro:</h6>
                            <h4 class="card-title"><span id="tituloforomostrar">asdf</span>
                                <span class="float-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-dark dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-hidden="true">
                                            <i class="ti-settings"></i>
                                        </button>
                                        <div class="dropdown-menu animated slideInUp" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -2px, 0px);" id="menuConfigForo">

                                        </div>
                                    </div>
                                </span>
                            </h4>
                            <hr>
                            <div class="chat-box scrollable" id="chatPrincipal" style="height:calc(100vh - 100px);">
                                <!--chat Row -->
                                <!-- <input type="hidden" name="valoridforo" id="valoridforo"> -->
                                <ul class="chat-list" id="chatlisto">
                                </ul>

                                <ul class="chat-list" id="chatnolisto">
                                    <li class="chat-item">
                                        <div class="chat-content text-center">
                                            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>

                            </div>
                        </div>
                        <div class="card-body border-top" id="ocultarformenviar">
                            <form action="/" method="post" id="formEnviarMensajeForo" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-11">
                                        <div class="input-field m-t-0 m-b-0">
                                            <input type="hidden" name="idforoenviarmensaje" id="idforoenviarmensaje">
                                            <input placeholder="Escribe..." class="form-control border-0" type="text" name="mensajeforoenviar" id="mensajeforoenviar" value="">
                                        </div>
                                    </div>
                                    <div class="col-1">

                                        <a class="btn-circle btn-cyan float-right text-white text-center waves-effect waves-light" href="javascript:void(0)"><i class="fas icon-paper-clip"></i><input name="filemensajeforo" id="filemensajeforo" type="file" accept="image/png, .jpeg, .jpg" style="position: absolute; top: 0; right: 0; min-width: 100%; min-height: 100%; font-size: 100px; text-align: right; opacity: 0; filter: alpha(opacity=0); outline: none; background: white; cursor: inherit; display: block;"></a>
                                        <!-- id="buttonenviarmensaje" -->

                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="right-part" style="margin-top: -100px;" id="mensajeriaForoVacio">
                <div class="card card-hover" style="background:#e1dddd !important">
                    <div class="card-body" style="background-color: #E3E3E3 !important;">
                        <div class="flex-column">
                            <div class="text-center display-7">
                                Selecciona un foro de la lista para participar
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->

        </div>
    </div>
</div>

<?php
echo view('plantillas/dentro_session/footer.php');
?>