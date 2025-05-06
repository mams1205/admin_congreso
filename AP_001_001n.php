<?php

$PageSecurity = 15; // Establece el nivel de seguridad de la página
$App = 'Revisores'; // Define la aplicación como 'CCC' (Catálogo Centro de costos)
$Mod = 'Revisores'; // Define el módulo como 'Proveedores'
include('includes/session.inc'); // Incluye el archivo de sesión para gestionar la autenticación y datos de sesión
$title = 'Control Resúmenes'; // Establece el título de la página
include('includes/header.inc'); // Incluye el archivo del encabezado de la página

// Abre un formulario HTML con el método POST y la codificación para archivos adjuntos.
echo '<form method="post" 
            enctype="multipart/form-data"
            action="AP_001_001n.php?ID='.$_GET['ID'].'&A='.$_GET['A'].'" />';
echo '<input type=hidden name=FormID value="'.$_SESSION['FormID'].'" />';


$Msg   = ''; // Inicializa la variable de mensaje como una cadena vacía
$vSaleM = 'IN'; // inicia la variable vsaleM con txt IN
$MsgC = 'green';
$SelID = $_GET['ID'];


// si A toma el valor de vMod entonces inserta estas variables en el formulario
if ($_GET['A']=='vDet' And $_POST['BtnSav']=='') {//ver detalle de la postulacion
    $Sql_Ase = "SELECT 
                    A.nombre,
                    A.apellido,
                    p.nombre as nacionalidad,
                    A.institucion,
                    A.mail,
                    CASE
                        WHEN A.ocupacion = 'EL' THEN 'Estudiante Lic.'
                        WHEN A.ocupacion = 'EM' THEN 'Estudiante Maestría'
                        WHEN A.ocupacion = 'ED' THEN 'Estudiante Doctorado'
                        WHEN A.ocupacion = 'P' THEN 'Profesionista'
                    END AS ocupacion,
                    CASE
                        WHEN A.modalidad_trabajo = 'O' THEN 'Oral'
                        WHEN A.modalidad_trabajo = 'C' THEN 'Cartel'
                    END AS modalidad,
                    CASE
                        WHEN A.concurso = 'SI' THEN 'SI'
                        WHEN A.concurso = 'NO' THEN 'NO'
                    END AS concurso,
                    A.modalidad_concurso AS mod_concurso,
                    GROUP_CONCAT(DISTINCT C.tema SEPARATOR ', ') AS temas,
                    A.titulo_eng,
                    A.titulo,
                    GROUP_CONCAT(DISTINCT D.co_autor SEPARATOR ',') AS autores   
                FROM trabajos_main A
                LEFT JOIN trabajos_detalle_tema B ON B.ID_trabajo = A.ID_trabajo
                LEFT JOIN Cat_temas C ON C.ID_tema = B.tema
                LEFT JOIN trabajos_detalle_authors D ON D.ID_trabajo = A.ID_trabajo
                LEFT JOIN paises p ON p.iso = A.nacionalidad
                WHERE A.ID_trabajo = '$SelID'
                GROUP BY A.ID_trabajo, A.titulo, A.nombre, A.apellido, A.ocupacion";
    $Res_Ase = DB_query($Sql_Ase,$db);
    $Row_Ase = DB_fetch_array($Res_Ase);
 
    $_POST['nombre']  = $Row_Ase['nombre'];
    $_POST['apellido']  = $Row_Ase['apellido'];
    $_POST['mail'] = $Row_Ase['mail'];
    $_POST['nationality']  = $Row_Ase['nacionalidad'];
    $_POST['institution']  = $Row_Ase['institucion'];
    $_POST['ocupacion']  = $Row_Ase['ocupacion'];
    $_POST['modalidad']  = $Row_Ase['modalidad'];
    $_POST['concurso']  = $Row_Ase['concurso'];
    $_POST['mod_concurso']  = $Row_Ase['mod_concurso'];
    $_POST['temas']  = $Row_Ase['temas'];
    $_POST['titulo_eng']  = $Row_Ase['titulo_eng'];
    $_POST['titulo']  = $Row_Ase['titulo'];
    $_POST['autores']  = $Row_Ase['autores'];

}

