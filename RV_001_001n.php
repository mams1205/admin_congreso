<?php

$PageSecurity = 15; // Establece el nivel de seguridad de la página
$App = 'Revisores'; // Define la aplicación como 'CCC' (Catálogo Centro de costos)
$Mod = 'Revisores'; // Define el módulo como 'Proveedores'
include('includes/session.inc'); // Incluye el archivo de sesión para gestionar la autenticación y datos de sesión
$title = 'Revisión Trabajos'; // Establece el título de la página
include('includes/header.inc'); // Incluye el archivo del encabezado de la página

// Abre un formulario HTML con el método POST y la codificación para archivos adjuntos.
echo '<form method="post" 
            enctype="multipart/form-data"
            action="RV_001_001n.php?ID='.$_GET['ID'].'&A='.$_GET['A'].'" />';
echo '<input type=hidden name=FormID value="'.$_SESSION['FormID'].'" />';


$Msg   = ''; // Inicializa la variable de mensaje como una cadena vacía
$vSaleM = 'IN'; // inicia la variable vsaleM con txt IN
$MsgC = 'green';
$SelID = $_GET['ID'];
$nombre_user = $_SESSION['UserID'];
?>
<?php
if ($_GET['A']=='vDet' And $_POST['BtnSav']=='') {
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

if ($_GET['A']=='vCali') {
    $Sql_Ase = "SELECT 
                    CASE
                        WHEN A.modalidad_trabajo = 'O' THEN 'Oral'
                        WHEN A.modalidad_trabajo = 'C' THEN 'Cartel'
                    END AS modalidad   
                FROM trabajos_main A
                WHERE A.ID_trabajo = '$SelID'
                GROUP BY A.ID_trabajo, A.titulo, A.nombre, A.apellido, A.ocupacion";
    $Res_Ase = DB_query($Sql_Ase,$db);
    $Row_Ase = DB_fetch_array($Res_Ase);
 
    $_POST['mod_select']  = $Row_Ase['modalidad'];


}

if (isset($_POST['BtnSend'])) { // Verifica si se envió el formulario
    if (!empty($_POST['total'])) {

        //obtener id del revisor
        $sql_id_rev = "SELECT ID
                FROM Cat_Rev_main A
                WHERE A.user = '$nombre_user'";

        $resultado = DB_query($sql_id_rev, $db);
        $id_rev = null;
        if ($fila = DB_fetch_array($resultado)) {
            $id_rev = $fila['ID'];
        }

        //agregar calificación del trabajo
        if (isset($_POST['total'])) {
            $total_cali = $_POST['total']; // Sanitiza el valor si es necesario
            
            $fecha_calificacion = date("Y-m-d H:i:s");
            $sql_upd_cali = "UPDATE trabajos_rev
                             SET cali = $total_cali,
                                 fecha_calificacion = '$fecha_calificacion'
                             WHERE ID_trabajo = $SelID AND ID_rev = $id_rev";
        
            $res_upd_cali = DB_query($sql_upd_cali, $db);

            //validacion para mmodificar status de trabajo
            $sql_select_status = "SELECT cali FROM trabajos_rev WHERE ID_trabajo = $SelID";
            $resultado_status = DB_query($sql_select_status, $db);

            $valid_status = 1; // Inicialmente, asumimos que todas las calificaciones son válidas

            while ($fila_status = DB_fetch_array($resultado_status)) {
                $valor_cali = $fila_status['cali']; // Obtener la calificación actual
                if ($valor_cali == 0) {
                    $valid_status = 0; // Si encontramos un 0, cambiamos a inválido
                    break; // Salimos del bucle, ya no es necesario seguir verificando
                }
            }

            if($valid_status != 0){
                $sql_upd_main = "UPDATE trabajos_main
                                SET status = 'C'
                                WHERE ID_trabajo = $SelID";

                $res_upd_main = DB_query($sql_upd_main, $db);

            } 
            prnMsgV20('Calificación enviada con éxito...', 'success');
        } else {
            echo "Error: La calificación no es válida.";
        }             
    $vSaleM = 'out';
}
}
?>

<!-- //container principal donde va a estar la tabla  -->
<div class="container" style="margin-top:80px">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-body">
                    <h4>Revisión de Trabajos</h4>
                    <?php if ($Msg != ''): ?>
                        <p style="text-align: center; font-family: Arial; font-size: 16px; color: <?= $MsgC; ?>">
                            <?= $Msg; ?>
                        </p>
                    <?php endif; ?>
                    <div id="tablaRV_001_001"></div>
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
<div class="modal fade" id="Pantalla_Cali" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Calificar Trabajo Postulado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0" style="align-items: center;">Rúbrica de Evaluación</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <p> Asigne una calificación del <strong>1 al 10</strong> para cada una de las siguientes preguntas, donde <strong>1</strong> es la puntuación más baja y <strong>10</strong> la más alta.</p>
                                <div class="form-group">
                                    <label for="criterio1">Pregunta 1?:</label>
                                    <input type="number" class="form-control sum-input" id="criterio1" name="criterio1" min="0" max="10" required>
                                </div>
                                <div class="form-group">
                                    <label for="criterio2">Pregunta 2?:</label>
                                    <input type="number" class="form-control sum-input" id="criterio2" name="criterio2" min="0" max="20" required>
                                </div>
                                <div class="form-group">
                                    <label for="criterio3">Pregunta 3?:</label>
                                    <input type="number" class="form-control sum-input" id="criterio3" name="criterio3" min="0" max="20" required>
                                </div>
                                <div class="form-group">
                                    <label for="criterio4">Pregunta 4?:</label>
                                    <input type="number" class="form-control sum-input" id="criterio4" name="criterio4" min="0" max="20" required>
                                </div>
                                <div class="form-group">
                                    <label for="criterio5">Pregunta 5?:</label>
                                    <input type="number" class="form-control sum-input" id="criterio5" name="criterio5" min="0" max="20" required>
                                </div>
                                <div class="form-group">
                                    <label for="total">Puntaje Total (Max. 100pts):</label>
                                    <input type="number" class="form-control" id="total" name="total" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="mod_select">Modalidad Seleccionada:</label>
                                    <input type="text" class="form-control sum-input" id="mod_select" name="mod_select" value="<?php echo $_POST['mod_select']; ?>"readonly>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <input type="submit" class="btn btn-secondary" name="BtnCer" data-dismiss="modal" value="Cerrar">
                <input type="submit" class="btn btn-success" name="BtnSend" value="Enviar Calificación">
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

if (($_GET['A']=='vCali') and $vSaleM == 'IN') {
    ?>
    <script type="text/javascript">
        $('#Pantalla_Cali').modal('show');
    </script>
    <?php   
  }
include('includes/footer.php'); // Incluye el archivo del pie de página
?>

<!--Agregar el script donde esta la tabla -->
<script type="text/javascript">
   $(document).ready(function() {
      $('#tablaRV_001_001').load('RV_001_001t.php');
   });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        function calcularTotal() {
            let total = 0;
            document.querySelectorAll(".sum-input").forEach(input => {
                total += Number(input.value) || 0; // Sumar solo si hay un valor
            });
            document.getElementById("total").value = total; // Asignar la suma al campo total
        }

        document.querySelectorAll(".sum-input").forEach(input => {
            input.addEventListener("input", calcularTotal); // Llamar a la función en cada cambio
        });
    });
</script>
</body>
</html>

