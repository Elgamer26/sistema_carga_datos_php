var tabla_actividad,
  tabla_trabajador,
  tbala_asignacion,
  tabla_cintas,
  tabla_lote,
  tabla_produccion,
  tabla_racimos,
  tabla_desecho;

////////////////
function listar_actividad() {
  funcion = "listar_actividad";
  tabla_actividad = $("#tabla_actividad").DataTable({
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
      url: "../../controlador/produccion/produccion.php",
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
      { data: "actividad" },
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
  tabla_actividad.on("draw.dt", function () {
    var pageinfo = $("#tabla_actividad").DataTable().page.info();
    tabla_actividad
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

function registra_actividad() {
  var nombre = $("#nombre_actividad").val();

  if (nombre.length == 0 || nombre.trim() == "") {
    $("#nombre_actividad_obligg").html(" - Ingrese la actividad");
    return swal.fire("Campo vacios", "Debe ingresar la actividad", "warning");
  } else {
    $("#nombre_actividad_obligg").html("");
  }

  funcion = "registra_actividad";
  alerta = ["datos", "Se esta creando la actividad", "Creando actividad"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/produccion/produccion.php",
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
        $("#nombre_actividad").val("");
      } else if (resp == 2) {
        alerta = [
          "existe",
          "warning",
          "La actividad '" + nombre + "', ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al registrar la actividad, falla en la matrix",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

$("#tabla_actividad").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_actividad.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_actividad.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_actividad.row(this).data();
  }
  var dato = 0;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado de la actividad se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_actividad(id, dato);
    }
  });
});

$("#tabla_actividad").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_actividad.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_actividad.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_actividad.row(this).data();
  }
  var dato = 1;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado de la actividad se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_actividad(id, dato);
    }
  });
});

function cambiar_estado_actividad(id, dato) {
  var res = "";
  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  funcion = "cambiar_estado_actividad";
  alerta = [
    "datos",
    "Se esta cambiando el estado a " + res + "",
    "Cambiando estado",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio"];
        cerrar_loader_datos(alerta);
        tabla_actividad.ajax.reload();
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

$("#tabla_actividad").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_actividad.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_actividad.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_actividad.row(this).data();
  }

  document.getElementById("id_actividad").value = data.id;
  document.getElementById("actividad").value = data.actividad;

  $("#actividad_edit_obligg").html("");

  $("#modal_eitar_actividad").modal({ backdrop: "static", keyboard: false });
  $("#modal_eitar_actividad").modal("show");
});

