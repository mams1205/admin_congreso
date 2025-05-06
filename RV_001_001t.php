<?php
   $PageSecurity = 2;
   include('includes/session.inc');

    $nombre_user = $_SESSION['UserID'];

    $sql_id_rev = "SELECT ID
                  FROM Cat_Rev_main A
                  WHERE A.user = '$nombre_user'";

    $resultado = DB_query($sql_id_rev, $db);
    $id_rev = null;
    if ($fila = DB_fetch_array($resultado)) {
        $id_rev = $fila['ID'];
    }

    // $sql_cali = "SELECT cali
    //              FROM trabajos_rev
    //              WHERE ID_rev = $id_rev";
    
    // $res_cali = DB_query($sql_cali, $db);
    // $cali = null;
    // if ($fila = DB_fetch_array($res_cali)) {
    //     $cali = $fila['cali'];
    // }
?>

<div class="pt-2 table-responsive table-hover">
   <table id="tabla_revision" class="table table-bordered">
   	  <thead style="background-color: #1c86ee;color: white; font-weight: bold;">
   	     <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Ocupación</th>
            <th>Modalidad</th>
            <th>Temas</th>
            <th>Status</th>
            <th>Acciones</th>
   	     </tr>   	            
   	  </thead>
      <tfoot style="background-color: #bebebe;color: white;">              
      </tfoot>
      <tbody>
         <?php
            $sql = "SELECT
                        A.ID_trabajo,
                        A.titulo,
                        A.nombre,
                        A.apellido,
                        CASE
                            WHEN A.ocupacion = 'EL' THEN 'Estudiante Lic.'
                            WHEN A.ocupacion = 'EM' THEN 'Estudiante Maestría'
                            WHEN A.ocupacion = 'ED' THEN 'Estudiante Doctorado'
                            WHEN A.ocupacion = 'P' THEN 'Profesionista'
                        END AS Ocupacion,
                        CASE
                            WHEN A.modalidad_trabajo = 'O' THEN 'Oral'
                            WHEN A.modalidad_trabajo = 'C' THEN 'Cartel'
                            WHEN A.modalidad_trabajo = 'R' THEN 'Presentación Rápida'
                        END AS Modalidad,
                        GROUP_CONCAT(C.tema SEPARATOR ', ') AS tema,
                        CASE
                            WHEN A.status = 'R' THEN 'Recibido'
                            WHEN A.status = 'E' THEN 'Enviado a Revisión'
                            WHEN A.status = 'C' THEN 'Calificado'
                            WHEN A.status = 'T' THEN 'Resultado Enviado'
                        END AS Status,
                        TR.cali
                    FROM
                        trabajos_main A
                    LEFT JOIN 
                        trabajos_detalle_tema B ON B.ID_trabajo = A.ID_trabajo
                    LEFT JOIN
                        Cat_temas C ON C.ID_tema = B.tema
                     LEFT JOIN
                     	trabajos_rev TR ON TR.ID_trabajo =  A.ID_trabajo
                     LEFT JOIN Cat_Rev_main CR ON CR.ID = TR.ID_rev
                     WHERE (A.status = 'E' OR A.status = 'C') AND TR.ID_rev = $id_rev
                    GROUP BY 
                        A.ID_trabajo, A.titulo, A.nombre, A.apellido, A.ocupacion";
	          $res = DB_query($sql,$db);
	          while($row = DB_fetch_row($res)) {
                $style = '';
                if ($row[7] === 'Enviado a Revisión' && $row[8] == 0) {
                    $style = 'style="background-color: #EA526F;"';
                } elseif ($row[7] === 'Enviado a Revisión' && $row[8] != 0 ) {
                    $style = 'style="background-color: #85D6FF;"'; // color para calificado
                } elseif($row[7] === 'Calificado' && $row[8] != 0){
                    $style = 'style="background-color: #85D6FF;"';
                }
                
                echo '<tr ' . $style . '>';
	            echo '<td>'.$row[0].'</td>';
	            echo '<td>'.$row[1].'</td>';
                echo '<td>'.$row[2].'</td>';
                echo '<td>'.$row[3].'</td>';
                echo '<td>'.$row[4].'</td>';
                echo '<td>'.$row[5].'</td>';
                echo '<td>'.$row[6].'</td>';
                if ($row[7] === 'Enviado a Revisión' && $row[8] == 0){
                    echo '<td>'.$row[7].'</td>';
                }else{
                    echo '<td> CALIFICACIÓN ENVIADA </td>';
                }
                if ($row[7] === 'Enviado a Revisión' && $row[8] == 0){
                    echo '<td>
                             <div class="d-flex flex-column gap-2"> 
                                <a href="RV_001_001n.php?A=vCali&ID='.$row[0].'" 
                                   class = "btn btn-primary"
                                   role = button
                                   style="border: 2px solid white;">
                                   <i class="fa-solid fa-user-graduate"></i>
                                   Calificar
                                </a>
                                <a href="#" 
                                    class = "btn btn-success mt-1"
                                    role = button
                                    onclick="gen_pdf(' . $row[0] . ')"
                                    style="border: 2px solid white;">
                                    <i class="fa-solid fa-download"></i> 
                                    Descargar Resumen
                                </a>
        
                                <a href="RV_001_001n.php?A=vDet&ID='.$row[0].'"
                                    class="btn mt-1"
                                    role="button"
                                    style="background-color: #6f42c1; border-color: #6f42c1; color: white; border: 2px solid white">
                                    <i class="fa-solid fa-magnifying-glass"></i> 
                                    Consulta detalle
                                </a>
                             </div>
                          </td>';
                }
                else{
                   echo '<td> SIN ACCIONES DISPONIBLES </td>';
                }               
	          }
	       ?>
   	  </tbody>
   </table>
