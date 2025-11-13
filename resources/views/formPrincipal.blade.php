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
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-red-600 text-white text-sm font-bold leading-normal tracking-[0.015em]">
                                <span class="truncate">Cerrar Sesión</span>
                            </button>
                        </form>
                    </div>
                    <!-- mensaje de succes o error -->
                    @if (session('success'))
                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800 w-2/4"
                            role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800 w-1/4"
                            role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-4 py-6">

                        <div
                            class="flex flex-col gap-6 p-6 rounded-lg bg-white dark:bg-background-dark border border-gray-200 dark:border-gray-700">
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white">Proveedor</h3>
                            <!-- ////////// FORMULARIO DE PROVEEDOR ////////// -->
                            <div class="flex flex-col gap-4">
                                <label class="flex flex-col w-full">
                                    <p class="text-gray-800 dark:text-gray-300 text-base font-medium leading-normal">
                                        Nombre de Proveedor</p>
                                    <select id="CardCode"
                                        class="form-input mt-2 flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-800 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:border-primary h-12 placeholder:text-gray-400 dark:placeholder-gray-500 p-3 text-base font-normal leading-normal">
                                        <!-- <option value="">Seleccione un proveedor</option> -->
                                        <option value="P0000690">Prefabricados Nortysur</option>
                                        <!-- <option value="P0000691">Enerfuer</option> -->
                                    </select>
                                    <p
                                        class="text-gray-800 dark:text-gray-300 text-base font-medium leading-normal mt-3">
                                        Nombre de Almacén</p>
                                    <select id="Warehouse"
                                        class="form-input mt-2 flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-800 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:border-primary h-12 placeholder:text-gray-400 dark:placeholder-gray-500 p-3 text-base font-normal leading-normal">
                                        <option value="">Seleccione un almacén</option>
                                        <option value="12">Almacen 12</option>
                                        <option value="14">Almacen 14</option>
                                        <option value="07">Almacen 07</option>
                                        <option value="28">Almacen 28</option>
                                        <option value="25">Almacen 25</option>
                                    </select>

                                </label>

                            </div>
                        </div>
                        <div
                            class="flex flex-col gap-6 p-6 rounded-lg bg-white dark:bg-background-dark border border-gray-200 dark:border-gray-700">
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white">Producto</h3>
                            <!-- ////////// FORMULARIO DE PRODUCTO ////////// -->

                            <div class="flex flex-col gap-4">
                                <form action="{{ route('consultaProducto') }}" method="GET" id="formProducto">
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

                                    </label>
                                    <label class="flex flex-col w-full">
                                        <p
                                            class="text-gray-800 dark:text-gray-300 text-base font-medium leading-normal pb-2">
                                            Producto</p>
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
                                                Precio coste</p>
                                            <input name="UnitPrice" type="number" min="0" id="UnitPrice"
                                                class="form-input w-full min-w-0 resize-none overflow-hidden rounded-lg text-gray-800 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:border-primary h-12 placeholder:text-gray-400 dark:placeholder-gray-500 p-3 text-base font-normal leading-normal"
                                                placeholder="Precio en €"
                                                value="{{ isset($productos['AvgStdPrice']) ? $productos['AvgStdPrice'] : '' }}" />
                                        </label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 justify-end">
                        <!-- /////// BOTON DE AÑADIR PRODUCTO AL PEDIDO /////// -->
                        <button id="subirProducto"
                            class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary/20 text-primary gap-2 pl-4 text-sm font-bold leading-normal tracking-[0.015em]">
                            <span class="material-symbols-outlined text-xl">add</span>
                            <span class="truncate">Añadir al pedido</span>
                        </button>
                    </div>
                    <div class="flex flex-col gap-4 p-4 mt-8">
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white">Resumen del Pedido</h3>
                        <div
                            class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-background-dark">
                            <form action="{{ route('crearPedido') }}" method="POST">
                                @csrf
                                <input type="hidden" name="CardCode" id="finalCardCode">
                                <input type="hidden" name="Warehouse" id="finalCardCode" value="">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-800">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                                                scope="col">Código</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                                                scope="col">Producto</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                                                scope="col">Precio Unitario</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                                                scope="col">Unidades</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                                                scope="col">Subtotal</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                                                scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700"
                                        id='listaProductosPedido'>
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-gray-50 dark:bg-gray-800">
                                            <td colspan="4"
                                                class="px-6 py-3 text-right text-base font-bold text-gray-900 dark:text-white">
                                                Total del Pedido:
                                            </td>
                                            <td colspan="2"
                                                class="px-6 py-3 text-left text-base font-bold text-gray-900 dark:text-white">
                                                €<span id="totalPedido">0.00</span>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                        </div>
                    </div>
                    <div class="flex justify-end gap-4 px-4 py-6 mt-4">
                        <button type="button" id="cancelarPedido"
                            class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white text-sm font-bold leading-normal tracking-[0.015em]">
                            <span class="truncate">Cancelar</span>
                        </button>
                        <button type="submit" id="crearPedidoBtn"
                            onclick="this.disabled=true; this.innerText='Creando...'; this.form.submit();"
                            class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em]">
                            <span class="truncate">Crear Pedido</span>
                        </button>
                        <div id="spinner" role="status" hidden>
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white opacity-20">
                                Noteworthy technology acquisitions 2021</h5>
                            <p class="font-normal text-gray-700 dark:text-gray-400 opacity-20">Here are the biggest
                                enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                            <div role="status" class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2">
                                <svg aria-hidden="true"
                                    class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor" />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentFill" />
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>