?>
<?php
if ($_GET['A']=='vRev') {// enviar revision

    $sql = "SELECT A.ID, A.nombre FROM Cat_Rev_main A
            LEFT JOIN trabajos_detalle_authors B ON B.co_autor = A.nombre AND B.ID_trabajo = $SelID
            LEFT JOIN trabajos_main C ON C.primer_autor_name = A.nombre AND C.ID_trabajo = $SelID
            WHERE B.ID_trabajo IS NULL 
            GROUP BY A.ID, A.nombre";
    $resultado = DB_query($sql, $db);
}

if (($_GET['A']=='vSResul' Or $_GET['A']=='vWResul')) {//enviar resultado
    $Sql_Ase = "SELECT 
                    CASE
                        WHEN A.modalidad_trabajo = 'O' THEN 'Oral'
                        WHEN A.modalidad_trabajo = 'C' THEN 'Cartel'
                    END AS modalidad
                FROM trabajos_main A
                WHERE A.ID_trabajo = '$SelID'";
    $Res_Ase = DB_query($Sql_Ase,$db);
    $Row_Ase = DB_fetch_array($Res_Ase);
    $_POST['mod_select']  = $Row_Ase['modalidad'];


    // Consulta para obtener el correo del revisor
    $sql= "SELECT B.ID, A.cali, A.fecha_envio, A.fecha_calificacion, B.nombre as revisor
            FROM trabajos_rev A 
            LEFT JOIN Cat_Rev_main B ON B.ID = A.ID_rev
            WHERE ID_trabajo = $SelID";
    $resultado_revisores = DB_query($sql, $db);

    $sql_cali = "SELECT SUM(A.cali)/(SELECT num_revisores FROM tota_revisores) AS calif_gral FROM trabajos_rev A WHERE A.ID_trabajo = $SelID";
    $res_cali = DB_query($sql_cali, $db);
    $Row_cali = DB_fetch_array($res_cali);
    $calificacion_gral = $Row_cali['calif_gral'];

    $sql_valores = "SELECT * FROM puntajes";
    $res_valores = DB_query($sql_valores, $db);
    $Row_valores = DB_fetch_array($res_valores);
    $min_aprob = isset($Row_valores['min_aprob']) ? (float)$Row_valores['min_aprob'] : 0;
    $min_oral = isset($Row_valores['min_oral']) ? (float)$Row_valores['min_oral'] : 0;

    //resultado
    if ($_POST['mod_select'] == 'Oral') {
        // Verificar si la calificación general alcanza el mínimo aprobado
        if ($calificacion_gral >= $min_aprob) {
            // Si también cumple el mínimo requerido para modalidad Oral
            if ($calificacion_gral >= $min_oral) {
                $resultado_final = 'Aprobado';
                $resultado_modalidad = 'Oral';
            // Si no lo cumple entonces se va para cartel
            } else {
                $resultado_final = 'Aprobado';
                $resultado_modalidad = 'Cartel';
            }
        // si no alcanza el minimo entonces es rechazado
        } else {
            $resultado_final = 'Rechazado';
            $resultado_modalidad = 'Rechazado';
        }
    // si no selecciono presentacion oral
    } else {
        // Para modalidades distintas de "Oral"
        if ($calificacion_gral >= $min_aprob) {
            $resultado_final = 'Aprobado';
            $resultado_modalidad = 'Cartel';
        } else {
            $resultado_final = 'Rechazado';
            $resultado_modalidad = 'Rechazado';
        }
    }
}

