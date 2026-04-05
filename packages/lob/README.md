# Integration: Lob

> Lob direct mail and address verification integration for the [Laravel AI SDK](https://github.com/laravel/ai) — send postcards and letters, verify US addresses. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents the ability to send physical mail and verify addresses through the [Lob](https://lob.com) API. Automate postcard campaigns, send personalized letters, and validate shipping addresses — all from within your AI workflows.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Lob tool lets AI agents send direct mail, track postcard deliveries, and verify addresses — enabling physical-world automation from digital workflows.

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
        'url'     => env('LOB_URL', 'https://api.lob.com/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `lob_send_postcard` | write | Send a postcard with custom HTML or template, merge variables |
| `lob_send_letter` | write | Send a letter with custom HTML or template |
| `lob_get_postcard` | read | Retrieve a postcard by ID (status, tracking, thumbnails) |
| `lob_list_postcards` | read | List postcards with pagination |
| `lob_verify_address` | read | Verify a US mailing address for deliverability |
| `lob_get_current_user` | read | Get current Lob account info and balance |

## Quick Start

```php
use OpenCompany\Integrations\Lob\LobService;
use OpenCompany\Integrations\Lob\Tools\LobSendPostcard;
use OpenCompany\Integrations\Lob\Tools\LobVerifyAddress;

// Create tools
$service = app(LobService::class);
$tools = [
    new LobSendPostcard($service),
    new LobVerifyAddress($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Send a postcard to 185 Berry St, San Francisco, CA 94107 saying "Welcome aboard!"');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('lob');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Lob\Tools\LobSendPostcard::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Lob\LobService;

$service = app(LobService::class);

// Send a postcard
$postcard = $service->sendPostcard(
    to: 'adr_abc123',
    from: 'adr_def456',
    front: '<html><body><h1>Hello!</h1></body></html>',
    back: '<html><body><p>Return address</p></body></html>',
    mergeVariables: ['name' => 'Alice'],
);

// Send a letter
$letter = $service->sendLetter(
    to: 'adr_abc123',
    from: 'adr_def456',
    file: '<html><body><p>Dear {{name}}, welcome!</p></body></html>',
    color: true,
    doubleSided: true,
);

// Get a postcard
$postcard = $service->getPostcard('psc_abc123');

// List postcards
$list = $service->listPostcards(limit: 25);

// Verify an address
$verification = $service->verifyAddress(
    address: '185 Berry St Ste 6100',
    city: 'San Francisco',
    state: 'CA',
    zip: '94107',
);

// Get account info
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
- A [Lob](https://lob.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
