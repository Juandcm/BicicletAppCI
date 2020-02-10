backendurlngrok = ''
backendurlsinngrok = 'http://localhost/bicicletappci/public/'
nodeurlngrok = ''
nodeurlsinngrok = 'http://localhost:3000'

if (backendurlngrok != '') {
  direccionfull = backendurlngrok
} else {
  direccionfull = backendurlsinngrok
}

if (nodeurlngrok != '') {
  socket = io.connect(nodeurlngrok);
} else {
  socket = io.connect(nodeurlsinngrok);
}

$.getScript(`${direccionfull}interaccion/funciones.js`, function () { });

var radioswitch = function () {
  var bt = function () {
    $(".radio-switch").on("switch-change", function () {
      $(".radio-switch").bootstrapSwitch("toggleRadioState")
    }), $(".radio-switch").on("switch-change", function () {
      $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
    }), $(".radio-switch").on("switch-change", function () {
      $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
    })
  };
  return {
    init: function () {
      bt()
    }
  }
}();


$('.nav-tabs a').on('shown.bs.tab', function (event) {
  var x = $(event.target).text().trim();         // active tab
  var y = $(event.relatedTarget).text().trim();  // previous tab
  if (x == 'Verdadero o Falso') {
    $("#tipodetab").val('1')
  } else {
    $("#tipodetab").val('2')
  }
});

$(document).ready(function () {
  if ($(".bt-switch input[type='checkbox']").length > 0) {
    $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
    radioswitch.init()
  }
});

socket.on('connect', function (data) {
  console.log('conectado al socket')
  // console.log(data)
});
socket.on('connect_error', function () {
  console.log('error al conectar al socket')
});

socket.on('disconnect', function () {
  console.log('conexion desconectada');
});

socket.on('reconnect', () => {
  console.log('reconectando el socket');
});

socket.on('actualizar_foro', function (data) {
  console.log('recibiendo datos del socket: actualizar_foro')
  mostrarTodosForos()
});

socket.on('actualizar_categorias', function (data) {
  console.log('recibiendo datos del socket: actualizar_categorias')
  // mostrarTodosForos()
});

socket.on('actualizar_piezas', function (data) {
  console.log('recibiendo datos del socket: actualizar_piezas')
  if (data.status) {
    mostrarTodasPiezas(true);
  } else {
    mostrarTodasPiezas();
  }
});

socket.on('chat_message_text', function (data) {
  idforovalor = $("#idforoenviarmensaje").val()
  valoriduser = $("#idusuarioweb").val()
  if (idforovalor == data.idforo) {
    console.log('recibiendo datos del socket: chat_message_text')
    // console.log(data)
    if (valoriduser == data.user.user_id) {
      html = `<li class="odd chat-item" id="mensaje-${data.mensajeforoid}">
      <div class="chat-content">
      <div class="box bg-light-inverse">${data.mensaje}</div>
      </div>
      <div class="chat-time">${data.fecha}</div>
      </li>`
    } else {
      if (data.user.user_photo != "") {
        fotoUsuarioweb = `<div class="chat-img"><img src="${direccionfull}${data.user.user_photo}" alt="user"></div>`
      } else {
        fotoUsuarioweb = `<div class="chat-img bg-success text-center" style="border-radius: 50%;width: 30px;height: 20px;">
        ${data.user.user_name.substr(0, 2)}
        </div>`
      }
      html = `<li class="chat-item" id="mensaje-${data.mensajeforoid}">
      ${fotoUsuarioweb}
      <div class="chat-content">
      <h6 class="font-medium">${data.user.user_name}</h6>
      <div class="box bg-light-info">${data.mensaje}</div>
      </div>
      <div class="chat-time">${data.fecha}</div>
      </li>`
    }
    
    $(`.foro-${data.idforo}`).addClass('d-none')
    $(`.forochat-${data.idforo}`).removeClass('d-none')
    $(`.forochat-${data.idforo}`).append(html);
    $('#chatPrincipal').stop().animate({
      scrollTop: $(`#chatPrincipal`)[0].scrollHeight
    }, 1000);
  }
  
  
});

socket.on('chat_message_file', function (data) {
  console.log('recibiendo datos del socket: chat_message_file')
  // console.log(data)
  valoriduser = $("#idusuarioweb").val()
  idforovalor = $("#idforoenviarmensaje").val()
  
  if (idforovalor == data.idforo) {
    if (data.user.user_photo != "") {
      fotoUsuarioweb = `<div class="chat-img"><img src="${direccionfull}${data.user.user_photo}" alt="user"></div>`
    } else {
      fotoUsuarioweb = `<div class="chat-img bg-success text-center" style="border-radius: 50%;width: 30px;height: 20px;">
      ${data.user.user_name.substr(0, 2)}
      </div>`
    }
    
    if (valoriduser == data.user.user_id) {
      html = `<li class="odd chat-item" id="mensaje-${data.mensajeforoid}">
      <div class="chat-content">
      <div class="box bg-light-info">
      <a href="javascript:void(0)" onclick="verImagenDetallada('${direccionfull}${data.archivomensaje}')">
      <img src="${direccionfull}${data.archivomensaje}" class="img-fluid rounded" style="width: 190px;height: 220px;">
      </a>
      </div>
      <div class="chat-time">${data.fecha}</div>
      </div>
      </li>`
    } else {
      html = `<li class="chat-item" id="mensaje-${data.mensajeforoid}">
      ${fotoUsuarioweb}
      <div class="chat-content">
      <h6 class="font-medium">${data.user.user_name}</h6>
      
      <a href="javascript:void(0)" onclick="verImagenDetallada('${direccionfull}${data.archivomensaje}')">
      <img src="${direccionfull}${data.archivomensaje}" class="img-fluid rounded" style="width: 190px;height: 220px;">
      </a> 
      
      </div>
      <div class="chat-time">${data.fecha}</div>
      </li>`
      
    }
    
    $(`.foro-${data.idforo}`).addClass('d-none')
    $(`.forochat-${data.idforo}`).removeClass('d-none')
    $(`.forochat-${data.idforo}`).append(html);
    
    $('#chatPrincipal').stop().animate({
      scrollTop: $(`#chatPrincipal`)[0].scrollHeight
    }, 1000);
    
  }
});

if ($("#my-dropzone").length > 0) {
  myDropzone("#my-dropzone", "Usuario/uploadImage", "#subirfotoUser", "#urlfotoregistro", false)
}

if ($("#my-dropzone-editar").length > 0) {
  myDropzone("#my-dropzone-editar", "Usuario/uploadImage", "#subirfotoUserEditar", "#urlfotoEditar", false)
}

if ($("#dropzonecategoria").length > 0) {
  myDropzone("#dropzonecategoria", "Categoria/uploadImage", "#subirfotoCategoria", "#urlfotoregistrocategoria", false)
}

if ($("#dropzonecategoriaeditar").length > 0) {
  myDropzone("#dropzonecategoriaeditar", "Categoria/uploadImage", "#subirfotoCategoriaEditar", "#urlfotoregistrocategoriaeditar", false)
}

if ($("#dropzonepieza").length > 0) {
  myDropzone("#dropzonepieza", "Pieza/uploadMultipleImage", "#subirfotoPieza", "#urlfotoregistropieza", true)
}


if ($("#dropzoneforo").length > 0) {
  myDropzone("#dropzoneforo", "Foro/uploadImage", "#subirfotoForo", "#urlfotoregistroforo", false)
}

if ($("#dropzoneforoeditar").length > 0) {
  myDropzone("#dropzoneforoeditar", "Foro/uploadImage", "#subirfotoForoEditar", "#urlfotoeditarforo", false)
}

if ($("#dropzonepregunta").length > 0) {
  myDropzone("#dropzonepregunta", "Quiz/uploadImage", "#subirfotoPregunta", "#urlfotoregistropregunta", false)
}