if (isset($_POST['BtnSend'])) { // Verifica si se envió el formulario
    if (!empty($_POST['revisores'])) {
        $sql_upd = "UPDATE trabajos_main SET status = 'E' WHERE ID_trabajo = '$SelID'";
        $res_upd = DB_query($sql_upd, $db);

        $revisoresSeleccionados = $_POST['revisores']; // Es un array con los IDs seleccionados

        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        $from = "postulacion_congreso@resumen-somemma.com";
        $subject = "Revisiión Resumen XXXIX Reunión Internacional para El Estudio de los Mamíferos Marinos";
        $fecha_envio = date("Y-m-d H:i:s");
        foreach ($revisoresSeleccionados as $revisor) {

            $sql_insert = "INSERT INTO trabajos_rev (ID_trabajo, ID_rev, Status, cali, fecha_envio)
                        VALUES ($SelID, $revisor, 'A', 0, '$fecha_envio')";
            $res_insert = DB_query($sql_insert, $db);
            // Consulta para obtener el correo del revisor
            $sql = "SELECT mail FROM Cat_Rev_main WHERE ID = $revisor";
            $resultado = DB_query($sql, $db);

            

            if ($row = DB_fetch_array($resultado)) {
                $to = $row['mail']; // Obtener el correo del revisor

                // Construcción del mensaje
                $message = "Estimado Revisor,\n\n";
                $message .= "Le informamos que se le ha asignado un resumen para revisión en el marco de la XXXIX Reunión Internacional para el Estudio de los Mamíferos Marinos.\n\n";
                $message .= "Le agradecemos su colaboración en este proceso. Para acceder al resumen y proporcionar sus comentarios, por favor inicie sesión en nuestro sistema de revisiones la cual puede encontrar en el siguiente link https://resumen-somemma.com/indexppal.php.\n\n";
                $message .= "Si tiene alguna duda o requiere asistencia, no responda a este correo, ya que está configurado como una dirección no respondible. En su lugar, contáctenos a través de: difusion.somemma@gmail.com.\n\n";
                $message .= "Atentamente,\n";
                $message .= "El Comité Organizador de la XXXIX Reunión Internacional para el Estudio de los Mamíferos Marinos.";
                $headers = "From:" . $from;

                // Enviar el correo
                if (mail($to, $subject, $message, $headers) && $res_upd) {
                    // Actualizar estado del trabajo antes de enviar correos
                    
                    prnMsgV20('Trabajo enviado a revisión con éxito...', 'success');
                    // prnMsgV20('Se ha enviado el trabajo a revisión ...', 'success');
                } else {
                    prnMsgV20('Error al enviar el trabajo: ' . DB_error($db), 'error');
                        }
            } else {
                echo "No se encontró correo para el revisor con ID: $revisor <br>";
            }
        }
    } else {
        echo "No seleccionaste ningún revisor.";
    }

    $vSaleM = 'out';
}

if (isset($_POST['BtnSResul'])) { // Verifica si se envió el formulario
    $fecha_resultado = date("Y-m-d H:i:s");
    $sql = "SELECT titulo, primer_autor_name, mail
            FROM trabajos_main
            WHERE ID_trabajo = $SelID";
    $resultado_mail = DB_query($sql, $db);

    $resultado_postul = $_POST['resultado_final'];
    if($resultado_postul == 'Aprobado'){
        $status_final = 'A';
    }else{
        $status_final = 'X';
    }
    $mod_asign = $_POST['mod_asign'];

    $sql_status = "UPDATE trabajos_main 
                   SET status = '$status_final',
                       fecha_resultado = '$fecha_resultado',
                       mod_asignada = '$mod_asign'
                   WHERE ID_trabajo = $SelID";
    $resultado_status = DB_query($sql_status, $db);
    
    if ($row_mail = DB_fetch_array($resultado_mail)) {  // Verificar que hay resultados
        
        

        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        $from = "postulacion_congreso@resumen-somemma.com";
        $subject = "Resultado Registro XXXIX Reunión Internacional para El Estudio de los Mamíferos Marinos";
        $fecha_envio = date("Y-m-d H:i:s");

        $to = $row_mail['mail']; // Obtener el correo del postulante
        $postulante = $row_mail['primer_autor_name'];
        $titulo = $row_mail['titulo']; // Se extrae correctamente el título

        // Construcción del mensaje
        $message = "Estimado/a $postulante,\n\n";
        $message .= "Por medio de la presente le informamos que el trabajo titulado: \"$titulo\" ha sido $resultado_postul para su presentación en la modalidad $mod_asign.\n\n";
        $message .= "Si tiene alguna duda o requiere asistencia, no responda a este correo, ya que está configurado como una dirección no respondible. En su lugar, contáctenos a través de: difusion.somemma@gmail.com.\n\n";
        $message .= "Atentamente,\n";
        $message .= "El Comité Organizador de la XXXIX Reunión Internacional para el Estudio de los Mamíferos Marinos.";

        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: difusion.somemma@gmail.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Enviar el correo y verificar resultado
        if (mail($to, $subject, $message, $headers)) {
            prnMsgV20('Resultado enviado con éxito...', 'success');
        } else {
            prnMsgV20('Error al enviar el correo.', 'error');
        }
    } else {
        echo "No se encontró correo para el trabajo con ID: $SelID <br>";
    }
    $vSaleM = 'out'; 
}





