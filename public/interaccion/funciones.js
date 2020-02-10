$(document).ready(function () {
  $(".is-checked").click();
});

$(document).on('keypress', "#textarea1", function (e) {
  if (e.keyCode == 13) {
    var id = $(this).attr("data-user-id");
    var msg = $(this).val();
    msg = msg_sent(msg);
    $("#someDiv").append(msg);
    $(this).val("");
    $(this).focus();
  }
});

$('body').tooltip({ selector: '[data-toggle="tooltip"]' });

if ($('.image-popup-vertical-fit').length > 0) {
  $('.image-popup-vertical-fit').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    mainClass: 'mfp-img-mobile',
    image: {
      verticalFit: true
    }
  });
}


$("#createmodel").on('hidden.bs.modal', function () {
  $("#formCrearUsuario")[0].reset()
  if ($("#dz-remove").length > 0) {
    $("#dz-remove")[0].click()
    $("#urlfotoregistro").val('')
  }
});

$("#editarusermodal").on('hidden.bs.modal', function () {
  $("#formEditarUsuario")[0].reset()
  if ($("#dz-remove").length > 0) {
    $("#dz-remove")[0].click()
    $("#urlfotoEditar").val('')
  }
});

$("#modalCrearCategoria").on('hidden.bs.modal', function () {
  $("#formCrearCategoria")[0].reset()
  if ($("#dz-remove").length > 0) {
    $("#dz-remove")[0].click()
    $("#urlfotoregistrocategoria").val('')
  }
});

$("#modalEditarCategoria").on('hidden.bs.modal', function () {
  $("#formEditarCategoria")[0].reset()
  if ($("#dz-remove").length > 0) {
    $("#dz-remove")[0].click()
    $("#urlfotoregistrocategoriaeditar").val('')
  }
});

$("#modalCrearPieza").on('hidden.bs.modal', function () {
  $("#formCrearPieza")[0].reset()
  if ($("#dz-remove").length > 0) {
    $("#dz-remove")[0].click()
    $("#urlfotoregistropieza").val('')
  }
});

$("#modalCrearForo").on('hidden.bs.modal', function () {
  $("#formCrearForo")[0].reset()
  if ($("#dz-remove").length > 0) {
    $("#dz-remove")[0].click()
    $("#urlfotoregistroforo").val('')
  }
});

$("#modalEditarForo").on('hidden.bs.modal', function () {
  $("#formEditarForo")[0].reset()
  if ($("#dz-remove").length > 0) {
    $("#dz-remove")[0].click()
    $("#urlfotoeditarforo").val('')
  }
});


$("#modalCrearPregunta").on('hidden.bs.modal', function () {
  $("#formCrearPregunta")[0].reset()
  if ($("#dz-remove").length > 0) {
    $("#dz-remove")[0].click()
    $("#urlfotoregistropregunta").val('')
  }
});

$("#modalEditarPieza").on('hidden.bs.modal', function () {
  $("#formEditarPieza")[0].reset()
  if ($("#dz-remove").length > 0) {
    $("#dz-remove")[0].click()
    $("#urlfotoeditarpieza").val('')
    $("#idImagenesEliminadas").val('')
  }
});

$("#modalEditarQuiz").on('hidden.bs.modal', function () {
  $("#formEditarQuiz")[0].reset()
});


$("#modalCrearNivel").on('hidden.bs.modal', function () {
  $("#formCrearNivel")[0].reset()
});

$("#modalEditarNivel").on('hidden.bs.modal', function () {
  $("#formEditarNivel")[0].reset()
});

if ($("#segundoCard").length > 0) {
  $("#segundoCard").hide();
}

$("#regresarCardPiezas").on('click', function (e) {
  e.preventDefault()
  $('#segundoCard').slideUp(1000);
  $('#primerCard').slideDown(1000);
})

swalWithBootstrapButtons = swal.mixin({
  confirmButtonClass: 'btn btn-success',
  cancelButtonClass: 'btn btn-danger',
  buttonsStyling: false
});

