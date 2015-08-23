<?php
/**
 * Created by PhpStorm.
 * User: icqparty
 * Date: 22.10.14
 * Time: 20:09
 */

namespace Application\VersionControl;

use Zend\Stdlib\AbstractOptions;

class ClientOptions extends AbstractOptions
{

    protected $scope;

    protected $authUri;

    protected $tokenUri;

    protected $clientId;

    protected $clientSecret;

    protected $redirectUri;

    //SCOPE
    public function getScope()
    {
        return $this->scope;
    }

    public function setScope($scope)
    {
        $this->scope = $scope;
    }

    public function getAuthUri()
    {
        return $this->authUri;
    }

    public function setAuthUri($authUri)
    {
        $this->authUri = $authUri;
    }

    public function getTokenUri()
    {
        return $this->tokenUri;
    }

    public function setTokenUri($tokenUri)
    {
        $this->tokenUri = $tokenUri;
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

}