# Integration: Workable

> Workable ATS integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage jobs, candidates, and team members. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your recruiting pipeline. List and create job postings, browse candidates, and look up team members — all through the [Workable](https://www.workable.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Workable tool lets AI agents manage recruiting workflows, check candidate statuses, and assist hiring managers — streamlining the entire hiring process.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-workable
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Workable access token and account subdomain.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'workable' => [
        'access_token' => env('WORKABLE_ACCESS_TOKEN'),
        'subdomain'    => env('WORKABLE_SUBDOMAIN'),
        'base_url'     => env('WORKABLE_BASE_URL', 'https://www.workable.com/spi/v3/accounts'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `workable_list_jobs` | read | List jobs with optional state filtering and pagination |
| `workable_get_job` | read | Get full details for a specific job by shortcode |
| `workable_create_job` | write | Create a new job posting |
| `workable_list_candidates` | read | List candidates for a specific job with pagination |
| `workable_get_candidate` | read | Get full details for a specific candidate |
| `workable_list_members` | read | List all team members (recruiters and hiring managers) |
| `workable_get_current_user` | read | Get the currently authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Workable\WorkableService;
use OpenCompany\Integrations\Workable\Tools\WorkableListJobs;
use OpenCompany\Integrations\Workable\Tools\WorkableGetJob;

// Create tools
$service = app(WorkableService::class);
$tools = [
    new WorkableListJobs($service),
    new WorkableGetJob($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all published jobs and show how many candidates each has.');
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

// Get job details
$job = $service->getJob('GROVF002');

// Create a new job
$newJob = $service->createJob([
    'title' => 'Senior Backend Engineer',
    'description' => '<p>We are looking for...</p>',
    'department' => 'Engineering',
    'employment_type' => 'full-time',
]);

// List candidates for a job
$candidates = $service->listCandidates('GROVF002');

// Get candidate details
$candidate = $service->getCandidate('abc123def456');

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
- A [Workable](https://www.workable.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
