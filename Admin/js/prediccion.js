var funcion;

function subir_excel() {
  Swal.fire({
    title: "Guardar el archivo excel?",
    text: "El excel se cargara al sistema!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, subir!",
  }).then((result) => {
    if (result.isConfirmed) {
      cargar_excel_sistema();
    }
  });
}

function cargar_excel_sistema() {
  var foto = $("#foto").val();
  var nombrearchivo = $("#nombre_ar").val();

  if (foto == "" || foto.length == 0 || foto == "") {
    return swal.fire(
      "Mensaje de advertencia",
      "Ingrese un archio excel",
      "warning"
    );
  }

  if (nombrearchivo == "" || nombrearchivo.length == 0 || nombrearchivo == "") {
    $("#nombre_oblliig").html(" - Ingrse nombre del archivo");
    return swal.fire(
      "Mensaje de alerta",
      "Ingrese todo los datos, no debe quedar ningun dato vacio",
      "warning"
    );
  } else {
    $("#nombre_oblliig").html("");
  }

  var formdata = new FormData();
  var foto = $("#foto")[0].files[0];
  //est valores son como los que van en la data del ajax

  alerta = ["datos", "Se está cargando el archivo", "Cargando archivo..."];
  mostar_loader_datos(alerta);

  funcion = "cargar_excel_caja";
  formdata.append("funcion", funcion);

  formdata.append("foto", foto);
  formdata.append("nombrearchivo", nombrearchivo);

  $.ajax({
    url: "../../controlador/prediccion/prediccion.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 2) {
          alerta = [
            "existe",
            "warning",
            "El nombre del archivo " + nombrearchivo + ", ya esta registrado",
          ];
          cerrar_loader_datos(alerta);
        } else if (resp == 1) {
          cargar_excel_cajas_();
          $("#foto").val("");
          $("#nombre_ar").val("");
          alerta = [
            "exito",
            "success",
            "Archivo cargado correctamento al sistema",
          ];
          cerrar_loader_datos(alerta);
        }
      } else {
        alerta = ["error", "error", "Error al cargar el archivo"];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

function cargar_excel_cajas_() {
  funcion = "cargar_excel_cajas_";
  $.ajax({
    type: "POST",
    url: "../../controlador/prediccion/prediccion.php",
    data: { funcion: funcion },
    success: function (response) {
      if (response != 0) {
        var data = JSON.parse(response);
        var element = "";
        data.forEach((row) => {
          nombre = row[1].split("/", 3);
          fin = nombre[2].split(".");
          element += `<div class="col-md-4">
                        <label>Archivo Excel</label>
                        <a href="../../${row[1]}" download="${fin[0]}.xlsx">
                           <img height="150" width="150" class="border rounded mx-auto d-block img-fluid" src="../../img/carga/excel.png" />
                        </a>
                        <label> <b> Nombre: </b> ${fin[0]} </label><br>
                        <label> <b> Fecha carga: ${row[2]} </b> </label><br>
                        <button onclick="eliminar_archivo_excel_cajas('${row[0]}', '${fin[0]}')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </div>`;
        });
        $("#unir_exel_cajas").html(element);
      }
    },
  });
}

function eliminar_archivo_excel_cajas(id, imagen) {
  Swal.fire({
    title: "Eliminar el archivo excel cajas?",
    text: "El excel se eliminará del sistema!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      funcion = "eliminar_archivo_excel_cajas";
      alerta = [
        "datos",
        "Se está eliminado el archivo",
        "Eliminado archivo...",
      ];
      mostar_loader_datos(alerta);
      $.ajax({
        type: "POST",
        url: "../../controlador/prediccion/prediccion.php",
        data: { id: id, imagen: imagen, funcion: funcion },
        success: function (response) {
          if (response == 1) {
            Swal.fire({
              title: "Archivo eliminado!!",
              text: "El archivo se elimino con exito",
              icon: "success",
              showCancelButton: false,
              showConfirmButton: true,
              allowOutsideClick: false,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "OK",
            }).then((result) => {
              if (result.value) {
                location.reload();
              } else {
                location.reload();
              }
            });
            // // cargar_excel_cajas_();
            // alerta = [
            //   "exito",
            //   "success",
            //   "El archivo se elimino con exito",
            // ];
            // cerrar_loader_datos(alerta);
          } else {
            alerta = ["error", "error", "Error al eliminar el archivo"];
            cerrar_loader_datos(alerta);
          }
        },
      });
    }
  });
}

////////////////////// para el arhivo enfunde
function subir_excel_enfunde() {
  Swal.fire({
    title: "Guardar el archivo excel?",
    text: "El excel se cargara al sistema!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, subir!",
  }).then((result) => {
    if (result.isConfirmed) {
      cargar_excel_sistema_enfunde();
    }
  });
}

function cargar_excel_sistema_enfunde() {
  var foto = $("#foto").val();
  var nombrearchivo = $("#nombre_ar").val();

  if (foto == "" || foto.length == 0 || foto == "") {
    return swal.fire(
      "Mensaje de advertencia",
      "Ingrese un archio excel",
      "warning"
    );
  }

  if (nombrearchivo == "" || nombrearchivo.length == 0 || nombrearchivo == "") {
    $("#nombre_oblliig").html(" - Ingrse nombre del archivo");
    return swal.fire(
      "Mensaje de alerta",
      "Ingrese todo los datos, no debe quedar ningun dato vacio",
      "warning"
    );
  } else {
    $("#nombre_oblliig").html("");
  }

  var formdata = new FormData();
  var foto = $("#foto")[0].files[0];
  //est valores son como los que van en la data del ajax

  alerta = ["datos", "Se está cargando el archivo", "Cargando archivo..."];
  mostar_loader_datos(alerta);

  funcion = "cargar_excel_enfunde";
  formdata.append("funcion", funcion);

  formdata.append("foto", foto);
  formdata.append("nombrearchivo", nombrearchivo);

  $.ajax({
    url: "../../controlador/prediccion/prediccion.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 2) {
          alerta = [
            "existe",
            "warning",
            "El nombre del archivo " + nombrearchivo + ", ya esta registrado",
          ];
          cerrar_loader_datos(alerta);
        } else if (resp == 1) {
          cargar_excel_enfunde_();
          $("#foto").val("");
          $("#nombre_ar").val("");
          alerta = [
            "exito",
            "success",
            "Archivo cargado correctamento al sistema",
          ];
          cerrar_loader_datos(alerta);
        }
      } else {
        alerta = ["error", "error", "Error al cargar el archivo"];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

function cargar_excel_enfunde_() {
  funcion = "cargar_excel_enfunde_";
  $.ajax({
    type: "POST",
    url: "../../controlador/prediccion/prediccion.php",
    data: { funcion: funcion },
    success: function (response) {
      if (response != 0) {
        var data = JSON.parse(response);
        var element = "";
        data.forEach((row) => {
          nombre = row[1].split("/", 3);
          fin = nombre[2].split(".");
          element += `<div class="col-md-4">
                        <label>Archivo Excel</label>
                        <a href="../../${row[1]}" download="${fin[0]}.xlsx">
                           <img height="150" width="150" class="border rounded mx-auto d-block img-fluid" src="../../img/carga/excel.png" />
                        </a>
                        <label> <b> Nombre: </b> ${fin[0]} </label><br>
                        <label> <b> Fecha carga: ${row[2]} </b> </label><br>
                        <button onclick="eliminar_archivo_excel_funda('${row[0]}', '${fin[0]}')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </div>`;
        });
        $("#unir_exel_enfunde").html(element);
      }
    },
  });
}

function eliminar_archivo_excel_funda(id, imagen) {
  Swal.fire({
    title: "Eliminar el archivo excel enfunde?",
    text: "El excel se eliminará del sistema!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      funcion = "eliminar_archivo_excel_funda";
      alerta = [
        "datos",
        "Se está eliminado el archivo",
        "Eliminado archivo...",
      ];
      mostar_loader_datos(alerta);
      $.ajax({
        type: "POST",
        url: "../../controlador/prediccion/prediccion.php",
        data: { id: id, imagen: imagen, funcion: funcion },
        success: function (response) {
          if (response == 1) {
            Swal.fire({
              title: "Archivo eliminado!!",
              text: "El archivo se elimino con exito",
              icon: "success",
              showCancelButton: false,
              showConfirmButton: true,
              allowOutsideClick: false,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "OK",
            }).then((result) => {
              if (result.value) {
                location.reload();
              } else {
                location.reload();
              }
            });
          } else {
            alerta = ["error", "error", "Error al eliminar el archivo"];
            cerrar_loader_datos(alerta);
          }
        },
      });
    }
  });
}

////////////////////// para el arhivo recobro
function subir_excel_recobro() {
  Swal.fire({
    title: "Guardar el archivo excel?",
    text: "El excel se cargara al sistema!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, subir!",
  }).then((result) => {
    if (result.isConfirmed) {
      cargar_excel_sistema_recobro();
    }
  });
}

function cargar_excel_sistema_recobro() {
  var foto = $("#foto").val();
  var nombrearchivo = $("#nombre_ar").val();

  if (foto == "" || foto.length == 0 || foto == "") {
    return swal.fire(
      "Mensaje de advertencia",
      "Ingrese un archio excel",
      "warning"
    );
  }

  if (nombrearchivo == "" || nombrearchivo.length == 0 || nombrearchivo == "") {
    $("#nombre_oblliig").html(" - Ingrse nombre del archivo");
    return swal.fire(
      "Mensaje de alerta",
      "Ingrese todo los datos, no debe quedar ningun dato vacio",
      "warning"
    );
  } else {
    $("#nombre_oblliig").html("");
  }

  var formdata = new FormData();
  var foto = $("#foto")[0].files[0];
  //est valores son como los que van en la data del ajax

  alerta = ["datos", "Se está cargando el archivo", "Cargando archivo..."];
  mostar_loader_datos(alerta);

  funcion = "cargar_excel_recobro";
  formdata.append("funcion", funcion);

  formdata.append("foto", foto);
  formdata.append("nombrearchivo", nombrearchivo);

  $.ajax({
    url: "../../controlador/prediccion/prediccion.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 2) {
          alerta = [
            "existe",
            "warning",
            "El nombre del archivo " + nombrearchivo + ", ya esta registrado",
          ];
          cerrar_loader_datos(alerta);
        } else if (resp == 1) {
          cargar_excel_recobro_();
          $("#foto").val("");
          $("#nombre_ar").val("");
          alerta = [
            "exito",
            "success",
            "Archivo cargado correctamento al sistema",
          ];
          cerrar_loader_datos(alerta);
        }
      } else {
        alerta = ["error", "error", "Error al cargar el archivo"];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

function cargar_excel_recobro_() {
  funcion = "cargar_excel_recobro_";
  $.ajax({
    type: "POST",
    url: "../../controlador/prediccion/prediccion.php",
    data: { funcion: funcion },
    success: function (response) {
      if (response != 0) {
        var data = JSON.parse(response);
        var element = "";
        data.forEach((row) => {
          nombre = row[1].split("/", 3);
          fin = nombre[2].split(".");
          element += `<div class="col-md-4">
                        <label>Archivo Excel</label>
                        <a href="../../${row[1]}" download="${fin[0]}.xlsx">
                           <img height="150" width="150" class="border rounded mx-auto d-block img-fluid" src="../../img/carga/excel.png" />
                        </a>
                        <label> <b> Nombre: </b> ${fin[0]} </label><br>
                        <label> <b> Fecha carga: ${row[2]} </b> </label><br>
                        <button onclick="eliminar_archivo_excel_recargo('${row[0]}', '${fin[0]}')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </div>`;
        });
        $("#unir_exel_recobro").html(element);
      }
    },
  });
}


function eliminar_archivo_excel_recargo(id, imagen) {
  Swal.fire({
    title: "Eliminar el archivo excel recargo?",
    text: "El excel se eliminará del sistema!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      funcion = "eliminar_archivo_excel_recargo";
      alerta = [
        "datos",
        "Se está eliminado el archivo",
        "Eliminado archivo...",
      ];
      mostar_loader_datos(alerta);
      $.ajax({
        type: "POST",
        url: "../../controlador/prediccion/prediccion.php",
        data: { id: id, imagen: imagen, funcion: funcion },
        success: function (response) {
          if (response == 1) {
            Swal.fire({
              title: "Archivo eliminado!!",
              text: "El archivo se elimino con exito",
              icon: "success",
              showCancelButton: false,
              showConfirmButton: true,
              allowOutsideClick: false,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "OK",
            }).then((result) => {
              if (result.value) {
                location.reload();
              } else {
                location.reload();
              }
            });
          } else {
            alerta = ["error", "error", "Error al eliminar el archivo"];
            cerrar_loader_datos(alerta);
          }
        },
      });
    }
  });
}