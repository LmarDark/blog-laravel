<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Meu Blog</h1>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <span class="text-sm text-gray-600">Olá, {{ auth()->user()->username }}!</span>
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
            <h2 class="text-4xl md:text-6xl font-bold mb-4">Bem-vindo ao Blog</h2>
            <p class="text-xl md:text-2xl mb-8 opacity-90">Descubra histórias incríveis e conteúdo de qualidade</p>
            <div class="flex justify-center">
                <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4">
                    <input 
                        type="text" 
                        placeholder="Pesquisar posts..." 
                        class="px-4 py-2 rounded-lg text-gray-900 w-64 focus:outline-none focus:ring-2 focus:ring-white/50"
                    >
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
                <article class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden">
                    @if(isset($post->image))
                        <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                            <span class="text-white text-2xl font-bold">{{ substr($post->title) }}</span>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        @if(isset($post->category))
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mb-3">
                                {{ $post->category }}
                            </span>
                        @endif
                        
                        <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-blue-600 transition duration-200">
                            <a href="{{ route('post.show', $post->id) }}">
                                {{ $post->title }}
                            </a>
                        </h3>
                        
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ $post->excerpt}}
                        </p>
                        
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-bold">{{ substr($post->author) }}</span>
                                </div>
                                <span>{{ $post->author }}</span>
                            </div>
                            <span>{{ $post->created_at ? $post->created_at->format('d/m/Y') : date('d/m/Y') }}</span>
                        </div>
                        
                        <div class="mt-4">
                            <a href="{{ route('post.show', $post->id) }}" 
                               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition duration-200">
                                Ler mais
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
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
                    <h3 class="text-lg font-bold mb-4">Meu Blog</h3>
                    <p class="text-gray-400">
                        Compartilhando conhecimento e experiências através de conteúdo de qualidade.
                    </p>
                </div>
            </div>
        </div>
    </footer>
</body>
