# Integration: Microsoft Power BI

> Microsoft Power BI integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list workspaces, datasets, and reports. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Power BI business intelligence. Browse workspaces, inspect datasets, and retrieve report details — all through the [Microsoft Power BI REST API](https://learn.microsoft.com/en-us/rest/api/power-bi/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Power BI tool lets AI agents explore business intelligence data, retrieve report metadata, and understand workspace structure — giving agents data-driven awareness of organizational analytics.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-microsoft-power-bi
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Power BI access token obtained via Azure AD OAuth2.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'powerbi' => [
        'access_token' => env('POWER_BI_ACCESS_TOKEN'),
        'url'          => env('POWER_BI_URL', 'https://api.powerbi.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `powerbi_list_workspaces` | read | List Power BI workspaces (groups) the user has access to |
| `powerbi_get_workspace` | read | Get details for a specific workspace by ID |
| `powerbi_list_datasets` | read | List datasets within a workspace |
| `powerbi_get_dataset` | read | Get details for a specific dataset |
| `powerbi_list_reports` | read | List reports within a workspace |
| `powerbi_get_report` | read | Get details for a specific report |

## Quick Start

```php
use OpenCompany\Integrations\PowerBi\PowerBiService;
use OpenCompany\Integrations\PowerBi\Tools\PowerBiListWorkspaces;
use OpenCompany\Integrations\PowerBi\Tools\PowerBiListReports;

// Create tools
$service = app(PowerBiService::class);
$tools = [
    new PowerBiListWorkspaces($service),
    new PowerBiListReports($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all Power BI workspaces and their reports');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('powerbi');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\PowerBi\Tools\PowerBiListWorkspaces::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\PowerBi\PowerBiService;

$service = app(PowerBiService::class);

// List workspaces
$workspaces = $service->listWorkspaces();

// Get a specific workspace
$workspace = $service->getWorkspace('workspace-guid-here');

// List datasets in a workspace
$datasets = $service->listDatasets('workspace-guid-here');

// Get a specific dataset
$dataset = $service->getDataset('workspace-guid-here', 'dataset-guid-here');

// List reports in a workspace
$reports = $service->listReports('workspace-guid-here');

// Get a specific report
$report = $service->getReport('workspace-guid-here', 'report-guid-here');
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
- A Microsoft Azure AD account with Power BI access and a valid OAuth2 access token

## License

MIT — see [LICENSE](LICENSE)
