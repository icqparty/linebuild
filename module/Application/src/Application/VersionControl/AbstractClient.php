<?php
/**
 * Created by PhpStorm.
 * User: icqparty
 * Date: 22.10.14
 * Time: 20:29
 */
namespace Application\VersionControl;

use Zend\Http\Client;
use Zend\Http\Request;

abstract class AbstractClient
{

    protected $options;

    protected $error;

    protected $client;

    abstract public function reset();
    abstract public function connect();
    abstract public function status();

    abstract public function getUrl();

    abstract public function getToken(Request $request);

    public function __construct()
    {

    }

    public function getInfo()
    {
        if(is_object($this->session->info)) {

            return $this->session->info;

        } elseif(isset($this->session->token->access_token)) {

            $urlProfile = $this->options->getInfoUri() . '?access_token='.$this->session->token->access_token;

            $client = $this->getHttpclient()
                ->resetParameters(true)
                ->setHeaders(array('Accept-encoding' => 'utf-8'))
                ->setMethod(Request::METHOD_GET)
                ->setUri($urlProfile);

            $retVal = $client->send()->getContent();

            if(strlen(trim($retVal)) > 0) {

                $this->session->info = \Zend\Json\Decoder::decode($retVal);
                return $this->session->info;

            } else {

                $this->error = array('internal-error' => 'Get info return value is empty.');
                return false;

            }

        } else {

            $this->error = array('internal-error' => 'Session access token not found.');
            return false;

        }
    }

    public function getScope($glue = ' ')
    {
        if(is_array($this->options->getScope()) AND count($this->options->getScope()) > 0) {
            $str = urlencode(implode($glue, array_unique($this->options->getScope())));
            return '&scope=' . $str;
        } else {
            return '';
        }
    }



    public function setOptions(ClientOptions $options)
    {
        $this->options = $options;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function getError()
    {
        return $this->error;
    }



    public function getProvider()
    {
        return $this->providerName;
    }



    public function getHttpClient()
    {

        if(!$this->client) {
            $this->client = new Client(null, array('timeout' => 30, 'adapter' => '\Zend\Http\Client\Adapter\Curl'));
        }

        return $this->client;

    }

}