<?php

namespace LMVC\Http;

class Route
{
    private $url;
    private $method;
    private $controllerName;
    private $actionName;

    public function __construct(Url $url, string $method, string $controllerName, string $actionName)
    {
        $this->url = $url;
        $this->method = $method;
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
    }

    public function check(Request $request): bool
    {
        $url = new Url($request->getServer()->get('REQUEST_ROUTE', '/'));
        $method = strtolower($request->getServer()->get('REQUEST_METHOD', 'GET'));

        if ($this->method !== $method) return false;
        if (count($this->url->getParts()) !== count($url->getParts())) return false;

        $routeParts = $this->url->getParts();
        $urlParts = $url->getParts();

        for ($i = 0; $i < count($routeParts); $i++) {
            if ($routeParts[$i] !== $urlParts[$i]) return false;
        }

        return true;
    }

    /**
     * @return Url
     */
    public function getUrl(): Url
    {
        return $this->url;
    }

    /**
     * @param Url $url
     * @return Route
     */
    public function setUrl(Url $url): Route
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return Route
     */
    public function setMethod(string $method): Route
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return string
     */
    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    /**
     * @param string $controllerName
     * @return Route
     */
    public function setControllerName(string $controllerName): Route
    {
        $this->controllerName = $controllerName;
        return $this;
    }

    /**
     * @return string
     */
    public function getActionName(): string
    {
        return $this->actionName;
    }

    /**
     * @param string $actionName
     * @return Route
     */
    public function setActionName(string $actionName): Route
    {
        $this->actionName = $actionName;
        return $this;
    }
}
