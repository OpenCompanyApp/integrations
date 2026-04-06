# Integration: Vercel

> Vercel integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage deployments, projects, and domains. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Vercel deployment platform. List and inspect deployments, browse projects, view domain configurations, and trigger new deployments — all through the [Vercel API](https://vercel.com/docs/api).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Vercel tool lets AI agents inspect deployments, check project status, and manage hosting configuration — enabling agents to work with your deployment pipeline.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-vercel
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Vercel API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'vercel' => [
        'access_token' => env('VERCEL_ACCESS_TOKEN'),
        'base_url'     => env('VERCEL_BASE_URL', 'https://api.vercel.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `vercel_list_deployments` | read | List deployments, optionally filtered by project or state |
| `vercel_get_deployment` | read | Get details for a specific deployment |
| `vercel_list_projects` | read | List all Vercel projects |
| `vercel_get_project` | read | Get details for a specific project |
| `vercel_create_deployment` | write | Create a new deployment |
| `vercel_list_domains` | read | List domains for a project |
| `vercel_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Vercel\VercelService;
use OpenCompany\Integrations\Vercel\Tools\VercelListDeployments;
use OpenCompany\Integrations\Vercel\Tools\VercelListProjects;

// Create tools
$service = app(VercelService::class);
$tools = [
    new VercelListDeployments($service),
    new VercelListProjects($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my most recent deployments');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('vercel');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Vercel\Tools\VercelListDeployments::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Vercel\VercelService;

$service = app(VercelService::class);

// Get current user
$user = $service->getCurrentUser();

// List projects
$projects = $service->listProjects(['limit' => 10]);

// Get a project
$project = $service->getProject('my-project-id');

// List deployments
$deployments = $service->listDeployments(['projectId' => 'my-project-id', 'limit' => 5]);

// Get a specific deployment
$deployment = $service->getDeployment('dpl_xxxxxxxxxxxxxxxxxxxx');

// List domains for a project
$domains = $service->listDomains('my-project-id');

// Create a deployment
$deployment = $service->createDeployment([
    'name' => 'my-project',
    'target' => 'production',
    'gitSource' => ['type' => 'github', 'ref' => 'main', 'repoId' => 12345],
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
- A [Vercel](https://vercel.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
