var funcion,
  tabla_tipo_i,
  tabla_insumo,
  tabla_tipo_e,
  table_herramienta,
  tabla_proveedor,
  insumos_disponibles,
  tabla_compras_insumos,
  herramienta_disponibles,
  tabla_compras_herramienta;

function registra_tipo_insumo() {
  var nombre = $("#nombre_tipo_i").val();

  if (nombre.length == 0 || nombre.trim() == "") {
    $("#nombre_tipo_i_obligg").html(" - Ingrese el tipo de insumo");
    return swal.fire("Campo vacios", "Debe ingresar el nombre", "warning");
  } else {
    $("#nombre_tipo_i_obligg").html("");
  }

  funcion = "registrar_tipo_insumo";
  alerta = ["datos", "Se esta creando el tipo", "Creando tipo"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    data: {
      funcion: funcion,
      nombre: nombre,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["exito", "success", "El tipo se registro con exito"];
        cerrar_loader_datos(alerta);
        $("#nombre_tipo_i").val("");
      } else if (resp == 2) {
        alerta = [
          "existe",
          "warning",
          "El tipo '" + nombre + "', ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al registrar el tipo, falla en la matrix",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

////////////////
function listar_tipo_insumo() {
  funcion = "listar_tipo_insumo";
  tabla_tipo_i = $("#tabla_tipo_i").DataTable({
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
      url: "../../controlador/inventario/inventario.php",
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
      { data: "tipo_insumo" },
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
  tabla_tipo_i.on("draw.dt", function () {
    var pageinfo = $("#tabla_tipo_i").DataTable().page.info();
    tabla_tipo_i
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_tipo_i").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_tipo_i.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_tipo_i.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_tipo_i.row(this).data();
  }
  var dato = 0;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del tipo se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_tipo_i(id, dato);
    }
  });
});

$("#tabla_tipo_i").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_tipo_i.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_tipo_i.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_tipo_i.row(this).data();
  }
  var dato = 1;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del tipo se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_tipo_i(id, dato);
    }
  });
});

function cambiar_estado_tipo_i(id, dato) {
  var res = "";
  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  funcion = "estado_tipo_insumo";
  alerta = [
    "datos",
    "Se esta cambiando el estado a " + res + "",
    "Cambiando estado",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio"];
        cerrar_loader_datos(alerta);
        tabla_tipo_i.ajax.reload();
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

$("#tabla_tipo_i").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_tipo_i.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_tipo_i.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_tipo_i.row(this).data();
  }

  document.getElementById("id_tipoi").value = data.id;
  document.getElementById("nombre_tipoi_e").value = data.tipo_insumo;

  $("#modal_eitar_tipoi").modal({ backdrop: "static", keyboard: false });
  $("#modal_eitar_tipoi").modal("show");
});

