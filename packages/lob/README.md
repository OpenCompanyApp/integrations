# Integration: Lob

> Lob print & mail integration for the [Laravel AI SDK](https://github.com/laravel/ai) — send letters and postcards, manage addresses. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents the ability to send physical mail through the [Lob](https://lob.com) API. Automate letter printing, postcard campaigns, and address management — all from within your AI workflows.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Lob tool lets AI agents send direct mail, track deliveries, and manage addresses — enabling physical-world automation from digital workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-lob
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Lob API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'lob' => [
        'api_key' => env('LOB_API_KEY'),
        'url'     => env('LOB_URL', 'https://api.lob.com'),
    ],
];
```

Use a `test_` prefixed key for the Lob sandbox, or a `live_` prefixed key for production.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `lob_list_letters` | read | List letters with pagination |
| `lob_get_letter` | read | Retrieve a letter by ID (status, tracking, URL) |
| `lob_create_letter` | write | Create and send a letter with HTML or template |
| `lob_list_postcards` | read | List postcards with pagination |
| `lob_get_postcard` | read | Retrieve a postcard by ID (status, tracking, thumbnails) |
| `lob_create_postcard` | write | Create and send a postcard with HTML or template |
| `lob_get_current_user` | read | List saved addresses in the Lob account |

## Quick Start

```php
use OpenCompany\Integrations\Lob\LobService;
use OpenCompany\Integrations\Lob\Tools\LobCreatePostcard;
use OpenCompany\Integrations\Lob\Tools\LobCreateLetter;

// Create tools
$service = app(LobService::class);
$tools = [
    new LobCreatePostcard($service),
    new LobCreateLetter($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Send a welcome letter to 185 Berry St, San Francisco, CA 94107');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('lob');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Lob\Tools\LobCreatePostcard::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Lob\LobService;

$service = app(LobService::class);

// List letters
$letters = $service->listLetters(limit: 25);

// Get a letter
$letter = $service->getLetter('ltr_abc123');

// Create a letter
$letter = $service->createLetter(
    to: 'adr_abc123',
    from: 'adr_def456',
    file: '<html><body><p>Dear {{name}}, welcome!</p></body></html>',
    description: 'Welcome letter',
    color: true,
    doubleSided: true,
);

// List postcards
$postcards = $service->listPostcards(limit: 25);

// Get a postcard
$postcard = $service->getPostcard('psc_abc123');

// Create a postcard
$postcard = $service->createPostcard(
    to: 'adr_abc123',
    from: 'adr_def456',
    front: '<html><body><h1>Hello!</h1></body></html>',
    back: '<html><body><p>Return address</p></body></html>',
    description: 'Marketing postcard',
);

// List addresses
$addresses = $service->listAddresses();
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
- A [Lob](https://lob.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
