var funcion, tabla_rol, tabla_usuario;

$(document).on("click", "#btn_aceptar", function () {
  var usuario = $("#username").val();
  var password = $("#password").val();

  if (parseInt(usuario.length) <= 0 || usuario == "") {
    $("#none_pass").hide();
    $("#none_usu").hide();
    $("#none_usu").show(2000);
  } else if (parseInt(password.length) <= 0 || password == "") {
    $("#none_usu").hide();
    $("#none_pass").hide();
    $("#none_pass").show(2000);
  } else {
    $("#none_usu").hide();
    $("#none_pass").hide();

    funcion = "logeo";
    $.ajax({
      url: "../Admin/controlador/usuario/usuario.php",
      type: "POST",
      data: { usuario: usuario, password: password, funcion: funcion },
    }).done(function (responce) {
      if (responce == 0) {
        $("#none_usu").hide();
        $("#none_pass").hide();
        $("#error_logeo").show(2000);
        return false;
      } else {
        var data = JSON.parse(responce);
        if (data[0][3] == 0) {
          Swal.fire({
            icon: "error",
            title: "Usuario inactivo",
            text: "El usuario se encuentra inactivo!",
          });
        } else {
          funcion = "session";
          $.ajax({
            url: "../Admin/controlador/usuario/usuario.php",
            type: "POST",
            data: {
              id_usu: data[0][0],
              rol: data[0][4],
              funcion: funcion,
            },
          }).done(function (res) {
            if (res == 1) {
              let timerInterval;
              Swal.fire({
                icon: "info",
                title: "Bienvenido al sistema!",
                html: "Usted sera redireccionado en <b></b> mi.",
                allowOutsideClick: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                  Swal.showLoading();
                  const b = Swal.getHtmlContainer().querySelector("b");
                  timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft();
                  }, 100);
                },
                willClose: () => {
                  clearInterval(timerInterval);
                },
              }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                  location.reload();
                }
              });
            }
          });
        }
      }
    });
  }
});

////////////////
function listar_rol() {
  funcion = "listar_rol";
  tabla_rol = $("#tabla_rol").DataTable({
    ordering: true,
    paging: true,
    aProcessing: true,
    aServerSide: true,
    searching: { regex: true },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,

    ajax: {
      url: "../../controlador/usuario/usuario.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el rol'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el rol'><i class='fa fa-edit'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el rol'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el rol'><i class='fa fa-edit'></i></button>`;
          }
        },
      },
      { data: "rol" },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return "<span class='badge badge-success'>ACTIVO</span>";
          } else {
            return "<span class='badge badge-danger'>INACTIVO</span>";
          }
        },
      },
    ],

    language: {
      rows: "%d fila seleccionada",
      processing: "Tratamiento en curso...",
      search: "Buscar&nbsp;:",
      lengthMenu: "Agrupar en _MENU_ items",
      info: "Mostrando los item (_START_ al _END_) de un total _TOTAL_ items",
      infoEmpty: "No existe datos.",
      infoFiltered: "(filtrado de _MAX_ elementos en total)",
      infoPostFix: "",
      loadingRecords: "Cargando...",
      zeroRecords: "No se encontro resultados en tu busqueda",
      emptyTable: "No hay datos disponibles en la tabla",
      paginate: {
        first: "Primero",
        previous: "Anterior",
        next: "Siguiente",
        last: "Ultimo",
      },
      select: {
        rows: "%d fila seleccionada",
      },
      aria: {
        sortAscending: ": active para ordenar la columa en orden ascendente",
        sortDescending: ": active para ordenar la columna en orden descendente",
      },
    },
    select: true,
    responsive: "true",
    dom: "Bfrtilp",
    buttons: [
      {
        extend: "excelHtml5",
        text: "Excel",
        titleAttr: "Exportar a Excel",
        className: "badge badge-success greenlover",
      },
      {
        extend: "pdfHtml5",
        text: "PDF",
        titleAttr: "Exportar a PDF",
        className: "badge badge-danger redfule",
      },
      {
        extend: "print",
        text: "Imprimir",
        titleAttr: "Imprimir",
        className: "badge badge-primary azuldete",
      },
    ],
    order: [[0, "ASC"]],
  });

  //esto es para crearn un contador para la tabla este contador es automatico
  tabla_rol.on("draw.dt", function () {
    var pageinfo = $("#tabla_rol").DataTable().page.info();
    tabla_rol
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_rol").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_rol.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_rol.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_rol.row(this).data();
  }
  var dato = 0;
  var id = data.rol_id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del rol se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_rol(id, dato);
    }
  });
});

