<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>

    <h2 class="text-center">Detalle Factura Venta</h2>
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-lg-12">
                <label class="form-control-label text-black-50" for="nombre">Cliente: {{ $facturaventa->id }} </label>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <table class="table mt-3 table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="border">Producto</th>
                    <th scope="border">Cantidad </th>
                    <th scope="border">Precio</th>
                    <th scope="border">SubTotal</th>
                </tr>
            </thead>
            <tbody>

                @foreach($detalles as $det)
                    <tr>
                        <td>{{$det->producto->nombre}}</td>
                        <td>{{$det->cantidad}}</td>
                        <td>{{$det->precio}}</td>
                        <td>{{$det->cantidad*$det->precio}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div align=right>
        <h4>Total: {{ $facturaventa->monto }}</h4>
    </div>
</body>

</html>
