<?php

$PageSecurity = 15; // Establece el nivel de seguridad de la página
$App = 'Temas'; // Define la aplicación como 'CCC' (Catálogo Centro de costos)
$Mod = 'Temas'; // Define el módulo como 'Proveedores'
include('includes/session.inc'); // Incluye el archivo de sesión para gestionar la autenticación y datos de sesión
$title = 'Catalogo de Temas'; // Establece el título de la página
include('includes/header.inc'); // Incluye el archivo del encabezado de la página

// Abre un formulario HTML con el método POST y la codificación para archivos adjuntos.
echo '<form method="post" 
            enctype="multipart/form-data"
            action="AP_003_002n.php?ID='.$_GET['ID'].'&A='.$_GET['A'].'" />';
echo '<input type=hidden name=FormID value="'.$_SESSION['FormID'].'" />';


$Msg   = ''; // Inicializa la variable de mensaje como una cadena vacía
$vSaleM = 'IN'; // inicia la variable vsaleM con txt IN
$MsgC = 'green';
$SelID = $_GET['ID'];


// si A toma el valor de vMod entonces inserta estas variables en el formulario
if ($_GET['A']=='vMod' And $_POST['BtnSav']=='') {
    $Sql_Ase = "SELECT * FROM Cat_temas WHERE ID_tema = '".$SelID."'";
    $Res_Ase = DB_query($Sql_Ase,$db);
    $Row_Ase = DB_fetch_array($Res_Ase);
 
    $_POST['tema']  = $Row_Ase['tema'];
    $_POST['ID'] = $Row_Ase['ID_tema'];

    echo '<input type=hidden
                 name=ID_tema
                 value="'.$_POST['ID'].'" />';
}


// al dar click en guardar insertar los datos de los campos en la database
if ($_POST['BtnSav']=='Guardar') {
    $sql = "INSERT INTO Cat_temas (tema, status) 
                                    VALUES ( '".$_POST['tema']."'
                                            ,'A')";
        $res  = DB_query($sql,$db);
        $Msg  = 'Se agrego Nuevo Tema '.$_POST['tema'];
        $MsgC = 'green'; 
        unset ($_POST['tema']);
        $vSaleM = 'OUT';
}

// Verifica si el parámetro 'A' en la URL es igual a 'vEli', lo que indica que se debe realizar una eliminación.
if ($_GET['A']=='vEli') {
    // Construye una consulta SQL para eliminar el ID seleccionado.
        $Del_CC = "UPDATE Cat_temas
                    SET status = 'D'
                    WHERE ID_tema =".$SelID;
        $Res_CC = DB_query($Del_CC,$db);  
        prnMsgV20('Se ha eliminado el Tema : '.$SelID.' ...','success');
}

//Si el boton es modificar entonces ejecuta esto
if ($_POST['BtnSav'] == 'Modificar') {
    // Asegúrate de que $_POST['ID_CC'] esté definido y no esté vacío
    if (isset($_POST['ID_tema']) && !empty($_POST['ID_tema'])) {
        $ID_tema = mysqli_real_escape_string($db, $_POST['ID_tema']);
        $nombre_tema = mysqli_real_escape_string($db, $_POST['tema']);

    //QUERY SQL
        $UPD_CC = "UPDATE Cat_temas
                    SET tema = '$nombre_tema'
                    WHERE ID_tema = $SelID";
        $res_cc = DB_query($UPD_CC, $db);

        if ($res_cc) {
            prnMsgV20('Se ha modificado el tema # : '.$ID_tema.' ...','success');
        } else {
            $Msg = 'Error al modificar el tema #: '.$ID_tema.'';
            $MsgC = 'red';
        }

        $vSaleM = 'OUT';
    } else {
        $Msg = 'ID del tema no proporcionado';
        $MsgC = 'red';
    }
}

//container principal donde va a estar la tabla 
echo '<div class="container" style="margin-top:80px">
    <div class="row">
        <div class="col-sm-12">
            <div class="card text-left">
                <div class="card-body">
                    <h4>Catálogo de Temas</h4>';
                    if ($Msg<>'')
                        echo '<p style="text-align: center;font-family:Arial;font-size:16px;color:'.$MsgC.'">'.$Msg.'</p>';
                            //<!-- Párrafo con estilo centrado, fuente Arial, tamaño 16px y color determinado por la variable $MsgC -->
                        echo '<a href="AP_003_002n.php?A=vNew" class="btn btn-primary" role="button">
                        Agregar
                        <span class="pl-2 fas fa-plus-circle"></span>
                        </a>';
                    echo '<div id="tablaAP_003_002"></div>';
                    //Contenedor vacío con el ID 'tablaCC_003_001' para cargar dinámicamente la tabla de centro de costos
echo'           </div>
            </div>
        </div>
    </div>
</div>';

if ($_GET['A']=='vNew') {
    $TituloModal = 'Agregar Nuevo Tema';
    $_POST['estatus'] = 1;
  }

if ($_GET['A']=='vMod') $TituloModal = 'Modificar Tema';

/***
* Modal Pantalla de Datos para agregar nuevo centro de costos
*/
// Modal HTML
echo '<div class="modal fade" id="PantallaDatos" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">'.$TituloModal.'</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';

echo'           <div class = "modal-body">
                    <div class = "row">
                        <div class="col-sm-12">
                            <div class="slic-form-group row">
                                <label for="nombre" class="col-sm-3 col-slic-label">Tema:</label>
                                <div class = "col-sm-4">
                                    <input  type="text" 
                                            class="slic-input" 
                                            name="tema"
                                            value = "'.$_POST['tema'].'"
                                    />
                                </div>
                            </div>';
echo'                  </div>
                    </div>
                </div>';
echo '          <div class="modal-footer">';
echo '          <input type=Submit class="btn btn-secondary" name=BtnCer data-dismiss="modal" value=Cerrar>';
                if ($_GET['A']=='vNew') 
echo '              <input type=Submit class="btn btn-primary" name=BtnSav value=Guardar>';
                if ($_GET['A']=='vMod')
echo '              <input type=Submit class="btn btn-primary" name=BtnSav value=Modificar>';
echo '          </div>
            </div>
        </div>
    </div>';

/***
* Modal Eliminar
*/
echo '<div class="modal fade" id="ConfirmaDel" tabindex="-1" role="dialog">
         <div class="modal-dialog modal-sm">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">Eliminar Tema</h5>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <div class="modal-body">
                  <p>Confirme para eliminar el Tema ID #'.$SelID .'</p>
               </div>
               <div class="modal-footer">
                  <input type=submit class="btn btn-secondary" name=BtnCer data-dismiss="modal" value=Cerrar>
                  <a href="AP_003_002n.php?A=vEli&ID='.$SelID .'" class="btn btn-primary" 
                     role=button >Eliminar</a>
               </div>
            </div>
         </div>
      </div>';
/****/


//script para activar el modal de nuevo centro de costo
if (($_GET['A']=='vNew' Or $_GET['A']=='vMod') and $vSaleM == 'IN') {
    ?>
    <script type="text/javascript">
        $('#PantallaDatos').modal('show');
    </script>
    <?php   
  }

// script para activar el modal de eliminar centro de costo
if ($_GET['A']=='vDel') {
    ?>
    <script type="text/javascript">
        $('#ConfirmaDel').modal('show'); 
    </script>
    <?php
}
include('includes/footer.php'); // Incluye el archivo del pie de página
?>

<!--Agregar el script donde esta la tabla -->
<script type="text/javascript">
   $(document).ready(function() {
      $('#tablaAP_003_002').load('AP_003_002t.php');
   });
</script>
</body>
</html>

