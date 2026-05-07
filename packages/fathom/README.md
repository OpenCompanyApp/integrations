# Integration: Fathom

> Fathom Analytics integration for Laravel - manage sites, events, milestones, reports, account details, and current visitors. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give AI agents access to privacy-first web analytics through the documented [Fathom Analytics](https://usefathom.com/api) API. The integration uses bearer token authentication and supports account-scoped credentials in hosts that provide multi-account resolution.

## Installation

```console
composer require opencompanyapp/integration-fathom
```

Laravel auto-discovers the service provider.

## Configuration

This integration requires a Fathom Analytics access token.

```php
return [
    'fathom' => [
        'access_token' => env('FATHOM_ACCESS_TOKEN'),
        'url' => env('FATHOM_URL', 'https://api.usefathom.com/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `fathom_get_account` | read | Get the authenticated Fathom account profile |
| `fathom_get_current_user` | read | Backward-compatible account profile lookup using `/account` |
| `fathom_list_sites` | read | List tracked sites |
| `fathom_get_site` | read | Get a site |
| `fathom_create_site` | write | Create a site |
| `fathom_update_site` | write | Update a site |
| `fathom_wipe_site` | write | Wipe analytics data for a site |
| `fathom_delete_site` | write | Delete a site |
| `fathom_list_events` | read | List site events |
| `fathom_get_event` | read | Get a site event |
| `fathom_create_event` | write | Create a site event |
| `fathom_update_event` | write | Update a site event |
| `fathom_wipe_event` | write | Wipe event completion data |
| `fathom_delete_event` | write | Delete a site event |
| `fathom_list_milestones` | read | List site milestones |
| `fathom_get_milestone` | read | Get a milestone |
| `fathom_create_milestone` | write | Create a milestone |
| `fathom_update_milestone` | write | Update a milestone |
| `fathom_delete_milestone` | write | Delete a milestone |
| `fathom_get_aggregate` | read | Generate an aggregation report |
| `fathom_get_current_visitors` | read | Get current visitors for a site |

## Quick Start

```php
use OpenCompany\Integrations\Fathom\FathomService;

$service = app(FathomService::class);

$sites = $service->listSites();
$account = $service->getAccount();

$topPages = $service->getAggregate(
    siteId: 'ABCDEF',
    dateFrom: '2026-01-01',
    dateTo: '2026-01-31',
    metrics: 'pageviews,visits,uniques',
    sortBy: 'pageviews:desc',
    groupBy: 'pathname',
    limit: 10,
);
```

### Via ToolProvider

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;
use OpenCompany\Integrations\Fathom\Tools\FathomGetAggregate;

$provider = app(ToolProviderRegistry::class)->get('fathom');
$tool = $provider->createTool(FathomGetAggregate::class);
```

## Endpoint Coverage

The service maps to the documented Fathom API v1 endpoints:

- Account: `/account`
- Sites: list, get, create, update, wipe data, delete
- Events: list, get, create, update, wipe data, delete under `/sites/{site_id}/events`
- Milestones: list, get, create, update, delete under `/sites/{site_id}/milestones`
- Reports: `/aggregations` and `/current_visitors`

Fathom does not document a raw pageviews list endpoint in the current API. Use `fathom_get_aggregate` for pageview reports.

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- `opencompanyapp/integration-core`
- A Fathom Analytics account with API access

## License

MIT - see [LICENSE](LICENSE)
