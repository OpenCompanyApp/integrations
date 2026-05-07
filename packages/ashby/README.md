# Integration: Ashby

> Ashby ATS integration for the [Laravel AI SDK](https://github.com/laravel/ai) - manage candidates, applications, jobs, interviews, offers, webhooks, and raw Ashby API calls. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Ashby recruiting workflows. Browse jobs, sync candidates, review applications, check interviews, inspect offers, and configure webhook settings through the [Ashby developer API](https://developers.ashbyhq.com/reference).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace - with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Ashby package lets AI agents manage recruiting workflows - browsing open positions, reviewing candidate applications, tracking interview schedules, syncing offers, and using raw endpoint calls when Ashby adds new API resources.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-ashby
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Ashby API key. Ashby's API uses HTTP Basic auth with the API key as the username and an empty password.

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

This package exposes 44 tools:

| Area | Tools |
|------|-------|
| Raw API | `ashby_api_post` |
| Account | `ashby_get_current_user`, `ashby_list_users` |
| Candidates | `ashby_list_candidates`, `ashby_search_candidates`, `ashby_get_candidate`, `ashby_create_candidate`, `ashby_update_candidate`, `ashby_create_note`, `ashby_list_candidate_notes` |
| Applications | `ashby_list_applications`, `ashby_get_application`, `ashby_create_application`, `ashby_update_application`, `ashby_list_criteria_evaluations` |
| Jobs | `ashby_list_jobs`, `ashby_search_jobs`, `ashby_get_job`, `ashby_create_job`, `ashby_update_job`, `ashby_list_job_postings`, `ashby_get_job_posting`, `ashby_list_openings`, `ashby_create_opening`, `ashby_list_departments`, `ashby_list_locations`, `ashby_list_sources` |
| Interviews | `ashby_list_interviews`, `ashby_get_interview`, `ashby_list_interview_plans`, `ashby_list_interview_schedules`, `ashby_update_interview_schedule`, `ashby_list_interview_events` |
| Offers | `ashby_list_offers`, `ashby_get_offer`, `ashby_create_offer`, `ashby_update_offer`, `ashby_approve_offer` |
| Files and configuration | `ashby_get_file`, `ashby_set_custom_field_value`, `ashby_list_webhooks`, `ashby_get_webhook`, `ashby_create_webhook`, `ashby_update_assessment` |

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

If you have `integration-core` installed, all tools auto-register with the `ToolProviderRegistry`:

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

MIT - see [LICENSE](LICENSE)
