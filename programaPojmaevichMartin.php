<?php
include_once("wordix.php");


/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/*
Apellido: Pojmaevich
Nombre: Gaston
Legajo FAI-2856
Carrera: TDW
Mail: gaston.pojma@hotmail.com
github: github.com/Tonga98

Apellido: Martin
Nombre: Gaston
Legajo FAI- 5674
Carrera: TDW
Mail: gastonmtnez@gmail.com
github: github.com/
*/


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Retorna una colección de palabras
 * @return array
 */
function cargarColeccionPalabras()
{
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "PERROS", "PATAS", "LAGOS", "CONOS", "SAPOS",
        "LATAS", "CHICOS", "PINTOR", "LENTO", "TRAPO"
    ];

    return $coleccionPalabras;
}

/**
 * Retorna una coleccion de partidas de ejemplo
 * @return array
 */
function cargarPartidas()
{
    /* Declaracion de variables
     * array $partidasPrecargadas */

    /*Asignacion de variables y ejecucion*/
    $partidasPrecargadas = [
        ["palabraWordix" => "MUJER", "jugador" => "juan", "intentos" => 1, "puntaje" => 15],
        ["palabraWordix" => "GATOS", "jugador" => "juan", "intentos" => 6, "puntaje" => 11],
        ["palabraWordix" => "MELON", "jugador" => "juan", "intentos" => 3, "puntaje" => 12],
        ["palabraWordix" => "PERROS", "jugador" => "juan", "intentos" => 7, "puntaje" => 0],
        ["palabraWordix" => "QUESO", "jugador" => "pedro", "intentos" => 2, "puntaje" => 14],
        ["palabraWordix" => "GOTAS", "jugador" => "pedro", "intentos" => 3, "puntaje" => 14],
        ["palabraWordix" => "YUYOS", "jugador" => "pedro", "intentos" => 1, "puntaje" => 17],
        ["palabraWordix" => "PATAS", "jugador" => "pedro", "intentos" => 7, "puntaje" => 0],
        ["palabraWordix" => "FUEGO", "jugador" => "martin", "intentos" => 3, "puntaje" => 11],
        ["palabraWordix" => "HUEVO", "jugador" => "martin", "intentos" => 4, "puntaje" => 11],
        ["palabraWordix" => "PIANO", "jugador" => "martin", "intentos" => 2, "puntaje" => 10],
        ["palabraWordix" => "LAGOS", "jugador" => "martin", "intentos" => 7, "puntaje" => 0],
        ["palabraWordix" => "CASAS", "jugador" => "eugenia", "intentos" => 4, "puntaje" => 13],
        ["palabraWordix" => "TINTO", "jugador" => "eugenia", "intentos" => 5, "puntaje" => 12],
        ["palabraWordix" => "PISOS", "jugador" => "eugenia", "intentos" => 1, "puntaje" => 17],
        ["palabraWordix" => "CONOS", "jugador" => "eugenia", "intentos" => 7, "puntaje" => 0],
        ["palabraWordix" => "RASGO", "jugador" => "lucia", "intentos" => 5, "puntaje" => 12],
        ["palabraWordix" => "NAVES", "jugador" => "lucia", "intentos" => 6, "puntaje" => 11],
        ["palabraWordix" => "VERDE", "jugador" => "lucia", "intentos" => 1, "puntaje" => 16],
        ["palabraWordix" => "SAPOS", "jugador" => "lucia", "intentos" => 7, "puntaje" => 0],
    ];
    return $partidasPrecargadas;
}

/**
 * Muestra un menu por pantalla y solicita al usuario que ingrese un entero para realizar una accion
 * @return int La opcion elegida por el usuario
 */
function seleccionarOpcion()
{
    /*Declaracion de variables
     * bool $continuar
     * int $opcion
     */

    /*Asignacion de variables y ejecucion*/
    do {
        $continuar = false;
        echo "-------------------MENU-------------------- \n" .
            "1) Jugar al wordix con una palabra elegida \n" .
            "2) Jugar al wordix con una palabra aleatoria \n" .
            "3) Mostrar una partida \n" .
            "4) Mostrar la primer partida ganadora \n" .
            "5) Mostrar resumen de Jugador \n" .
            "6) Mostrar listado de partidas ordenadas por jugador y por palabra \n" .
            "7) Agregar una palabra de 5 letras a Wordix \n" .
            "8) salir \n" .
            "Seleccion: ";

        $opcion = trim(fgets(STDIN));

        if (!($opcion >= 1 && $opcion <=8)){
            echo "\e[1;37;41m Error, por favor seleccione una opcion del 1 al 8 \e[0m  \n";
            $continuar = true;
        }
    }while($continuar);

    return $opcion;
}