if ($("#dropzonepiezaeditar").length > 0) {
  myDropzone("#dropzonepiezaeditar", "Pieza/uploadMultipleImage", "#subirfotoPiezaEditar", "#urlfotoeditarpieza", true)
}



if ($("#mensajeriaForolleno").length > 0) {
  socket.emit('action', { type: 'actualizar_foro' });
  $("#mensajeriaForolleno").hide();
}

// var idtable = null;
//Datatables:
function datatableSistema(idtable, urlbackend, otro) {
  if (otro) {
    tablaDataNew = $(`#${idtable}`).DataTable({
      'ajax': `${direccionfull}${urlbackend}`,
      'language': lenguaje,
      'responsive': true,
      dom: 'Bfrtip',
      buttons: [
        'csv', 'excel', 'pdf'
      ],
      'orders': []
    });
  } else {
    tablaData = $(`#${idtable}`).DataTable({
      'ajax': `${direccionfull}${urlbackend}`,
      'language': lenguaje,
      'responsive': true,
      dom: 'Bfrtip',
      buttons: [
        'csv', 'excel', 'pdf'
      ],
      'orders': []
    });
  }
}

//Datatables:
if ($("#usersDatatable").length > 0) {
  datatableSistema("usersDatatable", "Usuario/mostrarTodosUsuario", false)
}
if ($("#categoriasDatatable").length > 0) {
  datatableSistema("categoriasDatatable", "Categoria/mostrarTodasCategorias", false)
}

if ($("#preguntaDatatable").length > 0) {
  datatableSistema("preguntaDatatable", "Quiz/mostrarTodasPreguntas", false)
}

if ($("#nivelDatatable").length > 0) {
  datatableSistema("nivelDatatable", "Quiz/mostrarTodosNiveles", true)
}
$('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1 waves-effect waves-light');

// formCrearForo nameForo dropzoneforo urlfotoregistroforo subirfotoForo
$("#formCrearForo").on('submit', function (e) {
  e.preventDefault();
  form = $("#formCrearForo").serialize()
  $.post(`${direccionfull}Foro/registrarForo`, form, function () { }).done(function (data) {
    datos = JSON.parse(data)
    if (datos.status) {
      socket.emit('action', { type: 'actualizar_foro' });
      socket.emit('action', { type: 'agregar_foro', data: datos.data });
      alertasweet('success', 'Exito', 'Se guardo el foro')
      $("#modalCrearForo").modal('hide')
    } else {
      alertasweet('error', 'Error', 'No se guardo el foro')
    }
  }).fail(function (e) {
    alertasweet('error', 'Error', 'No se guardo el foro')
    console.log(e)
  })
})

$("#formEditarForo").on('submit', function (e) {
  e.preventDefault();
  form = $("#formEditarForo").serialize()
  $.post(`${direccionfull}Foro/editarForo`, form, function () { }).done(function (data) {
    datos = JSON.parse(data)
    if (datos.status) {
      socket.emit('action', { type: 'actualizar_foro' });
      socket.emit('action', { type: 'editar_foro', data: datos.data });
      $("#tituloforomostrar").text(datos.data.nameforo)
      alertasweet('success', 'Exito', 'Se edito el foro')
      $("#modalEditarForo").modal('hide')
    } else {
      if (datos.dataerror != '') {
        alertasweet('error', 'Error', datos.dataerror)
      } else {
        alertasweet('error', 'Error', 'No se edito el foro')
      }
    }
  }).fail(function (e) {
    alertasweet('error', 'Error', 'No se edito el foro')
    console.log(e)
  })
})

$("#formCrearUsuario").on('submit', function (e) {
  e.preventDefault();
  form = $("#formCrearUsuario").serialize()
  $.post(`${direccionfull}Usuario/registrarUsuario`, form, function () { }).done(function (e) {
    tablaData.ajax.reload(null, false);
    alertasweet('success', 'Exito', 'Se guardo el usuario')
    $("#createmodel").modal('hide')
  }).fail(function (e) {
    alertasweet('error', 'Error', 'No se guardo el usuario')
    console.log(e)
  })
})

$("#formEditarUsuario").on('submit', function (e) {
  e.preventDefault();
  form = $("#formEditarUsuario").serialize()
  
  swalWithBootstrapButtons({
    title: '¿Quieres editar el usuario?',
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si, deseo hacerlo',
    cancelButtonText: 'No',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      
      $.post(`${direccionfull}Usuario/editarUsuario`, form, function () { }).done(function (e) {
        if ($("#tipodeaccion").val() == 1) {
          recargarPagina('')
        } else {
          tablaData.ajax.reload(null, false);
        }
        alertasweet('success', 'Exito', 'Se edito correctamente el usuario')
        $("#editarusermodal").modal('hide')
      }).fail(function (e) {
        alertasweet('error', 'Error', 'No se edito el usuario')
        console.log(e)
      })
      
    } else if (result.dismiss === swal.DismissReason.cancel) {
      alertasweet('error', 'Error', 'No se edito el usuario')
      $("#editarusermodal").modal('hide')
    }
  });
})


$("#formCrearCategoria").on('submit', function (e) {
  e.preventDefault();
  form = $("#formCrearCategoria").serialize()
  $.post(`${direccionfull}Categoria/registrarCategoria`, form, function () { }).done(function (e) {
    tablaData.ajax.reload(null, false);
    alertasweet('success', 'Exito', 'Se guardo la categoria')
    $("#modalCrearCategoria").modal('hide')
  }).fail(function (e) {
    alertasweet('error', 'Error', 'No se guardo la categoria')
    console.log(e)
  })
})

$("#formEditarCategoria").on('submit', function (e) {
  e.preventDefault();
  form = $("#formEditarCategoria").serialize()
  $.post(`${direccionfull}Categoria/editarCategoria`, form, function () { }).done(function (e) {
    tablaData.ajax.reload(null, false);
    alertasweet('success', 'Exito', 'Se edito la categoria')
    $("#modalEditarCategoria").modal('hide')
  }).fail(function (e) {
    alertasweet('error', 'Error', 'No se edito la categoria')
    console.log(e)
  })
})


function mostrarTodasCategoriaSelect(idlugar, idcategoria) {
  $.post(`${direccionfull}Categoria/selectCategoria`, {}, function () { }).done(function (e) {
    $(`${idlugar}`).html(e)
    if (idcategoria != '') {
      $(`${idlugar} option[value="${idcategoria}"]`).attr("selected", true);
    }
  }).fail(function (e) {
    console.log(e)
  })
}

if ($("#categoriaPieza").length > 0) {
  mostrarTodasCategoriaSelect("#categoriaPieza", '')
}



$("#formCrearPieza").on('submit', function (e) {
  e.preventDefault();
  form = $("#formCrearPieza").serialize()
  namecategoria = $('select[name="categoriaPieza"] option:selected').text()
  
  $.post(`${direccionfull}Pieza/registrarPieza`, form + '&categoriaName=' + namecategoria, function () { }).done(function (data) {
    datos = JSON.parse(data)
    if (datos.status) {
      socket.emit('action', { type: 'actualizar_piezas', status: true });
      $("#modalCrearPieza").modal('hide')
      alertasweet('success', 'Exito', 'Se creo la pieza correctamente')
    } else {
      alertasweet('error', 'Error', 'No se creo la pieza')
    }
  }).fail(function (e) {
    console.log(e)
  })
})

