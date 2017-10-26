# Cadastro de Clientes
Projeto de criação de tarefas utilizando o zendframework PHP com persistência doctrine, base de dados mysql, bootstrap e etc..

Foco do projeto - > Listagem, Inclusão, Edição e Exclusão de Clientes.

Pasta dos sources do projeto module/Application 


# Listagem de Clientes 
Controller - > module/Application/src/Application/Controller/IndexController.php
View - > module/Application/view/application/index/index.phtml

# Adição de Clientes 
Controller - > module/Application/src/Application/Controller/IndexController.php
View - > module/Application/view/application/index/adicionar.phtml

# Edição de Clientes 
Controller - > module/Application/src/Application/Controller/IndexController.php
View - > module/Application/view/application/index/editar.phtml

# Para instalação da tabela de clientes é só executar o script cliente.sql
Configuração de acesso ao mysql
Doctrine - > /config/autoload/doctrine_orm.local.php