/**
 * Solicita al usuario que ingrese una palabra de 5 letras
 * @return string
 */
function solicitarPalabra()
{
    /*Declaracion de variables
     * string $palabra
     * bool $continuar
    */

    /*Asignacion de variables y ejecucion*/
    do {
        $continuar = false;
        echo "Por favor ingrese una palabara de 5 letras: \n";
        $palabra = strtoupper(trim(fgets(STDIN)));

        if (strlen($palabra) != 5){
            echo "\e[1;37;41m Error, la palabra debe tener 5 letras \e[0m \n";
            $continuar = true;
        }

        }while($continuar);
    return $palabra;
}

/**
 * Muestra por pantalla los datos de una partida
 * @param int $numPartida El numero de partida del cual se mostraran los datos
 * @param array $colPartidas La coleccion de todas las partidas
 */
function datosPartida($numPartida, $colPartidas)
{
    /*Declaracion de variables
    * string $intento
    */

    /*Asignacion de variables y ejecucion*/
    $intento = ($colPartidas[$numPartida]["intentos"] != 7) ? "Adivino la palabra en ".$colPartidas[$numPartida]["intentos"]." intentos" : "No adivino la palabra";

    echo "**************************************** \n".
         "Partida WORDIX ".$numPartida.": palabra ". $colPartidas[$numPartida]["palabraWordix"]."\n".
         "Jugador: ".$colPartidas[$numPartida]["jugador"]."\n".
         "Puntaje: ".$colPartidas[$numPartida]["puntaje"]."\n".
         "Intento: ".$intento."\n".
         "**************************************** \n";
}

/**
 * Recibe un array, una palabra y retorna el array con la palabra incluida.
 * @param array $colPalabras Coleccion de palabras de 5 letras.
 * @param string $palabra Palabra que se agregara a la coleccion.
 * @return array
 */
function agregarPalabra($colPalabras, $palabra)
{

    //Ejecucion
    $colPalabras[] = $palabra;
    return $colPalabras;
}

/**
 * Retorna el indice de la primer partida ganada de un jugador en una coleccion de partidas.
 * @param array $colPartidas Coleccion de partidas del juego.
 * @param string $jugador Nombre del jugador a buscar.
 * @return int Indice de la primer victoria, -1 en caso de no encontrar victoria.
 */
function indicePrimerVictoria($colPartidas, $jugador)
{
    /*Declaracion de variables
     * int $indiceVictoria, $indice, $cantPartidas
     * bool $encontrado
    */

    /*Asigancion de variables y ejecucion*/
    $cantPartidas = count($colPartidas);
    $indiceVictoria = -1;
    $encontrado = false;
    $indice = 0;

    do{
        if ($colPartidas[$indice]["jugador"] == $jugador && $colPartidas[$indice]["puntaje"] > 0){
            $indiceVictoria = $indice;
            $encontrado = true;
        }
        $indice++;
    }while(!$encontrado && $indice < $cantPartidas-1);

    return $indiceVictoria;
}

/**
 * Retorna el resumen de partidas de un jugador.
 * @param array $colPartidas Coleccion de partidas del juego.
 * @param string $jugador Nombre del jugador.
 * @return array
 */
function resumenJugador($colPartidas, $jugador)
{
    /*Declaracion de variables
     * int $cantPartidas, $puntaje, $victorias, $in1, $in2, $in3, $in4, $in5, $in6
     * float $porcentajeVictorias
     * array $resumen
     * */

    /*Asignacion de variables y ejecucion*/
    $cantPartidas = 0;
    $puntaje = 0;
    $victorias = 0;
    $in1 = 0;
    $in2 = 0;
    $in3 = 0;
    $in4 = 0;
    $in5 = 0;
    $in6 = 0;
    $resumen = [
        "jugador"=>$jugador,
        "partidas" => 0,
        "puntaje" => 0,
        "victorias" => 0,
        "intento1" => 0,
        "intento2" => 0,
        "intento3" => 0,
        "intento4" => 0,
        "intento5" => 0,
        "intento6" => 0
    ];

    foreach ($colPartidas as $partida){
        if ($partida["jugador"] == $jugador) {
            $cantPartidas++;
            if ($partida["puntaje"] > 0) {
                $puntaje += $partida["puntaje"];
                $victorias++;
                switch ($partida["intentos"]){
                    case 1:
                        $in1++;
                        break;
                    case 2:
                        $in2++;
                        break;
                    case 3:
                        $in3++;
                        break;
                    case 4:
                        $in4++;
                        break;
                    case 5:
                        $in5++;
                        break;
                    case 6:
                        $in6++;
                        break;
                }
            }
        }
    }
    $resumen = [
        "jugador"=>$jugador,
        "partidas" => $cantPartidas,
        "puntaje" => $puntaje,
        "victorias" => $victorias,
        "intento1" => $in1,
        "intento2" => $in2,
        "intento3" => $in3,
        "intento4" => $in4,
        "intento5" => $in5,
        "intento6" => $in6
    ];
    return $resumen;
}

