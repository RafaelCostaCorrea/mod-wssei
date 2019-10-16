<?
require_once dirname(__FILE__).'/../../../SEI.php';

class MdWsSeiNotificacaoRN extends InfraRN {

    protected function inicializarObjInfraIBanco(){
        return BancoSEI::getInstance();
    }

    /**
     * M�todo que realiza a notifica��o de um usu�rio
     * @param MdWsSeiNotificacaoDTO $notificacaoDTO
     */
    public function notificar(MdWsSeiNotificacaoDTO $notificacaoDTO)
    {
        $requestHeader = array(
            'Authorization: '.$notificacaoDTO->getStrChaveAutorizacao(),
            'Content-Type: application/json',
            'charset: utf-8'
        );
        $ch = curl_init($notificacaoDTO->getStrUrlServicoNotificacao());
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            $requestHeader
        );

        $requestBody = array(
            'idApp' => $notificacaoDTO->getNumIdApp(),
            'stSaveMessage' => 0,
            'dsMessage' => $notificacaoDTO->getStrMensagem(),
            'dsResume' => $notificacaoDTO->getStrResumo(),
            'dsTitle' => $notificacaoDTO->getStrTitulo(),
            'dsIdentities' => $notificacaoDTO->getStrIdentificadorUsuario(),
            'idUser' => "1",
            'stNotify' => $notificacaoDTO->getBolNotificar() ? 1 : 0
        );

        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            json_encode(MdWsSeiRest::dataToUtf8($requestBody))
        );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $response = curl_exec($ch);
        if(!curl_errno($ch)){
            $info = curl_getinfo($ch);
            if($info['http_code'] == 200){
                return true;
            }
        }
        return false;
    }


}