$("#tabla_rol").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_rol.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_rol.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_rol.row(this).data();
  }
  var dato = 1;
  var id = data.rol_id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del rol se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_rol(id, dato);
    }
  });
});

function cambiar_estado_rol(id, dato) {
  var res = "";
  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  funcion = "estado_rol";
  alerta = [
    "datos",
    "Se esta cambiando el estado a " + res + "",
    "Cambiando estado",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/usuario/usuario.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio"];
        cerrar_loader_datos(alerta);
        tabla_rol.ajax.reload();
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo cambiar el estado, error en la matrix",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function registra_rol() {
  var nombre = $("#nombre_rol").val();

  if (nombre.length == 0 || nombre.trim() == "") {
    $("#nombre_rol_obligg").html(" - Ingrese nombre del rol");
    return swal.fire(
      "Campo vacios",
      "Debe ingresar el nombre del rol",
      "warning"
    );
  } else {
    $("#nombre_rol_obligg").html("");
  }

  funcion = "registrar_rol";
  alerta = ["datos", "Se esta creando el rol", "Creando rol"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/usuario/usuario.php",
    type: "POST",
    data: {
      funcion: funcion,
      nombre: nombre,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["exito", "success", "El rol se registro con exito"];
        cerrar_loader_datos(alerta);
        $("#nombre_rol").val("");
      } else if (resp == 2) {
        alerta = [
          "existe",
          "warning",
          "El rol '" + nombre + "', ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al registrar el rol, falla en la matrix",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

$("#tabla_rol").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_rol.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_rol.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_rol.row(this).data();
  }

  document.getElementById("id_rol").value = data.rol_id;
  document.getElementById("nombre_rol").value = data.rol;

  $("#modal_eitar_rol").modal({ backdrop: "static", keyboard: false });
  $("#modal_eitar_rol").modal("show");
});

function editar_rol() {
  var id = $("#id_rol").val();
  var nombre = $("#nombre_rol").val();

  if (nombre.length == 0 || nombre.trim() == "") {
    $("#nombre_rol_edit_obligg").html(" - Ingrese nombre del rol");
    return swal.fire(
      "Campo vacios",
      "Debe ingresar el nombre del rol",
      "warning"
    );
  } else {
    $("#nombre_rol_edit_obligg").html("");
  }

  funcion = "editar_rol";
  alerta = ["datos", "Se esta editando el rol", "Editando el rol"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/usuario/usuario.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      nombre: nombre,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["exito", "success", "El rol se registro con exito"];
        cerrar_loader_datos(alerta);
        $("#modal_eitar_rol").modal("hide");
        tabla_rol.ajax.reload();
      } else if (resp == 2) {
        alerta = [
          "existe",
          "warning",
          "El rol '" + nombre + "', ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al registrar el rol, falla en la matrix",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

///////////////////
////////////////////////
function listar_rol_usu() {
  funcion = "listar_rol_usu";
  $.ajax({
    url: "../../controlador/usuario/usuario.php",
    type: "POST",
    data: {
      funcion: funcion,
    },
  }).done(function (response) {
    var data = JSON.parse(response);
    var cadena = "<option value=''> --- Ingrese rol de usuario --- </option>";
    if (data.length > 0) {
      //bucle para extraer los datos del rol
      for (var i = 0; i < data.length; i++) {
        cadena +=
          "<option value='" + data[i][0] + "'> " + data[i][1] + " </option>";
      }
      //aqui concadenamos al id del select
      $("#tipo_rol").html(cadena);
    } else {
      cadena += "<option value=''>No hay datos de rol</option>";
      $("#tipo_rol").html(cadena);
    }
  });
}

function registra_usuario() {
  var nombres = $("#nombres").val();
  var apellidos = $("#apellidos").val();
  var correo = $("#correo").val();
  var cedula = $("#cedula").val();
  var tipo_rol = $("#tipo_rol").val();
  var usuario = $("#usuario").val();
  var password = $("#password").val();
  var password_c = $("#password_c").val();
  /// foto
  var foto = $("#foto").val();

  if (
    nombres.length == 0 ||
    nombres.trim() == "" ||
    apellidos.length == 0 ||
    apellidos.trim() == "" ||
    correo.length == 0 ||
    correo.trim() == "" ||
    cedula.length == 0 ||
    cedula.trim() == "" ||
    tipo_rol.length == 0 ||
    tipo_rol == 0 ||
    usuario.length == 0 ||
    usuario.trim() == "" ||
    password.length == 0 ||
    password.trim() == "" ||
    password_c.length == 0 ||
    password_c.trim() == ""
  ) {
    validar_registros(
      nombres,
      apellidos,
      correo,
      cedula,
      tipo_rol,
      usuario,
      password,
      password_c
    );

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#nombres_obligg").html("");
    $("#apellidos_obligg").html("");
    $("#correo_obligg").html("");
    $("#cedula_obligg").html("");
    $("#tipo_rol_obligg").html("");
    $("#usuario_obligg").html("");
    $("#password_obligg").html("");
    $("#password_c_obligg").html("");
  }

  if (password != password_c) {
    $("#password_obligg").html(" - Confime password");
    $("#password_c_obligg").html(" - Confime password");
    return swal.fire(
      "Password no coinciden",
      "Los password ingresados no coinciden",
      "warning"
    );
  } else {
    $("#password_obligg").html("");
    $("#password_c_obligg").html("");
  }

  if (!pass_usus) {
    return swal.fire(
      "Password débil",
      "Ingrese un password mas fuerte",
      "warning"
    );
  }

  if (!correo_usus) {
    return swal.fire(
      "Correo incorrecto",
      "Ingrese un correo correcto",
      "warning"
    );
  }

  //para scar la fecha para la foto
  var f = new Date();
  //este codigo me captura la extenion del archivo
  var extecion = foto.split(".").pop();
  //renombramoso el archivo con las hora minutos y segundos
  var nombrearchivo =
    "IMG" +
    f.getDate() +
    "" +
    (f.getMonth() + 1) +
    "" +
    f.getFullYear() +
    "" +
    f.getHours() +
    "" +
    f.getMinutes() +
    "" +
    f.getSeconds() +
    "." +
    extecion;

  var formdata = new FormData();
  var foto = $("#foto")[0].files[0];
  //est valores son como los que van en la data del ajax

  alerta = ["datos", "Se esta creando el usuario", "Creando usuario"];
  mostar_loader_datos(alerta);

  funcion = "registra_usuario";

  formdata.append("funcion", funcion);

  formdata.append("nombres", nombres);
  formdata.append("apellidos", apellidos);
  formdata.append("correo", correo);
  formdata.append("cedula", cedula);
  formdata.append("tipo_rol", tipo_rol);
  formdata.append("usuario", usuario);
  formdata.append("password", password);

  formdata.append("foto", foto);
  formdata.append("nombrearchivo", nombrearchivo);

  $.ajax({
    url: "../../controlador/usuario/usuario.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          Swal.fire({
            title: "",
            text: "El usuario se registro con exito",
            icon: "success",
            showCancelButton: true,
            showCancelButton: false,
            allowOutsideClick: false,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ok",
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload();
            }
          });
        } else if (resp == 2) {
          alerta = [
            "existe",
            "warning",
            "El correo " + correo + ", ya esta registrado",
          ];
          cerrar_loader_datos(alerta);
        } else if (resp == 3) {
          alerta = [
            "existe",
            "warning",
            "La cedula '" + cedula + "', ya esta registrado",
          ];
          cerrar_loader_datos(alerta);
        } else if (resp == 4) {
          alerta = [
            "existe",
            "warning",
            "El usuario '" + usuario + "', ya esta registrado",
          ];
          cerrar_loader_datos(alerta);
        }
      } else {
        alerta = ["error", "error", "Error al registrar el usuario"];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

function validar_registros(
  nombres,
  apellidos,
  correo,
  cedula,
  tipo_rol,
  usuario,
  password,
  password_c
) {
  if (nombres.length == 0 || nombres.trim() == "") {
    $("#nombres_obligg").html(" - Ingrese los nombres");
  } else {
    $("#nombres_obligg").html("");
  }

  if (apellidos.length == 0 || apellidos.trim() == "") {
    $("#apellidos_obligg").html(" - Ingrese los apellidos");
  } else {
    $("#apellidos_obligg").html("");
  }

  if (correo.length == 0 || correo.trim() == "") {
    $("#correo_obligg").html(" - Ingrese el correo");
  } else {
    $("#correo_obligg").html("");
  }

  if (cedula.length == 0 || cedula.trim() == "") {
    $("#cedula_obligg").html(" - Ingrese la cedula");
  } else {
    $("#cedula_obligg").html("");
  }

  if (tipo_rol.length == 0 || tipo_rol == 0) {
    $("#tipo_rol_obligg").html(" - Ingrese el rol");
  } else {
    $("#tipo_rol_obligg").html("");
  }

  if (usuario.length == 0 || usuario.trim() == "") {
    $("#usuario_obligg").html(" - Ingrese el usuario");
  } else {
    $("#usuario_obligg").html("");
  }

  if (password.length == 0 || password.trim() == "") {
    $("#password_obligg").html(" - Ingrese el password");
  } else {
    $("#password_obligg").html("");
  }

  if (password_c.length == 0 || password_c.trim() == "") {
    $("#password_c_obligg").html(" - Confirme el password");
  } else {
    $("#password_c_obligg").html("");
  }
}

////////////////
function listar_usuario() {
  funcion = "listar_usuario";
  tabla_usuario = $("#tabla_usuario").DataTable({
    ordering: true,
    paging: true,
    aProcessing: true,
    aServerSide: true,
    searching: { regex: true },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,

    ajax: {
      url: "../../controlador/usuario/usuario.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return `<button class='inactivar btn btn-danger' title='Inactivar el usuario'><i class='fa fa-times'></i></button>-<button class='editar btn btn-primary' title='Editar el usuario'><i class='fa fa-edit'></i></button>-<button class='photoo btn btn-warning' title='Editar la foto'><i class='fas fa-image'></i></button>`;
          } else {
            return `<button class='activar btn btn-success' title='Activar el usuario'><i class='fa fa-check'></i></button>-<button class='editar btn btn-primary' title='Editar el usuario'><i class='fa fa-edit'></i></button>-<button class='photoo btn btn-warning' title='Editar la foto'><i class='fas fa-image'></i></button>`;
          }
        },
        width: "100",
        targets: 0,
      },
      { data: "nombres", width: "100", targets: 0 },
      { data: "apellidos", width: "100", targets: 0 },
      { data: "rol", width: "100", targets: 0 },
      {
        data: "foto",
        render: function (data, type, row) {
          return (
            "<img style='border-radius: 50px;' src='../../" +
            data +
            "' width='45px' />"
          );
        },
      },
      { data: "correo" },
      { data: "cedula" },
      { data: "usuario" },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return "<span class='badge badge-success'>ACTIVO</span>";
          } else {
            return "<span class='badge badge-danger'>INACTIVO</span>";
          }
        },
      },
    ],

    language: {
      rows: "%d fila seleccionada",
      processing: "Tratamiento en curso...",
      search: "Buscar&nbsp;:",
      lengthMenu: "Agrupar en _MENU_ items",
      info: "Mostrando los item (_START_ al _END_) de un total _TOTAL_ items",
      infoEmpty: "No existe datos.",
      infoFiltered: "(filtrado de _MAX_ elementos en total)",
      infoPostFix: "",
      loadingRecords: "Cargando...",
      zeroRecords: "No se encontro resultados en tu busqueda",
      emptyTable: "No hay datos disponibles en la tabla",
      paginate: {
        first: "Primero",
        previous: "Anterior",
        next: "Siguiente",
        last: "Ultimo",
      },
      select: {
        rows: "%d fila seleccionada",
      },
      aria: {
        sortAscending: ": active para ordenar la columa en orden ascendente",
        sortDescending: ": active para ordenar la columna en orden descendente",
      },
    },

    select: true,
    responsive: "true",
    dom: "Bfrtilp",
    buttons: [
      {
        extend: "excelHtml5",
        text: "Excel",
        titleAttr: "Exportar a Excel",
        className: "badge badge-success greenlover",
      },
      {
        extend: "pdfHtml5",
        text: "PDF",
        titleAttr: "Exportar a PDF",
        className: "badge badge-danger redfule",
      },
      {
        extend: "print",
        text: "Imprimir",
        titleAttr: "Imprimir",
        className: "badge badge-primary azuldete",
      },
    ],
    order: [[0, "ASC"]],
  });

  //esto es para crearn un contador para la tabla este contador es automatico
  tabla_usuario.on("draw.dt", function () {
    var pageinfo = $("#tabla_usuario").DataTable().page.info();
    tabla_usuario
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_usuario").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_usuario.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_usuario.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_usuario.row(this).data();
  }
  var dato = 0;
  var id = data.usuario_id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del usuario se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_usuario(id, dato);
    }
  });
});

