# Integration: Campaign Monitor

> Campaign Monitor integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage campaigns, lists, and subscribers. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to email marketing. List campaigns, manage subscriber lists, and add subscribers — all through the [Campaign Monitor](https://www.campaignmonitor.com/) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Campaign Monitor tool lets AI agents manage email campaigns, subscriber lists, and contacts — enabling data-driven email marketing automation.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-campaign-monitor
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Campaign Monitor API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'campaign-monitor' => [
        'api_key' => env('CAMPAIGN_MONITOR_API_KEY'),
        'url'     => env('CAMPAIGN_MONITOR_URL', 'https://api.createsend.com/api/v3.3'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `campaignmonitor_list_campaigns` | read | List all email campaigns |
| `campaignmonitor_get_campaign` | read | Get details for a specific campaign |
| `campaignmonitor_list_lists` | read | List all subscriber lists |
| `campaignmonitor_get_list` | read | Get details for a specific subscriber list |
| `campaignmonitor_list_subscribers` | read | List active subscribers on a list |
| `campaignmonitor_add_subscriber` | write | Add a subscriber to a list |
| `campaignmonitor_get_current_user` | read | Get authenticated user's account details |

## Quick Start

```php
use OpenCompany\Integrations\CampaignMonitor\CampaignMonitorService;
use OpenCompany\Integrations\CampaignMonitor\Tools\CampaignMonitorListLists;
use OpenCompany\Integrations\CampaignMonitor\Tools\CampaignMonitorAddSubscriber;

// Create tools
$service = app(CampaignMonitorService::class);
$tools = [
    new CampaignMonitorListLists($service),
    new CampaignMonitorAddSubscriber($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all subscriber lists and add john@example.com to the first one');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('campaign-monitor');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\CampaignMonitor\Tools\CampaignMonitorListLists::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\CampaignMonitor\CampaignMonitorService;

$service = app(CampaignMonitorService::class);

// List campaigns
$campaigns = $service->listCampaigns();

// Get a campaign
$campaign = $service->getCampaign('campaign-id');

// List subscriber lists
$lists = $service->listLists();

// List subscribers
$subscribers = $service->listSubscribers('list-id');

// Add a subscriber
$service->addSubscriber('list-id', 'john@example.com', 'John Doe');

// Get current user
$user = $service->getCurrentUser();
```

## Authentication

This integration uses HTTP Basic Authentication with your Campaign Monitor API key as the username and an empty password. The API key can be found in your Campaign Monitor account settings under **API Keys**.

## Dependencies

| Package | Purpose |
|---------|---------|
| [opencompanyapp/integration-core](https://github.com/OpenCompanyApp/integration-core) | ToolProvider contract and registry |
| [laravel/ai](https://github.com/laravel/ai) | Laravel AI SDK Tool contract |

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- [Laravel AI SDK](https://github.com/laravel/ai) ^0.1
- A [Campaign Monitor](https://www.campaignmonitor.com/) account with API access

## License

MIT — see [LICENSE](LICENSE)
