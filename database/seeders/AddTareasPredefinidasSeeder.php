<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AddTareasPredefinidasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tareas = [
            [
                'id' => 1,
                'fecha_inicio' => '2024-05-02',
                'fecha_limite' => '2024-07-04',
                'prioridad' => 'media'
            ],
            [
                'id' => 2,
                'fecha_inicio' => '2024-05-03',
                'fecha_limite' => '2024-07-08',
                'prioridad' => 'baja'
            ],
            [
                'id' => 3,
                'fecha_inicio' => '2024-05-04',
                'fecha_limite' => '2024-07-12',
                'prioridad' => 'alta'
            ],
            [
                'id' => 4,
                'fecha_inicio' => '2024-05-05',
                'fecha_limite' => '2024-07-16',
                'prioridad' => 'media'
            ],
            [
                'id' => 5,
                'fecha_inicio' => '2024-05-06',
                'fecha_limite' => '2024-07-20',
                'prioridad' => 'baja'
            ],
            [
                'id' => 6,
                'fecha_inicio' => '2024-05-07',
                'fecha_limite' => '2024-07-24',
                'prioridad' => 'alta'
            ],
            [
                'id' => 7,
                'fecha_inicio' => '2024-05-08',
                'fecha_limite' => '2024-07-28',
                'prioridad' => 'media'
            ],
            [
                'id' => 8,
                'fecha_inicio' => '2024-05-09',
                'fecha_limite' => '2024-08-01',
                'prioridad' => 'baja'
            ],
            [
                'id' => 9,
                'fecha_inicio' => '2024-05-10',
                'fecha_limite' => '2024-08-05',
                'prioridad' => 'alta'
            ],
            [
                'id' => 10,
                'fecha_inicio' => '2024-05-11',
                'fecha_limite' => '2024-08-09',
                'prioridad' => 'media'
            ],
            [
                'id' => 11,
                'fecha_inicio' => '2024-05-12',
                'fecha_limite' => '2024-08-13',
                'prioridad' => 'baja'
            ],
            [
                'id' => 12,
                'fecha_inicio' => '2024-05-13',
                'fecha_limite' => '2024-08-17',
                'prioridad' => 'alta'
            ],
            [
                'id' => 13,
                'fecha_inicio' => '2024-05-14',
                'fecha_limite' => '2024-08-21',
                'prioridad' => 'media'
            ],
            [
                'id' => 14,
                'fecha_inicio' => '2024-05-15',
                'fecha_limite' => '2024-08-25',
                'prioridad' => 'baja'
            ],
            [
                'id' => 15,
                'fecha_inicio' => '2024-05-16',
                'fecha_limite' => '2024-08-29',
                'prioridad' => 'alta'
            ],
            [
                'id' => 16,
                'fecha_inicio' => '2024-05-17',
                'fecha_limite' => '2024-08-29',
                'prioridad' => 'media'
            ],
            [
                'id' => 17,
                'fecha_inicio' => '2024-08-02',
                'fecha_limite' => '2024-08-05',
                'prioridad' => 'baja'
            ],
            [
                'id' => 18,
                'fecha_inicio' => '2024-08-03',
                'fecha_limite' => '2024-08-07',
                'prioridad' => 'alta'
            ],
            [
                'id' => 19,
                'fecha_inicio' => '2024-08-04',
                'fecha_limite' => '2024-08-09',
                'prioridad' => 'media'
            ],
            [
                'id' => 20,
                'fecha_inicio' => '2024-08-05',
                'fecha_limite' => '2024-08-11',
                'prioridad' => 'baja'
            ],
            [
                'id' => 21,
                'fecha_inicio' => '2024-08-06',
                'fecha_limite' => '2024-08-13',
                'prioridad' => 'alta'
            ],
            [
                'id' => 22,
                'fecha_inicio' => '2024-08-07',
                'fecha_limite' => '2024-08-15',
                'prioridad' => 'media'
            ],
            [
                'id' => 23,
                'fecha_inicio' => '2024-08-08',
                'fecha_limite' => '2024-08-17',
                'prioridad' => 'baja'
            ],
            [
                'id' => 24,
                'fecha_inicio' => '2024-08-09',
                'fecha_limite' => '2024-08-19',
                'prioridad' => 'alta'
            ],
            [
                'id' => 25,
                'fecha_inicio' => '2024-08-10',
                'fecha_limite' => '2024-08-21',
                'prioridad' => 'media'
            ],
            [
                'id' => 26,
                'fecha_inicio' => '2024-08-11',
                'fecha_limite' => '2024-08-23',
                'prioridad' => 'baja'
            ],
            [
                'id' => 27,
                'fecha_inicio' => '2024-08-12',
                'fecha_limite' => '2024-08-25',
                'prioridad' => 'media'
            ],
            [
                'id' => 28,
                'fecha_inicio' => '2024-08-13',
                'fecha_limite' => '2024-08-27',
                'prioridad' => 'Urgente'
            ],
            [
                'id' => 29,
                'fecha_inicio' => '2024-08-14',
                'fecha_limite' => '2024-08-29',
                'prioridad' => 'media'
            ],
            [
                'id' => 30,
                'fecha_inicio' => '2024-08-15',
                'fecha_limite' => '2024-08-31',
                'prioridad' => 'baja'
            ],
            [
                'id' => 31,
                'fecha_inicio' => '2024-08-16',
                'fecha_limite' => '2024-08-19',
                'prioridad' => 'alta'
            ],
            [
                'id' => 32,
                'fecha_inicio' => '2024-08-17',
                'fecha_limite' => '2024-08-21',
                'prioridad' => 'media'
            ],
            [
                'id' => 33,
                'fecha_inicio' => '2024-08-18',
                'fecha_limite' => '2024-08-23',
                'prioridad' => 'baja'
            ],
            [
                'id' => 34,
                'fecha_inicio' => '2024-08-19',
                'fecha_limite' => '2024-08-25',
                'prioridad' => 'media'
            ],
            [
                'id' => 35,
                'fecha_inicio' => '2024-08-20',
                'fecha_limite' => '2024-08-27',
                'prioridad' => 'Urgente'
            ],
            [
                'id' => 36,
                'fecha_inicio' => '2024-08-21',
                'fecha_limite' => '2024-08-19',
                'prioridad' => 'media'
            ],
            [
                'id' => 37,
                'fecha_inicio' => '2024-08-22',
                'fecha_limite' => '2024-08-21',
                'prioridad' => 'baja'
            ],
            [
                'id' => 38,
                'fecha_inicio' => '2024-08-23',
                'fecha_limite' => '2024-08-23',
                'prioridad' => 'alta'
            ],
            [
                'id' => 39,
                'fecha_inicio' => '2024-08-24',
                'fecha_limite' => '2024-08-25',
                'prioridad' => 'media'
            ],
            [
                'id' => 40,
                'fecha_inicio' => '2024-08-25',
                'fecha_limite' => '2024-08-27',
                'prioridad' => 'baja'
            ],
            [
                'id' => 41,
                'fecha_inicio' => '2024-08-26',
                'fecha_limite' => '2024-08-29',
                'prioridad' => 'media'
            ],
            [
                'id' => 42,
                'fecha_inicio' => '2024-09-03',
                'fecha_limite' => '2024-09-05',
                'prioridad' => 'Urgente'
            ],
            [
                'id' => 43,
                'fecha_inicio' => '2024-09-07',
                'fecha_limite' => '2024-09-09',
                'prioridad' => 'media'
            ],
            [
                'id' => 44,
                'fecha_inicio' => '2024-09-11',
                'fecha_limite' => '2024-09-13',
                'prioridad' => 'baja'
            ],
            [
                'id' => 45,
                'fecha_inicio' => '2024-09-15',
                'fecha_limite' => '2024-09-17',
                'prioridad' => 'alta'
            ],
            [
                'id' => 46,
                'fecha_inicio' => '2024-09-19',
                'fecha_limite' => '2024-09-21',
                'prioridad' => 'media'
            ],
            [
                'id' => 47,
                'fecha_inicio' => '2024-09-23',
                'fecha_limite' => '2024-09-25',
                'prioridad' => 'baja'
            ],
            [
                'id' => 48,
                'fecha_inicio' => '2024-10-02',
                'fecha_limite' => '2024-10-05',
                'prioridad' => 'media'
            ],
            [
                'id' => 49,
                'fecha_inicio' => '2024-10-05',
                'fecha_limite' => '2024-10-11',
                'prioridad' => 'Urgente'
            ],
            [
                'id' => 50,
                'fecha_inicio' => '2024-10-08',
                'fecha_limite' => '2024-10-17',
                'prioridad' => 'media'
            ],
            [
                'id' => 51,
                'fecha_inicio' => '2024-10-11',
                'fecha_limite' => '2024-10-23',
                'prioridad' => 'baja'
            ],
            [
                'id' => 52,
                'fecha_inicio' => '2024-10-14',
                'fecha_limite' => '2024-10-29',
                'prioridad' => 'alta'
            ],
            [
                'id' => 53,
                'fecha_inicio' => '2024-10-17',
                'fecha_limite' => '2024-10-29',
                'prioridad' => 'media'
            ],
            [
                'id' => 54,
                'fecha_inicio' => '2024-11-02',
                'fecha_limite' => '2024-11-05',
                'prioridad' => 'baja'
            ],
            [
                'id' => 55,
                'fecha_inicio' => '2024-11-06',
                'fecha_limite' => '2024-11-13',
                'prioridad' => 'media'
            ],
            [
                'id' => 56,
                'fecha_inicio' => '2024-11-10',
                'fecha_limite' => '2024-11-21',
                'prioridad' => 'Urgente'
            ],
            [
                'id' => 57,
                'fecha_inicio' => '2024-11-14',
                'fecha_limite' => '2024-11-29',
                'prioridad' => 'media'
            ],
            [
                'id' => 58,
                'fecha_inicio' => '2024-12-03',
                'fecha_limite' => '2024-12-05',
                'prioridad' => 'baja'
            ],
            [
                'id' => 59,
                'fecha_inicio' => '2024-12-04',
                'fecha_limite' => '2024-12-07',
                'prioridad' => 'alta'
            ],
            [
                'id' => 60,
                'fecha_inicio' => '2024-12-05',
                'fecha_limite' => '2024-12-09',
                'prioridad' => 'media'
            ],
            [
                'id' => 61,
                'fecha_inicio' => '2024-12-06',
                'fecha_limite' => '2024-12-11',
                'prioridad' => 'baja'
            ],
            [
                'id' => 62,
                'fecha_inicio' => '2024-12-07',
                'fecha_limite' => '2024-12-13',
                'prioridad' => 'media'
            ],
            [
                'id' => 63,
                'fecha_inicio' => '2024-12-08',
                'fecha_limite' => '2024-12-15',
                'prioridad' => 'Urgente'
            ],
            [
                'id' => 64,
                'fecha_inicio' => '2024-12-09',
                'fecha_limite' => '2024-12-28',
                'prioridad' => 'media'
            ],
            [
                'id' => 65,
                'fecha_inicio' => '2025-01-03',
                'fecha_limite' => '2025-01-05',
                'prioridad' => 'baja'
            ],
            [
                'id' => 66,
                'fecha_inicio' => '2025-01-05',
                'fecha_limite' => '2025-01-09',
                'prioridad' => 'alta'
            ],
            [
                'id' => 67,
                'fecha_inicio' => '2025-01-07',
                'fecha_limite' => '2025-01-11',
                'prioridad' => 'media'
            ],
            [
                'id' => 68,
                'fecha_inicio' => '2025-01-09',
                'fecha_limite' => '2025-01-13',
                'prioridad' => 'baja'
            ],
            [
                'id' => 69,
                'fecha_inicio' => '2025-01-11',
                'fecha_limite' => '2025-01-15',
                'prioridad' => 'media'
            ],
            [
                'id' => 70,
                'fecha_inicio' => '2025-01-13',
                'fecha_limite' => '2025-01-19',
                'prioridad' => 'Urgente'
            ],
            [
                'id' => 71,
                'fecha_inicio' => '2025-01-17',
                'fecha_limite' => '2025-01-21',
                'prioridad' => 'media'
            ],
            [
                'id' => 72,
                'fecha_inicio' => '2025-01-19',
                'fecha_limite' => '2025-01-23',
                'prioridad' => 'baja'
            ],
            [
                'id' => 73,
                'fecha_inicio' => '2025-01-27',
                'fecha_limite' => '2025-05-05',
                'prioridad' => 'alta'
            ],
            [
                'id' => 74,
                'fecha_inicio' => '2025-01-27',
                'fecha_limite' => '2025-05-05',
                'prioridad' => 'alta'
            ],
            [
                'id' => 75,
                'fecha_inicio' => '2024-08-26',
                'fecha_limite' => '2024-08-29',
                'prioridad' => 'media'
            ],
            [
                'id' => 76,
                'fecha_inicio' => '2025-02-03',
                'fecha_limite' => '2025-02-05',
                'prioridad' => 'media'
            ],
            [
                'id' => 77,
                'fecha_inicio' => '2025-02-23',
                'fecha_limite' => '2025-02-25',
                'prioridad' => 'baja'
            ],
            [
                'id' => 78,
                'fecha_inicio' => '2025-02-23',
                'fecha_limite' => '2025-02-25',
                'prioridad' => 'media'
            ],
            [
                'id' => 79,
                'fecha_inicio' => '2025-03-03',
                'fecha_limite' => '2025-03-04',
                'prioridad' => 'Urgente'
            ],
            [
                'id' => 80,
                'fecha_inicio' => '2025-03-03',
                'fecha_limite' => '2025-04-04',
                'prioridad' => 'media'
            ],
            [
                'id' => 81,
                'fecha_inicio' => '2025-04-13',
                'fecha_limite' => '2025-04-13',
                'prioridad' => 'baja'
            ],
            [
                'id' => 82,
                'fecha_inicio' => '2025-04-13',
                'fecha_limite' => '2025-04-13',
                'prioridad' => 'alta'
            ],
            [
                'id' => 83,
                'fecha_inicio' => '2025-04-13',
                'fecha_limite' => '2025-04-30',
                'prioridad' => 'media'
            ]
        ];

        // Iterate through each task and update the records
        foreach ($tareas as $tarea) {
            DB::table('tareas_predefinidas')
                ->where('id', $tarea['id'])
                ->update([
                    'fecha_inicio' => Carbon::createFromFormat('Y-m-d', $tarea['fecha_inicio'])->format('Y-m-d'),
                    'fecha_limite' => Carbon::createFromFormat('Y-m-d', $tarea['fecha_limite'])->format('Y-m-d'),
                    'prioridad' => $tarea['prioridad']
                ]);
        }

        // If records don't exist, insert them
        $existingIds = DB::table('tareas_predefinidas')->pluck('id')->toArray();
        $tareasToInsert = array_filter($tareas, function($tarea) use ($existingIds) {
            return !in_array($tarea['id'], $existingIds);
        });

        if (!empty($tareasToInsert)) {
            DB::table('tareas_predefinidas')->insert($tareasToInsert);
        }
    }
}
