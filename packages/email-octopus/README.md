# EmailOctopus Integration

EmailOctopus integration for the OpenCompany integration ecosystem. It targets
the public v1.6 API documentation for list management, contacts, fields, tags,
campaigns, campaign reports, and automation queueing.

EmailOctopus notes that API v2 is available in dashboards, but public method
documentation currently exposes the v1.6 endpoint set. This package avoids the
older generated `/v1.5` paths.

## Configuration

```php
'email-octopus' => [
    'api_key' => env('EMAILOCTOPUS_API_KEY'),
    'url' => env('EMAILOCTOPUS_URL', 'https://emailoctopus.com/api'),
    'list_id' => env('EMAILOCTOPUS_LIST_ID'),
],
```

`list_id` is optional, but list-scoped tools need either a configured default or
a `list_id` argument.

## Available Tools

This package exposes tools for:

- Lists: list, get, create, update, delete
- Tags: list, create, update, delete
- Contacts: list all, subscribed, unsubscribed, tagged, get, create, update, delete, bulk update
- Fields: create, update, delete
- Campaigns: list, get, report endpoints
- Automations: start automation for a list contact

## Standalone Usage

```php
use OpenCompany\Integrations\EmailOctopus\EmailOctopusService;

$service = new EmailOctopusService(
    apiKey: 'emailoctopus_test_key',
    listId: 'list_123',
);

$contacts = $service->listContacts(['limit' => 25]);

$contact = $service->createContact([
    'email_address' => 'reader@example.test',
    'fields' => ['FirstName' => 'Ada'],
    'tags' => ['vip'],
    'status' => 'SUBSCRIBED',
]);

$summary = $service->getCampaignReport([
    'campaign_id' => 'campaign_123',
    'report_type' => 'summary',
]);
```

## Agent Docs

See `script-docs/email-octopus.md` for JavaScript namespace examples and return-shape
notes.

## License

MIT - see [LICENSE](LICENSE)