?>

<!-- //container principal donde va a estar la tabla  -->
<div class="container" style="margin-top:80px">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-body">
                    <h4>Control de Solicitudes</h4>

                    <?php if ($Msg != ''): ?>
                        <p style="text-align: center; font-family: Arial; font-size: 16px; color: <?= $MsgC; ?>">
                            <?= $Msg; ?>
                        </p>
                    <?php endif; ?>
                    <div id="tablaAP_001_001"></div>
                    <!-- Contenedor vacío con el ID 'tablaAP_003_001' para cargar dinámicamente la tabla -->
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Pantalla de Datos para agregar nuevo centro de costos -->
<div class="modal fade" id="PantallaDatos" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalle de Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="slic-form-group row">
                            <label for="nombre" class="col-sm-12 col-slic-label">Nombre(s) y Apellido(s)</label>
                            <div class="col-sm-6">
                                <input type="text" class="slic-input" name="nombre" value="<?php echo $_POST['nombre']; ?>" readonly />
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="slic-input" name="apellido" value="<?php echo $_POST['apellido']; ?>" readonly />
                            </div>
                        </div>
                        <div class="slic-form-group row">
                            <div class="col-sm-12">
                                <label for="mail" class="col-sm-12 col-slic-label">Mail</label>
                                <input type="text" class="slic-input" name="mail" value="<?php echo $_POST['mail']; ?>" readonly/>
                            </div>
                        </div>
                        <div class="slic-form-group row">
                            <div class="col-sm-12">
                                <label for="nationality" class="col-sm-12 col-slic-label">Nacionalidad</label>
                                <input type="text" class="slic-input" name="nationality" value="<?php echo $_POST['nationality']; ?>" readonly/>
                            </div>
                        </div>
                        <div class="slic-form-group row">
                            <div class="col-sm-12">
                                <label for="institution" class="col-sm-3 col-slic-label">Institución</label>
                                <input type="text" class="slic-input" name="institution" value="<?php echo $_POST['institution']; ?>" readonly/>
                            </div>
                        </div>
                        <div class="slic-form-group row">
                            <div class="col-sm-6">
                                <label for="ocupacion" class="col-sm-6 col-slic-label">Ocupación</label>
                                <input type="text" class="slic-input" name="ocupacion" value="<?php echo $_POST['ocupacion']; ?>" readonly/>
                            </div>
                            <div class="col-sm-6">
                                <label for="modalidad" class="col-sm-6 col-slic-label">Modalidad</label>
                                <input type="text" class="slic-input" name="modalidad" value="<?php echo $_POST['modalidad']; ?>" readonly/>
                            </div>
                        </div>

                        <div class="slic-form-group row">
                            <div class="col-sm-6">
                                <label for="concurso" class="col-sm-6 col-slic-label">Participa en concurso?</label>
                                <input type="text" class="slic-input" name="concurso" value="<?php echo $_POST['concurso']; ?>" readonly/>
                            </div>
                            <div class="col-sm-6">
                                <label for="mod_concurso" class="col-sm-6 col-slic-label">Modalidad Concurso</label>
                                <input type="text" class="slic-input" name="mod_concurso" value="<?php echo $_POST['mod_concurso']; ?>" readonly/>
                            </div>
                        </div>

                        <div class="slic-form-group row">
                            <div class="col-sm-12">
                                <label for="temas" class="col-sm-12 col-slic-label">Temas</label>
                                <input type="text" class="slic-input" name="temas" value="<?php echo $_POST['temas']; ?>" readonly/>
                            </div>
                        </div>
                        <div class="slic-form-group row">
                            <div class="col-sm-12">
                                <label for="titulo_eng" class="col-sm-12 col-slic-label">Título (Eng)</label>
                                <textarea class="slic-input" name="titulo_eng" rows="2" readonly
                                          style="width: 100%; height: auto; min-height: 60px; resize: vertical; overflow-wrap: break-word; white-space: normal;">
                                <?php echo str_replace(array("\r", "\n"), ' ', htmlspecialchars($_POST['titulo_eng'] ?? '', ENT_QUOTES, 'UTF-8'));?>
                            </textarea>
                            </div>
                        </div>
                        <div class="slic-form-group row">
                            <div class="col-sm-12">
                                <label for="titulo" class="col-sm-12 col-slic-label">Titulo</label>
                                <textarea class="slic-input" name="titulo" rows="2" readonly 
                                          style="width: 100%; height: auto; min-height: 60px; resize: vertical; overflow-wrap: break-word; white-space: normal;">
                                <?php echo str_replace(array("\r", "\n"), ' ', htmlspecialchars($_POST['titulo'] ?? '', ENT_QUOTES, 'UTF-8')); ?>
                                </textarea>                           
                            </div>
                              
                        </div>
                        <div class="slic-form-group row">
                            <div class="col-sm-12">
                                <label for="autores" class="col-sm-12 col-slic-label">Co-Autores</label>
                                <textarea rows = "2" class="slic-input" name="autores" readonly
                                        style="width: 100%; height: auto; min-height: 60px; resize: vertical; overflow-wrap: break-word; white-space: normal;">
                                        <?php echo $_POST['autores']; ?>
                                </textarea>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <input type="submit" class="btn btn-secondary" name="BtnCer" data-dismiss="modal" value="Cerrar">
            </div>
        </div>
    </div>
