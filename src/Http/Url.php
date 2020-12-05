<?php

namespace LMVC\Http;

class Url
{
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @return string[]
     */
    public function getParts(): array
    {
        $parts = array_map(function (string $part) {
            return trim($part);
        }, explode('/', $this->path));

        return array_values(array_filter($parts, function(string $part) {
            return strlen($part) > 0;
        }));
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return Url
     */
    public function setPath(string $path): Url
    {
        $this->path = $path;
        return $this;
    }
}