function editar_actividad() {
  var id = $("#id_actividad").val();
  var nombre = $("#actividad").val();

  if (nombre.length == 0 || nombre.trim() == "") {
    $("#actividad_edit_obligg").html(" - Ingrese actividad");
    return swal.fire("Campo vacios", "Debe ingresar la actividad", "warning");
  } else {
    $("#actividad_edit_obligg").html("");
  }

  funcion = "editar_actividad";
  alerta = ["datos", "Se esta editando la actividad", "Editando la actividad"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      nombre: nombre,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["exito", "success", "La actividad se edito con exito"];
        cerrar_loader_datos(alerta);
        $("#modal_eitar_actividad").modal("hide");
        tabla_actividad.ajax.reload();
      } else if (resp == 2) {
        alerta = [
          "existe",
          "warning",
          "La actividad '" + nombre + "', ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al editar la actividad, falla en la matrix",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

///////////// trabajadores
function registra_trabajador() {
  var nombres = $("#nombres").val();
  var apellidos = $("#apellidos").val();
  var fecha = $("#fecha_nacimiento").val();
  var cedula = $("#numero_docu").val();
  var direccions = $("#direccions").val();
  var telefono = $("#telefono_empleado").val();
  var correo = $("#correo_empleado").val();
  var sexo = $("#sexo").val();

  if (
    nombres.length == 0 ||
    nombres.trim() == "" ||
    apellidos.length == 0 ||
    apellidos.trim() == "" ||
    fecha.length == 0 ||
    fecha.trim() == "" ||
    cedula.length == 0 ||
    cedula.trim() == "" ||
    direccions.length == 0 ||
    direccions.trim() == "" ||
    telefono.length == 0 ||
    telefono.trim() == "" ||
    correo.length == 0 ||
    correo.trim() == ""
  ) {
    validar_registro_empleado(
      nombres,
      apellidos,
      fecha,
      cedula,
      direccions,
      telefono,
      correo
    );

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#nombre_oblig").html("");
    $("#apellido_obliga").html("");
    $("#fecah_obliga").html("");
    $("#dcoumento_obliga").html("");
    $("#direccion_obliga").html("");
    $("#telefono_obliga").html("");
    $("#correo_obliga").html("");
  }

  alerta = ["datos", "Se esta creando el usuario", "Creando usuario"];
  mostar_loader_datos(alerta);

  funcion = "registra_trabajador";
  var formdata = new FormData();
  formdata.append("funcion", funcion);
  formdata.append("nombres", nombres);
  formdata.append("apellidos", apellidos);
  formdata.append("fecha", fecha);
  formdata.append("cedula", cedula);
  formdata.append("direccions", direccions);
  formdata.append("telefono", telefono);
  formdata.append("correo", correo);
  formdata.append("sexo", sexo);

  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          alerta = ["exito", "success", "El empleado se registro con exito"];
          cerrar_loader_datos(alerta);

          $("#nombres").val("");
          $("#apellidos").val("");
          $("#fecha_nacimiento").val("");
          $("#numero_docu").val("");
          $("#direccions").val("");
          $("#telefono_empleado").val("");
          $("#correo_empleado").val("");
        } else {
          alerta = [
            "existe",
            "warning",
            "La cedula " + cedula + ", ya esta registrado",
          ];
          cerrar_loader_datos(alerta);
        }
      } else {
        alerta = ["error", "error", "Error al registrar el empleado"];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

function validar_registro_empleado(
  nombres,
  apellidos,
  fecha,
  cedula,
  direccions,
  telefono,
  correo
) {
  if (nombres.length == 0 || nombres.trim() == "") {
    $("#nombre_oblig").html(" - Ingrese los nombres");
  } else {
    $("#nombre_oblig").html("");
  }

  if (apellidos.length == 0 || apellidos.trim() == "") {
    $("#apellido_obliga").html(" - Ingrese los apellidos");
  } else {
    $("#apellido_obliga").html("");
  }

  if (fecha.length == 0 || fecha.trim() == "") {
    $("#fecah_obliga").html(" - Ingrese la fecha");
  } else {
    $("#fecah_obliga").html("");
  }

  if (cedula.length == 0 || cedula.trim() == "") {
    $("#dcoumento_obliga").html(" - Ingrese la cedula");
  } else {
    $("#dcoumento_obliga").html("");
  }

  if (direccions.length == 0 || direccions.trim() == "") {
    $("#direccion_obliga").html(" - Ingrese la dirección");
  } else {
    $("#direccion_obliga").html("");
  }

  if (telefono.length == 0 || telefono.trim() == "") {
    $("#telefono_obliga").html(" - Ingrese el telefono");
  } else {
    $("#telefono_obliga").html("");
  }

  if (correo.length == 0 || correo.trim() == "") {
    $("#correo_obliga").html(" - Ingrese el correo");
  } else {
    $("#correo_obliga").html("");
  }
}

function listar_trabajador() {
  funcion = "listar_trabajador";
  tabla_trabajador = $("#tabla_trabajador").DataTable({
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
      url: "../../controlador/produccion/produccion.php",
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
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el rol'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el trabajador'><i class='fa fa-edit'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el rol'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el trabajador'><i class='fa fa-edit'></i></button>`;
          }
        },
      },
      { data: "nombres" },
      { data: "apellidos" },
      { data: "cedula" },
      { data: "telefono" },
      { data: "sexo" },
      { data: "correo" },
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
  tabla_trabajador.on("draw.dt", function () {
    var pageinfo = $("#tabla_trabajador").DataTable().page.info();
    tabla_trabajador
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_trabajador").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_trabajador.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_trabajador.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_trabajador.row(this).data();
  }
  var dato = 0;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del trabajador se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_trabajador(id, dato);
    }
  });
});

$("#tabla_trabajador").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_trabajador.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_trabajador.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_trabajador.row(this).data();
  }
  var dato = 1;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del trabajador se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_trabajador(id, dato);
    }
  });
});

function cambiar_estado_trabajador(id, dato) {
  var res = "";
  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  funcion = "cambiar_estado_trabajador";
  alerta = [
    "datos",
    "Se esta cambiando el estado a " + res + "",
    "Cambiando estado",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio"];
        cerrar_loader_datos(alerta);
        tabla_trabajador.ajax.reload();
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

$("#tabla_trabajador").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_trabajador.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_trabajador.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_trabajador.row(this).data();
  }

  $("#id_trabajador").val(data.id);
  $("#nombres").val(data.nombres);
  $("#apellidos").val(data.apellidos);
  $("#fecha_nacimiento").val(data.fecha);
  $("#numero_docu").val(data.cedula);
  $("#direccions").val(data.direccions);
  $("#telefono_empleado").val(data.telefono);
  $("#correo_empleado").val(data.correo);
  $("#sexo").val(data.sexo);

  $("#nombre_oblig").html("");
  $("#apellido_obliga").html("");
  $("#fecah_obliga").html("");
  $("#dcoumento_obliga").html("");
  $("#direccion_obliga").html("");
  $("#telefono_obliga").html("");
  $("#correo_obliga").html("");

  $("#correo_empleado").css("border", "1px solid green");
  $("#email_correcto").html("");

  $("#modal_editar_trabajador").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar_trabajador").modal("show");
});

function editar_trabajador() {
  var id = $("#id_trabajador").val();
  var nombres = $("#nombres").val();
  var apellidos = $("#apellidos").val();
  var fecha = $("#fecha_nacimiento").val();
  var cedula = $("#numero_docu").val();
  var direccions = $("#direccions").val();
  var telefono = $("#telefono_empleado").val();
  var correo = $("#correo_empleado").val();
  var sexo = $("#sexo").val();

  if (
    nombres.length == 0 ||
    nombres.trim() == "" ||
    apellidos.length == 0 ||
    apellidos.trim() == "" ||
    fecha.length == 0 ||
    fecha.trim() == "" ||
    cedula.length == 0 ||
    cedula.trim() == "" ||
    direccions.length == 0 ||
    direccions.trim() == "" ||
    telefono.length == 0 ||
    telefono.trim() == "" ||
    correo.length == 0 ||
    correo.trim() == ""
  ) {
    validar_editar_empleado(
      nombres,
      apellidos,
      fecha,
      cedula,
      direccions,
      telefono,
      correo
    );

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#nombre_oblig").html("");
    $("#apellido_obliga").html("");
    $("#fecah_obliga").html("");
    $("#dcoumento_obliga").html("");
    $("#direccion_obliga").html("");
    $("#telefono_obliga").html("");
    $("#correo_obliga").html("");
  }

  alerta = ["datos", "Se esta editando el usuario", "Editando usuario"];
  mostar_loader_datos(alerta);

  funcion = "editar_trabajador";
  var formdata = new FormData();
  formdata.append("funcion", funcion);
  formdata.append("id", id);
  formdata.append("nombres", nombres);
  formdata.append("apellidos", apellidos);
  formdata.append("fecha", fecha);
  formdata.append("cedula", cedula);
  formdata.append("direccions", direccions);
  formdata.append("telefono", telefono);
  formdata.append("correo", correo);
  formdata.append("sexo", sexo);

  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          alerta = ["exito", "success", "El empleado se edito con exito"];
          cerrar_loader_datos(alerta);
          $("#modal_editar_trabajador").modal("hide");
          tabla_trabajador.ajax.reload();
        } else {
          alerta = [
            "existe",
            "warning",
            "La cedula " + cedula + ", ya esta registrado",
          ];
          cerrar_loader_datos(alerta);
        }
      } else {
        alerta = ["error", "error", "Error al editar el empleado"];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

function validar_editar_empleado(
  nombres,
  apellidos,
  fecha,
  cedula,
  direccions,
  telefono,
  correo
) {
  if (nombres.length == 0 || nombres.trim() == "") {
    $("#nombre_oblig").html(" - Ingrese los nombres");
  } else {
    $("#nombre_oblig").html("");
  }

  if (apellidos.length == 0 || apellidos.trim() == "") {
    $("#apellido_obliga").html(" - Ingrese los apellidos");
  } else {
    $("#apellido_obliga").html("");
  }

  if (fecha.length == 0 || fecha.trim() == "") {
    $("#fecah_obliga").html(" - Ingrese la fecha");
  } else {
    $("#fecah_obliga").html("");
  }

  if (cedula.length == 0 || cedula.trim() == "") {
    $("#dcoumento_obliga").html(" - Ingrese la cedula");
  } else {
    $("#dcoumento_obliga").html("");
  }

  if (direccions.length == 0 || direccions.trim() == "") {
    $("#direccion_obliga").html(" - Ingrese la dirección");
  } else {
    $("#direccion_obliga").html("");
  }

  if (telefono.length == 0 || telefono.trim() == "") {
    $("#telefono_obliga").html(" - Ingrese el telefono");
  } else {
    $("#telefono_obliga").html("");
  }

  if (correo.length == 0 || correo.trim() == "") {
    $("#correo_obliga").html(" - Ingrese el correo");
  } else {
    $("#correo_obliga").html("");
  }
}

///////////// asignacion actividades del trabajador
function registra_asignacion() {
  var empleado = $("#datos_empleado").val();
  var actividad = $("#tipo_actividad").val();
  var fecha = $("#fecha_asiga").val();
  var costo = $("#costo_acivdad").val();

  if (
    empleado.length == 0 ||
    empleado == "0" ||
    actividad.length == 0 ||
    actividad == "0" ||
    fecha.length == 0 ||
    fecha.trim() == "" ||
    costo.length == 0 ||
    costo.trim() == ""
  ) {
    validar_registro_asignacion(empleado, actividad, fecha, costo);

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#costo_obliga").html("");
    $("#tipoo_obliga").html("");
    $("#fecha_obliga").html("");
    $("#empleado_obliga").html("");
  }

  alerta = ["datos", "Se esta creando la asignación", "Creando asignación"];
  mostar_loader_datos(alerta);

  funcion = "registra_asignacion";
  var formdata = new FormData();
  formdata.append("funcion", funcion);
  formdata.append("empleado", empleado);
  formdata.append("actividad", actividad);
  formdata.append("fecha", fecha);
  formdata.append("costo", costo);

  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          alerta = ["exito", "success", "La asignación se registro con exito"];
          cerrar_loader_datos(alerta);

          $("#costo_acivdad").val("");
          listar_actividad_combo();
          listar_trabajador_combo();
        } else {
          alerta = [
            "existe",
            "warning",
            "El empleado ya tiene asignada esta actividad",
          ];
          cerrar_loader_datos(alerta);
        }
      } else {
        alerta = ["error", "error", "Error al registrar la asignación"];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

function validar_registro_asignacion(empleado, actividad, fecha, costo) {
  if (empleado.length == 0 || empleado == "0") {
    $("#empleado_obliga").html(" - Seleccione un trabajador");
  } else {
    $("#empleado_obliga").html("");
  }

  if (actividad.length == 0 || actividad == "0") {
    $("#tipoo_obliga").html(" - Seleccione la actividad");
  } else {
    $("#tipoo_obliga").html("");
  }

  if (fecha.length == 0 || fecha.trim() == "") {
    $("#fecha_obliga").html(" - Ingrese la fecha");
  } else {
    $("#fecha_obliga").html("");
  }

  if (costo.length == 0 || costo.trim() == "") {
    $("#costo_obliga").html(" - Ingrese el valor");
  } else {
    $("#costo_obliga").html("");
  }
}

function listar_asignacion() {
  funcion = "listar_asignacion";
  tbala_asignacion = $("#tbala_asignacion").DataTable({
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
      url: "../../controlador/produccion/produccion.php",
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
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el rol'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el trabajador'><i class='fa fa-edit'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el rol'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el trabajador'><i class='fa fa-edit'></i></button>`;
          }
        },
      },
      { data: "trabajador" },
      { data: "actividad" },
      { data: "fecha" },
      { data: "valor" },
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
  tbala_asignacion.on("draw.dt", function () {
    var pageinfo = $("#tbala_asignacion").DataTable().page.info();
    tbala_asignacion
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tbala_asignacion").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tbala_asignacion.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tbala_asignacion.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tbala_asignacion.row(this).data();
  }
  var dato = 0;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado de la asignación se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_asignacion(id, dato);
    }
  });
});

