<?php

namespace Agenda\Model;

use Agenda\Module;
use Zend\Http\Client as HttpClient;
use Zend\Http\PhpEnvironment\Response as HttpResponse;
use Zend\Http\Request;

/**
 *
 */
class DataOperator
{
    protected $response;

    public function dataAction($entity, $action, $params = null)
    {
        $client = new HttpClient();
        $client->setAdapter('Zend\Http\Client\Adapter\Curl');
        $uri = Module::BASE_URL_API_REST . '/' . $entity;

        $client->setUri($uri);
        $client->setHeaders([
            'Accept'       => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);

        $request = new Request();
        $request->setUri($uri);

        switch ($action) {
            case 'getById':
                $client->setUri($uri . '/' . $params['id']);

                $response = $client->send();
                break;
            case 'create':
                $request->setMethod('POST');

                foreach ($params as $key => $value) {
                    $request->getPost()->set($key, $value);
                }

                $response = $client->send($request);
                break;
            case 'update':
                $request->setMethod('PUT');
                foreach ($params as $key => $value) {
                    if (strtolower($key) === ('id'.$entity)) {
                        $request->setUri($uri . '/' . $value);
                    }
                    $request->getPost()->set($key, $value);
                }
                
                $response = $client->send($request);
                break;
            case 'delete':
                $request->setMethod('DELETE');
                $request->setUri($uri . '/' . $params['id']);

                $response = $client->send($request);
                break;
            default:
                $response = $client->send();
                break;
        }

        if (!$response->isSuccess()) {
            $message = $response->getStatusCode() . ': ' . $response->getReasonPhrase();
            $errorCode = $response->getStatusCode();
            if ($errorCode <> '404' && $errorCode <> '406') {
                $response = $this->getResponse();
                $response->setContent($message);
                return ['Error' => $message];
            } else {
                return ['Msj' => 'OK'];
            }
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
