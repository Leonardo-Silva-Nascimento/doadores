# Projeto - Ambiente Local

Este documento descreve as etapas necessárias para configurar e executar o ambiente local do projeto.

## 1. Configuração do Banco de Dados

### 1.1. Editar o arquivo `conf.php`

O primeiro passo é configurar as credenciais de acesso ao banco de dados no arquivo `conf.php`.

Abra o arquivo e insira suas credenciais da seguinte forma:

```php
$host = "localhost";
$dbname = "dbname";
$username = "username";
$password = "password";
```

Certifique-se de substituir os valores pelo seu host, nome de banco de dados, usuário e senha corretos.

### 1.2. Executar o Dump SQL

Após configurar as credenciais, execute o arquivo `dump.sql` no seu banco de dados para criar a estrutura necessária.

Alternativamente, você pode acessar a rota `localhost/setup.php` para que o sistema configure o banco automaticamente.

## 2. Iniciar o Servidor Local

### 2.1. Executar o Frontend

Agora, para rodar o frontend do projeto, execute o seguinte comando no terminal:

```bash
php -S localhost:8000
```

Isso iniciará um servidor PHP embutido na porta `8000`. Você pode acessar a aplicação através do navegador, acessando a URL `http://localhost:8000`.

## 3. Considerações Finais

- Certifique-se de que o seu ambiente local tenha o PHP instalado.
- Caso tenha problemas ao configurar o banco de dados ou iniciar o servidor, verifique se as credenciais estão corretas e se o banco foi configurado corretamente.
- Para mais informações sobre o projeto ou ajuda com a configuração, consulte a documentação adicional ou entre em contato com a equipe de desenvolvimento.


# 2. Exercício de Lógica

para acessa-lo e ver a resposta basta acessar a rota `localhost/teste_logica.php`