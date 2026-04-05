# Integration: Tableau

> Tableau business intelligence integration for the [Laravel AI SDK](https://github.com/laravel/ai) — explore workbooks, views, projects, and user info. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Tableau business intelligence. List and inspect workbooks, dashboards, views, and projects — all through the [Tableau REST API](https://help.tableau.com/current/api/rest_api/en-us/REST/rest_api.htm).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Tableau tool lets AI agents explore BI content, inspect dashboards, and surface insights from your Tableau deployment — giving agents data-driven awareness of business intelligence assets.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-tableau
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Tableau personal access token and site ID.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'tableau' => [
        'access_token' => env('TABLEAU_ACCESS_TOKEN'),
        'site_id'      => env('TABLEAU_SITE_ID', 'Default'),
        'base_url'     => env('TABLEAU_BASE_URL', 'https://your-tableau-server.com/api/3.23'),
    ],
];
```

### Creating a Personal Access Token

1. Sign in to your Tableau Server or Tableau Cloud.
2. Go to **My Account Settings** → **Personal Access Tokens**.
3. Click **Create new token**, give it a name, and copy the secret.
4. Use the token name and secret to authenticate against the REST API and obtain a session token.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `tableau_list_workbooks` | read | List workbooks on the Tableau site |
| `tableau_get_workbook` | read | Get details for a specific workbook |
| `tableau_list_views` | read | List views (dashboards and sheets) on the site |
| `tableau_get_view` | read | Get details for a specific view |
| `tableau_list_projects` | read | List projects on the Tableau site |
| `tableau_get_current_user` | read | Get the authenticated user's information |

## Quick Start

```php
use OpenCompany\Integrations\Tableau\TableauService;
use OpenCompany\Integrations\Tableau\Tools\TableauListWorkbooks;
use OpenCompany\Integrations\Tableau\Tools\TableauGetWorkbook;

// Create tools
$service = app(TableauService::class);
$tools = [
    new TableauListWorkbooks($service),
    new TableauGetWorkbook($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all Tableau workbooks and tell me which ones were updated recently');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('tableau');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Tableau\Tools\TableauListWorkbooks::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Tableau\TableauService;

$service = app(TableauService::class);

// List workbooks
$workbooks = $service->listWorkbooks();

// Get a specific workbook
$workbook = $service->getWorkbook('workbook-luid');

// List views
$views = $service->listViews();

// List projects
$projects = $service->listProjects();

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
- A [Tableau](https://www.tableau.com) account with REST API access

## License

MIT — see [LICENSE](LICENSE)
