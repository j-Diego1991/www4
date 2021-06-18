<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Final</title>
    <link rel="stylesheet" href="./css/chartist.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <script src="./js/chartist.min.js"></script>
</head>

<body>
    <div class="container">
        <header class="encabezado">
            <h1>Número de televisores que hay en cada vivienda</h1>
            <span class="subt">Muestra de 25 000 hogares</span>
        </header>

        <?php
        require_once('./procesarDatos.php');

        $archivo = './datosCrudos.txt';

        $arrFrec = crear_frecuencias($archivo);

        $nuevoJSON = crear_json('./json/histograma.json', $arrFrec);

        $listaLabels = array();
        $listaFrecuencias = array();

        foreach ($arrFrec as $nombre => $valor){
            $listaLabels[] = $nombre;
            $listaFrecuencias[] = $valor;
        }
        ?>
        <!-----Área de la tabla----->
        <div class="table-responsive">
            <table class="table table-hover marco_histo">
                <thead class="thead-dark">
                    <tr>
                        <th>Familias con 0 pantallas</th>
                        <th>Familias con 1 pantalla</th>
                        <th>Familias con 2 pantallas</th>
                        <th>Familias con 3 pantallas</th>
                        <th>Familias con 4 pantallas</th>
                        <th>Familias con 5 pantallas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $listaFrecuencias[0]; ?></td>
                        <td><?php echo $listaFrecuencias[1]; ?></td>
                        <td><?php echo $listaFrecuencias[2]; ?></td>
                        <td><?php echo $listaFrecuencias[3]; ?></td>
                        <td><?php echo $listaFrecuencias[4]; ?></td>
                        <td><?php echo $listaFrecuencias[5]; ?></td>
                    </tr>
                </tbody>
                <caption class="marco_histo">Histograma</caption>
            </table>
        </div>

        <!-----Área de la grafica de barras----->
        <div class="ct-chart ct-octave" id="chart1">
        <script>


            var datos = {
                labels: [
                    '<?php echo $listaLabels[0]; ?> pantalla',
                    '<?php echo $listaLabels[1]; ?> pantalla',
                    '<?php echo $listaLabels[2]; ?> pantallas',
                    '<?php echo $listaLabels[3]; ?> pantallas',
                    '<?php echo $listaLabels[4]; ?> pantallas',
                    '<?php echo $listaLabels[5]; ?> pantallas'
                ],
                series: [
                    <?php echo $listaFrecuencias[0]; ?>,
                    <?php echo $listaFrecuencias[1]; ?>,
                    <?php echo $listaFrecuencias[2]; ?>,
                    <?php echo $listaFrecuencias[3]; ?>,
                    <?php echo $listaFrecuencias[4]; ?>,
                    <?php echo $listaFrecuencias[5]; ?>
                ]
            };
            var opciones = {
                fullWidth: true,
                distributeSeries: true,

                seriesBarDistance: 30,
                showLine: false,
                showPoint: false,
                chartPadding: {
                    right: 35,
                    left: 10,
                    bottom: 20
                },
                axisX: {
                    position: 'end',
                },
                axisY: {
                    type: Chartist.FixedScaleAxis,
                    ticks: [0, 500, 1000, 2000, 3000, 4000, 5000, 6000, 8000, 12000],
                    high: 12000
                }
            };

            var opcionesResponsive = [
                ['Screen and (min-width: 641px) and (max-width: 1024px)', {
                    axisX: {
                        labelInterpolationFnc: function(value){
                            return value;
                        }
                    }
                }],
                ['screen and (max-width: 640px)', {
                    seriesBarDistance: 5,
                    axisX: {
                        labelInterpolationFnc: function(value){
                            return value[0];
                        }
                    }
                }]
            ];
        new Chartist.Bar('#chart1', datos, opciones, opcionesResponsive);
        </script>
        </div>

        <div class="ct-chart ct-perfect-fourth" style="padding:30px,bottom" id="chart2">
        <script>
            var datos = {
                labels: [
                    '<?php echo $listaLabels[0]; ?> pantalla',
                    '<?php echo $listaLabels[1]; ?> pantalla',
                    '<?php echo $listaLabels[2]; ?> pantallas',
                    '<?php echo $listaLabels[3]; ?> pantallas',
                    '<?php echo $listaLabels[4]; ?> pantallas',
                    '<?php echo $listaLabels[5]; ?> pantallas'
                ],
                series: [{
                    name: 'serie-1',
                    data: [
                        <?php echo $listaFrecuencias[0]; ?>,
                        <?php echo $listaFrecuencias[1]; ?>,
                        <?php echo $listaFrecuencias[2]; ?>,
                        <?php echo $listaFrecuencias[3]; ?>,
                        <?php echo $listaFrecuencias[4]; ?>,
                        <?php echo $listaFrecuencias[5]; ?>,
                    ]                    
                }]
            };
            var opciones= {
                fullWidth: true,
                showArea: false,
                showLine: true,
                showPoint: true,
                chartPadding: {
                    bottom: 50,
                    right: 35,
                    left: 10
                },
                axisX: {
                    position: 'end',
                },
                axisY: {
                    type: Chartist.FixedScaleAxis,
                    ticks: [500, 1000, 2000, 3000, 4000, 5000, 6000, 8000, 12000],
                    high: 12000
                },
                series: {
                    'series-1': {
                        lineSmooth: Chartist.Interpolation.monotoneCubic()
                    }
                }
            };
            var opcionesResponsive= [
                ['screen and (max-width: 640px)',
                    {
                        series: {
                            'serie-1':{
                                lineSmooth: Chartist.Interpolation.none()
                            }
                        }
                    }
                ]
            ];
            new Chartist.Line('#chart2', datos, opciones, opcionesResponsive);
        </script>
        </div>

        <div class="ct-chart ct-perfect-fourth" style="padding:30px,botton" id="chart3">
        <script>
        var datos = {
                series: [
                    <?php echo $listaFrecuencias[0]; ?>,
                    <?php echo $listaFrecuencias[1]; ?>,
                    <?php echo $listaFrecuencias[2]; ?>,
                    <?php echo $listaFrecuencias[3]; ?>,
                    <?php echo $listaFrecuencias[4]; ?>,
                    <?php echo $listaFrecuencias[5]; ?>
                ]
        };
        
        var suma = function(a, b){
            return a + b;
        };
        
        var opciones = {
            labelInterpolationFnc: function(value){
                return Math.round(value / datos.series.reduce(suma) * 100) + '%';
            }
        };

        var opcionesResponsive = [
            ['screen and (min-width: 640px)', {
                chartPadding: 30,
                labelOffset: 100,
                labelDirection: 'explode',
                labelInterpolationFnc: function(value) {
                    return Math.round(value / datos.series.reduce(suma) * 100) + '%';
                }
            }],
            ['screen and (min-width: 1024px)', {
                labelOffest: 80,
                chartPadding: 20
            }]
        ];
        new Chartist.Pie('#chart3', datos, opciones, opcionesResponsive);
        </script>
        </div>

    <footer>
        <p>
            Existe una gran parte de la población que contiene dos o tres pantallas.
            Son pocos los casos los cuales que tienen una o ninguna pantalla.
            De la misma forma, no hay muchas familias que tienen cuatro o hasta cinco.
        </p>
    </footer>    
    </div>
    
    
        
</body>