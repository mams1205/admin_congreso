<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'head.php'; ?>
    </head>

    <body>
        <?php include 'header.php'; ?>

        <div class="carousel-header" style="height: 700px">
                <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                        <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
                        <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active" style="height: 700px;">
                            <img src="img/mztln.jpg" class="img-fluid w-100" alt="Image">
                            <div class="carousel-caption-1">
                                <div class="carousel-caption-1-content" style="max-width: 900px;">
                                    <h4 class="text-white text-uppercase fw-bold mb-4 fadeInLeft animated display-3 display-md-2 display-lg-1"
                                        style="animation-delay: 1s; font-family: 'Open Sans'">
                                        MAZATLÁN, SINALOA
                                    </h4>                              
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>


        <div class="container-fluid about">
            <div class="container">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s">
                    <h1 class ="display-3 display-md-2 display-lg-1" style="font-family:'Nunito'; color: #001442">¡Bienvenido a Mazatlán!</h1>
                    <hr style="border: none; border-top: 5px solid darkblue;">
                    <p style="font-size: 25px; font-family:'Nunito'; color: #001442">
                        Honramos este puerto, lleno de historia y tradición, donde el mar ha moldeado la vida de pescadores, artistas y comunidades que celebran su identidad al ritmo del tambor. 
                        Esta ciudad, ubicada en la costa del Pacífico mexicano, es reconocida por su gente hospitalaria, su riqueza natural y su diversidad cultural. 
                    </p>

                    <!-- Video responsivo -->
                    <div class="video-responsive" style="margin-top: 30px;">
                        <iframe  
                                src="https://www.youtube.com/embed/70Jsxn-HZiI?si=bE1YlRttP_Q5SrEe"
                                title="YouTube video player"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid about d-flex align-items-center justify-content-center text-center"
            style="background-color: #001442; min-height: 200px;">
            <div class="container">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <p class="descripcion-texto">
                        Mazatlán, Sinaloa, México se convierte en el punto de encuentro para la comunidad de mastozoólogos marinos de América Latina, al recibir con entusiasmo el segundo Congreso SOMEMMA-SOLAMAC 2025.
                    </p>
                </div>
            </div>
        </div>


        <div class="container-fluid feature py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="row">
                        <div class="col-md-4">
                            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner rounded" style="max-height: 300px; max-height: 300px;">
                                    <div class="carousel-item active" style="justify-content: center; align-items: center; height: 100%;">
                                        <img src="img/hoteles/centro_4.jpg" class="d-block w-100 carousel-img-mztln" style="object-fit: contain">
                                    <div class="carousel-caption d-none d-md-block">
                                    </div>
                                    </div>
                                    <div class="carousel-item" style=" justify-content: center; align-items: center; height: 100%;">
                                        <img src="img/hoteles/mal_1.png" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">

                                    </div>
                                    </div>
                                    <div class="carousel-item" style="justify-content: center; align-items: center; height: 100%;">
                                        <img src="img/hoteles/mal_4.jpg" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                    <span><i class="fa fa-chevron-left fa-2x text-dark"></i></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                    <span><i class="fa fa-chevron-right fa-2x text-dark"></i></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-8" style="color: white;">
                            <p class = "descripcion-texto-mztln" style="justify-content: center;">
                                Mazatlán se encuentra en la <strong> zona horaria UTC -7 </strong>, lo que la coloca en una ubicación estratégica, con fácil acceso desde distintas partes de México y el mundo.
                                Esta ciudad se distingue por su cálido clima tropical y su ambiente acogedor, ideal para disfrutar de la hospitalidad mexicana y la vibrante vida urbana, siempre conectada con el mar y la naturaleza.
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid about d-flex align-items-center justify-content-center text-center"
            style="background-color: #001442; min-height: 200px;">
            <div class="container">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <div class="row justify-content-center" style="margin: 20px">
                        <div class=" col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                            <img src="img/MUNBA/munba1.jpg " class="img-fluid rounded custom-img" alt="">
                        </div>
                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                            <img src="img/MUNBA/MIUNBA2.jpg" class="img-fluid rounded custom-img"  alt="">
                        </div>
                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                            <img src="img/MUNBA/MUNBA3.jpg" class="img-fluid rounded custom-img"  alt="">
                        </div>
                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                            <img src="img/MUNBA/MUNBA4.jpg" class="img-fluid rounded custom-img"  alt="">
                        </div>
                    </div>
                    <p class="descripcion-texto" style="margin-top:0%">
                        El rompehielos se celebrará en el Museo Nacional de la Ballena (MUNBA). El MUNBA se erige como un centro de referencia en México para la educación, la conservación, la investigación y la protección de las ballenas en nuestras aguas, ofreciendo un enfoque integral que conecta la ciencia con la sensibilización pública.<br>
                        <strong> En breve publicaremos el sitio sede de la conferencia. </strong>
                    </p>
                </div>
            </div>
        </div>

        <div class="container-fluid about" style="margin-top: 20px;">
            <div class="container">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s">
                    <h1 class ="display-3 display-md-2 display-lg-1" style="font-family:'Nunito'; color: #001442">¿Cómo llegar a Mazatlán?</h1>
                    <hr style="border: none; border-top: 5px solid darkblue;">
                    <div class="d-flex align-items-start">
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Viaje Aereo</button>
                            <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Viaje Terrestre</button>
                        </div>
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <p style="color:#001442; font-family:'Nunito'";>
                                    En el Aeropuerto Internacional de Mazatlán-General Rafael Buelna operan 7 aerolíneas extranjeras, 8 aerolíneas nacionales. El Aeropuerto opera las 24 horas, los siete días de la semana.  
                                </p>
                                <p style="color:#001442; font-family:'Nunito'";>
                                    Para quienes viajan desde países de América Latina, les informamos que actualmente Mazatlán solo cuenta con vuelos internacionales directos desde Estados Unidos y Canadá. Por ello, es necesario hacer escala en alguna ciudad mexicana —como Ciudad de México, Guadalajara o Monterrey— y desde ahí tomar un vuelo nacional hacia Mazatlán. Les recomendamos revisar con anticipación las opciones de conexión más convenientes según su país de origen.                                </p>
                                </p>
                                <p style="color:#001442; font-family:'Nunito'";>
                                    Vuelos nacionales directos desde 10 ciudades dentro de México: 
                                </p>
                                <ul style="list-style-type: none; padding-left: 0; color:#001442; font-family:'Nunito';">
                                    <li>Cabo San Lucas (SJD)</li>
                                    <li>Chihuahua (CUU)</li>
                                    <li>Ciudad de México (MEX) - Benito Juárez</li>
                                    <li>Ciudad de México (NLU) - Felipe Ángeles</li>
                                    <li>Ciudad Juárez (CJS)</li>
                                    <li>Guadalajara (GDL)</li>
                                    <li>Monterrey (MTY)</li>
                                    <li>Querétaro (QRO)</li>
                                    <li>Silao (BJX)</li>
                                    <li>Tijuana (TIJ)</li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <ul style="list-style-type: none; padding-left: 0; color:#001442; font-family:'Nunito';">
                                    <li><strong>Público</strong>
                                        <ul style="list-style-type: none; padding-left: 0; color:#001442; font-family:'Nunito';">
                                            <li>Puede encontrar información sobre accesibilidad, tarifas y horarios del transporte público en: 
                                                <a href="https://tics.mazatlan.gob.mx/" target="_blank">https://tics.mazatlan.gob.mx/</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><strong>Autobuses</strong>
                                        <ul style="list-style-type: none; padding-left: 0; color:#001442; font-family:'Nunito';">
                                            <li>Desde la Ciudad de México, varias líneas de autobuses ofrecen servicios directos a Mazatlán: TAP, ETN Turistar, Primera Plus.</li>
                                        </ul>
                                    </li>
                                    <li><strong>Plataformas</strong>
                                        <ul style="list-style-type: none; padding-left: 0; color:#001442; font-family:'Nunito';">
                                            <li>Mazatlán ofrece diversas opciones de transporte para los visitantes. Conseguir un taxi es fácil, especialmente en zonas turísticas, el aeropuerto, terminales, hoteles y el malecón.</li>
                                            <li><strong>Taxis tradicionales:</strong> Disponibles en la calle, sitios oficiales o a través de hoteles. Se recomienda acordar el precio antes del viaje.</li>
                                            <li><strong>Pulmonías:</strong> Icónicos vehículos abiertos similares a carritos de golf, ideales para recorridos cortos y turísticos.</li>
                                            <li><strong>Aplicaciones móviles:</strong> Uber, DiDi e InDrive operan en la ciudad.</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                           
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="container-fluid about" style="margin-top: 20px;">

            <div class="container">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s">
                    <h1 class ="display-3 display-md-2 display-lg-1" style="font-family:'Nunito'; color: #001442">Alojamiento</h1>
                    <hr style="border: none; border-top: 5px solid darkblue;">
                    <ul class="list-unstyled">
                        <li class="descripcion-texto-mztln">
                            Estamos por confirmar la sede oficial de la conferencia.
                        </li>
                        <li class="descripcion-texto-mztln" >
                            No obstante, pensando en su <strong>comodidad y seguridad</strong>, les recomendamos hospedarse en las inmediaciones del Centro Histórico de Mazatlán.
                            Esta zona es reconocida por ser <strong>segura, bien iluminada y con constante presencia turística</strong>, lo que brinda un entorno confiable tanto de día como de noche. Además, ofrece una amplia variedad de servicios, opciones de alojamiento, comida, vida nocturna y actividades culturales a poca distancia a pie.
                        </li>
                        <li class="descripcion-texto-mztln">
                            Agradecemos que consideren esta recomendación, ya que permitirá disfrutar de una estancia <strong>tranquila, accesible y segura</strong> durante el evento.
                        </li>
                        <li class="descripcion-texto-mztln">   
                            A continuación, les compartimos algunas opciones de alojamiento en esta zona.
                        </li>
                    </ul>

                </div>
            </div>

            <div class="container">
                    <div class="d-flex align-items-start">
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active" id="v-pills-hotel_1-tab" data-bs-toggle="pill" data-bs-target="#v-pills-hotel_1" type="button" role="tab" aria-controls="v-pills-hotel_1" aria-selected="true">Hotel La Siesta</button>
                            <button class="nav-link" id="v-pills-hotel_2-tab" data-bs-toggle="pill" data-bs-target="#v-pills-hotel_2" type="button" role="tab" aria-controls="v-pills-hotel_2" aria-selected="false">Hotel Posada Freeman</button>
                            <button class="nav-link" id="v-pills-hotel_3-tab" data-bs-toggle="pill" data-bs-target="#v-pills-hotel_3" type="button" role="tab" aria-controls="v-pills-hotel_3" aria-selected="false">Hotel Machado</button>
                            <button class="nav-link" id="v-pills-hotel_4-tab" data-bs-toggle="pill" data-bs-target="#v-pills-hotel_4" type="button" role="tab" aria-controls="v-pills-hotel_4" aria-selected="false">Hotel Casa de Leyendas</button>
                        </div>
                        
                        <div class="tab-content" id="v-pills-tabContent">
                            
                            <div class="tab-pane fade show active" id="v-pills-hotel_1" role="tabpanel" aria-labelledby="v-pills-hotel_1-tab">

                                <div class="container" style="margin-bottom: 20px;">
                                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="row justify-content-center" style="margin-bottom: 20px;">
                                            <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                                <a href="img/hoteles/siesta_1.jpg" data-lightbox="hotel-siesta" style="cursor:zoom-in">
                                                    <img src="img/hoteles/siesta_1.jpg" class="img-fluid rounded custom-img" alt="">
                                                </a>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                                <a href="img/hoteles/siesta_2.jpeg" data-lightbox="hotel-siesta" style="cursor:zoom-in">
                                                    <img src="img/hoteles/siesta_2.jpeg" class="img-fluid rounded custom-img" alt="">
                                                </a>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                                <a href="img/hoteles/siesta_3.jpg" data-lightbox="hotel-siesta" style="cursor:zoom-in">
                                                    <img src="img/hoteles/siesta_3.jpg" class="img-fluid rounded custom-img" alt="">
                                                </a>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                                <a href="img/hoteles/siesta_4.jpg" data-lightbox="hotel-siesta" style="cursor:zoom-in">
                                                    <img src="img/hoteles/siesta_4.jpg" class="img-fluid rounded custom-img" alt="">
                                                </a>
                                            </div>
                                        </div>

                                        <p style="color:#001442; font-family:'Nunito'; text-align:justify";>Hotel La Siesta se localiza en pleno Centro Histórico de Mazatlán, Sinaloa, frente a la playa y al malecón de Olas Altas. Su ubicación es verdaderamente privilegiada, ya que se sitúa muy cerca de la Plaza Machado, de sus restaurantes y bares y de otros íconos de la ciudad como el Teatro Ángela Peralta, la Catedral y el Mercado Pino Suárez.</p>

                                        <p style="color:#001442; font-family:'Nunito'";><strong>No se aceptan mascotas</strong></p>

                                        <p style="color:#001442; font-family:'Nunito'";><strong> Desde $800 MXN por noche ~ 47 USD por noche</strong></p>

                                        <small style="color:#001442; font-family:'Nunito'; display:block; margin-bottom: 10px;">
                                            *Los precios indicados son aproximados y están sujetos a cambios sin previo aviso, dependiendo de la temporada, la disponibilidad y la anticipación con la que se realice la reserva. Estos establecimientos no tienen relación directa con la organización del presente congreso y las reservaciones deben gestionarse directamente con cada uno de ellos.*
                                        </small>

                                        <a href="https://www.lasiesta.com.mx/" class="btn btn-primary rounded-pill d-inline-flex flex-shrink-0 py-2 px-4">Más Información!</a>

                                    </div>

                                </div>


                            </div>
                            
                            <div class="tab-pane fade" id="v-pills-hotel_2" role="tabpanel" aria-labelledby="v-pills-hotel_2-tab">
                                    <div class="container" style="margin-bottom: 20px;">
                                        <div class="row justify-content-center" style="margin-bottom: 20px;">
                                            <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                                <a href="img/hoteles/posada_freeman_1.jpg" data-lightbox="hotel-freeman" style="cursor:zoom-in">
                                                    <img src="img/hoteles/posada_freeman_1.jpg" class="img-fluid rounded custom-img"  alt="">
                                                </a>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                                <a href="img/hoteles/posada_freeman_2.jpg" data-lightbox="hotel-freeman" style="cursor:zoom-in">
                                                    <img src="img/hoteles/posada_freeman_2.jpg" class="img-fluid rounded custom-img"  alt="">
                                                </a>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                                <a href="img/hoteles/posada_freeman_3.jpg" data-lightbox="hotel-freeman" style="cursor:zoom-in">
                                                    <img src="img/hoteles/posada_freeman_3.jpg" class="img-fluid rounded custom-img"  alt="">
                                                </a>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                                <a href="img/hoteles/posada_freeman_4.jpg" data-lightbox="hotel-freeman" style="cursor:zoom-in">
                                                    <img src="img/hoteles/posada_freeman_4.jpg" class="img-fluid rounded custom-img"  alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <p style="color:#001442; font-family:'Nunito'; text-align:justify";>
                                            Best Western Hotel Posada Freeman Zona Dorada es una excelente opción para hospedarse en Mazatlán, combinando comodidad, buena ubicación y servicios de calidad. Está cerca de lugares destacados como el Pacific-Food Truck Park & Golf y la Catedral de la Inmaculada Concepción.

                                            El hotel ofrece wifi gratis, aire acondicionado, piscina, desayuno incluido y estacionamiento gratuito, además de servicio a la habitación y conserjería.

                                            En sus alrededores encontrarás populares restaurantes como Panamá, Pancho’s y Life En Español. Además, está cerca de atractivos turísticos como el Puente Baluarte.

                                            Un lugar ideal para disfrutar de Mazatlán con todas las comodidades.
                                        </p>

                                        <p style="color:#001442; font-family:'Nunito'";><strong>Desde $1,200 MXN ~ 70 USD por noche</strong></p>

                                        <small style="color:#001442; font-family:'Nunito'; display:block; margin-bottom: 10px;">
                                            *Los precios indicados son aproximados y están sujetos a cambios sin previo aviso, dependiendo de la temporada, la disponibilidad y la anticipación con la que se realice la reserva. Estos establecimientos no tienen relación directa con la organización del presente congreso y las reservaciones deben gestionarse directamente con cada uno de ellos.*
                                        </small>

                                        <a href="https://www.bestwestern.com/es_ES/book/hotels-in-mazatlan/best-western-hotel-posada-freeman-zona-dorada/propertyCode.70183.html" class="btn btn-primary rounded-pill d-inline-flex flex-shrink-0 py-2 px-4">Más Información!</a>                 

                                        

                                    </div>
                            </div>

                            <div class="tab-pane fade" id="v-pills-hotel_3" role="tabpanel" aria-labelledby="v-pills-hotel_3-tab">

                                <div class="container" style="margin-bottom: 20px;">
                                    <div class="row justify-content-center" style="margin-bottom: 20px;">
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/hotel_machado_1.jpeg" data-lightbox="hotel-macha" style="cursor:zoom-in">
                                                <img src="img/hoteles/hotel_machado_1.jpeg" class="img-fluid rounded custom-img"  alt="">
                                            </a>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/hotel_machado_2.jpeg" data-lightbox="hotel-macha" style="cursor:zoom-in">
                                                <img src="img/hoteles/hotel_machado_2.jpeg" class="img-fluid rounded custom-img"  alt="">
                                            </a>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/hotel_machado_3.jpeg" data-lightbox="hotel-macha" style="cursor:zoom-in">
                                                <img src="img/hoteles/hotel_machado_3.jpeg" class="img-fluid rounded custom-img"  alt="">
                                            </a>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/hotel_machado_4.jpeg" data-lightbox="hotel-macha" style="cursor:zoom-in">
                                                <img src="img/hoteles/hotel_machado_4.jpeg" class="img-fluid rounded custom-img"  alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <p style="color:#001442; font-family:'Nunito'; text-align:justify";>

                                        Situado a 10 minutos en coche del Faro de Navegación Marítima, el Hotel Machado Mazatlán se encuentra cerca del Museo El Rincón de Pedro Infante.

                                        Los atractivos culturales cercanos son el Museo arqueológico de Mazatlán (800 metros) y el Monumento al Pescador (1 km). Tan solo a 10 minutos en coche del Acuario Maz. Este hotel se encuentra cerca de los taxis Pulmonia, a solo unos minutos de la parada de autobús.
                                        
                                        El Hotel Machado en Mazatlán está a 25 km del Aeropuerto Internacional de Mazatlán.
                                    </p>
                                    <p style="color:#001442; font-family:'Nunito'";><strong>Desde $1,000 MXN ~ 50 USD por noche</strong></p>
                                    <small style="color:#001442; font-family:'Nunito'; display:block; margin-bottom: 10px;">
                                        *Los precios indicados son aproximados y están sujetos a cambios sin previo aviso, dependiendo de la temporada, la disponibilidad y la anticipación con la que se realice la reserva. Estos establecimientos no tienen relación directa con la organización del presente congreso y las reservaciones deben gestionarse directamente con cada uno de ellos.*
                                    </small>

                                    <a href="https://hotel-machado-mazatlan.mazatlan-hotels.com/es/" class="btn btn-primary rounded-pill d-inline-flex flex-shrink-0 py-2 px-4">Más Información!</a>
                                </div>                    

                            </div>

                            <div class="tab-pane fade" id="v-pills-hotel_4" role="tabpanel" aria-labelledby="v-pills-hotel_4-tab">

                                <div class="container" style="margin-bottom: 20px;">
                                    <div class="row justify-content-center" style="margin-bottom: 20px;">
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/casa_1.jpg" data-lightbox="hotel-casa" style="cursor:zoom-in">
                                                <img src="img/hoteles/casa_1.jpg" class="img-fluid rounded custom-img"  alt="">
                                            </a>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/casa_2.jpg" data-lightbox="hotel-casa" style="cursor:zoom-in">
                                                <img src="img/hoteles/casa_2.jpg" class="img-fluid rounded custom-img"  alt="">
                                            </a>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/casa_3.jpg" data-lightbox="hotel-casa" style="cursor:zoom-in">
                                                <img src="img/hoteles/casa_3.jpg" class="img-fluid rounded custom-img"  alt="">
                                            </a>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/casa_4.jpg" data-lightbox="hotel-casa" style="cursor:zoom-in">
                                                <img src="img/hoteles/casa_4.jpg" class="img-fluid rounded custom-img"  alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <p style="color:#001442; font-family:'Nunito'; text-align:justify">

                                        Conocido por su ambiente pintoresco y su proximidad a fantásticos restaurantes y atracciones, Casa de Leyendas te ayuda a disfrutar de lo mejor de Mazatlán.
                                        
                                        Los puntos de referencia de los alrededores, como Catedral Basílica de Mazatlán (0,7 km) y Punta de Clavadistas (0,7 km) hacen de Casa De Leyendas Hotel un magnífico sitio donde alojarse durante un viaje a Mazatlán.

                                        Si te interesa explorar Mazatlán, visita algunas atracciones cercanas como Malecon (0,7 km), Plaza Machado (0,7 km) y Old Mazatlan (0,5 km), ya que puedes llegar a todas andando desde Casa De Leyendas Hotel.

                                        Casa de Leyendas hará inolvidable tu visita a Mazatlán.

                                    </p>
                                    <p style="color:#001442; font-family:'Nunito'"><strong>Desde $1,300 MXN ~ 76 USD por noche</strong></p>
                                    <small style="color:#001442; font-family:'Nunito'; display:block; margin-bottom: 10px;">
                                        *Los precios indicados son aproximados y están sujetos a cambios sin previo aviso, dependiendo de la temporada, la disponibilidad y la anticipación con la que se realice la reserva. Estos establecimientos no tienen relación directa con la organización del presente congreso y las reservaciones deben gestionarse directamente con cada uno de ellos.*
                                    </small>

                                    <a href="https://hotel-machado-mazatlan.mazatlan-hotels.com/es/" class="btn btn-primary rounded-pill d-inline-flex flex-shrink-0 py-2 px-4">Más Información!</a>
                                </div>                    

                            </div>
                           
                        </div>

                    </div>

                
                </div> 

            </div>
           
        </div>

        <div class="container-fluid about" style="margin-top: 20px;">

            <div class="container">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s">
                    <h1 class ="display-3 display-md-2 display-lg-1" style="font-family:'Nunito'; color: #001442">Planifica tu estadía</h1>
                    <hr style="border: none; border-top: 5px solid darkblue;">
                </div>
            </div>

            <div class="container">
                    <div class="d-flex align-items-start">
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active" id="v-pills-mz_1-tab" data-bs-toggle="pill" data-bs-target="#v-pills-mz_1" type="button" role="tab" aria-controls="v-pills-mz_1" aria-selected="true">MUNBA</button>
                            <button class="nav-link" id="v-pills-mz_2-tab" data-bs-toggle="pill" data-bs-target="#v-pills-mz_2" type="button" role="tab" aria-controls="v-pills-mz_2" aria-selected="false">Centro Histórico de Mazatlán</button>
                            <button class="nav-link" id="v-pills-mz_3-tab" data-bs-toggle="pill" data-bs-target="#v-pills-mz_3" type="button" role="tab" aria-controls="v-pills-mz_3" aria-selected="false">Malecón de Mazatlán</button>
                            <button class="nav-link" id="v-pills-mz_4-tab" data-bs-toggle="pill" data-bs-target="#v-pills-mz_4" type="button" role="tab" aria-controls="v-pills-mz_4" aria-selected="false">Museo de Arte de Mazatlán</button>
                            <button class="nav-link" id="v-pills-mz_5-tab" data-bs-toggle="pill" data-bs-target="#v-pills-mz_5" type="button" role="tab" aria-controls="v-pills-mz_5" aria-selected="false">Museo Arqueológico de Mazatlán</button>
                            <button class="nav-link" id="v-pills-mz_6-tab" data-bs-toggle="pill" data-bs-target="#v-pills-mz_6" type="button" role="tab" aria-controls="v-pills-mz_6" aria-selected="false">Gran Acuario de Mazatlán</button>
                        </div>
                        
                        <div class="tab-content" id="v-pills-tabContent">
                            
                            <div class="tab-pane fade show active" id="v-pills-mz_1" role="tabpanel" aria-labelledby="v-pills-mz_1-tab">

                                <div class="container" style="margin-bottom: 20px;">
                                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="row justify-content-center" style="margin-bottom: 20px;">
                                            <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                                <a href="img/MUNBA/munba1.jpg" data-lightbox="MUNBA" style="cursor:zoom-in">
                                                    <img src="img/MUNBA/munba1.jpg" class="img-fluid rounded custom-img"  alt="">
                                                </a>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                                <a href="img/MUNBA/MIUNBA2.jpg" data-lightbox="MUNBA" style="cursor:zoom-in">
                                                    <img src="img/MUNBA/MIUNBA2.jpg" class="img-fluid rounded custom-img"  alt="">
                                                </a>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                                <a href="img/MUNBA/MUNBA3.jpg" data-lightbox="MUNBA" style="cursor:zoom-in">
                                                    <img src="img/MUNBA/MUNBA3.jpg" class="img-fluid rounded custom-img" alt="">
                                                </a>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                                <a href="img/MUNBA/MUNBA4.jpg" data-lightbox="MUNBA" style="cursor:zoom-in">
                                                    <img src="img/MUNBA/MUNBA4.jpg" class="img-fluid rounded custom-img" alt="">
                                                </a>
                                            </div>
                                        </div>

                                        <p style="color:#001442; font-family:'Nunito'; text-align:justify";>Espacio de conocimiento sobre cetáceos y su historia de vida a través de experiencias sensoriales, exhibiciones interactivas y una de las más diversas colecciones de esqueletos de cetáceos en México y Latinoamérica.</p>

                                        <p style="color:#001442; font-family:'Nunito';">
                                            <i class="fas fa-location-dot" style="margin-right: 5px;"></i>
                                            Camino al observatorio 54, Cerro del Vigía. Mazatlán, Sin. CP. 82000
                                        </p>

                                        <a href="https://munba.mx/" class="btn btn-primary rounded-pill d-inline-flex flex-shrink-0 py-2 px-4">Más Información!</a>

                                    </div>

                                </div>


                            </div>
                            
                            <div class="tab-pane fade" id="v-pills-mz_2" role="tabpanel" aria-labelledby="v-pills-mz_2-tab">
                                    <div class="container" style="margin-bottom: 20px;">
                                        <div class="row justify-content-center" style="margin-bottom: 20px;">
                                            <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                                <a href="img/hoteles/centro_1.jpg" data-lightbox="centro" style="cursor:zoom-in">
                                                    <img src="img/hoteles/centro_1.jpg" class="img-fluid rounded custom-img" alt="">
                                                </a>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                                <a href="img/hoteles/centro_2.jpg" data-lightbox="centro" style="cursor:zoom-in">
                                                    <img src="img/hoteles/centro_2.jpg" class="img-fluid rounded custom-img" alt="">
                                                </a>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                                <a href="img/hoteles/centro_3.jpg" data-lightbox="centro" style="cursor:zoom-in">
                                                    <img src="img/hoteles/centro_3.jpg" class="img-fluid rounded custom-img"  alt="">
                                                </a>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                                <a href="img/hoteles/centro_4.jpg" data-lightbox="centro" style="cursor:zoom-in">
                                                    <img src="img/hoteles/centro_4.jpg" class="img-fluid rounded custom-img" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <p style="color:#001442; font-family:'Nunito'; text-align:justify";>
                                            Cuenta con una diversidad arquitectónica de edificios coloniales, calles coloridas, pintorescas y adoquinadas. En esta zona se encuentran una gran variedad de teatros, locales y galerías de arte
                                        </p>

                                        <a href="https://escapadas.mexicodesconocido.com.mx/atractivos/centro-historico-mazatlan/" class="btn btn-primary rounded-pill d-inline-flex flex-shrink-0 py-2 px-4">Más Información!</a>                 

                                        

                                    </div>
                            </div>

                            <div class="tab-pane fade" id="v-pills-mz_3" role="tabpanel" aria-labelledby="v-pills-mz_3-tab">

                                <div class="container" style="margin-bottom: 20px;">
                                    <div class="row justify-content-center" style="margin-bottom: 20px;">
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/mal_1.png" data-lightbox="mal" style="cursor:zoom-in">
                                                <img src="img/hoteles/mal_1.png" class="img-fluid rounded custom-img"  alt="">
                                            </a>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/mal_2.jpg" data-lightbox="mal" style="cursor:zoom-in">
                                                <img src="img/hoteles/mal_2.jpg" class="img-fluid rounded custom-img"  alt="">
                                            </a>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/mal_3.jpeg" data-lightbox="mal" style="cursor:zoom-in">
                                                <img src="img/hoteles/mal_3.jpeg" class="img-fluid rounded custom-img"  alt="">
                                            </a>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/mal_4.jpg" data-lightbox="mal" style="cursor:zoom-in">
                                                <img src="img/hoteles/mal_4.jpg" class="img-fluid rounded custom-img" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <p style="color:#001442; font-family:'Nunito'; text-align:justify";>

                                        Siendo el segundo malecón más largo del mundo, con una extensión de aproximadamente 21 kilómetros. Es un lugar popular para caminar, correr, andar en bicicleta y disfrutar del océano

                                    </p>
                                    
                                    <a href="https://escapadas.mexicodesconocido.com.mx/actividades/malecon-de-mazatlan-sinaloa/" class="btn btn-primary rounded-pill d-inline-flex flex-shrink-0 py-2 px-4">Más Información!</a>
                                </div>                    

                            </div>

                            <div class="tab-pane fade" id="v-pills-mz_4" role="tabpanel" aria-labelledby="v-pills-mz_4-tab">

                                <div class="container" style="margin-bottom: 20px;">
                                    <div class="row justify-content-center" style="margin-bottom: 20px;">
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/mua_1.jpg" data-lightbox="mua" style="cursor:zoom-in">
                                                <img src="img/hoteles/mua_1.jpg" class="img-fluid rounded custom-img"  alt="">
                                            </a>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/mua_2.jpeg" data-lightbox="mua" style="cursor:zoom-in">
                                                <img src="img/hoteles/mua_2.jpeg" class="img-fluid rounded custom-img"  alt="">
                                            </a>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/mua_3.jpg" data-lightbox="mua" style="cursor:zoom-in">
                                                <img src="img/hoteles/mua_3.jpg" class="img-fluid rounded custom-img"  alt="">
                                            </a>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/mua_4.jpg" data-lightbox="mua" style="cursor:zoom-in">
                                                <img src="img/hoteles/mua_4.jpg" class="img-fluid rounded custom-img"  alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <p style="color:#001442; font-family:'Nunito'; text-align:justify">

                                        Cuenta con salas de exposiciones permanentes y temporales que incluyen artistas mexicanos de reconocimiento internacional, de entre los que destacan las obras de Rufino Tamayo, Francisco Toledo, Antonio López Sáenz, José Luis Cuevas, Vicente Rojo, Edgardo Coghlan, entre otros.

                                    </p>

                                    <p style="color:#001442; font-family:'Nunito';">
                                        <i class="fas fa-location-dot" style="margin-right: 5px;"></i>
                                        <a href="https://www.google.com/maps?q=Sixto+Osuna+71,+Mazatlán,+Sinaloa" target="_blank" style="color: inherit; text-decoration: none;">
                                            Sixto Osuna 71, esquina con Venustiano Carranza, Col. Centro, C.P. 82000, Mazatlán, Sinaloa
                                        </a>
                                    </p>

                                    <a href="https://culturasinaloa.gob.mx/index.php/infraestructura/teatros-/museos/museo-de-arte-de-mazatlan" class="btn btn-primary rounded-pill d-inline-flex flex-shrink-0 py-2 px-4">Más Información!</a>
                                </div>                    

                            </div>

                            <div class="tab-pane fade" id="v-pills-mz_5" role="tabpanel" aria-labelledby="v-pills-mz_5-tab">

                                <div class="container" style="margin-bottom: 20px;">
                                    <div class="row justify-content-center" style="margin-bottom: 20px;">
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/arq_1.jpg" data-lightbox="arq" style="cursor:zoom-in">
                                                <img src="img/hoteles/arq_1.jpg" class="img-fluid rounded custom-img"  alt="">
                                            </a>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/arq_2.jpg" data-lightbox="arq" style="cursor:zoom-in">
                                                <img src="img/hoteles/arq_2.jpg" class="img-fluid rounded custom-img"  alt="">
                                            </a>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/arq_3.jpg" data-lightbox="arq" style="cursor:zoom-in">
                                                <img src="img/hoteles/arq_3.jpg" class="img-fluid rounded custom-img" alt="">
                                            </a>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/arq_4.jpg" data-lightbox="arq" style="cursor:zoom-in">
                                                <img src="img/hoteles/arq_4.jpg" class="img-fluid rounded custom-img" alt="">
                                            </a>
                                        </div>
                                    </div>

                                    <p style="color:#001442; font-family:'Nunito'; text-align:justify">

                                        Un edificio histórico cuyo objetivo es mostrar la cultura prehispánica de Mazatlán, Sinaloa, destacando diversas costumbres ancestrales, especialmente las relacionadas con los rituales funerarios y el reconocido juego de pelota llamado ulama.
                                    
                                    </p>

                                    <p style="color:#001442; font-family:'Nunito';">
                                        <i class="fas fa-location-dot" style="margin-right: 5px;"></i>
                                        <a href="https://www.google.com/maps?q=Sixto+Osuna+76,+Mazatlán,+Sinaloa" target="_blank" style="color: inherit; text-decoration: none;">
                                            Sixto Osuna 76 Centro CP 82000 Mazatlán, Mazatlán, Sinaloa
                                        </a>
                                    </p>

                                    <a href="https://sic.gob.mx/ficha.php?table=museo&table_id=300" class="btn btn-primary rounded-pill d-inline-flex flex-shrink-0 py-2 px-4">Más Información!</a>
                                </div>                    

                            </div>

                            <div class="tab-pane fade" id="v-pills-mz_6" role="tabpanel" aria-labelledby="v-pills-mz_6-tab">

                                <div class="container" style="margin-bottom: 20px;">
                                    <div class="row justify-content-center" style="margin-bottom: 20px;">
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/acuario_1.jpg" data-lightbox="acuario" style="cursor:zoom-in">
                                                <img src="img/hoteles/acuario_1.jpg" class="img-fluid rounded custom-img"  alt="">
                                            </a>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/acuario_2.jpg" data-lightbox="acuario" style="cursor:zoom-in">
                                                <img src="img/hoteles/acuario_2.jpg" class="img-fluid rounded custom-img"  alt="">
                                            </a>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/acuario_3.jpg" data-lightbox="acuario" style="cursor:zoom-in">
                                                <img src="img/hoteles/acuario_3.jpg" class="img-fluid rounded custom-img"  alt="">
                                            </a>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-3 d-flex justify-content-center mb-4">
                                            <a href="img/hoteles/acuario_4.jpeg" data-lightbox="acuario" style="cursor:zoom-in">
                                                <img src="img/hoteles/acuario_4.jpeg" class="img-fluid rounded custom-img"  alt="">
                                            </a>
                                        </div>
                                    </div>

                                    <p style="color:#001442; font-family:'Nunito'; text-align:justify">

                                        El Museo del Mar es parte del parque recreativo Acuario de Mazatlán. Aquí se presenta al público una amplia diversidad de especies marinas y de agua dulce con enfoque en educación, investigación y divulgación del conocimiento en la importancia de la conservación del ecosistema marino a través de sus 52 estanques, su museo y su auditorio.                                
                                    
                                    </p>

                                    <p style="color:#001442; font-family:'Nunito';">
                                        <i class="fas fa-location-dot" style="margin-right: 5px;"></i>
                                        <a href="https://www.google.com/maps?q=Av.+de+los+Deportes+111,+Fracc.+Tellería,+82017,+Mazatlán,+Sinaloa" target="_blank" style="color: inherit; text-decoration: none;">
                                            Av. de los Deportes 111, Fracc. Tellería, C.P. 82017, Mazatlán, Sinaloa
                                        </a>
                                    </p>

                                    <a href="https://granacuario.com" class="btn btn-primary rounded-pill d-inline-flex flex-shrink-0 py-2 px-4">Más Información!</a>
                                
                                </div>                    

                            </div>
                        
                        </div>

                    </div>

                
                </div> 

            </div>

        </div>

        <div class="container-fluid about" style="margin-top: 20px; margin: bottom 20px; ">
            <div class="container" style="margin: bottom 20px;">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s">
                    <h1 class ="display-3 display-md-2 display-lg-1" style="font-family:'Nunito'; color: #001442">Recomendaciones para tu estancia</h1>
                    <hr style="border: none; border-top: 5px solid darkblue;">
                </div>
                <div style="margin: 0 auto;">
                    <p class="descripcion-texto-mztln" style="text-align: center;">
                        ¡Bienvenidos a Mazatlán!
                    </p>
                    <p class="descripcion-texto-mztln" style="text-align: center;">
                        Nos alegra contar con su presencia en este congreso internacional. Sabemos que para muchos esta puede ser su primera vez en la ciudad, y queremos que se sientan seguros y bienvenidos.
                    </p>
                    <p class="descripcion-texto-mztln" style="text-align: center;">
                        Mazatlán es una ciudad vibrante y hospitalaria, con una larga tradición turística. Como en cualquier destino, recomendamos mantenerse en zonas conocidas, moverse en grupo siempre que sea posible y tomar precauciones básicas de seguridad.
                    </p>
                    <p class="descripcion-texto-mztln" style="text-align: center;">
                        La mayoría de nuestros asistentes habla al menos un segundo idioma, lo que facilita la comunicación y el apoyo mutuo durante el evento. Además, nuestro equipo de logística estará disponible en todo momento para brindar asistencia si la necesitan.
                        Esperamos que disfruten tanto del programa académico como de la calidez de esta ciudad frente al mar.
                    </p>
                    <p class="descripcion-texto-mztln" style="text-align: center;">
                        ¡Gracias por ser parte de esta experiencia!
                    </p>
                    
                </div>    
            </div>
            <br>
        </div>

        

        
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
        <!-- Lightbox JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

        
        <?php include 'footer.php'; ?>
    </body>
</html>
