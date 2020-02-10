<div id="verificarform" class="d-none">
    <div class="logo">
        <span class="db"><img src="<?= base_url() ?>/assets/images/icon.png" alt="logo" style="width: 25%;height: 80px;" /></span>
        <h5 class="font-medium m-b-20">Verificar código</h5>
        <span>Ingrese el código que le llegó al correo</span>
    </div>
    <div class="row m-t-20">
        <!-- Form -->
        <form class="col-12" id="verificarformulario" action="#">
            <!-- email -->
            <div class="form-group row">
                <div class="col-12">
                    <input class="form-control form-control-lg" type="hidden" required name="verificarcorreo" id="verificarcorreo">
                    <input class="form-control form-control-lg" type="text" required name="codigoverificacion" id="codigoverificacion" placeholder="Código de verificación">
                </div>
            </div>
            <!-- pwd -->
            <div class="row m-t-20">
                <div class="col-12">
                    <button class="btn btn-block btn-lg btn-danger waves-effect waves-light" type="submit" name="action">Enviar</button>
                </div>
            </div>

            <div class="row m-t-20">
                <div class="col-12">
                    <a href="javascript:void(0)" id="to-inicio" class="text-dark">
                        <div class="btn btn-block btn-lg btn-success waves-effect waves-light">
                            ¿Ya tienes cuenta?
                        </div>
                    </a>
                </div>
            </div>

        </form>
    </div>
</div>