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
                                                placeholder="Ingrese el código del producto" value="{{ isset($productos['ItemCode']) ? $productos['ItemCode'] : '' }}" />
                                            <input type="submit" class="bg-primary/80 text-white rounded-lg px-4 py-2 h-12" value="Busca"></input>
                                        </div>
                                </form>
                                </label>
                                <label class="flex flex-col w-full">
                                    <p
                                        class="text-gray-800 dark:text-gray-300 text-base font-medium leading-normal pb-2">
                                        Nombre de Producto</p>
                                    <input
                                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-800 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:border-primary h-12 placeholder:text-gray-400 dark:placeholder-gray-500 p-3 text-base font-normal leading-normal"
                                        placeholder="Ingrese el nombre del producto" value="{{ isset($productos['ItemName']) ? $productos['ItemName'] : '' }}" />
                                </label>
                                <label class="flex flex-col w-full">
                                    <p
                                        class="text-gray-800 dark:text-gray-300 text-base font-medium leading-normal pb-2">
                                        Unidades</p>
                                    <input
                                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-800 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:border-primary h-12 placeholder:text-gray-400 dark:placeholder-gray-500 p-3 text-base font-normal leading-normal"
                                        placeholder="Ingrese el número de unidades" type="number" value="" />
                                </label>
                            </div>
                        </div>
                        <div
                            class="flex flex-col gap-6 p-6 rounded-lg bg-white dark:bg-background-dark border border-gray-200 dark:border-gray-700">
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white">Proveedor</h3>
                            <!-- ////////// FORMULARIO DE PROVEEDOR ////////// -->
                            <div class="flex flex-col gap-4">
                                <label class="flex flex-col w-full">
                                    <p
                                        class="text-gray-800 dark:text-gray-300 text-base font-medium leading-normal pb-2">
                                        Código de Proveedor</p>
                                    <input
                                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-800 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:border-primary h-12 placeholder:text-gray-400 dark:placeholder-gray-500 p-3 text-base font-normal leading-normal"
                                        placeholder="Ingrese el código del proveedor" value="" />
                                </label>
                                <label class="flex flex-col w-full">
                                    <p
                                        class="text-gray-800 dark:text-gray-300 text-base font-medium leading-normal pb-2">
                                        Nombre de Proveedor</p>
                                    <input
                                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-800 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:border-primary h-12 placeholder:text-gray-400 dark:placeholder-gray-500 p-3 text-base font-normal leading-normal"
                                        placeholder="Ingrese el nombre del proveedor" value="" />
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 justify-start">
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
                                    <tr>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                            PROD-002</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            Monitor 27" 4K</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            25</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button
                                                class="text-red-600 hover:text-red-900 dark:text-red-500 dark:hover:text-red-400">
                                                <span class="material-symbols-outlined text-xl">delete</span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                            PROD-003</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            Teclado Mecánico</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            50</td>
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
</body>

</html>