<div id="registerform">
    <div class="logo">
        <span class="db"><img src="<?= base_url() ?>/assets/images/icon.png" alt="logo" style="width: 25%;height: 80px;" /></span>
        <h5 class="font-medium m-b-20">Registro</h5>
    </div>
    <!-- Form -->
    <div class="row">
        <div class="col-12">
            <form class="form-horizontal m-t-20" id="registerform">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                    </div>
                    <input type="text" class="form-control form-control-lg" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                    </div>
                    <input type="text" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="custom-control custom-checkbox">
                            <a href="javascript:void(0)" id="to-recover" class="text-dark float-right"><i class="fa fa-lock m-r-5"></i> ¿Olvidaste la contraseña?</a>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    <div class="col-xs-12 p-b-20">
                        <button class="btn btn-block btn-lg btn-info" type="submit">Registrarme</button>
                    </div>
                </div>
                <div class="form-group m-b-0 m-t-10">
                    <div class="col-sm-12 text-center">
                        ¿Ya tienes una cuenta? <a href="javascript:void(0)" id="to-login" class="text-info m-l-5"><b>Entrar!</b></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>