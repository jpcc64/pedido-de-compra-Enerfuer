<table>
    <thead>
        <tr>
            <th>Codigo Proveedor</th>
            <th>Proveedor</th>
            <th>Producto</th>
        </tr>
    </thead>
    <tbody>

        @if(isset($compras))
            @foreach ($compras as $compra)
                <tr>
                    <td>{{ $compra['CardCode'] }}</td>
                    <td>{{ $compra['CardName'] }}</td>
                    @foreach ($compra['DocumentLines'] as $producto)
                        <td>{{ $producto['ItemDescription'] }}</td>
                    @endforeach

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4" class="text-center">No se han realizado consultas aún.</td>
            </tr>
        @endif
    </tbody>
</table>