$(document).ready(function () {
  $("#loginForm").on("submit", function (e) {
    e.preventDefault();

    let correo = $("#login_correo").val();
    let contrasena = $("#login_contrasena").val();

    if (correo === "" || contrasena === "") {
      Swal.fire({
        icon: "warning",
        title: "Campos vacíos",
        text: "Por favor complete todos los campos antes de continuar.",
      });
      return;
    }

    $.ajax({
      url: "./php/Login_usuarios.php",
      type: "POST",
      data: { correo, contrasena },
      dataType: "json",
      //mantener iniciada la sesion
      xhrFields: {
        withCredentials: true, 
      },
      success: function (respuesta) {
        if (respuesta.status === "ok") {
          Swal.fire({
            icon: "success",
            title: "¡Bienvenido!",
            text: respuesta.message,
            showConfirmButton: false,
            timer: 2000,
          }).then(() => {
            window.location.href = "../SeleccionEscuelas.php";
          });
        } else if (respuesta.status === "no") {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: respuesta.message,
          });
        } else if (respuesta.status === "no_usuario") {
          Swal.fire({
            icon: "error",
            title: "Usuario no encontrado",
            text: respuesta.message,
          });
        } else if (respuesta.status === "vacio") {
          Swal.fire({
            icon: "warning",
            title: "Campos vacíos",
            text: respuesta.message,
          });
        }
      },
      error: function () {
        Swal.fire({
          icon: "error",
          title: "Error de conexión",
          text: "No se pudo procesar la solicitud.",
        });
      },
    });
  });
});

//REGISTROS
$(document).ready(function () {
  $("#registroForm").on("submit", function (e) {
    e.preventDefault();

    let nombre = $("#reg_nombre").val().trim();
    let usuario = $("#reg_usuario").val().trim();
    let correo = $("#reg_correo").val().trim();
    let contrasena = $("#reg_contrasena").val().trim();

    // Validar campos vacíos
    if (nombre === "" || usuario === "" || correo === "" || contrasena === "") {
      Swal.fire({
        icon: "warning",
        title: "Campos vacíos",
        text: "Por favor complete todos los campos.",
      });
      return;
    }

    // Enviar datos al PHP
    $.ajax({
      url: "../php/Registro_Usuarios.php",
      type: "POST",
      data: { nombre, usuario, correo, contrasena },
      dataType: "json",
      success: function (respuesta) {
        if (respuesta.status === "ok") {
          Swal.fire({
            icon: "success",
            title: "Registro exitoso",
            text: respuesta.message,
            showConfirmButton: false,
            timer: 2000,
          }).then(() => {
            // Limpiar formulario
            $("#registroForm")[0].reset();
            window.location.href = "index.php";
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: respuesta.message,
          });
        }
      },
      error: function () {
        Swal.fire({
          icon: "error",
          title: "Error de conexión",
          text: "No se pudo procesar la solicitud.",
        });
      },
    });
  });
});
