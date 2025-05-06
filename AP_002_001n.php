<?php

$PageSecurity = 15; 
$App = 'Revisores'; 
$Mod = 'Revisores'; 
include('includes/session.inc'); 
$title = 'Control Resúmenes'; 
include('includes/header.inc'); 

echo '<form method="post" enctype="multipart/form-data" action="AP_002_001n.php?ID='.$_GET['ID'].'&A='.$_GET['A'].'">';
echo '<input type="hidden" name="FormID" value="'.$_SESSION['FormID'].'" />';

$Msg   = ''; 
$vSaleM = 'IN'; 
$MsgC = 'green';
$SelID = $_GET['ID'];

//generos
    $sql = "SELECT g.Nombre, COALESCE(COUNT(p.ID_trabajo), 0) AS total
            FROM GENEROS g
            LEFT JOIN trabajos_main p ON g.CVE= p.genero
            GROUP BY g.Nombre";
    $resultado = DB_query($sql, $db);

    $generos = array();
    // Recorre los resultados y almacena en el array
    while ($row = DB_fetch_array($resultado)) {
        $generos[] = array(
            'nombre' => $row['Nombre'],
            'total' => $row['total']
        );
    }

    $generos_json = json_encode($generos);

//ocupaciones
    $sql_ocupacion = "SELECT o.Nombre, COALESCE(COUNT(p.ID_trabajo), 0) AS total
            FROM ocupaciones o
            LEFT JOIN trabajos_main p ON o.CVE= p.ocupacion
            GROUP BY o.Nombre";
    $res_ocupacion = DB_query($sql_ocupacion, $db);

    $ocupacion = array();
    // Recorre los resultados y almacena en el array
    while ($row = DB_fetch_array($res_ocupacion)) {
        $ocupacion[] = array(
            'ocupacion' => $row['Nombre'],
            'total' => $row['total']
        );
    }

    $ocupaciones_json = json_encode($ocupacion);

//modalidades
    $sql_modalidades = "SELECT o.Nombre, COALESCE(COUNT(p.ID_trabajo), 0) AS total
                        FROM modalidades_presentacion o
                        LEFT JOIN trabajos_main p ON o.CVE= p.modalidad_trabajo
                        GROUP BY o.Nombre";
    $res_modalidades = DB_query($sql_modalidades, $db);
    $modalidades = array();
    // Recorre los resultados y almacena en el array
    while ($row = DB_fetch_array($res_modalidades)) {
        $modalidades[] = array(
            'modalidades' => $row['Nombre'],
            'total' => $row['total']
        );
    }
    $modalidades_json = json_encode($modalidades);

//Nacionalidades
    $sql_pais = "SELECT o.Nombre, COALESCE(COUNT(p.ID_trabajo), 0) AS total
                FROM paises o
                LEFT JOIN trabajos_main p ON o.iso = p.nacionalidad
                GROUP BY o.Nombre
                ORDER BY total DESC
                LIMIT 5";
    $res_pais = DB_query($sql_pais, $db);
    $paises = array();
    // Recorre los resultados y almacena en el array
    while ($row = DB_fetch_array($res_pais)) {
        $paises[] = array(
        'pais' => $row['Nombre'],
        'total' => $row['total']
        );
    }
    $paises_json = json_encode($paises);

//Instituciones
    $sql_inst = "SELECT p.institucion, COALESCE(COUNT(p.ID_trabajo), 0) AS total
                FROM trabajos_main p
                GROUP BY p.institucion
                ORDER BY total DESC
                LIMIT 5";
    $res_inst = DB_query($sql_inst, $db);
    $instituciones = array();
    // Recorre los resultados y almacena en el array
    while ($row = DB_fetch_array($res_inst)) {
        $instituciones[] = array(
        'institucion' => $row['institucion'],
        'total' => $row['total']
        );
    }
    $instituciones_json = json_encode($instituciones);

//Temas
    $sql_temas = "SELECT A.tema, COALESCE(COUNT(B.ID), 0) AS total
                    FROM Cat_temas A
                    LEFT JOIN trabajos_detalle_tema B ON B.tema = A.ID_tema
                    GROUP BY A.tema
                    ORDER BY total DESC
                    LIMIT 5";
    $res_temas = DB_query($sql_temas, $db);
    $temas = array();
    // Recorre los resultados y almacena en el array
    while ($row = DB_fetch_array($res_temas)) {
        $temas[] = array(
        'tema' => $row['tema'],
        'total' => $row['total']
        );
    }
    $temas_json = json_encode($temas);