// init Isotope
if ($('.grid').length > 0) {
  var $grid = $('.grid').isotope({
    itemSelector: '.element-item',
    layoutMode: 'fitRows',
    percentagePosition: true,
    animationEngine: 'best-available',
    animationOptions: {
      duration: 800,
      easing: 'linear',
      queue: false
    },
    filter: '*',
    masonry: {
      columnWidth: '.element-item',
      gutter: 30,
    }
  });
  
  var $filterCount = $('.filter-count');
  var iso = $grid.data('isotope');
  // bind filter button click
  $('.filters-button-group').on('click', 'button', function () {
    var filterValue = $(this).attr('data-filter');
    // use filterFn if matches value
    filterValue = filterFns[filterValue] || filterValue;
    // console.log(filterValue)
    $grid.isotope({ filter: filterValue });
    updateFilterCount();
  });
  
  // filter functions
  var filterFns = {
    // show if number is greater than 50
    numberGreaterThan50: function () {
      var number = $(this).find('.number').text();
      return parseInt(number, 10) > 50;
    },
    // show if name ends with -ium
    ium: function () {
      var name = $(this).find('.name').text();
      // console.log('name',name)
      return name.match(/ium$/);
    }
  };
  
  
  // change is-checked class on buttons
  $('.button-group').each(function (i, buttonGroup) {
    var $buttonGroup = $(buttonGroup);
    $buttonGroup.on('click', 'button', function () {
      $buttonGroup.find('.is-checked').removeClass('is-checked');
      $(this).addClass('is-checked');
    });
  });
  
  $("#buscarCategoria").on('submit', function (e) {
    e.preventDefault()
    qsRegex = $('.quicksearch').val()
    
    if (qsRegex == '') {
      $grid.isotope({ filter: '*' });
    } else {
      palabra = qsRegex.charAt(0).toUpperCase() + qsRegex.slice(1);
      $grid.isotope({
        filter: function () {
          return palabra ? $(this).text().match(palabra) : true;
        }
      });
    }
    updateFilterCount();
  })
}

if ($("#botonesCategorias").length > 0) {
  mostrarTodasPiezas()
}

function mostrarTodasPiezas(estado) {
  $("#botonesCategorias").html('');
  $.post(`${direccionfull}Pieza/mostrarTodasPiezas`, {}, function () { }).done(function (e) {
    data = JSON.parse(e)
    if (estado) {
      $('#contenidototalPiezas').html('');
    }
    $("#botonesCategorias").html(data.categorias)
    var $newItems = data.datos;
    $('#contenidototalPiezas').prepend($newItems).isotope('reloadItems').isotope({ sortBy: 'original-order' });
    setTimeout(function () {
      $(".is-checked").click()
    }, 500)
    updateFilterCount();
  }).fail(function (e) {
    console.log(e)
  })
}

function updateFilterCount() {
  $('#filter-count-new').text(iso.filteredItems.length + ' Items');
}


function editarusuariodatatable(id, name, email, phone, type, photo, tipodeaccion) {
  if (tipodeaccion == 1) {
    $("#tipodeaccion").val(tipodeaccion)
  }
  $("#editarusermodal").modal('show')
  $("#iduserEditar").val(id)
  $("#nameEditar").val(name)
  $("#emailEditar").val(email)
  $("#phoneEditar").val(phone)
  $("#urlfotoEditar").val(photo)
  $("#selectRolEditar").val(type)
}

function editarcategoriadatatable(id, name, foto, status) {
  $("#modalEditarCategoria").modal('show')
  $("#idcategoria").val(id)
  $("#nameCategoriaEditar").val(name)
  $("#urlfotoregistrocategoriaeditar").val(foto)
}

function bilitarusuario(id, tipo) {
  if (tipo == '1') {
    valor = 'habilitar'
    valorfinal = 'habilito'
  } else {
    valor = 'deshabilitar'
    valorfinal = 'deshabilito'
  }
  swalWithBootstrapButtons({
    title: `¿Quieres ${valor} el usuario?`,
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si, deseo hacerlo',
    cancelButtonText: 'No',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      $.post(`${direccionfull}Usuario/bilitarUsuario`, { id: id, tipo: tipo }, function () { }).done(function (e) {
        tablaData.ajax.reload(null, false);
        if (tipo == '0') {
          alertasweet('success', 'Exito', 'Se desabilito correctamente el usuario')
        } else {
          alertasweet('success', 'Exito', 'Se habilito correctamente el usuario')
        }
      }).fail(function (e) {
        alertasweet('error', 'Error', 'No se edito el usuario')
        console.log(e)
      })
      
    } else if (result.dismiss === swal.DismissReason.cancel) {
      alertasweet('error', 'Error', 'No se edito el usuario')
      $("#editarusermodal").modal('hide')
    }
  });
}

function bilitarcategoria(id, tipo) {
  if (tipo == '1') {
    valor = 'habilitar'
    valorfinal = 'habilito'
  } else {
    valor = 'deshabilitar'
    valorfinal = 'desabilito'
  }
  swalWithBootstrapButtons({
    title: `¿Quieres ${valor} la categoria?`,
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si, deseo hacerlo',
    cancelButtonText: 'No',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      $.post(`${direccionfull}Categoria/bilitarCategoria`, { id: id, tipo: tipo }, function () { }).done(function (e) {
        tablaData.ajax.reload(null, false);
        if (tipo == '0') {
          alertasweet('success', 'Exito', 'Se desabilito correctamente la categoria')
        } else {
          alertasweet('success', 'Exito', 'Se habilito correctamente la categoria')
        }
      }).fail(function (e) {
        alertasweet('error', 'Error', 'No se edito la categoria')
        console.log(e)
      })
    } else if (result.dismiss === swal.DismissReason.cancel) {
      alertasweet('error', 'Error', 'No se edito la categoria')
      $("#editarusermodal").modal('hide')
    }
  });
}


function bilitarpieza(idpieza, tipo) {
  if (tipo == '1') {
    valor = 'habilitar'
    valorfinal = 'habilito'
  } else {
    valor = 'deshabilitar'
    valorfinal = 'deshabilito'
  }
  
  swalWithBootstrapButtons({
    title: `¿Quieres ${valor} la pieza?`,
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si, deseo hacerlo',
    cancelButtonText: 'No',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      $.post(`${direccionfull}Pieza/bilitarPieza`, { idpieza: idpieza, tipo: tipo }, function () { }).done(function (e) {
        data = JSON.parse(e)
        console.log(data)
        if (data.status == true) {
          alertasweet('success', 'Exito', `Se ${valorfinal} correctamente la pieza`)
          socket.emit('action', { type: 'actualizar_piezas', status: true });
          
          if (tipo == '1') {
            socket.emit('action', { type: 'agregar_pieza', piezaNueva: data.dataPieza[0], categoriasActualizadas: data.dataCategoria });
          } else {
            socket.emit('action', { type: 'eliminar_pieza', idpieza: idpieza, categoriasActualizadas: data.dataCategoria });
          }
        } else {
          alertasweet('success', 'Exito', `Se ${valorfinal} correctamente la pieza`)
        }
      }).fail(function (e) {
        console.log(e)
      })
    } else if (result.dismiss === swal.DismissReason.cancel) {
      alertasweet('error', 'Error', 'No se edito la pieza')
      $("#editarusermodal").modal('hide')
    }
  });
}

function eliminarPieza(idpieza) {
  swalWithBootstrapButtons({
    title: `¿Quieres eliminar la pieza?`,
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si, deseo hacerlo',
    cancelButtonText: 'No',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      $.post(`${direccionfull}Pieza/eliminarPieza`, { idpieza: idpieza }, function () { }).done(function (e) {
        data = JSON.parse(e)
        if (data.status) {
          alertasweet('success', 'Exito', 'Se elimino correctamente la pieza')
          socket.emit('action', { type: 'eliminar_pieza', idpieza: idpieza });
        } else {
          alertasweet('error', 'Error', 'No se elimino la pieza')
        }
      }).fail(function (e) {
        alertasweet('error', 'Error', 'No se elimino la pieza')
        console.log(e)
      })
    } else if (result.dismiss === swal.DismissReason.cancel) {
      alertasweet('error', 'Error', 'No se elimino la pieza')
      $("#editarusermodal").modal('hide')
    }
  });
}

