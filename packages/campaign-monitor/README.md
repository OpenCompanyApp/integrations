# Integration: Campaign Monitor

Campaign Monitor integration for the OpenCompany integration ecosystem. It wraps
the official Campaign Monitor API v3.3 for account setup, clients, campaigns,
subscriber lists, subscribers, segments, custom fields, transactional email, and
webhooks.

API reference: https://www.campaignmonitor.com/api/v3-3/

## Installation

```console
composer require opencompanyapp/integration-campaign-monitor
```

Laravel auto-discovers the service provider.

## Configuration

Campaign Monitor uses HTTP Basic authentication with the API key as the
username. The password is blank.

```php
return [
    'campaign-monitor' => [
        'api_key' => env('CAMPAIGN_MONITOR_API_KEY'),
        'url' => env('CAMPAIGN_MONITOR_URL', 'https://api.createsend.com/api/v3.3'),
    ],
];
```

## Tool Coverage

The provider exposes 79 tools across the current v3.3 API:

- Account setup: primary contact, clients, countries, time zones, system date
- Client resources: lists, segments, templates, suppression lists, tags, drafts, scheduled campaigns, sent campaigns
- Campaigns: create, get, send, unschedule, delete, summary, recipients, bounces, opens, clicks, unsubscribes, spam complaints, email client usage
- Lists: create, get, update, delete, stats, custom fields
- Subscribers: active, unconfirmed, unsubscribed, deleted, bounced, add/update, import, get, update, delete, unsubscribe, history
- Segments: create, get, update, delete, active subscribers
- Webhooks: list, create, get, test, activate, deactivate, delete
- Transactional: smart email listing/details/send, classic send, groups, statistics, message timeline, message details, resend
- Raw helpers: `campaignmonitor_api_get`, `campaignmonitor_api_post`, `campaignmonitor_api_put`, `campaignmonitor_api_delete`

Raw helpers only accept relative Campaign Monitor API paths such as
`/clients.json`; absolute URLs and parent-directory paths are rejected.

## Example

```php
use OpenCompany\Integrations\CampaignMonitor\CampaignMonitorService;
use OpenCompany\Integrations\CampaignMonitor\Tools\CampaignMonitorAddSubscriber;

$service = app(CampaignMonitorService::class);
$tool = new CampaignMonitorAddSubscriber($service);

$result = $tool->execute([
    'list_id' => 'list_test',
    'EmailAddress' => 'reader@example.test',
    'Name' => 'Ada Reader',
    'Resubscribe' => true,
]);
```

## Notes for Agents

- Campaign Monitor uses PascalCase request fields such as `EmailAddress`, `Name`, and `CustomFields`.
- Most non-transactional endpoints in v3.3 use `.json` suffixes.
- Transactional endpoints are JSON-only and do not use the `.json` suffix.
- Use fake domains such as `example.test` in tests, examples, and fixtures.

## License

MIT
