# Integration: Workable

> Workable ATS integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage jobs, candidates, and team members. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your recruiting pipeline. List and manage job postings, view and create candidates, and look up team members — all through the [Workable](https://www.workable.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Workable tool lets AI agents interact with your ATS — checking open positions, reviewing candidates, and even adding new applicants to the pipeline.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-workable
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Workable API access token and your account subdomain.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'workable' => [
        'access_token' => env('WORKABLE_ACCESS_TOKEN'),
        'subdomain'    => env('WORKABLE_SUBDOMAIN'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `workable_list_jobs` | read | List jobs, optionally filtered by state (published, draft, archived, closed) |
| `workable_get_job` | read | Get full details for a specific job by shortcode |
| `workable_list_candidates` | read | List candidates for a specific job |
| `workable_get_candidate` | read | Get full details for a specific candidate |
| `workable_create_candidate` | write | Create a new candidate for a job |
| `workable_list_members` | read | List team members in the account |
| `workable_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Workable\WorkableService;
use OpenCompany\Integrations\Workable\Tools\WorkableListJobs;
use OpenCompany\Integrations\Workable\Tools\WorkableCreateCandidate;

// Create tools
$service = app(WorkableService::class);
$tools = [
    new WorkableListJobs($service),
    new WorkableCreateCandidate($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all published jobs and show me the candidates for the first one.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('workable');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Workable\Tools\WorkableListJobs::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Workable\WorkableService;

$service = app(WorkableService::class);

// List published jobs
$jobs = $service->listJobs('published');

// Get a specific job
$job = $service->getJob('GRO-001');

// List candidates for a job
$candidates = $service->listCandidates('GRO-001');

// Get a specific candidate
$candidate = $service->getCandidate('abc123');

// Create a candidate
$newCandidate = $service->createCandidate('GRO-001', 'Jane Smith', 'jane@example.com');

// List team members
$members = $service->listMembers();

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
- A [Workable](https://www.workable.com) account with API access enabled

## License

MIT — see [LICENSE](LICENSE)
