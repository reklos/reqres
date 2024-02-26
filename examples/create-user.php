<?php
include __DIR__ . '/../vendor/autoload.php';

use GeorgiosReklos\Reqres\Exceptions\ReqresException;
use GeorgiosReklos\Reqres\Service\ClientService;

try {
    $client = new ClientService();
    $userId = $client->user->createUser(
        name: 'johndoe',
        job: 'leader'
    );
} catch (ReqresException $e) {
    echo $e->getMessage();
    exit;
}

echo "\nUser ID: {$userId}\n";