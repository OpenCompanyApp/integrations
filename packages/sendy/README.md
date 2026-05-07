# Integration: Sendy

> Sendy newsletter integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage subscribers, campaigns, and brands. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to email newsletter management. Subscribe, unsubscribe, delete and inspect contacts, list brands and lists, check active subscriber counts, and create or schedule campaigns through the [Sendy](https://sendy.co/api) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Sendy tool lets AI agents manage email subscribers and campaigns — giving agents the ability to handle newsletter workflows autonomously.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-sendy
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Sendy API key and hostname.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'sendy' => [
        'api_key'  => env('SENDY_API_KEY'),
        'hostname' => env('SENDY_HOSTNAME', 'https://sendy.example.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `sendy_subscribe` | write | Subscribe an email to a mailing list |
| `sendy_unsubscribe` | write | Unsubscribe an email from a mailing list |
| `sendy_delete_subscriber` | write | Delete a subscriber from a list |
| `sendy_subscription_status` | read | Get a subscriber's list status |
| `sendy_list_subscribers` | read | Get active subscriber count for a list |
| `sendy_get_lists` | read | Get lists for a brand |
| `sendy_get_brands` | read | Get all brands visible to the API key |
| `sendy_create_campaign` | write | Create, send, or schedule an email campaign |
| `sendy_get_current_user` | read | Compatibility alias for get brands |

## Quick Start

```php
use OpenCompany\Integrations\Sendy\SendyService;
use OpenCompany\Integrations\Sendy\Tools\SendySubscribe;
use OpenCompany\Integrations\Sendy\Tools\SendyListSubscribers;

// Create tools
$service = app(SendyService::class);
$tools = [
    new SendySubscribe($service),
    new SendyListSubscribers($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Subscribe john@example.com to the newsletter list');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 9 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('sendy');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Sendy\Tools\SendySubscribe::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Sendy\SendyService;

$service = app(SendyService::class);

// Subscribe
$result = $service->subscribe('list-id', 'user@example.com', 'John Doe');

// Unsubscribe
$result = $service->unsubscribe('list-id', 'user@example.com');

// Get active subscriber count
$count = $service->listSubscribers('list-id');

// Check subscriber status
$status = $service->getSubscriptionStatus('list-id', 'user@example.com');

// Get brands and lists
$brands = $service->getBrands();
$lists = $service->getLists('1', includeHidden: true);

// Create a campaign
$result = $service->createCampaign([
    'from_name' => 'Acme Corp',
    'from_email' => 'hello@acme.com',
    'reply_to' => 'hello@acme.com',
    'title' => 'Newsletter',
    'subject' => 'Monthly update',
    'html_text' => '<h1>Hello!</h1>',
    'list_ids' => 'list-id',
    'send_campaign' => 1,
]);
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
- A [Sendy](https://sendy.co) installation with API access

## License

MIT — see [LICENSE](LICENSE)
