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
    
?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <?php include 'head.php'; ?>
    </head>


    <body>
        <?php include 'header.php'; ?>
        <main> 
            <div class="container-fluid bg-breadcrumb" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 20, 66, 0.7)), url('<?php echo $ruta_foto; ?>'); background-position: center; background-size: cover; background-repeat: no-repeat;">
    <div class="container text-center py-5" style="max-width: 900px;">
      <h4 style="font-family: 'Nunito';"class="text-white display-3 display-md-2 display-lg-1 mb-4 wow fadeInDown" data-wow-delay="0.1s">Inscripción</h4>
    </div>
  </div>

  <div class="container-fluid feature py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s">
            <h1 class ="display-3 display-md-2 display-lg-1" style="font-family:'Nunito'; color: #001442">Precios de Inscripción</h1>
            <hr style="border: none; border-top: 5px solid darkblue;">
            <p style="font-size: 25px; font-family:'Nunito'; color: #001442">
                La 2ª  Reunión Internacional para el Estudio de los Mamíferos Acuáticos SOMEMMA-SOLAMAC se llevará a cabo en Mazatlán, Sinaloa, del 8 al 12 de diciembre de 2025. 
                La fecha límite para el pago anticipado es hasta el final del día 30 de agosto de 2025. Después de esa fecha, se aplicarán las tarifas de pago tardío.
            </p>
        </div>
        <div class="row justify-content-center">
            <!-- Card Pago Temprano -->
            <div class="col-12 col-md-6 col-lg-5 mb-4">
            <div class="card h-100">
                <div class="card-header text-center" style="background-color: #00D1F9; color:#001442; font-family:'Nunito'; font-size:x-large; font-weight:bold">Pago Temprano</div>
                <div class="card-body text-center">
                <img src="img/FOTOS/azul.jpg" class="img-fluid rounded mb-3" alt="Descripción de la imagen">
                <h4 class="card-title">Pago antes del 30 de agosto</h4>
                </div>
                <div class="card-footer text-center">
                <p><strong>Miembros SOMEMMA-SOLAMAC</strong></p>
                <ul style="list-style: none; padding-left: 0;">
                    <li>Estudiante pregrado <strong>$80USD</strong></li>
                    <li>Estudiante posgrado <strong>$90USD</strong></li>
                    <li>Profesionista y Participante general <strong>$130USD</strong></li>
                </ul>
                <hr style="border: none; border-top: 5px solid darkblue;">
                <p><strong>NO miembros</strong></p>
                <ul style="list-style: none; padding-left: 0;">
                    <li>Estudiante pregrado <strong>$100USD</strong></li>
                    <li>Estudiante posgrado <strong>$120USD</strong></li>
                    <li>Profesionista y Participante general <strong>$175USD</strong></li>
                </ul>
                <a href="proximamente.php" class="btn btn-primary rounded-pill d-inline-flex flex-shrink-0 py-2 px-4">Proceder al pago</a>
                </div>
            </div>
            </div>

            <!-- Card Pago Tardío -->
            <div class="col-12 col-md-6 col-lg-5 mb-4">
            <div class="card h-100">
                <div class="card-header text-center" style="background-color: #001442; color: white; font-family:'Nunito'; font-size:x-large; font-weight:bold">Pago Tardío</div>
                <div class="card-body text-center">
                <img src="img/FOTOS/manati_2.jpg" class="img-fluid rounded mb-3" alt="Descripción de la imagen">
                <h4 class="card-title">Pago a partir del 1 de septiembre</h4>
                </div>
                <div class="card-footer text-center">
                <p><strong>Miembros SOMEMMA-SOLAMAC</strong></p>
                <ul style="list-style: none; padding-left: 0;">
                    <li>Estudiante pregrado <strong>$105USD</strong></li>
                    <li>Estudiante posgrado <strong>$115USD</strong></li>
                    <li>Profesionista y Participante General <strong>$155USD</strong></li>
                </ul>
                <hr style="border: none; border-top: 5px solid darkblue;">
                <p><strong>NO miembros</strong></p>
                <ul style="list-style: none; padding-left: 0;">
                    <li>Estudiante pregrado <strong>$125USD</strong></li>
                    <li>Estudiante posgrado <strong>$145USD</strong></li>
                    <li>Profesionista y Participante general <strong>$195USD</strong></li>
                </ul>
                <a href="proximamente.php" class="btn btn-primary rounded-pill d-inline-flex flex-shrink-0 py-2 px-4">Proceder al pago</a>
                </div>
            </div>
            </div>

        </div> <!-- .row -->
            <div class="text-center mx-auto pb-5">
                <p style="font-size: 25px; font-family:'Nunito'; color: #001442">
                    Próximamente compartiremos los detalles sobre cómo realizar el pago.
                </p>

                <p style="font-size: 25px; font-family:'Nunito'; color: #001442">
                    Ten en cuenta que estos costos no incluyen la participación en los cursos pre congreso.
                    Dichos cursos tendrán un costo adicional, el cual será anunciado en breve.
                </p>
            </div>

    </div> <!-- .container -->
  </div> <!-- .container-fluid -->
</main>



        <!-- Copyright Start -->
        <?php include 'footer.php';?> 
        <!-- Copyright End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>
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

    </body>

</html>
<?php
// Cerrar conexión
$conexion->close();
?>