function editar_tipo_i() {
  var id = $("#id_tipoi").val();
  var nombre = $("#nombre_tipoi_e").val();

  if (nombre.length == 0 || nombre.trim() == "") {
    $("#nombre_tipoi_e_obligg").html(" - Ingrese nombre del tipo");
    return swal.fire(
      "Campo vacios",
      "Debe ingresar el nombre del tipo",
      "warning"
    );
  } else {
    $("#nombre_tipoi_e_obligg").html("");
  }

  funcion = "editar_tipo_i";
  alerta = ["datos", "Se esta editando el tipo", "Editando el tipo"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      nombre: nombre,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["exito", "success", "El tipo se edito con exito"];
        cerrar_loader_datos(alerta);
        $("#modal_eitar_tipoi").modal("hide");
        tabla_tipo_i.ajax.reload();
      } else if (resp == 2) {
        alerta = [
          "existe",
          "warning",
          "El tipo '" + nombre + "', ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al editar el tipo, falla en la matrix",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

////////////////////////
function listar_tipo_insumo_COMBO() {
  funcion = "listar_tipo_insumo_COMBO";
  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    data: {
      funcion: funcion,
    },
  }).done(function (response) {
    var data = JSON.parse(response);
    var cadena = "<option value=''> --- Ingrese tipo de insumo --- </option>";
    if (data.length > 0) {
      //bucle para extraer los datos del rol
      for (var i = 0; i < data.length; i++) {
        cadena +=
          "<option value='" + data[i][0] + "'> " + data[i][1] + " </option>";
      }
      //aqui concadenamos al id del select
      $("#tipo_insumo").html(cadena);
    } else {
      cadena += "<option value=''>No hay datos de tipo</option>";
      $("#tipo_insumo").html(cadena);
    }
  });
}

function registra_insumo() {
  var codigo = $("#codigo_insumoo").val();
  var nombre = $("#nombre_insumo").val();
  var marca = $("#marca_insumo").val();
  var tipo = $("#tipo_insumo").val();
  var precio = $("#precio_compra").val();
  var cantidad = $("#cantidad_insumo").val();
  var descripcion = $("#decripcion_mterial").val();
  /// foto
  var foto = $("#foto").val();

  if (
    codigo.length == 0 ||
    codigo.trim() == "" ||
    nombre.length == 0 ||
    nombre.trim() == "" ||
    marca.length == 0 ||
    marca.trim() == "" ||
    tipo.length == 0 ||
    tipo.trim() == "" ||
    precio.length == 0 ||
    precio == 0 ||
    cantidad.length == 0 ||
    cantidad.trim() == "" ||
    descripcion.length == 0 ||
    descripcion.trim() == ""
  ) {
    validar_registros_insumo(
      codigo,
      nombre,
      marca,
      tipo,
      precio,
      cantidad,
      descripcion
    );

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#codigo_insumoo_obligg").html("");
    $("#nombre_insumo_obligg").html("");
    $("#marca_insumo_obligg").html("");
    $("#tipo_insumo_obligg").html("");
    $("#precio_compra_obligg").html("");
    $("#cantidad_insumo_obligg").html("");
    $("#descripc_obliga").html("");
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

  alerta = ["datos", "Se esta creando el insumo", "Creando insumo"];
  mostar_loader_datos(alerta);

  funcion = "registra_insumo";
  formdata.append("funcion", funcion);

  formdata.append("codigo", codigo);
  formdata.append("nombre", nombre);
  formdata.append("marca", marca);
  formdata.append("tipo", tipo);
  formdata.append("precio", precio);
  formdata.append("cantidad", cantidad);
  formdata.append("descripcion", descripcion);

  formdata.append("foto", foto);
  formdata.append("nombrearchivo", nombrearchivo);

  $.ajax({
    url: "../../controlador/inventario/inventario.php",
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
            text: "El insumo se registro con exito",
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
            "El codigo " + codigo + ", ya esta registrado",
          ];
          cerrar_loader_datos(alerta);
        }
      } else {
        alerta = ["error", "error", "Error al registrar el insumo"];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

function validar_registros_insumo(
  codigo,
  nombre,
  marca,
  tipo,
  precio,
  cantidad,
  descripcion
) {
  if (codigo.length == 0 || codigo.trim() == "") {
    $("#codigo_insumoo_obligg").html(" - Ingrese el codigo");
  } else {
    $("#codigo_insumoo_obligg").html("");
  }

  if (nombre.length == 0 || nombre.trim() == "") {
    $("#nombre_insumo_obligg").html(" - Ingrese el nombre");
  } else {
    $("#nombre_insumo_obligg").html("");
  }

  if (marca.length == 0 || marca.trim() == "") {
    $("#marca_insumo_obligg").html(" - Ingrese la marca");
  } else {
    $("#marca_insumo_obligg").html("");
  }

  if (tipo.length == 0 || tipo.trim() == "") {
    $("#tipo_insumo_obligg").html(" - Ingrese el tipo");
  } else {
    $("#tipo_insumo_obligg").html("");
  }

  if (precio.length == 0 || precio == 0) {
    $("#precio_compra_obligg").html(" - Ingrese el precio");
  } else {
    $("#precio_compra_obligg").html("");
  }

  if (cantidad.length == 0 || cantidad.trim() == "") {
    $("#cantidad_insumo_obligg").html(" - Ingrese la cantidad");
  } else {
    $("#cantidad_insumo_obligg").html("");
  }

  if (descripcion.length == 0 || descripcion.trim() == "") {
    $("#descripc_obliga").html(" - Ingrese la descripción");
  } else {
    $("#descripc_obliga").html("");
  }
}

////////////////
function llistar_tabla_insumo() {
  funcion = "llistar_tabla_insumo";
  tabla_insumo = $("#table_insumo").DataTable({
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
      url: "../../controlador/inventario/inventario.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      { data: "codigo" },
      { data: "nombre" },
      { data: "marca" },
      { data: "tipo_insumo" },
      {
        data: "ruta",
        render: function (data, type, row) {
          return (
            "<img style='border-radius: 50px;' src='../../" +
            data +
            "' width='45px' />"
          );
        },
      },
      { data: "precio" },
      { data: "cantidad" },
      { data: "descripcion" },
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
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el insumo'><i class='fa fa-times'></i></button>-<button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el insumo'><i class='fa fa-edit'></i></button>-<button class='photoo btn btn-warning' title='Editar la foto'><i class='fas fa-image'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el insumo'><i class='fa fa-check'></i></button>-<button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el insumo'><i class='fa fa-edit'></i></button>-<button class='photoo btn btn-warning' title='Editar la foto'><i class='fas fa-image'></i></button>`;
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
  tabla_insumo.on("draw.dt", function () {
    var pageinfo = $("#table_insumo").DataTable().page.info();
    tabla_insumo
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#table_insumo").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_insumo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_insumo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_insumo.row(this).data();
  }
  var dato = 0;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del insumo se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_insumo(id, dato);
    }
  });
});

$("#table_insumo").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_insumo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_insumo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_insumo.row(this).data();
  }
  var dato = 1;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del insumo se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_insumo(id, dato);
    }
  });
});

function cambiar_estado_insumo(id, dato) {
  var res = "";
  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  funcion = "cambiar_estado_insumo";
  alerta = [
    "datos",
    "Se esta cambiando el estado a " + res + "",
    "Cambiando estado",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio"];
        cerrar_loader_datos(alerta);
        tabla_insumo.ajax.reload();
      }
    } else {
      alerta = ["error", "error", "No se pudo cambiar el estado"];
      cerrar_loader_datos(alerta);
    }
  });
}

$("#table_insumo").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_insumo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_insumo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_insumo.row(this).data();
  }

  $("#id_insumo").val(data.id);
  $("#codigo_insumoo").val(data.codigo);
  $("#nombre_insumo").val(data.nombre);
  $("#marca_insumo").val(data.marca);
  $("#tipo_insumo").val(data.tipo).trigger("change");
  $("#precio_compra").val(data.precio);
  $("#cantidad_insumo").val(data.cantidad);
  $("#decripcion_mterial").val(data.descripcion);

  $("#codigo_insumoo_obligg").html("");
  $("#nombre_insumo_obligg").html("");
  $("#marca_insumo_obligg").html("");
  $("#tipo_insumo_obligg").html("");
  $("#precio_compra_obligg").html("");
  $("#cantidad_insumo_obligg").html("");
  $("#descripc_obliga").html("");

  $("#modal_editar_insumo").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_editar_insumo").modal("show");
});

function editar_insumo() {
  var id = $("#id_insumo").val();
  var codigo = $("#codigo_insumoo").val();
  var nombre = $("#nombre_insumo").val();
  var marca = $("#marca_insumo").val();
  var tipo = $("#tipo_insumo").val();
  var precio = $("#precio_compra").val();
  var cantidad = $("#cantidad_insumo").val();
  var descripcion = $("#decripcion_mterial").val();

  if (
    codigo.length == 0 ||
    codigo.trim() == "" ||
    nombre.length == 0 ||
    nombre.trim() == "" ||
    marca.length == 0 ||
    marca.trim() == "" ||
    tipo.length == 0 ||
    tipo.trim() == "" ||
    precio.length == 0 ||
    precio == 0 ||
    cantidad.length == 0 ||
    cantidad.trim() == "" ||
    descripcion.length == 0 ||
    descripcion.trim() == ""
  ) {
    validar_editar_insumo(
      codigo,
      nombre,
      marca,
      tipo,
      precio,
      cantidad,
      descripcion
    );

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#codigo_insumoo_obligg").html("");
    $("#nombre_insumo_obligg").html("");
    $("#marca_insumo_obligg").html("");
    $("#tipo_insumo_obligg").html("");
    $("#precio_compra_obligg").html("");
    $("#cantidad_insumo_obligg").html("");
    $("#descripc_obliga").html("");
  }

  var formdata = new FormData();

  alerta = ["datos", "Se esta editando el insumo", "Editando insumo"];
  mostar_loader_datos(alerta);

  funcion = "editar_insumo";
  formdata.append("funcion", funcion);

  formdata.append("id", id);
  formdata.append("codigo", codigo);
  formdata.append("nombre", nombre);
  formdata.append("marca", marca);
  formdata.append("tipo", tipo);
  formdata.append("precio", precio);
  formdata.append("cantidad", cantidad);
  formdata.append("descripcion", descripcion);

  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          alerta = ["exito", "success", "El insumo se edito con exito"];
          cerrar_loader_datos(alerta);
          tabla_insumo.ajax.reload();

          $("#modal_editar_insumo").modal("hide");
        } else if (resp == 2) {
          alerta = [
            "existe",
            "warning",
            "El codigo '" + codigo + "', ya esta registrado",
          ];
          cerrar_loader_datos(alerta);
        }
      } else {
        alerta = ["error", "error", "Error al registrar el insumo"];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

function validar_editar_insumo(
  codigo,
  nombre,
  marca,
  tipo,
  precio,
  cantidad,
  descripcion
) {
  if (codigo.length == 0 || codigo.trim() == "") {
    $("#codigo_insumoo_obligg").html(" - Ingrese el codigo");
  } else {
    $("#codigo_insumoo_obligg").html("");
  }

  if (nombre.length == 0 || nombre.trim() == "") {
    $("#nombre_insumo_obligg").html(" - Ingrese el nombre");
  } else {
    $("#nombre_insumo_obligg").html("");
  }

  if (marca.length == 0 || marca.trim() == "") {
    $("#marca_insumo_obligg").html(" - Ingrese la marca");
  } else {
    $("#marca_insumo_obligg").html("");
  }

  if (tipo.length == 0 || tipo.trim() == "") {
    $("#tipo_insumo_obligg").html(" - Ingrese el tipo");
  } else {
    $("#tipo_insumo_obligg").html("");
  }

  if (precio.length == 0 || precio == 0) {
    $("#precio_compra_obligg").html(" - Ingrese el precio");
  } else {
    $("#precio_compra_obligg").html("");
  }

  if (cantidad.length == 0 || cantidad.trim() == "") {
    $("#cantidad_insumo_obligg").html(" - Ingrese la cantidad");
  } else {
    $("#cantidad_insumo_obligg").html("");
  }

  if (descripcion.length == 0 || descripcion.trim() == "") {
    $("#descripc_obliga").html(" - Ingrese la descripción");
  } else {
    $("#descripc_obliga").html("");
  }
}

$("#table_insumo").on("click", ".photoo", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_insumo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_insumo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_insumo.row(this).data();
  }

  var id = data.id;
  var foto = data.ruta;

  $("#id_foto_insumo").val(id);
  $("#foto_actu_insumo").val(foto);
  $("#foto_insumo_edit").attr("src", "../../" + foto);

  $("#modal_editar_photo_insumo").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_editar_photo_insumo").modal("show");
});

function editar_foto_insumo() {
  var id = document.getElementById("id_foto_insumo").value;
  var foto = document.getElementById("foto_new_i").value;
  var ruta_actual = document.getElementById("foto_actu_insumo").value;

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
  var foto = $("#foto_new_i")[0].files[0];

  //est valores son como los que van en la data del ajax
  funcion = "editar_foto_insumo";
  formdata.append("funcion", funcion);
  formdata.append("id", id);
  formdata.append("foto", foto);
  formdata.append("ruta_actual", ruta_actual);
  formdata.append("nombrearchivo", nombrearchivo);

  alerta = [
    "datos",
    "Se esta editando la imagen del insumo",
    "Editando imagen insumo",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          document.getElementById("foto_new_i").value = "";
          tabla_insumo.ajax.reload();
          alerta = ["exito", "success", "La foto de insumo se edito con exito"];
          cerrar_loader_datos(alerta);
          $("#modal_editar_photo_insumo").modal("hide");
        }
      } else {
        alerta = ["error", "error", "No se pudo editar la foto de insumo"];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

/////////////// herramienta
function registra_tipo_herramienta() {
  var nombre = $("#nombre_tipo_e").val();

  if (nombre.length == 0 || nombre.trim() == "") {
    $("#nombre_tipo_e_obligg").html(" - Ingrese el tipo de herramienta");
    return swal.fire("Campo vacios", "Debe ingresar el nombre", "warning");
  } else {
    $("#nombre_tipo_e_obligg").html("");
  }

  funcion = "registrar_tipo_herramienta";
  alerta = ["datos", "Se esta creando el tipo", "Creando tipo"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    data: {
      funcion: funcion,
      nombre: nombre,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["exito", "success", "El tipo se registro con exito"];
        cerrar_loader_datos(alerta);
        $("#nombre_tipo_e").val("");
      } else if (resp == 2) {
        alerta = [
          "existe",
          "warning",
          "El tipo '" + nombre + "', ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al registrar el tipo, falla en la matrix",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function listar_tipo_herramienta() {
  funcion = "listar_tipo_herramienta";
  tabla_tipo_e = $("#tabla_tipo_e").DataTable({
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
      url: "../../controlador/inventario/inventario.php",
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
      { data: "tipo_herramienta" },
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
  tabla_tipo_e.on("draw.dt", function () {
    var pageinfo = $("#tabla_tipo_e").DataTable().page.info();
    tabla_tipo_e
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_tipo_e").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_tipo_e.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_tipo_e.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_tipo_e.row(this).data();
  }
  var dato = 0;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del tipo se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_tipo_e(id, dato);
    }
  });
});

$("#tabla_tipo_e").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_tipo_e.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_tipo_e.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_tipo_e.row(this).data();
  }
  var dato = 1;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del tipo se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_tipo_e(id, dato);
    }
  });
});

function cambiar_estado_tipo_e(id, dato) {
  var res = "";
  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  funcion = "cambiar_estado_tipo_e";
  alerta = [
    "datos",
    "Se esta cambiando el estado a " + res + "",
    "Cambiando estado",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio"];
        cerrar_loader_datos(alerta);
        tabla_tipo_e.ajax.reload();
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

$("#tabla_tipo_e").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_tipo_e.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_tipo_e.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_tipo_e.row(this).data();
  }

  document.getElementById("id_tipoe").value = data.id;
  document.getElementById("nombre_tipo_h").value = data.tipo_herramienta;

  $("#modal_editar_t_h").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar_t_h").modal("show");
});

function editar_tipo_h() {
  var id = $("#id_tipoe").val();
  var nombre = $("#nombre_tipo_h").val();

  if (nombre.length == 0 || nombre.trim() == "") {
    $("#nombre_tipo_h_obligg").html(" - Ingrese nombre del tipo");
    return swal.fire(
      "Campo vacios",
      "Debe ingresar el nombre del tipo",
      "warning"
    );
  } else {
    $("#nombre_tipo_h_obligg").html("");
  }

  funcion = "editar_tipo_h";
  alerta = ["datos", "Se esta editando el tipo", "Editando el tipo"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      nombre: nombre,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["exito", "success", "El tipo se edito con exito"];
        cerrar_loader_datos(alerta);
        $("#modal_editar_t_h").modal("hide");
        tabla_tipo_e.ajax.reload();
      } else if (resp == 2) {
        alerta = [
          "existe",
          "warning",
          "El tipo '" + nombre + "', ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al editar el tipo, falla en la matrix",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

////////////////////////
function listar_tipo_herramienta_COMBO() {
  funcion = "listar_tipo_herramienta_COMBO";
  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    data: {
      funcion: funcion,
    },
  }).done(function (response) {
    var data = JSON.parse(response);
    var cadena = "<option value=''> --- Ingrese tipo de herramienta --- </option>";
    if (data.length > 0) {
      //bucle para extraer los datos del rol
      for (var i = 0; i < data.length; i++) {
        cadena +=
          "<option value='" + data[i][0] + "'> " + data[i][1] + " </option>";
      }
      //aqui concadenamos al id del select
      $("#tipo_herramienta").html(cadena);
    } else {
      cadena += "<option value=''>No hay datos de tipo</option>";
      $("#tipo_herramienta").html(cadena);
    }
  });
}

function registra_herramienta() {
  var codigo = $("#codigo_herramientao").val();
  var nombre = $("#nombre_herramienta").val();
  var marca = $("#marca_herramienta").val();
  var tipo = $("#tipo_herramienta").val();
  var precio = $("#precio_compra").val();
  var cantidad = $("#cantidad_herramienta").val();
  var descripcion = $("#decripcion_herramienta").val();
  /// foto
  var foto = $("#foto").val();

  if (
    codigo.length == 0 ||
    codigo.trim() == "" ||
    nombre.length == 0 ||
    nombre.trim() == "" ||
    marca.length == 0 ||
    marca.trim() == "" ||
    tipo.length == 0 ||
    tipo.trim() == "" ||
    precio.length == 0 ||
    precio == 0 ||
    cantidad.length == 0 ||
    cantidad.trim() == "" ||
    descripcion.length == 0 ||
    descripcion.trim() == ""
  ) {
    validar_registros_herramienta(
      codigo,
      nombre,
      marca,
      tipo,
      precio,
      cantidad,
      descripcion
    );

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#codigo_herramientao_obligg").html("");
    $("#nombre_herramienta_obligg").html("");
    $("#marca_herramienta_obligg").html("");
    $("#tipo_herramienta_obligg").html("");
    $("#precio_compra_obligg").html("");
    $("#cantidad_herramienta_obligg").html("");
    $("#descripc_obliga").html("");
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

  alerta = ["datos", "Se esta creando la herramienta", "Creando herramienta"];
  mostar_loader_datos(alerta);

  funcion = "registra_herramienta";
  formdata.append("funcion", funcion);

  formdata.append("codigo", codigo);
  formdata.append("nombre", nombre);
  formdata.append("marca", marca);
  formdata.append("tipo", tipo);
  formdata.append("precio", precio);
  formdata.append("cantidad", cantidad);
  formdata.append("descripcion", descripcion);

  formdata.append("foto", foto);
  formdata.append("nombrearchivo", nombrearchivo);

  $.ajax({
    url: "../../controlador/inventario/inventario.php",
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
            text: "La herramienta se registro con exito",
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
            "El codigo " + codigo + ", ya esta registrado",
          ];
          cerrar_loader_datos(alerta);
        }
      } else {
        alerta = ["error", "error", "Error al registrar el herramienta"];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

function validar_registros_herramienta(
  codigo,
  nombre,
  marca,
  tipo,
  precio,
  cantidad,
  descripcion
) {
  if (codigo.length == 0 || codigo.trim() == "") {
    $("#codigo_herramientao_obligg").html(" - Ingrese el codigo");
  } else {
    $("#codigo_herramientao_obligg").html("");
  }

  if (nombre.length == 0 || nombre.trim() == "") {
    $("#nombre_herramienta_obligg").html(" - Ingrese el nombre");
  } else {
    $("#nombre_herramienta_obligg").html("");
  }

  if (marca.length == 0 || marca.trim() == "") {
    $("#marca_herramienta_obligg").html(" - Ingrese la marca");
  } else {
    $("#marca_herramienta_obligg").html("");
  }

  if (tipo.length == 0 || tipo.trim() == "") {
    $("#tipo_herramienta_obligg").html(" - Ingrese el tipo");
  } else {
    $("#tipo_herramienta_obligg").html("");
  }

  if (precio.length == 0 || precio == 0) {
    $("#precio_compra_obligg").html(" - Ingrese el precio");
  } else {
    $("#precio_compra_obligg").html("");
  }

  if (cantidad.length == 0 || cantidad.trim() == "") {
    $("#cantidad_herramienta_obligg").html(" - Ingrese la cantidad");
  } else {
    $("#cantidad_herramienta_obligg").html("");
  }

  if (descripcion.length == 0 || descripcion.trim() == "") {
    $("#descripc_obliga").html(" - Ingrese la descripción");
  } else {
    $("#descripc_obliga").html("");
  }
}

function listar_tabla_herramienta() {
  funcion = "listar_tabla_herramienta";
  table_herramienta = $("#table_herramienta").DataTable({
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
      url: "../../controlador/inventario/inventario.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      { data: "codigo" },
      { data: "nombre" },
      { data: "marca" },
      { data: "tipo_herramienta" },
      {
        data: "ruta",
        render: function (data, type, row) {
          return (
            "<img style='border-radius: 50px;' src='../../" +
            data +
            "' width='45px' />"
          );
        },
      },
      { data: "precio" },
      { data: "cantidad" },
      { data: "descripcion" },
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
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el insumo'><i class='fa fa-times'></i></button>-<button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el insumo'><i class='fa fa-edit'></i></button>-<button class='photoo btn btn-warning' title='Editar la foto'><i class='fas fa-image'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el insumo'><i class='fa fa-check'></i></button>-<button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el insumo'><i class='fa fa-edit'></i></button>-<button class='photoo btn btn-warning' title='Editar la foto'><i class='fas fa-image'></i></button>`;
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
  table_herramienta.on("draw.dt", function () {
    var pageinfo = $("#table_herramienta").DataTable().page.info();
    table_herramienta
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#table_herramienta").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = table_herramienta.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (table_herramienta.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = table_herramienta.row(this).data();
  }
  var dato = 0;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado de la herramienta se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_herramienta(id, dato);
    }
  });
});

$("#table_herramienta").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = table_herramienta.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (table_herramienta.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = table_herramienta.row(this).data();
  }
  var dato = 1;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado de la herramienta se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_herramienta(id, dato);
    }
  });
});

