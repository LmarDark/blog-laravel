<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - {{ auth()->user()->username ?? 'Usuário' }}</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            position: relative;
        }

        .close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 20px;
        }

        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
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
                    <a href="{{ route('blog') }}" class="text-gray-500 hover:text-gray-900 transition duration-200">Início</a>
                    <a href="{{ route('profile') }}" class="text-blue-600 font-semibold">Perfil</a>
                    <a href="https://github.com/lmardark/blog-laravel" target="_blank" class="text-gray-500 hover:text-gray-900 transition duration-200">Documentação</a>
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

    <section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-8">
                <div class="relative">
                    <div class="w-32 h-32 bg-white/20 backdrop-blur-sm rounded-full border-4 border-white shadow-lg flex items-center justify-center">
                        <span class="text-4xl font-bold text-white">
                            {{ strtoupper(substr($user->username ?? 'U', 0, 1)) }}
                        </span>
                    </div>
                </div>

                <div class="text-center md:text-left flex-1">
                    <h1 class="text-4xl font-bold mb-2">{{ $user->username }}</h1>
                    <p class="text-lg opacity-80 mb-6">{{ $user->bio }}</p>

                    <div class="flex justify-center md:justify-start space-x-8">
                        <div class="text-center">
                            <div class="text-2xl font-bold">{{ $posts->count() ?? 0 }}</div>
                            <div class="text-sm opacity-80">Posts</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold">{{ auth()->user()->created_at->format('d/m/Y') }}</div>
                            <div class="text-sm opacity-80">Conta criada em</div>
                        </div>
                    </div>
                </div>

                @if ($user === auth()->user())
                    <div class="flex flex-col space-y-3">
                        <button id="editProfileBtn" class="bg-white text-blue-600 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 transition duration-200">
                            Editar Perfil
                        </button>
                        <button id="newPostBtn" class="bg-blue-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-600 transition duration-200">
                            Novo Post
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Meus Posts</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
                <article class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden">
                    <div class="relative w-full h-48 bg-gradient-to-br from-blue-400 to-purple-500 rounded-t-xl overflow-hidden">
                        @if ($user === auth()->user())
                            <div class="absolute top-0 right-0 flex z-20">
                                <button type="button" class="bg-yellow-500 hover:bg-yellow-600 p-2 rounded-bl-lg">
                                    <img class="w-8 hover:scale-110 transition-all duration-200" src="https://www.svgrepo.com/show/510962/edit-pencil-line-01.svg">
                                </button>
                                <button type="button" class="bg-red-500 hover:bg-red-600 p-2">
                                    <img class="w-8 hover:scale-110 transition-all duration-200" src="https://www.svgrepo.com/show/533020/trash-list-alt.svg">
                                </button>
                            </div>
                        @endif
                        <a href="{{ route('post.show', $post->id) }}" class="absolute inset-0 z-10 flex items-center justify-center">
                            <span class="text-white text-2xl font-bold">{{ substr($post->title ?? 'P', 0, 1) }}</span>
                        </a>
                    </div>
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
                            {{ \Illuminate\Support\Str::limit($post->content, 150, '...') }}
                        </p>

                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>{{ $post->created_at->format('d/m/Y') }}</span>
                            <span>{{ $post->likes ?? 0 }} curtidas</span>
                        </div>
                    </div>
                </article>
            @empty
                <div class="lg:col-span-3 text-center py-10">
                    <p class="text-gray-600 text-lg">Você ainda não publicou nenhum post.</p>
                    <button id="newPostBtnEmpty" class="mt-4 bg-blue-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-600 transition duration-200">
                        Criar seu primeiro Post
                    </button>
                </div>
            @endforelse
        </div>

        @if(isset($posts) && method_exists($posts, 'links'))
            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        @endif
    </main>

    <!-- Modal de Editar Perfil -->
    <div id="editProfileModal" class="modal">
        <div class="modal-content">
            <span class="close-button" id="closeEditProfileModal">&times;</span>
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Editar Perfil</h2>
            <form action="{{ route('profile.post') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="editUsername" class="block text-sm font-medium text-gray-700">Usuário</label>
                    <input type="text" id="editUsername" name="username" value="{{ auth()->user()->username ?? '' }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="editBio" class="block text-sm font-medium text-gray-700">Biografia</label>
                    <textarea id="editBio" name="bio" rows="3" maxlength="500" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ auth()->user()->bio ?? '' }}</textarea>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Salvar Alterações</button>
            </form>
        </div>
    </div>

    <!-- Modal de Novo Post -->
    <div id="newPostModal" class="modal">
        <div class="modal-content">
            <span class="close-button" id="closeNewPostModal">&times;</span>
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Criar Novo Post</h2>
            <form action="{{ route('profile.create') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="postTitle" class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" id="postTitle" name="title" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="postContent" class="block text-sm font-medium text-gray-700">Conteúdo</label>
                    <textarea id="postContent" name="content" rows="6" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div>
                    <label for="postCategory" class="block text-sm font-medium text-gray-700">Categorias</label>
                    <input type="text" id="postCategory" name="category" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Publicar Post</button>
            </form>
        </div>
    </div>

    <script>
        const editProfileModal = document.getElementById('editProfileModal');
        const newPostModal = document.getElementById('newPostModal');

        const editProfileBtn = document.getElementById('editProfileBtn');
        const newPostBtn = document.getElementById('newPostBtn');
        const newPostBtnEmpty = document.getElementById('newPostBtnEmpty');

        const closeEditProfileModal = document.getElementById('closeEditProfileModal');
        const closeNewPostModal = document.getElementById('closeNewPostModal');

        if (editProfileBtn) {
            editProfileBtn.onclick = function() {
                editProfileModal.style.display = 'flex';
            }
        }

        if (newPostBtn) {
            newPostBtn.onclick = function() {
                newPostModal.style.display = 'flex';
            }
        }

        if (newPostBtnEmpty) {
            newPostBtnEmpty.onclick = function() {
                newPostModal.style.display = 'flex';
            }
        }

        if (closeEditProfileModal) {
            closeEditProfileModal.onclick = function() {
                editProfileModal.style.display = 'none';
            }
        }

        if (closeNewPostModal) {
            closeNewPostModal.onclick = function() {
                newPostModal.style.display = 'none';
            }
        }

        window.onclick = function(event) {
            if (event.target == editProfileModal) {
                editProfileModal.style.display = 'none';
            }
            if (event.target == newPostModal) {
                newPostModal.style.display = 'none';
            }
        }

        // Exemplo de dados de posts (substitua pela sua lógica de backend)
        // const posts = [
        //     { id: 1, title: 'Meu Primeiro Post', excerpt: 'Este é um resumo do meu primeiro post.', image: 'https://via.placeholder.com/150', category: 'Tecnologia', created_at: '2023-01-15', views: 120, comments_count: 5, likes_count: 20 },
        //     { id: 2, title: 'Dicas de Produtividade', excerpt: 'Aprenda a ser mais produtivo no seu dia a dia.', image: null, category: 'Produtividade', created_at: '2023-02-01', views: 80, comments_count: 2, likes_count: 15 },
        // ];

        // Você precisará passar a variável $posts do seu controlador Laravel para a view.
        // Exemplo no controlador:
        // public function profile()
        // {
        //     $user = Auth::user();
        //     $posts = $user->posts()->latest()->get(); // Supondo um relacionamento 'posts' no modelo User
        //     return view('profile', compact('posts'));
        // }
    </script>
</body>
</html>