$("#tbala_asignacion").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tbala_asignacion.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tbala_asignacion.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tbala_asignacion.row(this).data();
  }
  var dato = 1;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado de la asignación se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_asignacion(id, dato);
    }
  });
});

function cambiar_estado_asignacion(id, dato) {
  var res = "";
  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  funcion = "cambiar_estado_asignacion";
  alerta = [
    "datos",
    "Se esta cambiando el estado a " + res + "",
    "Cambiando estado",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio"];
        cerrar_loader_datos(alerta);
        tbala_asignacion.ajax.reload();
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

$("#tbala_asignacion").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tbala_asignacion.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tbala_asignacion.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tbala_asignacion.row(this).data();
  }

  $("#id_asignacion").val(data.id);
  $("#datos_empleado").val(data.trabajador_id).trigger("change");
  $("#tipo_actividad").val(data.actividad_id).trigger("change");
  $("#costo_acivdad").val(data.valor);
  $("#fecha_asiga").val(data.fecha);

  $("#costo_obliga").html("");
  $("#tipoo_obliga").html("");
  $("#fecha_obliga").html("");
  $("#empleado_obliga").html("");

  $("#modal_editar_asignacion").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar_asignacion").modal("show");
});

function editar_asignacion() {
  var id = $("#id_asignacion").val();
  var empleado = $("#datos_empleado").val();
  var actividad = $("#tipo_actividad").val();
  var fecha = $("#fecha_asiga").val();
  var costo = $("#costo_acivdad").val();

  if (
    empleado.length == 0 ||
    empleado == "0" ||
    actividad.length == 0 ||
    actividad == "0" ||
    fecha.length == 0 ||
    fecha.trim() == "" ||
    costo.length == 0 ||
    costo.trim() == ""
  ) {
    validar_editar_asignacion(empleado, actividad, fecha, costo);

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#costo_obliga").html("");
    $("#tipoo_obliga").html("");
    $("#fecha_obliga").html("");
    $("#empleado_obliga").html("");
  }

  alerta = ["datos", "Se esta editando la asignación", "Editando asignación"];
  mostar_loader_datos(alerta);

  funcion = "editar_asignacion";
  var formdata = new FormData();
  formdata.append("funcion", funcion);
  formdata.append("empleado", empleado);
  formdata.append("actividad", actividad);
  formdata.append("fecha", fecha);
  formdata.append("costo", costo);
  formdata.append("id", id);

  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          alerta = ["exito", "success", "La asignación se edito con exito"];
          cerrar_loader_datos(alerta);

          tbala_asignacion.ajax.reload();
          $("#modal_editar_asignacion").modal("hide");
        } else {
          alerta = [
            "existe",
            "warning",
            "El empleado ya tiene asignada esta actividad",
          ];
          cerrar_loader_datos(alerta);
        }
      } else {
        alerta = ["error", "error", "Error al editar la asignación"];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

function validar_editar_asignacion(empleado, actividad, fecha, costo) {
  if (empleado.length == 0 || empleado == "0") {
    $("#empleado_obliga").html(" - Seleccione un trabajador");
  } else {
    $("#empleado_obliga").html("");
  }

  if (actividad.length == 0 || actividad == "0") {
    $("#tipoo_obliga").html(" - Seleccione la actividad");
  } else {
    $("#tipoo_obliga").html("");
  }

  if (fecha.length == 0 || fecha.trim() == "") {
    $("#fecha_obliga").html(" - Ingrese la fecha");
  } else {
    $("#fecha_obliga").html("");
  }

  if (costo.length == 0 || costo.trim() == "") {
    $("#costo_obliga").html(" - Ingrese el valor");
  } else {
    $("#costo_obliga").html("");
  }
}

////////////////
function listar_tipo_cintas() {
  funcion = "listar_tipo_cintas";
  tabla_cintas = $("#tabla_cintas").DataTable({
    ordering: true,
    paging: true,
    aProcessing: true,
    aServerSide: true,
    searching: { regex: true },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 25,
    destroy: true,
    async: false,
    processing: true,

    ajax: {
      url: "../../controlador/produccion/produccion.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      {
        render: function (data, type, row) {
          return `<button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el rol'><i class='fa fa-edit'></i></button>`;
        },
      },
      { data: "semana" },
      {
        data: "color",
        render: function (data, type, row) {
          return (
            "<input type='color' class='form-control' value='" +
            data +
            "' disabled>"
          );
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
    order: [[0, "ASC"]],
  });

  //esto es para crearn un contador para la tabla este contador es automatico
  tabla_cintas.on("draw.dt", function () {
    var pageinfo = $("#tabla_cintas").DataTable().page.info();
    tabla_cintas
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_cintas").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_cintas.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_cintas.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_cintas.row(this).data();
  }

  $("#id_tipo_cinta").val(data.id);
  $("#color_cinta").val(data.color);

  $("#modal_eitar_tipo_cinta").modal({ backdrop: "static", keyboard: false });
  $("#modal_eitar_tipo_cinta").modal("show");
});

function editar_color() {
  var id = $("#id_tipo_cinta").val();
  var color = $("#color_cinta").val();

  funcion = "editar_color";
  alerta = ["datos", "Se esta editando color de cinta", "Color cinta"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      color: color,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "Se edito el color de cinta con exito"];
        cerrar_loader_datos(alerta);

        tabla_cintas.ajax.reload();

        $("#modal_eitar_tipo_cinta").modal("hide");
      }
    } else {
      alerta = ["error", "error", "No se pudo editar el color"];
      cerrar_loader_datos(alerta);
    }
  });
}

