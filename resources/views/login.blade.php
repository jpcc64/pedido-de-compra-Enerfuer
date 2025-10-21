@include('layouts.head')

<body class="bg-[radial-gradient(circle,_#3f3f47,_#0000ff)] flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-sm">
        <h1 class="text-2xl font-bold text-center mb-6">Iniciar Sesión</h1>
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <input type="text" name="username" placeholder="Usuario" required
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <input type="password" name="password" placeholder="Contraseña" required
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">Entrar</button>
            </div>
        </form>
        @if ($errors->has('login'))
            <p class="text-red-500 text-sm mt-4">{{ $errors->first('login') }}</p>
        @endif
    </div>
</body>

</html>