</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function logEvent(message, context = {}) {
        $.post('{{ route('logFrontendEvent') }}', {
            _token: '{{ csrf_token() }}',
            message: message,
            context: context
        });
    }

    $(document).ready(function () {
        // Asignar IDs a los inputs de producto para una referencia más clara
        const $itemCodeInput = $('input[name="ItemCode"]');
        const $itemNameInput = $('input[name="ItemName"]');
        const $quantityInput = $('input[name="Quantity"]');
        const $unitPriceInput = $('input[name="UnitPrice"]');
        const $cardCodeInput = $('input[name="CardCode"]');
        const $cardNameInput = $('input[name="CardName"]');
        // Búsqueda de productos
        $('#buscarProducto').click(function (e) {
            e.preventDefault();
            const itemCode = $itemCodeInput.val();
            logEvent('Búsqueda de producto iniciada', { itemCode: itemCode });
            if (!itemCode) {
                alert('Por favor, ingrese un Código de Producto.');
                return;
            }

            $.get('{{ route('consultaProducto') }}', { ItemCode: itemCode })
                .done(function (response) {
                    if (response.productos) {
                        const product = response.productos;
                        console.log('Producto encontrado:', product);
                        logEvent('Producto encontrado', { itemCode: itemCode, product: product });
                        // Rellenar campos del producto
                        $itemNameInput.val(product.ItemName || '');
                        // Asigna AvgStdPrice como precio unitario si está disponible
                        $unitPriceInput.val(parseFloat(product.AvgStdPrice || 0).toFixed(2));
                        $quantityInput.val('1'); // Pone 1 por defecto al buscar
                    } else {
                        alert('Producto no encontrado.');
                        logEvent('Producto no encontrado', { itemCode: itemCode });
                        $itemNameInput.val('');
                        $unitPriceInput.val('0.00');
                        $quantityInput.val('1');
                    }
                })
                .fail(function (xhr, status, error) {
                    console.error('Error al buscar producto:', error, xhr.responseText);
                    logEvent('Error al buscar producto', { itemCode: itemCode, error: error });
                    alert('Hubo un error de conexión al buscar el producto.');
                });
        });

        // Añadir producto al pedido (Carrito)
        $('#subirProducto').click(function (e) {
            e.preventDefault();

            // Validación básica
            if (!$cardCodeInput.val() || !$('#finalCardCode').val()) {
                alert('Debe buscar y seleccionar un Proveedor primero.');
                return;
            }
            if (!$itemCodeInput.val() || !$itemNameInput.val() || !$quantityInput.val() || !$unitPriceInput.val()) {
                alert('Debe buscar un Producto y especificar la Cantidad y el Precio Unitario.');
                return;
            }
            if (parseInt($quantityInput.val()) <= 0) {
                alert('La cantidad debe ser mayor que cero.');
                return;
            }

            const formData = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                ItemCode: $itemCodeInput.val(),
                ItemName: $itemNameInput.val(),
                Quantity: $quantityInput.val(),
                UnitPrice: $unitPriceInput.val()
            };
            logEvent('Añadir producto al pedido', { product: formData });

            $.post('{{ route('pedidos.addProducto') }}', formData)
                .done(function (response) {
                    if (response.success && response.carrito) {

                        alert('Producto añadido al pedido correctamente.');
                        updateCartTable(response.carrito);

                        // Limpiar campos del producto después de añadirlo
                        $itemCodeInput.val('');
                        $itemNameInput.val('');
                        $quantityInput.val('');
                        $unitPriceInput.val('');

                    } else {
                        alert('Error al añadir el producto al pedido: ' + (response.error_message || 'Desconocido'));
                    }
                })
                .fail(function (xhr, status, error) {
                    console.error('Error en la petición AJAX:', error, xhr.responseText);
                    alert('Hubo un error de conexión al añadir el producto. Consulta la consola.');
                });
        });

        // Función para actualizar la tabla del carrito
        function updateCartTable(carrito) {
            const $tableBody = $('#listaProductosPedido');
            $tableBody.empty(); // Limpiar la tabla existente
            //limpiar la listaProductosPedido
            $('#listaProductosPedido').empty();
            let totalGeneral = 0;

            if (carrito && Object.keys(carrito).length > 0) {
                // El carrito debe ser un objeto o array de productos. Usaremos Object.values() si es un objeto.
                const productosArray = Array.isArray(carrito) ? carrito : Object.values(carrito);

                productosArray.forEach(function (item) {
                    const quantity = parseFloat(item.Quantity);
                    const unitPrice = parseFloat(item.UnitPrice);
                    const currentSubtotal = (quantity * unitPrice).toFixed(2);
                    totalGeneral += parseFloat(currentSubtotal);

                    // Fila con 6 columnas: Código | Producto | Precio Unitario | Unidades | Subtotal | Acciones
                    const newRowHtml = `
                        <tr data-product-id="${item.ItemCode}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                ${item.ItemCode} 
                                <input type="hidden" name="items[${item.ItemCode}][ItemCode]" value="${item.ItemCode}">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                ${item.ItemName} 
                                <input type="hidden" name="items[${item.ItemCode}][ItemName]" value="${item.ItemName}">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                €<span class="product-unit-price">${unitPrice.toFixed(2)}</span>
                                <input type="hidden" name="items[${item.ItemCode}][UnitPrice]" value="${unitPrice.toFixed(2)}">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                <input type="number" name="items[${item.ItemCode}][Quantity]" value="${quantity}" min="1"
                                    class="w-20 form-input text-gray-800 dark:text-white bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 rounded-md text-sm quantity-input"
                                    data-item-code="${item.ItemCode}">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                €<span class="product-subtotal">${currentSubtotal}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button type="button" class="text-red-600 hover:text-red-900 dark:text-red-500 dark:hover:text-red-400 remove-product-btn" data-item-code="${item.ItemCode}">
                                    <span class="material-symbols-outlined text-xl">delete</span>
                                </button>
                            </td>
                        </tr>
                    `;
                    $tableBody.append(newRowHtml);
                });
            } else {
                // Mostrar mensaje de carrito vacío si es necesario
                $tableBody.html('<tr><td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No hay productos en el pedido.</td></tr>');
            }

            // Actualizar el total general en el footer de la tabla
            $('#totalPedido').text(totalGeneral.toFixed(2));
        }

        // Delegación de evento para eliminar producto
        $(document).on('click', '.remove-product-btn', function () {
            const itemCodeToRemove = $(this).data('item-code');
            logEvent('Eliminar producto del pedido', { itemCode: itemCodeToRemove });

            // Petición AJAX para eliminar el producto de la sesión
            $.post('{{ route('pedidos.removeProducto') }}', {
                _token: $('meta[name="csrf-token"]').attr('content'),
                ItemCode: itemCodeToRemove
            })
                .done(function (response) {
                    if (response.success && response.carrito) {
                        alert('Producto eliminado del pedido.');
                        updateCartTable(response.carrito);
                    } else {
                        alert('Error al eliminar el producto: ' + (response.error_message || 'Desconocido'));
                    }
                })
                .fail(function (xhr, status, error) {
                    console.error('Error en la petición AJAX:', error, xhr.responseText);
                    alert('Hubo un error de conexión al eliminar el producto.');
                });
        });

        // Delegación de evento para actualizar cantidad
        $(document).on('change', '.quantity-input', function () {
            const $input = $(this);
            const itemCodeToUpdate = $input.data('item-code');
            const newQuantity = $input.val();

            if (parseInt(newQuantity) <= 0) {
                alert('La cantidad debe ser mayor que cero. Producto eliminado.');
                // Tratar como una eliminación si la cantidad es 0 o menos
                $(`button.remove-product-btn[data-item-code="${itemCodeToUpdate}"]`).click();
                return;
            }

            logEvent('Actualizar cantidad de producto', { itemCode: itemCodeToUpdate, newQuantity: newQuantity });
            // Petición AJAX para actualizar la cantidad del producto en la sesión
            $.post('{{ route('pedidos.updateQuantity') }}', { // Necesitarás crear esta ruta
                _token: $('meta[name="csrf-token"]').attr('content'),
                ItemCode: itemCodeToUpdate,
                Quantity: newQuantity
            })
                .done(function (response) {
                    if (response.success && response.carrito) {
                        updateCartTable(response.carrito);
                    } else {
                        alert('Error al actualizar la cantidad: ' + (response.error_message || 'Desconocido'));
                    }
                })
                .fail(function (xhr, status, error) {
                    console.error('Error en la petición AJAX:', error, xhr.responseText);
                    alert('Hubo un error de conexión al actualizar la cantidad.');
                });
        });

        $('#Warehouse').change(function () {
            const selectedWarehouse = $(this).val();
            $('[name="Warehouse"]').val(selectedWarehouse);
        });
        $('#CardCode').change(function () {
            const selectedCardCode = $(this).val();
            $('[name="CardCode"]').val(selectedCardCode);
        });

        // Cargar el carrito al inicio si ya hay productos en la sesión (necesita una ruta de fetch)
        $.get('{{ route('pedidos.fetchCarrito') }}')
            .done(function (response) {
                if (response.carrito) {
                    updateCartTable(response.carrito);
                }
            });
        $('#crearPedidoBtn').click(function (e) {
           $.get('{{ route('pedidos.clearCarrito') }}')
            .done(function (response) {
                if (response.carrito) {
                    updateCartTable(response.carrito);
                }
            });
        });

    });
</script>