//////////////// lotes
function guardar_lotes() {
  var lote = $("#lote").val();
  var hectarea = 0;

  $("#taba_hectareas tbody#tbody_taba_hectareasl tr").each(function () {
    hectarea++;
  });

  if (hectarea == 0) {
    return Swal.fire(
      "Mensaje de advertencia",
      "No hay hectareas en detalle",
      "warning"
    );
  }

  if (lote.length == 0 || lote.trim() == "") {
    $("#lote_obligg").html(" - Ingrese el lote");
    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos",
      "warning"
    );
  } else {
    $("#lote_obligg").html("");
  }

  funcion = "registrar_lotes";
  alerta = ["datos", "Se esta creando el lote", "Creando lote."];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      lote: lote,
    },
  }).done(function (response) {
    if (response > 0) {
      registrar_detalle_hectreas(parseInt(response));
    } else {
      alerta = ["error", "error", "No se pudo crear el lote"];
      cerrar_loader_datos(alerta);
    }
  });
}

function registrar_detalle_hectreas(id) {
  var count = 0;
  var arrego_hectarea = new Array();

  $("#taba_hectareas tbody#tbody_taba_hectareasl tr").each(function () {
    arrego_hectarea.push($(this).find("td").eq(0).text());
    count++;
  });

  var hectarea = arrego_hectarea.toString();

  if (count == 0) {
    return false;
  }

  funcion = "registrar_detalle_hectarea";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      hectarea: hectarea,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["exito", "success", "El lote se creo con exito"];
        cerrar_loader_datos(alerta);

        $("#lote").val("");
        $("#tbody_taba_hectareasl").empty();
      }
    } else {
      alerta = ["error", "error", "No se pudo crear el detalle de lote"];
      cerrar_loader_datos(alerta);
    }
  });
}

