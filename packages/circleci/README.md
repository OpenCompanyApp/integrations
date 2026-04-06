# Integration: CircleCI

> CircleCI integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage pipelines, workflows, and projects. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your CI/CD pipelines. List and inspect pipelines, monitor workflow statuses, manage projects, and trigger new builds — all through the [CircleCI API v2](https://circleci.com/docs/api/v2/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This CircleCI tool lets AI agents monitor build statuses, inspect pipeline details, and trigger new deployments — giving agents awareness of your CI/CD processes.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-circleci
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a CircleCI Personal API Token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'circleci' => [
        'access_token' => env('CIRCLECI_TOKEN'),
        'url'          => env('CIRCLECI_API_URL', 'https://circleci.com/api'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `circleci_list_pipelines` | read | List recent pipelines for an organization |
| `circleci_get_pipeline` | read | Get details for a specific pipeline |
| `circleci_list_workflows` | read | List workflows for a pipeline |
| `circleci_get_workflow` | read | Get details for a specific workflow |
| `circleci_list_projects` | read | List projects in an organization |
| `circleci_trigger_pipeline` | write | Trigger a new pipeline on a project |
| `circleci_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\CircleCI\CircleCIService;
use OpenCompany\Integrations\CircleCI\Tools\CircleCIListPipelines;
use OpenCompany\Integrations\CircleCI\Tools\CircleCITriggerPipeline;

// Create tools
$service = app(CircleCIService::class);
$tools = [
    new CircleCIListPipelines($service),
    new CircleCITriggerPipeline($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('What is the status of the latest pipeline on main?');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('circleci');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\CircleCI\Tools\CircleCIListPipelines::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\CircleCI\CircleCIService;

$service = app(CircleCIService::class);

// Get current user
$user = $service->getCurrentUser();

// List pipelines
$pipelines = $service->listPipelines(['org-slug' => 'gh/my-org', 'limit' => 10]);

// Get a specific pipeline
$pipeline = $service->getPipeline('pipeline-uuid');

// List workflows for a pipeline
$workflows = $service->listWorkflows('pipeline-uuid');

// Get a specific workflow
$workflow = $service->getWorkflow('workflow-uuid');

// List projects
$projects = $service->listProjects(['org-slug' => 'gh/my-org']);

// Trigger a pipeline
$result = $service->triggerPipeline('gh/my-org', 'my-repo', [
    'branch' => 'main',
    'parameters' => ['deploy_env' => 'staging'],
]);
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
- A [CircleCI](https://circleci.com) account with a Personal API Token

## License

MIT — see [LICENSE](LICENSE)