function cambiar_estado_herramienta(id, dato) {
  var res = "";
  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  funcion = "cambiar_estado_herramienta";
  alerta = [
    "datos",
    "Se esta cambiando el estado a " + res + "",
    "Cambiando estado",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio"];
        cerrar_loader_datos(alerta);
        table_herramienta.ajax.reload();
      }
    } else {
      alerta = ["error", "error", "No se pudo cambiar el estado"];
      cerrar_loader_datos(alerta);
    }
  });
}

$("#table_herramienta").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = table_herramienta.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (table_herramienta.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = table_herramienta.row(this).data();
  }

  $("#id_herramienta").val(data.id);
  $("#codigo_herramientao").val(data.codigo);
  $("#nombre_herramienta").val(data.nombre);
  $("#marca_herramienta").val(data.marca);
  $("#tipo_herramienta").val(data.tipo).trigger("change");
  $("#precio_compra").val(data.precio);
  $("#cantidad_herramienta").val(data.cantidad);
  $("#decripcion_herramienta").val(data.descripcion);

  $("#codigo_herramientao_obligg").html("");
  $("#nombre_herramienta_obligg").html("");
  $("#marca_herramienta_obligg").html("");
  $("#tipo_herramienta_obligg").html("");
  $("#precio_compra_obligg").html("");
  $("#cantidad_herramienta_obligg").html("");
  $("#descripc_obliga").html("");

  $("#modal_editar_herramienta").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_editar_herramienta").modal("show");
});