function listar_lotes() {
  funcion = "listar_lotes";
  tabla_lote = $("#tabla_lote").DataTable({
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
      url: "../../controlador/produccion/produccion.php",
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
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el Oftalmólogo'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el Oftalmólogo'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='hectarea btn btn-warning' title='ver hectareas'><i class='fa fa-h-square'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el Oftalmólogo'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el Oftalmólogo'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='hectarea btn btn-warning' title='ver hectareas'><i class='fa fa-h-square'></i></button>`;
          }
        },
      },
      { data: "nombre" },
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
        className: "btn btn-success greenlover",
      },
      {
        extend: "pdfHtml5",
        text: "PDF",
        titleAttr: "Exportar a PDF",
        className: "btn btn-danger redfule",
      },
      {
        extend: "print",
        text: "Imprimir",
        titleAttr: "Imprimir",
        className: "btn btn-primary azuldete",
      },
    ],
    order: [[0, "desc"]],
  });

  //esto es para crearn un contador para la tabla este contador es automatico
  tabla_lote.on("draw.dt", function () {
    var pageinfo = $("#tabla_lote").DataTable().page.info();
    tabla_lote
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_lote").on("click", ".hectarea", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_lote.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_lote.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_lote.row(this).data();
  }

  var id = data.id;

  funcion = "cargra_detalle_lote";
  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    var data = JSON.parse(resp);
    var llenat = "";
    var count = 0;
    var estado = "";
    data["data"].forEach((row) => {
      if (row["estado"] == 1) {
        estado = "<button class='btn btn-success'>Disponible</button>";
      } else {
        estado = "<button class='btn btn-warning'>Ocupado</button>";
      }

      count++;
      llenat += `<tr>
                <td>${count}</td> 
                <td>${row["nombre"]}</td>  
                <td>${estado}</td>   
                </tr>`;

      $("#tbody_taba_hectareasl").html(llenat);
    });
  });

  $("#modal_hectareas_ver").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_hectareas_ver").modal("show");
});

$("#tabla_lote").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_lote.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_lote.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_lote.row(this).data();
  }

  $("#id_lote").val(data.id);
  $("#lote").val(data.nombre);

  $("#modal_editar_lote").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_editar_lote").modal("show");
});

function editar_lotes() {
  var id = $("#id_lote").val();
  var lote = $("#lote").val();

  if (lote.length == 0 || lote.trim() == "") {
    $("#lote_obligg").html(" - Ingrese el lote");
    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos",
      "warning"
    );
  } else {
    $("#lote_obligg").html("");
  }

  funcion = "editar_lotes";
  alerta = ["datos", "Se esta editando el lote", "Editando lote."];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      lote: lote,
      id: id,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "El lote se edito con exito"];
        cerrar_loader_datos(alerta);
        tabla_lote.ajax.reload();
        $("#modal_editar_lote").modal("hide");
      } else {
        alerta = ["existe", "warning", "El lote " + lote + ", ya existe"];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = ["error", "error", "No se pudo crear el lote"];
      cerrar_loader_datos(alerta);
    }
  });
}

$("#tabla_lote").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_lote.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_lote.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_lote.row(this).data();
  }
  var dato = 0;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del lote se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_lote(id, dato);
    }
  });
});

$("#tabla_lote").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_lote.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_lote.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_lote.row(this).data();
  }
  var dato = 1;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del lote se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_lote(id, dato);
    }
  });
});

function cambiar_estado_lote(id, dato) {
  var res = "";
  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  funcion = "estado_lote";
  alerta = [
    "datos",
    "Se esta cambiando el estado a " + res + "",
    "Cambiando estado",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio"];
        cerrar_loader_datos(alerta);
        tabla_lote.ajax.reload();
      }
    } else {
      alerta = ["error", "error", "No se pudo cambiar el estado"];
      cerrar_loader_datos(alerta);
    }
  });
}

//////////// para la produccion
function guardar_produccion_nueva() {
  Swal.fire({
    title: "Guardar la producción?",
    text: "La producción se guardará!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, guardar!",
  }).then((result) => {
    if (result.isConfirmed) {
      registrar_produccion();
    }
  });
}

function registrar_produccion() {
  var produccion = $("#produccion").val();
  var f_i = $("#fecha_i").val();
  var f_f = $("#fecha_f").val();
  var lote_id = $("#lote_id").val();
  var count = 0;
  var acti = 0;
  var herra = 0;
  var insu = 0;

  if (produccion == "0" || produccion.length == 0) {
    $("#produccion_obligg").html(" - Ingrese el nombre de producción");
    return swal.fire(
      "Campo vacios",
      "Debe ingresar el nombre de producción",
      "warning"
    );
  } else {
    $("#produccion_obligg").html("");
  }

  if (f_i >= f_f) {
    $("#fecha_i_obligg").html("XXX");
    $("#fecha_f_obligg").html("XXX");
    return swal.fire(
      "Error de fechas",
      "Debe ingresar fechas correctas",
      "warning"
    );
  } else {
    $("#fecha_f_obligg").html("");
    $("#fecha_i_obligg").html("");
  }

  if (lote_id == "0" || lote_id.length == 0) {
    $("#lote_id_obligg").html(" - Seleccione un lote");
    return swal.fire("No hay lote", "Debe seleccionar un lote", "warning");
  } else {
    $("#lote_id_obligg").html("");
  }

  $("#tabla_hectareas tbody#tbody_detalle_hectarea tr").each(function () {
    let check = $(this).find("#checkfull").is(":checked");
    if (check) {
      count++;
    }
  });

  if (count == 0) {
    return swal.fire(
      "No hay hectareas",
      "Debe marcar las hectareas del lote a produccir - HECTAREAS",
      "warning"
    );
  }

  $("#tabla_detalle_atividad tbody#tbody_detalle_atividad tr").each(
    function () {
      acti++;
    }
  );

  if (acti == 0) {
    return swal.fire(
      "No hay actividad",
      "Debe ingresar las actividades en la tabla - ACTVIDADES",
      "warning"
    );
  }

  $("#tabla_detalle_material tbody#tbody_detalle_material tr").each(
    function () {
      herra++;
    }
  );

  if (herra == 0) {
    return swal.fire(
      "No hay herramienta",
      "Debe ingresar las herramientas en la tabla - HERRAMIENTAS",
      "warning"
    );
  }

  $("#tabla_detalle_insumo tbody#tbody_detalle_insumo tr").each(function () {
    insu++;
  });

  if (insu == 0) {
    return swal.fire(
      "No hay insumo",
      "Debe ingresar los insumos en la tabla - INSUMOS",
      "warning"
    );
  }

  funcion = "registrar_produccion_save";
  alerta = ["datos", "Se esta creando la producción", "Creando producción."];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      produccion: produccion,
      f_i: f_i,
      f_f: f_f,
      lote_id: lote_id,
    },
  }).done(function (response) {
    if (response > 0) {
      detalle_hectreas_produccion(parseInt(response));
    } else {
      alerta = ["error", "error", "No se pudo crear la producción"];
      cerrar_loader_datos(alerta);
    }
  });
}

function detalle_hectreas_produccion(id) {
  var count = 0;
  var arrego_id = new Array();

  $("#tabla_hectareas tbody#tbody_detalle_hectarea tr").each(function () {
    let check = $(this).find("#checkfull").is(":checked");
    if (check) {
      count++;
      arrego_id.push($(this).find("td").eq(0).text());
    }
  });

  var hectarea = arrego_id.toString();

  if (count == 0) {
    return false;
  }

  funcion = "detalle_hectreas_produccion";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      hectarea: hectarea,
    },
  }).done(function (resp) {
    if (resp > 0) {
      detalle_actividades_produccion(parseInt(id));
    } else {
      alerta = ["error", "error", "No se pudo crear el registro hectarea"];
      cerrar_loader_datos(alerta);
    }
  });
}

function detalle_actividades_produccion(id) {
  var count = 0;
  var arrego_id = new Array();

  $("#tabla_detalle_atividad tbody#tbody_detalle_atividad tr").each(
    function () {
      count++;
      arrego_id.push($(this).find("td").eq(0).text());
    }
  );

  var actividad = arrego_id.toString();

  if (count == 0) {
    return false;
  }

  funcion = "detalle_actividades_produccion";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      actividad: actividad,
    },
  }).done(function (resp) {
    if (resp > 0) {
      detalle_herraienta_produccion(parseInt(id));
    } else {
      alerta = ["error", "error", "No se pudo crear el registro actividad"];
      cerrar_loader_datos(alerta);
    }
  });
}

function detalle_herraienta_produccion(id) {
  var count = 0;
  var arrego_id = new Array();
  var arrego_cantidad = new Array();

  $("#tabla_detalle_material tbody#tbody_detalle_material tr").each(
    function () {
      count++;
      arrego_id.push($(this).find("td").eq(0).text());
      arrego_cantidad.push($(this).find("td").eq(2).text());
    }
  );

  var herramienta = arrego_id.toString();
  var cantidad = arrego_cantidad.toString();

  if (count == 0) {
    return false;
  }

  funcion = "detalle_herraienta_produccion";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      herramienta: herramienta,
      cantidad: cantidad,
    },
  }).done(function (resp) {
    if (resp > 0) {
      detalle_insumo_produccion(parseInt(id));
    } else {
      alerta = ["error", "error", "No se pudo crear el registro herramienta"];
      cerrar_loader_datos(alerta);
    }
  });
}

function detalle_insumo_produccion(id) {
  var count = 0;
  var arrego_id = new Array();
  var arrego_cantidad = new Array();

  $("#tabla_detalle_insumo tbody#tbody_detalle_insumo tr").each(function () {
    count++;
    arrego_id.push($(this).find("td").eq(0).text());
    arrego_cantidad.push($(this).find("td").eq(2).text());
  });

  var insumo = arrego_id.toString();
  var cantidad = arrego_cantidad.toString();

  if (count == 0) {
    return false;
  }

  funcion = "detalle_insumo_produccion";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      insumo: insumo,
      cantidad: cantidad,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["exito", "success", "La producción se registro con exito"];
        cerrar_loader_datos(alerta);

        $("#tbody_detalle_hectarea").empty();
        $("#tbody_detalle_insumo").empty();
        $("#tbody_detalle_material").empty();
        $("#tbody_detalle_atividad").empty();
        $("#produccion").val("");
      }
    } else {
      alerta = ["error", "error", "No se pudo crear el registro insumo"];
      cerrar_loader_datos(alerta);
    }
  });
}

function listar_produccion() {
  funcion = "listar_produccion";
  tabla_produccion = $("#tabla_produccion").DataTable({
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
      url: "../../controlador/produccion/produccion.php",
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
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='cancelar la produccion'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='ver btn btn-warning' title='ver produccion'><i class='fa fa-eye'></i></button>`;
          } else if (data == 0) {
            return `<button style='font-size:13px;' type='button' class='ver btn btn-warning' title='ver produccion'><i class='fa fa-eye'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='ver btn btn-warning' title='ver produccion'><i class='fa fa-eye'></i></button>`;
          }
        },
      },
      { data: "nombre" },
      { data: "f_i" },
      { data: "f_f" },
      { data: "lote" },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return "<span class='badge badge-warning'>INICIADO</span>";
          } else if (data == 0) {
            return "<span class='badge badge-danger'>CANCELADO</span>";
          } else {
            return "<span class='badge badge-success'>FINALIZADO</span>";
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
  tabla_produccion.on("draw.dt", function () {
    var pageinfo = $("#tabla_produccion").DataTable().page.info();
    tabla_produccion
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_produccion").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_produccion.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_produccion.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_produccion.row(this).data();
  }
  var dato = 0;
  var id = data.id;

  Swal.fire({
    title: "Cancelar produccioón?",
    text: "La producción se cancelara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cancelar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cancelar_produccion(id, dato);
    }
  });
});

