# Integration: Elastic Email

Elastic Email REST API v4 integration for AI agents: transactional email, bulk email payloads, templates, contacts, lists, campaigns, events, suppressions, statistics, files, and generic v4 endpoint access.

## Installation

```console
composer require opencompanyapp/integration-elastic-email
```

Laravel auto-discovers the service provider.

## Configuration

```php
return [
    'elastic-email' => [
        'api_key' => env('ELASTIC_EMAIL_API_KEY'),
        'url' => env('ELASTIC_EMAIL_URL', 'https://api.elasticemail.com/v4'),
    ],
];
```

The integration sends the API key with the documented `X-ElasticEmail-ApiKey` header.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `elasticemail_send_email` | write | Send a transactional email |
| `elasticemail_send_bulk_email` | write | Send a full v4 bulk email payload |
| `elasticemail_get_email_status` | read | Get status for a transaction ID |
| `elasticemail_list_templates` | read | List templates |
| `elasticemail_get_template` | read | Get a template by name |
| `elasticemail_list_contacts` | read | List contacts |
| `elasticemail_get_contact` | read | Get a contact by email |
| `elasticemail_create_contact` | write | Create or add a contact |
| `elasticemail_update_contact` | write | Update a contact |
| `elasticemail_delete_contact` | write | Delete a contact |
| `elasticemail_list_lists` | read | List contact lists |
| `elasticemail_get_list` | read | Get a list by name |
| `elasticemail_list_list_contacts` | read | List contacts in a list |
| `elasticemail_add_contacts_to_list` | write | Add contacts to a list |
| `elasticemail_remove_contacts_from_list` | write | Remove contacts from a list |
| `elasticemail_list_campaigns` | read | List campaigns |
| `elasticemail_get_campaign` | read | Get a campaign by name |
| `elasticemail_pause_campaign` | write | Pause a campaign |
| `elasticemail_list_events` | read | List events |
| `elasticemail_list_email_events` | read | List events for a transaction ID |
| `elasticemail_list_suppressions` | read | List unsubscribes, bounces, or complaints |
| `elasticemail_get_statistics` | read | Get account statistics |
| `elasticemail_get_campaign_statistics` | read | Get campaign statistics |
| `elasticemail_list_files` | read | List uploaded files |
| `elasticemail_api_get` | read | Call a read-only v4 endpoint |
| `elasticemail_api_post` | write | Call a v4 POST endpoint |

## Service Usage

```php
use OpenCompany\Integrations\ElasticEmail\ElasticEmailService;

$service = app(ElasticEmailService::class);

$service->sendEmail('person@example.test', 'Welcome', '<p>Hello</p>', [
    'from' => 'sender@example.test',
]);

$contacts = $service->listContacts(['limit' => 50]);
$campaigns = $service->listCampaigns();
$events = $service->listEvents(['limit' => 100]);
$stats = $service->getStatistics();
```

## Notes

- The package now targets Elastic Email REST API v4 by default.
- Template, campaign, and list lookups use names because the documented v4 paths are name based.
- The former current-user tool was removed because the v4 docs do not expose an account-profile endpoint.
- `elasticemail_api_get` and `elasticemail_api_post` accept only relative API paths, not full URLs.

## Dependencies

| Package | Purpose |
|---------|---------|
| `opencompanyapp/integration-core` | ToolProvider contract and registry |

## License

MIT