function verPieza(idpieza) {
  htmlcargando = `<div class="chat-content text-center"><div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
  <span class="sr-only">Loading...</span>
  </div></div>`
  $("#CardCargando").html(htmlcargando)
  $('#segundoCard').addClass('d-none')
  $.post(`${direccionfull}Pieza/verPiezaDetallada`, { idpieza: idpieza }, function () { }).done(function (e) {
    datos = JSON.parse(e)
    datosPrincipales = datos.dataPrincipal[0]
    $("#nombrePiezaDetalles").text(`${datosPrincipales.pieza_bicicleta_name}`)
    $("#categoriaPiezaDetalles").text(datosPrincipales.categoria_piezas_bicicleta_name)
    $("#imagenprincipalPiezaDetalles").attr('src', `${direccionfull}${datosPrincipales.imagen_pieza_bicicleta_file}`)
    $("#descripcionPiezaDetalles").text(datosPrincipales.pieza_bicicleta_description)
    $("#indicadoresCarrusel").html('')
    $("#listboxCarrusel").html('')
    
    if (datos.dataSecundaria.length <= 0) {
      $("#mostrarImageneSecundarias").addClass('d-none')
    } else {
      datos.dataSecundaria.map((item, index) => {
        indicators = `<li data-target="#carouselExampleIndicators2" data-slide-to="${index}" class="active"></li>`
        if (index == 0) {
          listbox = `<div class="carousel-item active text-center">
          <img class="img-thumbnail rounded" src="${direccionfull}${item.imagen_pieza_bicicleta_file}" style="width: 90%;height: 370px;">
          </div>`
        } else {
          listbox = `<div class="carousel-item text-center">
          <img class="img-thumbnail rounded" src="${direccionfull}${item.imagen_pieza_bicicleta_file}" style="width: 90%;height: 370px;">
          </div>`
        }
        $("#indicadoresCarrusel").append(indicators)
        $("#listboxCarrusel").append(listbox)
      });
      $("#mostrarImageneSecundarias").removeClass('d-none')
    }
    $("#CardCargando").html('')
    $('#segundoCard').removeClass('d-none')
  }).fail(function (e) {
    console.log(e)
  })
  
  $('#primerCard').hide({
    duration: 1000,
    complete: function () {
    },
    easing: 'swing'
  }
  );
  $('#segundoCard').show(1000);
  
}

function editarPieza(idpieza, namepieza, descriptionpieza, idcategoria) {
  $("#idImagenesEliminadas").val('')
  mostrarTodasCategoriaSelect("#selectCategoriaPiezaEditar", idcategoria)
  $("#modalEditarPieza").modal('show')
  $("#idPiezaEditar").val(idpieza)
  $("#namePiezaEditar").val(namepieza)
  $("#descriptionPiezaEditar").val(descriptionpieza)
  $("#imagenesPiezaEditandoMostrar").html(`<tr class="table-info text-center">
  <td>
  </td>
  <td>
  <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
  <span class="sr-only">Loading...</span>
  </div>
  </td>
  <td>
  </td>
  </tr>`);
  $.post(`${direccionfull}Pieza/verImagenesPieza`, { idpieza: idpieza }, function () { }).done(function (e) {
    datos = JSON.parse(e)
    $("#imagenesPiezaEditandoMostrar").html('')
    datos.data.map((item) => {
      if (item.imagen_pieza_bicicleta_tipo == "1") {
        html = `
        <tr class="table-success text-center" id="imagen-${item.imagen_pieza_bicicleta_id}">
        <td>
        <input type="hidden" name="fotosRegistradasPiezas[]" value="${item.imagen_pieza_bicicleta_id}---${item.imagen_pieza_bicicleta_tipo}">
        <img src="${direccionfull}${item.imagen_pieza_bicicleta_file}" width="125" height='125' class="rounded-circle" alt="logo">
        </td>
        <td>
        <span class="font-medium">Primaria</span>
        </td>
        <td>
        <a href="javascript:void(0)">
        <i class="mdi mdi-checkbox-marked fa-2x"></i>
        </a>                                                    
        <a href="javascript:void(0)" onclick="eliminarImagenDom('${item.imagen_pieza_bicicleta_id}')">
        <i class="mdi mdi-delete fa-2x"></i>
        </a>
        </td>
        </tr>
        `
      } else {
        html = `
        <tr class="table-danger text-center" id="imagen-${item.imagen_pieza_bicicleta_id}">
        <input type="hidden" name="fotosRegistradasPiezas[]" value="${item.imagen_pieza_bicicleta_id}---${item.imagen_pieza_bicicleta_tipo}">
        <td><img src="${direccionfull}${item.imagen_pieza_bicicleta_file}" width="125" height='125' class="rounded-circle" alt="logo"></td>
        <td>
        <span class="font-medium">Secundaria</span>
        </td>
        <td>
        <a href="javascript:void(0)" onclick="bilitarImagen('${item.imagen_pieza_bicicleta_id}','1','${item.imagen_pieza_bicicleta_file}')">
        <i class="mdi mdi-checkbox-blank-outline fa-2x"></i>
        </a>
        <a href="javascript:void(0)" onclick="eliminarImagenDom('${item.imagen_pieza_bicicleta_id}')">
        <i class="mdi mdi-delete fa-2x"></i>
        </a>
        </td>
        </tr>
        `
      }
      $("#imagenesPiezaEditandoMostrar").append(html);
    })
  })
}

function cambioImage(cambio, idimagen) {
  file = cambio.files[0]
  let formData = new FormData();
  formData.append('file', file);
  $(`#imagenquiz-${idimagen}`).html(`
  <td rowspan="2" colspan="2" scope="2" class="text-center">
  <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
  <span class="sr-only">Loading...</span>
  </div>
  </td>
  `)
  $.ajax({
    url: `${direccionfull}Quiz/uploadImage`,
    type: 'POST',
    dataTyte: 'json',
    data: formData,
    processData: false,
    contentType: false,
    enctype: 'multipart/form-data',
    success: function (data) {
      $("#fotoQuizEditar").val(data)
      html = `
      <td>
      <img src="${direccionfull}${data}" width="125" height='125' class="rounded-circle" alt="logo">
      </td>
      <td>                                                    
      <a href="javascript:void(0)" onclick="eliminarImagenQuizDom('${idimagen}')">
      <i class="mdi mdi-delete fa-2x"></i>
      </a>
      </td>
      `
      $(`#imagenquiz-${idimagen}`).html(html)
      
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("Ha ocurrido un error");
      console.log(jqXHR, textStatus, errorThrown)
    }
  });
}

function eliminarImagenDom(idimagen) {
  $(`#imagen-${idimagen}`).remove()
  valorImagenesEliminadas = $("#idImagenesEliminadas").val()
  idimagenFull = `${valorImagenesEliminadas}${idimagen}---`
  $("#idImagenesEliminadas").val(idimagenFull)
}


function eliminarImagenQuizDom(idimagen) {
  $(`#imagenquiz-${idimagen}`).remove()
  $("#fotoQuizEditar").val('')  
  html = `
  <tr class="table-success text-center" id="imagenquiz-${idimagen}">
  <td rowspan="1" colspan="2" scope="2" class="text-center">
  <a class="btn-circle btn-cyan text-white text-center waves-effect waves-light" href="javascript:void(0)">
  <i class="fas icon-paper-clip"></i>
  <input name="filemensajequiz" id="filemensajequiz" type="file" onchange="cambioImage(this,${idimagen})" accept="image/png, .jpeg, .jpg" style="position: absolute; top: 0; right: 0; min-width: 100%; min-height: 100%; font-size: 100px; text-align: right; opacity: 0; filter: alpha(opacity=0); outline: none; background: white; cursor: inherit; display: block;">
  </a>
  </td>
  </tr>
  `
  $("#imagenQuizEditar").html(html)
}


