@include('layouts.head')

<body class="bg-background-light dark:bg-background-dark font-display">
    <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            <main class="px-40 flex flex-1 justify-center py-10">
                <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
                    <div class="flex flex-wrap justify-between gap-3 p-4">
                        <div class="flex min-w-72 flex-col gap-3">
                            <p
                                class="text-gray-800 dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">
                                Crear Nuevo Pedido de Compra</p>
                            <p class="text-gray-500 dark:text-gray-400 text-base font-normal leading-normal">Rellene los
                                detalles del producto y del proveedor para crear un nuevo pedido de compra.</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-4 py-6">

                        <div
                            class="flex flex-col gap-6 p-6 rounded-lg bg-white dark:bg-background-dark border border-gray-200 dark:border-gray-700">
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white">Proveedor</h3>
                            <!-- ////////// FORMULARIO DE PROVEEDOR ////////// -->
                            <div class="flex flex-col gap-4">
                                <label class="flex flex-col w-full">
                                    <form action="{{ route('consultaCliente') }}" method="GET">
                                        <p
                                            class="text-gray-800 dark:text-gray-300 text-base font-medium leading-normal pb-2">
                                            Código de Proveedor</p>
                                        <input name="CardCode"
                                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-800 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:border-primary h-12 placeholder:text-gray-400 dark:placeholder-gray-500 p-3 text-base font-normal leading-normal"
                                            placeholder="Ingrese el código del proveedor"
                                            value="{{ $cliente['CardCode'] ?? '' }}" />
                                </label>
                                <label class="flex flex-col w-full">
                                    <p
                                        class="text-gray-800 dark:text-gray-300 text-base font-medium leading-normal pb-2">
                                        Nombre de Proveedor</p>
                                    <input name="CardName"
                                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-800 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:border-primary h-12 placeholder:text-gray-400 dark:placeholder-gray-500 p-3 text-base font-normal leading-normal"
                                        placeholder="Ingrese el nombre del proveedor"
                                        value="{{ $cliente['CardName'] ?? '' }}" />

                                    <input type="submit"
                                        class="bg-primary/80 text-white rounded-lg px-4 py-2 h-12 w-1/3 mt-4"
                                        value="Buscar"></input>
                                    </form>
                                </label>
                            </div>
                        </div>
                        <div
                            class="flex flex-col gap-6 p-6 rounded-lg bg-white dark:bg-background-dark border border-gray-200 dark:border-gray-700">
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white">Producto</h3>
                            <!-- ////////// FORMULARIO DE PRODUCTO ////////// -->
                            <div class="flex flex-col gap-4">
                                <form action="{{ route('consultaProducto') }}" method="GET">
                                    <label class="flex flex-col w-full">
                                        <p
                                            class="text-gray-800 dark:text-gray-300 text-base font-medium leading-normal pb-2">
                                            Código de Producto</p>
                                        <div class="flex w-full gap-2">
                                            <input name="ItemCode" type="text"
                                                class="form-input flex-1 min-w-0 resize-none overflow-hidden rounded-lg text-gray-800 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:border-primary h-12 placeholder:text-gray-400 dark:placeholder-gray-500 p-3 text-base font-normal leading-normal"
                                                placeholder="Ingrese el código del producto"
                                                value="{{ isset($productos['ItemCode']) ? $productos['ItemCode'] : '' }}" />
                                            <button type="button" id="buscarProducto"
                                                class="bg-primary/80 text-white rounded-lg px-4 py-2">Buscar</button>
                                        </div>
                                </form>
                                </label>
                                <label class="flex flex-col w-full">
                                    <p
                                        class="text-gray-800 dark:text-gray-300 text-base font-medium leading-normal pb-2">
                                        Nombre de Producto</p>
                                    <input name="ItemName"
                                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-800 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:border-primary h-12 placeholder:text-gray-400 dark:placeholder-gray-500 p-3 text-base font-normal leading-normal"
                                        placeholder="Ingrese el nombre del producto"
                                        value="{{ isset($productos['ItemName']) ? $productos['ItemName'] : '' }}" />
                                </label>
                                <div class="flex gap-4">
                                    <label class="flex flex-col flex-1 min-w-0">
                                        <p
                                            class="text-gray-800 dark:text-gray-300 text-base font-medium leading-normal pb-2">
                                            Unidades</p>
                                        <input name="Quantity" type="number" min="0" step="1"
                                            class="form-input w-full min-w-0 resize-none overflow-hidden rounded-lg text-gray-800 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:border-primary h-12 placeholder:text-gray-400 dark:placeholder-gray-500 p-3 text-base font-normal leading-normal"
                                            placeholder="Número de unidades" value="" />
                                    </label>

                                    <label class="flex flex-col flex-1 min-w-0">
                                        <p
                                            class="text-gray-800 dark:text-gray-300 text-base font-medium leading-normal pb-2">
                                            Precio total</p>
                                        <input name="TotalPrice" type="number" min="0"
                                            class="form-input w-full min-w-0 resize-none overflow-hidden rounded-lg text-gray-800 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:border-primary h-12 placeholder:text-gray-400 dark:placeholder-gray-500 p-3 text-base font-normal leading-normal"
                                            placeholder="Precio en €" value="" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="px-4 py-3 justify-end">
                        <!-- /////// BOTON DE AÑADIR PRODUCTO AL PEDIDO /////// -->
                        <button
                            class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary/20 text-primary gap-2 pl-4 text-sm font-bold leading-normal tracking-[0.015em]">
                            <span class="material-symbols-outlined text-xl">add</span>
                            <span class="truncate">Añadir al pedido</span>
                        </button>
                    </div>
                    <div class="flex flex-col gap-4 p-4 mt-8">
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white">Resumen del Pedido</h3>
                        <!-- ////////// FORMULARIO QUE SE VA A MANDAR PARA CREAR EL PEDIDO JUNTO CON EL PROVEEDOR////////// -->
                        <div
                            class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-background-dark">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                                            scope="col">Código</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                                            scope="col">Producto</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                                            scope="col">Unidades</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                                            scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <tr>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                            PROD-001</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            Laptop Pro 15"</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            10</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button
                                                class="text-red-600 hover:text-red-900 dark:text-red-500 dark:hover:text-red-400">
                                                <span class="material-symbols-outlined text-xl">delete</span>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="flex justify-end gap-4 px-4 py-6 mt-4">
                        <button
                            class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white text-sm font-bold leading-normal tracking-[0.015em]">
                            <span class="truncate">Cancelar</span>
                        </button>
                        <button
                            class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em]">
                            <span class="truncate">Crear Pedido</span>
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Búsqueda de productos
            $('#buscarProducto').click(function (e) {
                e.preventDefault();
                $.get('{{ route('consultaProducto') }}', {
                    ItemCode: $('input[name="ItemCode"]').val()
                })
                    .done(function (response) {
                        if (response.productos) {
                            const firstPrice = response.productos.AvgStdPrice;
                            let unidades = $('input[name="Quantity"]').val();
                            
                            console.log(firstPrice);

                            // ejemplo: asignar un campo con una propiedad del primer objeto si existe
                            if (firstPrice) {
                                $('input[name="TotalPrice"]').val(firstPrice * unidades ?? '');
                            }
                            $('input[name="ItemName"]').val(response.productos.ItemName);
                        }
                    });
            });

            // Búsqueda de clientes
            $('#buscarCliente').click(function (e) {
                e.preventDefault();
                $.get('{{ route('consultaCliente') }}', {
                    CardCode: $('input[name="CardCode"]').val()
                })
                    .done(function (response) {
                        if (response.cliente) {
                            $('input[name="CardName"]').val(response.cliente.CardName);
                            // Aquí puedes actualizar otros campos del cliente
                        }
                    });
            });
        });
    </script>
</body>

</html>