function cancelar_produccion(id, dato) {
  funcion = "cancelar_produccion";
  alerta = [
    "datos",
    "Se esta cancelando la producción",
    "Cancelando la producción",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "La producción se cancelo con extio"];
        cerrar_loader_datos(alerta);
        tabla_produccion.ajax.reload();
      }
    } else {
      alerta = ["error", "error", "No se pudo cancelar la producción"];
      cerrar_loader_datos(alerta);
    }
  });
}

$("#tabla_produccion").on("click", ".ver", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_produccion.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_produccion.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_produccion.row(this).data();
  }
  var id = data.id;

  alerta = [
    "datos",
    "Se esta cargando el detalle produccion",
    ".:Cargando la produccion:.",
  ];
  mostar_loader_datos(alerta);

  cargar_detalle_produccion_lote(parseInt(id));
  cargar_detalle_produccion_cintass(parseInt(id));
  cargar_detalle_produccion_racimos(parseInt(id));
  cargar_detalle_produccion_desechos(parseInt(id));
});

/// para las cintas
function cargar_detalle_produccion_cintass(id) {
  funcion = "cargar_detalle_encinte_produccion";
  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    if (resp != 0) {
      var data = JSON.parse(resp);
      var llenat = "";
      var count = 0;
      data["data"].forEach((row) => {
        count++;
        llenat += `<tr>
              <td>${count}</td>  
              <td>${row["semana"]}</td> 
              <td style="text-align: center;"><input type='color' value='${row["color"]}' disabled></td>
              <td>${row["fecha"]}</td> 
              <td>${row["detalle"]}</td>                
              </tr>`;

        $("#tbody_tabala_semanas").html(llenat);
      });
    } else {
      $("#tbody_tabala_semanas").empty();
    }
  });
}

