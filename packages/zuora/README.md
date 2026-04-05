# Integration: Zuora

> Zuora subscription management integration for the [Laravel AI SDK](https://github.com/laravel/ai) — query accounts, subscriptions, invoices, and payments. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to subscription billing data. Look up customer accounts, review subscription details, track invoices and payments — all through the [Zuora REST API v2](https://developer.zuora.com/api-reference/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Zuora tool lets AI agents query billing data, review customer accounts, and monitor subscription health — giving agents visibility into the revenue pipeline.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-zuora
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Zuora OAuth 2.0 access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'zuora' => [
        'access_token' => env('ZUORA_ACCESS_TOKEN'),
        'base_url'     => env('ZUORA_BASE_URL', 'https://rest.zuora.com/v2'),
    ],
];
```

### Base URLs by Environment

| Environment | Base URL |
|-------------|----------|
| US Production | `https://rest.zuora.com/v2` |
| EU Production | `https://rest.eu.zuora.com/v2` |
| US Sandbox | `https://rest.sandbox.na.zuora.com/v2` |
| EU Sandbox | `https://rest.sandbox.eu.zuora.com/v2` |

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `zuora_list_accounts` | read | List customer accounts with filtering and pagination |
| `zuora_get_account` | read | Get details of a specific account by ID |
| `zuora_list_subscriptions` | read | List subscriptions with filtering and pagination |
| `zuora_get_subscription` | read | Get details of a specific subscription by ID |
| `zuora_list_invoices` | read | List invoices with filtering and pagination |
| `zuora_list_payments` | read | List payments with filtering and pagination |
| `zuora_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Zuora\ZuoraService;
use OpenCompany\Integrations\Zuora\Tools\ZuoraListAccounts;
use OpenCompany\Integrations\Zuora\Tools\ZuoraGetAccount;

// Create tools
$service = app(ZuoraService::class);
$tools = [
    new ZuoraListAccounts($service),
    new ZuoraGetAccount($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me all active subscriptions for Acme Corp');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('zuora');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Zuora\Tools\ZuoraListAccounts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Zuora\ZuoraService;

$service = app(ZuoraService::class);

// List accounts
$accounts = $service->listAccounts(20);

// Get a specific account
$account = $service->getAccount('8a90b89a8a...');

// List subscriptions
$subscriptions = $service->listSubscriptions(20, null, ['filter' => 'status.EQ:Active']);

// Get a specific subscription
$subscription = $service->getSubscription('8a90b89a8a...');

// List invoices
$invoices = $service->listInvoices(20);

// List payments
$payments = $service->listPayments(20);

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
- A [Zuora](https://www.zuora.com) tenant with OAuth 2.0 API access

## License

MIT — see [LICENSE](LICENSE)
