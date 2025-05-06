<?php
$PageSecurity = 2;
include('includes/session.inc');

$array = [];
$sql = "SELECT
            A.ID_trabajo,
            A.primer_autor_name,
            CASE
                WHEN A.status = 'R' THEN 'Recibido'
                WHEN A.status = 'E' THEN 'Enviado a Revisión'
                WHEN A.status = 'C' THEN 'Calificado'
                WHEN A.status = 'A' THEN 'Aprobado'
                WHEN A.status = 'X' THEN 'Rechazado'
            END AS Status,
            A.titulo_eng,
            A.titulo,
            A.mod_asignada,
            CASE
                WHEN A.ocupacion = 'EL' THEN 'Estudiante Lic.'
                WHEN A.ocupacion = 'EM' THEN 'Estudiante Maestría'
                WHEN A.ocupacion = 'ED' THEN 'Estudiante Doctorado'
                WHEN A.ocupacion = 'P' THEN 'Profesionista'
            END AS ocupacion,
            CASE
                WHEN A.concurso = 'SI' THEN 'SI'
                WHEN A.concurso = 'NO' THEN 'NO'
            END AS concurso,					
            A.modalidad_concurso AS mod_concurso,
            GROUP_CONCAT(DISTINCT C.tema SEPARATOR ', ') AS temas,
            GROUP_CONCAT(DISTINCT D.co_autor SEPARATOR ',') AS autores,
            p.nombre as nacionalidad,
            A.institucion,
            A.mail
        FROM trabajos_main A
        LEFT JOIN trabajos_detalle_tema B ON B.ID_trabajo = A.ID_trabajo
        LEFT JOIN Cat_temas C ON C.ID_tema = B.tema
        LEFT JOIN trabajos_detalle_authors D ON D.ID_trabajo = A.ID_trabajo
        LEFT JOIN paises p ON p.iso = A.nacionalidad
        GROUP BY A.ID_trabajo, A.titulo, A.nombre, A.apellido, A.ocupacion";

$Res = DB_query($sql, $db); // Ejecuta la consulta
while($row = DB_fetch_row($Res)) {
    $array[] = $row; // Agregar cada fila al array principal
}
$column_names = ['ID','Primer Autor', 'Status', 'Titulo Eng.', 'Titulo', 'Modalidad', 'Ocupacion', 'Concurso', 'Modalidad Concurso',
                 'Temas', 'Co-autores', 'Nacionalidad', 'Institucion', 'Mail'];
$filename = "Reporte_trabajos_SOMEMMA_2025.csv";


    // Establecer las cabeceras para forzar la descarga
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    // Abrir la salida para escritura
    $output = fopen('php://output', 'w');


    // Escribir el encabezado de las columnas
    // Escribir los encabezados de las columnas
    fputcsv($output, $column_names);

    // Asegúrate de que $array esté bien formado y no contenga filas vacías
    foreach ($array as $rowx) {
        // Verifica que $row no esté vacío y tenga el formato correcto
        if (count($rowx) > 0) {
            fputcsv($output, $rowx); // Escribir cada fila en el CSV
        }
    }

    // Cerrar la salida
    fclose($output);
    // Terminar la ejecución para que el archivo se descargue
    exit();
?>