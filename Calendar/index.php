<?php
  session_start();

  require 'C:\xampp\htdocs\IntroduccionPHP\Horario_Proyecto_A\database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id,name, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;


    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= "icon" type="image/png" href="fenix.png" />
     <!------------------------------------------------------------->
    <link rel="stylesheet" type="text/css" href="css/fullcalendar.min.css">
	  <link rel="stylesheet"  href="css/bootstrap.min.css">
    <link rel="stylesheet"  href="css/bootstrap-clockpicker.css">
     <!------------------------------------------------------------->
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/moment.min.js"></script>	
    <script type="text/javascript" src="js/fullcalendar.min.js"></script>
    <script src="js/bootstrap-clockpicker.js"></script>
    <script src='js/es.js'></script>
     <!------------------------------------------------------------->
    <script  src="js/bootstrap.min.js"></script>
    <script  src="js/popper.min.js"></script>
     <!------------------------------------------------------------->
    <title>Calendario</title>
</head>


<header>
  
    <img src="usario.png" id="imagenp"><p id="usariooo"><?=$user['name']?></p>
    <a class="padre" href="/IntroduccionPHP/Horario_Proyecto_A/logout.php">
    <p class="header">Cerrar sesión</p>
    </a>

</header>
<body>

    <div class="container">
        <div class="row"></div>
        <div id="Calendario"></div>   
        <div class="row"></div>
    </div>

    <style>

      #imagenp{

        width: auto;
        height: 40px;
        display: flex; 
        position: absolute;
        left:1.5%;
        top:0.8%;
      }

      #usariooo{
       color: white;
       font-size: 16px;
       font-family: 'Graphik Light', sans-serif;
       font-weight:bold;
       display: flex; 
       position: absolute;
       left:5%;
       top:2.3%;
      }

      header{
      width: auto;
      height: 50px;
      background: #da4c3f;
      
      }

      .header{
       padding:16px 19px;
       padding-bottom: 10px;
       background: #f54d3e;
       color: white;
	     text-decoration: none;
       text-align: center;
	     text-decoration: none;
       font-size: 16px;
       font-family: 'Graphik Light', sans-serif;
       font-weight:bold;
       display: flex; 
       position: absolute;
       left:90%;
       top:0%;
     }
     

  
     .padre { 
      text-decoration-line: none;
      float:right;
      color: white;
    }
    
    .header:hover {
      background-color:#fafafa54;
    }

     .container{
     
      width: 100%;
      padding-right: 65px;
      padding-left: 65px;
      margin-right: auto;
      margin-left: auto;
     }

     .row{
       margin-top: 50px;
     }
    
     .fc th{
      padding: 10px;
      color: #da4c3f;
      background-color:#eee ;
     }

     .fc-unthemed td.fc-today {
     background: hsl(31, 100%, 89%);
     }

     .fc-unthemed .fc-divider, .fc-unthemed .fc-list-heading td, .fc-unthemed .fc-popover .fc-header {
      color: #da4c3f;
     }


     .fc-state-default {
      background: white;
      color: black;
      border: 1px solid;  
     }

     .fc-unthemed .fc-content, .fc-unthemed .fc-divider, .fc-unthemed .fc-list-heading td, .fc-unthemed .fc-list-view, .fc-unthemed .fc-popover, .fc-unthemed .fc-row, .fc-unthemed tbody, .fc-unthemed td, .fc-unthemed th, .fc-unthemed thead {
      border-color: #a56876;
      
     }
    
     .fc-ltr .fc-basic-view .fc-day-top .fc-day-number {
      color: #931837;
      }
     
     .fc-state-default:hover {
      background: #ffffd2;
      
     }

     .fc-state-default:focus {
      background: #fefea8;
      outline: 2px;
     }

     .fc-state-default.fc-corner-left {
      border-top-left-radius: 0px;
      border-bottom-left-radius: 0px;
      }

      .fc-state-default.fc-corner-right {
       border-top-right-radius: 0px;
       border-bottom-right-radius: 0px;
      }      

     .fc-state-active, .fc-state-down {
     background-image: none; 
     box-shadow:none;
     }   

     .fc-nonbusiness{
       background: rgb(252, 229, 229);
      
      }

      .text-primary {
       color: #da4c3f!important;
      }

      .circu{
      padding: 25px;
      background: #ccc;
      border-radius: 50px;
      }

      #grupoRadio{
      text-align: center;
      }

      #grupoRadio label:hover{
      cursor: pointer;
      }

     #grupoRadio input[type="radio"]:checked + label {
      border: 3px solid #ccc !important;  
     }

     .activado input[type=radio]:checked + label {
       border: 3px solid #555 !important;  

     }

     #grupoRadio input[type="radio"]{
     display: none;
}

    </style>

    <script>
      var alm;
      var eventDrop_= false;
      var alarmNombre;
    
       $(document).ready(function(){
           $('#Calendario').fullCalendar({

            header:{
            left: 'today,prev,next Miboton Alarma',
            center: 'title',
            right: 'month,basicWeek,listMonth'
           },

           customButtons:{
             Miboton:{

              text: 'Vaciar',
              click: function(){

                var pregunta = confirm("¿Deseas Borrar todos los Eventos?");  
                if(pregunta){

                  $.ajax({
                 type:'POST',
                 url:'http://localhost/IntroduccionPHP/Horario_Proyecto_A/Calendar/eventos.php?accion=vaciar',
                 success: function(msg){
                  $('#Calendario').fullCalendar('refetchEvents');
                 }
                 });
     

                }
                
              }
             },

             Alarma:{

              text: 'Conf. Alarm',
              click: function(){
                $("#alarmConf").modal(); 
              }
             }


           },

           dayClick:function(date,jsEvent,view){

            $('#btnAgregar').prop("disabled",false);
            $('#btnEliminar').prop("disabled",true);
            $('#btnModificar').prop("disabled",true);
            $('#alarmButton').prop("disabled",true);
            
            limpiarFormulario()
            $("#txtFechaI").val(date.format());
            $("#txtFechaF").val(date.format());
            $("#ModalEventos").modal();
           },

         events:'http://localhost/IntroduccionPHP/Horario_Proyecto_A/Calendar/eventos.php',

      eventClick:function(calEvent,jsEvent,view){


        $('#btnAgregar').prop("disabled",true);
        $('#btnEliminar').prop("disabled",false);
        $('#btnModificar').prop("disabled",false);
        $('#alarmButton').prop("disabled",false);
         


         $('#tituloEvento').html(calEvent.title);
        
         $('#txtDescripcion').val(calEvent.descripcion);
         $('#txtID').val(calEvent.id);
         $('#txtTitulo').val(calEvent.title);
         $('#txtColor').val(calEvent.color);

         FechaHora = calEvent.start._i.split(" ");
         $('#txtFechaI').val(FechaHora[0]);
         $('#txtHoraI').val(FechaHora[1]);

         alarmNombre = calEvent.title;
         alm = calEvent.start._d;
         Fechahora =  calEvent.end._i.split(" ");
         
         $('#txtFechaF').val(Fechahora[0]);
         $('#txtHoraF').val(Fechahora[1]);

         $("#ModalEventos").modal(); 

         ///Eventos para saber que boton radio esta seleccionado
        
         if(calEvent.color =="#ffba08"){
          $('#uno').click();
         }

         if(calEvent.color =="#f48c06"){
          $('#dos').click();
         }

         if(calEvent.color =="#dc2f02"){
          $('#tres').click();
         }

         if(calEvent.color =="#d00000"){
          $('#cuatro').click();
         }

         if(calEvent.color =="#9d0208"){
          $('#cinco').click();
         }

         if(calEvent.color =="#6a040f"){
          $('#seis').click();
         }
   
         },

         businessHours:true,
         editable:true,
         navLinks: true, 
         eventDrop:function(calEvent){
          eventDrop_=true;
          $('#txtID').val(calEvent.id);
          $('#txtTitulo').val(calEvent.title);
          $('#txtColor').val(calEvent.color);
          $('#txtDescripcion').val(calEvent.descripcion);

          var fechaHora = calEvent.start.format().split("T");
          $('#txtFechaI').val(fechaHora[0]);
          $('#txtHoraI').val(fechaHora[1]);

          fechaHora = calEvent.end.format().split("T");
          $('#txtFechaF').val(fechaHora[0]);
          $('#txtHoraF').val(fechaHora[1]);

          RecolectarDatosGUI();
          EnviarInformacion('modificar',NuevoEvento);
          modal=true;
         
         }
        });
       });

    </script>

    <!-- Modal -->
