<?php

namespace Agenda\Model\Collection;

use Agenda\Module;
use Zend\Http\Client as HttpClient;
use Zend\Http\PhpEnvironment\Response as HttpResponse;

/**
 *
 */
class Categorias
{
    protected $response;

    public function fetchAll()
    {
        return self::dataResponse('get');
    }

    public function getAll_Id_Nombre()
    {
        $arr = [];
        foreach (self::dataResponse('get') as $key => $value) {
            $tmp[((array) $value)['idCategoria']] = ((array) $value)['nombre'];
            $arr += $tmp;
        }

        return $arr;
    }

    private function dataResponse($action, $params = null)
    {
        $client = new HttpClient();
        $client->setAdapter('Zend\Http\Client\Adapter\Curl');

        $client->setUri(Module::BASE_URL_API_REST . '/categoria');
        $client->setHeaders([
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        ]);

        switch ($action) {
            case 'get-list':
                $client->setMethod('GET');
                break;
            case 'create':
                $client->setMethod('POST');
                $client->setParameterPOST($params);
                break;
        }

        $response = $client->send();

        if (!$response->isSuccess()) {
            $message = $response->getStatusCode() . ': ' . $response->getReasonPhrase();

            $response = $this->getResponse();
            $response->setContent($message);
            return ['Error' => $message];
        }
        $body = $response->getBody();

        $response = $this->getResponse();
        $response->setContent($body);

        return json_decode($body);
    }

    private function getResponse()
    {
        if (!$this->response) {
            $this->response = new HttpResponse();
        }

        return $this->response;
    }
}
