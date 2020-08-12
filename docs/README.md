# Documenta��o dos Servi�os

## Postman

Aqui estamos disponibilizando uma breve documenta��o dos servi�os dispon�veis na API.

Para visualiz�-la basta instalar o utilit�rio  [Postman](https://www.postman.com/) .

Esse utilit�rio conta com uma vers�o gratuita, e elenca os servi�os da nossa API em chamadas REST. 

Serve tanto para documentar os servi�os e par�metros, quanto ir� auxiliar desenvolvedores e integradores de solu��o a constru�rem de forma mais �gil as suas solu��es particulares.

D�vidas com o utilit�rio Postman bem como sua filosofia de uso podem ser sanadas na pr�pria comunidade do utilit�rio.

## Arquivos Postman

### Download do Projeto Postman

** caminhos relativos no reposit�rio do github: **

- docs/postman/MD-WSSEI.postman_collection.json
- docs/postman/SEI-Nuvem.postman_environment.json

Breve explica��o sobre os arquivos, abaixo.

### Postman da API - mod_wssei

docs/postman/MD-WSSEI.postman_collection.json

Projeto Postman elaborado pelos desenvolvedores da API para facilitar o uso por terceiros.

Os servi�os est�o separados por categorias e em cada categoria existe um ou mais servi�os. Para cada servi�o temos:
- nome do servi�o
- descri��o dos servi�os
- par�metros esperados
- tipos dos par�metros esperados
- url de chamada do servi�o
- tipo de chamada do servi�o (GET - Post, etc)
- exemplo de chamada
- a ferramenta tamb�m mostra/permite, n�o exaustivamente:
	- exemplos da chamada do servi�o em dezenas de linguagens de programa��o diferentes
	- executar de fato a chamada e observar o retorno em v�rias formas de sa�da (html, raw, json, etc)
	- construir o seu workflow pessoal de algum caso de teste: por exemplo, logar no SEI, cadastrar um processo e incluir documento nesta ordem


### Environment para Uso

docs/postman/SEI-Nuvem.postman_environment.json

O arquivo de environment serve para informar os par�metros referentes ao ambiente. Inicialmente, voc� ir� alterar o campo "baseurl" que indica onde encontra-se o SEI. 

O par�metro "token" tamb�m � reaproveitado em outras chamadas e deve ser preenchido assim que voc� receber o token ap�s rodar o servi�o de autentica��o.


## Testes da API

Temos tamb�m a disposi��o um cen�rio de teste completo tomando por base um SEI zerado iniciando com a base de refer�ncia do poder executivo.

Maiores detalhes acesse a �rea de Teste nesse projeto clicando aqui [Testes da API](../testes/README.md)

---
[Retornar ao In�cio](../README.md)