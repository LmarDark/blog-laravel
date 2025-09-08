<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - {{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <a href="{{ route('blog') }}">
                        <h1 class="text-2xl font-bold text-gray-900 cursor-pointer hover:text-blue-500">Laravel Blog</h1>
                    </a>
                </div>
                <nav class="hidden md:flex space-x-8">
                    @auth
                        <a href="{{ route('blog') }}" class="text-blue-600 font-semibold">Início</a>
                        <a href="{{ route('profile') }}" class="text-gray-500 hover:text-gray-900 transition duration-200">Perfil</a>
                        <a href="https://github.com/lmardark/blog-laravel" target="_blank" class="text-gray-500 hover:text-gray-900 transition duration-200">Documentação</a>
                    @endauth
                </nav>
                <div class="flex items-center space-x-4">
                    @auth
                        <span class="text-sm text-gray-600">Olá, <a class="hover:text-blue-500" href="/profile">{{ auth()->user()->username }}</a>!</span>
                        <a href="{{ route('logout') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-200">
                            Sair
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-900 transition duration-200">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                            Registrar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-6xl font-bold mb-4">Bem-vindo ao Laravel Blog</h2>
            <p class="text-xl md:text-2xl mb-8 opacity-90">Descubra histórias incríveis e conteúdo de qualidade</p>
            <div class="flex justify-center">
                <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 flex justify-center">
                    <input
                        type="text"
                        placeholder="Pesquisar por posts..."
                        class="px-4 py-2 rounded-lg text-gray-900 w-64 focus:outline-none focus:ring-2 focus:ring-white/50"
                    >
                    <button class="bg-white text-blue-600 px-6 py-2 rounded-lg ml-2 hover:bg-gray-100 transition duration-200">
                        <img class="w-5" src="//www.svgrepo.com/show/532169/filter.svg"></img>
                    </button>
                    <button class="bg-white text-blue-600 px-6 py-2 rounded-lg ml-2 hover:bg-gray-100 transition duration-200">
                        Buscar
                    </button>
                </div>
            </div>
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
                <article class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden flex flex-col h-full">
                    <a href="{{ route('post.show', $post->id) }}">
                        <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                            <span class="text-white text-2xl font-bold">{{ substr($post->title, 0, 20) }}</span>
                        </div>
                    </a>

                    <div class="p-6 flex flex-col flex-1">
                        <div class="mb-2 flex items-center justify-between">
                            @if(isset($post->category))
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mb-3">
                                    {{ $post->category }}
                                </span>
                            @endif
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-blue-600 transition duration-200">
                            <a href="{{ route('post.show', $post->id) }}">
                                {{ $post->title }}
                            </a>
                        </h3>

                        <p class="text-gray-600 mb-4 line-clamp-3 flex-1">
                            {{ $post->content ? \Illuminate\Support\Str::limit($post->content, 150, '...') : 'Nenhum conteúdo disponível.' }}
                        </p>

                        <div class="flex items-center justify-between text-sm text-gray-500 mt-auto">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('profile.show', $post->author) }}" class="flex items-center space-x-2 hover:text-blue-600 transition duration-200">
                                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                        <span class="text-xs font-bold">{{ substr($post->author ?? 'A', 0, 1) }}</span>
                                    </div>
                                    <span>{{ $post->author }}</span>
                                </a>
                            </div>
                            <span>{{ $post->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </article>

            @empty
                <p class="text-center text-gray-500 col-span-3 mt-20">Nenhum post disponível no momento.</p>
            @endforelse
        </div>

        @if(isset($posts) && method_exists($posts, 'links'))
            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        @endif
    </main>

    <footer class="bg-gray-900 text-white py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">Blog Laravel</h3>
                    <p class="text-gray-400">
                        Compartilhando conhecimento e experiências através de conteúdo de qualidade.
                    </p>
                </div>
            </div>
        </div>
    </footer>
</body>
