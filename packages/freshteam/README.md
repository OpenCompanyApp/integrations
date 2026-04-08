# Integration: Freshteam

> Freshteam HR integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage candidates, job postings, employees, and user info. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to HR and recruitment data. List and query candidates, browse job postings, look up employee records, and verify the active user — all through the [Freshteam](https://www.freshteam.com/) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Freshteam tool lets AI agents query recruitment pipelines, manage job postings, and access employee directories — giving agents HR-awareness and recruitment capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-freshteam
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Freshteam API access token and your account domain.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'freshteam' => [
        'access_token' => env('FRESHTEAM_ACCESS_TOKEN'),
        'domain'       => env('FRESHTEAM_DOMAIN'), // e.g. "acme" for acme.freshteam.com
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `freshteam_list_candidates` | read | List recruitment candidates with pagination and status filtering |
| `freshteam_get_candidate` | read | Retrieve details for a specific candidate |
| `freshteam_list_job_postings` | read | List job postings with pagination, status, and department filtering |
| `freshteam_get_job_posting` | read | Retrieve details for a specific job posting |
| `freshteam_list_employees` | read | List employees with pagination and department filtering |
| `freshteam_get_employee` | read | Retrieve details for a specific employee |
| `freshteam_get_current_user` | read | Retrieve the currently authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Freshteam\FreshteamService;
use OpenCompany\Integrations\Freshteam\Tools\FreshteamListCandidates;
use OpenCompany\Integrations\Freshteam\Tools\FreshteamGetCandidate;

// Create tools
$service = app(FreshteamService::class);
$tools = [
    new FreshteamListCandidates($service),
    new FreshteamGetCandidate($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all active candidates and show me the first one');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('freshteam');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Freshteam\Tools\FreshteamListCandidates::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Freshteam\FreshteamService;

$service = app(FreshteamService::class);

// List candidates
$candidates = $service->listCandidates(page: 1, perPage: 20, status: 'active');

// Get a specific candidate
$candidate = $service->getCandidate(12345);

// List job postings
$jobs = $service->listJobPostings(page: 1, perPage: 20, status: 'published');

// Get a specific job posting
$job = $service->getJobPosting(67890);

// List employees
$employees = $service->listEmployees(page: 1, perPage: 50);

// Get a specific employee
$employee = $service->getEmployee(54321);

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
- A [Freshteam](https://www.freshteam.com/) account with API access

## License

MIT — see [LICENSE](LICENSE)