function bilitarImagen(idimagen, tipodeaccion, imagen_pieza_bicicleta_file) {
  $(".table-success").find('input').each(function () {
    if ($(this).attr("name") == "fotosRegistradasPiezas[]") {
      ids = $(this).val().split("---");
      valorfinal = `${ids[0]}---0`
      $(this).val(valorfinal)
    }
  });
  $(".table-success .font-medium").text('Secundaria')
  
  $(".table-success td:first").find('img').each(function () {
    valorurl = $(this).attr("src").split(direccionfull);
    valorfinalurl = `${valorurl[1]}`
  });
  
  $(".table-success td:last").html(`
  <a href="javascript:void(0)" onclick="bilitarImagen('${ids[0]}','1','${valorfinalurl}')">
  <i class="mdi mdi-checkbox-blank-outline fa-2x"></i>
  </a>
  <a href="javascript:void(0)" onclick="eliminarImagenDom('${ids[0]}')">
  <i class="mdi mdi-delete fa-2x"></i>
  </a>
  `)
  
  
  $(".table-success").removeClass('table-success').addClass('table-danger')
  $(`#imagen-${idimagen}`).removeClass('table-danger')
  $(`#imagen-${idimagen}`).addClass('table-success')
  html = `
  <td>
  <input type="hidden" name="fotosRegistradasPiezas[]" value="${idimagen}---${tipodeaccion}">
  <img src="${direccionfull}${imagen_pieza_bicicleta_file}" width="125" height='125' class="rounded-circle" alt="logo">
  </td>
  <td>
  <span class="font-medium">Primaria</span>
  </td>
  <td>
  <a href="javascript:void(0)">
  <i class="mdi mdi-checkbox-marked fa-2x"></i>
  </a>                                                    
  <a href="javascript:void(0)" onclick="eliminarImagenDom('${idimagen}')">
  <i class="mdi mdi-delete fa-2x"></i>
  </a>
  </td>
  `
  $(`#imagen-${idimagen}`).html(html)
}

$("#formEditarPieza").on('submit', function (e) {
  e.preventDefault()
  form = $("#formEditarPieza").serialize()
  $.post(`${direccionfull}Pieza/editarPieza`, form, function () { }).done(function (e) {
    datos = JSON.parse(e)
    if (datos.status) {
      socket.emit('action', { type: 'actualizar_piezas', status: true });
      socket.emit('action', { type: 'editar_pieza_unica', status: true });
      
      $("#modalEditarPieza").modal('hide')
      alertasweet('success', 'Edicción de la Pieza', 'La pieza se edito correctamente')
    } else {
      console.log(datos)
    }
  })
})


function mostrarTodosForos() {
  $.post(`${direccionfull}Foro/mostrarTodosForos`, {}, function () { }).done(function (e) {
    datos = JSON.parse(e)
    $("#listadeForos").html('');
    datos.data.map((item) => {
      if (item.fileforo != "") {
        valorfile = `<span class="user-img text-center">
        <img src="${direccionfull}${item.fileforo}" alt="user" class="rounded-circle" width="50" onclick='verImagenDetallada("${direccionfull}${item.fileforo}")'> 
        </span>`
      } else {
        valorfile = null
      }
      if (item.statusforo == '1') {
        color = 'style="background:#68d768ab;"'
        valortext = 'Habilitado'
        valorbg = "success"
      } else {
        color = 'style="background:#d03d6d66;"'
        valortext = 'Inhabilitado'
        valorbg = "danger"
      }
      html = `<a href="javascript:void(0)" class="message-item mt-1 card-hover waves-effect waves-light comment-row" ${color} id="foro-${item.idforo}" onclick="selecciondeforo('${item.idforo}','${item.nameforo}','${item.fileforo}','${item.statusforo}','${item.userforo}','${item.createforo}')">
      <div class="d-flex flex-row justify-content-center align-content-start">
      
      <div class="p-0">
      ${valorfile}
      </div>
      <div class="comment-text active w-100">
      <h6 class="font-medium">${item.nameforo}</h6>
      <div class="comment-footer ">
      <span class="text-muted float-right">${item.createforo}</span>
      <span class="label label-${valorbg} label-rounded float-left">${valortext}</span>
      </div>
      </div>
      </div>
      </a>`
      $("#listadeForos").append(html);
    });
  }).fail(function (e) {
    console.log(e)
  })
}

function selecciondeforo(idforo, nombreForoNew, fileforo, statusforo, userforo, createforo) {
  $("#chatlisto").addClass('d-none')
  $("#ocultarformenviar").addClass('d-none')
  $("#chatnolisto").removeClass('d-none')
  $("#chatlisto").html('')
  $("#idforoenviarmensaje").val(idforo)
  $("#mensajeforoenviar").val('');
  $("#iduserforoeditar").val(userforo)
  $("#menuConfigForo").html('')
  $("#chatlisto").addClass(`forochat-${idforo}`)
  
  if (statusforo == 1) {
    htmlconfigforo = `<a class="dropdown-item" href="javascript:void(0)" id="btneditarforo" onclick="abrirmodaleditarforo('${idforo}','${nombreForoNew}')">
    <i class="ti-pencil-alt"></i> Editar
    </a>
    <a class="dropdown-item" href="javascript:void(0)" id="btnocultarforo" onclick="bilitarforo('${idforo}','${userforo}','0','${nombreForoNew}','${fileforo}','${createforo}')">
    <i class="fas fa-eye-slash"></i> Ocultar 
    </a>`
  } else {
    htmlconfigforo = `<a class="dropdown-item" href="javascript:void(0)" id="btneditarforo" onclick="abrirmodaleditarforo('${idforo}','${nombreForoNew}')">
    <i class="ti-pencil-alt"></i> Editar
    </a>
    <a class="dropdown-item" href="javascript:void(0)" id="btnmostrarforo" onclick="bilitarforo('${idforo}','${userforo}','1','${nombreForoNew}','${fileforo}','${createforo}')">
    <i class="fas fa-eye"></i> Habilitar 
    </a>`
  }
  $("#menuConfigForo").html(htmlconfigforo)
  
  $("#chatnolisto").html(`<li class="chat-item">
  <div class="chat-content text-center">
  <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
  <span class="sr-only">Loading...</span>
  </div>
  </div>
  </li>`)
  
  $("#tituloforomostrar").text(nombreForoNew)
  $('#mensajeriaForoVacio').hide({
    duration: 1000,
    complete: function () { },
    easing: 'swing'
  });
  $.post(`${direccionfull}Foro/mostrarTodosMensajesForo`, { idforo: idforo }, function () { }).done(function (data) {
    datos = JSON.parse(data)
    if (datos.status) {
      $("#chatnolisto").html('')
      $(`.foro-${idforo}`).addClass('d-none');
      $(`.forochat-${idforo}`).removeClass('d-none');
      $("#ocultarformenviar").removeClass('d-none')
      
      datos.data.sort((primera, segunda) => primera.mensaje_foro_id - segunda.mensaje_foro_id);
      retornando = datos.data.map((item, index) => {
        if (item.user_photo != "") {
          fotoUsuario = `<div class="chat-img"><img src="${direccionfull}${item.user_photo}" alt="user"></div>`
        } else {
          fotoUsuario = `<div class="chat-img bg-success text-center" style="border-radius: 50%;width: 30px;height: 20px;">
          ${item.user_name.substr(0, 2)}
          </div>`
        }
        switch (item.tipodemensaje) {
          case 'enviado':
          if (item.mensaje_foro_file != null) {
            html = `<li class="odd chat-item" id="mensaje-${item.mensaje_foro_id}">
            <div class="chat-content">
            <div class="box bg-light-info">
            <a href="javascript:void(0)" onclick="verImagenDetallada('${direccionfull}${item.mensaje_foro_file}')">
            <img src="${direccionfull}${item.mensaje_foro_file}" class="img-fluid rounded" style="width: 190px;height: 220px;">
            </a>
            </div>
            <div class="chat-time">${item.mensaje_foro_create}</div>
            </div>
            </li>`
          } else {
            html = `<li class="odd chat-item" id="mensaje-${item.mensaje_foro_id}">
            <div class="chat-content">
            <div class="box bg-light-inverse">${item.mensaje_foro_mens}</div>
            </div>
            <div class="chat-time">${item.mensaje_foro_create}</div>
            </li>`
          }
          break;
          
          case 'recibido':
          if (item.mensaje_foro_file != null) {
            html = `<li class="chat-item" id="mensaje-${item.mensaje_foro_id}">
            ${fotoUsuario}
            <div class="chat-content">
            <h6 class="font-medium">${item.user_name}</h6>
            <a href="javascript:void(0)" onclick="verImagenDetallada('${direccionfull}${item.mensaje_foro_file}')">
            <img src="${direccionfull}${item.mensaje_foro_file}" class="img-fluid rounded" style="width: 190px;height: 220px;">
            </a>
            </div>
            <div class="chat-time">${item.mensaje_foro_create}</div>
            </li>`
          } else {
            html = `<li class="chat-item" id="mensaje-${item.mensaje_foro_id}">
            ${fotoUsuario}
            <div class="chat-content">
            <h6 class="font-medium">${item.user_name}</h6>
            <div class="box bg-light-info">${item.mensaje_foro_mens}</div>
            </div>
            <div class="chat-time">${item.mensaje_foro_create}</div>
            </li>`
          }
          break;
          default:
          break;
        }
        $(`.forochat-${idforo}`).append(html);
      });
      
      $('#chatPrincipal').stop().animate({
        scrollTop: $(`#chatPrincipal`)[0].scrollHeight
      }, 1000);
      
    } else {
      $("#chatnolisto").addClass(`foro-${idforo}`)
      $("#chatnolisto").html(`<li class="chat-item" id="foro-${idforo}">
      <div class="chat-content text-center">
      No hay mensajes en este foro
      </div>
      </li>`)
      $("#ocultarformenviar").removeClass('d-none')
    }
  }).fail(function (e) {
    console.log(e)
  });
  
  $('#mensajeriaForolleno').show(1000);
}


