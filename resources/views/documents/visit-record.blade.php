<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuaderno de campo:</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
        body {  font-family: 'Roboto', sans-serif;font-size: 12px; line-height: 1.6; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        td { padding: 5px; border: 1px solid #000; }
        .section-title { font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <h1>DATOS GENERALES:</h1>
    <p class="section-title">DATOS DEL APICULTOR/A REPRESENTANTE LEGAL</p>
    <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">
    <tr>
        <td colspan="2"><b>NOMBRE O RAZÓN SOCIAL:</b></td>
        <td colspan="2">{{ $data['legal_representative'] }}</td>
    </tr>
    <tr>
        <td colspan="2"><b>APELLIDOS:</b></td>
        <td colspan="2">{{ $data['last_name'] }}</td>
    </tr>
    <tr>
        <td colspan="2"><b>NÚMERO DE REGISTRO DEL APICULTOR/A:</b></td>
        <td colspan="2">{{ $data['registration_number'] }}</td>
    </tr>
    <tr>
        <td colspan="2"><b>CORREO ELECTRÓNICO:</b></td>
        <td colspan="2">{{ $data['email'] }}</td>
    </tr>
    <tr>
        <td><b>RUT:</b></td>
        <td>{{ $data['rut'] }}</td>
        <td><b>TELÉFONO:</b></td>
        <td>+56 {{ $data['phone'] }}</td>
    </tr>
    <tr>
        <td><b>DIRECCIÓN:</b></td>
        <td>{{ $data['address'] }}</td>
        <td><b>REGIÓN:</b></td>
        <td>{{ $data['region'] }}</td>
    </tr>
    <tr>
        <td colspan="2"><b>COMUNA:</b></td>
        <td colspan="2">{{ $data['commune'] }}</td>
    </tr>
</table>


    <p class="section-title">DATOS DEL APIARIO</p>
    <table>
    <!-- Fila para Nombre del Apiario y Número -->
    <tr>
        <td><b>NOMBRE DEL APIARIO:</b></td>
        <td>{{ $data['apiary_name'] }}</td>
    </tr>
    <tr>
        <td><b>NÚMERO DEL APIARIO:</b></td>
        <td>{{ $data['apiary_number'] }}</td>
    </tr>

    <!-- Fila para Actividad del Apiario y Fecha de Instalación -->
    <tr>
        <td><b>ACTIVIDAD DEL APIARIO:</b></td>
        <td>{{ $data['activity'] }}</td>
    </tr>
    <tr>
        <td><b>FECHA DE INSTALACIÓN:</b></td>
        <td>{{ $data['installation_date'] }}</td>
    </tr>

    <!-- Resto de la información -->
    <tr>
        <td>X:</td>
        <td>{{ $data['utm_x'] }}</td>
    </tr>
    <tr>
        <td>Y:</td>
        <td>{{ $data['utm_y'] }}</td>
    </tr>
    <tr>
        <td>HUSO:</td>
        <td>{{ $data['utm_huso'] }}</td>
    </tr>
    <tr>
        <td>LATITUD:</td>
        <td>{{ $data['latitude'] }}</td>
    </tr>
    <tr>
        <td>LONGITUD:</td>
        <td>{{ $data['longitude'] }}</td>
    </tr>
    <tr>
        <td>TRASHUMANTE:</td>
        <td>{{ $data['nomadic'] }}</td>
    </tr>
    <tr>
        <td>NÚMERO DE COLMENAS:</td>
        <td>{{ $data['hive_count'] }}</td>
    </tr>
</table>

<div style="page-break-before: always;"></div>
<p class="section-title">REGISTRO DE VISITAS</p>
<table>
    <thead>
    <tr>
        <th>FECHA</th>
        <th>NOMBRE</th>
        <th>APELLIDO</th>
        <th>RUT</th>
        <th>MOTIVO</th>
        <th>TELEFONO</th>
        <th>FIRMA</th>
    <tr>
    </thead>
    <tbody>
    @foreach ($data['visits'] as $visit)
    <tr>
        <td>{{  $visit['fecha_visita'] }}</td>
        <td>{{ $data['nombre_usuario'] }}</td>
        <td>{{ $data['last_name'] }}</td>
        <td>{{ $data['rut'] }}</td>
        <td>{{  $visit['fecha_visita'] }}</td>
        <td>{{ $data['phone'] }}</td>
        
        <td><br>  </td>
    <tr>
    @endforeach
    </tbody>
</table>
<div style="page-break-before: always;"></div>

<p class="section-title">REGISTRO DE INSPECCIONES</p>
<table>
    <thead>
    <tr>
        <th>FECHA</th>
        <th>N°COLMENAS TOTALES</th>
        <th>N°COLMENAS ACTIVAS</th>
        <th>N° COLMENAS ENFERMAS </th>
        <th>N° COLMENAS MUERTAS</th>
        <th>COLMENAS INSPECCIONADAS</th>

        <th>VIGOR DE LA COLMENA</th>
        <th>ACTIVIDAD DE LA COLMENA</th>
        <th>INGRESO DE POLLEN</th>
    <tr>
    </thead>
    <tbody>
    @foreach ($data['visits'] as $visit)
    <tr>
    
        <td>{{  $visit['fecha_visita'] }}  </td>
        <td>{{ $data['hive_count'] }}  </td>
        <td>{{ $visit['num_colmenas_totales'] }} </td>
        <td>0  </td>
        <td>0  </td>
        <td>20 </td>
        <td>{{  $visit['vigor_de_colmena'] }}</td>
        <td>{{  $visit['actividad_colmena'] }}</td>
        <td>{{  $visit['ingreso_pollen'] }}</td>
    <tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
