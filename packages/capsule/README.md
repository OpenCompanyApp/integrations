# Integration: Capsule CRM

Expose Capsule CRM operations to OpenCompany and KosmoKrator agents through the official Capsule CRM API v2.

## Coverage

This package covers:

- parties: contacts and organisations
- opportunities and party opportunities
- projects/cases
- tasks
- tracks
- tag definitions
- custom field definitions
- current user checks
- safe raw relative API helpers for endpoints that do not yet have a dedicated tool

## Configuration

```php
return [
    'capsule' => [
        'access_token' => env('CAPSULE_ACCESS_TOKEN'),
        'url' => env('CAPSULE_URL', 'https://api.capsulecrm.com/api/v2'),
    ],
];
```

## Tools

The provider exposes dedicated tools for list, get, create, update, and delete operations across core CRM objects, plus `capsule_api_get`, `capsule_api_post`, `capsule_api_put`, and `capsule_api_delete`.

## Service Usage

```php
use OpenCompany\Integrations\Capsule\CapsuleService;

$service = new CapsuleService('token-test');

$parties = $service->listContacts(page: 1, perPage: 50);
$opportunity = $service->createOpportunity([
    'name' => 'New deal',
    'party' => ['id' => 123],
]);
$fields = $service->listCustomFields('opportunities');
```

## Documentation

See the official Capsule CRM API documentation at <https://developer.capsulecrm.com/>.

## License

MIT
