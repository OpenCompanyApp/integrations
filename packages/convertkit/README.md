# Integration: ConvertKit

> ConvertKit integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage subscribers, tags, forms, and broadcasts. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your ConvertKit email marketing platform. List and look up subscribers, manage tags and forms, and browse broadcasts — all through the [ConvertKit API](https://developers.convertkit.com/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This ConvertKit tool lets AI agents query subscriber data, manage tags, list forms, and access broadcast information — giving agents awareness of your email marketing state.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-convertkit
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a ConvertKit API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'convertkit' => [
        'api_key' => env('CONVERTKIT_API_KEY'),
        'url'     => env('CONVERTKIT_URL', 'https://api.convertkit.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `convertkit_list_subscribers` | read | List subscribers with pagination and date filtering |
| `convertkit_get_subscriber` | read | Get details for a single subscriber by ID |
| `convertkit_list_forms` | read | List all forms in the account |
| `convertkit_list_tags` | read | List all tags in the account |
| `convertkit_create_tag` | write | Create a new tag |
| `convertkit_list_broadcasts` | read | List broadcasts with pagination |
| `convertkit_get_current_user` | read | Get authenticated account information |

## Quick Start

```php
use OpenCompany\Integrations\ConvertKit\ConvertKitService;
use OpenCompany\Integrations\ConvertKit\Tools\ConvertKitListSubscribers;
use OpenCompany\Integrations\ConvertKit\Tools\ConvertKitGetSubscriber;

// Create tools
$service = app(ConvertKitService::class);
$tools = [
    new ConvertKitListSubscribers($service),
    new ConvertKitGetSubscriber($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('How many subscribers do we have?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('convertkit');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\ConvertKit\Tools\ConvertKitListSubscribers::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\ConvertKit\ConvertKitService;

$service = app(ConvertKitService::class);

// List subscribers
$subscribers = $service->listSubscribers(page: 1, perPage: 25);

// Get a single subscriber
$subscriber = $service->getSubscriber(12345);

// List forms
$forms = $service->listForms();

// List tags
$tags = $service->listTags();

// Create a tag
$tag = $service->createTag('VIP Customer');

// List broadcasts
$broadcasts = $service->listBroadcasts();

// Get account info
$account = $service->getAccount();
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
- A [ConvertKit](https://convertkit.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
