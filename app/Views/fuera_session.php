<?php
echo view('plantillas/fuera_session/header.php');
?>
<div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(<?= base_url() ?>/assets/images/big/auth-bg.jpg) no-repeat center center;">
    <div class="auth-box">
        <?php
        echo view('plantillas/fuera_session/loginform.php');
        echo view('plantillas/fuera_session/recoverform.php');
        echo view('plantillas/fuera_session/verificarcode.php');
        ?>
    </div>
</div>


<?php
echo view('plantillas/fuera_session/footer.php');
?>