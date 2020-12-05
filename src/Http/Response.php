<?php

namespace LMVC\Http;

use LMVC\Support\Bag;

class Response
{
    private $content;
    private $code;
    private $status;
    private $headers;

    public function __construct(string $content, int $code = 200, string $status = 'OK')
    {
        $this->content = $content;
        $this->code = $code;
        $this->status = $status;
        $this->headers = new Bag();
    }

    public function sendHeaders()
    {
        if (!headers_sent()) {
            header('HTTP/1.1 ' . $this->code . ' ' . $this->status);

            foreach ($this->headers as $header => $value) {
                header($header . ': ' . $value);
            }
        }
    }

    public function sendContent()
    {
        echo $this->content;
    }

    public function send()
    {
        $this->sendHeaders();
        $this->sendContent();
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Response
     */
    public function setContent(string $content): Response
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     * @return Response
     */
    public function setCode(int $code): Response
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Response
     */
    public function setStatus(string $status): Response
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return Bag
     */
    public function getHeaders(): Bag
    {
        return $this->headers;
    }

    /**
     * @param Bag $headers
     * @return Response
     */
    public function setHeaders(Bag $headers): Response
    {
        $this->headers = $headers;
        return $this;
    }
}