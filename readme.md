# Instruções de uso

## Pré-requisitos

Para usar o sistema, você precisa ter instalado PHP, MySQL, composer e node.js.

## Instruções de back-end

1. Configure o arquivo `.env` para que esteja o banco de dados, porta, senha e usuário adequado ao MySQL que você deseja usar.
2. Abra um terminal de linha de comando no diretório `backend` e use os seguintes comandos:

   1. `composer install` para instalar as dependências do back-end.
   2. `php artisan migrate --seed` para instalar o banco de dados e os dados de teste.
   3. `php artisan storage:link` para indexar o diretório de imagens na pasta publica
   4. `php artisan serve` para ligar o servidor.

## Instruções de front-end

1. Abra um terminal de linha de comando no diretório `frontend` e use os seguintes comandos:

   1. `npm install` para instalar as dependências do front-end.
   2. `npm run dev` para iniciar o servidor front-end.
   3. Abra o navegador em `http://localhost:5173` para executar a página.

## Autenticação

* Para autenticação, use o e-mail `test@example.com` com a senha `password`.
* Para usar o administrador, acesse `http://localhost:5173/admin`. O e-mail do usuário administrador é `test_admin@example.com`.