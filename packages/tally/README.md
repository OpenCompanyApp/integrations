# Integration: Tally

> Tally form builder integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage forms, submissions, and workspaces. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to [Tally](https://tally.so) forms and submissions. List forms, retrieve form details, query submissions with date filters, manage workspaces, and verify the connected user — all through the Tally API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Tally tool lets AI agents interact with form data, review submissions, and manage form configurations — giving agents awareness of customer feedback, lead captures, surveys, and more.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-tally
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Tally API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'tally' => [
        'api_key' => env('TALLY_API_KEY'),
        'url'     => env('TALLY_URL', 'https://api.tally.so'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `tally_list_forms` | read | List all forms in the workspace |
| `tally_get_form` | read | Get full details for a specific form |
| `tally_list_submissions` | read | List submissions for a form (with date filters) |
| `tally_get_submission` | read | Get full details of a single submission |
| `tally_list_workspaces` | read | List all workspaces |
| `tally_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Tally\TallyService;
use OpenCompany\Integrations\Tally\Tools\TallyListForms;
use OpenCompany\Integrations\Tally\Tools\TallyListSubmissions;

// Create tools
$service = app(TallyService::class);
$tools = [
    new TallyListForms($service),
    new TallyListSubmissions($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Show me the latest submissions for my contact form');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('tally');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Tally\Tools\TallyListForms::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Tally\TallyService;

$service = app(TallyService::class);

// List all forms
$forms = $service->listForms();

// Get a specific form
$form = $service->getForm('mVlDK4');

// List submissions with date filter
$submissions = $service->listSubmissions(
    'mVlDK4',
    limit: 50,
    submittedAfter: '2026-01-01T00:00:00Z',
);

// Get a single submission
$submission = $service->getSubmission('sub_abc123');

// List workspaces
$workspaces = $service->listWorkspaces();

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
- A [Tally](https://tally.so) account with API access

## License

MIT — see [LICENSE](LICENSE)
