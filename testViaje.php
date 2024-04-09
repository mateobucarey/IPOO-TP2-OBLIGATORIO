<?php

include_once ('Pasajero.php');
include_once('Viaje.php');
include_once('ResponsableV.php');

while (true) {
    
    //Menu de opciones
    echo "\n 1. Cargar nuevo viaje \n";
    echo "2. Modificar un viaje \n";
    echo "3. Mostrar un viaje \n";
    echo "4. Salir \n";
    echo "Seleccione una opcion: \n";
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case 1:

            /**
             * Esta funcion valida si se desea agregar mas pasajeros o no, retorna un valor booleano
             * @return boolean
             */
            function validar(){
                $repetir = true;
                while($repetir) {
                    echo "¿Desea agregar mas pasajeros? \n SI/NO \n";
                    $respuesta = trim(fgets(STDIN));
                    if (strtoupper($respuesta) == 'SI') {
                        $agregar = true;
                        $repetir = false;
                    } elseif(strtoupper($respuesta) == 'NO'){
                        $agregar = false;
                        $repetir = false;
                    } else {
                        echo "Ingreso un valor invalido, por favor vuelva a intentarlo \n";
                    }
                }
                return $agregar;
            }
            //Se ingresan los datos del viaje y del responsable del viaje
            echo "Ingrese el codigo del viaje: \n";
            $codViaje = trim(fgets(STDIN));
            echo "Ingrese el destino: \n";
            $destino = trim(fgets(STDIN));
            echo "Ingrese la cantidad maxima de pasajeros: \n";
            $cantMaxPasajeros = trim(fgets(STDIN));

            //Datos del responsable del viaje
            echo "Ingrese los datos del responsable del viaje: \n";
            echo "Numero de empleado: \n";
            $nroEmpleado = trim(fgets(STDIN));
            echo "Numero de licencia: \n";
            $nroLicencia = trim(fgets(STDIN));
            echo "Nombre: \n";
            $nombreRes = trim(fgets(STDIN));
            echo "Apellido: \n";
            $apellidoRes = trim(fgets(STDIN));
            $objResponsable = new ResponsableV($nroEmpleado, $nroLicencia, $nombreRes, $apellidoRes);

            echo "Ingrese los pasajeros de este viaje: \n";

            //Inicializacion de variables
            $i = 0;
            $ingresar = true;
            $coleccionPasajeros = [];

            //En caso de que la cantidad de pasajeros maximos sea igual a cero
            if ($cantMaxPasajeros == 0) {
                echo "No se pueden ingresar mas pasajeros, espacio agotado \n";
                $ingresar = false;
            }

            //Se crea un arreglo de pasajeros
            while ($i < $cantMaxPasajeros && $ingresar) {
                echo "Ingrese el nombre: \n";
                $nombre = trim(fgets(STDIN));
                echo "Ingrese el apellido: \n";
                $apellido = trim(fgets(STDIN));
                echo "Ingrese el numero de documento: \n";
                $nroDoc = trim(fgets(STDIN));
                echo "Ingrese el numero de telefono: \n";
                $nroTelefono = trim(fgets(STDIN));
                $objPasajero = new Pasajero($nombre, $apellido, $nroDoc, $nroTelefono);
                array_push($coleccionPasajeros, $objPasajero);
                $ingresar = validar();
                $i++;
                if ($i > $cantMaxPasajeros) {
                    echo "No se pueden ingresar mas pasajeros, espacio agotado \n";
                }
            }
            
            //Se crea un viaje
            $viaje = new Viaje($codViaje, $destino, $cantMaxPasajeros, $coleccionPasajeros, $objResponsable);
            
            break;
            
        case 2:
            echo "1. Destino \n";
            echo "2. Cantidad maxima de pasajeros \n";
            echo "3. Pasajeros \n";
            echo "4. Responsable del viaje \n";
            echo "5. Salir \n";
            $opcionModificacion = trim(fgets(STDIN));
            switch ($opcionModificacion) {
                case 1:
                    echo "Ingrese un nuevo destino: \n";
                    $nuevoDestino = trim(fgets(STDIN));
                    $viaje->setDestino($nuevoDestino);
                    break;
                case 2:
                    echo "Ingrese una nueva cantidad maxima de pasajeros: \n";
                    $nuevaCantMaxPasajeros = trim(fgets(STDIN));
                    $viaje->setCantMaxPasajeros($nuevaCantMaxPasajeros);
                    break;
                case 3:

                    $i = count($viaje->getPasajeros());
                    while ($i < $viaje->getCantMaxPasajeros() && $ingresar) {
                        
                        echo "Ingrese los datos del nuevo pasajero del viaje: \n";
                        echo "Ingrese el nombre: \n";
                        $nuevoNombre = trim(fgets(STDIN));
                        echo "Ingrese el apellido: \n";
                        $nuevoApellido = trim(fgets(STDIN));
                        echo "Ingrese el numero de documento: \n";
                        $nuevoNroDoc = trim(fgets(STDIN));
                        echo "Ingrese el numero de telefono: \n";
                        $nuevoNroTelefono = trim(fgets(STDIN));
                        $objPasajero = new Pasajero($nuevoNombre, $nuevoApellido, $nuevoNroDoc, $nuevoNroTelefono);
                        array_push($coleccionPasajeros, $objPasajero);
                        $ingresar = validar();
                        $i++;
                        if ($i > $cantMaxPasajeros) {
                            echo "No se pueden ingresar mas pasajeros, espacio agotado \n";
                        }
                    }
                    break;
                case 4:
                    echo "Ingrese el numero del pasajero que desea modificar: \n";
                    $numeroPasajero = trim(fgets(STDIN));

                    $modificarPasajero = $viaje->getPasajeros()[$numeroPasajero];
                    echo "Modificar nombre: \n";
                    $modificarNombre = trim(fgets(STDIN));
                    $modificarPasajero->setNombre($modificarNombre);
                    echo "Modificar apellido: \n";
                    $modificarApellido = trim(fgets(STDIN));
                    $modificarPasajero->setApellido($modificarApellido);                    
                   echo "Modificar numero de telefono: \n";
                    $modificarNroTelefono = trim(fgets(STDIN));
                    $modificarPasajero->setTelefono($modificarNroTelefono);                

                    break;
                case 5:
                    echo "Modificar los datos del nuevo responsable del viaje: \n";
                    echo "Ingrese el nombre: \n";
                    $nuevoNombreRes = trim(fgets(STDIN));
                    $viaje->getObjResponsable()->setNombre($nuevoNombreRes);
                    echo "Ingrese el apellido: \n";
                    $nuevoApellidoRes = trim(fgets(STDIN));
                    $viaje->getObjResponsable()->setApellido($nuevoApellidoRes);
                    echo "Ingrese el numero de empleado: \n";
                    $nuevoNroEmpRes = trim(fgets(STDIN));
                    $viaje->getObjResponsable()->setNroEmpleado($nuevoNroEmpRes);
                    echo "Ingrese el numero de licencia: \n";
                    $nuevoNroLicRes = trim(fgets(STDIN));
                    $viaje->getObjResponsable()->setNroLicencia($nuevoNroLicRes);
                    break;
                case 6:
                    echo "Saliendo del menu de modificaciones";
                    exit();
                    break;
                default:
                    echo "¡Invalido!";
                    break;
            }
            break;
        case 3:
            echo $viaje;
            break;
        case 4:
            echo "Saliendo del programa";
            exit();
            break;
        default:
            echo "¡Valor invalido! Intentelo de nuevo";
            break;
    }
}