$("#tabla_usuario").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_usuario.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_usuario.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_usuario.row(this).data();
  }
  var dato = 1;
  var id = data.usuario_id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del usuario se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_usuario(id, dato);
    }
  });
});

function cambiar_estado_usuario(id, dato) {
  var res = "";
  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  funcion = "cambiar_estado_usuario";
  alerta = [
    "datos",
    "Se esta cambiando el estado a " + res + "",
    "Cambiando estado",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/usuario/usuario.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio"];
        cerrar_loader_datos(alerta);
        tabla_usuario.ajax.reload();
      }
    } else {
      alerta = ["error", "error", "No se pudo cambiar el estado"];
      cerrar_loader_datos(alerta);
    }
  });
}

$("#tabla_usuario").on("click", ".photoo", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_usuario.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_usuario.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_usuario.row(this).data();
  }

  var id = data.usuario_id;
  var foto = data.foto;

  $("#id_foto_producto").val(id);
  $("#foto_actu").val(foto);
  $("#foto_producto").attr("src", "../../" + foto);

  $("#modal_editar_photo").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar_photo").modal("show");
});

function editar_foto_usuario() {
  var id = document.getElementById("id_foto_producto").value;
  var foto = document.getElementById("foto_new").value;
  var ruta_actual = document.getElementById("foto_actu").value;

  if (foto == "" || ruta_actual.length == 0 || ruta_actual == "") {
    return swal.fire(
      "Mensaje de advertencia",
      "Ingrese una imagen para actualizar",
      "warning"
    );
  }

  var f = new Date();
  //este codigo me captura la extenion del archivo
  var extecion = foto.split(".").pop();
  //renombramoso el archivo con las hora minutos y segundos
  var nombrearchivo =
    "IMG" +
    f.getDate() +
    "" +
    (f.getMonth() + 1) +
    "" +
    f.getFullYear() +
    "" +
    f.getHours() +
    "" +
    f.getMinutes() +
    "" +
    f.getSeconds() +
    "." +
    extecion;

  var formdata = new FormData();
  var foto = $("#foto_new")[0].files[0];

  //est valores son como los que van en la data del ajax
  funcion = "editar_foto_usuario";
  formdata.append("funcion", funcion);
  formdata.append("id", id);
  formdata.append("foto", foto);
  formdata.append("ruta_actual", ruta_actual);
  formdata.append("nombrearchivo", nombrearchivo);

  alerta = [
    "datos",
    "Se esta editando la imagen del producto",
    "Editando imagen producto",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/usuario/usuario.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          document.getElementById("foto_new").value = "";
          tabla_usuario.ajax.reload();
          alerta = [
            "exito",
            "success",
            "La foto de usuario se edito con exito",
          ];
          cerrar_loader_datos(alerta);
          $("#modal_editar_photo").modal("hide");
        }
      } else {
        alerta = ["error", "error", "No se pudo editar la foto de usuario"];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

$("#tabla_usuario").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_usuario.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_usuario.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_usuario.row(this).data();
  }

  $("#id_usuario").val(data.usuario_id);
  $("#nombres").val(data.nombres);
  $("#apellidos").val(data.apellidos);
  $("#correo").val(data.correo);
  $("#cedula").val(data.cedula);
  $("#tipo_rol").val(data.rol_id).trigger("change");
  $("#usuario").val(data.usuario);

  $("#correo").css("border", "1px solid green");
  $("#email_correcto").html("");

  $("#cedula").css("border", "1px solid green");
  $("#cedula_empleado").html("");

  $("#nombres_obligg").html("");
  $("#apellidos_obligg").html("");
  $("#correo_obligg").html("");
  $("#cedula_obligg").html("");
  $("#tipo_rol_obligg").html("");
  $("#usuario_obligg").html("");

  correo_usus_edit = true;

  $("#modal_editar_usuario").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_editar_usuario").modal("show");
});

