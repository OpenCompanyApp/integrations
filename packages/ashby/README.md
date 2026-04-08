# Integration: Ashby

> Ashby ATS integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage jobs, applications, and interviews. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your applicant tracking system. Browse job postings, review applications, and check interview schedules — all through the [Ashby](https://ashbyhq.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Ashby tool lets AI agents manage recruiting workflows — browsing open positions, reviewing candidate applications, and tracking interview schedules.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-ashby
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Ashby API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'ashby' => [
        'access_token' => env('ASHBY_ACCESS_TOKEN'),
        'url'          => env('ASHBY_URL', 'https://api.ashbyhq.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `ashby_list_applications` | read | List job applications with optional filters (job, status) |
| `ashby_get_application` | read | Get details for a specific application |
| `ashby_list_jobs` | read | List job postings with optional status filter |
| `ashby_get_job` | read | Get details for a specific job |
| `ashby_list_interviews` | read | List interviews with optional application filter |
| `ashby_get_interview` | read | Get details for a specific interview |
| `ashby_get_current_user` | read | Get the authenticated user's profile |

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
    ->prompt('List all open engineering positions and their application counts');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

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
$jobs = $service->listJobs(status: 'open');

// Get a specific job
$job = $service->getJob('job_abc123');

// List applications for a job
$applications = $service->listApplications(jobId: 'job_abc123');

// Get a specific application
$application = $service->getApplication('app_xyz789');

// List interviews for an application
$interviews = $service->listInterviews(applicationId: 'app_xyz789');

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
- An [Ashby](https://ashbyhq.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
