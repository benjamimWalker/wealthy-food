# PHP Challenge 20200916

## Introdução

## Instalação

Primeiro clone este repositório e configure seu arquivo .env.

```
git clone git@github.com:benjamimWalker/wealthy-food.git
cp .env.example .env
```
## Configuração
Suba o container. Se docker compose não funcionar, tente docker-compose.

```
docker compose up -d
```

Instale as dependências do composer.
```
docker compose exec app composer install
```

Execute as migrations iniciais.

```
docker compose exec app php artisan migrate
```

Execute o seeder para popular o banco de dados.

```
docker compose exec app php artisan db:seed
```

Não é necessário executar comando para o servidor php, uma vez que o container esteja de pé, basta acessar
```
http://localhost
```
na porta 80 mesmo.

## Testando

Você pode executar os testes com o comando.
```
docker compose exec app php artisan test
```

## CRON

Para iniciar o CRON, basta executar o comando
```
docker compose exec app php artisan schedule:work
```

## Documentação

Documentação da API pode ser acessada em
```
http://localhost/docs
```
