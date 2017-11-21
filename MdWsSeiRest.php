<?

/**
 * Eduardo Romao
 *
 * 26/03/2017 - criado por ejushiro@gmail.com
 *
 */
class MdWsSeiRest extends SeiIntegracao
{
    const NOME_MODULO = "MdWsSeiRest";

    /**
     * Converte os dados para UTF8 para ser compativel com json_encode
     * @param $item
     * @return array|string
     */
    public static function dataToUtf8($item)
    {

        if (is_array($item)) {
            $itemArr = $item;
        } else if (is_object($item)) {
            $itemArr = get_object_vars($item);
        } else if (is_bool($item)) {
            return $item;
        } else {
            return utf8_encode(htmlspecialchars($item));
        }
        $response = array();
        foreach ($itemArr as $key => $val) {
            $response[$key] = MdWsSeiRest::dataToUtf8($val);
        }
        return $response;
    }

    public static function dataToIso88591($item)
    {
        if (is_array($item)) {
            $itemArr = $item;
        } else if (is_object($item)) {
            $itemArr = get_object_vars($item);
        } else if (is_bool($item)) {
            return $item;
        } else {
            return mb_convert_encoding($item, 'ISO-8859-1');
        }
        $response = array();
        foreach ($itemArr as $key => $val) {
            $response[$key] = MdWsSeiRest::dataToIso88591($val);
        }
        return $response;
    }

    /**
     * Formata o retorno da mensagem para o padr�o do controlador de servi�os REST
     * @param null $mensagem
     * @param null $result
     * @param null $total
     * @param bool $jsonEncode - Se alterado para true retornar� como json_encode
     * @return array
     */
    public static function formataRetornoSucessoREST($mensagem = null, $result = null, $total = null, $jsonEncode = false)
    {
        $data = array();
        $data['sucesso'] = true;
        if ($mensagem) {
            $data['mensagem'] = $mensagem;
        }
        if ($result) {
            $data['data'] = $result;
        }
        if (!is_null($total)) {
            $data['total'] = $total;
        }
        $retorno = MdWsSeiRest::dataToUtf8($data);

        return !$jsonEncode ? $retorno : json_encode($retorno);
    }

    /**
     * Formata o retorno da mensagem para o padr�o do controlador de servi�os REST
     * @param Exception $e
     * @return array
     */
    public static function formataRetornoErroREST(Exception $e)
    {
        $mensagem = $e->getMessage();
        if ($e instanceof InfraException) {
            if (!$e->getStrDescricao()) {
                /** @var InfraValidacaoDTO $validacaoDTO */
                if (count($e->getArrObjInfraValidacao()) == 1) {
                    $mensagem = $e->getArrObjInfraValidacao()[0]->getStrDescricao();
                } else {
                    foreach ($e->getArrObjInfraValidacao() as $validacaoDTO) {
                        $mensagem[] = $validacaoDTO->getStrDescricao();
                    }
                }
            } else {
                $mensagem = $e->getStrDescricao();
            }

        }
        return MdWsSeiRest::dataToUtf8(
            array(
                "sucesso" => false,
                "mensagem" => $mensagem,
                "exception" => $e
            )
        );
    }

    public function __construct()
    {
    }

    /**
     * M�todo que verifica se o m�dulo esta ativo nas configura��es do SEI
     */
    public static function moduloAtivo()
    {
        global $SEI_MODULOS;
        $ativo = false;
        foreach ($SEI_MODULOS as $modulo) {
            if ($modulo instanceof self) {
                $ativo = true;
                break;
            }
        }
        return $ativo;
    }

    /**
     * Retorna se � compativel com a vers�o atual do SEI instalado
     * @param $strVersaoSEI
     * @return bool
     */
    public function verificaCompatibilidade($strVersaoSEI)
    {
        if (substr($strVersaoSEI, 0, 2) != '3.') {
            return false;
        }
        return true;
    }

    public function getNome()
    {
        return 'M�dulo de provisionamento de servi�os REST do SEI';
    }

    public function getVersao()
    {
        return '0.7.8';
    }

    public function getInstituicao()
    {
        return 'wssei';
    }

    public function inicializar($strVersaoSEI)
    {
        if (!$this->verificaCompatibilidade($strVersaoSEI)) {
            die('M�dulo "' . $this->getNome() . '" (' . $this->getVersao() . ') n�o e compat�vel com esta vers�o do SEI (' . $strVersaoSEI . ').');
        }
    }

    public function montarBotaoControleProcessos()
    {
        return array();
    }

    public function montarIconeControleProcessos($arrObjProcedimentoAPI)
    {
        return array();
    }

    public function montarIconeAcompanhamentoEspecial($arrObjProcedimentoAPI)
    {
        return array();
    }

    public function montarIconeProcesso(ProcedimentoAPI $objProcedimentoAPI)
    {
        return array();
    }

    public function montarBotaoProcesso(ProcedimentoAPI $objProcedimentoAPI)
    {
        return array();
    }

    public function montarIconeDocumento(ProcedimentoAPI $objProcedimentoAPI, $arrObjDocumentoAPI)
    {
        return array();
    }

    public function montarBotaoDocumento(ProcedimentoAPI $objProcedimentoAPI, $arrObjDocumentoAPI)
    {
        return array();
    }

