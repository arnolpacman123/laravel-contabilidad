<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
        @page {
            margin: 0cm 0cm;
            font-size: 1em;
        }

        body {
            margin: 3cm 2cm 2cm;
        }
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #eb2651;
            color: white;
            text-align: center;
            line-height: 30px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #eb2651;
            color: white;
            text-align: center;
            line-height: 35px;
        }
    </style>
    <title>Reporte de clientes</title>
</head>

<body>
    <header>
        <br>
        <p><strong>REPORTE DE CLIENTES REGISTRADOS</strong></p>
    </header>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">Documento</th>
                <th scope="col">Nombre</th>
                <th scope="col">Dirección</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Empresa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <th scope="row">{{ $cliente->tipo_documento }}: {{ $cliente->num_documento }}</th>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->direccion }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->empresa->nombre }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <footer>
        <p><strong>CONTABILIDAD EN LA NUBE</strong></p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>
