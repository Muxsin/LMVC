<?php

namespace LMVC\Controller;

use LMVC\Http\Response;

class BaseController
{
    public function view(string $view): Response
    {
        $viewPath = implode(DIRECTORY_SEPARATOR, explode('.', $view)) . '.php';
        $baseDir = dirname(dirname(__DIR__));
        $viewFile = $baseDir . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . $viewPath;

        if (file_exists($viewFile)) {
            return new Response(shell_exec('php ' . $viewFile));
        }

        return abort(404, 'Not Found');
    }
}
