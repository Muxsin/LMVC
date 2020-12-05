<?php

namespace App\Controller;

use App\Model\User;
use LMVC\Controller\BaseController;
use LMVC\Http\Request;
use LMVC\Http\Response;

class UserController extends BaseController
{
    public function index(Request $request): Response
    {
        return $this->view('users.index');
    }

    public function create(Request $request): string
    {
        global $connection;

        $name = $request->getQuery()->get('name');
        $username = $request->getQuery()->get('username');
        $password = $request->getQuery()->get('password');
        $user = new User($name, $username, $password);
        $user->save($connection);

        return "<h1 style='margin: 0'>{$user->getName()}</h1><h2 style='margin: 0'>{$user->getUsername()}</h2><h2 style='margin: 0'>{$user->getPassword()}</h2>";
    }

    public function store(Request $request): string
    {
        return '<h1>UserController::store</h1>';
    }
}