</div>

<!-- modal pantalla de revisores -->
<div class="modal fade" id="PantallaRev" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Enviar a Revisión</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 d-flex justify-content-center align-items-center" style="height: 100%;">
                        <div class="slic-form-group row w-100">
                            <label for="nombre" class="col-sm-12 col-slic-label text-center">Seleccionar Revisores</label>

                            <!-- Contenedor con scroll -->
                            <div style="max-height: 300px; overflow-y: auto; width: 100%;">
                                <div class="row">
                                    <?php if ($resultado): ?>
                                        <?php while ($row = DB_fetch_array($resultado)): ?>
                                            <div class="col-md-3 col-sm-6 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="revisores[]" value="<?php echo $row['ID']; ?>" id="tema<?php echo $row['ID']; ?>">
                                                    <label class="form-check-label" for="tema<?php echo $row['ID']; ?>">
                                                        <?php echo htmlspecialchars($row['nombre']); ?>
                                                    </label>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <div class="col-12 text-center">
                                            <p>No hay revisores disponibles.</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- Fin contenedor con scroll -->

                        </div>
                    </div>
                </div>
            </div>



            <div class="modal-footer">
                <input type="submit" class="btn btn-secondary" name="BtnCer" data-dismiss="modal" value="Cerrar">
                <input type="submit" class="btn btn-success" name="BtnSend" value="Enviar">
                <!-- <a href="AP_001_001n.php?A=vSnd&ID=<?php echo urlencode($SelID); ?>" class="btn btn-primary" role="button">Enviar</a> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="PantallaCali" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Enviar Resultado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0" style="align-items: center;">Evaluaciónes y Resultado</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Mostrar los temas desde la base de datos -->
                                <?php if ($resultado_revisores && DB_num_rows($resultado_revisores) > 0): ?>
                                    <?php while ($row = DB_fetch_assoc($resultado_revisores)): ?>
                                        <?php
                                        // Verifica si el HTML se está generando
                                        echo "<div class='form-group'>";
                                        echo "<label class='d-block'>Revisor: " . $row['revisor'] . "</label>";
                                        echo "<label class='d-block'>Fecha de Envío: " . $row['fecha_envio'] . "</label>";
                                        echo "<label class='d-block'>Fecha de Revisión: " . $row['fecha_calificacion'] . "</label>";
                                        echo "<label class='d-block'>Calificación:</label>";
                                        echo "<input id='calif_" . $row['ID'] . " type='number' class='form-control' value='" . (isset($row['cali']) ? $row['cali'] : '') . "' readonly>";
                                        echo "</div>";
                                        ?>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <p>No hay calificaciones disponibles.</p>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="mod_select">Modalidad Seleccionada:</label>
                                    <input type="text" class="form-control" id="mod_select" name="mod_select" 
                                            value="<?= isset($_POST['mod_select']) ? $_POST['mod_select'] : ''; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="mod_select">Promedio:</label>
                                    <input type="text" class="form-control" id="cal_gral" name="cal_gral" 
                                            value="<?= isset($calificacion_gral) ? $calificacion_gral : ''; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="mod_select">Resultado:</label>
                                    <input type="text" class="form-control" id="resultado_final" name="resultado_final" 
                                            value="<?= isset($resultado_final) ? $resultado_final : ''; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="mod_select">Modalidad Asignada:</label>
                                    <input type="text" class="form-control" id="mod_asign" name="mod_asign" 
                                            value="<?= isset($resultado_modalidad) ? $resultado_modalidad : ''; ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-secondary" name="BtnCer" data-dismiss="modal" value="Cerrar">
                <?php if ($_GET['A'] == 'vSResul') { ?> 
                    <input type="submit" class="btn btn-success" id="BtnSResul" name="BtnSResul" value="Enviar Resultado">
                <?php } ?>
            </div>
        </div>
    </div>
