# Integration: Chargebee

> Chargebee integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage subscriptions, customers, and invoices. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to subscription billing and revenue management. Browse subscriptions, look up customer details, and review invoices — all through the [Chargebee](https://www.chargebee.com/) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Chargebee tool lets AI agents manage billing operations — browsing subscriptions, looking up customer details, reviewing invoices, and verifying credentials — giving agents visibility into subscription lifecycle data.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-chargebee
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Chargebee API access token and site name.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'chargebee' => [
        'access_token' => env('CHARGEBEE_ACCESS_TOKEN'),
        'site_name'    => env('CHARGEBEE_SITE_NAME'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `chargebee_list_subscriptions` | read | List subscriptions with filtering by state and pagination |
| `chargebee_get_subscription` | read | Retrieve details of a single subscription |
| `chargebee_list_customers` | read | List customers with pagination |
| `chargebee_get_customer` | read | Retrieve details of a single customer |
| `chargebee_list_invoices` | read | List invoices with filtering by status and pagination |
| `chargebee_get_invoice` | read | Retrieve details of a single invoice |
| `chargebee_get_current_user` | read | Retrieve current authenticated user information |

## Quick Start

```php
use OpenCompany\Integrations\Chargebee\ChargebeeService;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeListSubscriptions;

// Create tools
$service = app(ChargebeeService::class);
$tools = [
    new ChargebeeListSubscriptions($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all active subscriptions');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('chargebee');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Chargebee\Tools\ChargebeeListSubscriptions::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Chargebee\ChargebeeService;

$service = app(ChargebeeService::class);

// List subscriptions
$subscriptions = $service->listSubscriptions(limit: 25, state: 'active');

// Get a customer
$customer = $service->getCustomer('customer_xyz');

// List invoices
$invoices = $service->listInvoices(status: 'paid');

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
- A [Chargebee](https://www.chargebee.com/) account with API access

## License

MIT — see [LICENSE](LICENSE)
