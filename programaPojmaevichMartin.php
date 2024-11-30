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
Legajo FAI-
Carrera: TDW
Mail:
github: github.com/
*/


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Obtiene una colección de palabras
 * @return array
 */
function cargarColeccionPalabras(): array
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
 * Retorna un array de partidas de ejemplo
 * @return array
 */
function cargarPartidas(): array
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
function seleccionarOpcion():int
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
function solicitarPalabra():string
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
 * Recibe un array, una palabra y retorna el array con la palabra incluida.
 * @param array $colPalabras Coleccion de palabras de 5 letras.
 * @param string $palabra Palabra que se agregara a la coleccion.
 * @return array
 */
function agregarPalabra(array $colPalabras, string $palabra):array
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
function indicePrimerVictoria(array $colPartidas, string $jugador): int
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
    }while(!$encontrado && $indice < $cantPartidas-1);

    return $indiceVictoria;
}
/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:


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
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 3:
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;

        //...
    }
} while ($opcion != 8);

