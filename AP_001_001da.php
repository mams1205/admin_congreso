<?php
include('conexion_bd.php');

header('Content-Type: application/json');

$SelID = $_GET['ID']; // Obtener ID desde la URL

$Sql_Ase = "SELECT 
                A.nombre,
                A.apellido,
                p.nombre AS nacionalidad,
                A.institucion,
                A.mail,
                CONCAT(
                    A.primer_autor_name, ', ', 
                    GROUP_CONCAT(DISTINCT B.co_autor ORDER BY B.co_autor SEPARATOR ', ')
                ) AS co_autores,
                CASE
                    WHEN A.ocupacion = 'EL' THEN 'Estudiante Lic.'
                    WHEN A.ocupacion = 'EM' THEN 'Estudiante Maestría'
                    WHEN A.ocupacion = 'ED' THEN 'Estudiante Doctorado'
                    WHEN A.ocupacion = 'P' THEN 'Profesionista'
                END AS ocupacion,
                CASE
                    WHEN A.modalidad_trabajo = 'O' THEN 'Oral'
                    WHEN A.modalidad_trabajo = 'C' THEN 'Cartel'
                    WHEN A.modalidad_trabajo = 'R' THEN 'Presentación Rápida'
                END AS modalidad,
                A.titulo,
                A.titulo_eng,
                A.resumen,
                A.resumen_eng,
                A.palabras_clave,
                A.palabras_clave_eng
            FROM trabajos_main A
            LEFT JOIN paises p ON p.iso = A.nacionalidad
            LEFT JOIN trabajos_detalle_authors B ON B.ID_trabajo = A.ID_trabajo
            WHERE A.ID_trabajo = $SelID";

$datos_resumen = [];
$resultado = mysqli_query($conexion, $Sql_Ase);
if (mysqli_num_rows($resultado) > 0) {
    // Recorrer y mostrar cada fila de la tabla
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $fila = array_map('htmlspecialchars', $fila);  // Evitar caracteres especiales
        $datos_resumen[] = $fila; // Se agrega la fila al array
  
    }
  } else {
    
    echo json_encode(["error" => "No se encontraron resultados."]);
    exit;
  }

 // Retornar los datos como JSON
echo json_encode([
    'titulo' => $datos_resumen[0]['titulo'] ?? '',
    'titulo_eng' => $datos_resumen[0]['titulo_eng'] ?? '',
    'nombre' => $datos_resumen[0]['nombre'] ?? '',
    'co_autores' => $datos_resumen[0]['co_autores'] ?? '',
    'apellido' => $datos_resumen[0]['nombre'] ?? '',
    'institucion' => $datos_resumen[0]['institucion'] ?? '',
    'nacionalidad' => $datos_resumen[0]['nacionalidad'] ?? '',
    'ocupacion' => $datos_resumen[0]['ocupacion'] ?? '',
    'modalidad' => $datos_resumen[0]['modalidad'] ?? '',
    'resumen_esp' => $datos_resumen[0]['resumen'] ?? '',
    'resumen_eng' => $datos_resumen[0]['resumen_eng'] ?? '',
    'palabras_clave_eng' => $datos_resumen[0]['palabras_clave_eng'] ?? '',
    'palabras_clave' => $datos_resumen[0]['palabras_clave'] ?? ''
]);
?>