function editar_herramienta() {
  var id = $("#id_herramienta").val();
  var codigo = $("#codigo_herramientao").val();
  var nombre = $("#nombre_herramienta").val();
  var marca = $("#marca_herramienta").val();
  var tipo = $("#tipo_herramienta").val();
  var precio = $("#precio_compra").val();
  var cantidad = $("#cantidad_herramienta").val();
  var descripcion = $("#decripcion_herramienta").val();

  if (
    codigo.length == 0 ||
    codigo.trim() == "" ||
    nombre.length == 0 ||
    nombre.trim() == "" ||
    marca.length == 0 ||
    marca.trim() == "" ||
    tipo.length == 0 ||
    tipo.trim() == "" ||
    precio.length == 0 ||
    precio == 0 ||
    cantidad.length == 0 ||
    cantidad.trim() == "" ||
    descripcion.length == 0 ||
    descripcion.trim() == ""
  ) {
    validar_editar_herramienta(
      codigo,
      nombre,
      marca,
      tipo,
      precio,
      cantidad,
      descripcion
    );

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#codigo_herramientao_obligg").html("");
    $("#nombre_herramienta_obligg").html("");
    $("#marca_herramienta_obligg").html("");
    $("#tipo_herramienta_obligg").html("");
    $("#precio_compra_obligg").html("");
    $("#cantidad_herramienta_obligg").html("");
    $("#descripc_obliga").html("");
  }

  var formdata = new FormData();

  alerta = ["datos", "Se esta editando la herramienta", "Editando herramienta"];
  mostar_loader_datos(alerta);

  funcion = "editar_herramienta";
  formdata.append("funcion", funcion);

  formdata.append("id", id);
  formdata.append("codigo", codigo);
  formdata.append("nombre", nombre);
  formdata.append("marca", marca);
  formdata.append("tipo", tipo);
  formdata.append("precio", precio);
  formdata.append("cantidad", cantidad);
  formdata.append("descripcion", descripcion);

  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          alerta = ["exito", "success", "La herramienta se edito con exito"];
          cerrar_loader_datos(alerta);
          table_herramienta.ajax.reload();
          $("#modal_editar_herramienta").modal("hide");
        } else if (resp == 2) {
          alerta = [
            "existe",
            "warning",
            "El codigo " + codigo + ", ya esta registrado",
          ];
          cerrar_loader_datos(alerta);
        }
      } else {
        alerta = ["error", "error", "Error al registrar el herramienta"];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

function validar_editar_herramienta(
  codigo,
  nombre,
  marca,
  tipo,
  precio,
  cantidad,
  descripcion
) {
  if (codigo.length == 0 || codigo.trim() == "") {
    $("#codigo_herramientao_obligg").html(" - Ingrese el codigo");
  } else {
    $("#codigo_herramientao_obligg").html("");
  }

  if (nombre.length == 0 || nombre.trim() == "") {
    $("#nombre_herramienta_obligg").html(" - Ingrese el nombre");
  } else {
    $("#nombre_herramienta_obligg").html("");
  }

  if (marca.length == 0 || marca.trim() == "") {
    $("#marca_herramienta_obligg").html(" - Ingrese la marca");
  } else {
    $("#marca_herramienta_obligg").html("");
  }

  if (tipo.length == 0 || tipo.trim() == "") {
    $("#tipo_herramienta_obligg").html(" - Ingrese el tipo");
  } else {
    $("#tipo_herramienta_obligg").html("");
  }

  if (precio.length == 0 || precio == 0) {
    $("#precio_compra_obligg").html(" - Ingrese el precio");
  } else {
    $("#precio_compra_obligg").html("");
  }

  if (cantidad.length == 0 || cantidad.trim() == "") {
    $("#cantidad_herramienta_obligg").html(" - Ingrese la cantidad");
  } else {
    $("#cantidad_herramienta_obligg").html("");
  }

  if (descripcion.length == 0 || descripcion.trim() == "") {
    $("#descripc_obliga").html(" - Ingrese la descripción");
  } else {
    $("#descripc_obliga").html("");
  }
}

$("#table_herramienta").on("click", ".photoo", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = table_herramienta.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (table_herramienta.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = table_herramienta.row(this).data();
  }

  var id = data.id;
  var foto = data.ruta;

  $("#id_foto_herramienta").val(id);
  $("#foto_actu_herramienta").val(foto);
  $("#foto_herramienta_edit").attr("src", "../../" + foto);

  $("#modal_editar_photo_herramienta").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_editar_photo_herramienta").modal("show");
});

