# Integration: Clearbit

> Clearbit enrichment integration for the [Laravel AI SDK](https://github.com/laravel/ai) — enrich people and companies, reveal visitor identity, prospect by role. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to powerful data enrichment. Look up person and company data, identify website visitors by IP, and find prospects by job title — all through the [Clearbit](https://clearbit.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Clearbit tool lets AI agents enrich contact data, identify anonymous website visitors, and find potential prospects — giving agents data-driven context for sales, marketing, and research workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-clearbit
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Clearbit API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'clearbit' => [
        'api_key' => env('CLEARBIT_API_KEY'),
        'url'     => env('CLEARBIT_URL', 'https://person.clearbit.com/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `clearbit_enrich_person` | read | Enrich a person by email — social profiles, employment, demographics |
| `clearbit_enrich_company` | read | Enrich a company by domain — metrics, categorization, social profiles |
| `clearbit_reveal` | read | Identify the company/person behind an IP address |
| `clearbit_prospect` | read | Find people by job title and/or company name |
| `clearbit_list_autocomplete` | read | Search for companies by name (autocomplete) |
| `clearbit_get_current_user` | read | Get authenticated user's Clearbit account info |

## Quick Start

```php
use OpenCompany\Integrations\Clearbit\ClearbitService;
use OpenCompany\Integrations\Clearbit\Tools\ClearbitEnrichPerson;
use OpenCompany\Integrations\Clearbit\Tools\ClearbitEnrichCompany;

// Create tools
$service = app(ClearbitService::class);
$tools = [
    new ClearbitEnrichPerson($service),
    new ClearbitEnrichCompany($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Look up alex@stripe.com and tell me about their company.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('clearbit');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Clearbit\Tools\ClearbitEnrichPerson::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Clearbit\ClearbitService;

$service = app(ClearbitService::class);

// Enrich a person
$person = $service->enrichPerson('alex@stripe.com');

// Enrich a company
$company = $service->enrichCompany('stripe.com');

// Reveal visitor identity from IP
$reveal = $service->reveal('104.193.168.24');

// Prospect for people
$prospects = $service->prospect(title: 'CEO', company: 'Stripe');

// Autocomplete companies
$suggestions = $service->autocomplete('Strip');

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
- A [Clearbit](https://clearbit.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
