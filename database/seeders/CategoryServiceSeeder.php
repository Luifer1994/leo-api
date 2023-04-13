<?php

namespace Database\Seeders;

use App\Http\Modules\Services\Models\CategoryService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //taller mecánico automotriz y diesel.
        $categories = [
            [
                'name' => 'Mantenimiento preventivo',
                'description' => 'Mantenimiento preventivo de vehículos automotores y diesel',
                'services' => [
                    [
                        'name' => 'Cambio de aceite',
                        'description' => 'Cambio de aceite de motor, caja de cambios, etc.'
                    ],
                    [
                        'name' => 'Cambio de líquido de frenos',
                        'description' => 'Cambio de líquido de frenos, pastillas, discos, etc.'
                    ],
                    [
                        'name' => 'Revisión de frenos',
                        'description' => 'Revisión de frenos, pastillas, discos, etc.'
                    ],
                    [
                        'name' => 'Revisión de suspensión',
                        'description' => 'Revisión de suspensión, amortiguadores, etc.'
                    ],
                    [
                        'name' => 'Revisión de dirección',
                        'description' => 'Revisión de dirección, bomba de dirección, etc.'
                    ],
                    [
                        'name' => 'Revisión de luces',
                        'description' => 'Revisión de luces, intermitentes, etc.'
                    ],
                    [
                        'name' => 'Sincronización',
                        'description' => 'Sincronización de motor, válvulas, etc.'
                    ],
                    [
                        'name' => 'Cambio kit de distribución',
                        'description' => 'Cambio kit de distribución, bomba de agua, correa de distribución, tensor, etc.'
                    ]
                ]
            ],
            [
                'name' => 'Mantenimiento correctivo',
                'description' => 'Mantenimiento correctivo de vehículos automotores y diesel',
                'services' => [
                    [
                        'name' => 'Suspensión',
                        'description' => 'Suspensión, amortiguadores, etc.'
                    ],
                    [
                        'name' => 'Dirección',
                        'description' => 'Dirección, bomba de dirección, etc.'
                    ],
                    [
                        'name' => 'Kit de embrague',
                        'description' => 'Kit de embrague, etc.'
                    ],
                    [
                        'name' => 'Electrónica y electricidad',
                        'description' => 'Electrónica y electricidad, etc.'
                    ],
                    [
                        'name' => 'Correción de fugas',
                        'description' => 'Correción de fugas, etc.'
                    ]
                ]
            ],
            [
                'name' => 'Mécanica especializada',
                'description' => 'Mécanica especializada de vehículos automotores y diesel',
                'services' => [
                    [
                        'name' => 'Reparación de motor',
                        'description' => 'Reparación de motor, etc.'
                    ],
                    [
                        'name' => 'Reparación de caja de cambios',
                        'description' => 'Reparación de caja de cambios, etc.'
                    ],
                    [
                        'name' => 'Reparación de diferencial',
                        'description' => 'Reparación de diferencial, etc.'
                    ],
                    [
                        'name' => 'Scaner',
                        'description' => 'Scaner'
                    ]
                ]
            ],
            [
                'name' => 'Embellecimiento',
                'description' => 'Embellecimiento de vehículos automotores y diesel',
                'services' => [
                    [
                        'name' => 'Latonería y pintura',
                        'description' => 'Latonería y pintura, etc.'
                    ],
                    [
                        'name' => 'Lavado',
                        'description' => 'Lavado, etc.'
                    ],
                    [
                        'name' => 'Limpieza de tapicería',
                        'description' => 'Limpieza de tapicería, etc.'
                    ]
                ]
            ],
            [
                'name' => 'Servicios adicionales',
                'description' => 'Servicios adicionales de vehículos automotores y diesel',
                'services' => [
                    [
                        'name' => 'Cambio de llantas',
                        'description' => 'Cambio de llantas, etc.'
                    ],
                    [
                        'name' => 'Servicio de desvare',
                        'description' => 'Servicio de desvare, etc.'
                    ]
                ]
            ]
        ];

        foreach ($categories as $category) {
            $categoryService = CategoryService::create([
                'name' => $category['name'],
                'description' => $category['description']
            ]);

            foreach ($category['services'] as $service) {
                $categoryService->services()->create([
                    'name' => $service['name'],
                    'description' => $service['description']
                ]);
            }
        }
    }
}
