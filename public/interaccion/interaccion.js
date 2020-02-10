// direccionfull = 'http://localhost/bicicletappci/public/';
direccionfull = `${window.location}`

$('[data-toggle="tooltip"]').tooltip();
$(".preloader").fadeOut();
$("#verificarform").slideUp();
// ============================================================== 
// Login and Recover Password 
// ============================================================== 
$('#to-recover').on("click", function () {
  $("#recoverform").fadeIn();
  $("#loginform").slideUp();
  $("#verificarform").slideUp();
});

$('#to-login').on("click", function () {
  $("#loginform").fadeIn();
  $("#recoverform").slideUp();
  $("#verificarform").slideUp();
});

$('#to-inicio').on("click", function () {
  $("#loginform").fadeIn();
  $("#recoverform").slideUp();
  $("#verificarform").slideUp();
  $("#verificarform").addClass('d-none')
});

var swalWithBootstrapButtons = swal.mixin({
  confirmButtonClass: 'btn btn-success',
  cancelButtonClass: 'btn btn-danger',
  buttonsStyling: false
});

// Aqui muestra el swall alert del tipo success
function alertasweet(valorestado, titulo, valormsg) {
  swal({
    type: valorestado,
    title: titulo,
    text: valormsg,
    showConfirmButton: false,
    timer: 3000
  });
}


$('#btnentrar').on('click', function () {
  $.ajax({
    url: `${direccionfull}Usuario/login_admin`,
    type: "POST",
    data: $('#loginformulario').serialize(),
    dataType: "JSON",
    success: function (data) {
      // console.log(data)
      if (data.status) {
        window.location.reload();
      } else {
        alertasweet('error', 'Error', 'Datos incorrectos')
      }
    },
    error: function (error) {
      console.log(error)
    }
  });
})


$("#recuperarForm").on('submit', function (e) {
  e.preventDefault();
  form = $("#recuperarForm").serialize();
  correo = $("#restaurarcorreo").val();
  $.post(`${direccionfull}Usuario/recuperarContrasena`, form, function () { }).done(function (data) {
    datos = JSON.parse(data)
    if (datos.status) {
      $("#verificarform").removeClass('d-none');
      $("#verificarcorreo").val(correo);
      $("#verificarform").fadeIn();
      $("#recoverform").slideUp();
      $("#loginform").slideUp();
    } else {
      alertasweet('error', 'Error', 'El correo no se encuentra en el sistema')
    }

  }).fail(function (e) {
    console.log(e)
  })
})


$("#verificarformulario").on('submit', function (e) {
  e.preventDefault();
  form = $("#verificarformulario").serialize();
  $.post(`${direccionfull}Usuario/restaurarUsuario`, form + '&tipoverificacion=web', function () { }).done(function (data) {
    datos = JSON.parse(data)
    if (datos.status) {
      window.location.reload();
    } else {
      alertasweet('error', 'Error', 'No se pudo recuperar la contraseña')
    }

  }).fail(function (e) {
    console.log(e)
  })
})