function editar_foto_herramienta() {
  var id = document.getElementById("id_foto_herramienta").value;
  var foto = document.getElementById("foto_new_h").value;
  var ruta_actual = document.getElementById("foto_actu_herramienta").value;

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
  var foto = $("#foto_new_h")[0].files[0];

  //est valores son como los que van en la data del ajax
  funcion = "editar_foto_herramienta";
  formdata.append("funcion", funcion);
  formdata.append("id", id);
  formdata.append("foto", foto);
  formdata.append("ruta_actual", ruta_actual);
  formdata.append("nombrearchivo", nombrearchivo);

  alerta = [
    "datos",
    "Se esta editando la imagen de la herramienta",
    "Editando imagen herramienta",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          document.getElementById("foto_new_h").value = "";
          table_herramienta.ajax.reload();
          alerta = [
            "exito",
            "success",
            "La foto de herramienta se edito con exito",
          ];
          cerrar_loader_datos(alerta);
          $("#modal_editar_photo_herramienta").modal("hide");
        }
      } else {
        alerta = ["error", "error", "No se pudo editar la foto de herramienta"];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

/////// proveedor
function registra_proveedor() {
  var razon_social = $("#razon_social").val();
  var ruc = $("#ruc").val();
  var telefono = $("#telefono").val();
  var direccion = $("#direccion").val();
  var correo = $("#correo").val();
  var encargado = $("#encargado").val();
  var decripcion_proveedor = $("#decripcion_proveedor").val();

  if (
    razon_social.length == 0 ||
    razon_social.trim() == "" ||
    ruc.length == 0 ||
    ruc.trim() == "" ||
    telefono.length == 0 ||
    telefono.trim() == "" ||
    direccion.length == 0 ||
    direccion.trim() == "" ||
    correo.length == 0 ||
    correo == 0 ||
    encargado.length == 0 ||
    encargado.trim() == "" ||
    decripcion_proveedor.length == 0 ||
    decripcion_proveedor.trim() == ""
  ) {
    validar_registro_proveedor(
      razon_social,
      ruc,
      telefono,
      direccion,
      correo,
      encargado,
      decripcion_proveedor
    );

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#razon_social_obligg").html("");
    $("#ruc_obligg").html("");
    $("#telefono_obligg").html("");
    $("#direccion_obligg").html("");
    $("#correo_obligg").html("");
    $("#encargado_obligg").html("");
    $("#descrip_prov_obliga").html("");
  }

  if (!correo_proveedor) {
    return swal.fire(
      "Correo incorrecto",
      "Ingrese un correo correcto",
      "warning"
    );
  }

  var formdata = new FormData();

  alerta = ["datos", "Se esta editando la herramienta", "Editando herramienta"];
  mostar_loader_datos(alerta);

  funcion = "registra_proveedor";
  formdata.append("funcion", funcion);

  formdata.append("razon_social", razon_social);
  formdata.append("ruc", ruc);
  formdata.append("telefono", telefono);
  formdata.append("direccion", direccion);
  formdata.append("correo", correo);
  formdata.append("encargado", encargado);
  formdata.append("decripcion_proveedor", decripcion_proveedor);

  $.ajax({
    url: "../../controlador/inventario/inventario.php",
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
            text: "El proveedor se registro con exito",
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
            "El ruc " + ruc + ", ya esta registrado",
          ];
          cerrar_loader_datos(alerta);
        }
      } else {
        alerta = ["error", "error", "Error al registrar el proveedor"];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

function validar_registro_proveedor(
  razon_social,
  ruc,
  telefono,
  direccion,
  correo,
  encargado,
  decripcion_proveedor
) {
  if (razon_social.length == 0 || razon_social.trim() == "") {
    $("#razon_social_obligg").html(" - Ingrese razon social");
  } else {
    $("#razon_social_obligg").html("");
  }

  if (ruc.length == 0 || ruc.trim() == "") {
    $("#ruc_obligg").html(" - Ingrese el ruc");
  } else {
    $("#ruc_obligg").html("");
  }

  if (telefono.length == 0 || telefono.trim() == "") {
    $("#telefono_obligg").html(" - Ingrese telefono");
  } else {
    $("#telefono_obligg").html("");
  }

  if (direccion.length == 0 || direccion.trim() == "") {
    $("#direccion_obligg").html(" - Ingrese direccion");
  } else {
    $("#direccion_obligg").html("");
  }

  if (correo.length == 0 || correo == 0) {
    $("#correo_obligg").html(" - Ingrese el correo");
  } else {
    $("#correo_obligg").html("");
  }

  if (encargado.length == 0 || encargado.trim() == "") {
    $("#encargado_obligg").html(" - Ingrese encargado");
  } else {
    $("#encargado_obligg").html("");
  }

  if (decripcion_proveedor.length == 0 || decripcion_proveedor.trim() == "") {
    $("#descrip_prov_obliga").html(" - Ingrese la descripción");
  } else {
    $("#descrip_prov_obliga").html("");
  }
}

function listar_tabla_proveedor() {
  funcion = "listar_tabla_proveedor";
  tabla_proveedor = $("#tabla_proveedor").DataTable({
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
      url: "../../controlador/inventario/inventario.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return `<div class="form-row"><button type='button' class='inactivar btn btn-danger' title='Inactivar el insumo'><i class='fa fa-times'></i></button>-<button type='button' class='editar btn btn-primary' title='Editar el insumo'><i class='fa fa-edit'></i></button></div>`;
          } else {
            return `<div class="form-row"><button type='button' class='activar btn btn-success' title='Activar el insumo'><i class='fa fa-check'></i></button>-<button type='button' class='editar btn btn-primary' title='Editar el insumo'><i class='fa fa-edit'></i></button></div>`;
          }
        },
      },
      { data: "razon_social" },
      { data: "ruc" },
      { data: "telefono" },
      { data: "direccion" },
      { data: "correo" },
      { data: "encargado" },
      { data: "descripcion" },
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
}

$("#tabla_proveedor").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_proveedor.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_proveedor.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_proveedor.row(this).data();
  }
  var dato = 0;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del proveedor se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_proveedor(id, dato);
    }
  });
});

$("#tabla_proveedor").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_proveedor.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_proveedor.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_proveedor.row(this).data();
  }
  var dato = 1;
  var id = data.id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del proveedor se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_proveedor(id, dato);
    }
  });
});

function cambiar_estado_proveedor(id, dato) {
  var res = "";
  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  funcion = "cambiar_estado_proveedor";
  alerta = [
    "datos",
    "Se esta cambiando el estado a " + res + "",
    "Cambiando estado",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio"];
        cerrar_loader_datos(alerta);
        tabla_proveedor.ajax.reload();
      }
    } else {
      alerta = ["error", "error", "No se pudo cambiar el estado"];
      cerrar_loader_datos(alerta);
    }
  });
}

