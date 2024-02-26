## REQRES Client API
PHP Client for the REQRES API (https://reqres.in)

## Getting Started

### Create a new user
```php
require_once(__DIR__ . '/vendor/autoload.php');

try {
    $client = new ClientService();
    $userId = $client->user->createUser(
        name: 'john',
        job: 'leader'
    );
} catch (ReqresException $e) {
    echo $e->getMessage();
}
```

### Retrieve a single user
```php
require_once(__DIR__ . '/vendor/autoload.php');

try {
    $userId = 1;
    $client = new ClientService();
    $user = $client->user->getUser($userId);
} catch (ReqresException $e) {
    echo $e->getMessage();
}
```
### Retrieve users from a page
```php
require_once(__DIR__ . '/vendor/autoload.php');

try {
    $client = new ClientService();
    $users = $client->user->getUsersFromPage(1);
    $users = $client->user->getUsersFromPage(2);
} catch (ReqresException $e) {
    echo $e->getMessage();
}
```

### Pagination
```php
require_once(__DIR__ . '/vendor/autoload.php');

try {
    $client = new ClientService();

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
}
```




