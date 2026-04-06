# Integration: ServiceM8

> ServiceM8 integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage jobs, clients, activities, and users. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to field service management. List and create jobs, manage clients, track activities, and identify the connected user — all through the [ServiceM8](https://www.servicem8.com/) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This ServiceM8 tool lets AI agents manage field service jobs, look up client details, and track job activity — giving agents operational awareness of your service business.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-service-m8
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a ServiceM8 API access token (OAuth bearer token).

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'service_m8' => [
        'access_token' => env('SERVICEM8_ACCESS_TOKEN'),
        'url'          => env('SERVICEM8_URL', 'https://api.servicem8.com/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `servicem8_list_jobs` | read | List jobs with optional filtering by status and pagination |
| `servicem8_get_job` | read | Get details of a specific job by UUID |
| `servicem8_list_clients` | read | List clients with pagination |
| `servicem8_get_client` | read | Get details of a specific client by UUID |
| `servicem8_create_job` | write | Create a new job with client, template, and description |
| `servicem8_list_activities` | read | List activity records (status changes, comments, notes) |
| `servicem8_get_current_user` | read | Get the currently authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\ServiceM8\ServiceM8Service;
use OpenCompany\Integrations\ServiceM8\Tools\ServiceM8ListJobs;
use OpenCompany\Integrations\ServiceM8\Tools\ServiceM8CreateJob;

// Create tools
$service = app(ServiceM8Service::class);
$tools = [
    new ServiceM8ListJobs($service),
    new ServiceM8CreateJob($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all open jobs and create a new one for client ABC123');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('service_m8');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\ServiceM8\Tools\ServiceM8ListJobs::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\ServiceM8\ServiceM8Service;

$service = app(ServiceM8Service::class);

// List open jobs
$jobs = $service->listJobs(['status' => 'open']);

// Get a specific job
$job = $service->getJob('job-uuid-here');

// Create a job
$job = $service->createJob([
    'client_uuid' => 'client-uuid-here',
    'job_description' => 'Fix the leaking pipe',
]);

// List clients
$clients = $service->listClients();

// Get activities
$activities = $service->listActivities(['job_uuid' => 'job-uuid-here']);

// Current user
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
- A [ServiceM8](https://www.servicem8.com/) account with API access

## License

MIT — see [LICENSE](LICENSE)
