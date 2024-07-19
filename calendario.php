<?php
  session_start();

  require 'database.php';

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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darenix</title>
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/fullcalendar.min.css">
    <link rel="stylesheet" href="css/bootstrap-clockpicker.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/png" href="img/fenix.png" />

</head>

<body>
    <nav class="navbar navbar-light">
        <div class="btn-group  btn-shadow-none mx-2">
            <button type="button" class="btn dropdown-toggle shadow-none border-0 text-white" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img src="img/user.png" height="50" alt="">
                <?=$user['name']?>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#"></a></li>
                <li><a class="dropdown-item" href="#"><i class='bx bx-cog'></i> Configuración</a></li>
                <li><a class="dropdown-item" href="#"><i class='bx bx-file-find'></i> Novedades</a></li>
                <li><a class="dropdown-item" href="#"><i class='bx bx-line-chart'></i> Registro de
                        actividades</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item rounded-3" href="logout.php"><i class='bx bx-exit'></i> Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </nav>
    <main>
        <section class="container">
            <div class="row">
                <div id="Calendario"></div>
            </div>
        </section>
        <!-- Modal -->
        <div class="modal fade" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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
                        <input type="hidden" id="txtID" name="txtID" />
                        <input type="hidden" id="txtFechaI" name="txtFechaI" />

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
                                <input type="text" id="txtFechaF" class="form-control" name="txtFechaF" disabled />
                            </div>
                            <div class="form-group col-md-4">
                                <label>Hora Final:</label>
                                <div class="input-group clockpicker" data-placement="top" data-align="right"
                                    data-autoclose="true">
                                    <input type="text" id="txtHoraF" class="form-control" value="10:30" />
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <input type="hidden" value="#fdb364" id="txtColor" class="form-control">


                            <div class="col-md-12" id="grupoRadio">
                                <input type="radio" name="color_evento" id="uno" value="#FFB200" checked>
                                <label for="uno" class="circu" style="background-color: #FFB200;"></label>

                                <input type="radio" name="color_evento" id="dos" value="#EB5B00">
                                <label for="dos" class="circu" style="background-color: #EB5B00;"></label>

                                <input type="radio" name="color_evento" id="tres" value="#219C90">
                                <label for="tres" class="circu" style="background-color: #219C90;"></label>

                                <input type="radio" name="color_evento" id="cuatro" value="#E4003A">
                                <label for="cuatro" class="circu" style="background-color: #E4003A;"></label>

                                <input type="radio" name="color_evento" id="cinco" value="#B60071">
                                <label for="cinco" class="circu" style="background-color: #B60071;"></label>
                            </div>


                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnAgregar" class="btn btn-danger">Añadir</button>
                        <button type="button" id="btnModificar" class="btn btn-danger">Editar</button>
                        <button type="button" id="alarmButton" class="btn btn-danger"
                            onclick="setAlarm(this);">Alarma</button>
                        <button type="button" id="btnEliminar" class="btn btn-dark">Borrar</button>

                    </div>
                </div>
            </div>
        </div>
        <!--End Modal--> <!--Modal para la alarma -->
        <div class="modal fade" id="alarmOptions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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
                        <button type="button" onclick="stopAlarm();" class="btn btn-dark" data-dismiss="modal">Detener
                            Alarma</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Modal para la alarma configuracion-->
        <div class="modal fade" id="alarmConf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Configurar Alarma</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" value="">
                        <div class="col-md-12" id="grupoRadio2">
                            Escoge el tono de tu alarma:
                            <br><br>
                            <input type="radio" name="cancion" id="prede" checked>&nbsp;Predeterminada
                            <br>
                            <input type="radio" name="cancion" id="primera">&nbsp;Bee Gees
                            <br>
                            <input type="radio" name="cancion" id="segunda">&nbsp;Mareux
                            <br>
                            <input type="radio" name="cancion" id="tercera">&nbsp;Borns
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="setAlarmTonos();" class="btn btn-danger"
                            data-dismiss="modal">Cambiar tono de alarma</button>
                    </div>
                </div>
            </div>
        </div>
        <!--End-->
        <!--Modal Vaciar -->
        <div class="modal fade" id="Vaciar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Vaciar Calendario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" value="">
                        <div class="col-md-12">
                            ¿Deseas Borrar todos los Eventos?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="VaciarCalendario();" class="btn btn-dark"
                            data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/moment.min.js"></script>
    <script type="text/javascript" src="js/fullcalendar.min.js"></script>
    <script src="js/bootstrap-clockpicker.js"></script>
    <script src='js/es.js'></script>
    <script src="js/popper.min.js"></script>
    <script src="js/fullcalendar.js"></script>
</body>

</html>