</div>




<?php
//script para activar el modal de nuevo centro de costo
if (($_GET['A']=='vDet') and $vSaleM == 'IN') {
    ?>
    <script type="text/javascript">
        $('#PantallaDatos').modal('show');
    </script>
    <?php   
  }

if (($_GET['A']=='vRev') and $vSaleM == 'IN') {
    ?>
    <script type="text/javascript">
        $('#PantallaRev').modal('show');
    </script>
    <?php   
  }

  if (($_GET['A']=='vSResul' Or $_GET['A']=='vWResul') and $vSaleM == 'IN') {
    ?>
    <script type="text/javascript">
        $('#PantallaCali').modal('show');
    </script>
    <?php   
  }
include('includes/footer.php'); // Incluye el archivo del pie de página
?>



<!--Agregar el script donde esta la tabla -->
<script type="text/javascript">
   $(document).ready(function() {
      $('#tablaAP_001_001').load('AP_001_001t.php');
   });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let calificaciones = document.querySelectorAll(".form-control[readonly]"); 
        let btnEnviar = document.getElementById("BtnSResul");

        function verificarCalificaciones() {
            for (let input of calificaciones) {
                if (parseFloat(input.value) === 0 || input.value.trim() === "") {
                    btnEnviar.disabled = true;
                    return;
                }
            }
            btnEnviar.disabled = false;
        }

        verificarCalificaciones(); // Ejecutar la verificación al cargar

        // Si hay un cambio (por si en algún caso se editan dinámicamente)
        calificaciones.forEach(input => {
            input.addEventListener("input", verificarCalificaciones);
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let resultadoInput = document.getElementById("resultado_final");
        let resultado_modalidadInput = document.getElementById("mod_asign");

        function cambiarEstilosResultado() {
            let valor = resultadoInput.value.trim().toLowerCase(); // Obtener el valor en minúsculas
            let valor_modalidad = resultado_modalidadInput.value.trim().toLowerCase(); // Obtener el valor en minúsculas

            if (valor === "aprobado") {
                resultadoInput.style.borderColor = "green";
                resultadoInput.style.backgroundColor = "#d4edda"; // Verde claro

                resultado_modalidadInput.style.borderColor = "green";
                resultado_modalidadInput.style.backgroundColor = "#d4edda"; // Verde claro
            } else if (valor === "rechazado") {
                resultadoInput.style.borderColor = "red";
                resultadoInput.style.backgroundColor = "#f8d7da"; // Rojo claro

                resultado_modalidadInput.style.borderColor = "red";
                resultado_modalidadInput.style.backgroundColor = "#f8d7da"; // Rojo claro
            }
        }

        cambiarEstilosResultado(); // Ejecutar al cargar

        // También ejecutar cuando los valores cambien
        resultadoInput.addEventListener("input", cambiarEstilosResultado);
        resultado_modalidadInput.addEventListener("input", cambiarEstilosResultado);
    });
</script>

</body>
</html>

