<?php
include __DIR__ . '/../vendor/autoload.php';

use GeorgiosReklos\Reqres\Client;
use GeorgiosReklos\Reqres\Exceptions\ReqresException;

try {
    $userId = 1;
    $client = new Client();
    $user = $client->user->getUser($userId);
} catch (ReqresException $e) {
    echo $e->getMessage();
    exit;
}

echo "\n---\n";
echo "ID: {$user->getId()}\n";
echo "Email: {$user->getEmail()}\n";
echo "First name: {$user->getFirstName()}\n";
echo "Last name: {$user->getLastName()}\n";
echo "Avatar: {$user->getAvatar()}\n";