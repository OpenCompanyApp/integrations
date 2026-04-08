# Integration: Qualifying

> Qualifying CRM integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage accounts, contacts, and deals. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your sales CRM. List and retrieve accounts, contacts, and deals — all through the [Qualifying](https://qualifying.ai) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Qualifying tool lets AI agents query and manage sales data — giving agents awareness of your pipeline, accounts, and contacts.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-qualifying
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Qualifying access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'qualifying' => [
        'access_token' => env('QUALIFYING_ACCESS_TOKEN'),
        'url'          => env('QUALIFYING_URL', 'https://api.qualifying.ai'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `qualifying_list_accounts` | read | List sales accounts with pagination |
| `qualifying_get_account` | read | Get details for a specific account |
| `qualifying_list_contacts` | read | List contacts with optional account filter |
| `qualifying_get_contact` | read | Get details for a specific contact |
| `qualifying_list_deals` | read | List deals with optional stage filter |
| `qualifying_get_current_user` | read | Get the currently authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Qualifying\QualifyingService;
use OpenCompany\Integrations\Qualifying\Tools\QualifyingListAccounts;
use OpenCompany\Integrations\Qualifying\Tools\QualifyingListDeals;

// Create tools
$service = app(QualifyingService::class);
$tools = [
    new QualifyingListAccounts($service),
    new QualifyingListDeals($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me all deals in the "qualified" stage');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('qualifying');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Qualifying\Tools\QualifyingListDeals::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Qualifying\QualifyingService;

$service = app(QualifyingService::class);

// List accounts
$accounts = $service->listAccounts(25, 1);

// Get a specific account
$account = $service->getAccount('acc_123');

// List contacts (optionally filtered by account)
$contacts = $service->listContacts(25, 1, 'acc_123');

// Get a specific contact
$contact = $service->getContact('con_456');

// List deals (optionally filtered by stage)
$deals = $service->listDeals(25, 1, 'qualified');

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
- A [Qualifying](https://qualifying.ai) account with API access

## License

MIT — see [LICENSE](LICENSE)
