<?php
  include('conexion_bd.php');

  if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
    $sql_foto = "SELECT 
                    ID_FOTO,
                    ruta_foto
                FROM 
                    fotos
                ORDER BY RAND()
                LIMIT 1";
    $resultado_fotos = mysqli_query($conexion, $sql_foto);

    /// Verificar si la consulta devolvió resultados
    if (mysqli_num_rows($resultado_fotos) > 0) {
        $resultado_fotos = mysqli_query($conexion, $sql_foto);

        // Obtener el resultado en una variable asociativa
        $foto = mysqli_fetch_assoc($resultado_fotos);
        
        // Acceder a un campo, por ejemplo, la ruta
        $ruta_foto = $foto['ruta_foto']; // Asegúrate de que la columna se llama 'ruta'
    } else {
      echo "No se encontraron resultados de fotos.";
    }

    // query obtener los temas disponibles
    $sql = "SELECT ID_tema, tema
            FROM Cat_temas
            ORDER BY 
                CASE 
                    WHEN tema = 'SILAMA' THEN 0
                    ELSE 1
                END,
                tema ASC";
    $resultado = mysqli_query($conexion, $sql);

    //mails que ya subieron algun trabajo
    $sql_mails_ready = "SELECT DISTINCT(mail)
                  FROM trabajos_main";
    $resultado_mails = mysqli_query($conexion, $sql_mails_ready);

        //array vacio
    $array_mails =[];

    // Recorrer y mostrar cada fila de la tabla
    while ($fila = mysqli_fetch_assoc($resultado_mails)) {
        $array_mails[]=trim(strtolower($fila['mail'])); //se agrega la fila al array
    }
    // $array_mails = array_column($resultado->fetch_all(MYSQLI_ASSOC), "mail");
    // Convertir el array de PHP a JSON para usarlo en JavaScript
    $correosJson = json_encode($array_mails);

    //consulta de los coautores
    $sql_coautores = "SELECT DISTINCT(nombre)
                      FROM Cat_Rev_main
                      order by nombre ASC";
    $resultado_coautores = mysqli_query($conexion, $sql_coautores);

        //array vacio
    $array_coautores =[];

    // Recorrer y mostrar cada fila de la tabla
    while ($fila = mysqli_fetch_assoc($resultado_coautores)) {
        $array_coautores[]=trim($fila['nombre']); //se agrega la fila al array
    }
    // $array_mails = array_column($resultado->fetch_all(MYSQLI_ASSOC), "mail");
    // Convertir el array de PHP a JSON para usarlo en JavaScript
    $coautores_Json = json_encode($array_coautores);


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'head.php'; ?>
    </head>

    <body>
        <?php include 'header.php'; ?>
         <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb" style = "background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 20, 66, 0.7)), url('<?php echo $ruta_foto; ?>');  background-position: center;     background-size: cover;
              background-repeat: no-repeat;";  >
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 style="font-family: 'Nunito';"class="text-white display-3 display-md-2 display-lg-1 mb-4 wow fadeInDown" data-wow-delay="0.1s">Registro</h4> 
            </div>
        </div>
        <main class="main">       

            <!-- <instrucciones -->
            <div class="container-fluid feature py-5">
                <div class="container py-5">
                    <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                        <h1 class="display-3 text-capitalize mb-3" style="font-size:xxx-large; color: #001442;">
                            GUÍA PARA EL ENVÍO DE RESÚMENES
                        </h1>
                        <hr style="border: none; border-top: 5px solid darkblue;">
                    </div>

                    <!-- primeras instrucciones -->
                    <div class="row">
                        <div class="col-md-4">
                            <img src="img/FOTOS/1b.jpg" alt="Imagen guía de resúmenes" class="img-fluid rounded shadow">
                        </div>
                        <div class="col-md-8" style="color: white;">
                            <ul class="letra_instrucciones">
                                <li>La plataforma para el envío de resúmenes se abre el <strong>miércoles 30 de abril de 2025</strong> .</li>
                                <li>Para someter un resumen, complete el formulario que se encuentra al final de esta página.</li>
                                <li>Para asegurarse de que sus datos se introducen correctamente, siga atentamente todas las instrucciones.</li>
                                <li>Dedique tiempo al envío de su resumen y proceda a través del sistema, completando cuidadosamente cada sección.</li>
                                <li>Una vez enviado el resumen, recibirá un acuse de recibo por correo electrónico en un plazo de 24 horas.</li>
                                <li>La plataforma para el envío de resúmenes cierra el <strong>30 de junio de 2025 a las 00:00, hora estándar del centro de México (CST) (GMT-6). </strong></li>
                                <li>Los correos electrónicos de aceptación se enviarán una vez haya culminado el periodo de revisión..</li>
                                <li> Los resúmenes deberán estar escritos en español o en portugués, con un límite de 300 palabras y su traducción al inglés. </li>
                                <li> Se Solicitan 4 palabras clave </li>
                                <li> <strong> Sólo se permitirá un resumen como primer autor.</strong> </li>
                            </ul>
                        </div>
                    </div>
                    <br>

                    <!-- fecha limite -->
                    <hr style="border: none; border-top: 5px solid darkblue;">
                    <div class="row">
                        <div class="col-md-4">
                        <h1 class="display-3 text-capitalize mb-3" style="font-size:xx-large; color: #001442;">
                            FECHA LÍMITE PARA SOMETER RESUMEN
                        </h1>
                            
                        </div>
                        <div class="col-md-8" style="color: white;">
                            <ul class="letra_instrucciones">
                                <li> La fecha límite para el envío de resúmenes es el <strong>30 de junio de 2025 a las 00:00, hora estándar del centro de México (CST) (GMT-6). </strong></li>
                                <li> <strong> NO </strong> es necesario inscribirse en el momento del envío del resumen; sin embargo, si su resumen es aceptado para su presentación en cualquier formato, deberá inscribirse y pagar antes de la fecha límite de inscripción.</li>
                            </ul>
                        </div>
                    </div>
                    <br>

                    <!-- limite de resumenes -->
                    <hr style="border: none; border-top: 5px solid darkblue;">
                    <div class="row">
                        <div class="col-md-4">
                            <h1 class="display-3 text-capitalize mb-3" style="font-size:xx-large; color: #001442;">
                                LÍMITE DE RESÚMENES
                            </h1>
                        </div>
                        <div class="col-md-8" style="color: white;">
                            <ul class="letra_instrucciones">
                                <li> Una persona solo puede presentar <strong>UN</strong> resumen y ser el «presentador principal» <strong>SÓLO UNA VEZ</strong> para cualquier presentación (es decir, oral, ponencia rápida o póster), independientemente de la posición que ocupe en la línea de autores.</li>
                                <li><strong> NO </strong> hay límite en el número de resúmenes en los que puede figurar un coautor. </li>
                            </ul>
                        </div>
                    </div>
                    <br>

                    <!-- cuerpo del resumen -->
                    <hr style="border: none; border-top: 5px solid darkblue;">
                    <div class="row">
                        <div class="col-md-4">
                        <h1 class="display-3 text-capitalize mb-3" style="font-size:xx-large; color: #001442;">
                            CUERPO DEL RESUMEN
                        </h1>
                            
                        </div>
                        <div class="col-md-8" style="color: white;">
                            <ul class="letra_instrucciones">
                                <li>El límite de palabras para los resúmenes es de <strong>300 palabras</strong>. Este límite de palabras no incluye el título del resumen, los nombres de los autores ni las afiliaciones.</li>
                            </ul>
                        </div>
                    </div>
                    <br>

                    <!-- modalidades de participacion -->
                    <hr style="border: none; border-top: 5px solid darkblue;">
                    <div class="row">
                        <div class="col-md-4">
                        <h1 class="display-3 text-capitalize mb-3" style="font-size:xx-large; color: #001442;">
                            MODALIDADES DE PARTICIPACIÓN
                        </h1>
                            
                        </div>
                        <div class="col-md-8" style="color: white;">
                            <div class="accordion_modalidades" id="accordion_modalidades">
                                <!-- Sección Oral -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" >
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_One" aria-expanded="true" aria-controls="collapse_One" style="color: #001442; font-family: 'Roboto'; font-size: 20px; ">
                                            Presentación Oral
                                        </button>
                                    </h2>
                                    <div id="collapse_One" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion_modalidades">
                                        <div class="accordion-body"style="color:#001442">
                                        Ponencias de 12 minutos para presentar una investigación (culminada o avanzada), con tres minutos para responder preguntas de los asistentes.
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Sección Cartel -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_Two" aria-expanded="false" aria-controls="collapse_Two" style="color: #001442; font-family: 'Roboto'; font-size: 20px; ">
                                            Cartel
                                        </button>
                                    </h2>
                                    <div id="collapse_Two" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion_modalidades">
                                        <div class="accordion-body"style="color:#001442">
                                            <ul>
                                                <li>Trabajos de investigación culminados o en proceso que se expondrán concurrentemente durante la semana.</li>
                                                <li>Dimensiones: 90 cm de alto x 60 cm de ancho.</li>
                                                <li>El cartel deberá proveer de información mínima sobre introducción, objetivos, método, resultados, discusión y literatura citada, así mismo, incluir agradecimientos de ser necesarios.</li>
                                                <li>Deberá contener una secuencia lógica que permita la fácil comprensión del mismo.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Sección Ponencia Rápida -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_Three" aria-expanded="false" aria-controls="collapseThree" style="color: #001442; font-family: 'Roboto'; font-size: 20px; ">
                                            Ponencia Rápida
                                        </button>
                                    </h2>
                                    <div id="collapse_Three" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordion_modalidades">
                                        <div class="accordion-body" style="color:#001442">

                                            <ul>
                                                <li>Ponencias de 5 minutos para presentar una experiencia o reporte breve, así como propuesta de investigación.</li>
                                                <li>Se pide a los expositores ajustarse al tiempo propuesto (5 minutos), siendo concreto y resaltando los resultados o puntos relevantes.</li>
                                                <li>Esta categoría permite a los ponentes presentar casos puntuales, reportes breves, investigaciones con resultados preliminares o con tamaños de muestra limitados, así como propuestas de investigación, para que los asistentes retroalimenten con sus conocimientos.</li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <br>

                    <hr style="border: none; border-top: 5px solid darkblue;">
                    <div class="row">
                        <div class="col-md-4">
                        <h1 class="display-3 text-capitalize mb-3" style="font-size:xx-large; color: #001442;">
                            CONCURSO
                        </h1>
                            
                        </div>
                        <div class="col-md-8" style="color: white;">
                            <ul class="letra_instrucciones">
                                <li>Concurso para estudiantes de SOMEMMA y/o SOLAMAC</li>
                            </ul>
                        </div>
                    </div>

                    <!-- temas de la conferencia -->
                    <hr style="border: none; border-top: 5px solid darkblue;">
                    <div class="row">
                        <div class="col-md-4">
                            <h1 class="display-3 text-capitalize mb-3" style="font-size:xx-large; color: #001442;">
                                TEMAS DE LA CONFERENCIA
                            </h1> 
                        </div>
                        <div class="col-md-8" style="color: white;">
                            <ul class="letra_instrucciones">
                                <li>Deberá identificar el o los temas que se ajustan a la presentación de su resumen. Hay 17 temas principales entre los que puede elegir. Somos conscientes de que no todos se excluyen mutuamente, por lo que le rogamos que presente su resumen unicamente bajo aquellos que más se ajusten a su investigación.</li>
                                <li>Si su trabajo corresponde al Simposio Latinoamericano para la Investigación y Conservación de manatíes,  debe elegir SILAMA</li>                            
                            </ul>
                            <strong style="color: #001442; font-size: 20px">Los temas disponibles son los siguientes:</strong>
                            <ul class="letra_instrucciones">
                                <li>SILAMA</li>
                                <li>Acústica</li>
                                <li>Biogeografía</li>
                                <li>Biología</li>
                                <li>Biología Molecular</li>
                                <li>Cambio Climático</li>
                                <li>Ciencia Ciudadana</li>
                                <li>Conservación</li>
                                <li>Ecología de Poblaciones</li>
                                <li>Ecología trófica</li>
                                <li>Ecotoxicología</li>
                                <li>Educación ambiental</li>
                                <li>Enfermedades</li>
                                <li>Eventos de mortalidad masiva</li>
                                <li>Evolución</li>
                                <li>Genética poblacional</li>
                                <li>Sistemática</li>
                                <li>Varamientos</li>
                            </ul>
                        </div>
                    </div>
                    <br>

                    <!-- como presentar su resumen -->
                    <hr style="border: none; border-top: 5px solid darkblue;">
                    <div class="row">
                        <div class="col-md-4">
                            <h1 class="display-3 text-capitalize mb-3" style="font-size:xx-large; color: #001442;">
                                ¿CÓMO PRESENTAR SU RESUMEN?
                            </h1> 
                        </div>
                        <div class="col-md-8" style="color: white;">
                            <ul class="letra_instrucciones">
                                <li>Para enviar su resumen es obligatorio completar todas las secciones solicitadas.</li> 
                                <li>En caso de que falten secciones o estén incompletas, se le pedirá que introduzca la información que falta. 
                                    Una vez introducida toda la información requerida, pulse el botón <strong>«ENVIAR»</strong>. Recibirá un acuse de recibo por correo electrónico en un plazo de 24 horas.</li>

                                <li><strong>Importante:</strong> Una vez enviado su resumen, <strong>NO</strong> podrá modificar la información. 
                                    Por favor, revise cuidadosamente que todos los datos ingresados en el formulario sean correctos antes de enviarlo.</li>
                            </ul>

                        </div>                    
                    </div>
                    <br>

                    <!-- autores -->
                    <hr style="border: none; border-top: 5px solid darkblue;">
                    <div class = "row">
                        <div class="col-md-4">
                            <h1 class="display-3 text-capitalize mb-3" style="font-size:xx-large; color: #001442;">
                                AUTORES
                            </h1> 
                        </div>
                        <div class="col-md-8" style="color: white;">
                            <ul class="letra_instrucciones">
                                <li><strong>Sólo se permitirá un resumen como primer autor.</strong></li>
                                <li>Se le pedirá que añada a sus coautores. <strong>Si alguno de los coautores de su trabajo aparece en la lista de autores proporcionada, seleccione ese coautor de la lista. Si no aparece, por favor, añádalo manualmente.</strong></li>
                                <li><strong>NO</strong> hay límite en el número de resúmenes en los que puede figurar un coautor.</li>
                            </ul>
                        </div>       
                    </div>
                    <br>

                    <!-- proceso de revision -->
                    <hr style="border: none; border-top: 5px solid darkblue;">
                    <div class = "row">
                        <div class="col-md-4">
                            <h1 class="display-3 text-capitalize mb-3" style="font-size:xx-large; color: #001442;">
                                PROCESO DE REVISIÓN
                            </h1> 
                        </div>
                        <div class="col-md-8" style="color: white;">
                            <ul class="letra_instrucciones">
                                <li><strong>Cada resumen presentado será evaluado por al menos dos revisores independientes expertos en el tema.</strong></li>
                                <li>Los revisores aplicarán los siguientes cuatro criterios para evaluar los resúmenes enviados, cada uno de los criterios será valorado del 1 al 5</li>
                                <li><strong>Originalidad:</strong> Se valorará más la investigación con nuevos hallazgos significativos o enfoques innovadores que aquellas que describan modificaciones de trabajos previos.</li>
                                <li><strong>Calidad:</strong> El resumen debe mostrar un uso apropiado de métodos sólidos y un diseño de estudio bien fundamentado, con resultados claros y bien respaldados por los datos.</li>
                                <li><strong>Importancia:</strong> Se evaluará el impacto de la investigación en el campo de los mamíferos marinos, su conservación y gestión.</li>
                                <li><strong>Presentación:</strong> Un resumen claro y bien estructurado, que explique los objetivos, métodos, resultados y conclusiones de forma lógica y comprensible, recibirá una puntuación más alta.</li>
                                <li>Una vez ajustadas las puntuaciones de los revisores, los resúmenes se clasificarán según la puntuación global. La modalidad de la presentación se asignará basándose en el puntaje y en la modalidad elegida por el autor.</li>
                            </ul>

                        </div>       
                    </div>
                    <br>

                    <!-- notificacion de aprobacion -->
                    <hr style="border: none; border-top: 5px solid darkblue;">
                    <div class = "row">
                        <div class="col-md-4">
                            <h1 class="display-3 text-capitalize mb-3" style="font-size:xx-large; color: #001442;">
                                NOTIFICACIÓN DE APROBACIÓN
                            </h1> 
                        </div>
                        <div class="col-md-8" style="color: white;">
                            <ul class="letra_instrucciones">
                            <li>Los correos de aceptación de resúmenes se enviarán una vez se culmine el proceso de revisión.
                                La fecha límite para confirmar la participación será indicada en ese mismo correo.</li>
                        </ul>

                        </div>       
                    </div>
                    <br>

                    <!-- dar de baja un resumen -->
                    <hr style="border: none; border-top: 5px solid darkblue;">
                    <div class = "row">
                        <div class="col-md-4">
                            <h1 class="display-3 text-capitalize mb-3" style="font-size:xx-large; color: #001442;">
                                DAR DE BAJA UN RESÚMEN
                            </h1> 
                        </div>
                        <div class="col-md-8" style="color: white;">
                        <ul class="letra_instrucciones">
                            <li>Si necesita retirar su resumen por cualquier motivo, los autores son responsables de notificarlo inmediatamente al Comité del Programa Científico
                                ciencias.somemma@gmail.com. Por favor, incluya en su solicitud el título del resumen.
                            </li>
                        </ul>

                        </div>       
                    </div>
                    <br>

                    <!-- soporte tecnico -->
                    <hr style="border: none; border-top: 5px solid darkblue;">
                    <div class = "row">
                        <div class="col-md-4">
                            <h1 class="display-3 text-capitalize mb-3" style="font-size:xx-large; color: #001442;">
                                SOPORTE TÉCNICO
                            </h1> 
                        </div>
                        <div class="col-md-8" style="color: white;">
                        <ul class="letra_instrucciones">
                            <li>Si tiene preguntas generales sobre el proceso de envío de resúmenes, póngase en contacto con <strong>postulacion_congreso@resumen-somemma.com</strong> o <strong>ciencias.somemma@gmail.com</strong>.
                            </li>
                        </ul>

                        </div>       
                    </div>

                </div>
            </div>



            <!-- formulario -->
            <?php 
                date_default_timezone_set('America/Mexico_City');
                $fecha_actual = date("Y-m-d H:i:s");
            ?>
            <div class="container-fluid feature bg-light py-5">
                <div class="container py-5"> 
                    <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                        <h4 class="text-uppercase text-primary" style="font-size: xx-large;">¡Inicia tu Registro!</h4>
                        <h1 class="display-3  mb-3" style="font-size:x-large;">COMPLETA EL SIGUIENTE FORMULARIO E INSCRÍBETE COMO PARTICIPANTE EN PONENCIAS ORALES O DE CARTEL.</h1>
                    </div>
                    <div class="card" style = "border: none; background-color: transparent;">
                    <div class="card-body">

                    <form id= "form_formulario">
                    
                    <!-- datos generales -->
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" 
                                        aria-expanded="true" aria-controls="collapseOne" style="color: darkblue; font-family: 'Roboto'; font-size: 20px; ">
                                    Datos Generales
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row g-3">
                                            <!-- Nombre -->
                                        <div class="col-md-3 mb-3">
                                            <label for="name" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Nombre (s)</label>
                                            <input type="text" class="form-control" id="name" name="name" required 
                                                    pattern="[A-Za-zÁÉÍÓÚáéíóúÑñÃãẼẽĨĩÕõŨũâÂêÊîÎôÔûÛ\s]+" 
                                                    title="Solo letras con acentos, virgulilla y espacios" 
                                                    oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñÃãẼẽĨĩÕõŨũâÂêÊîÎôÔûÛ\s]/g, '')">

                                        </div>

                                        <!-- Apellido -->
                                        <div class="col-md-3 mb-3">
                                            <label for="apellido" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Apellido(s)</label>
                                            <input type="text" class="form-control" id="apellido" name="apellido" required
                                                    pattern="[A-Za-zÁÉÍÓÚáéíóúÑñÃãẼẽĨĩÕõŨũâÂêÊîÎôÔûÛ\s]+" 
                                                    title="Solo letras con acentos, virgulilla y espacios" 
                                                    oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñÃãẼẽĨĩÕõŨũâÂêÊîÎôÔûÛ\s]/g, '')">
                                        </div>

                                        <!-- Género -->
                                        <div class="col-md-3 mb-3">
                                            <label for="genero" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Género</label>
                                            <select name="genero" id="genero" class="form-select" required>
                                                <option value="" disabled selected>Selecciona una opción</option>
                                                <option value="H">Hombre</option>
                                                <option value="M">Mujer</option>
                                                <option value="O">Otro</option>
                                                <option value="NO">Prefiero no decirlo</option>
                                            </select>
                                        </div>

                                        <!--Nacionalidad-->
                                        <div class="col-md-3 mb-3">
                                            <label for="pais" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Nacionalidad</label>
                                            <select name="pais" id="pais" class="form-select" required>
                                                <option value="" disabled selected>Selecciona tu país</option>
                                                <option value="MX">México</option>
                                                <option value="AF">Afganistán</option>
                                                <option value="AL">Albania</option>
                                                <option value="DE">Alemania</option>
                                                <option value="AD">Andorra</option>
                                                <option value="AO">Angola</option>
                                                <option value="AR">Argentina</option>
                                                <option value="AM">Armenia</option>
                                                <option value="AU">Australia</option>
                                                <option value="AT">Austria</option>
                                                <option value="AZ">Azerbaiyán</option>
                                                <option value="BH">Baréin</option>
                                                <option value="BD">Bangladés</option>
                                                <option value="BE">Bélgica</option>
                                                <option value="BO">Bolivia</option>
                                                <option value="BR">Brasil</option>
                                                <option value="BG">Bulgaria</option>
                                                <option value="CA">Canadá</option>
                                                <option value="CL">Chile</option>
                                                <option value="CN">China</option>
                                                <option value="CO">Colombia</option>
                                                <option value="CR">Costa Rica</option>
                                                <option value="CU">Cuba</option>
                                                <option value="DK">Dinamarca</option>
                                                <option value="EC">Ecuador</option>
                                                <option value="EG">Egipto</option>
                                                <option value="SV">El Salvador</option>
                                                <option value="ES">España</option>
                                                <option value="US">Estados Unidos</option>
                                                <option value="FR">Francia</option>
                                                <option value="GR">Grecia</option>
                                                <option value="GT">Guatemala</option>
                                                <option value="HN">Honduras</option>
                                                <option value="IN">India</option>
                                                <option value="ID">Indonesia</option>
                                                <option value="IT">Italia</option>
                                                <option value="JP">Japón</option>
                                                <option value="NI">Nicaragua</option>
                                                <option value="PA">Panamá</option>
                                                <option value="PY">Paraguay</option>
                                                <option value="PE">Perú</option>
                                                <option value="PT">Portugal</option>
                                                <option value="PR">Puerto Rico</option>
                                                <option value="GB">Reino Unido</option>
                                                <option value="RU">Rusia</option>
                                                <option value="DO">República Dominicana</option>
                                                <option value="UY">Uruguay</option>
                                                <option value="VE">Venezuela</option>
                                                <option value="Otro">Otro</option>
                                            </select>
                                        </div>
                                        <div class="alert alert-danger d-none" id="mail_error" role="alert">
                                            🚫 Por favor ingrese un correo electrónico válido.
                                        </div>
                                        <!-- email -->
                                        <div class="col-md-6 mb-6">
                                            <label for="mail" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Mail</label>
                                            <input type="text" class="form-control" id="mail" name="mail" required>
                                            <small id="mensaje_error_mail" style="color: red; display: none;">⚠️ Este correo ya está registrado. Intente con otro.</small>
                                        </div>
                                        <!-- institucion -->
                                        <div class="col-md-3 mb-3">
                                            <label for="institucion" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Institución</label>
                                            <input type="text" class="form-control" id="institucion" name="institucion" required oninput="this.value = this.value.toUpperCase();">
                                        </div>

                                        <!-- Ocupacion -->
                                        <div class="col-md-3 mb-3">
                                            <label for="ocupacion" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Ocupación</label>
                                            <select name="ocupacion" id="ocupacion" class="form-select" required>
                                                <option value="" disabled selected>Selecciona una opción</option>
                                                <option value="EL">Estudiante Licenciatura</option>
                                                <option value="EM">Estudiante Maestria</option>
                                                <option value="ED">Estudiante Doctorado</option>
                                                <option value="P">Profesionista</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- informacion del tema a presentar -->
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" 
                                        aria-expanded="true" aria-controls="collapseTwo" style="color: darkblue; font-family: 'Roboto'; font-size: 20px; ">
                                    Información del Tema a Presentar 
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row g-3">
                                        <!-- titulo -->
                                        <div class="col-md-12 mb-3">
                                            <label for="titulo" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Titulo del trabajo (español o portugués)</label>
                                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                                        </div>
                                        <!-- titulo ingles -->
                                        <div class="col-md-12 mb-3">
                                            <label for="titulo_eng" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Titulo del trabajo (inglés)</label>
                                            <input type="text" class="form-control" id="titulo_eng" name="titulo_eng" required>
                                        </div>
                                        <!-- Temas -->
                                        <div class="col-md-3 col-sm-12 mb-3">
                                            <label for="temas" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Tema</label>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: white; color: #82878F;">
                                                    Seleccione una o varias opciones
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" >
                                                    <?php
                                                        if ($resultado->num_rows > 0) {
                                                            while ($row = $resultado->fetch_assoc()) {
                                                                echo '<li>
                                                                        <div class="form-check dropdown-item ms-2">
                                                                            <input class="form-check-input" type="checkbox" name = temas[] value="'.$row['ID_tema'].'" id="option'.$row['ID_tema'].'">
                                                                            <label class="form-check-label" for="option'.$row['ID_tema'].'">'.$row['tema'].'</label>
                                                                        </div>
                                                                      </li>';
                                                            }
                                                        } else {
                                                            echo '<li class="dropdown-item text-muted">No hay opciones disponibles</li>';
                                                        }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 mb-3">
                                            <label for="temas_seleccion" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Temas Seleccionados:</label>
                                            <input type="text" class="form-control" id="temas_selected" name="temas_selected" readonly>
                                        </div>

                                        <div class="w-100"></div> <!-- Fuerza el salto de línea -->

                                        <!-- modalidad -->
                                        <div class="col-md-3 mb-3">
                                            <label for="modalidad_trabajo" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Modalidad a Participar</label>
                                            <select name="modalidad_trabajo" id="modalidad_trabajo" class="form-select" required>
                                                <option value="" disabled selected>Selecciona una opción</option>
                                                <option value="O">Presentación Oral</option>
                                                <option value="C">Cartel</option>
                                                <option value="R">Presentación Rápida</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="modalidad_concurso" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Participa en Concurso? (Estudiantes SOMEMMA y SOLAMAC)
                                                <i class="fa-solid fa-circle-info"
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-placement="top" 
                                                    style="cursor: pointer;" 
                                                    title="Concurso para estudiantes SOMEMMA y/o SOLAMAC"></i>
                                            </label>
                                            <select name="modalidad_concurso" id="modalidad_concurso" class="form-select" required>
                                                <option value="" disabled selected>Selecciona una opción</option>
                                                <option value="SI">SI</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="modalidad_concurso_opt" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Si selecciona que participa en el concurso, por favor elija la modalidad. Si no participa, puede omitir esta pregunta.</label>
                                            <select name="modalidad_concurso_opt" id="modalidad_concurso_opt" class="form-select" disabled>
                                                <option value="" disabled selected>Selecciona una opción</option>
                                                <option value="Licenciatura">Licenciatura</option>
                                                <option value="Maestria">Maestría</option>
                                                <option value="Doctorado">Doctorado</option>
                                            </select>
                                        </div>

                                        <!-- tema -->
                                        
                                    
                                        <h4 style="color: darkblue; margin-bottom: 2px;">Información de Autores</h4>
                                        <div class="row g-3">
                                            <!-- Datos Primer Autor -->
                                            <div class="col-md-6 mb-9">
                                                <h5 style="color: black; margin-top: 1px;">Datos Primer Autor</h5>
                                            
                                                <!-- Nombre -->
                                                <label for="name" style="font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Nombre (s)</label>
                                                <input type="text" class="form-control" id="name_1" name="name_1" required
                                                        pattern="[A-Za-zÁÉÍÓÚáéíóúÑñÃãẼẽĨĩÕõŨũâÂêÊîÎôÔûÛ\s]+" 
                                                        title="Solo letras con acentos, virgulilla y espacios" 
                                                        oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñÃãẼẽĨĩÕõŨũâÂêÊîÎôÔûÛ\s]/g, '')">
                                                
                                                <!-- Apellido -->
                                                <label for="apellido" style="font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Apellido(s)</label>
                                                <input type="text" class="form-control" id="apellido_1" name="apellido_1" required 
                                                        pattern="[A-Za-zÁÉÍÓÚáéíóúÑñÃãẼẽĨĩÕõŨũâÂêÊîÎôÔûÛ\s]+" 
                                                        title="Solo letras con acentos, virgulilla y espacios" 
                                                        oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñÃãẼẽĨĩÕõŨũâÂêÊîÎôÔûÛ\s]/g, '')">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="autofillCheckbox">
                                                    <label class="form-check-label" for="autofillCheckbox">Completar con Información De Datos Generales</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <!-- Adscripcion -->
                                                <label for="ads_1" style="font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Adscripción</label>
                                                <input type="text" class="form-control" id="ads_1" name="ads_1" required>
                                            </div>
                                        </div>
                                    
                                        <!-- Co-autores -->
                                        <div class="col-md-12 mb-3" id = "inputs-container">
                                            <h5 style="color: black;">Co-autores</h5>
                                                <!-- Input para mostrar la selección -->
                                            <label for="selectedOption" style="font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;" class="form-label">Nombre(s) y Apellido(s):</label>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <!-- Contenedor del dropdown -->
                                                    <div class="dropdown w-100">
                                                        <!-- Input que activa el dropdown -->
                                                        <input type="text" class="form-control" id="selectedOption" name = co_autor[] placeholder="Selecciona o agrega un co-autor...">

                                                        <!-- Menú desplegable -->
                                                        <ul class="dropdown-menu w-100" id = "dropdownMenu">
                                                            <li>
                                                                <input type="text" class="form-control" id="dropdownSearch" placeholder="Buscar...">
                                                            </li>
                                                            <li><hr class="dropdown-divider"></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class = "col-md-12 mb-3">
                                                    <label for="ads_co" style="font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Adscripción</label>
                                                    <input type="text" class="form-control" id="adsc" name="ads_co[]" required>
                                                </div>
                                            </div>
                                                <div class="col-md-3">
                                                    <button class="btn btn-primary w-100" id="add-dropdown-btn">Agregar más autores</button>
                                                </div>
                                            <br>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Datos de Resumen -->
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" 
                                        aria-expanded="true" aria-controls="collapseThree" style="color: darkblue; font-family: 'Roboto'; font-size: 20px; ">
                                    Resumen y Palabras Clave
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row g-3">        
                                        <div class="alert alert-danger d-none" id="wordError" role="alert">
                                            🚫 Resumen debe ser de Máximo 300 palabras.
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="textArea_resumen" style="font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Resumen (Español o Portugués)</label>
                                            <textarea id="textArea_resumen" name = "textArea_resumen" class="form-control" 
                                                    rows="10" placeholder="Escribe aquí tu resumen (Máximo 300 palabras)...">
                                            </textarea>
                                            <p id="wordCount">0/300 palabras</p>
                                            <label for="palabras_clave_esp" style="font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Ingresa hasta 4 palabras clave, separadas por comas (,)</label>
                                            <input type="text" class="form-control" id="palabras_clave_esp" name="palabras_clave_esp" oninput="validarPalabrasClave()" required>
                                            <small id="mensaje_error" style="color: red; display: none;">Solo puedes ingresar hasta 4 palabras clave.</small>
                                        </div>
                                   

                                        <div class="col-md-12 mb-3">
                                            <label for="textArea_resumen_eng" style="font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Abstract (English)</label>
                                            <textarea id="textArea_resumen_eng" name = "textArea_resumen_eng" class="form-control" 
                                                    rows="10" placeholder="Write your abstract here (300 words maximum)...">
                                            </textarea>
                                            <p id="wordCount_english" style="margin-bottom: 20px;">0/300 palabras</p>
                                            <label for="palabras_clave_eng" style="font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Enter up to 4 keywords, separated by commas (,) (English)</label>
                                            <input type="text" class="form-control" id="palabras_clave_eng" name="palabras_clave_eng" oninput="validarPalabrasClave_eng()" required>
                                            <small id="mensaje_error_eng" style="color: red; display: none;">Solo puedes ingresar hasta 4 palabras clave.</small>
                                        </div>
                                        </div>
                                    </div>                   
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="card-footer text-end" style = "border: none; background-color: transparent;">
                        <div style="display: flex; align-items: flex-start; text-align: justify;">
                            <input type="checkbox" name="declaracion" id="declaracion" value='A' required style="margin-right: 10px;">
                            <label for="declaracion" style="display: block;">
                                Declaro que la información proporcionada en este formulario es veraz y completa. Asimismo, confirmo que el resumen enviado es de mi autoría (o de los autores indicados) y que cuento con los permisos necesarios para su presentación. Acepto que cualquier inexactitud o incumplimiento de las normas del congreso puede resultar en la descalificación de la postulación.
                            </label>
                            <small id="mensaje_error_dec" style="color: red; display: none;">⚠️ Confirmar declaración para poder enviar formulario.</small>

                        </div>
                        <div style="text-align: center;">
                            <button type = "submit" class="btn btn-success" id="Enviar" name="Enviar" style="color: white; width: 150px;" disabled>
                                <i class="fa-solid fa-paper-plane"></i>
                                Enviar
                            </button>

                       
                            <!-- <div id="loading" style="display: none;">Loading...</div> -->
                            <div id="error-message" style="color: red; display: none;">Tu no se ha podido realizar, por favor, intente de nuevo más tarde</div>
                            <div id="success-message" style="color: green; display: none;">Tu Registro se ha llevado a cabo con éxito, en breve recibiras un correo con tu información! Seras redirigido a la página principal en 5 segundos</div>
                            <!-- <div id="prueba-message" style="color: green; display: none;">Tu  ha sido enviado, pronto nos pondremos en contacto contigo!</div> -->
                            
                            
                        </div>
                    </div>
                    </form>          
                </div>                
                <div id="loadingOverlay" style="display:none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.5); color: white; font-size: 20px; text-align: center; padding-top: 200px;">
                  Registro enviado con éxito, sera redirigido a la página principal...
                </div>
            </div>
        </main>
    <!-- footer -->
    <?php include 'footer.php'; ?>
        

        
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="_lib/wow/wow.min.js"></script>
    <script src="_lib/easing/easing.min.js"></script>
    <script src="_lib/waypoints/waypoints.min.js"></script>
    <script src="_lib/counterup/counterup.min.js"></script>
    <script src="_lib/owlcarousel/owl.carousel.min.js"></script>
    

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <script type="text/javascript">
        function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'es'}, 'google_translate_element');
        }
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <script>
            // Activar tooltips en toda la página
            document.addEventListener("DOMContentLoaded", function () {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            });
    </script>

    <script> //autocomplete datos nombre
        document.getElementById('autofillCheckbox').addEventListener('change', function() {
        if (this.checked) {
            // Rellenar los inputs con valores predeterminados
            document.getElementById('name_1').value =  document.getElementById('name').value;
            document.getElementById('apellido_1').value =  document.getElementById('apellido').value;
        } else {
            // Limpiar los inputs cuando se desmarca el checkbox
            document.getElementById('name_1').value = '';
            document.getElementById('apellido_1').value = '';
        }
    });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let container = document.getElementById("inputs-container");

            const authors = <?php echo $coautores_Json; ?>;

            // Agregar nuevo elemento dropdown y adscripción
            document.getElementById("add-dropdown-btn").addEventListener("click", function (event) {
                event.preventDefault(); // Evita que se recargue la página si está dentro de un formulario

                //dropdown label
                let newDropdownLabel = document.createElement("label");
                newDropdownLabel.style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;";
                newDropdownLabel.textContent = "Datos Co-Autor";

                // Crear contenedor del dropdown
                let newDropdownContainer = document.createElement("div");
                newDropdownContainer.className = "col-md-6 mb-3";

                let newDropdown = document.createElement("div");
                newDropdown.className = "dropdown w-100";

                newDropdown.innerHTML = `
                    <input type="text" class="form-control dropdown-toggle" name="co_autor[]" placeholder="Selecciona o agrega un co-autor..." data-bs-toggle="dropdown">
                    <ul class="dropdown-menu w-100">
                        <li>
                            <input type="text" class="form-control dropdown-search" placeholder="Buscar...">
                        </li>
                        <li><hr class="dropdown-divider"></li>
                    </ul>
                `;

                newDropdownContainer.appendChild(newDropdownLabel);
                newDropdownContainer.appendChild(newDropdown);
                container.appendChild(newDropdownContainer);

                // Crear el nuevo campo de Adscripción
                let newAdscriptionContainer = document.createElement("div");
                newAdscriptionContainer.className = "col-md-12 mb-3";

                let newAdscription = document.createElement("input");
                newAdscription.type = "text";
                newAdscription.className = "form-control";
                newAdscription.name = "ads_co[]";
                newAdscription.required = true;
                newAdscription.placeholder = "Adscripción";

                newAdscriptionContainer.appendChild(newAdscription);
                container.appendChild(newAdscriptionContainer); // SE AGREGA AL DOM

                // Llenar dropdown y agregar funcionalidad
                fillDropdownWithAuthors(newDropdown);
                addDropdownFunctionality(newDropdown);
            });

            // Función para llenar el dropdown con los autores
            function fillDropdownWithAuthors(dropdown) {
                const menu = dropdown.querySelector(".dropdown-menu");

                authors.forEach(author => {
                    const li = document.createElement("li");
                    const div = document.createElement("div");
                    div.className = "dropdown-item";
                    div.textContent = author;
                    div.style.cursor = "pointer"; // Para indicar que es seleccionable
                    li.appendChild(div);
                    menu.appendChild(li);

                    div.addEventListener("click", function () {
                        dropdown.querySelector("input[name='co_autor[]']").value = author;
                        menu.style.display = "none";
                    });
                });
            }

            // Función para agregar funcionalidad a cada dropdown
            function addDropdownFunctionality(dropdown) {
                let input = dropdown.querySelector(".dropdown-toggle");
                let menu = dropdown.querySelector(".dropdown-menu");
                let search = dropdown.querySelector(".dropdown-search");

                // Mostrar dropdown cuando se hace clic en el input
                input.addEventListener("click", function () {
                    menu.style.display = "block";
                });

                // Cerrar dropdown si se hace clic fuera
                document.addEventListener("click", function (event) {
                    if (!dropdown.contains(event.target)) {
                        menu.style.display = "none";
                    }
                });

                // Filtrar opciones en la búsqueda
                search.addEventListener("keyup", function () {
                    let filter = this.value.toLowerCase();
                    let items = menu.querySelectorAll(".dropdown-item");
                    items.forEach(item => {
                        let text = item.textContent.toLowerCase();
                        item.style.display = text.includes(filter) ? "" : "none";
                    });
                });
            }

            // Agregar funcionalidad al primer dropdown si ya existe
            let firstDropdown = document.querySelector(".dropdown");
            if (firstDropdown) {
                addDropdownFunctionality(firstDropdown);
            }
        });
    </script>

    <script> //revisar palabras del resumen espanol
        document.getElementById("textArea_resumen").addEventListener("input", function() {
            const maxWords = 300; //maximo de 500 palabras
            const text = this.value.trim(); 
            const words = text.split(/\s+/).filter(word => word.length > 0); // Divide por espacios y elimina vacíos
            const errorDiv = document.getElementById("wordError");
            const noword_errorDiv = document.getElementById("noword_error");
            const wordCount = document.getElementById("wordCount");
            const enviarbutton = document.getElementById("Enviar");
        
            if (words.length > maxWords) {
                errorDiv.classList.remove("d-none"); // Muestra la alerta
                this.value = words.slice(0, maxWords).join(" "); // Corta el texto al límite
                enviarbutton.disabled = true;
            } else {
                errorDiv.classList.add("d-none"); // Oculta la alerta si está dentro del límite
                enviarbutton.disabled = false;
            }
        
            wordCount.textContent = `${words.length}/${maxWords} palabras`; // Actualiza el contador
        });
    </script>

    <script>// revisar palabras del resumen ingles
        document.getElementById("textArea_resumen_eng").addEventListener("input", function() {
            const maxWords = 300; //maximo de 500 palabras
            const text = this.value.trim(); 
            const words = text.split(/\s+/).filter(word => word.length > 0); // Divide por espacios y elimina vacíos
            const errorDiv = document.getElementById("wordError");
            const noword_errorDiv = document.getElementById("noword_error");
            const wordCount = document.getElementById("wordCount_english");
            const enviarbutton = document.getElementById("Enviar");
        
            if (words.length > maxWords) {
                errorDiv.classList.remove("d-none"); // Muestra la alerta
                this.value = words.slice(0, maxWords).join(" "); // Corta el texto al límite
                enviarbutton.disabled = true;
            } else {
                errorDiv.classList.add("d-none"); // Oculta la alerta si está dentro del límite
                enviarbutton.disabled = false;
            }
        
            wordCount.textContent = `${words.length}/${maxWords} palabras`; // Actualiza el contador
        });
    </script>

    <script>// si no se agrego nada de resumen se desactiva el boton
        document.getElementById("textArea_resumen").addEventListener("input", function() {
            const text = this.value.trim(); 
            const words = text.split(/\s+/).filter(word => word.length > 0); // Divide por espacios y elimina vacíos
            const noword_errorDiv = document.getElementById("noword_error");
            const enviarbutton = document.getElementById("Enviar");
        
            if (words.length < 1) {
                noword_errorDiv.classList.remove("d-none"); // Muestra la alerta
                enviarbutton.disabled = true;
            } else {
                noword_errorDiv.classList.add("d-none"); // Oculta la alerta si está dentro del límite
                enviarbutton.disabled = false;
            }

        });
    </script>

    <script>// validacion mail correctamente
        document.getElementById("mail").addEventListener("blur", function(event) {
            var email = document.getElementById("mail").value;
            var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            const mail_errorDiv = document.getElementById("mail_error");
            const enviarbutton = document.getElementById("Enviar");
        
            if (!emailRegex.test(email)) {
                mail_errorDiv.classList.remove("d-none"); // Muestra la alerta
                enviarbutton.disabled = true;
            } else {
                mail_errorDiv.classList.add("d-none"); // Oculta la alerta si está dentro del límite
                enviarbutton.disabled = false;
                }
        });
    </script>

    <script> //validar que mail no existe en los resumenes enviados previamente y envio del formulario

        document.addEventListener("DOMContentLoaded", function() {
        // Obtener la lista de correos desde PHP
        const correosExistentes = <?php echo $correosJson; ?>;

        document.getElementById("form_formulario").addEventListener("submit", function(event) {

            event.preventDefault(); // Evita el envío del formulario

            const inputCorreo = document.getElementById("mail").value.trim();
            let input = document.getElementById("mail");
            let mensajeError = document.getElementById("mensaje_error_mail");

            // console.log("Verificando correo:", inputCorreo);

            if (correosExistentes.includes(inputCorreo)) {
                // event.preventDefault(); // Evita el envío del formulario
                mensajeError.style.display = "block";
                mensajeError.innerText = "⚠️ Este correo ya está registrado. Intente con otro.";
                input.style.borderColor = "red"; // Resaltar en rojo si el correo ya existe
                input.scrollIntoView({ behavior: "smooth", block: "center" });
                return false; // Asegura que no continúe con el envío
            } else {
                mensajeError.style.display = "none"; // Ocultar mensaje de error si el correo es válido
                input.style.borderColor = ""; // Restaurar borde normal
                    // Si pasa la validación, continuar con el envío del formulario
            console.log('Enviando formulario...');
            const formData = new FormData(this);

            fetch("forma_resumenes.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                if (data.trim() === "success") {
                    document.getElementById("success-message").style.display = "block";
                    document.getElementById("error-message").style.display = "none";
                    document.getElementById("form_formulario").reset(); // Limpiar formulario

                    // document.getElementById('loadingOverlay').style.display = 'block'

                    // Esperar 5 segundos antes de redirigir a la página
                    setTimeout(() => {
                        // Redirigir a la página después de 5 segundos
                        window.location.href = "https://resumen-somemma.com";
                    }, 5000);

                } else {
                    document.getElementById("error-message").style.display = "block";
                }
            })
            .catch(() => {
                document.getElementById("error-message").style.display = "block";
            });
            }

            

            });
        });
    </script>

    <script> //busqueda dinamica en el dropodown 
        document.addEventListener("DOMContentLoaded", function () {
            let input = document.getElementById("selectedOption");
            let dropdownMenu = input.nextElementSibling; // Obtiene el ul.dropdown-menu

            // Mostrar el dropdown cuando se hace clic en el input
            input.addEventListener("click", function () {
                dropdownMenu.style.display = "block";
            });

            // Cerrar dropdown si se hace clic fuera
            document.addEventListener("click", function (event) {
                if (!input.parentElement.contains(event.target)) {
                    dropdownMenu.style.display = "none";
                }
            });

            // Filtrar elementos en la búsqueda
            document.getElementById("dropdownSearch").addEventListener("keyup", function () {
                let filter = this.value.toLowerCase();
                let items = dropdownMenu.querySelectorAll(".dropdown-item");

                items.forEach(item => {
                    let text = item.textContent.toLowerCase();
                    item.style.display = text.includes(filter) ? "" : "none";
                });
            });

            // Seleccionar un elemento y colocarlo en el input
            dropdownMenu.querySelectorAll(".dropdown-item").forEach(item => {
                item.addEventListener("click", function () {
                    input.value = this.textContent;
                    dropdownMenu.style.display = "none"; // Ocultar menú después de la selección
                });
            });
        });
    </script>

    <script> //llenar dropdwon original con coautores
        // Función para llenar el dropdown con los autores del JSON
        function fillDropdownWithAuthors() {
            const dropdownMenu = document.getElementById('dropdownMenu');
            const authors = <?php echo $coautores_Json; ?>;
            // Limpiar el dropdown antes de llenarlo
            dropdownMenu.innerHTML = `
                <li>
                    <input type="text" class="form-control" id="dropdownSearch" placeholder="Buscar...">
                </li>
                <li><hr class="dropdown-divider"></li>
            `;

            // Iterar sobre el JSON de autores y agregar elementos al dropdown
            authors.forEach(author => {
                const li = document.createElement('li');
                const div = document.createElement('div');
                div.className = 'dropdown-item';
                div.textContent = author;
                li.appendChild(div);
                dropdownMenu.appendChild(li);

                // Función para seleccionar un autor
                div.addEventListener('click', function() {
                    document.getElementById('selectedOption').value = div.textContent;
                    dropdownMenu.style.display = 'none'; // Ocultar el dropdown al hacer una selección
                });
            });
        }

        // Llamar a la función para llenar el dropdown al cargar la página
        window.onload = function() {
            fillDropdownWithAuthors();

            // Filtrar opciones al escribir en el campo de búsqueda
            document.getElementById('dropdownSearch').addEventListener('keyup', function() {
                let filter = this.value.toLowerCase();
                let items = document.querySelectorAll('.dropdown-item');
                items.forEach(item => {
                    let text = item.textContent.toLowerCase();
                    item.style.display = text.includes(filter) ? "" : "none";
                });
            });
        };
    </script>

    <script> //validacion concurso
        document.getElementById('modalidad_concurso').addEventListener('change', function() {
            var modalidadConcursoOpt = document.getElementById('modalidad_concurso_opt');
            if (this.value === 'SI') {
                modalidadConcursoOpt.disabled = false;
                modalidadConcursoOpt.required = true; 
            } else {
                modalidadConcursoOpt.disabled = true;
                modalidadConcursoOpt.required = false; // Quitar obligatorio
                modalidadConcursoOpt.value = ''; // Resetear el valor si se desactiva
            }
        });
    </script>

    <script> //validar palabras clave espanol
        function validarPalabrasClave() {
            let input = document.getElementById("palabras_clave_esp");

            let mensajeError = document.getElementById("mensaje_error");

            let enviarbutton = document.getElementById("Enviar");


            // Divide la entrada por comas y elimina espacios extras
            let palabras = input.value.split(",").map(p => p.trim()).filter(p => p !== "");


            // Verifica si hay más de 5 elementos
            if (palabras.length > 4) {
                mensajeError.style.display = "block";
                input.style.borderColor = "red"; // Resaltar en rojo si hay más de 5
                enviarbutton.disabled = true;

            } else {
                mensajeError.style.display = "none";
                input.style.borderColor = ""; // Restaurar color normal
                enviarbutton.disabled = false;
            }

        }
    </script>

    <script> //validar palabras clave eng
        function validarPalabrasClave_eng() {
            let input = document.getElementById("palabras_clave_eng");

            let mensajeError = document.getElementById("mensaje_error_eng");

            let enviarbutton = document.getElementById("Enviar");

            // Divide la entrada por comas y elimina espacios extras
            let palabras = input.value.split(",").map(p => p.trim()).filter(p => p !== "");


            // Verifica si hay más de 4 elementos
            if (palabras.length > 4) {
                mensajeError.style.display = "block";
                input.style.borderColor = "red"; // Resaltar en rojo si hay más de 5
                enviarbutton.disabled = true;  // Desactivar el botón de enviar


            } else {
                mensajeError.style.display = "none";
                input.style.borderColor = ""; // Restaurar color normal
                enviarbutton.disabled = false;  // Desactivar el botón de enviar

            }

        }
    </script>

    <script>// agregar temas seleccionados al input
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.dropdown-menu .form-check-input');
            const temasSelectedInput = document.getElementById('temas_selected');

            function actualizarTemasSeleccionados() {
                let temasSeleccionados = [];
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const label = checkbox.nextElementSibling.textContent;
                        temasSeleccionados.push(label);
                    }
                });
                temasSelectedInput.value = temasSeleccionados.join(', ');
                if (temasSeleccionados.length === 0) {
                    temasSelectedInput.value = '';
                }
            }

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', actualizarTemasSeleccionados);
            });
        });
    </script>

    <script> //validar que checkbox de declaración este activo

        document.getElementById("form_formulario").addEventListener("submit", function(event) {
            const declaracion = document.getElementById("declaracion").value;
            let mensajeError = document.getElementById("mensaje_error_dec");

            // aler.log("⚠️ Este correo ya está registrado. Intente con otro.");
            if (declaracion != 'A') {
                event.preventDefault(); // Evita el envío del formulario
                mensajeError.style.display = "block";
                // 🔹 Desplaza la pantalla al campo con error
                input.scrollIntoView({ behavior: "smooth", block: "center" });
            } else {
                mensajeError.style.display = "none"; // Ocultar mensaje de error si el correo es válido
            }
    });
    </script>

    <!-- <script> 
        document.getElementById("form_formulario").addEventListener("submit", function (e) {
            e.preventDefault(); // Evita el envío estándar del formulario

            // Mostrar el indicador de carga
        
            console.log('ejecuta funcion')
            // Captura los datos del formulario
            const formData = new FormData(this);

            // Envía los datos al servidor con fetch
            fetch("forma_resumenes.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
            console.log(data)
                // Oculta el indicador de carga
                if (data.trim() === "success") {
                    // Mostrar mensaje de éxito
                    document.getElementById("success-message").style.display = "block";
                    document.getElementById("error-message").style.display = "none";

                    // Opcional: Limpiar los campos del formulario
                    document.getElementById("form_formulario").reset();
                } else {
                    // Mostrar mensaje de error
                    document.getElementById("error-message").style.display = "block";
                    // document.getElementById("success-message").style.display = "none";
                }
            })
            .catch(() => {
                // Oculta el indicador de carga y muestra un mensaje de error
                // document.getElementById("loading").style.display = "none";
                document.getElementById("error-message").style.display = "block";
                // document.getElementById("success-message").style.display = "none";
            });
        });

    </script> -->


    
    </body>

</html>
<?php
// Cerrar conexión
$conexion->close();
?>