$("#formEnviarMensajeForo").on('submit', function (e) {
  e.preventDefault()
  mensajeforoenviar = $("#mensajeforoenviar").val();
  if (mensajeforoenviar != '') {
    form = $("#formEnviarMensajeForo").serialize()
    $("#mensajeforoenviar").val('');
    
    idforoenviarmensaje = $("#idforoenviarmensaje").val()
    $.post(`${direccionfull}Foro/enviarMensaje`, form, function () { }).done(function (data) {
      datos = JSON.parse(data)
      mensajeforoid = datos.mensaje_foro_id
      mensajeforo = datos.mensaje_foro_mens
      fecha = datos.fechactual
      user = datos.user
      $("#chatnolisto").addClass('d-none')
      $("#chatlisto").removeClass('d-none')
      socket.emit('action', { type: 'chat_message_text', data: { idforo: idforoenviarmensaje, user: user, mensajeforoid: mensajeforoid, mensaje: mensajeforo, fecha: fecha } });
    }).fail(function (e) {
      console.log(e)
    })
  }
})

$("#filemensajeforo").on('change', function () {
  idforo = $("#idforoenviarmensaje").val()
  file = this.files[0]
  let formData = new FormData();
  formData.append('file', file);
  formData.append('idforo', idforo);
  
  $.ajax({
    url: `${direccionfull}Foro/uploadImageMensajeForo`,
    type: 'POST',
    dataTyte: 'json',
    data: formData,
    processData: false,
    contentType: false,
    enctype: 'multipart/form-data',
    success: function (data) {
      datos = JSON.parse(data)
      mensajeforoid = datos.mensaje_foro_id
      fecha = datos.fechactual
      archivomensaje = datos.dataubicacionfile
      if (datos.status) {
        $("#chatnolisto").addClass('d-none')
        $("#chatlisto").removeClass('d-none')
      }
      socket.emit('action', { type: 'chat_message_file', data: { idforo: idforo, user: datos.user, mensajeforoid: mensajeforoid, archivomensaje: archivomensaje, fecha: fecha } });
    },
    //Si la operación tiene un error
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("Ha ocurrido un error");
      console.log(jqXHR, textStatus, errorThrown)
    }
  });
  
})
// // modalEditarForo formEditarForo idforoeditar nameForoEditar dropzoneforoeditar urlfotoeditarforo subirfotoForoEditar
function bilitarforo(idforo, iduser, tipodeaccion, nombreForoNew, fileforo, createforo) {
  idforo = $("#idforoenviarmensaje").val();
  iduser = $("#iduserforoeditar").val()
  mensajebueno = (tipodeaccion == '1') ? 'Se habilito el foro' : 'Se oculto el foro';
  mensajemalo = (tipodeaccion == '1') ? 'No se habilito el foro' : 'No se oculto el foro';
  $.post(`${direccionfull}Foro/bilitarforo`, { idforo: idforo, iduser: iduser, tipodeaccion: tipodeaccion }, function () { }).done(function (data) {
    datos = JSON.parse(data)
    datosactualizar = {
      idforo: idforo,
      nameforo: nombreForoNew,
      fileforo: fileforo,
      createforo: createforo,
      statusforo: tipodeaccion,
      userforo: iduser,
    }
    
    if (datos.status) {
      socket.emit('action', { type: 'actualizar_foro' });
      if (tipodeaccion == '1') {
        socket.emit('action', { type: 'agregar_foro', data: datosactualizar });
      } else {
        socket.emit('action', { type: 'eliminar_foro', data: datosactualizar });
      }
      selecciondeforo(idforo, nombreForoNew, fileforo, tipodeaccion, iduser)
      alertasweet('success', 'Exito', mensajebueno)
    } else {
      if (datos.dataerror != '') {
        alertasweet('error', 'Error', datos.dataerror)
      } else {
        alertasweet('error', 'Error', mensajemalo)
      }
    }
  }).fail(function (e) {
    alertasweet('error', 'Error', mensajemalo)
    console.log(e)
  })
}

function abrirmodaleditarforo(idforo, nombreForoNew) {
  $("#modalEditarForo").modal('show')
  $("#idforoeditar").val(idforo);
  $("#nameForoEditar").val(nombreForoNew);
}


// Niveles
// modalCrearNivel formCrearNivel nameNivel
$("#formCrearNivel").on('submit', function (e) {
  e.preventDefault()
  form = $("#formCrearNivel").serialize()
  
  $.post(`${direccionfull}Quiz/crearNivel`, form, function () { }).done(function (data) {
    datos = JSON.parse(data)
    if (datos.status) {
      tablaDataNew.ajax.reload(null, false);
      $("#modalCrearNivel").modal('hide')
      alertasweet('success', 'Exito', 'Se creo el nivel')
    } else {
      if (datos.dataerror != '') {
        alertasweet('error', 'Error', 'No se creo el nivel')
      } else {
        alertasweet('error', 'Error', 'No se creo el nivel')
      }
    }
  }).fail(function (e) {
    console.log(e)
  })
  
})