/// para los racimos
function cargar_detalle_produccion_racimos(id) {
  funcion = "cargar_detalle_produccion_racimos";
  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    if (resp != 0) {
      var data = JSON.parse(resp);
      var llenat = "";
      var count = 0;
      data["data"].forEach((row) => {
        count++;
        llenat += `<tr>
              <td>${count}</td>  
              <td>${row["fecha"]}</td>  
              <td>${row["cantidad"]}</td> 
              <td>${row["tipo"]}</td>                
              </tr>`;

        $("#tbody_detalle_racimos").html(llenat);
      });
    } else {
      $("#tbody_detalle_racimos").empty();
    }
  });
}

/// para los desechos
function cargar_detalle_produccion_desechos(id) {
  funcion = "cargar_detalle_produccion_desechos";
  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    if (resp != 0) {
      var data = JSON.parse(resp);
      var llenat = "";
      var count = 0;
      data["data"].forEach((row) => {
        count++;
        llenat += `<tr>
              <td>${count}</td>  
              <td>${row["fecha"]}</td>  
              <td>${row["cantidad"]}</td> 
              <td>${row["tipo"]}</td>                
              </tr>`;

        $("#tbody_detalle_desechos").html(llenat);
      });
    } else {
      $("#tbody_detalle_desechos").empty();
    }
  });
}

function cargar_detalle_produccion_lote(id) {
  funcion = "cargar_detalle_produccion_lote";
  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    let count = 0;
    var data = JSON.parse(resp);
    var llenat = "";
    data["data"].forEach((row) => {
      count++;
      llenat += `<tr>
                <td>${count}</td>
                <td>${row["nombre"]}</td>                          
                </tr>`;

      $("#tbody_detalle_hectarea").html(llenat);
    });

    cargar_detalle_produccion_actividades(parseInt(id));
  });
}

function cargar_detalle_produccion_actividades(id) {
  funcion = "cargar_detalle_produccion_actividades";
  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    let count = 0;
    var data = JSON.parse(resp);
    var llenat = "";
    data["data"].forEach((row) => {
      count++;
      llenat += `<tr>
                <td>${count}</td>
                <td>${row["empleado"]}</td>   
                <td>${row["actividad"]}</td>                          
                </tr>`;

      $("#tbody_detalle_atividad").html(llenat);
    });

    cargar_detalle_produccion_herramientas(parseInt(id));
  });
}

function cargar_detalle_produccion_herramientas(id) {
  funcion = "cargar_detalle_produccion_herramientas";
  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    let count = 0;
    var data = JSON.parse(resp);
    var llenat = "";
    data["data"].forEach((row) => {
      count++;
      llenat += `<tr>
                <td>${count}</td>
                <td>${row["herramientas"]}</td>   
                <td>${row["cantidad"]}</td>                          
                </tr>`;

      $("#tbody_detalle_material").html(llenat);
    });
    cargar_detalle_produccion_insumo(parseInt(id));
  });
}

function cargar_detalle_produccion_insumo(id) {
  funcion = "cargar_detalle_produccion_insumo";
  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    alerta = [" ", " ", " "];
    cerrar_loader_datos(alerta);

    let count = 0;
    var data = JSON.parse(resp);
    var llenat = "";
    data["data"].forEach((row) => {
      count++;
      llenat += `<tr>
                <td>${count}</td>
                <td>${row["insumo"]}</td>   
                <td>${row["cantidad"]}</td>                          
                </tr>`;

      $("#tbody_detalle_insumo").html(llenat);
    });

    $("#modal_detalle_produccion").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modal_detalle_produccion").modal("show");
  });
}

/// registro de encinte
function registro_encinte() {
  Swal.fire({
    title: "Guardar el registro?",
    text: "El registro se guardará!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, guardar!",
  }).then((result) => {
    if (result.isConfirmed) {
      guardar_encinte_produccion();
    }
  });
}

function guardar_encinte_produccion() {
  var id = $("#prodcuciion_id").val();
  var numero = $("#n_semana").val();
  var fecha = $("#fecha").val();
  var detalle = $("#detalle").val();
  var n = parseInt(numero) + 1;

  if (
    id == "0" ||
    numero.length == 0 ||
    fecha.length == 0 ||
    detalle.length == 0 ||
    detalle.trim() == ""
  ) {
    validar_registro_cintas(id, numero, fecha, detalle);
    return swal.fire(
      "Campo vacios",
      "Debe ingresar datos en los campos",
      "warning"
    );
  } else {
    $("#prodcuciion_id_oblig").html("");
    $("#n_semana_oblig").html("");
    $("#fecha_oblig").html("");
    $("#detalle_oblig").html("");
  }

  funcion = "guardar_encinte_produccion";
  alerta = ["datos", "Se esta creando el encinte", "Creando encinte."];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      numero: numero,
      fecha: fecha,
      detalle: detalle,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        if (parseInt(n) == 8) {
          alerta = [
            "exito",
            "success",
            "La producción a finalizado, encinte de 8 semana",
          ];
          cerrar_loader_datos(alerta);
          $("#n_semana").val("");
          $("#detalle").val("");
          $("#tbody_tabala_semanas").empty();
          return listar_produccion_combo();
        } else {
          alerta = ["exito", "success", "El encinte se registro con exito"];
          cerrar_loader_datos(alerta);
          semanas_produccion(id);
          detalle_encinte_produccion(id);
          $("#detalle").val("");
        }
      }
    } else {
      alerta = ["error", "error", "No se pudo crear la cinta"];
      cerrar_loader_datos(alerta);
    }
  });
}

function validar_registro_cintas(id, numero, fecha, detalle) {
  if (id == "0") {
    $("#prodcuciion_id_oblig").html(" - Seleccione una producción");
  } else {
    $("#prodcuciion_id_oblig").html("");
  }

  if (numero.length == 0) {
    $("#n_semana_oblig").html(" - No hay semana");
  } else {
    $("#n_semana_oblig").html("");
  }

  if (fecha.length == 0) {
    $("#fecha_oblig").html(" - Ingrese la fecha");
  } else {
    $("#fecha_oblig").html("");
  }

  if (detalle.length == 0 || detalle.trim() == "") {
    $("#detalle_oblig").html(" - Ingrese el detalle");
  } else {
    $("#detalle_oblig").html("");
  }
}

