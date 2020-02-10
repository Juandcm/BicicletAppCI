<?php
$uri = $_SERVER['REQUEST_URI'];
$librerias = '
<script src="' . base_url() . '/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="' . base_url() . '/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="' . base_url() . '/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="' . base_url() . '/dist/js/app.min.js"></script>
<script src="' . base_url() . '/dist/js/app.init.horizontal.js"></script>
<script src="' . base_url() . '/dist/js/waves.js"></script>
<script src="' . base_url() . '/dist/js/custom.min.js"></script>
<script src="' . base_url() . '/assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="' . base_url() . '/dist/js/socketio/socket.io.js"></script>
<script src="' . base_url() . '/assets/libs/dropzone/dist/min/dropzone.min.js"></script>
<script src="' . base_url() . '/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="' . base_url() . '/assets/extra-libs/sparkline/sparkline.js"></script>
<script src="' . base_url() . '/dist/js/sidebarmenu.js"></script>
';

switch ($uri) {
    case '/bicicletappci/public/inicio':
        $librerias .= '';
        break;

    case '/bicicletappci/public/usuarios':
        $librerias .= '
    <!--This page plugins -->
    <script src="' . base_url() . '/assets/extra-libs/DataTables/datatables.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/dataTables.buttons.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/buttons.flash.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/jszip.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/pdfmake.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/vfs_fonts.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/buttons.html5.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/buttons.print.min.js"></script>
    <script src="' . base_url() . '/assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="' . base_url() . '/dist/js/pages/forms/mask/mask.init.js"></script>
    ';
        break;

    case '/bicicletappci/public/categorias':
        $librerias .= '
    <!--This page plugins -->
    <script src="' . base_url() . '/assets/extra-libs/DataTables/datatables.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/dataTables.buttons.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/buttons.flash.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/jszip.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/pdfmake.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/vfs_fonts.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/buttons.html5.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/buttons.print.min.js"></script>
    ';
        break;

    case '/bicicletappci/public/foro':
        $librerias .= '
    <!--This page plugins -->
    <script src="' . base_url() . '/assets/extra-libs/DataTables/datatables.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/dataTables.buttons.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/buttons.flash.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/jszip.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/pdfmake.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/vfs_fonts.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/buttons.html5.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/buttons.print.min.js"></script>
    ';
        break;

    case '/bicicletappci/public/piezas':
        $librerias .= '
    <script src="' . base_url() . '/dist/js/isotope-docs.min.js"></script>
    ';
        break;

    case '/bicicletappci/public/quiz':
        $librerias .= '
    <!--This page plugins -->
    <script src="' . base_url() . '/assets/extra-libs/DataTables/datatables.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/dataTables.buttons.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/buttons.flash.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/jszip.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/pdfmake.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/vfs_fonts.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/buttons.html5.min.js"></script>
    <script src="' . base_url() . '/assets/extra-libs/DataTables/buttons.print.min.js"></script>
    <script src="' . base_url() . '/dist/js/app-style-switcher.horizontal.js"></script>
    <script src="' . base_url() . '/assets/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
    ';
        break;

    default:
        break;
}

$librerias .= '
<script src="' . base_url() . '/interaccion/funciones.js"></script>
<script src="' . base_url() . '/interaccion/interacciondentro.js"></script>
';


?>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<footer class="footer text-center">
    Desarrollador. Juan Colmenares. 2020
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->

<!-- ya -->

<?php
echo view('administracion/general/modalverimagen.php');
echo $librerias;
?>


</body>

</html>