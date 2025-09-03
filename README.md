# Blog Laravel

Este é um projeto de blog desenvolvido com o framework Laravel. O objetivo é fornecer uma plataforma simples e moderna para publicação de posts, gerenciamento de usuários e personalização de perfis.

## Funcionalidades

- Cadastro e autenticação de usuários
- Perfil de usuário com informações e posts
- Criação, edição e exclusão de posts
- Interface responsiva utilizando Tailwind CSS

## Requisitos

- PHP >= 8.2
- Composer
- SQLite (ou outro banco de dados suportado pelo Laravel)
- Node.js e npm (para assets front-end, opcional)

## Instalação

1. **Clone o repositório:**
   ```sh
   git clone https://github.com/seu-usuario/blog-laravel.git
   cd blog-laravel
   ```

2. **Instale as dependências PHP:**
   ```sh
   composer install
   ```

3. **Copie o arquivo de ambiente e gere a chave da aplicação:**
   ```sh
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure o banco de dados:**
   - Por padrão, o projeto utiliza SQLite. O arquivo `database/database.sqlite` já está incluído.
   - Caso queira usar outro banco, edite as variáveis no arquivo `.env`.

5. **Execute as migrações:**
   ```sh
   php artisan migrate
   ```

6. **(Opcional) Instale as dependências front-end e compile os assets:**
   ```sh
   npm install
   npm run build
   ```

7. **Inicie o servidor de desenvolvimento:**
   ```sh
   php artisan serve
   ```

8. **Acesse o projeto:**
   - Abra [http://localhost:8000](http://localhost:8000) no navegador.

## Estrutura do Projeto

- `app/` - Código principal da aplicação (Models, Http, Providers)
- `resources/views/` - Templates Blade (ex: [resources/views/User/profile.blade.php](resources/views/User/profile.blade.php))
- `routes/` - Definição das rotas web e console
- `database/` - Migrations, seeders e arquivo SQLite
- `public/` - Arquivos públicos (index.php, assets)
- `config/` - Arquivos de configuração

## Scripts Úteis

- `composer test` - Executa os testes automatizados
- `php artisan migrate:fresh --seed` - Refaz o banco e executa os seeders

## Licença

Este projeto está licenciado sob a licença MIT.

---

Desenvolvido com Laravel ❤️
