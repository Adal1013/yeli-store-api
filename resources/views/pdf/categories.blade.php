<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <style>
        head {
            text-align: center;
        }  

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
        }

        table {
            border: 1px solid #66A5AD;
            width: 100%;
        }

        th{
            border: 1px solid #66A5AD;
            padding: 5px;
            background-color: #07575B
        }
        td {
            border: 1px solid #66A5AD;
            padding: 5px;
            text-align: center;
        }

        th {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Lista de Usuarios</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Codigo</th>
            <th>Fecha de Creación</th>
        </tr>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->code }}</td>
                <td>{{ $category->created_at->format('Y-m-d') }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>