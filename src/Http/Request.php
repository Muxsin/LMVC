<?php

namespace LMVC\Http;

use LMVC\Support\Bag;

class Request
{
    private $query;
    private $request;
    private $server;
    private $cookies;
    private $session;

    public function __construct(Bag $query = null, Bag $request = null, Bag $server = null, Bag $cookies = null, Bag $session = null)
    {
        $this->query = $query ?? new Bag();
        $this->request = $request ?? new Bag();
        $this->server = $server ?? new Bag();
        $this->cookies = $cookies ?? new Bag();
        $this->session = $session ?? new Bag();
    }

    public static function createFromGlobals(): Request
    {
        return new static(
            Bag::createFromArray($_GET),
            Bag::createFromArray($_POST),
            Bag::createFromArray($_SERVER),
            Bag::createFromArray($_COOKIE),
            Bag::createFromArray(isset($_SESSION) ? $_SESSION : [])
        );
    }

    /**
     * @return Bag
     */
    public function getQuery(): Bag
    {
        return $this->query;
    }

    /**
     * @param Bag $query
     * @return Request
     */
    public function setQuery(Bag $query): Request
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @return Bag
     */
    public function getRequest(): Bag
    {
        return $this->request;
    }

    /**
     * @param Bag $request
     * @return Request
     */
    public function setRequest(Bag $request): Request
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return Bag
     */
    public function getServer(): Bag
    {
        return $this->server;
    }

    /**
     * @param Bag $server
     * @return Request
     */
    public function setServer(Bag $server): Request
    {
        $this->server = $server;
        return $this;
    }

    /**
     * @return Bag
     */
    public function getCookies(): Bag
    {
        return $this->cookies;
    }

    /**
     * @param Bag $cookies
     * @return Request
     */
    public function setCookies(Bag $cookies): Request
    {
        $this->cookies = $cookies;
        return $this;
    }

    /**
     * @return Bag
     */
    public function getSession(): Bag
    {
        return $this->session;
    }

    /**
     * @param Bag $session
     * @return Request
     */
    public function setSession(Bag $session): Request
    {
        $this->session = $session;
        return $this;
    }
}
