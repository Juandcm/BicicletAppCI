<div id="loginform">
    <div class="logo">
        <span class="db"><img src="<?= base_url() ?>/assets/images/icon.png" alt="logo" style="width: 25%;height: 80px;" /></span>
        <h5 class="font-medium m-b-20">Iniciar sesión</h5>
    </div>
    <!-- Form -->
    <div class="row">
        <div class="col-12">
            <form class="form-horizontal m-t-20" id="loginformulario">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                    </div>
                    <input type="email" class="form-control form-control-lg" placeholder="Correo" aria-label="Correo" name="correo" aria-describedby="basic-addon1" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                    </div>
                    <input type="password" class="form-control form-control-lg" placeholder="Contraseña" aria-label="Contraseña" name="contrasena" aria-describedby="basic-addon1" required>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Recordarme</label>
                            <a href="javascript:void(0)" id="to-recover" class="text-dark float-right"><i class="fa fa-lock m-r-5"></i> ¿Olvidaste la contraseña?</a>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    <div class="col-xs-12 p-b-20">
                        <button class="btn btn-block btn-lg btn-info waves-effect waves-light" type="button" id="btnentrar">Entrar</button>
                        <!-- <button class="btn float-button-light waves-effect waves-button waves-float waves-light">Entrar</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>