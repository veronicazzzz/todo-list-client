<?php

require __DIR__.'/../../vendor/autoload.php';

use Veronicazzzz\TodoListClient\TodoList\Client;

$client = new Client('143.198.80.83');

echo $client->register('masha', 'masha@mail.ru', '12345')."\n";
echo $client->auth('masha@mail.ru', '12345')."\n";
echo $client->addTodo('Посидеть', true)."\n";
echo $client->addTodo('Постоять', true)."\n";
echo $client->getTodoAll()."\n";