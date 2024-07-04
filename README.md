Projeto de Monitoramento de Incubadora de Ovos
Este projeto é uma aplicação full-stack desenvolvida para monitorar uma incubadora de ovos. Ele utiliza um ESP32 para coletar dados de telemetria, que são então enviados para um servidor e exibidos em um painel de controle na web.

Tela de Login
A aplicação possui uma tela de login, implementada no arquivo login.php. Esta tela é responsável por autenticar o usuário e direcioná-lo para o painel de controle.

Imagem da tela de login

Tela de Telemetria
A telemetria do ESP32 é exibida em um painel de controle, implementado nos arquivos dashboard.html e dashboard.php. Esta tela exibe gráficos de temperatura, umidade e outros dados relevantes coletados pelo ESP32.

Imagem da tela de telemetria

Os dados são obtidos do servidor por meio de uma chamada à API implementada no arquivo get_data.php, que consulta o banco de dados e retorna os dados em formato JSON.

Os dados recebidos do ESP32 são armazenados no banco de dados pelo script receive_data.php, que recebe os dados via POST e insere no banco de dados.

Como usar
Para usar esta aplicação, você precisa ter um servidor PHP e um banco de dados MySQL. Configure o banco de dados e atualize as credenciais de conexão nos arquivos PHP conforme necessário.

Depois de configurar o servidor e o banco de dados, você pode acessar a tela de login no navegador para começar a usar a aplicação.

Conclusão
Este projeto é uma solução completa para monitorar uma incubadora de ovos. Ele fornece uma interface de usuário amigável para visualizar os dados de telemetria do ESP32 e gerenciar a incubadora de ovos.

Para mais informações, consulte a documentação do código ou entre em contato com o desenvolvedor.