    public function alterarIconeArvoreDocumento(ProcedimentoAPI $objProcedimentoAPI, $arrObjDocumentoAPI)
    {
        return array();
    }

    public function montarMenuPublicacoes()
    {
        return array();
    }

    public function montarMenuUsuarioExterno()
    {
        return array();
    }

    public function montarAcaoControleAcessoExterno($arrObjAcessoExternoAPI)
    {
        return array();
    }

    public function montarAcaoDocumentoAcessoExternoAutorizado($arrObjDocumentoAPI)
    {
        return array();
    }

    public function montarAcaoProcessoAnexadoAcessoExternoAutorizado($arrObjProcedimentoAPI)
    {
        return array();
    }

    public function montarBotaoAcessoExternoAutorizado(ProcedimentoAPI $objProcedimentoAPI)
    {
        return array();
    }

    public function montarBotaoControleAcessoExterno()
    {
        return array();
    }

    public function processarControlador($strAcao)
    {
        return false;
    }

    public function processarControladorAjax($strAcao)
    {
        return null;
    }

    public function processarControladorPublicacoes($strAcao)
    {
        return false;
    }

    public function processarControladorExterno($strAcao)
    {
        return false;
    }

    public function verificarAcessoProtocolo($arrObjProcedimentoAPI, $arrObjDocumentoAPI)
    {
        return null;
    }

    public function verificarAcessoProtocoloExterno($arrObjProcedimentoAPI, $arrObjDocumentoAPI)
    {
        return null;
    }

    public function montarMensagemProcesso(ProcedimentoAPI $objProcedimentoAPI)
    {
        return null;
    }

    public function adicionarElementoMenu()
    {
        $nomeArquivo = 'QRCODE_'
            . self::NOME_MODULO
            . "_"
            . SessaoSEI::getInstance()->getNumIdOrgaoUsuario()
            . "_"
            . SessaoSEI::getInstance()->getNumIdContextoUsuario()
            . "_"
            . self::getVersao();
        $html = CacheSEI::getInstance()->getAtributo($nomeArquivo);

        if ($html) {
            return $html;
        }

        $html = $this->montaCorpoHTMLQRCode($nomeArquivo);
        CacheSEI::getInstance()->setAtributo($nomeArquivo, $html, CacheSEI::getInstance()->getNumTempo());

        return $html;
    }

    /**
     * Fun��o que monta o html do QRCode para o menu lateral do SEI
     * @param $nomeArquivo
     * @return string
     */
    private function montaCorpoHTMLQRCode($nomeArquivo)
    {
        $htmlQrCode = '';
        $caminhoAtual = explode("/sei/web", __DIR__);
        $urlSEI = ConfiguracaoSEI::getInstance()->getValor('SEI', 'URL')
            . $caminhoAtual[1]
            . '/controlador_ws.php/api/v1';
        $conteudoQrCode = 'url: ' . $urlSEI
            . ';'
            . 'siglaorgao: ' . SessaoSEI::getInstance()->getStrSiglaOrgaoUsuario()
            . ';'
            . 'orgao: ' . SessaoSEI::getInstance()->getNumIdOrgaoUsuario()
            . ';'
            . 'contexto: ' . SessaoSEI::getInstance()->getNumIdContextoUsuario();
        $caminhoFisicoQrCode = DIR_SEI_TEMP . '/' . $nomeArquivo;

        InfraQRCode::gerar($conteudoQrCode, $caminhoFisicoQrCode, 'L', 2, 1);

        $infraException = new InfraException();
        if (!file_exists($caminhoFisicoQrCode)) {
            $infraException->lancarValidacao('Arquivo do QRCode n�o encontrado.');
        }
        if (filesize($caminhoFisicoQrCode) == 0) {
            $infraException->lancarValidacao('Arquivo do QRCode vazio.');
        }
        if (($binQrCode = file_get_contents($caminhoFisicoQrCode)) === false) {
            $infraException->lancarValidacao('N�o foi poss�vel ler o arquivo do QRCode.');
        }

        $htmlQrCode .= '<div style="font-size: 12px; text-align: center;">';
        $htmlQrCode .= '<div style="height: 12px; margin-bottom: 22px; background-color: #01A5DA; border-bottom: 4px solid #AFCF2C;"></div>';
        $htmlQrCode .= '<p style="text-align: left; margin: 5px;">';
        $htmlQrCode .= '<strong style="font-weight: bolder">';
        $htmlQrCode .= 'Acesse as lojas App Store ou Google Play e instale o aplicativo do SEI! no seu celular.';
        $htmlQrCode .= '</strong>';
        $htmlQrCode .= '</p>';
        $htmlQrCode .= '<p style="text-align: left; margin: 15px 5px 5px 5px;">';
        $htmlQrCode .= '<strong style="font-weight: bolder">';
        $htmlQrCode .= 'Abra o aplicativo do SEI! e fa�a a leitura do c�digo abaixo para sincroniz�-lo com sua conta.';
        $htmlQrCode .= '</strong>';
        $htmlQrCode .= '</p>';
        $htmlQrCode .= '<img style="margin: 20px auto 6px;" align="center" src="data:image/png;base64, '
            . base64_encode($binQrCode) . '" />';
        $htmlQrCode .= '</div>';

        return $htmlQrCode;
    }
}

?>