<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Meu Blog</h1>
                </div>
                <nav class="hidden md:flex space-x-8">
                    <a href="#" class="text-gray-500 hover:text-gray-900 transition duration-200">Início</a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 transition duration-200">Categorias</a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 transition duration-200">Sobre</a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 transition duration-200">Contato</a>
                </nav>
                <div class="flex items-center space-x-4">
                    @auth
                        <span class="text-sm text-gray-600">Olá, {{ auth()->user()->username ?? 'Usuário' }}!</span>
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

    <!-- Hero Section -->
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

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Posts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- Loop através dos posts (você adicionará a lógica aqui) --}}
            @forelse($posts ?? [] as $post)
                <article class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden">
                    {{-- Imagem do post --}}
                    @if(isset($post->image))
                        <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                            <span class="text-white text-2xl font-bold">{{ substr($post->title ?? 'Post', 0, 1) }}</span>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        {{-- Categoria --}}
                        @if(isset($post->category))
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mb-3">
                                {{ $post->category }}
                            </span>
                        @endif
                        
                        {{-- Título --}}
                        <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-blue-600 transition duration-200">
                            <a href="{{ route('post.show', $post->id ?? '#') }}">
                                {{ $post->title ?? 'Título do Post' }}
                            </a>
                        </h3>
                        
                        {{-- Resumo --}}
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ $post->excerpt ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' }}
                        </p>
                        
                        {{-- Meta informações --}}
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-bold">{{ substr($post->author ?? 'A', 0, 1) }}</span>
                                </div>
                                <span>{{ $post->author ?? 'Autor' }}</span>
                            </div>
                            <span>{{ $post->created_at ? $post->created_at->format('d/m/Y') : date('d/m/Y') }}</span>
                        </div>
                        
                        {{-- Botão de leitura --}}
                        <div class="mt-4">
                            <a href="{{ route('post.show', $post->id ?? '#') }}" 
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
                {{-- Posts de exemplo quando não há posts no banco --}}
                <article class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden">
                    <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">T</span>
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mb-3">
                            Tecnologia
                        </span>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-blue-600 transition duration-200">
                            <a href="#">Como criar um blog moderno com Laravel</a>
                        </h3>
                        <p class="text-gray-600 mb-4">
                            Aprenda a desenvolver um blog completo usando Laravel e Tailwind CSS. Este tutorial aborda desde a configuração inicial até o deploy em produção.
                        </p>
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-bold">J</span>
                                </div>
                                <span>João Silva</span>
                            </div>
                            <span>{{ date('d/m/Y') }}</span>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition duration-200">
                                Ler mais
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>

                <article class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden">
                    <div class="w-full h-48 bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">D</span>
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full mb-3">
                            Design
                        </span>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-blue-600 transition duration-200">
                            <a href="#">Princípios de Design para Web</a>
                        </h3>
                        <p class="text-gray-600 mb-4">
                            Descubra os fundamentos do design web moderno e como aplicar conceitos de UX/UI para criar interfaces incríveis e funcionais.
                        </p>
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-bold">M</span>
                                </div>
                                <span>Maria Santos</span>
                            </div>
                            <span>{{ date('d/m/Y', strtotime('-1 day')) }}</span>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition duration-200">
                                Ler mais
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>

                <article class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden">
                    <div class="w-full h-48 bg-gradient-to-br from-purple-400 to-pink-500 flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">P</span>
                    </div>
                    <div class="p-6">
                        <span class="inline-block bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full mb-3">
                            Programação
                        </span>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-blue-600 transition duration-200">
                            <a href="#">PHP 8: Novidades e Recursos</a>
                        </h3>
                        <p class="text-gray-600 mb-4">
                            Explore as principais novidades do PHP 8, incluindo union types, match expressions, named arguments e muito mais.
                        </p>
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-bold">P</span>
                                </div>
                                <span>Pedro Costa</span>
                            </div>
                            <span>{{ date('d/m/Y', strtotime('-2 days')) }}</span>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition duration-200">
                                Ler mais
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            @endforelse
        </div>

        {{-- Paginação (você adicionará a lógica aqui) --}}
        @if(isset($posts) && method_exists($posts, 'links'))
            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        @else
            {{-- Paginação de exemplo --}}
            <div class="mt-12 flex justify-center">
                <nav class="flex items-center space-x-2">
                    <button class="px-3 py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition duration-200">
                        Anterior
                    </button>
                    <button class="px-3 py-2 bg-blue-500 text-white rounded-lg">1</button>
                    <button class="px-3 py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition duration-200">2</button>
                    <button class="px-3 py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition duration-200">3</button>
                    <button class="px-3 py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition duration-200">
                        Próximo
                    </button>
                </nav>
            </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">Meu Blog</h3>
                    <p class="text-gray-400">
                        Compartilhando conhecimento e experiências através de conteúdo de qualidade.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Categorias</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition duration-200">Tecnologia</a></li>
                        <li><a href="#" class="hover:text-white transition duration-200">Design</a></li>
                        <li><a href="#" class="hover:text-white transition duration-200">Programação</a></li>
                        <li><a href="#" class="hover:text-white transition duration-200">Tutoriais</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition duration-200">Sobre</a></li>
                        <li><a href="#" class="hover:text-white transition duration-200">Contato</a></li>
                        <li><a href="#" class="hover:text-white transition dur
(Content truncated due to size limit. Use page ranges or line ranges to read remaining content)