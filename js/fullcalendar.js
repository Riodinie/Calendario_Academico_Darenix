var alm;
var eventDrop_ = false;
var alarmNombre;
var NuevoEvento;

$(document).ready(function () {
  $("#Calendario").fullCalendar({
    header: {
      left: "title",
      center: "",
      right: "Miboton Alarma prev next today basicDay,basicWeek,month",
    },
    customButtons: {
      Miboton: {
        icon: " bx bx-trash",
        click: function () {
          $("#Vaciar").modal();
        },
      },

      Alarma: {
        icon: " bx bx-alarm",
        click: function () {
          $("#alarmConf").modal();
        },
      },
    },

    dayClick: function (date, jsEvent, view) {
      $("#btnAgregar").prop("disabled", false);
      $("#btnEliminar").prop("disabled", true);
      $("#btnModificar").prop("disabled", true);
      $("#alarmButton").prop("disabled", true);

      limpiarFormulario();
      $("#txtFechaI").val(date.format());
      $("#txtFechaF").val(date.format());
      $("#ModalEventos").modal();
    },

    events: "eventos.php",

    eventClick: function (calEvent, jsEvent, view) {
      $("#btnAgregar").prop("disabled", true);
      $("#btnEliminar").prop("disabled", false);
      $("#btnModificar").prop("disabled", false);
      $("#alarmButton").prop("disabled", false);

      $("#tituloEvento").html(calEvent.title);

      $("#txtDescripcion").val(calEvent.descripcion);
      $("#txtID").val(calEvent.id);
      $("#txtTitulo").val(calEvent.title);
      $("#txtColor").val(calEvent.color);

      FechaHora = calEvent.start._i.split(" ");
      $("#txtFechaI").val(FechaHora[0]);
      $("#txtHoraI").val(FechaHora[1]);

      alarmNombre = calEvent.title;
      alm = calEvent.start._d;
      Fechahora = calEvent.end._i.split(" ");

      $("#txtFechaF").val(Fechahora[0]);
      $("#txtHoraF").val(Fechahora[1]);

      $("#ModalEventos").modal();

      ///Eventos para saber que boton radio esta seleccionado

      if (calEvent.color == "#FFB200") {
        $("#uno").click();
      }

      if (calEvent.color == "#EB5B00") {
        $("#dos").click();
      }

      if (calEvent.color == "#219C90") {
        $("#tres").click();
      }

      if (calEvent.color == "#E4003A") {
        $("#cuatro").click();
      }

      if (calEvent.color == "#B60071") {
        $("#cinco").click();
      }
    },

    businessHours: true,
    editable: true,
    navLinks: true,
    eventDrop: function (calEvent) {
      eventDrop_ = true;
      $("#txtID").val(calEvent.id);
      $("#txtTitulo").val(calEvent.title);
      $("#txtColor").val(calEvent.color);
      $("#txtDescripcion").val(calEvent.descripcion);

      var fechaHora = calEvent.start.format().split("T");
      $("#txtFechaI").val(fechaHora[0]);
      $("#txtHoraI").val(fechaHora[1]);

      fechaHora = calEvent.end.format().split("T");
      $("#txtFechaF").val(fechaHora[0]);
      $("#txtHoraF").val(fechaHora[1]);

      RecolectarDatosGUI();
      EnviarInformacion("modificar", NuevoEvento);
      modal = true;
    },
  });
});

$("#btnAgregar").click(function () {
  eventDrop_ = false;
  RecolectarDatosGUI();
  EnviarInformacion("agregar", NuevoEvento);
});

$("#btnEliminar").click(function () {
  eventDrop_ = false;
  var pregunta = confirm("¿Deseas Borrar este Evento?");
  if (pregunta) {
    RecolectarDatosGUI();
    EnviarInformacion("eliminar", NuevoEvento);
  }
});

