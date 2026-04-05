# Integration: Wufoo

> Wufoo forms integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list forms, retrieve entries, manage reports. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to online form data. List forms, retrieve entries with pagination and filters, view reports, and get user profile information — all through the [Wufoo](https://wufoo.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Wufoo tool lets AI agents query form structures, retrieve submitted entries, and manage reports — giving agents data-driven awareness of form submissions and responses.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-wufoo
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Wufoo API key and your subdomain-specific base URL.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'wufoo' => [
        'api_key'  => env('WUFOO_API_KEY'),
        'base_url' => env('WUFOO_BASE_URL', 'https://yoursubdomain.wufoo.com/api/v3'),
    ],
];
```

### Getting Your Wufoo API Key

1. Log in to your Wufoo account.
2. Navigate to **Your Name → Account → API Information**.
3. Copy the API key.
4. Use your subdomain in the base URL: `https://{subdomain}.wufoo.com/api/v3`.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `wufoo_list_forms` | read | List all forms in your Wufoo account |
| `wufoo_get_form` | read | Get details for a specific form by ID |
| `wufoo_list_entries` | read | List entries for a form (paginated, filterable) |
| `wufoo_get_entry` | read | Get a single entry by its ID |
| `wufoo_list_reports` | read | List all reports in your Wufoo account |
| `wufoo_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Wufoo\WufooService;
use OpenCompany\Integrations\Wufoo\Tools\WufooListForms;
use OpenCompany\Integrations\Wufoo\Tools\WufooListEntries;

// Create tools
$service = app(WufooService::class);
$tools = [
    new WufooListForms($service),
    new WufooListEntries($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me all forms and their latest 5 entries');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('wufoo');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Wufoo\Tools\WufooListForms::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Wufoo\WufooService;

$service = app(WufooService::class);

// List all forms
$forms = $service->listForms();

// Get a specific form
$form = $service->getForm('q1w2e3r4t5y6');

// List entries with pagination
$entries = $service->listEntries('q1w2e3r4t5y6', page: 0, pageSize: 50);

// List entries with filters
$entries = $service->listEntries('q1w2e3r4t5y6', filters: [
    'Filter1' => 'Field1+Is+equal_to+value',
]);

// Get a single entry
$entry = $service->getEntry('12345');

// List reports
$reports = $service->listReports();

// Get current user
$user = $service->getCurrentUser();
```

## Authentication

Wufoo uses HTTP Basic Authentication. The API key is sent as the username, and the password is always set to `"footastic"`. This is handled automatically by the `WufooService`.

## Dependencies

| Package | Purpose |
|---------|---------|
| [opencompanyapp/integration-core](https://github.com/OpenCompanyApp/integration-core) | ToolProvider contract and registry |
| [laravel/ai](https://github.com/laravel/ai) | Laravel AI SDK Tool contract |

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- [Laravel AI SDK](https://github.com/laravel/ai) ^0.1
- A [Wufoo](https://wufoo.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