// modalEditarNivel formEditarNivel idnivel nameNivelEditar
$("#formEditarNivel").on('submit', function (e) {
  e.preventDefault()
  form = $("#formEditarNivel").serialize()
  
  $.post(`${direccionfull}Quiz/editarNivel`, form, function () { }).done(function (data) {
    datos = JSON.parse(data)
    if (datos.status) {
      tablaDataNew.ajax.reload(null, false);
      $("#modalEditarNivel").modal('hide')
      alertasweet('success', 'Exito', 'Se edito el nivel')
    } else {
      if (datos.dataerror != '') {
        alertasweet('error', 'Error', 'No se edito el nivel')
      } else {
        alertasweet('error', 'Error', 'No se edito el nivel')
      }
    }
  }).fail(function (e) {
    console.log(e)
  })
  
})

// Preguntas
// modalCrearPregunta formCrearPregunta namePregunta selectnivel
$("#btnCrearPregunta").on('click', function (e) {
  e.preventDefault()
  form = $("#formCrearPregunta").serialize()
  switchs = $(".bt-switch input[type='checkbox']").bootstrapSwitch('state');
  tipodetab = $("#tipodetab").val()
  
  
  pregunta = $("#namePregunta").val()
  nivel = $("#selectnivel").val()
  foto = $("#urlfotoregistropregunta").val()
  respuesta1 = $("#respuesta1").val()
  respuesta2 = $("#respuesta2").val()
  respuesta3 = $("#respuesta3").val()
  respuesta4 = $("#respuesta4").val()
  
  respuestaradio = $('input:radio[name=respuestaradio]:checked').val()
  
  if (tipodetab == '1') {
    formnew = {
      pregunta: pregunta,
      nivel: nivel,
      foto: foto,
      verdofalso: switchs,
      tipoderespuesta: tipodetab
    }
  } else {
    formnew = {
      pregunta: pregunta,
      nivel: nivel,
      foto: foto,
      respuesta1: respuesta1,
      respuesta2: respuesta2,
      respuesta3: respuesta3,
      respuesta4: respuesta4,
      respuestaradio: respuestaradio,
      tipoderespuesta: tipodetab
    }
  }
  
  $.post(`${direccionfull}Quiz/crearPregunta`, formnew, function () { }).done(function (data) {
    datos = JSON.parse(data)
    if (datos.status) {
      tablaData.ajax.reload(null, false);
      alertasweet('success', 'Exito', `Se creo correctamente la pregunta`)
      $("#modalCrearPregunta").modal('hide')
    } else {
      alertasweet('error', 'Error', `No se creo la pregunta`)
    }
  }).fail(function (e) {
    console.log(e)
  })
  
})


$("#btnModalCrearPregunta").on('click', function (e) {
  e.preventDefault()
  $("#modalCrearPregunta").modal('show')
  traerNiveles(`#selectnivel`, '')
})

function traerNiveles(idlugar, idnivel) {
  $.post(`${direccionfull}Quiz/selectNivel`, {}, function () { }).done(function (e) {
    $(`${idlugar}`).html(e)
    if (idnivel != '') {
      $(`${idlugar} option[value="${idnivel}"]`).attr("selected", true);
    }
  }).fail(function (e) {
    console.log(e)
  })
}

function editarPregunta(idpregunta, pregunta, file, idnivel) {
  $("#modalEditarQuiz").modal('show')
  $("#idQuizEditar").val(idpregunta)
  $("#nameQuizEditar").val(pregunta)
  $("#fotoQuizEditar").val(file)
  $("#respuestasQuizEditar").html(`<td rowspan="2" colspan="2" scope="2" class="text-center">
  <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
  <span class="sr-only">Loading...</span>
  </div>
  </td>`)
  traerNiveles(`#selectNivelQuizEditar`, idnivel)
  
  if (file == '') {
    imagen = `<td rowspan="1" colspan="2" scope="2" class="text-center">
    <a class="btn-circle btn-cyan text-white text-center waves-effect waves-light" href="javascript:void(0)">
    <i class="fas icon-paper-clip"></i>
    <input name="filemensajequiz" id="filemensajequiz" type="file" onchange="cambioImage(this,${idpregunta})" accept="image/png, .jpeg, .jpg" style="position: absolute; top: 0; right: 0; min-width: 100%; min-height: 100%; font-size: 100px; text-align: right; opacity: 0; filter: alpha(opacity=0); outline: none; background: white; cursor: inherit; display: block;">
    </a>
    </td>
    `
  } else {
    imagen = `<td>
    <img src="${direccionfull}${file}" width="125" height='125' class="rounded-circle" alt="logo">
    </td>
    <td>                                                  
    <a href="javascript:void(0)" onclick="eliminarImagenQuizDom('${idpregunta}')">
    <i class="mdi mdi-delete fa-2x"></i>
    </a>
    </td>`
  }
  
  html = `
  <tr class="table-success text-center" id="imagenquiz-${idpregunta}">
  ${imagen}
  </tr>
  `
  $("#imagenQuizEditar").html(html)
  
  $.post(`${direccionfull}Quiz/verRespuestasPregunta`, { idpregunta: idpregunta }, function () { }).done(function (data) {
    datos = JSON.parse(data)  
    if (datos.tipodedata == 'unica') {
      valorRespuesta = (datos.data[0].respuesta_quiz_correcta == '1') ? 'Verdadero' : 'Falso'
      valorRespuestaTabla = (datos.data[0].respuesta_quiz_correcta == '1') ? 'table-success' : 'table-danger'
      checked = (datos.data[0].respuesta_quiz_correcta == '1') ? 'checked' : ''
      
      htmlRespuestas = `<tr class='table-info'>
      <td>
      <input type="hidden" name="tipoderespuesta" value="unica">
      <input type="hidden" name="respuestaId[]" value="${datos.data[0].respuesta_quiz_id}">
      <input type="hidden" name="respuestaUnicaValor[]" value="${datos.data[0].respuesta_quiz_correcta}">
      ${valorRespuesta}
      </td>
      <td>
      <div class="bt-switch">
      <input type="checkbox" name="respuestaradioeditarunica" class="radio-switch" ${checked} data-on-color="success" data-off-color="danger" data-on-text="Verdadero" data-off-text="Falso" value='seleccionada'>
      </div>
      </td>
      </tr>
      `
      $("#respuestasQuizEditar").html(htmlRespuestas)
      $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
      radioswitch.init()
    } else {
      
      checked1 = (datos.data[0].respuesta_quiz_correcta == '1') ? 'checked' : ''
      checked2 = (datos.data[1].respuesta_quiz_correcta == '1') ? 'checked' : ''
      checked3 = (datos.data[2].respuesta_quiz_correcta == '1') ? 'checked' : ''
      checked4 = (datos.data[3].respuesta_quiz_correcta == '1') ? 'checked' : ''
      
      htmlRespuestas = `
      <div class="bt-switch">
      <input type="hidden" name="tipoderespuesta" value="multiple">
      <div class="row m-b-15 m-l-20 m-t-15 justify-content-center align-content-center align-items-center">
      <div class="col-sm-8">
      <div class="form-group">
      
      <input type="hidden" class="form-control" name="respuestasIdEditar[]" required value="${datos.data[0].respuesta_quiz_id}">
      <input type="text" class="form-control" name="respuestasNameEditar[]" placeholder="Respuesta 1" required value="${datos.data[0].respuesta_quiz_resp}">
      </div>
      </div>
      <div class="col-sm-4">
      <div class="form-group" name="btnradio">
      <input type="radio" name="respuestaradioeditarmultiple" class="radio-switch" ${checked1} data-on-color="success" data-off-color="danger" data-on-text="Correcta" data-off-text="Incorrecta" checked value="0">
      </div>
      </div>
      </div>
      
      <div class="row m-b-15 m-l-20 justify-content-center align-content-center align-items-center">
      <div class="col-sm-8">
      <div class="form-group">
      <input type="hidden" class="form-control" name="respuestasIdEditar[]" required value="${datos.data[1].respuesta_quiz_id}">
      <input type="text" class="form-control" name="respuestasNameEditar[]" placeholder="Respuesta 1" required value="${datos.data[1].respuesta_quiz_resp}">
      </div>
      </div>
      <div class="col-sm-4">
      <div class="form-group" name="btnradio">
      <input type="radio" name="respuestaradioeditarmultiple" class="radio-switch" ${checked2} data-on-color="success" data-off-color="danger" data-on-text="Correcta" data-off-text="Incorrecta" value="1">
      </div>
      </div>
      </div>
      
      <div class="row m-b-15 m-l-20 justify-content-center align-content-center align-items-center">
      <div class="col-sm-8">
      <div class="form-group">
      <input type="hidden" class="form-control" name="respuestasIdEditar[]" required value="${datos.data[2].respuesta_quiz_id}">
      <input type="text" class="form-control" name="respuestasNameEditar[]" placeholder="Respuesta 1" required value="${datos.data[2].respuesta_quiz_resp}">
      </div>
      </div>
      <div class="col-sm-4">
      <div class="form-group" name="btnradio">
      <input type="radio" name="respuestaradioeditarmultiple" class="radio-switch" ${checked3} data-on-color="success" data-off-color="danger" data-on-text="Correcta" data-off-text="Incorrecta" value="2">
      </div>
      </div>
      </div>
      
      <div class="row m-b-15 m-l-20 justify-content-center align-content-center align-items-center">
      <div class="col-sm-8">
      <div class="form-group">
      <input type="hidden" class="form-control" name="respuestasIdEditar[]" required value="${datos.data[3].respuesta_quiz_id}">
      <input type="text" class="form-control" name="respuestasNameEditar[]" placeholder="Respuesta 1" required value="${datos.data[3].respuesta_quiz_resp}">
      </div>
      </div>
      <div class="col-sm-4">
      <div class="form-group" name="btnradio">
      <input type="radio" name="respuestaradioeditarmultiple" class="radio-switch" ${checked4} data-on-color="success" data-off-color="danger" data-on-text="Correcta" data-off-text="Incorrecta" value="3">
      </div>
      </div>
      </div>
      
      </div>
      `
      $("#respuestasQuizEditar").html(htmlRespuestas)
      $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
      radioswitch.init()
    }
  })
}

