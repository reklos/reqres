<?php
require_once __DIR__ . '/path/to/vendor/autoload.php';

use GeorgiosReklos\Reqres\Client;
use GeorgiosReklos\Reqres\Exceptions\ReqresException;

try {
    $client = new Client();
    $userId = $client->user->createUser(
        name: 'johndoe',
        job: 'leader'
    );
} catch (ReqresException $e) {
    echo $e->getMessage();
    exit;
}

echo "\nUser ID: {$userId}\n";