$("#btnModificar").click(function () {
  eventDrop_ = false;
  RecolectarDatosGUI();
  EnviarInformacion("modificar", NuevoEvento);
});

function RecolectarDatosGUI() {
  let a = "";

  // Para saber que boton radio fue clikeado y mandar la informacion a la base de datos
  if (eventDrop_ == false) {
    if (document.getElementById("uno").checked) {
      a = "#uno";
    }
    if (document.getElementById("dos").checked) {
      a = "#dos";
    }
    if (document.getElementById("tres").checked) {
      a = "#tres";
    }
    if (document.getElementById("cuatro").checked) {
      a = "#cuatro";
    }

    if (document.getElementById("cinco").checked) {
      a = "#cinco";
    }

  } else {
    a = "#txtColor";
  }

  NuevoEvento = {
    id: $("#txtID").val(),
    title: $("#txtTitulo").val(),
    start: $("#txtFechaI").val() + " " + $("#txtHoraI").val(),
    color: $(a).val(),
    descripcion: $("#txtDescripcion").val(),
    textColor: "#ffffff",
    end: $("#txtFechaF").val() + " " + $("#txtHoraF").val(),
  };
}
function EnviarInformacion(accion, objEvento) {
  modal = false;
  $.ajax({
    type: "POST",
    url:
      "eventos.php?accion=" +
      accion,
    data: objEvento,
    success: function (msg) {
      if (msg) {
        $("#Calendario").fullCalendar("refetchEvents");
        if (!modal) {
          $("#ModalEventos").modal("toggle");
        }
      }
    },

    error: function () {
      alert("Lo siento, se presento un error....");
    },
  });
}

$(".clockpicker").clockpicker();

function limpiarFormulario() {
  $("#tituloEvento").html("Nuevo Evento");
  $("#txtID").val("");
  $("#txtTitulo").val("");
  $("#txtColor").val("");
  $("#txtDescripcion").val("");
  $("#uno").click();
}
//Alarma
var alarmSound = new Audio();
alarmSound.src = "music/alarm.mp3";

var alarmTimer;

function setAlarmTonos() {
  if (document.getElementById("prede").checked) {
    alarmSound.src = "music/alarm.mp3";
  }
  if (document.getElementById("primera").checked) {
    alarmSound.src = "music/1.mp3";
  }
  if (document.getElementById("segunda").checked) {
    alarmSound.src = "music/2.mp3";
  }
  if (document.getElementById("tercera").checked) {
    alarmSound.src = "music/3.mp3";
  }
}

function setAlarm(button) {
  var alarm = alm;
  console.log(alm);
  var alarmTime = new Date(
    alarm.getUTCFullYear(),
    alarm.getUTCMonth(),
    alarm.getUTCDate(),
    alarm.getUTCHours(),
    alarm.getUTCMinutes(),
    alarm.getUTCSeconds()
  );

  var differenceInMs = alarmTime.getTime() - new Date().getTime();

  if (differenceInMs < 0) {
    alert("El tiempo especificado ya ha pasado");
    return;
  }

  alarmTimer = setTimeout(initAlarm, differenceInMs);
  button.innerText = "Quitar Alm.";
  button.setAttribute("onclick", "cancelAlarm(this);");
}

function cancelAlarm(button) {
  clearTimeout(alarmTimer);
  button.innerText = "Act. Alarma";
  button.setAttribute("onclick", "setAlarm(this);");
}

function initAlarm() {
  alarmSound.play();
  $("#NombreEvento").html(alarmNombre + " a iniciado.");
  $("#alarmOptions").modal();
}

function stopAlarm() {
  alarmSound.pause();
  alarmSound.currentTime = 0;
  cancelAlarm(document.getElementById("alarmButton"));
}


//Vaciar

function VaciarCalendario() {
  $.ajax({
    type: "POST",
    url: "eventos.php?accion=vaciar",
    success: function (msg) {
      $("#Calendario").fullCalendar("refetchEvents");
    },
  });
}
