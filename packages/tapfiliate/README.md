# Integration: Tapfiliate

> Tapfiliate affiliate marketing integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage affiliates, track conversions, and monitor referral performance. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to affiliate marketing data. Manage affiliates, conversions, commissions, customers, programs, and affiliate groups through the [Tapfiliate REST API](https://tapfiliate.com/docs/rest/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Tapfiliate integration lets AI agents query affiliate data, track conversions, and manage referral programs — giving agents awareness of marketing performance.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-tapfiliate
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Tapfiliate API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'tapfiliate' => [
        'api_key' => env('TAPFILIATE_API_KEY'),
        'url'     => env('TAPFILIATE_URL', 'https://api.tapfiliate.com/1.6'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `tapfiliate_get_current_user` | read | Get the currently authenticated user |
| `tapfiliate_list_affiliates` | read | List affiliates with filters |
| `tapfiliate_get_affiliate` | read | Get details for a specific affiliate |
| `tapfiliate_create_affiliate` | write | Create an affiliate |
| `tapfiliate_update_affiliate` | write | Update an affiliate |
| `tapfiliate_delete_affiliate` | write | Delete an affiliate |
| `tapfiliate_set_affiliate_group` | write | Assign an affiliate group |
| `tapfiliate_list_affiliate_notes` | read | List affiliate notes |
| `tapfiliate_list_affiliate_groups` | read | List affiliate groups |
| `tapfiliate_list_conversions` | read | List conversions with optional filters |
| `tapfiliate_get_conversion` | read | Get a conversion |
| `tapfiliate_create_conversion` | write | Create a conversion |
| `tapfiliate_add_conversion_commission` | write | Add a commission line to a conversion |
| `tapfiliate_list_commissions` | read | List commissions |
| `tapfiliate_get_commission` | read | Get a commission |
| `tapfiliate_list_customers` | read | List customers |
| `tapfiliate_create_customer` | write | Create a tracked customer |
| `tapfiliate_list_programs` | read | List programs |
| `tapfiliate_get_program_affiliate` | read | Get a program affiliate record |
| `tapfiliate_update_program_affiliate` | write | Update a program affiliate record |
| `tapfiliate_list_program_commission_types` | read | List program commission types |

## Quick Start

```php
use OpenCompany\Integrations\Tapfiliate\TapfiliateService;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateListAffiliates;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateListConversions;

// Create tools
$service = app(TapfiliateService::class);
$tools = [
    new TapfiliateListAffiliates($service),
    new TapfiliateListConversions($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me the top affiliates by conversion volume');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 21 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('tapfiliate');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateListAffiliates::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Tapfiliate\TapfiliateService;

$service = app(TapfiliateService::class);

// Get current user
$user = $service->getCurrentUser();

// List affiliates
$affiliates = $service->listAffiliates(['limit' => 50, 'page' => 1]);

// Get a specific affiliate
$affiliate = $service->getAffiliate('aff_12345');

// List conversions with filters
$conversions = $service->listConversions([
    'affiliate_id' => 'aff_12345',
    'status' => 'approved',
    'date_from' => '2025-01-01',
]);

// Create a conversion
$conversion = $service->createConversion([
    'affiliate_id' => 'aff_12345',
    'amount' => 99.00,
    'external_id' => 'order_67890',
]);

// List commissions and programs
$commissions = $service->listCommissions(['affiliate_id' => 'aff_12345']);
$programs = $service->listPrograms();
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
- A [Tapfiliate](https://tapfiliate.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