$("#formEditarQuiz").on('submit', function (e) {
  e.preventDefault()
  form = $("#formEditarQuiz").serialize()  
  $.post(`${direccionfull}Quiz/editarPreguntaQuiz`, form, function () { }).done(function (data) {
    datos = JSON.parse(data)
    tablaData.ajax.reload(null, false);
    $("#modalEditarQuiz").modal('hide')
    alertasweet('success', 'Exito', 'Se actualizo la pregunta')
  })
})

function eliminarPregunta(idpregunta) {
  swalWithBootstrapButtons({
    title: `¿Quieres eliminar la pregunta?`,
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si, deseo hacerlo',
    cancelButtonText: 'No',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      $.post(`${direccionfull}Quiz/eliminarPregunta`, { idpregunta: idpregunta }, function () { }).done(function (data) {
        datos = JSON.parse(data)
        if (datos.status) {
          tablaData.ajax.reload(null, false);
          alertasweet('success', 'Exito', `Se elimino correctamente la pregunta`)
        } else {
          alertasweet('error', 'Error', `No Se elimino la pregunta`)
        }
      }).fail(function (e) {
        console.log(e)
      })
    } else if (result.dismiss === swal.DismissReason.cancel) {
    }
  });
  
}

function editarNivel(idnivel, namenivel) {
  $("#modalEditarNivel").modal('show');
  $("#idnivel").val(idnivel)
  $("#nameNivelEditar").val(namenivel)
}

function verRespuestas(idpregunta, nombrepregunta) {
  $("#detallesRespuestas").html('')
  $("#detallesRespuestasCargando").html(`<div class="row justify-content-center align-content-center">
  <div class="chat-item">
  <div class="chat-content text-center">
  <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
  <span class="sr-only">Loading...</span>
  </div>
  </div>
  </div>
  </div>
  `)
  $.post(`${direccionfull}Quiz/verRespuestasPregunta`, { idpregunta: idpregunta }, function () { }).done(function (data) {
    datos = JSON.parse(data)
    if (datos.tipodedata == 'unica') {
      if (datos.data[0].respuesta_quiz_correcta == '1') {
        respuesta = '<span class="label label-success">Verdadero</span>'
      } else {
        respuesta = '<span class="label label-danger">Falso</span>'
      }
      
      datahtml = `<div class="row justify-content-center align-content-center">
      <div class="card card-hover" style="background:#e1dddd !important">
      <div class="card-header">
      <h2 class="m-b-0 text-center">La respuesta correcta a la pregunta es</h2>
      </div>
      <div class="card-body">
      <div class="flex-column">
      <h3 class="text-center">${respuesta}</h3>
      </div>
      </div>
      </div>
      </div>`
      
      $("#detallesRespuestas").html(`<div class="row">
      ${datahtml}
      </div>`)
      
    } else {
      
      $("#detallesRespuestas").html(`
      <div class="row justify-content-center align-content-center">
      <div class="card card-hover" style="background:#e1dddd !important">
      <div class="card-header">
      <h2 class="m-b-0 text-center">Respuestas de la pregunta</h2>
      </div>
      
      <div class="input-group mb-3">
      <div class="table-responsive">
      <table class="table table-hover table-info bg-info">
      <thead class="text-white text-center">
      <tr>
      <th scope="col">Respuesta</th>
      <th scope="col">Tipo</th>
      </tr>
      </thead>
      <tbody id="idverrespuestas" class="text-center">
      </tbody>
      </table>
      </div>
      </div>
      
      </div>
      </div>
      `)
      retornando = datos.data.map((item, index) => {
        
        if (item.respuesta_quiz_correcta == "1") {
          html = `
          <tr class="table-success text-center">
          <td>
          <span class="font-medium">${item.respuesta_quiz_resp}</span>
          </td>
          <td>
          <span class="font-medium">Verdadero</span>
          </td>
          </tr>
          `
        } else {
          html = `
          <tr class="table-danger text-center">
          <td>
          <span class="font-medium">${item.respuesta_quiz_resp}</span>
          </td>
          <td>
          <span class="font-medium">Falso</span>
          </td>
          </tr>
          `
        }  
        $("#idverrespuestas").append(html)
      });
    }
    $("#detallesRespuestasCargando").html('')
  }).fail(function (e) {
    console.log(e)
  })
  
  $("#modalVerRespuestas").modal('show')
  $("#nombrePregunta").text(nombrepregunta)
}


function bilitarnivel(idnivel, tipo) {
  if (tipo == '1') {
    valor = 'habilitar'
    valorfinal = 'habilito'
  } else {
    valor = 'deshabilitar'
    valorfinal = 'deshabilito'
  }
  swalWithBootstrapButtons({
    title: `¿Quieres ${valor} el nivel?`,
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si, deseo hacerlo',
    cancelButtonText: 'No',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      $.post(`${direccionfull}Quiz/bilitarNivel`, { idnivel: idnivel, tipo: tipo }, function () { }).done(function (data) {
        datos = JSON.parse(data)
        if (datos.status) {
          tablaDataNew.ajax.reload(null, false);
          alertasweet('success', 'Exito', `Se ${valorfinal} correctamente el nivel`)
        } else {
          alertasweet('error', 'Error', `No Se ${valorfinal} el nivel`)
        }
      }).fail(function (e) {
        console.log(e)
      })
    } else if (result.dismiss === swal.DismissReason.cancel) {
      alertasweet('error', 'Error', 'No se edito el nivel')
    }
  });
}