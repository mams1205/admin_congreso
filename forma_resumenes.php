<?php
include('conexion_bd.php');

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

     // 1. Recibir y limpiar datos
     function limpiar($valor) {
        return trim(htmlspecialchars($valor));
    }
    // Recibir los datos del formulario
    $nombre = limpiar($_POST['name']);
    $apellido = limpiar($_POST['apellido']);
    $genero = limpiar($_POST['genero']);
    $nacionalidad = limpiar($_POST['pais']);
    $mail = limpiar($_POST['mail']);
    $institucion = limpiar($_POST['institucion']);
    $ocupacion = limpiar($_POST['ocupacion']);
    $titulo = limpiar($_POST['titulo']);
    $titulo_eng = limpiar($_POST['titulo_eng']);
    $co_autores = $_POST['co_autor'] ?? [];
    $temas_selected = $_POST['temas'] ?? [];
    $modalidad = limpiar($_POST['modalidad_trabajo']);
    $concurso_valid = limpiar($_POST['modalidad_concurso']);
    $modalidad_concurso = isset($_POST['modalidad_concurso_opt']) ? limpiar($_POST['modalidad_concurso_opt']) : '';
    $nombre_autor = limpiar($_POST['name_1']);
    $apellido_autor = limpiar($_POST['apellido_1']);
    $autor_concat = $nombre_autor . " " . $apellido_autor;
    $nombre_concat = $nombre . " " . $apellido;
    $resumen_esp = limpiar($_POST['textArea_resumen']);
    $palabras_espanol = limpiar($_POST['palabras_clave_esp']);
    $resumen_eng = limpiar($_POST['textArea_resumen_eng']);
    $palabras_eng = limpiar($_POST['palabras_clave_eng']);
    $adsc_1 = limpiar($_POST['ads_1']);
    $ads_co = $_POST['ads_co'] ?? [];
    $fecha_registro = date("Y-m-d H:i:s");


    $errores = array(); // Array para almacenar los campos vacíos

    // Verificar si cada campo está vacío
    if (empty($nombre)) $errores[] = "Nombre";
    if (empty($apellido)) $errores[] = "Apellido";
    if (empty($genero)) $errores[] = "Género";
    if (empty($nacionalidad)) $errores[] = "Nacionalidad";
    if (empty($mail)) $errores[] = "Correo electrónico";
    if (empty($institucion)) $errores[] = "Institución";
    if (empty($ocupacion)) $errores[] = "Ocupación";
    if (empty($titulo)) $errores[] = "Título";
    if (empty($titulo_eng)) $errores[] = "Título en inglés";
    if (empty($temas_selected)) $errores[] = "Temas seleccionados";
    if (empty($co_autores)) $errores[] = "Co-autores";
    if (empty($modalidad)) $errores[] = "Modalidad";
    if (empty($concurso_valid)) $errores[] = "Validación del concurso";
    // if (empty($modalidad_concurso)) $modalidad_concurso[] = "";
    if (empty($nombre_autor)) $errores[] = "Nombre del autor";
    if (empty($apellido_autor)) $errores[] = "Apellido del autor";
    if (empty($resumen_esp)) $errores[] = "Resumen en español";
    if (empty($resumen_eng)) $errores[] = "Resumen en inglés";
    if (empty($palabras_eng)) $errores[] = "Palabras clave en inglés";
    if (empty($palabras_espanol)) $errores[] = "Palabras clave en español";
    if (empty($adsc_1)) $errores[] = "adscripcion primer autor";
    if (empty($ads_co)) $errores[] = "adscripcion co autores";
    if ($modalidad === 'O') {
        $modalidad_txt = 'Oral';
    } elseif ($modalidad === 'C') {
        $modalidad_txt = 'Cartel';
    } else {
        $modalidad_txt = 'Presentación Rápida'; // o lo que aplique
    }

    // Si hay campos vacíos, mostrar cuáles son
    if (count($errores) > 0) {
        echo "Error: falta el siguiente(s) campo(s): " . implode(", ", $errores);
        exit;
    }


    // Preparar la consulta SQL
    $sql_main = "INSERT INTO trabajos_main (titulo, titulo_eng, nombre, apellido, genero,
                                        nacionalidad, mail, institucion, ocupacion,
                                        modalidad_trabajo, concurso, modalidad_concurso, primer_autor_name,
                                        palabras_clave, palabras_clave_eng, resumen, resumen_eng,
                                        fecha_registro, status, adscripcion) 
            VALUES ('$titulo', '$titulo_eng', '$nombre', '$apellido', '$genero',
                    '$nacionalidad', '$mail', '$institucion', '$ocupacion',
                    '$modalidad', '$concurso_valid', '$modalidad_concurso', '$autor_concat',
                    '$palabras_espanol', '$palabras_eng', '$resumen_esp', '$resumen_eng',
                    '$fecha_registro', 'R', '$adsc_1')";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $sql_main)){
        $max_id = mysqli_insert_id($conexion); 
    
        foreach ($temas_selected as $tema) {
            $tema = mysqli_real_escape_string($conexion, $tema);
            $sql_temas = "INSERT INTO trabajos_detalle_tema (ID_trabajo, tema) VALUES ('$max_id', '$tema')";
            mysqli_query($conexion, $sql_temas);
        }
    
        foreach ($co_autores as $index => $co_autor) {
            $co_autor = mysqli_real_escape_string($conexion, $co_autor);
            $adscripcion = mysqli_real_escape_string($conexion, $ads_co[$index]); // Obtener adscripción correspondiente
        
            $sql_coautor = "INSERT INTO trabajos_detalle_authors (ID_trabajo, co_autor, adscripcion) 
                            VALUES ('$max_id', '$co_autor', '$adscripcion')";
        
            if (!mysqli_query($conexion, $sql_coautor)) {
                echo "Error: " . mysqli_error($conexion);
            }
        }
        

        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $from = "postulacion_congreso@resumen-somemma.com";
        $to = $mail;
        $subject = "Confirmación Envío de Resumen a la Segunda Reunión SOMEMMA-SOLAMAC";
        $message = "Estimado/a $nombre_concat,\n\n";
        $message .= "Mediante este correo se confirma la recepción de su trabajo titulado: $titulo para presentarse en la modalidad $modalidad_txt para la XXXIX Reunión Internacional para El Estudio de los Mamíferos Marinos.\n\n";
        $message .= "Agradecemos su participación y nos pondremos en contacto con usted para más detalles sobre el evento.\n\n";
        $message .= "Si tiene alguna duda, no responda a este correo electrónico, ya que está configurado como una dirección no respondible. Si necesita asistencia, por favor contáctenos a través de: difusion.somemma@gmail.com\n\n";
        $message .= "Atentamente,\n";
        $message .= "El Comité Organizador de la XXXIX Reunión Internacional para el Estudio de los Mamíferos Marinos";
        $headers = "From:" . $from;
        mail($to,$subject,$message, $headers);

        echo trim("success"); // Si la inserción es exitosa
        
        } else {
            echo "db-error"; // Si hubo un error en la ejecución de la consulta
    }
}
// ❗ Cerrar la conexión SIEMPRE, incluso si no se hizo un POST
if (isset($conexion)) {
    mysqli_close($conexion);
}
?>

