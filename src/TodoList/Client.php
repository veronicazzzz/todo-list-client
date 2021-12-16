<?php

namespace Veronicazzzz\TodoListClient\TodoList;

use Veronicazzzz\TodoListClient\Curl\Request;

class Client
{
    private $host;

    private $token = null;

    public function __construct(string $host)
    {
        $this->host = $host;
    }

    public function auth(string $username, string $password): string|bool
    {
        $url = $this->host . Routes::LOGIN_CHECK;

        $response = Request::sendPost($url, [
            'username' => $username,
            'password' => $password
        ]);

        $responseArray = json_decode($response, true);

        $this->token = $responseArray['token'];
        
        return $response;
    }

    public function register(string $name, string $email, string $password): string|bool
    {
        $url = $this->host . Routes::REGISTER;

        $body = [
            'name'     => $name,
            'email'    => $email,
            'password' => $password
        ];

        return Request::sendPost($url, $body);
    }

    public function getTodoAll(): string|bool
    {
        $url = $this->host . Routes::TODO;

        return Request::sendGet($url, $this->token);
    }

    public function getTodoOne(int $id): string|bool
    {
        $url = $this->host . Routes::TODO . '/' . $id;

        return Request::sendGet($url, $this->token);
    }

    public function deleteTodo(int $id): string|bool
    {
        $url = $this->host . Routes::TODO . '/' . $id;

        return Request::sendDelete($url, $this->token);
    }

    public function editTodo(int $id, ?string $thing, ?bool $done): string|bool
    {
        $url = $this->host . Routes::TODO . '/' . $id;

        $body = [];

        if (!is_null($thing)) {
            $body['thing'] = $thing;
        }

        if (!is_null($done)) {
            $body['done'] = $done ? 1 : 0;
        }

        return Request::sendPut($url, $body, $this->token);
    }

    public function addTodo(string $thing, bool $done): string|bool
    {
        $url = $this->host . Routes::TODO;

        $body = [
            'thing' => $thing,
            'done'  => $done ? 1 : 0
        ];

        return Request::sendPost($url, $body, $this->token);
    }

    public function todoDone(int $id): string|bool
    {
        return $this->editTodo($id, null, true);
    }

    public function todoUndone(int $id): string|bool
    {
        return $this->editTodo($id, null, false);
    }
}