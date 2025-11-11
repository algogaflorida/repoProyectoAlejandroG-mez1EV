<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    </link>
</head>
<body>
    
<?php
// ===============================
//  PROYECTO: LAS CABRAS DE SATURNO
// ===============================
//
// Contexto: La colonia Capra Majoris, en los anillos de Saturno,
// ha sido impactada por bolas de queso ardiente procedentes del
// cinturón de Meteorquesos. Este programa ayudará a los técnicos
// a analizar los daños y calcular las pérdidas (y ganancias).
//
// Simbología del mapa ($capraMajoris):
// "0" -> terreno rocoso
// "~" -> atmósfera de metano
// "C" -> zona habitada (corrales de cabras)
//
// Los impactos se almacenan en el array $impacts
// como coordenadas [fila, columna].
//
// =========================================
// MAPA ORIGINAL DE CAPRA MAJORIS
// =========================================

$capraMajoris = [
    ['~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~'],
    ['~', '~', '~', '~', '~', '0', '0', 'C', '0', 'C', '0', '0', 'C', '0', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~'],
    ['~', '~', '~', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~'],
    ['~', '~', '~', '0', '0', '0', '0', '0', '0', 'C', '0', '0', '0', '0', 'C', '0', '~', '~', '~', '~', '~', '~', '~', '~'],
    ['~', '~', '~', '~', '~', '0', '0', '0', '0', '0', 'C', 'C', '0', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~'],
    ['~', '~', '~', '~', '~', '~', '0', '0', '0', '0', '0', 'C', '0', '0', 'C', 'C', 'C', '0', '~', '~', '~', '~', '~', '~'],
    ['~', '~', '0', '0', '0', 'C', '0', 'C', 'C', '0', '0', '0', '0', '0', '0', '0', 'C', '0', '0', '0', 'C', '0', '0', '~'],
    ['~', '~', '~', '~', '~', '~', '0', '0', 'C', '0', '0', '0', 'C', '0', '0', '0', '0', '0', '0', 'C', '0', '0', '0', '~'],
    ['~', '~', '~', '~', '~', '~', '~', '~', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '~'],
    ['~', '~', '~', '~', '~', '0', '0', 'C', '0', '0', '0', '0', '0', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~'],
    ['~', '~', '~', '~', '~', '0', '0', '0', '0', '0', 'C', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '~', '~', '~'],
    ['~', '~', '~', '0', '0', '0', '0', '0', '0', '0', 'C', '0', '0', '0', '0', '0', '0', '0', '0', '~', '~', '~', '~', '~'],
    ['~', '0', '0', '0', '0', '0', '0', '0', '0', 'C', '0', '0', '0', 'C', '0', '0', '0', '0', '0', 'C', '0', '~', '~', '~'],
    ['~', '~', '~', '~', '~', '~', '~', '~', '~', '0', '0', '0', '0', 'C', '0', '0', '~', '~', '~', '~', '~', '~', '~', '~'],
    ['~', '~', '~', '~', '~', '~', '~', '~', '~', '0', '0', '0', 'C', 'C', 'C', '0', '0', 'C', '0', '0', '0', '~', '~', '~'],
    ['~', '~', '~', '~', '0', 'C', 'C', '0', '0', 'C', '0', '0', '0', 'C', '0', '0', '0', '0', '~', '~', '~', '~', '~', '~'],
    ['~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '0', 'C', '0', '0', '0', '~', '~', '~', '~', '~', '~', '~', '~'],
    ['~', '~', '~', '~', '~', '~', '~', '~', '0', '0', '0', 'C', '0', '0', '0', '0', '0', 'C', '0', 'C', '0', '0', '0', '~'],
    ['~', '~', '~', '0', 'C', '0', '0', '0', '0', '0', '0', '0', '0', 'C', '0', '0', '0', '~', '~', '~', '~', '~', '~', '~'],
    ['~', '~', '~', '~', '~', '~', '~', '~', '~', '0', '0', '0', 'C', '0', '0', 'C', '0', '~', '~', '~', '~', '~', '~', '~'],
    ['~', '~', '~', '~', '0', '0', '0', '0', 'C', '0', '0', '0', '0', 'C', '0', '~', '~', '~', '~', '~', '~', '~', '~', '~'],
    ['~', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 'C', '0', '0', '0', '0', '0', '0', '~', '~', '~', '~', '~', '~'],
    ['~', '~', '~', '~', '~', '0', '0', '0', '0', '0', 'C', '0', '0', '0', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~'],
    ['~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~', '~']
];

// Coordenadas [fila, columna] de los impactos de queso
$impacts = [
    [20, 4],
    [2, 13],
    [13, 12],
    [3, 17],
    [2, 13],
    [5, 19],
    [6, 18],
    [5, 2],
    [20, 13],
    [9, 7],
    [5, 9],
    [15, 16],
    [16, 13],
    [16, 9],
    [16, 0],
    [3, 19],
    [19, 8],
    [1, 16],
    [18, 4],
    [21, 23],
    [7, 17],
    [22, 15],
    [21, 6],
    [14, 8],
    [12, 23],
    [7, 7],
    [22, 4],
    [3, 21],
    [2, 3],
    [8, 11],
    [0, 4],
    [7, 21],
    [11, 4],
    [7, 15],
    [6, 17],
    [5, 19],
    [4, 19],
    [4, 7],
    [23, 21],
    [15, 20],
    [2, 9],
    [21, 2],
    [1, 13],
    [7, 10],
    [21, 5],
    [13, 17],
    [2, 14],
    [11, 14],
    [22, 17],
    [18, 22],
    [2, 23],
    [3, 1],
    [18, 6],
    [17, 12],
    [18, 18],
    [20, 2],
    [3, 14],
    [11, 21],
    [6, 5],
    [6, 2],
    [12, 23],
    [18, 18],
    [21, 6],
    [10, 12],
    [5, 4],
    [16, 19],
    [8, 10],
    [12, 21],
    [15, 1],
    [20, 14],
    [3, 20],
    [6, 19],
    [20, 13],
    [15, 4],
    [10, 2],
    [5, 16],
    [20, 1],
    [12, 13],
    [11, 5],
    [12, 14],
    [8, 3],
    [6, 8],
    [19, 7],
    [16, 9],
    [13, 20],
    [3, 5],
    [1, 0],
    [20, 14],
    [12, 21],
    [12, 16],
    [15, 7],
    [9, 1],
    [1, 18],
    [20, 6],
    [8, 6],
    [22, 1],
    [10, 22],
    [19, 19],
    [7, 16],
    [8, 8]
];


// =========================================
// ESCRIBE AQUÍ LA DEFINICIÓN DE LAS FUNCIONES
// =========================================

// Ejercicio 1
function mapaOriginal($mapa){
    foreach ($mapa as $linea){
        foreach ($linea as $campo){
            echo $campo;
        }
        echo "<br>";
    }
}

// Ejercicio 2
function zonasAfectadas($mapa, $impactos){

    foreach ($impactos as $coordenada){
        $fila=$coordenada[0];
        $columna=$coordenada[1];
        if ($mapa[$fila][$columna] == "C"){
            $mapa[$fila][$columna] = "Q";
        }
    }

    return $mapa;
}

// Ejercicio 3
function desodoranteEspacial($mapa) {
    $cabrasPorZona = 3000;
    $mlPorCabra = 10;
    $zonasNecesitadasDesodorante = 0;

    foreach ($mapa as $linea){
        foreach ($linea as $campo){
            if ($campo == "Q"){
                $zonasNecesitadasDesodorante++;
            }
        }
    }

    $arrayDatos = [];

    $totalDesodorante = $cabrasPorZona*$zonasNecesitadasDesodorante;
    $arrayDatos[0] = $totalDesodorante;

    $mlTotalesNecesarios = ($totalDesodorante*$mlPorCabra)/1000;
    $arrayDatos[1] = $mlTotalesNecesarios;

    return $arrayDatos;
}

// Ejercicio 4
function DañosTotales($mapa, $impactos){

    foreach ($impactos as $coordenada){
        $fila=$coordenada[0];
        $columna=$coordenada[1];
        if ($mapa[$fila][$columna] == "0"){
            $mapa[$fila][$columna] = "X";
        } elseif ($mapa[$fila][$columna] == "~"){
            $mapa[$fila][$columna] = "S";
        }
    }

    return $mapa;
}

// Ejercicio 5
function estimacionCostes($mapa){
    $terrenoRocoso = 0;
    $zonaHabitada = 0;
    $precioTerrenoRocoso = 75000;
    $precioZonaHabitada = 250000;

    foreach ($mapa as $fila){
        foreach ($fila as $columna){
            if ($columna == "X"){
                $terrenoRocoso++;
            } elseif ($columna == "Q"){
                $zonaHabitada++;
            }
        }
    }

    $totalPrecioTerrenoRocoso = $terrenoRocoso * $precioTerrenoRocoso;
    $totalPrecioZonaHabitada = $zonaHabitada * $precioZonaHabitada;
    $totalTerrenoZona=$totalPrecioTerrenoRocoso+$totalPrecioZonaHabitada;
    return $totalTerrenoZona;
}

// Ejercicio 6 
function atmosferaPresente($mapa){
    $atmosferaActual = 0;

    for ($i=0;$i<count($mapa);$i++){
        for ($j=0;$j<count($mapa[$i]);$j++){
            if ($mapa[$i][$j] == "~" || $mapa[$i][$j] == "S"){
                $atmosferaActual++;
            }
        }
    }

    return $atmosferaActual;
}

function atmosferaAfectada($mapa){
    $atmosferaAfectada = 0;

    for ($i=0;$i<count($mapa);$i++){
        for ($j=0;$j<count($mapa[$i]);$j++){
            if ($mapa[$i][$j] == "S"){
                $atmosferaAfectada++;
            }
        }
    }

    return $atmosferaAfectada;
}

// Ejercicio 7 (y final)
function recaudacionSolidaria($mapa){
    $precioKg = 7;
    $toneladasTotales = 1000;
    $kgPorTonelada = 1000;
    
    $atmTotal = atmosferaPresente($mapa);
    $atmAfectada = atmosferaAfectada($mapa);
    
    $toneladasAprovechables = ($atmAfectada / $atmTotal) * $toneladasTotales;
    $kgAprovechables = $toneladasAprovechables * $kgPorTonelada;

    $recaudacion = $kgAprovechables * $precioKg;
    return $recaudacion;
}

// Para el CSS y atractivo del ejercicio 
function renderizarMapa($mapa){
    $tabla='<table class=mapeado>';
        foreach ($mapa as $casilla){
            $tabla .= "<tr>";
            foreach($casilla as $simbolo){
                switch ($simbolo){
                    case "~":
                        $tipo='atmosfera';
                        break;
                    case "S":
                        $tipo='atmosferacontaminada';
                        break;
                    case "C":
                        $tipo='campo';
                        break;
                    case "Q":
                        $tipo='quesificado';
                        break;
                    case "0";
                        $tipo='rocoso';
                        break;
                    case "X";
                        $tipo='rocosoafectado';
                        break;
                    default:
                        break;
                    
                    }
            $tabla .= "<td class='$tipo'></td>";
                }
            $tabla .= '</tr>';
            }
        $tabla .= '</table>';
        
        return $tabla;
    }
// =========================================
// ESCRIBE AQUÍ TU PROGRAMA PRINCIPAL
// =========================================

echo "<h1>🌌 Mapa Original de Capri Majoris</h1>";
echo renderizarMapa($capraMajoris);

echo "<h1>💥 Zonas habitadas afectadas</h1>";
$mapaZonasAfectadas = zonasAfectadas($capraMajoris, $impacts);
echo renderizarMapa($mapaZonasAfectadas);
$mapaCabrasAfectadas = desodoranteEspacial($mapaZonasAfectadas);
echo "🐐 El total de cabras afectadas (pobrecillas macho) es: " . $mapaCabrasAfectadas[0] . " cabras <br>";
echo "🧴 El total necesario de desodorante para las cabras es: " . $mapaCabrasAfectadas[1] . " litros";

echo "<h1>🛠️ Mapa de daños totales</h1>";
$mapaDañosTotales = DañosTotales($mapaZonasAfectadas, $impacts);
echo renderizarMapa($mapaDañosTotales);

$estimacionDeCostes = estimacionCostes($mapaDañosTotales);
echo "💸 Coste total de limpieza: " . number_format($estimacionDeCostes, 0, ",", ".") . " € <br>"; 
$recaudacionTotal = recaudacionSolidaria($mapaDañosTotales);
echo "🪐🧑‍🍳 Recaudación ONG Cocineros cósmicos: " . number_format($recaudacionTotal, 0, ",", ".") . " € <br>";
$diferencia = $estimacionDeCostes-$recaudacionTotal;
echo "🧾 Daños netos estimados: " . number_format($diferencia, 0, ",", ".") . " € <br>";

?>



</body>
</html>