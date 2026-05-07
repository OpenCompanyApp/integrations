# Integration: Loops

Loops integration for the OpenCompany integration ecosystem. It exposes the
current Loops REST API for contacts, events, transactional email, mailing lists,
contact properties, suppression, API-key validation, and dedicated sending IPs.

## Configuration

```php
return [
    'loops' => [
        'api_key' => env('LOOPS_API_KEY'),
        'url'     => env('LOOPS_URL', 'https://app.loops.so/api/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `loops_create_contact` | write | Create a contact with default and custom properties |
| `loops_update_contact` | write | Update or create a contact by email or userId |
| `loops_find_contact` | read | Find a contact by email or userId |
| `loops_delete_contact` | write | Delete a contact by email or userId |
| `loops_check_contact_suppression` | read | Check whether a contact is suppressed |
| `loops_remove_contact_suppression` | write | Remove a contact from suppression |
| `loops_create_contact_property` | write | Create a contact property |
| `loops_list_contact_properties` | read | List contact properties |
| `loops_list_mailing_lists` | read | List mailing lists |
| `loops_send_event` | write | Send an event to trigger Loops automations |
| `loops_send_transactional_email` | write | Send a transactional email |
| `loops_list_transactional_emails` | read | List transactional emails |
| `loops_test_api_key` | read | Test the configured API key |
| `loops_list_dedicated_sending_ips` | read | List dedicated sending IP addresses |

## Standalone Service Usage

```php
use OpenCompany\Integrations\Loops\LoopsService;

$service = new LoopsService('loops_test_key');

$service->createContact([
    'email' => 'reader@example.test',
    'firstName' => 'Ada',
    'planName' => 'Pro',
]);

$service->sendEvent([
    'email' => 'reader@example.test',
    'eventName' => 'trial_started',
    'eventProperties' => ['plan' => 'Pro'],
]);

$service->sendTransactionalEmail([
    'email' => 'reader@example.test',
    'transactionalId' => 'clw6rbuwp01rmeiyndm80155l',
    'dataVariables' => ['loginUrl' => 'https://example.test/login'],
]);
```

## Agent Docs

See `lua-docs/loops.md` for Lua usage examples and endpoint-specific notes.

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- A Loops account with API access

## License

MIT - see [LICENSE](LICENSE)
