<div id="recoverform">
    <div class="logo">
        <span class="db"><img src="<?= base_url() ?>/assets/images/icon.png" alt="logo" style="width: 25%;height: 80px;" /></span>
        <h5 class="font-medium m-b-20">Recuperar contraseña</h5>
        <span>Ingrese su correo para restaurar la contraseña</span>
    </div>
    <div class="row m-t-20">
        <!-- Form -->
        <form class="col-12" id="recuperarForm" action="#">
            <!-- email -->
            <div class="form-group row">
                <div class="col-12">
                    <input class="form-control form-control-lg" type="email" required name="restaurarcorreo" id="restaurarcorreo" placeholder="Correo">
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
                    <a href="javascript:void(0)" id="to-login" class="text-dark">
                        <div class="btn btn-block btn-lg btn-success waves-effect waves-light">
                            ¿Ya tienes cuenta?
                        </div>
                    </a>
                </div>
            </div>

        </form>
    </div>
</div>