$("#tabla_proveedor").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_proveedor.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_proveedor.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_proveedor.row(this).data();
  }

  $("#id_proveedor").val(data.id);
  $("#razon_social").val(data.razon_social);
  $("#ruc").val(data.ruc);
  $("#telefono").val(data.telefono);
  $("#direccion").val(data.direccion);
  $("#correo").val(data.correo);
  $("#encargado").val(data.encargado);
  $("#decripcion_proveedor").val(data.descripcion);

  $("#razon_social_obligg").html("");
  $("#ruc_obligg").html("");
  $("#telefono_obligg").html("");
  $("#direccion_obligg").html("");
  $("#correo_obligg").html("");
  $("#encargado_obligg").html("");
  $("#descrip_prov_obliga").html("");

  correo_proveedor_edit = true;

  $("#modal_editar_proveedor").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_editar_proveedor").modal("show");
});

function editar_proveedor() {
  var id = $("#id_proveedor").val();
  var razon_social = $("#razon_social").val();
  var ruc = $("#ruc").val();
  var telefono = $("#telefono").val();
  var direccion = $("#direccion").val();
  var correo = $("#correo").val();
  var encargado = $("#encargado").val();
  var decripcion_proveedor = $("#decripcion_proveedor").val();

  if (
    razon_social.length == 0 ||
    razon_social.trim() == "" ||
    ruc.length == 0 ||
    ruc.trim() == "" ||
    telefono.length == 0 ||
    telefono.trim() == "" ||
    direccion.length == 0 ||
    direccion.trim() == "" ||
    correo.length == 0 ||
    correo == 0 ||
    encargado.length == 0 ||
    encargado.trim() == "" ||
    decripcion_proveedor.length == 0 ||
    decripcion_proveedor.trim() == ""
  ) {
    validar_editar_proveedor(
      razon_social,
      ruc,
      telefono,
      direccion,
      correo,
      encargado,
      decripcion_proveedor
    );

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#razon_social_obligg").html("");
    $("#ruc_obligg").html("");
    $("#telefono_obligg").html("");
    $("#direccion_obligg").html("");
    $("#correo_obligg").html("");
    $("#encargado_obligg").html("");
    $("#descrip_prov_obliga").html("");
  }

  if (!correo_proveedor_edit) {
    return swal.fire(
      "Correo incorrecto",
      "Ingrese un correo correcto",
      "warning"
    );
  }

  var formdata = new FormData();

  alerta = ["datos", "Se esta editando el proveedor", "Editando proveedor"];
  mostar_loader_datos(alerta);

  funcion = "editara_proveedor";
  formdata.append("funcion", funcion);

  formdata.append("id", id);
  formdata.append("razon_social", razon_social);
  formdata.append("ruc", ruc);
  formdata.append("telefono", telefono);
  formdata.append("direccion", direccion);
  formdata.append("correo", correo);
  formdata.append("encargado", encargado);
  formdata.append("decripcion_proveedor", decripcion_proveedor);

  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          alerta = ["exito", "success", "El proveedor se edito con exito"];
          cerrar_loader_datos(alerta);
          tabla_proveedor.ajax.reload();
          $("#modal_editar_proveedor").modal("hide");
        } else if (resp == 2) {
          alerta = [
            "existe",
            "warning",
            "El ruc " + ruc + ", ya esta registrado",
          ];
          cerrar_loader_datos(alerta);
        }
      } else {
        alerta = ["error", "error", "Error al editar el proveedor"];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

function validar_editar_proveedor(
  razon_social,
  ruc,
  telefono,
  direccion,
  correo,
  encargado,
  decripcion_proveedor
) {
  if (razon_social.length == 0 || razon_social.trim() == "") {
    $("#razon_social_obligg").html(" - Ingrese razon social");
  } else {
    $("#razon_social_obligg").html("");
  }

  if (ruc.length == 0 || ruc.trim() == "") {
    $("#ruc_obligg").html(" - Ingrese el ruc");
  } else {
    $("#ruc_obligg").html("");
  }

  if (telefono.length == 0 || telefono.trim() == "") {
    $("#telefono_obligg").html(" - Ingrese telefono");
  } else {
    $("#telefono_obligg").html("");
  }

  if (direccion.length == 0 || direccion.trim() == "") {
    $("#direccion_obligg").html(" - Ingrese direccion");
  } else {
    $("#direccion_obligg").html("");
  }

  if (correo.length == 0 || correo == 0) {
    $("#correo_obligg").html(" - Ingrese el correo");
  } else {
    $("#correo_obligg").html("");
  }

  if (encargado.length == 0 || encargado.trim() == "") {
    $("#encargado_obligg").html(" - Ingrese encargado");
  } else {
    $("#encargado_obligg").html("");
  }

  if (decripcion_proveedor.length == 0 || decripcion_proveedor.trim() == "") {
    $("#descrip_prov_obliga").html(" - Ingrese la descripción");
  } else {
    $("#descrip_prov_obliga").html("");
  }
}

//////////// compra insumo
function listar_proveedor_combo() {
  funcion = "listar_proveedor_combo";
  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    data: {
      funcion: funcion,
    },
  }).done(function (response) {
    var data = JSON.parse(response);
    var cadena = "<option value=''> --- Ingrese un proveedor --- </option>";
    if (data.length > 0) {
      //bucle para extraer los datos del rol
      for (var i = 0; i < data.length; i++) {
        cadena +=
          "<option value='" +
          data[i][0] +
          "'> " +
          data[i][1] +
          " - " +
          data[i][2] +
          " </option>";
      }
      //aqui concadenamos al id del select
      $("#selec_proveedor").html(cadena);
    } else {
      cadena += "<option value=''>No hay datos de tipo</option>";
      $("#selec_proveedor").html(cadena);
    }
  });
}

function modal_insumo() {
  $("#modal_productos_insumos").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_productos_insumos").modal("show");
}

////////////////
function listar_isnumos_disponibles() {
  funcion = "listar_isnumos_disponibles";
  insumos_disponibles = $("#insumos_disponibles").DataTable({
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
      url: "../../controlador/inventario/inventario.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      {
        render: function (data, type, row) {
          return `<button id="enviar_i" class='btn btn-primary' title='Enviar el insumo'><i class='fa fa-paper-plane'></i></button>`;
        },
      },
      { data: "codigo" },
      { data: "nombre" },
      { data: "marca" },
      { data: "tipo_insumo" },
      { data: "precio" },
      { data: "cantidad" },
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
  });

  insumos_disponibles.on("draw.dt", function () {
    var pageinfo = $("#insumos_disponibles").DataTable().page.info();
    insumos_disponibles
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#insumos_disponibles").on("click", "#enviar_i", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = insumos_disponibles.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (insumos_disponibles.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = insumos_disponibles.row(this).data();
  }

  $("#id_insumo_t").val(data.id);
  $("#inumo_t").val(
    data.nombre + " - " + data.marca + " - " + data.tipo_insumo
  );
  $("#precio_compra_t").val(data.precio);
  $("#cantidad_t").val("1");
  $("#Descuento").val("0");

  $("#modal_productos_insumos").modal("hide");
});

