# Integration: Salesloft

> Salesloft integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage call sequences, automation rules, and user data. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your sales engagement platform. Manage call sequences, review automation rules, and verify user identity — all through the [Salesloft](https://salesloft.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Salesloft tool lets AI agents manage call sequences and review automation rules — giving agents visibility into sales workflows and the ability to create new sequences.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-salesloft
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Salesloft API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'salesloft' => [
        'access_token' => env('SALESLOFT_ACCESS_TOKEN'),
        'url'          => env('SALESLOFT_URL', 'https://api.salesloft.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `salesloft_list_sequences` | read | List call sequences with optional status filtering |
| `salesloft_get_sequence` | read | Get details of a specific call sequence |
| `salesloft_create_sequence` | write | Create a new call sequence with steps and targets |
| `salesloft_list_rules` | read | List automation rules |
| `salesloft_get_rule` | read | Get details of a specific automation rule |
| `salesloft_get_current_user` | read | Get the currently authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Salesloft\SalesloftService;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftListSequences;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftGetCurrentUser;

// Create tools
$service = app(SalesloftService::class);
$tools = [
    new SalesloftListSequences($service),
    new SalesloftGetCurrentUser($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all active call sequences in Salesloft');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('salesloft');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Salesloft\Tools\SalesloftListSequences::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Salesloft\SalesloftService;

$service = app(SalesloftService::class);

// List sequences
$sequences = $service->listSequences(limit: 50, status: 'active');

// Get a specific sequence
$sequence = $service->getSequence(12345);

// Create a sequence
$sequence = $service->createSequence([
    'name' => 'Q1 Outreach Campaign',
    'owner_id' => 42,
    'status' => 'active',
]);

// List rules
$rules = $service->listRules();

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
- A [Salesloft](https://salesloft.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
