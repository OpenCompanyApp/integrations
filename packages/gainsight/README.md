# Integration: Gainsight

> Gainsight customer success integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list companies, users, and surveys. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to customer success data from Gainsight. Retrieve company health scores, user profiles, and survey data — all through the Gainsight REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Gainsight tool lets AI agents query customer health scores, review survey results, and analyze account data — giving agents customer success context.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-gainsight
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Gainsight API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'gainsight' => [
        'access_token' => env('GAINSIGHT_ACCESS_TOKEN'),
        'url'          => env('GAINSIGHT_URL', 'https://api.gainsight.com/v1'),
    ],
];
```

Generate an access token in Gainsight under **Administration → Connectors 2.0 → OAuth**.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `gainsight_list_companies` | read | List companies with search and pagination filters |
| `gainsight_get_company` | read | Get detailed information about a specific company |
| `gainsight_list_users` | read | List users with role and pagination filters |
| `gainsight_get_user` | read | Get detailed information about a specific user |
| `gainsight_list_surveys` | read | List surveys with status and pagination filters |
| `gainsight_get_survey` | read | Get detailed information about a specific survey |
| `gainsight_get_current_user` | read | Get the currently authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Gainsight\GainsightService;
use OpenCompany\Integrations\Gainsight\Tools\GainsightListCompanies;
use OpenCompany\Integrations\Gainsight\Tools\GainsightGetCurrentUser;

// Create tools
$service = app(GainsightService::class);
$tools = [
    new GainsightListCompanies($service),
    new GainsightGetCurrentUser($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all at-risk companies and summarize their health scores.');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('gainsight');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Gainsight\Tools\GainsightListCompanies::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Gainsight\GainsightService;

$service = app(GainsightService::class);

// List companies
$companies = $service->listCompanies([
    'search' => 'Acme',
]);

// Get a specific company
$company = $service->getCompany('1A2B3C4D');

// List users
$users = $service->listUsers([
    'role' => 'CSM',
]);

// Get a specific user
$user = $service->getUser('5E6F7G8H');

// List surveys
$surveys = $service->listSurveys([
    'status' => 'active',
]);

// Get a specific survey
$survey = $service->getSurvey('9I0J1K2L');

// Get current user
$me = $service->getCurrentUser();
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
- A [Gainsight](https://www.gainsight.com) account with API access enabled

## License

MIT — see [LICENSE](LICENSE)
