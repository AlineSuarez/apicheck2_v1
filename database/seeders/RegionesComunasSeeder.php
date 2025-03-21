<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;
use App\Models\Comuna;

class RegionesComunasSeeder extends Seeder
{
    public function run()
    {
        $regiones_comunas = [
            'Región de Arica y Parinacota' => ['Arica', 'Camarones', 'Putre', 'General Lagos'],
            'Región de Tarapacá' => ['Iquique', 'Alto Hospicio', 'Pozo Almonte', 'Huara', 'Camiña', 'Colchane', 'Pica'],
            'Región de Antofagasta' => ['Antofagasta', 'Mejillones', 'Sierra Gorda', 'Taltal', 'Calama', 'Ollagüe', 'San Pedro de Atacama', 'Tocopilla', 'María Elena'],
            'Región de Atacama' => ['Copiapó', 'Caldera', 'Tierra Amarilla', 'Chañaral', 'Diego de Almagro', 'Vallenar', 'Huasco', 'Freirina', 'Alto del Carmen'],
            'Región de Coquimbo' => ['La Serena', 'Coquimbo', 'Andacollo', 'La Higuera', 'Vicuña', 'Paihuano', 'Ovalle', 'Monte Patria', 'Combarbalá', 'Punitaqui', 'Río Hurtado', 'Illapel', 'Salamanca', 'Los Vilos', 'Canela'],
            'Región de Valparaíso' => ['Valparaíso', 'Viña del Mar', 'Concón', 'Quilpué', 'Villa Alemana', 'Casablanca', 'Quillota', 'La Calera', 'Nogales', 'Hijuelas', 'La Cruz', 'San Antonio', 'Cartagena', 'El Quisco', 'El Tabo', 'Algarrobo', 'Santo Domingo', 'Los Andes', 'Calle Larga', 'San Esteban', 'Rinconada', 'Putaendo', 'San Felipe', 'Santa María', 'Panquehue', 'Llaillay', 'Catemu', 'Petorca', 'Cabildo', 'La Ligua', 'Zapallar', 'Papudo'],
            'Región Metropolitana de Santiago' => ['Santiago', 'Providencia', 'Las Condes', 'Vitacura', 'Lo Barnechea', 'Ñuñoa', 'Macul', 'La Florida', 'Puente Alto', 'San Joaquín', 'La Granja', 'El Bosque', 'La Cisterna', 'San Ramón', 'Lo Espejo', 'Pedro Aguirre Cerda', 'Lo Prado', 'Cerro Navia', 'Quilicura', 'Renca', 'Pudahuel', 'Estación Central', 'Maipú', 'Cerrillos', 'Peñalolén', 'La Reina', 'Huechuraba', 'Conchalí', 'Independencia', 'Recoleta', 'San Miguel', 'San Bernardo', 'Buin', 'Paine', 'Calera de Tango', 'Talagante', 'El Monte', 'Isla de Maipo', 'Padre Hurtado', 'Peñaflor', 'Melipilla', 'Alhué', 'Curacaví', 'María Pinto', 'San Pedro', 'Colina', 'Lampa', 'Tiltil'],
            'Región de O’Higgins' => ['Rancagua', 'Machalí', 'Graneros', 'Codegua', 'Mostazal', 'Requínoa', 'Rengo', 'Malloa', 'Coinco', 'Coltauco', 'Doñihue', 'Las Cabras', 'Peumo', 'Pichidegua', 'San Vicente', 'San Fernando', 'Santa Cruz', 'Chimbarongo', 'Placilla', 'Nancagua', 'Palmilla', 'Peralillo', 'Pumanque', 'Marchigüe', 'Lolol', 'Pichilemu', 'Marchigüe', 'Litueche', 'La Estrella', 'Navidad'],
            'Región del Maule' => ['Talca', 'San Clemente', 'Pelarco', 'Pencahue', 'Maule', 'San Rafael', 'Curepto', 'Constitución', 'Río Claro', 'Linares', 'Colbún', 'Longaví', 'Retiro', 'Parral', 'Villa Alegre', 'Yerbas Buenas', 'Cauquenes', 'Chanco', 'Pelluhue', 'Curicó', 'Teno', 'Romeral', 'Molina', 'Sagrada Familia', 'Hualañé', 'Licantén', 'Vichuquén'],
            'Región de Ñuble' => ['Chillán', 'Chillán Viejo', 'Bulnes', 'Quillón', 'San Ignacio', 'El Carmen', 'Pemuco', 'Pinto', 'Coihueco', 'San Carlos', 'Ñiquén', 'San Fabián', 'San Nicolás', 'Quirihue', 'Cobquecura', 'Ninhue', 'Treguaco', 'Portezuelo', 'Ránquil', 'Yungay'],
            'Región del Biobío' => ['Concepción', 'Talcahuano', 'Hualpén', 'Penco', 'Tomé', 'Florida', 'Coronel', 'San Pedro de la Paz', 'Chiguayante', 'Hualqui', 'Lota', 'Santa Juana', 'Los Ángeles', 'Nacimiento', 'Negrete', 'Santa Bárbara', 'Tucapel', 'Mulchén', 'Quilaco', 'Quilleco', 'Antuco', 'Cabrero', 'Yumbel', 'Laja', 'San Rosendo', 'Arauco', 'Cañete', 'Contulmo', 'Curanilahue', 'Lebu', 'Los Álamos', 'Tirúa'],
            'Región de La Araucanía' => ['Temuco', 'Padre Las Casas', 'Cunco', 'Melipeuco', 'Vilcún', 'Freire', 'Pitrufquén', 'Gorbea', 'Loncoche', 'Villarrica', 'Toltén', 'Pucón', 'Curarrehue', 'Perquenco', 'Galvarino', 'Lautaro', 'Nueva Imperial', 'Carahue', 'Saavedra', 'Teodoro Schmidt', 'Puerto Saavedra', 'Cholchol', 'Angol', 'Renaico', 'Collipulli', 'Ercilla', 'Los Sauces', 'Purén', 'Lumaco', 'Traiguén', 'Victoria'],
            'Región de Los Ríos' => ['Valdivia', 'Corral', 'Lanco', 'Máfil', 'Mariquina', 'Paillaco', 'Panguipulli', 'Los Lagos', 'Futrono', 'Lago Ranco', 'Río Bueno', 'La Unión'],
            'Región de Los Lagos' => ['Puerto Montt', 'Puerto Varas', 'Llanquihue', 'Frutillar', 'Fresia', 'Los Muermos', 'Maullín', 'Calbuco', 'Ancud', 'Castro', 'Chonchi', 'Curaco de Vélez', 'Dalcahue', 'Puqueldón', 'Queilén', 'Quellón', 'Quemchi', 'Quinchao', 'Osorno', 'Purranque', 'Río Negro', 'San Pablo', 'San Juan de la Costa'],
            'Región de Aysén del General Carlos Ibáñez del Campo' => ['Coyhaique', 'Lago Verde', 'Aysén', 'Cisnes', 'Guaitecas', 'Cochrane', 'O’Higgins', 'Tortel', 'Chile Chico', 'Río Ibáñez'],
            'Región de Magallanes y de la Antártica Chilena' => ['Punta Arenas', 'Laguna Blanca', 'Río Verde', 'San Gregorio', 'Cabo de Hornos', 'Antártica', 'Porvenir', 'Primavera', 'Timaukel', 'Natales', 'Torres del Paine'],
        ];

        foreach ($regiones_comunas as $region => $comunas) {
            $nuevaRegion = Region::create([
                'nombre' => $region,
                'abreviatura' => $this->getAbreviatura($region),
            ]);

            foreach ($comunas as $comuna) {
                Comuna::create([
                    'nombre' => $comuna,
                    'region_id' => $nuevaRegion->id,
                ]);
            }
        }
    }

    // Función para generar abreviaturas de las regiones
    private function getAbreviatura($region)
    {
        $abreviaturas = [
            'Región de Arica y Parinacota' => 'AP',
            'Región de Tarapacá' => 'TA',
            'Región de Antofagasta' => 'AN',
            'Región de Atacama' => 'AT',
            'Región de Coquimbo' => 'CO',
            'Región de Valparaíso' => 'VS',
            'Región Metropolitana de Santiago' => 'RM',
            'Región de O’Higgins' => 'LI',
            'Región del Maule' => 'ML',
            'Región de Ñuble' => 'NB',
            'Región del Biobío' => 'BI',
            'Región de La Araucanía' => 'AR',
            'Región de Los Ríos' => 'LR',
            'Región de Los Lagos' => 'LL',
            'Región de Aysén del General Carlos Ibáñez del Campo' => 'AI',
            'Región de Magallanes y de la Antártica Chilena' => 'MA',
        ];

        return $abreviaturas[$region] ?? '';
    }

    
}
