## API de Contatos

Este é um repositório que contém uma API para gerenciar contatos de uma pessoa. A API permite a criação, leitura, atualização e exclusão de contatos.

## Tecnologias Utilizadas
Laravel: um framework PHP para desenvolvimento web.

Docker: para criar e gerenciar containers.

## Instalação
Para executar a API localmente, siga estas etapas:

1. Certifique-se de ter o Docker instalado em sua máquina.
2. Clone este repositório:
    git clone https://github.com/seu-usuario/api-contatos.git
3. Navegue até o diretório do projeto:
    cd api-contatos
4. Crie um arquivo .env baseado no .env.example:
    cp .env.example .env
5. Execute os containers Docker:
    docker-compose up -d
6. Instale as dependências do PHP com o Composer:
    docker-compose exec app composer install
7. Gere a chave de aplicativo do Laravel:
    docker-compose exec app php artisan key:generate
8. Execute as migrações do banco de dados:
    docker-compose exec app php artisan migrate
9. A API estará acessível em http://localhost:8000.

## Uso

Você pode usar qualquer cliente HTTP para interagir com a API. Aqui estão alguns exemplos usando o cURL:

1. Criar um contato:
    curl -X POST -H "Content-Type: application/json" -d '{"name":"Teste 1","email":"teste1@example.com","phone":"123456789"}' http://localhost:8000/api/contacts

2. Listar todos os contatos:
    curl http://localhost:8000/api/contacts

3. Atualizar um contato:
curl -X PUT -H "Content-Type: application/json" -d '{"name":"Teste 2"}' http://localhost:8000/api/contacts/1

4. Excluir um contato:
    curl -X DELETE http://localhost:8000/api/contacts/1