?>

<div class="container" style="margin-top:80px">
    <div class="row d-flex align-items-stretch">
        <div class="col-md-6">
        <div class="card">
            <div class="card-body">
            <h5>Distribución de Participantes por Sexo</h5>
            <br>
            <canvas id="myChart"></canvas>
            </div>
        </div>
        </div>

        <div class="col-md-6">
        <div class="card">
            <div class="card-body">
            <h5>Ocupación de los Asistentes</h5>
            <br>
            <canvas id="myChart2"></canvas>
            </div>
        </div>
        </div>
    </div>

    <div class="row d-flex align-items-stretch">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                <h5>Total de Participantes por Modalidad</h5>
                <br>
                <canvas id="myChart3"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
        <div class="card">
            <div class="card-body">
            <h5>Países de Origen de Participantes</h5>
            <br>
            <canvas id="myChart4"></canvas>
            </div>
        </div>
        </div>
    </div>

    <div class="row d-flex align-items-stretch"> 
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                <h5>Instituciones Representadas</h5>
                <br>
                <canvas id="myChart5"></canvas> <!-- ID corregido -->
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                <h5>Distribución por Tema</h5>
                <br>
                <canvas id="myChart6"></canvas> <!-- ID corregido -->
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-12 text-center">
        <a href="AP_002_001da.php"
            class="btn mt-1"
            role="button"
            style="background-color: green; border-color: #6f42c1; color: white;">
            <i class="fas fa-file-excel me-2"></i>
            Descarga Reporte
        </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs/dist/purecounter_vanilla.js"></script>
