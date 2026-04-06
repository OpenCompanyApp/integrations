# EmailOctopus Integration

Email marketing integration using the [EmailOctopus API](https://emailoctopus.com/api-documentation).

## Tools

| Tool | Type | Description |
|------|------|-------------|
| `emailoctopus_list_contacts` | read | List contacts in a mailing list |
| `emailoctopus_get_contact` | read | Get a specific contact's details |
| `emailoctopus_create_contact` | write | Add a new contact to a mailing list |
| `emailoctopus_list_campaigns` | read | List all email campaigns |
| `emailoctopus_get_campaign` | read | Get a specific campaign's details |
| `emailoctopus_get_current_user` | read | Get authenticated account details |

## Configuration

Add to `config/ai-tools.php`:

```php
'email-octopus' => [
    'api_key' => env('EMAILOCTOPUS_API_KEY'),
    'url' => env('EMAILOCTOPUS_URL', 'https://emailoctopus.com/api'),
    'list_id' => env('EMAILOCTOPUS_LIST_ID'),
],
```

## Standalone Usage

```php
use OpenCompany\Integrations\EmailOctopus\EmailOctopusService;

$service = new EmailOctopusService(
    apiKey: 'your-api-key',
    baseUrl: 'https://emailoctopus.com/api',
    listId: 'your-list-id',
);

// List contacts
$contacts = $service->listContacts();

// Create a contact
$contact = $service->createContact('user@example.com', [
    'first_name' => 'Jane',
    'last_name' => 'Doe',
]);

// List campaigns
$campaigns = $service->listCampaigns();
```

## Via ToolProvider

```php
use OpenCompany\Integrations\EmailOctopus\EmailOctopusToolProvider;

$provider = new EmailOctopusToolProvider();

foreach ($provider->tools() as $key => $meta) {
    $tool = $provider->createTool($meta['class']);
    $result = $tool->execute([...]);
}
```
