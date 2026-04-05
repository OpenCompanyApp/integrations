# Integration: Customer.io

> Customer.io integration for the [Laravel AI SDK](https://github.com/laravel/ai) — identify customers, track events, manage segments, campaigns, and newsletters. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to customer engagement tools. Identify customers, track behavioral events, and manage campaigns and newsletters — all through the [Customer.io](https://customer.io) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Customer.io tool lets AI agents manage customer profiles, track events, and review campaign performance — giving agents the ability to drive personalized customer engagement.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-customerio
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Customer.io API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'customerio' => [
        'api_key' => env('CUSTOMERIO_API_KEY'),
        'url'     => env('CUSTOMERIO_URL', 'https://api.customer.io/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `customerio_identify_customer` | write | Create or update a customer profile |
| `customerio_track_event` | write | Track a custom event for a customer |
| `customerio_list_segments` | read | List all segments in the workspace |
| `customerio_list_campaigns` | read | List all campaigns in the workspace |
| `customerio_get_campaign` | read | Get details for a specific campaign |
| `customerio_list_newsletters` | read | List all newsletters in the workspace |
| `customerio_get_current_user` | read | Get authenticated user / account info |

## Quick Start

```php
use OpenCompany\Integrations\CustomerIO\CustomerIOService;
use OpenCompany\Integrations\CustomerIO\Tools\CustomerIOIdentifyCustomer;
use OpenCompany\Integrations\CustomerIO\Tools\CustomerIOTrackEvent;

// Create tools
$service = app(CustomerIOService::class);
$tools = [
    new CustomerIOIdentifyCustomer($service),
    new CustomerIOTrackEvent($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Create a customer for john@example.com named John Smith');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('customerio');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\CustomerIO\Tools\CustomerIOIdentifyCustomer::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\CustomerIO\CustomerIOService;

$service = app(CustomerIOService::class);

// Identify a customer
$service->identifyCustomer('user_123', [
    'email' => 'jane@example.com',
    'name' => 'Jane Doe',
    'plan' => 'premium',
]);

// Track an event
$service->trackEvent('user_123', 'purchase', [
    'product' => 'Pro Plan',
    'amount' => 99,
]);

// List segments
$segments = $service->listSegments();

// List campaigns
$campaigns = $service->listCampaigns();

// Get a specific campaign
$campaign = $service->getCampaign(42);

// List newsletters
$newsletters = $service->listNewsletters();

// Get current user
$user = $service->getCurrentUser();
```

## Dependencies

| Package | Purpose |
|---------|---------|
| [opencompanyapp/integration-core](https://github.com/OpenCompanyApp/integration-core) | ToolProvider contract and registry |
| [laravel/ai](https://github.com/laravel/ai) | Laravel AI SDK Tool contract |

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- [Laravel AI SDK](https://github.com/laravel/ai) ^0.1
- A [Customer.io](https://customer.io) account with API access

## License

MIT — see [LICENSE](LICENSE)
