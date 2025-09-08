<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title ?? 'Post' }} - Laravel Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
</head>
<body class="bg-gray-50 min-h-screen">
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <a href="{{ route('blog') }}" class="text-2xl font-bold text-gray-900 hover:text-blue-600 transition duration-200">
                        Laravel Blog
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

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li><a href="{{ route('blog') }}" class="hover:text-gray-700">Início</a></li>
                <li><span class="mx-2">/</span></li>
                @if(isset($post->category))
                    <li><a href="#" class="hover:text-gray-700">{{ $post->category }}</a></li>
                    <li><span class="mx-2">/</span></li>
                @endif
                <li class="text-gray-900 font-medium">{{ $post->title ?? 'Post' }}</li>
            </ol>
        </nav>

        <!-- Post Header -->
        <article class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Featured Image -->
            @if(isset($post->image))
                <div class="w-full h-96 overflow-hidden">
                    <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                </div>
            @else
                <div class="w-full h-96 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                    <span class="text-white text-6xl font-bold">{{ substr($post->title ?? 'P', 0, 1) }}</span>
                </div>
            @endif

            <!-- Post Content -->
            <div class="p-8">
                <!-- Category and Meta -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-4">
                        @if(isset($post->category))
                            <span class="inline-block bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">
                                {{ $post->category }}
                            </span>
                        @endif
                        <span class="text-gray-500 text-sm">{{ $post->created_at ? $post->created_at->format('d/m/Y') : date('d/m/Y') }}</span>
                        <span class="text-gray-500 text-sm">{{ $post->reading_time ?? '5' }} min de leitura</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-500 text-sm">{{ $post->views ?? 0 }} visualizações</span>
                    </div>
                </div>

                <!-- Title -->
                <h1 class="text-4xl font-bold text-gray-900 mb-6 leading-tight">
                    {{ $post->title ?? 'Título do Post' }}
                </h1>

                <!-- Author Info -->
                <div class="flex items-center mb-8 pb-6 border-b border-gray-200">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center mr-4">
                        <span class="text-white font-bold text-lg">{{ substr($post->author->username ?? 'A', 0, 1) }}</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ $post->author->username ?? 'Autor' }}</h3>
                        <p class="text-gray-600 text-sm">{{ $post->author->bio ?? 'Desenvolvedor e escritor' }}</p>
                    </div>
                </div>

                <!-- Post Content -->
                <div class="prose prose-lg max-w-none">
                    {!! $post->content ?? '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>' !!}
                </div>

                <!-- Tags -->
                @if(isset($post->tags) && count($post->tags) > 0)
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h4 class="text-sm font-semibold text-gray-900 mb-3">Tags:</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($post->tags as $tag)
                                <span class="inline-block bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full hover:bg-gray-200 transition duration-200">
                                    #{{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Social Share -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h4 class="text-sm font-semibold text-gray-900 mb-3">Compartilhar:</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="flex items-center space-x-2 text-blue-600 hover:text-blue-800 transition duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                            <span>Twitter</span>
                        </a>
                        <a href="#" class="flex items-center space-x-2 text-blue-700 hover:text-blue-900 transition duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            <span>Facebook</span>
                        </a>
                        <a href="#" class="flex items-center space-x-2 text-blue-500 hover:text-blue-700 transition duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                            <span>LinkedIn</span>
                        </a>
                    </div>
                </div>
            </div>
        </article>

        <!-- Comments Section -->
        <section class="mt-12">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Comentários ({{ $post->comments_count ?? 0 }})</h3>

                <!-- Comment Form -->
                @auth
                    <form class="mb-8">
                        <div class="mb-4">
                            <textarea
                                rows="4"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                placeholder="Deixe seu comentário..."
                            ></textarea>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                            Comentar
                        </button>
                    </form>
                @else
                    <div class="mb-8 p-4 bg-gray-50 rounded-lg text-center">
                        <p class="text-gray-600 mb-4">Faça login para comentar</p>
                        <a href="{{ route('login') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                            Fazer Login
                        </a>
                    </div>
                @endauth

                <!-- Comments List -->
                <div class="space-y-6">
                    @forelse($post->comments ?? [] as $comment)
                        <div class="flex space-x-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold text-sm">{{ substr($comment->author->username ?? 'U', 0, 1) }}</span>
                            </div>
                            <div class="flex-1">
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="font-semibold text-gray-900">{{ $comment->author->username ?? 'Usuário' }}</h4>
                                        <span class="text-gray-500 text-sm">{{ $comment->created_at ? $comment->created_at->diffForHumans() : 'Agora' }}</span>
                                    </div>
                                    <p class="text-gray-700">{{ $comment->content ?? 'Comentário de exemplo.' }}</p>
                                </div>
                                <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                                    <button class="hover:text-blue-600 transition duration-200">Curtir</button>
                                    <button class="hover:text-blue-600 transition duration-200">Responder</button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Comentários de exemplo -->
                        <div class="flex space-x-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold text-sm">J</span>
                            </div>
                            <div class="flex-1">
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="font-semibold text-gray-900">João Silva</h4>
                                        <span class="text-gray-500 text-sm">2 horas atrás</span>
                                    </div>
                                    <p class="text-gray-700">Excelente post! Muito esclarecedor e bem explicado. Obrigado por compartilhar esse conhecimento.</p>
                                </div>
                                <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                                    <button class="hover:text-blue-600 transition duration-200">Curtir (3)</button>
                                    <button class="hover:text-blue-600 transition duration-200">Responder</button>
                                </div>
                            </div>
                        </div>

                        <div class="flex space-x-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold text-sm">M</span>
                            </div>
                            <div class="flex-1">
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="font-semibold text-gray-900">Maria Santos</h4>
                                        <span class="text-gray-500 text-sm">1 dia atrás</span>
                                    </div>
                                    <p class="text-gray-700">Muito útil! Já salvei nos favoritos para consultar depois. Parabéns pelo conteúdo de qualidade.</p>
                                </div>
                                <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                                    <button class="hover:text-blue-600 transition duration-200">Curtir (1)</button>
                                    <button class="hover:text-blue-600 transition duration-200">Responder</button>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Related Posts -->
        <section class="mt-12">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Posts Relacionados</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @for($i = 1; $i <= 3; $i++)
                    <article class="bg-white rounded-xl shadow-md hover:shadow-lg transition duration-300 overflow-hidden">
                        <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                            <span class="text-white text-2xl font-bold">{{ $i }}</span>
                        </div>
                        <div class="p-6">
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mb-3">
                                Tecnologia
                            </span>
                            <h4 class="text-lg font-bold text-gray-900 mb-2 hover:text-blue-600 transition duration-200">
                                <a href="#">Post Relacionado {{ $i }}</a>
                            </h4>
                            <p class="text-gray-600 text-sm mb-4">
                                Breve descrição do post relacionado para despertar o interesse do leitor.
                            </p>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>{{ date('d/m/Y', strtotime("-{$i} days")) }}</span>
                                <span>{{ rand(50, 200) }} visualizações</span>
                            </div>
                        </div>
                    </article>
                @endfor
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; {{ date('Y') }} Laravel Blog. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script>
        // Funcionalidade para curtir comentários
        document.addEventListener('DOMContentLoaded', function() {
            const likeButtons = document.querySelectorAll('button:contains("Curtir")');

            likeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Aqui você adicionaria a lógica para curtir o comentário
                    console.log('Curtir comentário');
                });
            });

            // Funcionalidade para responder comentários
            const replyButtons = document.querySelectorAll('button:contains("Responder")');

            replyButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Aqui você adicionaria a lógica para responder o comentário
                    console.log('Responder comentário');
                });
            });
        });
    </script>
</body>
</html>

