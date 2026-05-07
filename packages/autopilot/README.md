# Integration: Autopilot

Autopilot marketing automation integration for OpenCompany agents. The package
exposes the official Autopilot API Blueprint surface for contacts, lists,
journey ejection, and REST hooks.

## Installation

```console
composer require opencompanyapp/integration-autopilot
```

Laravel auto-discovers the service provider.

## Configuration

Configure an Autopilot API key. The API key is sent using Autopilot's
documented `autopilotapikey` header.

```php
return [
    'autopilot' => [
        'api_key' => env('AUTOPILOT_API_KEY'),
        'url' => env('AUTOPILOT_URL', 'https://api.autopilothq.com'),
    ],
];
```

## Coverage

This package follows the official API Blueprint in
`https://github.com/autopilotdev/autopilotdev.github.io/blob/master/_api_docs/apiary.md`
and currently exposes 10 tools:

| Tool | Type | Description |
|------|------|-------------|
| `autopilot_create_contact` | write | Create or update a contact |
| `autopilot_get_contact` | read | Get a contact by ID or email |
| `autopilot_delete_contact` | write | Delete a contact |
| `autopilot_get_contacts_on_list` | read | Get contacts on a list |
| `autopilot_add_list` | write | Add a list |
| `autopilot_delete_list` | write | Delete a list |
| `autopilot_eject_contact_from_journey` | write | Eject a contact from a journey |
| `autopilot_register_rest_hook` | write | Register a REST hook |
| `autopilot_unregister_rest_hook` | write | Unregister a REST hook |
| `autopilot_list_rest_hooks` | read | List REST hooks |

The API Blueprint says bulk contact retrieval and programmatic journey listing
are not currently supported, so this package does not expose fake list-contact
or list-journey tools.

## Usage

```php
use OpenCompany\Integrations\Autopilot\AutopilotService;

$service = app(AutopilotService::class);

$contact = $service->call('autopilot_create_contact', [
    'payload' => [
        'Email' => 'ada@example.test',
        'FirstName' => 'Ada',
    ],
]);
```

## License

MIT.
