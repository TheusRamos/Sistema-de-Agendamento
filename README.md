Sistema de Agendamento de Consultas Médicas
- Objetivo
Este projeto é uma aplicação web desenvolvida para facilitar o agendamento de consultas médicas. O sistema permite que usuários se cadastrem, façam login e marquem consultas de diversas especialidades, enquanto o backend gerencia os dados de pacientes e agendamentos de forma segura e eficiente.

- Tecnologias Utilizadas
- Front-end: HTML, Tailwind CSS, JavaScript
- Back-end: PHP
- Banco de Dados: PostgreSQL

- Funcionalidades Principais
- Gerenciamento de Usuários
- Cadastro de Usuários: Novos usuários podem criar uma conta fornecendo nome completo, e-mail e senha.
- Validação de E-mail: O sistema impede o cadastro de e-mails que já existem na base de dados.
- Segurança de Senha: As senhas são armazenadas de forma segura no banco de dados utilizando password_hash.
- Login e Autenticação: Usuários cadastrados podem acessar o sistema através de uma página de login. O acesso é gerenciado por sessões PHP.
- Logout Seguro: Uma funcionalidade de "Sair" encerra a sessão do usuário de forma segura.

- Agendamento de Consultas
- Acesso Restrito: A página de agendamento só pode ser acessada por usuários autenticados.
- Formulário de Agendamento: Interface para o usuário preencher seus dados (nome, e-mail, telefone, CPF) e escolher a especialidade, a data e a hora da consulta.
- Gerenciamento de Pacientes: O sistema verifica se o paciente (identificado pelo CPF) já existe. Caso não exista, um novo registro é criado automaticamente.
- Confirmação de Agendamento: Após o agendamento, o usuário é redirecionado para uma página de sucesso que confirma os detalhes da consulta.
- Interface Intuitiva: O usuário tem a opção de realizar um novo agendamento ou sair do sistema após a confirmação.


- Como Executar

1. Clone o Repositório:

git clone <URL_DO_SEU_REPOSITORIO>
Servidor Local:

2. Utilize um ambiente de servidor local como XAMPP, WampServer ou Laragon.
Mova a pasta do projeto para o diretório raiz do seu servidor (ex: htdocs no XAMPP).

3. Banco de Dados:
Crie um banco de dados no PostgreSQL com o nome sistema_clinico.
Crie as tabelas necessárias (usuarios, pacientes, agendamentos). Você pode usar o seguinte SQL como base:
SQL

CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE pacientes (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    cpf VARCHAR(14) UNIQUE NOT NULL,
    email VARCHAR(255)
);

CREATE TABLE agendamentos (
    id SERIAL PRIMARY KEY,
    paciente_id INTEGER REFERENCES pacientes(id),
    consulta_id INTEGER NOT NULL, -- Assumindo que o ID se refere ao tipo de consulta
    data_consulta DATE NOT NULL,
    hora_consulta TIME NOT NULL
);

4. Configurar a Conexão:
Abra o arquivo Conexao.php.
Altere a variável $password para a senha do seu usuário do PostgreSQL.
PHP

$password = 'sua_senha'; // <-- COLOQUE SUA SENHA AQUI
Acessar a Aplicação:

Inicie os serviços do seu servidor local (Apache e PostgreSQL).
Abra seu navegador e acesse a aplicação. Comece pela página de cadastro ou login: http://localhost/nome_da_pasta/Cadastro.html ou http://localhost/nome_da_pasta/login.html.

- Estrutura de Arquivos
/
── Cadastro.html         
── Cadastro.php          
── login.html           
── login.php             
── AgendamentoPage.html 
── agendamento.php       
── agendamento_sucesso.html 
── logout.php            
── conexao.php           
── README.md             