/////////// guardar compra
function registra_compra_insumo() {
  var proveedor = $("#selec_proveedor").val();
  var fecha = $("#fecha").val();
  var numero_compra = $("#numero_compra").val();
  var tipo_comprobante = $("#tipo_comprobante").val();
  var iva = $("#iva").val();

  var txt_totalneto = $("#txt_totalneto").val();
  var txt_impuesto = $("#txt_impuesto").val();
  var txt_a_pagar = $("#txt_a_pagar").val();
  var count = 0;

  if (proveedor.length == 0 || numero_compra.length == 0 || iva.length == 0) {
    validar_compra_insumo(proveedor, numero_compra, iva);
    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos",
      "warning"
    );
  } else {
    $("#selec_proveedor_obligg").html("");
    $("#numero_compra_obligg").html("");
    $("#iva_obligg").html("");
  }

  $("#detalle_compra_insumo tbody#tbody_detalle_compra_insumo tr").each(
    function () {
      count++;
    }
  );

  if (count == 0) {
    return Swal.fire(
      "Mensaje de advertencia",
      "El detalle de compra debe tener un insumo por lo menos",
      "warning"
    );
  }

  funcion = "registrar_compra_insumo";
  alerta = ["datos", "Se esta registrando la compra", "Registrando la compra"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    data: {
      funcion: funcion,
      proveedor: proveedor,
      fecha: fecha,
      numero_compra: numero_compra,
      tipo_comprobante: tipo_comprobante,
      iva: iva,

      txt_totalneto: txt_totalneto,
      txt_impuesto: txt_impuesto,
      txt_a_pagar: txt_a_pagar,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp != 2) {
        registrar_detalle_compra_insumo(parseInt(resp));
      } else {
        alerta = [
          "existe",
          "warning",
          "El numero de compra '" + numero_compra + "', ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = ["error", "error", "No se pudo regitrar la compra"];
      cerrar_loader_datos(alerta);
    }
  });
}

function validar_compra_insumo(proveedor, numero_compra, iva) {
  if (proveedor.length == 0) {
    $("#selec_proveedor_obligg").html(" - No hay proveedor");
  } else {
    $("#selec_proveedor_obligg").html("");
  }

  if (numero_compra.length == 0) {
    $("#numero_compra_obligg").html(" - Ingrese N° compra");
  } else {
    $("#numero_compra_obligg").html("");
  }

  if (iva.length == 0) {
    $("#iva_obligg").html(" - IVA");
  } else {
    $("#iva_obligg").html("");
  }
}

////////////
function registrar_detalle_compra_insumo(id) {
  var count = 0;
  var arrego_insumo = new Array();
  var arreglo_cantidad = new Array();
  var arreglo_precio = new Array();
  var arreglo_descuento_moneda = new Array();
  var arreglo_subtotal = new Array();

  $("#detalle_compra_insumo tbody#tbody_detalle_compra_insumo tr").each(
    function () {
      arrego_insumo.push($(this).find("td").eq(0).text());
      arreglo_cantidad.push($(this).find("td").eq(2).text());
      arreglo_precio.push($(this).find("td").eq(3).text());
      arreglo_descuento_moneda.push($(this).find("td").eq(4).text());
      arreglo_subtotal.push($(this).find("td").eq(5).text());
      count++;
    }
  );

  //aqui combierto el arreglo a un string
  var idpm = arrego_insumo.toString();
  var cantidad = arreglo_cantidad.toString();
  var precio = arreglo_precio.toString();
  var des = arreglo_descuento_moneda.toString();
  var sutotal = arreglo_subtotal.toString();

  if (count == 0) {
    return;
  }

  funcion = "registrar_detalle_compra_insumo";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      idpm: idpm,
      cantidad: cantidad,
      precio: precio,
      des: des,
      sutotal: sutotal,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["", "", ""];
        cerrar_loader_datos(alerta);

        Swal.fire({
          title: "Campra realizada con exito",
          text: "Desea imprimir la compra??",
          icon: "warning",
          showCancelButton: true,
          showConfirmButton: true,
          allowOutsideClick: false,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si, Imprimir!!",
        }).then((result) => {
          if (result.value) {
            window.open(
              "../../reportes/Pdf/reporte_compra_insumo.php?id=" +
                parseInt(id) +
                "#zoom=100%",
              "Reporte de compra",
              "scrollbards=No"
            );

            location.reload();
          } else {
            location.reload();
          }
        });
      }
    } else {
      alerta = ["error", "error", "No se pudo regitrar el detalle compra"];
      cerrar_loader_datos(alerta);
    }
  });
}

////////////////
function listar_compras_insumos() {
  funcion = "listar_compras_insumos";
  tabla_compras_insumos = $("#tabla_compras_insumos").DataTable({
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
      url: "../../controlador/inventario/inventario.php",
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
            return `<button class='anular btn btn-danger' title='Anular la venta'><i class='fa fa-times'></i></button>-<button class='ver_reporte btn btn-primary' title='Ver detalle'><i class='fa fa-file'></i></button>`;
          } else {
            return "<button class='ver_reporte btn btn-primary' title='Ver detalle'><i class='fa fa-file'></i></button>";
          }
        },
      },
      { data: "numero_compra" },
      { data: "fecha" },
      { data: "razon_social" },
      {
        data: "tipo_comprobante",
        render: function (data, type, row) {
          if (data == "Factura") {
            return "<span class='badge badge-success'>Factura</span>";
          } else {
            return "<span class='badge badge-warning'>Nota compra</span>";
          }
        },
      },

      { data: "iva" },
      { data: "txt_totalneto" },
      { data: "txt_a_pagar" },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return "<span class='badge badge-success'>ACTIVO</span>";
          } else {
            return "<span class='badge badge-danger'>ANULADO</span>";
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
  });

  tabla_compras_insumos.on("draw.dt", function () {
    var pageinfo = $("#tabla_compras_insumos").DataTable().page.info();
    tabla_compras_insumos
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_compras_insumos").on("click", ".ver_reporte", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_compras_insumos.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_compras_insumos.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_compras_insumos.row(this).data();
  }
  var id = data.id;

  Swal.fire({
    title: "Imprimir compra",
    text: "Desea imprimir la compra??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Imprimir!!",
  }).then((result) => {
    if (result.value) {
      window.open(
        "../../reportes/Pdf/reporte_compra_insumo.php?id=" +
          parseInt(id) +
          "#zoom=100%",
        "Reporte de compra",
        "scrollbards=No"
      );
    }
  });
});

$("#tabla_compras_insumos").on("click", ".anular", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_compras_insumos.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_compras_insumos.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_compras_insumos.row(this).data();
  }
  var id = data.id;

  Swal.fire({
    title: "Anular compra",
    text: "Desea anular la compra??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, anular!!",
  }).then((result) => {
    if (result.value) {
      anular_compra_insumo(id);
    }
  });
});

function anular_compra_insumo(id) {
  alerta = ["datos", "Se esta anulando la compra", ".:Anulando compra:."];
  mostar_loader_datos(alerta);

  funcion = "anular_compra_insumo";
  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["exito", "success", "Se anulo la compra con exito"];
        cerrar_loader_datos(alerta);
        tabla_compras_insumos.ajax.reload();
      }
    } else {
      alerta = ["error", "error", "No se pudo anular la compra"];
      cerrar_loader_datos(alerta);
    }
  });
}

////////// compras herramientas
function modal_herramienta() {
  $("#modal_productos_herramienta").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_productos_herramienta").modal("show");
}

////////////////
function listar_herramientas_disponibles() {
  funcion = "listar_herramientas_disponibles";
  herramienta_disponibles = $("#herramienta_disponibles").DataTable({
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
      url: "../../controlador/inventario/inventario.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      {
        render: function (data, type, row) {
          return `<button id="enviar_i" class='btn btn-primary' title='Enviar el insumo'><i class='fa fa-paper-plane'></i></button>`;
        },
      },
      { data: "codigo" },
      { data: "nombre" },
      { data: "marca" },
      { data: "tipo_herramienta" },
      { data: "precio" },
      { data: "cantidad" },
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
  });

  herramienta_disponibles.on("draw.dt", function () {
    var pageinfo = $("#herramienta_disponibles").DataTable().page.info();
    herramienta_disponibles
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#herramienta_disponibles").on("click", "#enviar_i", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = herramienta_disponibles.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (herramienta_disponibles.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = herramienta_disponibles.row(this).data();
  }

  $("#id_herramienta_t").val(data.id);
  $("#herramienta_t").val(
    data.nombre + " - " + data.marca + " - " + data.tipo_herramienta
  );
  $("#precio_compra_t").val(data.precio);
  $("#cantidad_t").val("1");
  $("#Descuento").val("0");

  $("#modal_productos_herramienta").modal("hide");
});