function sumarPartida($resumen, $partida)
{
    return array_push($resumen, $partida);
}

/**
 * Solicita al usuario un nombre y lo retorna en minuscula
 * @return string
 */
function solicitarJugador()
{
    /*Declaracion de variables
    * string $jugador
    */

    /*Asignacion de variables y ejecucion*/
    do {
        echo "Ingrese el nombre del jugador: ";
        $jugador = strtolower(trim(fgets(STDIN)));
    }while(!(is_string(substr($jugador,0,1))));

    return $jugador;
}

/**
 * Muestra por pantalla la coleccion de partidas ordenadas por el nombre del jugador y la palabra de la partida.
 * @param array $colPartidas
 * @return void
 */

function coleccionPartidas($colPartidas)
{
    /*Asignacion de variables y ejecucion*/
    uasort($colPartidas, "ordenarPartidas");

    echo "************PARTIDAS************\n";
    foreach ($colPartidas as $partida){
        print_r($partida);
    }

}

/**
 * Compara dos partidas lexicograficamente en base al nombre del jugador y palabra jugada, retorna el resultado de la comparacion.
 * @param array $a Primer partida a comparar.
 * @param array $b Segunda partida a comparar.
 * @return int Retorna -1 si la primer partida es menor, 0 si son iguales y 1 si la primer partida es mayor.
 */
function ordenarPartidas($a,$b)
{
    $jugadorComparar = strcmp($a["jugador"],$b["jugador"]);

    if ($jugadorComparar == 0){
        $jugadorComparar = strcmp($a["palabraWordix"],$b["palabraWordix"]);
    }

    return $jugadorComparar;
}

function datosJugador($datosJugador)
{
    echo "Nombre: ".$datosJugador["jugador"]."\n";
    echo "Partidas: ".$datosJugador["partidas"]."\n";
    echo "Puntaje: ".$datosJugador["puntaje"]."\n";
    echo "Victorias: ".$datosJugador["victorias"]."\n";
    echo "Intento 1: ".$datosJugador["intento1"]."\n";
    echo "Intento 2: ".$datosJugador["intento2"]."\n";
    echo "Intento 3: ".$datosJugador["intento3"]."\n";
    echo "Intento 4: ".$datosJugador["intento4"]."\n";
    echo "Intento 5: ".$datosJugador["intento5"]."\n";
    echo "Intento 6: ".$datosJugador["intento6"]."\n";
}

/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

/* Declaración de variables
 * array $partidasPrecargadas, $palabrasPrecargadas
 */

/*Asignación de variables y ejecucion*/
$partidasPrecargadas = cargarPartidas();
$palabrasPrecargadas = cargarColeccionPalabras();

//Proceso:

//$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);


do {
    $opcion = seleccionarOpcion();

    switch ($opcion) {
        case 1:
            jugarWordix("MELON", "Tonga");

            break;
        case 2:
            $palabraAleatoria = $palabrasPrecargadas[rand(0, count($palabrasPrecargadas)-1)];
            jugarWordix($palabraAleatoria, "Tonga");
            break;
        case 3:
            echo "Ingrese un numero de partida: ";
            $numeroPartida = trim(fgets(STDIN));
            datosPartida($numeroPartida, $partidasPrecargadas);
            break;
        case 4:
            $jugador = solicitarJugador();
            $indice = indicePrimerVictoria($partidasPrecargadas, $jugador);
            datosPartida($indice, $partidasPrecargadas);
            break;
        case 5:
            $jugador = solicitarJugador();
            $resumen = resumenJugador($partidasPrecargadas, $jugador);
            datosJugador($resumen);
            break;
        case 6:
            coleccionPartidas($partidasPrecargadas);
            break;
        case 7:
            $palabraNueva = solicitarPalabra();
            $palabrasPrecargadas = agregarPalabra($palabrasPrecargadas, $palabraNueva);
            print_r($palabrasPrecargadas);
    }
} while ($opcion != 8);

