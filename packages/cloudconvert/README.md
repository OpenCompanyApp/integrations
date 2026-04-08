# Integration: CloudConvert

> CloudConvert integration for the [Laravel AI SDK](https://github.com/laravel/ai) — create jobs and tasks, manage file conversions. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to [CloudConvert](https://cloudconvert.com)'s powerful file conversion API. Convert between 200+ file formats, capture websites, merge PDFs, optimize images, and more — all through the CloudConvert v2 API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This CloudConvert tool lets AI agents create file conversion jobs, monitor task progress, and retrieve converted files — enabling automated document processing pipelines.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-cloudconvert
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a CloudConvert API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'cloudconvert' => [
        'api_key' => env('CLOUDCONVERT_API_KEY'),
        'url'     => env('CLOUDCONVERT_URL', 'https://api.cloudconvert.com/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `cloudconvert_create_job` | write | Create a new job with tasks (import, convert, export pipeline) |
| `cloudconvert_get_job` | read | Get job details and status |
| `cloudconvert_list_jobs` | read | List jobs with filtering and pagination |
| `cloudconvert_create_task` | write | Create a standalone task |
| `cloudconvert_get_task` | read | Get task details, status, and download URLs |
| `cloudconvert_list_tasks` | read | List tasks with filtering and pagination |
| `cloudconvert_get_current_user` | read | Get user profile and remaining credits |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\CloudConvert\CloudConvertService;
use OpenCompany\Integrations\CloudConvert\Tools\CloudConvertCreateJob;
use OpenCompany\Integrations\CloudConvert\Tools\CloudConvertGetJob;

// Create tools
$service = app(CloudConvertService::class);
$tools = [
    new CloudConvertCreateJob($service),
    new CloudConvertGetJob($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Convert the PDF at https://example.com/document.pdf to PNG images');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('cloudconvert');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\CloudConvert\Tools\CloudConvertCreateJob::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\CloudConvert\CloudConvertService;

$service = app(CloudConvertService::class);

// Create a job with a full conversion pipeline
$job = $service->createJob([
    [
        'operation' => 'import/url',
        'url' => 'https://example.com/document.pdf',
        'filename' => 'document.pdf',
    ],
    [
        'operation' => 'convert',
        'input' => 'import',
        'output_format' => 'png',
    ],
    [
        'operation' => 'export/url',
        'input' => 'convert',
    ],
]);

// Check job status
$status = $service->getJob($job['data']['id']);

// List recent jobs
$jobs = $service->listJobs(perPage: 10);

// Create a standalone task
$task = $service->createTask('convert', [
    'output_format' => 'pdf',
], name: 'my-convert', input: 'previous-task');

// Get user info and credits
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
- A [CloudConvert](https://cloudconvert.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
