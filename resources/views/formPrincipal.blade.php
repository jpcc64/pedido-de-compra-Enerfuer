@include('components.head')

<body class="bg-background-light dark:bg-background-dark font-display">
    <div class="flex flex-col items-center min-h-screen p-4 pt-10">
        <div class="w-full max-w-5xl">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800 dark:text-white">Pedido de compra</h1>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="mb-6 bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-600 dark:hover:bg-red-500 focus:outline-none focus:ring-4 focus:ring-red-300 transition-all duration-300 transform hover:scale-105">
                    Cerrar Sesión
                </button>
            </form>
            <div
                class="bg-white dark:bg-background-dark shadow-xl rounded-xl p-8 border border-gray-200 dark:border-gray-700">
                <form class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="flex flex-col">
                        <label class="mb-2 font-medium text-gray-700 dark:text-gray-300" for="producto">Producto</label>
                        <input
                            class="form-input w-full bg-background-light dark:bg-gray-800 border-2 border-gray-300 dark:border-gray-600 focus:border-primary focus:ring-primary rounded-lg text-gray-800 dark:text-gray-200 px-4 py-3 transition-colors duration-300"
                            id="producto" placeholder="Ingrese el producto" type="text" />
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 font-medium text-gray-700 dark:text-gray-300" for="unidades">Unidades</label>
                        <input
                            class="form-input w-full bg-background-light dark:bg-gray-800 border-2 border-gray-300 dark:border-gray-600 focus:border-primary focus:ring-primary rounded-lg text-gray-800 dark:text-gray-200 px-4 py-3 transition-colors duration-300"
                            id="unidades" placeholder="Ingrese las unidades" type="number" />
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-2 font-medium text-gray-700 dark:text-gray-300" for="cliente">Cliente</label>
                        <input
                            class="form-input w-full bg-background-light dark:bg-gray-800 border-2 border-gray-300 dark:border-gray-600 focus:border-primary focus:ring-primary rounded-lg text-gray-800 dark:text-gray-200 px-4 py-3 transition-colors duration-300"
                            id="cliente" placeholder="Ingrese el cliente" type="text" />
                    </div>
                    <div class="md:col-span-3 flex justify-center mt-6">
                        <button
                            class="bg-primary text-white font-bold py-3 px-8 rounded-lg hover:bg-red-600 dark:hover:bg-red-500 focus:outline-none focus:ring-4 focus:ring-primary/30 transition-all duration-300 transform hover:scale-105"
                            type="submit">
                            Enviar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>