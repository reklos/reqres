<?php
include __DIR__ . '/../vendor/autoload.php';

use GeorgiosReklos\Reqres\Client;
use GeorgiosReklos\Reqres\Exceptions\ReqresException;

try {
    $client = new Client();

    // Get users for the first page
    $users = $client->userPagination->getUsers();

    // Move to the next page
    $client->userPagination->nextPage();
    $users = $client->userPagination->getUsers();

    // Move to the previous page
    $client->userPagination->previousPage();
    $users = $client->userPagination->getUsers();

    // Move to last page
    $client->userPagination->lastPage();
    $users = $client->userPagination->getUsers();

    // Move to first page
    $client->userPagination->firstPage();
    $users = $client->userPagination->getUsers();

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

// Move to the next page
echo "\n---\n";

$client->userPagination->nextPage();
$users = $client->userPagination->getUsers();

foreach ($users as $user) {
    echo "\n---\n";
    echo "ID: {$user->getId()}\n";
    echo "Email: {$user->getEmail()}\n";
    echo "First name: {$user->getFirstName()}\n";
    echo "Last name: {$user->getLastName()}\n";
    echo "Avatar: {$user->getAvatar()}\n";
}