<script src="plugins/js/new_counter.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        var generosData = <?php echo $generos_json; ?>;
        var ocupacionData = <?php echo $ocupaciones_json; ?>;
        var modalidadesData = <?php echo $modalidades_json; ?>;
        var paisesData = <?php echo $paises_json; ?>;
        var institucionesData = <?php echo $instituciones_json; ?>;
        var temasData = <?php echo $temas_json ?>

        // Prepara las etiquetas y los datos del gráfico
        var labels_gen = generosData.map(function(genero) {
            return genero.nombre; // Extrae el nombre de cada género
        });
        var data_gen = generosData.map(function(genero) {
            return genero.total; // Extrae el total de cada género
        });

        // Prepara las etiquetas y los datos del gráfico
        var labels_ocu = ocupacionData.map(function(ocupacion) {
            return ocupacion.ocupacion; // Extrae el nombre 
        });
        var data_ocu = ocupacionData.map(function(ocupacion) {
            return ocupacion.total; // Extrae el total 
        });

        // Prepara las etiquetas y los datos del gráfico
        var labels_mod = modalidadesData.map(function(modalidades) {
            return modalidades.modalidades; // Extrae el nombre 
        });
        var data_mod = modalidadesData.map(function(modalidades) {
            return Number(modalidades.total); // Convierte a número si es necesario
        });

        // Prepara las etiquetas y los datos del gráfico
        var labels_pais = paisesData.map(function(paises) {
            return paises.pais; // Extrae el nombre 
        });
        var data_pais = paisesData.map(function(paises) {
            return Number(paises.total); // Convierte a número si es necesario
        });

        // Prepara las etiquetas y los datos del gráfico
        var labels_inst = institucionesData.map(function(instituciones) {
            return instituciones.institucion; // Extrae el nombre 
        });
        var data_inst = institucionesData.map(function(instituciones) {
            return Number(instituciones.total); // Convierte a número si es necesario
        });

        // Prepara las etiquetas y los datos del gráfico
        var labels_tema = temasData.map(function(temas) {
            return temas.tema; // Extrae el nombre 
        });
        var data_tema = temasData.map(function(temas) {
            return Number(temas.total); // Convierte a número si es necesario
        });
        
        const ctx1 = document.getElementById('myChart').getContext('2d');
        const ctx2 = document.getElementById('myChart2').getContext('2d');
        const ctx3 = document.getElementById('myChart3').getContext('2d');
        const ctx4 = document.getElementById('myChart4').getContext('2d');
        const ctx5 = document.getElementById('myChart5').getContext('2d');
        const ctx6 = document.getElementById('myChart6').getContext('2d');

        // Gráfico de distribución por sexo
        new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: labels_gen,
                datasets: [{
                    data: data_gen, // Cambia estos valores por datos dinámicos
                    backgroundColor: ['rgb(28, 63, 89)', 'rgb(0, 204, 204)', 'rgb(255, 87, 34)', 'rgb(35, 75, 53)', 'rgb(255, 223, 51)',
                    'rgb(70, 130, 180)', 'rgb(255, 99, 71)', 'rgb(75, 0, 130)' ],
                    hoverOffset: 4
                }]
            }
        });
        //Ocupacion de los asistentes
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: labels_ocu,
                datasets: [{
                    data: data_ocu, // Cambia estos valores por datos dinámicos
                    backgroundColor: ['rgb(28, 63, 89)', 'rgb(0, 204, 204)', 'rgb(255, 87, 34)', 'rgb(35, 75, 53)', 'rgb(255, 223, 51)',
                    'rgb(70, 130, 180)', 'rgb(255, 99, 71)', 'rgb(75, 0, 130)' ],
                    hoverOffset: 4
                }]
            }
        });
        data_mod.push(0);
        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: labels_mod,
                datasets: [{
                    data: data_mod,
                    backgroundColor: ['rgb(28, 63, 89)', 'rgb(0, 204, 204)', 'rgb(255, 87, 34)', 'rgb(35, 75, 53)', 'rgb(255, 223, 51)',
                    'rgb(70, 130, 180)', 'rgb(255, 99, 71)', 'rgb(75, 0, 130)' ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,  // Especifica el mínimo del eje Y
                        max: Math.max(...data_mod) + 1,  // Establece un máximo basado en tus datos
                        ticks: {
                            stepSize: 1,
                            maxTicksLimit: 10
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false  // Esto quita la leyenda
                    }
                }
            }
        });

        new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: labels_pais,
                datasets: [{
                    data: data_pais,
                    backgroundColor: ['rgb(28, 63, 89)', 'rgb(0, 204, 204)', 'rgb(255, 87, 34)', 'rgb(35, 75, 53)', 'rgb(255, 223, 51)',
                    'rgb(70, 130, 180)', 'rgb(255, 99, 71)', 'rgb(75, 0, 130)' ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,  // Especifica el mínimo del eje Y
                        max: Math.max(...data_pais) + 1,  // Establece un máximo basado en tus datos
                        ticks: {
                            stepSize: 1,
                            maxTicksLimit: 10
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false  // Esto quita la leyenda
                    }
                }
            }
        });

        data_inst.push(0);
        new Chart(ctx5, {
            type: 'bar',
            data: {
                labels: labels_inst,
                datasets: [{
                    data: data_inst,
                    backgroundColor: ['rgb(28, 63, 89)', 'rgb(0, 204, 204)', 'rgb(255, 87, 34)', 'rgb(35, 75, 53)', 'rgb(255, 223, 51)',
                    'rgb(70, 130, 180)', 'rgb(255, 99, 71)', 'rgb(75, 0, 130)' ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,  // Especifica el mínimo del eje Y
                        max: Math.max(...data_inst) + 1,  // Establece un máximo basado en tus datos
                        ticks: {
                            stepSize: 1,
                            maxTicksLimit: 10
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false  // Esto quita la leyenda
                    }
                }
            }
        });
        new Chart(ctx6, {
            type: 'polarArea',
            data: {
                labels: labels_tema,
                datasets: [{
                    data: data_tema,
                    backgroundColor: ['rgb(28, 63, 89)', 'rgb(0, 204, 204)', 'rgb(255, 87, 34)', 'rgb(35, 75, 53)', 'rgb(255, 223, 51)',
                    'rgb(70, 130, 180)', 'rgb(255, 99, 71)', 'rgb(75, 0, 130)' ],
                    hoverOffset: 4
                }]
            }});
    });
</script>

<?php include('includes/footer.php'); ?>