<div class="modal fade" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloEvento"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <div id="descripcionEvento"></div>
         <input type="hidden" id="txtID" name="txtID"/>
         <input type="hidden"  id="txtFechaI" name="txtFechaI"  />
         
         <div class="form-row">

         <div class="form-group col-md-8">

         <label>Asignatura:</label>
         <input type="text" class="form-control" id="txtTitulo" placeholder="Título del evento">
         </div>

         <div class="form-group col-md-4">
         <label>Hora Inicial:</label>
         <div class="input-group clockpicker" id="" data-autoclose="true">
         <input type="text" id="txtHoraI" class="form-control" value="10:30" />
         </div>
         </div>
         </div>

         <div class="form-row">
         <label>Descripción:</label>
         <textarea id="txtDescripcion" rows="2" class="form-control"></textarea>
         </div>
         <br>
         <div class="form-row">
         <div class="form-group col-md-8">
         <label>Fecha:</label>
         <input type="text" id="txtFechaF"  class="form-control" name="txtFechaF" disabled/>
         </div>
         <div class="form-group col-md-4">
         <label>Hora Final:</label>
         <div class="input-group clockpicker" data-autoclose="true">
          <input type="text" id="txtHoraF"  class="form-control" value="10:30" />
         </div>
         </div>
         </div>
         <br>
         <div class="form-row">
         <input type="hidden" value="#fdb364" id="txtColor"  class="form-control">

        
         <div class="col-md-12" id="grupoRadio">
  
          <input type="radio" name="color_evento" id="uno" value="#ffba08" checked>
          <label for="uno" class="circu" style="background-color: #ffba08;"></label>
        
          <input type="radio" name="color_evento" id="dos" value="#f48c06">  
          <label for="dos" class="circu" style="background-color: #f48c06;"></label>
        
          <input type="radio" name="color_evento" id="tres" value="#dc2f02">  
          <label for="tres" class="circu" style="background-color: #dc2f02;"></label>
        
          <input type="radio" name="color_evento" id="cuatro" value="#d00000">  
          <label for="cuatro" class="circu" style="background-color: #d00000;"></label>
        
          <input type="radio" name="color_evento" id="cinco" value="#9d0208">  
          <label for="cinco" class="circu" style="background-color: #9d0208;"></label>
        
          <input type="radio" name="color_evento" id="seis" value="#6a040f">  
          <label for="seis" class="circu" style="background-color: #6a040f;"></label>
        
        </div>
          

         </div>

        </div>
        <div class="modal-footer">
          <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
          <button type="button" id="btnModificar" class="btn btn-success">Modificar</button>
          <button type="button" id="alarmButton" class="btn btn-success" onclick="setAlarm(this);">Activar Alarma</button>
          <button type="button" id="btnEliminar" class="btn btn-danger">Borrar</button>

        </div>
      </div>
    </div>
  </div>
   
  <script>

   var NuevoEvento;

   $('#btnAgregar').click(function(){
    eventDrop_=false;
    RecolectarDatosGUI();
    EnviarInformacion('agregar',NuevoEvento);
   });

   $('#btnEliminar').click(function(){
    eventDrop_=false;
    var pregunta = confirm("¿Deseas Borrar este Evento?");  
    if(pregunta){
      RecolectarDatosGUI();
      EnviarInformacion('eliminar',NuevoEvento);
    }
    
   });

   $('#btnModificar').click(function(){
    eventDrop_=false;
    RecolectarDatosGUI();
    EnviarInformacion('modificar',NuevoEvento);
   });



   function RecolectarDatosGUI(){

    let a = "";

    // Para saber que boton radio fue clikeado y mandar la informacion a la base de datos
   if(eventDrop_== false){

    if(document.getElementById('uno').checked){
      a = "#uno";
    }
     if(document.getElementById('dos').checked){
      a = "#dos";
    }
     if(document.getElementById('tres').checked){
      a = "#tres";
    }
     if(document.getElementById('cuatro').checked){
      a = "#cuatro";
    }

     if(document.getElementById('cinco').checked){
      a = "#cinco";
    }

     if(document.getElementById('seis').checked){
      a = "#seis";
    }

   }else{
     a="#txtColor"
   }

    NuevoEvento = {
        
        id:$('#txtID').val(),
        title: $('#txtTitulo').val(),
        start: $('#txtFechaI').val()+" "+$('#txtHoraI').val(),
        color: $(a).val(),
        descripcion: $('#txtDescripcion').val(),
        textColor: "#ffffff",
        end: $('#txtFechaF').val()+" "+$('#txtHoraF').val(),
        
    };

    
   
}
   function EnviarInformacion(accion,objEvento){
    modal = false;
    $.ajax({
      type:'POST',
      url:'http://localhost/IntroduccionPHP/Horario_Proyecto_A/Calendar/eventos.php?accion='+accion,
      data:objEvento,
      success: function(msg){
        if(msg){
          $('#Calendario').fullCalendar('refetchEvents');
          if(!modal){
            $("#ModalEventos").modal('toggle');

          }
         
        }
      },

       error:function(){
       alert("Lo siento, se presento un error....");
        }
        
     });
   }

   $('.clockpicker').clockpicker();

   function limpiarFormulario(){

      $('#tituloEvento').html('Nuevo Evento');
      $('#txtID').val('');
      $('#txtTitulo').val('');
      $('#txtColor').val('');
      $('#txtDescripcion').val('');
      $('#uno').click();

   }
  //Alarma
    var alarmSound = new Audio();
		alarmSound.src = 'alarm.mp3';
   
		var alarmTimer;

    function setAlarmTonos(){

    if(document.getElementById('prede').checked){
      alarmSound.src = 'alarm.mp3';
    }
    if(document.getElementById('primera').checked){
      alarmSound.src = '1.mp3';
    }
     if(document.getElementById('segunda').checked){
      alarmSound.src  = '2.mp3';
    }
     if(document.getElementById('tercera').checked){
      alarmSound.src = '3.mp3';
    }


    }

    function setAlarm(button) {

			var alarm = alm;
      console.log(alm);
			var alarmTime = new Date(alarm.getUTCFullYear(), alarm.getUTCMonth(), alarm.getUTCDate(),  alarm.getUTCHours(), alarm.getUTCMinutes(), alarm.getUTCSeconds());
			
			var differenceInMs = alarmTime.getTime() - (new Date()).getTime();

			if(differenceInMs < 0) {
				alert('El tiempo especificado ya ha pasado');
				return;
			}

			alarmTimer = setTimeout(initAlarm, differenceInMs);
			button.innerText = 'Cancelar Alarma';
			button.setAttribute('onclick', 'cancelAlarm(this);');
		};

		function cancelAlarm(button) {
			clearTimeout(alarmTimer);
			button.innerText = 'Activar Alarma';
			button.setAttribute('onclick', 'setAlarm(this);')
		};

		function initAlarm() {
			alarmSound.play();
      $('#NombreEvento').html(alarmNombre +' a iniciado.');
      $("#alarmOptions").modal(); 
      
		};

		function stopAlarm() {
			alarmSound.pause();
			alarmSound.currentTime = 0;
			cancelAlarm(document.getElementById('alarmButton'));
      $('#Detener').prop("disabled",true);
		};


 
     
  </script>
 <!--Modal para la alarma -->
  <div class="modal fade" id="alarmOptions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Notificación</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" value="" id="NombreEvento"> 
        </div>
        <div class="modal-footer">
          <button type="button" onclick="stopAlarm();" class="btn btn-danger" id="Detener">Detener Alarma</button>
        </div>
      </div>
    </div>
  </div>

<!--Modal para la alarma configuracion-->
  <div class="modal fade" id="alarmConf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Configurar Alarma</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" value="" >
        <div class="col-md-12" id="grupoRadio2">
        Escoge el tono de tu alarma:
        <br><br>
        <input type="radio" name="cancion" id="prede" >&nbsp;Predeterminada
        <br>
        <input type="radio" name="cancion" id="primera" >&nbsp;Bee Gees
        <br>
        <input type="radio" name="cancion" id="segunda" >&nbsp;Mareux
        <br>
        <input type="radio" name="cancion" id="tercera" >&nbsp;Borns
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" onclick="setAlarmTonos();" class="btn btn-success"  data-dismiss="modal" >Cambiar Tono de Alarma</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>