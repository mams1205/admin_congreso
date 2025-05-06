<?php require('conexion_bd.php');
$sql = "SELECT 
            ID_FOTO,
            ruta_foto
        FROM 
            fotos
        ORDER BY RAND()
        LIMIT 10"; // Cambia "PROP_F" por el nombre correcto si es diferente
$resultado = mysqli_query($conexion, $sql);
//array vacio
$fotos =[];
/// Verificar si la consulta devolvió resultados
if (mysqli_num_rows($resultado) > 0) {
  // Recorrer y mostrar cada fila de la tabla
  while ($fila = mysqli_fetch_assoc($resultado)) {
    $fotos[]=$fila; //se agrega la fila al array

  }
} else {
  echo "No se encontraron resultados.";
}

// Cerrar la conexión
mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <?php include 'head.php'; ?>
    </head>


    <body>
        <?php include 'header.php'; ?>
    

            <!-- Carousel Start -->
        <div class="carousel-header">
            <div id="carouselId" class="carousel slide" data-bs-ride="carousel">

                <!-- Indicadores dinámicos -->
                <div class="carousel-indicators">
                    <?php foreach ($fotos as $i => $foto): ?>
                        <button type="button"
                                data-bs-target="#carouselId"
                                data-bs-slide-to="<?= $i ?>"
                                class="<?= $i === 0 ? 'active' : '' ?>"
                                <?= $i === 0 ? 'aria-current="true"' : '' ?>
                                aria-label="Slide <?= $i + 1 ?>">
                        </button>
                    <?php endforeach; ?>
                </div>

                <div class="carousel-inner" role="listbox">
                    <?php foreach ($fotos as $i => $foto): 
                        $ruta_foto = isset($foto['ruta_foto']) ? $foto['ruta_foto'] : 'img/FOTOS/bg.jpg';
                        $activeClass = ($i === 0) ? 'active' : '';
                    ?>
                        <div class="carousel-item <?= $activeClass ?>">
                            <img src="<?= $ruta_foto ?>" class="d-block w-100" alt="Foto del carrusel <?= $i + 1 ?>">
                            <div class="carousel-caption-1 d-flex align-items-center justify-content-center h-100">
                                <div class="carousel-caption-1-content" style="max-width: 900px;">
                                    <h4 class="text-white text-uppercase fw-bold mb-4 fadeInLeft animated display-6 display-md-5 display-lg-4"
                                        style="animation-delay: 1s;">
                                        Segunda Reunión Internacional para el Estudio de los Mamíferos Acuáticos SOMEMMA-SOLAMAC
                                    </h4>
                                    <h1 class="display-2 text-uppercase text-white mb-2 fadeInLeft animated"
                                        style="font-size: 16px; font-family: 'Open Sans'; animation-delay: 1.3s;">
                                        XXXIX Reunión Internacional para el Estudio de los Mamíferos Marinos
                                    </h1>
                                    <h1 class="display-2 text-uppercase text-white mb-2 fadeInLeft animated "
                                        style="font-size: 14px; font-family: 'Open Sans'; animation-delay: 1.3s;">
                                        20 Reunión de Trabajo de Especialistas en Mamíferos Acuáticos de América del Sur
                                    </h1>
                                    <h1 class="display-2 text-uppercase text-white mb-4 fadeInLeft animated"
                                        style="font-size: 14px; font-family: 'Open Sans'; animation-delay: 1.3s;">
                                        IX Congreso de la Sociedad Latinoamericana de Mamíferos Acuáticos
                                    </h1>
                                    <div class="carousel-caption-1-content-btn fadeInLeft animated"
                                        style="animation-delay: 1.7s;">
                                        <a class="btn btn-primary rounded-pill flex-shrink-0 py-3 px-5 me-2" href="mztln.php">
                                            ¡Más información!
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Botones del carrusel -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon btn btn-primary fadeInLeft animated" style="animation-delay: 1.3s;">
                        <i class="fa fa-angle-left fa-3x"></i>
                    </span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                    <span class="carousel-control-next-icon btn btn-primary fadeInRight animated" style="animation-delay: 1.3s;">
                        <i class="fa fa-angle-right fa-3x"></i>
                    </span>
                    <span class="visually-hidden">Siguiente</span>
                </button>

            </div>
        </div>
        <!-- Carousel End -->

        <div class="container-fluid about">
            <div class="container">
                
                <!-- Fila con logo a la izquierda y texto a la derecha -->
                <div class="row align-items-center">
                    <!-- Columna del logo -->
                    <div class="col-12 col-md-3 d-flex justify-content-center mb-4 mb-md-0">
                        <img src="img/logo_congreso_fin.png" class="img-fluid"
                            style="width: 100%; max-width: 405px; height: 433px; object-fit: contain;"
                            alt="Logo Congreso">
                    </div>

                    <!-- Columna del texto -->
                    <div class="col-12 col-md-9 justify-content-center mb-4 mb-md-0">
                        <h1 class="text-uppercase text-center text-md-center fw-bold fadeInLeft animated"
                            style="font-size: 22px; font-family: 'Nunito'; animation-delay: 0.5s;">
                            "LOS MAMÍFEROS ACUÁTICOS Y LA CONSERVACIÓN DE LOS OCÉANOS DE AMÉRICA LATINA PARA LA HUMANIDAD"
                        </h1>
                        <h1 class="text-uppercase text-center text-md-center fw-bold fadeInLeft animated"
                            style="font-size: 22px; font-family: 'Nunito'; animation-delay: 0.5s; color:#00D1F9">
                            "MAMÍFEROS AQUÁTICOS E A CONSERVAÇÃO DOS OCEANOS LATINO-AMERICANOS PARA A HUMANIDADE"
                        </h1>

                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid blog pb-5" style="margin-top: 20px;">
            <div class="container pb-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h1 class="text-center  fw-bold display-4 display-md-3 display-lg-1" style="font-family:'Nunito'; color: #001442;">Historia e Importancia</h1>
                    <hr style="border: none; border-top: 5px solid darkblue;">
                </div>
                <div style="align-items: center; text-align:justify">
                <p class="descripcion-texto-mztln" style="justify-content: center;">
                    La Segunda Reunión conjunta de la Sociedad Latinoamericana de Especialistas en 
                    Mamíferos Acuáticos (SOLAMAC) y la Sociedad Mexicana de Mastozoología Marina   
                    (SOMEMMA), que se celebrará en 2025 en la ciudad de Mazatlán, México, representa un hito 
                    relevante para el fortalecimiento de la cooperación científica regional orientada a la 
                    conservación de los mamíferos acuáticos y sus hábitats. Esta edición especial retoma y celebra 
                    la histórica colaboración iniciada en 2006, en la “Primera Reunión Internacional para el Estudio 
                    de los Mamíferos Acuáticos SOMEMMA-SOLAMAC” realizada en Mérida, México, que consolidó 
                    vínculos institucionales y científicos entre especialistas latinoamericanos. En un contexto de 
                    crecientes amenazas a los ecosistemas marinos, el reencuentro de ambas sociedades 
                    reafirma el compromiso con el intercambio de conocimientos, la capacitación de profesionales 
                    y el desarrollo de estrategias integradas y sostenibles para la investigación y conservación. La 
                    elección de Mazatlán, reconocida por su relevancia ecológica y cultural en el contexto marino, 
                    refuerza la importancia de dialogar entre ciencia y sociedad. Este encuentro busca no sólo 
                    impulsar el avance técnico-científico, sino también fomentar colaboraciones interinstitucionales 
                    duraderas, enfocadas en soluciones compartidas para los desafíos que enfrentan los 
                    mamíferos acuáticos en toda la región. La II Reunión Internacional para el Estudio de los 
                    Mamíferos Acuáticos 2025 será, por tanto, una plataforma estratégica para consolidar avances 
                    y planificar el futuro de la conservación marina en América Latina. 
                </p>
                </div>
            </div>
        </div>

        <div class="container-fluid blog pb-5" style="margin-top: 20px;">
            <div class="container">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h1 class="text-center  fw-bold display-4 display-md-3 display-lg-1" style="font-family:'Nunito'; color: #001442;">Tema de la reunión</h1>
                    <hr style="border: none; border-top: 5px solid darkblue;">
                </div>

                <div style="align-items: center; text-align:justify">
                    <p class="descripcion-texto-mztln" style="justify-content: center;">
                        El Tema de la Reunión es “Los Mamíferos Acuáticos y la Conservación de los Océanos 
                        de América Latina para la Humanidad” que está alineado con el objetivo 14 de la agenda 2030 
                        sobre el Desarrollo Sostenible de la Organización de las Naciones Unidas (ONU) para la 
                        protección del medio ambiente. 
                    </p>
                </div>
                
                <div class="row align-items-center">
                    <!-- Columna del logo -->
                        <img src="img/logo_congreso_fin.png" 
                            class="img-fluid mx-auto d-block" 
                            style="max-width: 284px; height: 303px; object-fit: contain;" 
                            alt="Logo Congreso">
                </div>

                <div style="align-items: center; text-align:justify">
                    <p class="descripcion-texto-mztln" style="justify-content: center;">
                        El logo de la Reunión se compone de elementos representativos de la región. En la 
                        lengua indígena “nahuatl”, Mazatlán significa “Tierra de venados”. El mar de Mazatlán es un 
                        hábitat clave para varios mamíferos acuáticos como las ballenas jorobadas, que migran desde 
                        las frías aguas del Ártico hasta el Pacífico Mexicano, y frente a las costas de Mazatlán 
                        encuentran las condiciones idóneas para reproducirse y dar a luz a sus crías. La temporada 
                        de avistamiento de ballenas jorobadas en Mazatlán va de diciembre a abril, por lo que esta 
                        Reunión 2025 brinda una gran oportunidad para observar a estos cetáceos. 
                    </p>
                </div>
            </div>
        </div>

        <!-- Fechas -->
        <div class="container-fluid blog pb-5" style="margin-top: 20px;">
            <div class="container pb-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <!-- <h4 class="text-uppercase text-primary">Our Blog</h4> -->
                    <h1 class="text-center  fw-bold display-4 display-md-3 display-lg-1" style="font-family:'Nunito'; color: #001442;">Cursos, ponencias y más</h1>
                    <hr style="border: none; border-top: 5px solid darkblue;">
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="img/FOTOS/orca.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="blog-date px-4 py-2"><i class="fa fa-calendar-alt me-1"></i> Dic 06 2025 y Dic 07 2025 </div>
                            </div>
                            <div class="blog-content rounded-bottom p-4">
                                <a href="#" class="h4 d-inline-block mb-3" style ="font-family:'Nunito'; color: #001442">Cursos Pre-congreso</a>
                                <p>¡Más Información Próximamente!</p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="img/FOTOS/franca.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="blog-date px-4 py-2"><i class="fa fa-calendar-alt me-1"></i> Dic 8 2025</div>
                            </div>
                            <div class="blog-content rounded-bottom p-4">
                                <a href="#" class="h4 d-inline-block mb-3" style ="font-family:'Nunito'; color: #001442">Programa del Congreso</a>
                                <p>¡Más Información Próximamente!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="img/FOTOS/16b.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="blog-date px-4 py-2"><i class="fa fa-calendar-alt me-1"></i> Dic 8 2025</div>
                            </div>
                            <div class="blog-content rounded-bottom p-4">
                                <a href="#" class="h4 d-inline-block mb-3" style ="font-family:'Nunito'; color: #001442">Ponencias Magistrales</a>
                                <p>¡Más Información Próximamente!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Blog End -->

        <div class="container-fluid about py-5 bg-color: ">
            <div class="container">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s">
                    <h1 class="text-center  fw-bold display-4 display-md-3 display-lg-1" style="font-family:'Nunito'; color: #001442;">
                        ¡GRACIAS A NUESTROS PATROCINADORES!
                    </h1>                    
                    <hr style="border: none; border-top: 5px solid darkblue;">
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-3 d-flex justify-content-center mb-4">
                        <img src="img/munba_exp_logo.png" class="img-fluid rounded" style="width: 250px; height: 113px; object-fit: cover;" alt="">
                    </div>
                    <div class="col-12 col-md-3 d-flex justify-content-center mb-4">
                        <img src="img/logo_mztln_m.png" class="img-fluid rounded-top" style="width: 125px; height: 160px; object-fit: contain;" alt="">
                    </div>
                    <div class="col-12 col-md-3 d-flex justify-content-center mb-4">
                        <img src="img/logo_parque.png" class="img-fluid rounded-top" style="width: 250px; height: 82px; object-fit: cover;" alt="">
                    </div>
                    <div class="col-12 col-md-3 d-flex justify-content-center mb-4">
                        <img src="img/logo_muba.png" class="img-fluid rounded-top" style="width: 250px; height: 56px; object-fit: cover;" alt="">
                    </div>
                </div>
            </div>
        </div>
          
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