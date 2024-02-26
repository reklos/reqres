<?php
include __DIR__ . '/../vendor/autoload.php';

use GeorgiosReklos\Reqres\Client;
use GeorgiosReklos\Reqres\Exceptions\ReqresException;

try {
    $client = new Client();
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