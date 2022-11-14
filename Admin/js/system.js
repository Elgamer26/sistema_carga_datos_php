var funcion;

function traer_datos_de_empresa() {
  funcion = "traer_datos_de_empresa";
  $.ajax({
    url: "../../controlador/system/system.php",
    type: "POST",
    data: { funcion: funcion },
  }).done(function (resp) {
    var data = JSON.parse(resp);
    if (data.length > 0) {
      document.getElementById("nombre").value = data[0][1];
      document.getElementById("ruc").value = data[0][2];
      document.getElementById("direccion").value = data[0][3];
      document.getElementById("telefono").value = data[0][4];
      document.getElementById("correo_e").value = data[0][5];

      correo_home = true;

      document.getElementById("detalle").value = data[0][6];
      document.getElementById("encargado").value = data[0][7];
      document.getElementById("telefono_encargado").value = data[0][8];

      document.getElementById("foto_empresa").src = "../../" + data[0][9];
      document.getElementById("foto_actual").value = data[0][9];
    }
  });
}

function cambiar_foto_perfil_empresa() {
  var foto = document.getElementById("foto_nueva").value;
  var ruta_actual = document.getElementById("foto_actual").value;

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
  var foto = $("#foto_nueva")[0].files[0];

  //est valores son como los que van en la data del ajax
  funcion = "cambiar_foto_perfilempresa";

  formdata.append("funcion", funcion);
  formdata.append("foto", foto);
  formdata.append("ruta_actual", ruta_actual);
  formdata.append("nombrearchivo", nombrearchivo);

  alerta = [
    "datos",
    "Se esta editando la foto de la empresa",
    "Editando foto empresa",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/system/system.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {

      if (resp > 0) {
        if (resp == 1) {
          document.getElementById("foto_nueva").value = "";
          traer_datos_de_empresa();
          alerta = [
            "exito",
            "success",
            "La foto de empresa se edito con exito",
          ];
          cerrar_loader_datos(alerta);
        }
      } else {
        alerta = ["error", "error", "No se pudo editar la foto de empresa"];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

function editra_datos_empresa() {
  var nomber = document.getElementById("nombre").value;
  var ruc = document.getElementById("ruc").value;
  var direcc = document.getElementById("direccion").value;
  var telefono = document.getElementById("telefono").value;
  var correo = document.getElementById("correo_e").value;
  var dueño = document.getElementById("encargado").value;
  var tele_dueño = document.getElementById("telefono_encargado").value;
  var descrp = document.getElementById("detalle").value;

  if (
    nomber.length == 0 ||
    ruc.length == 0 ||
    direcc.length == 0 ||
    telefono.length == 0 ||
    correo.length == 0 ||
    dueño.length == 0 ||
    tele_dueño.length == 0 ||
    descrp.length == 0 ||
    nomber.trim() == "" ||
    ruc.trim() == "" ||
    direcc.trim() == "" ||
    telefono.trim() == "" ||
    correo.trim() == "" ||
    dueño.trim() == "" ||
    tele_dueño.trim() == "" ||
    descrp.trim() == ""
  ) {
    validar_registro(
      nomber,
      ruc,
      direcc,
      telefono,
      correo,
      dueño,
      descrp,
      tele_dueño
    );

    return swal.fire(
      "Mensaje de alerta",
      "Ingrese todo los datos, no debe quedar ningun dato vacio",
      "warning"
    );
  } else {
    $("#nombre_obligg").html("");
    $("#ruc").html("");
    $("#direccion_obligg").html("");
    $("#telefono_obligg").html("");
    $("#correo_obligg").html("");
    $("#encargado_obligg").html("");
    $("#detalle_obligg").html("");
    $("#telefono_encargado_obligg").html("");
  }

  if (!correo_home) {
    return swal.fire(
      "Correo incorrecto",
      "Ingrese un correo correcto",
      "warning"
    );
  }

  funcion = "cambiar_datos_empresa";
  alerta = [
    "datos",
    "Se esta modificando los datos de perfil",
    "Cambiando datos del usuario",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/system/system.php",
    type: "POST",
    data: {
      funcion: funcion,
      nomber: nomber,
      ruc: ruc,
      direcc: direcc,
      telefono: telefono,
      correo: correo,
      dueño: dueño,
      descrp: descrp,
      tele_dueño: tele_dueño,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        traer_datos_de_empresa();
        alerta = [
          "exito",
          "success",
          "Los datos de empresa se actualizo con exito",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = ["error", "error", "No se pudo actualizar el registro"];
      cerrar_loader_datos(alerta);
    }
  });
}

function validar_registro(
  nomber,
  ruc,
  direcc,
  telefono,
  correo,
  dueño,
  descrp,
  tele_dueño
) {
  if (nomber.length == 0 || nomber.trim() == "") {
    $("#nombre_obligg").html("Ingrese nombre de empresa");
  } else {
    $("#nombre_obligg").html("");
  }

  if (ruc.length == 0 || ruc.trim() == "") {
    $("#ruc").html("Ingrese ruc empresa");
  } else {
    $("#ruc").html("");
  }

  if (direcc.length == 0 || direcc.trim() == "") {
    $("#direccion_obligg").html("Ingrese direccion");
  } else {
    $("#direccion_obligg").html("");
  }

  if (telefono.length == 0 || telefono.trim() == "") {
    $("#telefono_obligg").html("Ingrese telefono empresa");
  } else {
    $("#telefono_obligg").html("");
  }

  if (correo.length == 0 || correo.trim() == "") {
    $("#correo_obligg").html("Ingrese correo empresa");
  } else {
    $("#correo_obligg").html("");
  }

  if (dueño.length == 0 || dueño.trim() == "") {
    $("#encargado_obligg").html("Ingrese encargado");
  } else {
    $("#encargado_obligg").html("");
  }

  if (descrp.length == 0 || descrp.trim() == "") {
    $("#detalle_obligg").html("Ingrese descripcion de la empresa");
  } else {
    $("#detalle_obligg").html("");
  }

  if (tele_dueño.length == 0 || tele_dueño.trim() == "") {
    $("#telefono_encargado_obligg").html("Ingrese telefono de encargado");
  } else {
    $("#telefono_encargado_obligg").html("");
  }
}

function datos_usuarios() {
  $("#modal_datos_usuario").modal({ backdrop: "static", keyboard: false });
  $("#modal_datos_usuario").modal("show");
}

//datos del usuario legeado
function datos_usuario_logeado() {
  funcion = "datos_usuario_logeado";
  $.ajax({
    url: "../../controlador/system/system.php",
    type: "POST",
    data: { funcion: funcion },
  }).done(function (responce) {
    if (responce != 0) {
      var data = JSON.parse(responce);
      $("#foto_usuario_l").attr("src", "../../" + data[0][7]);

      $("#nombres_l").val(data[0][1]);
      $("#apellidos_l").val(data[0][2]);
      $("#correo_l").val(data[0][3]);
      $("#usuario_l").val(data[0][5]);

      $("#foto_actu_l").val(data[0][7]);
      $("#pass_oculto").val(data[0][6]);
    }
  });
}

function editar_usuario_login() {
  var nombre = $("#nombres_l").val();
  var apellido = $("#apellidos_l").val();
  var correo = $("#correo_l").val();
  var usuarios = $("#usuario_l").val();

  if (
    nombre.length == 0 ||
    nombre.trim() == "" ||
    apellido.length == 0 ||
    apellido.trim() == "" ||
    correo.length == 0 ||
    correo.trim() == "" ||
    usuarios.length == 0 ||
    usuarios.trim() == ""
  ) {
    validar_registros_edit_login(nombre, apellido, correo, usuarios);

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#nombres_l_obligg").html("");
    $("#apellidos_l_obligg").html("");
    $("#correo_l_obligg").html("");
    $("#usuario_l_obligg").html("");
  }

  if (!correo_usus_lo) {
    return swal.fire(
      "Correo incorrecto",
      "Ingrese un correo correcto",
      "warning"
    );
  }

  funcion = "editando_usuario_logeado";
  alerta = ["datos", "Se esta editando el usuario", "Editando usuario"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/usuario/usuario.php",
    type: "POST",
    data: {
      funcion: funcion,
      nombre: nombre,
      apellido: apellido,
      correo: correo,
      usuarios: usuarios,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["exito", "success", "El usuario se edito con exito"];
        cerrar_loader_datos(alerta);
        datos_usuario_logeado();
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
          "El usuario '" + usuarios + "', ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = ["error", "error", "Error al editar los datos"];
      cerrar_loader_datos(alerta);
    }
  });
}

function validar_registros_edit_login(nombre, apellido, correo, usuarios) {
  if (nombre.length == 0 || nombre.trim() == "") {
    $("#nombres_l_obligg").html(" - Ingrese los nombres");
  } else {
    $("#nombres_l_obligg").html("");
  }

  if (apellido.length == 0 || apellido.trim() == "") {
    $("#apellidos_l_obligg").html(" - Ingrese los apellidos");
  } else {
    $("#apellidos_l_obligg").html("");
  }

  if (correo.length == 0 || correo.trim() == "") {
    $("#correo_l_obligg").html(" - Ingrese el correo");
  } else {
    $("#correo_l_obligg").html("");
  }

  if (usuarios.length == 0 || usuarios.trim() == "") {
    $("#usuario_l_obligg").html(" - Ingrese el usuario");
  } else {
    $("#usuario_l_obligg").html("");
  }
}

function editar_foto_usuario_logeado() {
  var foto = document.getElementById("foto_new_l").value;
  var ruta_actual = document.getElementById("foto_actu_l").value;

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
  var foto = $("#foto_new_l")[0].files[0];

  //est valores son como los que van en la data del ajax
  funcion = "editar_foto_usuario_logeado";
  formdata.append("funcion", funcion);

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
          document.getElementById("foto_new_l").value = "";
          datos_usuario_logeado();
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

function cambiar_password_login() {
  var pass_oculto = $("#pass_oculto").val();
  var pass_ac = $("#pass_ac").val();
  var pass_nue = $("#pass_nue").val();
  var pass_co = $("#pass_co").val();

  if (
    pass_ac.length == 0 ||
    pass_ac.trim() == "" ||
    pass_nue.length == 0 ||
    pass_nue.trim() == "" ||
    pass_co.length == 0 ||
    pass_co.trim() == ""
  ) {
    validar_password_login(pass_ac, pass_nue, pass_co);

    return swal.fire(
      "Campo vacios",
      "Los campos no deben quedar vacios, complete los datos",
      "warning"
    );
  } else {
    $("#pass_ac_obligg").html("");
    $("#pass_nue_obligg").html("");
    $("#pass_co_obligg").html("");
  }

  if (pass_oculto != pass_ac) {
    $("#pass_ac_obligg").html("Password incorrecto");
    return swal.fire(
      "Password incorrecto ",
      "El password actual ingresado es incorrecto",
      "warning"
    );
  } else {
    $("#pass_ac_obligg").html("");
  }

  if (pass_nue != pass_co) {
    $("#pass_nue_obligg").html("No coinciden");
    $("#pass_co_obligg").html("No coinciden");
    return swal.fire(
      "Password incorrecto",
      "Los password no coinciden",
      "warning"
    );
  } else {
    $("#pass_nue_obligg").html("");
    $("#pass_co_obligg").html("");
  }

  funcion = "editar_passwoed_logeado";
  alerta = ["datos", "Se esta editando el password", "Editando password"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../../controlador/usuario/usuario.php",
    type: "POST",
    data: {
      funcion: funcion,
      pass_nue: pass_nue,
    },
  }).done(function (resp) {

    if (resp > 0) {
      if (resp == 1) {

        $("#pass_ac").val("");
        $("#pass_nue").val("");
        $("#pass_co").val("");

        alerta = ["exito", "success", "El password se edito con exito"];
        cerrar_loader_datos(alerta);
        datos_usuario_logeado();
      }
    } else {
      alerta = ["error", "error", "Error al editar el password"];
      cerrar_loader_datos(alerta);
    }
  });
}

function validar_password_login(pass_ac, pass_nue, pass_co) {
  if (pass_ac.length == 0 || pass_ac.trim() == "") {
    $("#pass_ac_obligg").html(" - Ingrese password actual");
  } else {
    $("#pass_ac_obligg").html("");
  }

  if (pass_nue.length == 0 || pass_nue.trim() == "") {
    $("#pass_nue_obligg").html(" - Ingrese password nuevo");
  } else {
    $("#pass_nue_obligg").html("");
  }

  if (pass_co.length == 0 || pass_co.trim() == "") {
    $("#pass_co_obligg").html(" - Confirme password");
  } else {
    $("#pass_co_obligg").html("");
  }
}
