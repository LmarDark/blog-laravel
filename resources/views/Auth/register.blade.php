<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Registrar</h2>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-4">
                <input
                    type="text"
                    name="username"
                    placeholder="Usuário"
                    value="{{ old('username') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('username') border-red-500 @enderror"
                    required
                >
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <input
                    type="password"
                    name="password"
                    placeholder="Senha"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('password') border-red-500 @enderror"
                    required
                >
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirmar Senha"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                    required
                >
            </div>

            <button
                type="submit"
                class="w-full bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-200"
            >
                Criar Conta
            </button>
        </form>

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                Já tem uma conta?
                <a href="{{ route('welcome') }}" class="text-green-600 hover:text-green-800 font-semibold">
                    Faça login
                </a>
            </p>
        </div>
    </div>
</body>
</html>