</div>

<script type="text/javascript">
   $(document).ready(function() {
      $('#tabla_revision').DataTable({
         "language": {
         "url": "plugins/bootstrap/js/Spanish.json"},
         "order": [[0, "asc"]]
      });
   });      
</script>

<script type="text/javascript">
   $(document).ready(function() {
      $('#tabla_revision').DataTable();
   });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/5.0.2/jspdf.plugin.autotable.js"></script>

<script>
    async function gen_pdf(id) {
        try {
            console.log(id)
            const response = await fetch(`AP_001_001da.php?ID=${id}`);
            
            const data = await response.json();
            
            let decodedData = {};
            Object.keys(data).forEach(key => {
                decodedData[key] = (new DOMParser()).parseFromString(data[key], "text/html").documentElement.textContent;
                decodedData[key] = decodedData[key].replace(/[\r\n]+/g, ' ')
                                                    .replace(/&lt;/g, '<')
                                                    .replace(/&gt;/g, '>')
                                                    .replace(/&amp;/g, '&')
                                                    .replace(/&quot;/g, '"')
                                                    .replace(/&apos;/g, "'")
                                                    .replace(/&nbsp;/g, ' ') // Reemplaza los espacios no separables
                                                    .replace(/&copy;/g, '©')  // Copyright
                                                    .replace(/&reg;/g, '®')    // Registered trademark
                                                    .replace(/&euro;/g, '€')   // Euro symbol
                                                    .replace(/&pound;/g, '£')  // Libra esterlina
                                                    .replace(/&yen;/g, '¥')    // Yen japonés
                                                    .replace(/&cent;/g, '¢')   // Centavo
                                                    .replace(/&times;/g, '×')  // Multiplicación
                                                    .replace(/&divide;/g, '÷') // División
                                                    .replace(/=/g, '=')
                                                    .replace(/\$/g, '$')
                                                    .replace(/%/g, '%')
                                                    .replace(/#/g, '#')
                                                    .replace(/[\r\n]+/g, ' ');
            });

            // Crear una nueva instancia de jsPDF
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            // Agregar contenido al PDF
            doc.setFont("helvetica", "bold");
            doc.setFontSize(12);

            // const titulo_esp = decodedTitulo;
            const pageWidth = doc.internal.pageSize.getWidth(); // Ancho de la página
            const maxWidth = pageWidth - 40; // Margen de 20px a cada lado

            // Divide el texto en múltiples líneas si es necesario
            const tituloDividido = doc.splitTextToSize(decodedData.titulo, maxWidth);
            const titulo_eng = doc.splitTextToSize(decodedData.titulo_eng, maxWidth);
            
            const autoresDividido = doc.splitTextToSize(decodedData.co_autores, maxWidth);

            const resumen_esp = doc.splitTextToSize(decodedData.resumen_esp, (maxWidth+50));
            const resumen_eng = doc.splitTextToSize(decodedData.resumen_eng, (maxWidth+50));

            const palabras_clave_eng = doc.splitTextToSize(decodedData.palabras_clave_eng, maxWidth);
            const palabras_clave = doc.splitTextToSize(decodedData.palabras_clave, maxWidth);
            
            const fontSize_tit = 12; // Tamaño de la fuente del titulo
            // Agrega Título
            const tituloDimensions = doc.getTextDimensions(tituloDividido, { fontSize_tit });
            const titulo_lineHeight = tituloDimensions.h; // Altura de una línea de texto
            const tituloTotalHeight = tituloDividido.length * titulo_lineHeight; // Altura total del bloque de autores
            const tituloEndY = 20 + titulo_lineHeight; // Posición final de autores
            doc.text(tituloDividido, pageWidth / 2, 20, { align: "center" });


            const fontSize = 10; // Tamaño de la fuente del texto
            doc.setFont("helvetica", "normal");
            doc.setFontSize(10);
            
            //Agrega autores
            const authorsStartY = tituloEndY + 5; // Añade margen de 5px después de autores
            const textDimensions = doc.getTextDimensions(autoresDividido, { fontSize });
            const lineHeight = textDimensions.h; // Altura de una línea de texto
            const authorsTotalHeight = autoresDividido.length * lineHeight; // Altura total del bloque de autores
            const authorsEndY =  tituloEndY + lineHeight; // Posición final de autores

            doc.text(autoresDividido, pageWidth / 2, authorsStartY, { align: "center" });

            //Agregar palabras clave
            const palabrasClaveStartY = authorsEndY + 10; // Añade margen de 5px después de autores
            const palabrasClaveLines = doc.splitTextToSize("Palabras Clave: " + palabras_clave, maxWidth);
            const palabrasClaveDimensions = doc.getTextDimensions(palabrasClaveLines, {fontSize});
            const palabrasClavelineh = palabrasClaveDimensions.h;
            const palabrasClaveTotalHeight = palabrasClaveLines.length * lineHeight;
            const palabrasClaveEndY = palabrasClaveStartY + palabrasClavelineh;

            doc.text(palabrasClaveLines, pageWidth / 2, palabrasClaveStartY, { align: "center" });

            //Agregar Resumen
            let yPosition = palabrasClaveEndY + 5
             // Escribir las líneas en el PDF
            resumen_esp.forEach(line => {
                if (yPosition + 10 > doc.internal.pageSize.height - 20) {
                    // Si el texto sobrepasa la página, agregar una nueva página
                    doc.addPage();
                    yPosition = 20; // Reiniciar la posición vertical
                }
                doc.text(line, 20, yPosition, {align: "justify"});
                yPosition += 6; // Incrementar la altura para la siguiente línea
            });
            doc.addPage();

            doc.setFont("helvetica", "bold");
            doc.setFontSize(12);
            // Agrega Título english
            const tit_engDimensions = doc.getTextDimensions(titulo_eng, { fontSize_tit });
            const tit_englineHeight = tit_engDimensions.h; // Altura de una línea de texto
            const tit_engTotalHeight = titulo_eng.length * tit_englineHeight; // Altura total del bloque de autores
            const tit_engEndY = 20 + tit_englineHeight; // Posición final de autores
            doc.text(titulo_eng, pageWidth / 2, 20, { align: "center" });


            doc.setFont("helvetica", "normal");
            doc.setFontSize(10);

            //Agrega autores
            const authors_engStartY = tit_engEndY + 5; // Añade margen de 5px después de autores
            // const authors_engDimensions = doc.getTextDimensions(autoresDividido, { fontSize });
            // const lineHeight = textDimensions.h; // Altura de una línea de texto
            // const authorsTotalHeight = autoresDividido.length * lineHeight; // Altura total del bloque de autores
            const authors_engEndY =  tit_engEndY + lineHeight; // Posición final de autores
            doc.text(autoresDividido, pageWidth / 2, authors_engStartY, { align: "center" });

            //Agregar palabras clave
            const keywordsStartY = authors_engEndY + 10; // Añade margen de 5px después de autores
            const keywordsLines = doc.splitTextToSize("Keywords: " + palabras_clave_eng, maxWidth);
            const keywordsDimensions = doc.getTextDimensions(keywordsLines, {fontSize});
            const keywordslineh = keywordsDimensions.h;
            const keywordsTotalHeight = keywordsLines.length * lineHeight;
            const keywordsEndY = keywordsStartY + keywordslineh;

            doc.text(keywordsLines, pageWidth / 2, keywordsStartY, { align: "center" });

            // doc.text("Keywords: " + palabras_clave_eng, pageWidth / 2, 45, { align: "center" });
            
            let yPosition_eng = keywordsEndY + 5
             // Escribir las líneas en el PDF
            resumen_eng.forEach(line => {
                if (yPosition_eng + 10 > doc.internal.pageSize.height - 20) {
                    // Si el texto sobrepasa la página, agregar una nueva página
                    doc.addPage();
                    yPosition_eng = 20; // Reiniciar la posición vertical
                }
                doc.text(line, 20, yPosition_eng, {align: "justify"});
                yPosition_eng += 6; // Incrementar la altura para la siguiente línea
            });




            // Descargar el archivo con un nombre dinámico
            doc.save(`resumen_${id}.pdf`);
        } catch (error) {
            console.error("Error al generar el PDF:", error);
            alert("Hubo un error al generar el PDF.");
        }
    }
</script>





