# Integration: Ashby

> AshbyHQ integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage jobs, applications, candidates, interviews, and notes. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your ATS. List and search jobs, review applications and candidates, schedule interviews, and add notes — all through the [Ashby](https://ashbyhq.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Ashby tool lets AI agents manage recruiting workflows — browsing open positions, reviewing candidate pipelines, checking interview schedules, and leaving notes for the hiring team.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-ashby
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Ashby API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'ashby' => [
        'api_key' => env('ASHBY_API_KEY'),
        'url'     => env('ASHBY_URL', 'https://api.ashbyhq.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `ashby_list_jobs` | read | List open and closed job postings |
| `ashby_get_job` | read | Get detailed info about a specific job |
| `ashby_list_applications` | read | List job applications with filters |
| `ashby_get_application` | read | Get detailed info about a specific application |
| `ashby_list_candidates` | read | List candidates in the ATS |
| `ashby_create_note` | write | Add a note to a candidate, application, or job |
| `ashby_list_interviews` | read | List scheduled interviews |
| `ashby_get_current_user` | read | Get info about the authenticated Ashby user |

## Quick Start

```php
use OpenCompany\Integrations\Ashby\AshbyService;
use OpenCompany\Integrations\Ashby\Tools\AshbyListJobs;
use OpenCompany\Integrations\Ashby\Tools\AshbyListApplications;

// Create tools
$service = app(AshbyService::class);
$tools = [
    new AshbyListJobs($service),
    new AshbyListApplications($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all open engineering jobs and their application counts');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('ashby');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Ashby\Tools\AshbyListJobs::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Ashby\AshbyService;

$service = app(AshbyService::class);

// List open jobs
$jobs = $service->listJobs(['status' => 'open']);

// Get a specific job
$job = $service->getJob(['jobId' => 'job_abc123']);

// List applications for a job
$applications = $service->listApplications(['jobId' => 'job_abc123']);

// Search candidates
$candidates = $service->listCandidates(['name' => 'Jane']);

// Create a note
$service->createNote([
    'subjectId' => 'cand_abc123',
    'subjectType' => 'candidate',
    'content' => 'Strong fit for the role.',
]);

// List upcoming interviews
$interviews = $service->listInterviews(['status' => 'scheduled']);

// Verify connection
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
- An [Ashby](https://ashbyhq.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
