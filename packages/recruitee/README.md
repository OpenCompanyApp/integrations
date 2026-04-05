# Integration: Recruitee

> Recruitee ATS integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list offers, candidates, departments, and user info. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your applicant tracking system. List open positions, browse candidates, view departments, and check user context — all through the [Recruitee](https://recruitee.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Recruitee tool lets AI agents query job offers, review candidate profiles, and access hiring pipeline data — enabling agents to assist with recruitment workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-recruitee
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Recruitee API access token and company ID.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'recruitee' => [
        'access_token' => env('RECRUITEE_ACCESS_TOKEN'),
        'company_id'   => env('RECRUITEE_COMPANY_ID'),
        'url'          => env('RECRUITEE_URL', 'https://{company}.recruitee.com/api/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `recruitee_list_offers` | read | List job offers with status filter and pagination |
| `recruitee_get_offer` | read | Get details for a specific job offer |
| `recruitee_list_candidates` | read | List candidates with pagination |
| `recruitee_get_candidate` | read | Get details for a specific candidate |
| `recruitee_list_departments` | read | List all departments |
| `recruitee_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\Recruitee\RecruiteeService;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeListOffers;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeGetCandidate;

// Create tools
$service = app(RecruiteeService::class);
$tools = [
    new RecruiteeListOffers($service),
    new RecruiteeGetCandidate($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('How many open positions do we have right now?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('recruitee');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Recruitee\Tools\RecruiteeListOffers::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Recruitee\RecruiteeService;

$service = app(RecruiteeService::class);

// List open offers
$offers = $service->listOffers(['status' => 'open']);

// Get a specific offer
$offer = $service->getOffer(12345);

// List candidates
$candidates = $service->listCandidates(['page' => 1, 'limit' => 20]);

// Get a specific candidate
$candidate = $service->getCandidate(67890);

// List departments
$departments = $service->listDepartments();

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
- A [Recruitee](https://recruitee.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
