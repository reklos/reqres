<?php
include __DIR__ . '/../vendor/autoload.php';

use GeorgiosReklos\Reqres\Exceptions\ReqresException;
use GeorgiosReklos\Reqres\Service\ClientService;

try {
    $client = new ClientService();
    $users = $client->user->getUsersFromPage(1);
} catch (ReqresException $e) {
    echo $e->getMessage();
    exit;
}

foreach ($users as $user) {
    echo "\n---\n";
    echo "ID: {$user->getId()}\n";
    echo "Email: {$user->getEmail()}\n";
    echo "First name: {$user->getFirstName()}\n";
    echo "Last name: {$user->getLastName()}\n";
    echo "Avatar: {$user->getAvatar()}\n";
}