/////////// guardar compra
function registra_compra_herramienta() {
  var proveedor = $("#selec_proveedor").val();
  var fecha = $("#fecha").val();
  var numero_compra = $("#numero_compra").val();
  var tipo_comprobante = $("#tipo_comprobante").val();
  var iva = $("#iva").val();

  var txt_totalneto = $("#txt_totalneto").val();
  var txt_impuesto = $("#txt_impuesto").val();
  var txt_a_pagar = $("#txt_a_pagar").val();
  var count = 0;

  if (proveedor.length == 0 || numero_compra.length == 0 || iva.length == 0) {
    validar_compra_insumo(proveedor, numero_compra, iva);
    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos",
      "warning"
    );
  } else {
    $("#selec_proveedor_obligg").html("");
    $("#numero_compra_obligg").html("");
    $("#iva_obligg").html("");
  }

  $("#detalle_compra_herramienta tbody#tbody_detalle_compra_herramienta tr").each(
    function () {
      count++;
    }
  );

  if (count == 0) {
    return Swal.fire(
      "Mensaje de advertencia",
      "El detalle de compra debe tener una herramienta por lo menos",
      "warning"
    );
  }

  funcion = "registrar_compra_herramienta";
  alerta = ["datos", "Se esta registrando la compra", "Registrando la compra"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    data: {
      funcion: funcion,
      proveedor: proveedor,
      fecha: fecha,
      numero_compra: numero_compra,
      tipo_comprobante: tipo_comprobante,
      iva: iva,

      txt_totalneto: txt_totalneto,
      txt_impuesto: txt_impuesto,
      txt_a_pagar: txt_a_pagar,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp != 2) {
        registrar_detalle_compra_herramienta(parseInt(resp));
      } else {
        alerta = [
          "existe",
          "warning",
          "El numero de compra '" + numero_compra + "', ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = ["error", "error", "No se pudo regitrar la compra"];
      cerrar_loader_datos(alerta);
    }
  });
}

function validar_compra_insumo(proveedor, numero_compra, iva) {
  if (proveedor.length == 0) {
    $("#selec_proveedor_obligg").html(" - No hay proveedor");
  } else {
    $("#selec_proveedor_obligg").html("");
  }

  if (numero_compra.length == 0) {
    $("#numero_compra_obligg").html(" - Ingrese N° compra");
  } else {
    $("#numero_compra_obligg").html("");
  }

  if (iva.length == 0) {
    $("#iva_obligg").html(" - IVA");
  } else {
    $("#iva_obligg").html("");
  }
}

////////////
function registrar_detalle_compra_herramienta(id) {
  var count = 0;
  var arrego_herramienta = new Array();
  var arreglo_cantidad = new Array();
  var arreglo_precio = new Array();
  var arreglo_descuento_moneda = new Array();
  var arreglo_subtotal = new Array();

  $("#detalle_compra_herramienta tbody#tbody_detalle_compra_herramienta tr").each(
    function () {
      arrego_herramienta.push($(this).find("td").eq(0).text());
      arreglo_cantidad.push($(this).find("td").eq(2).text());
      arreglo_precio.push($(this).find("td").eq(3).text());
      arreglo_descuento_moneda.push($(this).find("td").eq(4).text());
      arreglo_subtotal.push($(this).find("td").eq(5).text());
      count++;
    }
  );

  //aqui combierto el arreglo a un string
  var idpm = arrego_herramienta.toString();
  var cantidad = arreglo_cantidad.toString();
  var precio = arreglo_precio.toString();
  var des = arreglo_descuento_moneda.toString();
  var sutotal = arreglo_subtotal.toString();

  if (count == 0) {
    return;
  }

  funcion = "registrar_detalle_compra_herramienta";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      idpm: idpm,
      cantidad: cantidad,
      precio: precio,
      des: des,
      sutotal: sutotal,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["", "", ""];
        cerrar_loader_datos(alerta);

        Swal.fire({
          title: "Campra realizada con exito",
          text: "Desea imprimir la compra??",
          icon: "warning",
          showCancelButton: true,
          showConfirmButton: true,
          allowOutsideClick: false,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si, Imprimir!!",
        }).then((result) => {
          if (result.value) {
            window.open(
              "../../reportes/Pdf/reporte_compra_herramienta.php?id=" +
                parseInt(id) +
                "#zoom=100%",
              "Reporte de compra",
              "scrollbards=No"
            );

            location.reload();
          } else {
            location.reload();
          }
        });
      }
    } else {
      alerta = ["error", "error", "No se pudo regitrar el detalle compra"];
      cerrar_loader_datos(alerta);
    }
  });
}

////////////////
function listar_compras_herramienta() {
  funcion = "listar_compras_herramienta";
  tabla_compras_herramienta = $("#tabla_compras_herramienta").DataTable({
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
      url: "../../controlador/inventario/inventario.php",
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
            return `<button class='anular btn btn-danger' title='Anular la venta'><i class='fa fa-times'></i></button>-<button class='ver_reporte btn btn-primary' title='Ver detalle'><i class='fa fa-file'></i></button>`;
          } else {
            return "<button class='ver_reporte btn btn-primary' title='Ver detalle'><i class='fa fa-file'></i></button>";
          }
        },
      },
      { data: "numero_compra" },
      { data: "fecha" },
      { data: "razon_social" },
      {
        data: "tipo_comprobante",
        render: function (data, type, row) {
          if (data == "Factura") {
            return "<span class='badge badge-success'>Factura</span>";
          } else {
            return "<span class='badge badge-warning'>Nota compra</span>";
          }
        },
      },

      { data: "iva" },
      { data: "txt_totalneto" },
      { data: "txt_a_pagar" },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return "<span class='badge badge-success'>ACTIVO</span>";
          } else {
            return "<span class='badge badge-danger'>ANULADO</span>";
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
  });

  tabla_compras_herramienta.on("draw.dt", function () {
    var pageinfo = $("#tabla_compras_herramienta").DataTable().page.info();
    tabla_compras_herramienta
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_compras_herramienta").on("click", ".ver_reporte", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_compras_herramienta.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_compras_herramienta.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_compras_herramienta.row(this).data();
  }
  var id = data.id;

  Swal.fire({
    title: "Imprimir compra",
    text: "Desea imprimir la compra??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Imprimir!!",
  }).then((result) => {
    if (result.value) {
      window.open(
        "../../reportes/Pdf/reporte_compra_herramienta.php?id=" +
          parseInt(id) +
          "#zoom=100%",
        "Reporte de compra",
        "scrollbards=No"
      );
    }
  });
});

$("#tabla_compras_herramienta").on("click", ".anular", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_compras_herramienta.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_compras_herramienta.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_compras_herramienta.row(this).data();
  }
  var id = data.id;

  Swal.fire({
    title: "Anular compra",
    text: "Desea anular la compra??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, anular!!",
  }).then((result) => {
    if (result.value) {
      anular_compra_herramienta(id);
    }
  });
});

function anular_compra_herramienta(id) {
  alerta = ["datos", "Se esta anulando la compra", ".:Anulando compra:."];
  mostar_loader_datos(alerta);

  funcion = "anular_compra_herramienta";
  $.ajax({
    url: "../../controlador/inventario/inventario.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["exito", "success", "Se anulo la compra con exito"];
        cerrar_loader_datos(alerta);
        tabla_compras_herramienta.ajax.reload();
      }
    } else {
      alerta = ["error", "error", "No se pudo anular la compra"];
      cerrar_loader_datos(alerta);
    }
  });
}