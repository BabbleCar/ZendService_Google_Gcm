<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @category  ZendService
 * @package   ZendService_Google\Gcm
 */
namespace ZendService\Google\Gcm;

use ZendService\Google\Exception;
use Zend\Http\Client as HttpClient;
use Zend\Json\Json;

/**
 * Google Cloud Messaging Client
 * This class allows the ability to send out messages
 * through the Google Cloud Messaging API.
 *
 * @category ZendService
 * @package ZendService_Google
 * @subpackage Gcm
 */
class Client
{

    /**
     * @const string Server URI
     */
    const SERVER_URI = 'https://gcm-http.googleapis.com/gcm/send';

    /**
     * @const string Server URI DEVICE GROUP
     */
    const SERVER_URI_DEVICE_GROUP = 'https://android.googleapis.com/gcm/notification';

    /**
     *
     * @var Zend\Http\Client
     */
    protected $httpClient;

    /**
     *
     * @var string
     */
    protected $apiKey;

    /**
     *
     * @var string
     */
    protected $senderId;

    /**
     * Get API Key
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set API Key
     *
     * @param string $apiKey            
     * @return Client
     * @throws InvalidArgumentException
     */
    public function setApiKey($apiKey)
    {
        if (! is_string($apiKey) || empty($apiKey)) {
            throw new Exception\InvalidArgumentException('The api key must be a string and not empty');
        }
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * Get SENDER id
     *
     * @return string
     */
    public function getSenderId()
    {
        return $this->senderId;
    }

    /**
     * Set SENDER id
     *
     * @param string $senderId            
     * @return Client
     * @throws InvalidArgumentException
     */
    public function setSenderId($senderId)
    {
        if (! is_string($senderId) || empty($senderId)) {
            throw new Exception\InvalidArgumentException('The sender id key must be a string and not empty');
        }
        $this->senderId = $senderId;
        return $this;
    }

    /**
     * Get HTTP Client
     *
     * @return Zend\Http\Client
     */
    public function getHttpClient()
    {
        if (! $this->httpClient) {
            $this->httpClient = new HttpClient();
            $this->httpClient->setOptions(array('strictredirects' => true));
        }
        return $this->httpClient;
    }

    /**
     * Set HTTP Client
     *
     * @param
     *            Zend\Http\Client
     * @return Client
     */
    public function setHttpClient(HttpClient $http)
    {
        $this->httpClient = $http;
        return $this;
    }

    /**
     * Send Message
     *
     * @param Mesage $message            
     * @return Response
     * @throws Exception\RuntimeException
     */
    public function send(Message $message)
    {
        return new Response($this->_send($message, self::SERVER_URI), $message);
    }
    
    /**
     * Send Device Group
     *
     * @param DeviceGroup $deviceGroup
     * @return array
     * @throws Exception\RuntimeException
     */
    public function sendDeviceGroup(DeviceGroup $deviceGroup)
    {
        return $this->_send($deviceGroup, self::SERVER_URI_DEVICE_GROUP);
    }

    private function _send($obj, $uri)
    {
        $client = $this->getHttpClient();
        $client->setUri($uri);
        $headers = $client->getRequest()->getHeaders();
        $headers->addHeaderLine('Authorization', 'key=' . $this->getApiKey());
        if ($sender_id = $this->getSenderId()) {
            $headers->addHeaderLine('project_id', $sender_id);
        }
        
        $response = $client->setHeaders($headers)
            ->setMethod('POST')
            ->setRawBody($obj->toJson())
            ->setEncType('application/json')
            ->send();

        switch ($response->getStatusCode()) {
            case 500:
                throw new Exception\RuntimeException('500 Internal Server Error');
                break;
            case 503:
                $exceptionMessage = '503 Server Unavailable';
                if ($retry = $response->getHeaders()->get('Retry-After')) {
                    $exceptionMessage .= '; Retry After: ' . $retry;
                }
                throw new Exception\RuntimeException($exceptionMessage);
                break;
            case 401:
                throw new Exception\RuntimeException('401 Forbidden; Authentication Error');
                break;
            case 400:
                throw new Exception\RuntimeException('400 Bad Request; ' . Json::decode($response->getBody(), Json::TYPE_ARRAY));
                break;
        }
        
        if (! $response = Json::decode($response->getBody(), Json::TYPE_ARRAY)) {
            throw new Exception\RuntimeException('Response body did not contain a valid JSON response');
        }
        
        return $response;
    }
}
