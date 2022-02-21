# Clickbeard 
Repositório da resolução do teste Click Ativo

Dividi a aplicação em dois módulos (separados por pastas).

A pasta barber corresponde ao módulo administrativo da aplicação.
A pasta app corresponde ao módulo por onde os clientes irão realizar seus agendamento e outras funcionalidades pedidas.

Para instalar a aplicação em sua máquina local ou servidor web, basta importar o arquivo de banco de dados (.sql) disponibilizado na raiz do repositório.
Alterar os seguintes arquivos para que funcione:
  <h4>/barber</h4>
  <ul>
    <li>barber > app > core > Database.php (editar a linha 9 e colocar suas informações de banco de dados</li>
    <li>barber > app > index.php (editar a linha 4 e colocar suas informaçõs de servidor | URL_BASE)</li>
    <li>barber > app > public > js > app.js ( editar linha 5 e 7 e colocar colocar suas informaçõs de servidor | URL_BASE)</li>
  </ul>
  <h4>/app/</h4>
  <ul>
    <li>app > app > core > Database.php (editar a linha 9 e colocar suas informações de banco de dados</li>
    <li>app > app > index.php (editar a linha 4 e colocar suas informaçõs de servidor | URL_BASE)</li>
    <li>app > app > public > js > app.js ( editar linha 5 e 7 e colocar colocar suas informaçõs de servidor | URL_BASE)</li>
  </ul>

  # Demo da aplicação (subindo para o servidor....)
  
  Email de teste (ja inserido no banco) para o painel administrativo: admin@email.com  | Senha: 123456
