# API de rastreio de encomendas
---

Esse projeto de API de rastreio foi desenvolvido em `PHP >= 7.3` e `Laravel >= 8`, utilizando o `NGINX >= 1.16` como servidor web e `MySQL >= 5` como banco de dados.

### Documentação dos Endpoints da API
---

A documentação foi feita utilizando o `Postman` no link abaixo contém toda a documentação dos endpoints da API:

- https://www.getpostman.com/collections/b54fdae3f0edc6e6897f

### Containers do Docker
---

A aplicação foi desenvolvida sobre containers do `Docker`, segue a lista de containers que a aplicação possui:

- `tracking-api-php-fpm` -> `PHP FPM 7.4` + `Composer 1`.
- `tracking-api-nginx` -> `NGINX 1.16`.
- `tracking-api-mysql` -> `MySQL 5`.

### Como Configurar a Aplicação
---

Para configurar tudo que a aplicação precisa para funcionar, foi criado um `Shell Script` para que tudo seja configurado.
- Basta digitar `sh config.sh` e ele configurará tudo e no final gerará um `token` que será necessário para testar a aplicação.

A aplicação responde na porta `8000`, o `MySQL` na porta `3306` (Caso não tenha sido feita nenhuma alteração no `.env`). 
