<?php

namespace Agenda\Model\Collection;

use Agenda\Module;
use Zend\Http\Client as HttpClient;
use Zend\Http\PhpEnvironment\Response as HttpResponse;
use Zend\Http\Request;

/**
 *
 */
class Contactos
{
    protected $response;

    public function fetchAll()
    {
        return self::dataResponse('get');
    }

    public function addRow($row)
    {
        return self::dataResponse('create', $row);
    }

    private function dataResponse($action, $params = null)
    {
        $client = new HttpClient();
        $client->setAdapter('Zend\Http\Client\Adapter\Curl');
        $uri = Module::BASE_URL_API_REST . '/contacto';

        $client->setUri($uri);
        $client->setHeaders([
            'Accept'       => 'application/json',
            'Content-Type' => 'multipart/form-data',
        ]);

        switch ($action) {
            case 'get-list':
                $client->setMethod('GET');
                break;
            case 'create':
                $request = new Request();
                $request->setUri($uri);
                $request->setMethod('POST');
                foreach ($params as $key => $value) {
                    $request->getPost()->set($key, $value);
                }

                $response = $client->send($request);

                if (!$response->isSuccess()) {
                    $message = $response->getStatusCode() . ': ' . $response->getReasonPhrase();

                    if ($response->getStatusCode() !== '404') {
                        $response = $this->getResponse();
                        $response->setContent($message);
                        return ['Error' => $message];
                    }else
                    {
                    	return ['Msj' => 'OK'];
                    }
                }

                return ['Msj' => 'OK'];
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
