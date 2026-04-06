# Integration: Stripe Connect

> Stripe Connect integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage connected accounts, payouts, balances, and capabilities. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Stripe Connect platform management. List and inspect connected accounts, track payouts, review balance transactions, and check account capabilities — all through the [Stripe Connect](https://stripe.com/connect) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Stripe Connect tool lets AI agents monitor platform activity, track payouts to connected accounts, and review balance transactions — giving agents financial awareness of your Connect platform.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-stripe-connect
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Stripe API key (used as a Bearer token).

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'stripe-connect' => [
        'access_token' => env('STRIPE_CONNECT_ACCESS_TOKEN'),
        'base_url'     => env('STRIPE_CONNECT_BASE_URL', 'https://api.stripe.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `stripe_connect_list_accounts` | read | List connected Stripe accounts |
| `stripe_connect_get_account` | read | Retrieve a connected account by ID |
| `stripe_connect_list_payouts` | read | List payouts with optional filtering by status and arrival date |
| `stripe_connect_get_payout` | read | Retrieve a payout by ID |
| `stripe_connect_list_balances` | read | List balance transactions |
| `stripe_connect_list_capabilities` | read | List capabilities for a connected account |
| `stripe_connect_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\StripeConnect\StripeConnectService;
use OpenCompany\Integrations\StripeConnect\Tools\StripeConnectListAccounts;
use OpenCompany\Integrations\StripeConnect\Tools\StripeConnectListPayouts;

// Create tools
$service = app(StripeConnectService::class);
$tools = [
    new StripeConnectListAccounts($service),
    new StripeConnectListPayouts($service),
];
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('stripe-connect');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\StripeConnect\Tools\StripeConnectListAccounts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\StripeConnect\StripeConnectService;

$service = app(StripeConnectService::class);

// List connected accounts
$accounts = $service->listAccounts(['limit' => 25]);

// Get a specific account
$account = $service->getAccount('acct_1234567890');

// List payouts
$payouts = $service->listPayouts(['status' => 'paid', 'limit' => 10]);

// Get a specific payout
$payout = $service->getPayout('po_1234567890');

// List balance transactions
$balances = $service->listBalanceTransactions(['limit' => 25]);

// List capabilities for an account
$capabilities = $service->listCapabilities(['account' => 'acct_1234567890']);

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
- A [Stripe](https://stripe.com) account with Connect enabled

## License

MIT — see [LICENSE](LICENSE)
