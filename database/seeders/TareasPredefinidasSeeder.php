<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TareasPredefinidasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       
    /*     17 | INVERNADA                                       | NULL        | Pendiente | 2025-01-05 23:47:12 | 2025-01-05 23:47:12 |
        | 18 | SERVICIO DE POLINIZACIÓN                        | NULL        | Pendiente | 2025-01-05 23:50:02 | 2025-01-05 23:50:02 |
        | 19 | APIARIO PARA MIEL - DESARROLLO CÁMARA DE CRÍA   | NULL        | Pendiente | 2025-01-05 23:51:59 | 2025-01-05 23:51:59 |
        | 20 | MANTENCIÓN DE COLMENAS                          | NULL        | Pendiente | 2025-01-05 23:57:09 |*/
        $tareas = [
            //T 17 | INVERNADA 
            ["tarea_general_id" => 17, "nombre" => "Fundir cera"],
            ["tarea_general_id" => 17, "nombre" => "Verificar disponibilidad de cera estampada en bodega"],
            ["tarea_general_id" => 17, "nombre" => "Comprar cera estampada"],
            ["tarea_general_id" => 17, "nombre" => "Verificar disponibilidad de alimento en bodega"],
            ["tarea_general_id" => 17, "nombre" => "Comprar alimento"],
            ["tarea_general_id" => 17, "nombre" => "Verificar disponibilidad de medicamentos en bodega (para varroa)"],
            ["tarea_general_id" => 17, "nombre" => "Comprar medicamentos (para varroa)"],
            ["tarea_general_id" => 17, "nombre" => "Inspección de Invierno: verificar familias muertas o huérfanas y revisar techos "],
            ["tarea_general_id" => 17, "nombre" => "Verificar reservas de néctar y polen, y aplicar suplemento (pasta de polen) "],
            ["tarea_general_id" => 17, "nombre" => "Revisar nivel de humedad y ventilación de las colmenas "],
            ["tarea_general_id" => 17, "nombre" => "Reducir piqueras "],
            ["tarea_general_id" => 17, "nombre" => "Comprar reinas"],
            ["tarea_general_id" => 17, "nombre" => "Limpiar marcos y alzas"],
            ["tarea_general_id" => 17, "nombre" => "Preparar registros"],
            ["tarea_general_id" => 17, "nombre" => "Revisar estado de marcos y alambrar"],
            ["tarea_general_id" => 17, "nombre" => "Revisar estado de cajones nucleros y alzas"],
            ["tarea_general_id" => 17, "nombre" => "Revisar estado de alimentadores y dispensadores de medicamentos"],
            ["tarea_general_id" => 17, "nombre" => "Preparar traje, equipos de seguridad y herramientas"],
            ["tarea_general_id" => 17, "nombre" => "Comprar núcleos"],

            //18 | SERVICIO DE POLINIZACIÓN  
            ["tarea_general_id" => 18, "nombre" => "Preparar colmenas para polinización "],
            ["tarea_general_id" => 18, "nombre" => "Inspeccionar colmenas, verificar familias muertas o huérfanas y revisar techos "],
            ["tarea_general_id" => 18, "nombre" => "Si hay floración, aplicar alimento de estímulo "],
            ["tarea_general_id" => 18, "nombre" => "Monitorear nivel de Varroa, si supera el 1%, aplicar un tratamiento orgánico "],
            ["tarea_general_id" => 18, "nombre" => "Revisar reinas activas y buen estado de la postura (cantidad y calidad) "],
            ["tarea_general_id" => 18, "nombre" => "Agregar y reemplazar marcos con cera estampada "],
            ["tarea_general_id" => 18, "nombre" => "Fusionar colmenas muy débiles "],
            ["tarea_general_id" => 18, "nombre" => "Formar núcleos "],
            ["tarea_general_id" => 18, "nombre" => "Reemplazar reinas viejas o enfermas "],
            ["tarea_general_id" => 18, "nombre" => "Coordinar el traslado de colmenas al sitio de polinización"],
            ["tarea_general_id" => 18, "nombre" => "Coordinar con agricultores que no haya aplicación de plaguicidas en el lugar de polinización"],
            ["tarea_general_id" => 18, "nombre" => "Obtener permisos para movimiento de colmenas"],
            ["tarea_general_id" => 18, "nombre" => "Registrar movimiento de colmenas en el SAG"],
            ["tarea_general_id" => 18, "nombre" => "Trasladar las colmenas al lugar de polinización"],
            ["tarea_general_id" => 18, "nombre" => "Retirar las colmenas del lugar polinizado"],
            // 19 | APIARIO PARA MIEL - DESARROLLO CÁMARA DE CRÍA
            ["tarea_general_id" => 19, "nombre" => "Trasladar las colmenas al apiario de producción de miel en la temporada"],
            ["tarea_general_id" => 19, "nombre" => "Construir y reparar banquillos del apiario destinado a miel"],
            ["tarea_general_id" => 19, "nombre" => "Revisar estado de cajones de la cámara de cría, marcos y alzas para llevar al apiario"],
            ["tarea_general_id" => 19, "nombre" => "Revisar estado de alimentadores y dispensadores de medicamentos para llevar al apiario"],
            ["tarea_general_id" => 19, "nombre" => "Generar registro FRADA del SAG"],
            ["tarea_general_id" => 19, "nombre" => "Inspeccionar colmenas para comprobar el estado de las abejas, las crías y la reina "],
            ["tarea_general_id" => 19, "nombre" => "Monitorear nivel de Varroa, si supera el 1%, aplicar un tratamiento orgánico "],
            ["tarea_general_id" => 19, "nombre" => "Cambiar panales viejos "],
            ["tarea_general_id" => 19, "nombre" => "Fusionar colmenas muy débiles "],
            ["tarea_general_id" => 19, "nombre" => "Formar núcleos "],
            ["tarea_general_id" => 19, "nombre" => "Colocar alzas "],
            ["tarea_general_id" => 19, "nombre" => "Revisar la ventilación y espacio de las colmenas, para evitar enjambrazón "],
            ["tarea_general_id" => 19, "nombre" => "Monitorear reservas de polen, si es necesario, aplicar suplemento "],

          //  20 | MANTENCIÓN DE COLMENAS 
            
            ["tarea_general_id" => 20, "nombre" =>"Renovar reinas "],
            ["tarea_general_id" => 20, "nombre" =>"Reforzar los núcleos desarrollados el mes anterior "],
            ["tarea_general_id" => 20, "nombre" =>"Verificar disponibilidad de agua "],
            ["tarea_general_id" => 20, "nombre" =>"Recoger enjambres "],
            ["tarea_general_id" => 20, "nombre" =>"Retirar marcos con cera virgen "],
            ["tarea_general_id" => 20, "nombre" =>"Recolectar miel de las primeras mieladas "],
            ["tarea_general_id" => 20, "nombre" =>"Colocar alzas "],
            ["tarea_general_id" => 20, "nombre" =>"Formar núcleos "],
            ["tarea_general_id" => 20, "nombre" =>"Vigilar la enjambrazón natural "],
            ["tarea_general_id" => 20, "nombre" =>"Revisar la fecundación de reinas nuevas "],
            ["tarea_general_id" => 20, "nombre" =>"RColocar alzas "],
            ["tarea_general_id" => 20, "nombre" =>"Revisar la ventilación y espacio de las colmenas, para evitar enjambrazón "],
            ["tarea_general_id" => 20, "nombre" =>"Revisar la postura de reinas vírgenes y colmenas zanganeras "],
            ["tarea_general_id" => 20, "nombre" =>"Eliminar restos de miel y cera cerca del apiario, para evitar pillaje "],
            ["tarea_general_id" => 20, "nombre" =>"Retirar panales con cera vieja y renovar con cera estampada "],
            ["tarea_general_id" => 20, "nombre" =>"Vigilar la entrada de polen "],
            ["tarea_general_id" => 20, "nombre" =>"Fusionar colmenas muy débiles "],
            ["tarea_general_id" => 20, "nombre" =>"Limpiar alrededor de las colmenas "],
            ["tarea_general_id" => 20, "nombre" =>"Verificar la disponibilidad de agua o proveer "],
            ["tarea_general_id" => 20, "nombre" =>"Vigilar la ventilación de las colmenas y las subidas de temperaturas "],
            ["tarea_general_id" => 20, "nombre" =>"Colocar alzas "],
            ["tarea_general_id" => 20, "nombre" =>"Verificar si hay larvas o abejas muertas en la piquera "],
            ["tarea_general_id" => 20, "nombre" =>"Revisar madurez de la miel"],
            ["tarea_general_id" => 20, "nombre" =>"Preparar alzas vacias para recolectar marcos con miel"],
            ["tarea_general_id" => 20, "nombre" =>"Recolectar marcos con miel"],
            // cosecha miel
            ["tarea_general_id" => 21, "nombre" =>" Cosechar miel "],
//pRE-INVERNADA
          ["tarea_general_id" => 22, "nombre" =>" Preparar invernada"],
          ["tarea_general_id" => 22, "nombre" =>"Monitorear nivel de Varroa, si supera el 1%, aplicar un tratamiento orgánico "],
          ["tarea_general_id" => 22, "nombre" =>"Dejar provisiones para el invierno (8)"],
          ["tarea_general_id" => 22, "nombre" =>"Fusionar colmenas débiles o huérfanas para la invernada (8)"],
          ["tarea_general_id" => 22, "nombre" =>"Si la postura disminuye fuertemente, alimentar (8)"],
          ["tarea_general_id" => 22, "nombre" =>"Revisar estado de la reina, cría nueva, abejas y reservas de néctar (8)"],
          ["tarea_general_id" => 22, "nombre" =>"Vigilar la ventilación, sin cerrar la piquera (8)"],
          ["tarea_general_id" => 22, "nombre" =>"Colocar poncho (8)"],
          ["tarea_general_id" => 22, "nombre" =>"Retirar alzas e inclinar colmenas hacia delante (8)"],
          ["tarea_general_id" => 22, "nombre" =>"Limpiar y desinfectar marcos y alzas"],
           
        ];

        DB::table('tareas_predefinidas')->insert($tareas);
    }
}