function editar_usuario() {

  var id = $("#id_usuario").val();
  var nombres = $("#nombres").val();
  var apellidos = $("#apellidos").val();
  var correo = $("#correo").val();
  var cedula = $("#cedula").val();
  var tipo_rol = $("#tipo_rol").val();
  var usuario = $("#usuario").val();

  if (
    nombres.length == 0 ||
    nombres.trim() == "" ||
    apellidos.length == 0 ||
    apellidos.trim() == "" ||
    correo.length == 0 ||
    correo.trim() == "" ||
    cedula.length == 0 ||
    cedula.trim() == "" ||
    tipo_rol.length == 0 ||
    tipo_rol == 0 ||
    usuario.length == 0 ||
    usuario.trim() == "" 
  ) {
    validar_registros_edit(
      nombres,
      apellidos,
      correo,
      cedula,
      tipo_rol,
      usuario
    );

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#nombres_obligg").html("");
    $("#apellidos_obligg").html("");
    $("#correo_obligg").html("");
    $("#cedula_obligg").html("");
    $("#tipo_rol_obligg").html("");
    $("#usuario_obligg").html("");
  }

  if (!correo_usus_edit) {
    return swal.fire(
      "Correo incorrecto",
      "Ingrese un correo correcto",
      "warning"
    );
  }

  funcion = "editando_usuario";
  alerta = ["datos", "Se esta editando el usuario", "Editando usuario"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/usuario/usuario.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      nombres: nombres,
      apellidos: apellidos,
      correo: correo,
      cedula: cedula,
      tipo_rol: tipo_rol,
      usuario: usuario
    },
  }).done(function (resp) {

    if (resp > 0) {
      if (resp == 1) {
        
        alerta = [
          "exito",
          "success",
          "El usuario se edito con exito",
        ];
        cerrar_loader_datos(alerta);
        $("#modal_editar_usuario").modal("hide");
        tabla_usuario.ajax.reload();
        
      } else if (resp == 2) {
        alerta = [
          "existe",
          "warning",
          "El correo " + correo + ", ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      } else if (resp == 3) {
        alerta = [
          "existe",
          "warning",
          "La cedula '" + cedula + "', ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      } else if (resp == 4) {
        alerta = [
          "existe",
          "warning",
          "El usuario '" + usuario + "', ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = ["error", "error", "Error al registrar el usuario"];
      cerrar_loader_datos(alerta);
    }

  });
}

function validar_registros_edit(
  nombres,
  apellidos,
  correo,
  cedula,
  tipo_rol,
  usuario
) {
  if (nombres.length == 0 || nombres.trim() == "") {
    $("#nombres_obligg").html(" - Ingrese los nombres");
  } else {
    $("#nombres_obligg").html("");
  }

  if (apellidos.length == 0 || apellidos.trim() == "") {
    $("#apellidos_obligg").html(" - Ingrese los apellidos");
  } else {
    $("#apellidos_obligg").html("");
  }

  if (correo.length == 0 || correo.trim() == "") {
    $("#correo_obligg").html(" - Ingrese el correo");
  } else {
    $("#correo_obligg").html("");
  }

  if (cedula.length == 0 || cedula.trim() == "") {
    $("#cedula_obligg").html(" - Ingrese la cedula");
  } else {
    $("#cedula_obligg").html("");
  }

  if (tipo_rol.length == 0 || tipo_rol == 0) {
    $("#tipo_rol_obligg").html(" - Ingrese el rol");
  } else {
    $("#tipo_rol_obligg").html("");
  }

  if (usuario.length == 0 || usuario.trim() == "") {
    $("#usuario_obligg").html(" - Ingrese el usuario");
  } else {
    $("#usuario_obligg").html("");
  }
}