function eliminar_detalle_cinta(id, idpro) {
  Swal.fire({
    title: "Eliminar detalle",
    text: "Desea eliminar detalle de cinta??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!!",
  }).then((result) => {
    if (result.value) {
      funcion = "eliminar_detalle_cinta";
      $.ajax({
        url: "../../controlador/produccion/produccion.php",
        type: "POST",
        data: {
          funcion: funcion,
          id: id,
          idpro: idpro,
        },
      }).done(function (response) {
        if (response == 1) {
          alerta = ["exito", "success", "Detalle eliminado con exito"];
          cerrar_loader_datos(alerta);
          semanas_produccion(idpro);
          detalle_encinte_produccion(idpro);
        } else {
          alerta = ["error", "error", "No se pudo eliminado con el detalle"];
          cerrar_loader_datos(alerta);
        }
      });
    }
  });
}

///// registro racimos
function guardr_racimos() {
  Swal.fire({
    title: "Guardar el registro?",
    text: "El registro se guardará!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, guardar!",
  }).then((result) => {
    if (result.isConfirmed) {
      registro_frutasa();
    }
  });
}

function registro_frutasa() {
  var id = $("#prodcuciion_id").val();
  var fecha = $("#fecha_ras_des").val();
  var tipo = $("#tipo_ses").val();
  var numero = $("#numero_ra").val();

  if (
    id == "0" ||
    tipo == "0" ||
    fecha.length == 0 ||
    numero.length == 0 ||
    numero.trim() == ""
  ) {
    validar_regitro_frutass(id, fecha, tipo, numero);
    return swal.fire("Campo vacios", "Debe ingresar todos lo datos", "warning");
  } else {
    $("#prodcuciion_id_oblig").html(""); 
    $("#tipo_ses_oblig").html(""); 
    $("#fecha_ras_des_oblig").html(""); 
    $("#cantidad_oblig").html("");
  }

  funcion = "registro_frutasa";
  alerta = ["datos", "Se esta registrando la fruta", "Registrando fruta."];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      fecha: fecha,
      tipo: tipo,
      numero: numero,
    },
  }).done(function (response) {
    if (response > 0) {
     if(response == 1){
      alerta = ["exito", "success", "Registro guardado con exito"];
      cerrar_loader_datos(alerta);
      $("#numero_ra").val("");
     }
    } else {
      alerta = ["error", "error", "No se pudo crear el registro"];
      cerrar_loader_datos(alerta);
    }
  });
}

function validar_regitro_frutass(id, fecha, tipo, numero) {
  if (id == "0") {
    $("#prodcuciion_id_oblig").html(" - Seleccine la producción");
  } else {
    $("#prodcuciion_id_oblig").html("");
  }

  if (tipo == "0") {
    $("#tipo_ses_oblig").html(" - Seleccine el tipo");
  } else {
    $("#tipo_ses_oblig").html("");
  }

  if (fecha.length == 0) {
    $("#fecha_ras_des_oblig").html(" - Ingrese la fecha");
  } else {
    $("#fecha_ras_des_oblig").html("");
  }

  if (numero.length == 0 || numero.trim() == "") {
    $("#cantidad_oblig").html(" - Ingrese la cantidad");
  } else {
    $("#cantidad_oblig").html("");
  }
}

function listar_racimos_produccion() {
  funcion = "listar_racimos_produccion";
  tabla_racimos = $("#tabla_racimos_list").DataTable({
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
      url: "../../controlador/produccion/produccion.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      { 
        render: function (data, type, row) { 
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el rol'><i class='fa fa-times'></i></button>`;
          
        },
      },
      { data: "lote" },
      { data: "fecha" },
      { data: "cantidad" },
      { 
        render: function (data, type, row) { 
            return "<span class='badge badge-warning'>Racimo</span>";
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
  tabla_racimos.on("draw.dt", function () {
    var pageinfo = $("#tabla_racimos_list").DataTable().page.info();
    tabla_racimos
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_racimos_list").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_racimos.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_racimos.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_racimos.row(this).data();
  } 
  var id = data.id;

  Swal.fire({
    title: "Eliminiar el racimo?",
    text: "El racimo se eliminará del listado!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      eliminar_racimos_list(id);
    }
  });
});

function eliminar_racimos_list(id) {
  funcion = "eliminar_racimos_list"; 
  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: { id: id, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "El racimo se elimino con extio"];
        cerrar_loader_datos(alerta);
        tabla_racimos.ajax.reload();
      }
    } else {
      alerta = ["error", "error", "No se pudo eliminar el racimo"];
      cerrar_loader_datos(alerta);
    }
  });
}

function listar_desecho_produccion() {
  funcion = "listar_desecho_produccion";
  tabla_desecho = $("#tabla_desechos_list").DataTable({
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
      url: "../../controlador/produccion/produccion.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      { 
        render: function (data, type, row) { 
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el rol'><i class='fa fa-times'></i></button>`;
          
        },
      },
      { data: "lote" },
      { data: "fecha" },
      { data: "cantidad" },
      { 
        render: function (data, type, row) { 
            return "<span class='badge badge-danger'>Desecho</span>";
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
  tabla_desecho.on("draw.dt", function () {
    var pageinfo = $("#tabla_desechos_list").DataTable().page.info();
    tabla_desecho
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_desechos_list").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_desecho.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_desecho.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_desecho.row(this).data();
  } 
  var id = data.id;

  Swal.fire({
    title: "Eliminiar el desecho?",
    text: "El desecho se eliminará del listado!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      eliminar_desecho_list(id);
    }
  });
});

function eliminar_desecho_list(id) {
  funcion = "eliminar_desecho_list"; 
  $.ajax({
    url: "../../controlador/produccion/produccion.php",
    type: "POST",
    data: { id: id, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "El desecho se elimino con extio"];
        cerrar_loader_datos(alerta);
        tabla_desecho.ajax.reload();
      }
    } else {
      alerta = ["error", "error", "No se pudo eliminar el desecho"];
      cerrar_loader_datos(alerta);
    }
  });
}
