# Aplicativo SEI - Orienta��o para Instala��o


### Primeira Etapa: Instalar o m�dulo de integra��o no servidor de aplica��o do SEI (a partir da vers�o 3.0.11)

1. Baixar a �ltima vers�o do m�dulo wssei no endere�o: 
2. [https://github.com/spbgovbr/mod-wssei](https://github.com/spbgovbr/mod-wssei)

3. Copiar a pasta contendo o m�dulo wssei para o diret�rio de m�dulos do SEI, localizado em:

   ```
   [DIRETORIO_RAIZ_INSTALA��O]/sei/web/modulos
   ```

   Certifique-se de que a pasta contenha os arquivos do m�dulo.  Nome padr�o **mod-wssei**

4. Adicionar ao arquivo de configura��o do sistema (ConfiguracaoSEI.php), na chave M�dulos, a refer�ncia para a pasta do m�dulo copiado no passo anterior. Utilizando a chave de identifica��o MdWsSeiRest.

   O sistema procura pelo m�dulo a partir da pasta de m�dulos do SEI.

   Exemplo:
   ```
   'SEI' => ARRAY(
                ( ...)
                'Modulos' => array('MdWsSeiRest' => 'mod-wssei/')
        ),
   ```

5. Adicionar ao arquivo de configura��o do sistema (ConfiguracaoSEI.php), no Array de configura��es, a chave com as configura��es abaixo (servi�o de envio de notifica��es):

   Exemplo:
   ```bash
   public function getArrConfiguracoes(){
       return array(
           'SEI' => array(
               (...)
           ),
           'WSSEI' => array(
               'UrlServicoNotificacao' => '{URL do servi�o de notifica��o}',
               'IdApp' => '{ID do app registrado no servi�o de notifica��o}',
               'ChaveAutorizacao' => '{Chave de autoriza��o do servi�o de notifica��o}'
           ),

           (...)
   ```

   **Importante:**
   * para ativar as notifica��es, ser� necess�rio informar o endere�o/credenciais do servi�o push de mensagens
   * pode usar o servi�o push disponibilizado pelo Minist�rio da Economia. Para tanto, abra
chamado na Central de Atendimento do  PEN([https://portaldeservicos.planejamento.gov.br/citsmart/login/login.load](https://www.google.com/url?q=https://portaldeservicos.planejamento.gov.br/citsmart/login/login.load&sa=D&source=hangouts&ust=1576333188310000&usg=AFQjCNFo4ErHNsg7p65YJEJiKLIjdfMM5Q)). **A categoria do chamado � PEN - WSSEI - INSTALA��O.**
   * verifique se o n� do SEI respons�vel por executar os agendamentos tenha acesso a URL/Porta acima

5. Realizar o procedimento de verifica��o e atualiza��o de scripts de banco de dados conforme abaixo:

   * Mover o arquivo de instala��o do m�dulo no SEI sei_atualizar_versao_modulo_wssei.php para a pasta [DIRETORIO_RAIZ_INSTALA��O]/sei/scripts

   * Executar o script **sei_atualizar_versao_modulo_wssei.php** para inser��o de dados no banco do SEI referente ao m�dulo

      ```bash
      php -c /etc/php.ini       [DIRETORIO_RAIZ_INSTALA��O]/sei/scripts/sei_atualizar_versao_modulo_wssei.php
      ```
   * importante: o usu�rio de banco, no momento da execu��o, dever� ser capaz de criar tabelas

6. Necess�rio habilitar/instalar a extens�o PHP &quot;mbstring&quot;. Verificar se todos os requisitos para utiliza��o do SEI 3.0 est�o sendo atendidos, entre eles, a vers�oo do PHP 5.6

7. Verificar se o m�dulo foi carregado por meio do menu Infra/M�dulos do SEI

8. Verificar se o banco de dados foi corretamente atualizado por meio do menu Infra/Par�metros do SEI (chave VERSAO_MODULO_WSSEI)

9. Verificar se o agendamento para as notifica��es foi corretamente criado (tela Infra/Agendamentos):
   ```bash
   MdWsSeiAgendamentoRN :: notificacaoAtividades
   ```

10. Verificar se o QR Code foi criado na parte inferior do menu lateral esquerdo do SEI. Esse c�digo cont�m os dados de acesso ao ambiente do �rg�o


### Segunda Etapa: Instalar o aplicativo no telefone celular

1. No telefone celular, acessar a loja Google Play ou App Store e realizar a instala��o do aplicativo do SEI



### Terceira Etapa: Realizar a leitura do QR Code

1. No telefone celular, abrir o aplicativo do SEI

2. Acessar a op��o &quot;Trocar �rg�o&quot; e, em seguida, a op��o &quot;Ler C�digo&quot;

3. Fazer a leitura do QR Code no SEI _web_ do seu �rg�o com a c�mera do telefone celular

4. Informar o usu�rio e a senha do SEI, e iniciar o uso do aplicativo

---
[Retornar ao In�cio](README.md)