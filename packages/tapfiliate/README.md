# Integration: Tapfiliate

> Tapfiliate affiliate marketing integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage affiliates, track conversions, and monitor referral performance. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to affiliate marketing data. List and manage affiliates, track conversions, and monitor referral performance — all through the [Tapfiliate](https://tapfiliate.com) API.

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
        'url'     => env('TAPFILIATE_URL', 'https://api.tapfiliate.com/1.5'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `tapfiliate_list_affiliates` | read | List affiliates with pagination |
| `tapfiliate_get_affiliate` | read | Get details for a specific affiliate |
| `tapfiliate_list_conversions` | read | List conversions with optional filters |
| `tapfiliate_create_conversion` | write | Create a new conversion for an affiliate |
| `tapfiliate_get_current_user` | read | Get the currently authenticated user |

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

If you have `integration-core` installed, all 5 tools auto-register with the `ToolProviderRegistry`:

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
$affiliates = $service->listAffiliates(limit: 50, page: 1);

// Get a specific affiliate
$affiliate = $service->getAffiliate('aff_12345');

// List conversions with filters
$conversions = $service->listConversions([
    'affiliate_id' => 'aff_12345',
    'status' => 'approved',
    'from_date' => '2025-01-01',
]);

// Create a conversion
$conversion = $service->createConversion(
    affiliateId: 'aff_12345',
    amount: 99.00,
    externalId: 'order_67890',
);
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