lenguaje = {
  'sProcessing': 'Procesando...',
  'sLengthMenu': 'Mostrar _MENU_ registros',
  'sZeroRecords': 'No se encontraron resultados',
  'sEmptyTable': 'Ningún dato disponible en esta tabla',
  'sInfo': 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_',
  'sInfoEmpty': 'Mostrando registros del 0 al 0 de un total de 0 registros',
  'sInfoFiltered': '(filtrado de un total de _MAX_ registros)',
  'sInfoPostFix': '',
  'sSearch': 'Buscar:',
  'sUrl': '',
  'sInfoThousands': ',',
  'sLoadingRecords': 'Cargando...',
  'oPaginate': {
    'sFirst': 'Primero',
    'sLast': 'Último',
    'sNext': 'Siguiente',
    'sPrevious': 'Anterior'
  },
  'oAria': {
    'sSortAscending': ': Activar para ordenar la columna de manera ascendente',
    'sSortDescending': ': Activar para ordenar la columna de manera descendente'
  }
}

Dropzone.autoDiscover = false;
Dropzone.prototype.defaultOptions.dictDefaultMessage = "<div class='drag-icon-cph'><i class='material-icons'>Tocar o Arrastrar</i></div><h5>Para agregar archivo</h5>";
Dropzone.prototype.defaultOptions.dictRemoveFile = "Eliminar archivo";
Dropzone.prototype.defaultOptions.dictFallbackText = "Utilice el siguiente formulario de respaldo para cargar sus archivos como en los viejos tiempos";
Dropzone.prototype.defaultOptions.dictFileTooBig = "El archivo es demasiado grande ({{filesize}}MiB). Tamaño máximo de archivo: {{maxFilesize}}MiB";
Dropzone.prototype.defaultOptions.dictInvalidFileType = "No puede cargar archivos de este tipo";
Dropzone.prototype.defaultOptions.dictResponseError = "El servidor respondió con el código {{statusCode}}";
Dropzone.prototype.defaultOptions.dictCancelUpload = "Cancelar carga";
Dropzone.prototype.defaultOptions.dictUploadCanceled = "Carga cancelada";
Dropzone.prototype.defaultOptions.dictCancelUploadConfirmation = "¿Está seguro de que desea cancelar esta carga?";
Dropzone.prototype.defaultOptions.dictMaxFilesExceeded = "No puede cargar más archivos";

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

function myDropzone(idropzone, urlbackend, btnsubir, urlregistro, multipleFile) {
  opciones = null
  if (multipleFile) {
    opciones = {
      url: `${direccionfull}${urlbackend}`,
      files: this,
      method: "post",
      addRemoveLinks: true,
      autoProcessQueue: false,
      uploadMultiple: true,
      maxFilesize: 2, // MB
      parallelUploads: 10,
      acceptedFiles: "image/*",
      init: function (data) {
        $(btnsubir).on('click', function (e) {
          e.preventDefault();
          e.stopPropagation();
          myDropzone.processQueue();
        });
        this.on("success", function (file, xhr) {
          // console.log(file.xhr.response);
          valoranterior = $(urlregistro).val()
          $(urlregistro).val(valoranterior + file.xhr.response)
        });
      }
    }
  } else {
    opciones = {
      url: `${direccionfull}${urlbackend}`,
      files: this,
      method: "post",
      addRemoveLinks: true,
      autoProcessQueue: false,
      uploadMultiple: false,
      maxFiles: 1,
      maxFilesize: 2, // MB
      acceptedFiles: "image/*",
      init: function (data) {
        $(btnsubir).on('click', function (e) {
          e.preventDefault();
          e.stopPropagation();
          myDropzone.processQueue();
        });
        this.on("success", function (file, xhr) {
          // console.log(file.xhr.response);
          $(urlregistro).val(file.xhr.response)
        });
        // this.on("removedfile",function(file){
        //   console.log('removedfile')
        //   console.log(file);
        //   });
      }
    }
  }
  var myDropzone = new Dropzone(idropzone, opciones);
}

function recargarPagina(direccion) {
  if (direccion.length > 0) {
    setTimeout(function () {
      window.location.replace(direccion);
    }, 1000);
  } else {
    setTimeout(function () {
      window.location.reload(true);
    }, 1000);
  }
}

function salir() {
  $.ajax({
    url: `${direccionfull}Usuario/logout`,
    type: "GET",
    success: function (data) {
      recargarPagina(direccionfull)
    },
    error: function (error) {
      console.log(error)
    }
  });
}

$("#formBuscador").on('submit', function (e) {
  e.preventDefault()
  inputBuscador = $("#inputBuscador").val()
  recargarPagina(`${direccionfull}buscador/${inputBuscador}`)
})


function verImagenDetallada(url) {
  // console.log(url)
  $("#modalVerImagen").modal('show')
  $("#verImagenForoUrl").attr('src', url)
}