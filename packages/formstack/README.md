# Integration: Formstack

> Formstack integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage forms, submissions, and folders. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Formstack forms and submissions. List and retrieve forms, manage submissions, organize forms in folders, and get current user info — all through the [Formstack](https://www.formstack.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Formstack tool lets AI agents interact with online forms — retrieving form structures, listing and creating submissions, and managing form organization — giving agents the ability to work with form data and workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-formstack
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Formstack OAuth access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'formstack' => [
        'access_token' => env('FORMSTACK_ACCESS_TOKEN'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `formstack_list_forms` | read | List all forms in your Formstack account |
| `formstack_get_form` | read | Get details and field structure of a specific form |
| `formstack_list_submissions` | read | List submissions for a specific form |
| `formstack_get_submission` | read | Get details of a specific submission |
| `formstack_create_submission` | write | Create a new submission for a form |
| `formstack_delete_submission` | write | Delete a submission |
| `formstack_list_folders` | read | List all folders in your Formstack account |
| `formstack_get_current_user` | read | Get the currently authenticated user's profile |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\Formstack\FormstackService;
use OpenCompany\Integrations\Formstack\Tools\FormstackListForms;
use OpenCompany\Integrations\Formstack\Tools\FormstackGetForm;

// Create tools
$service = app(FormstackService::class);
$tools = [
    new FormstackListForms($service),
    new FormstackGetForm($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all my Formstack forms and show me the fields in the first one');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('formstack');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Formstack\Tools\FormstackListForms::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Formstack\FormstackService;

$service = app(FormstackService::class);

// List forms
$forms = $service->listForms();

// Get a specific form with its fields
$form = $service->getForm(12345);

// List submissions for a form
$submissions = $service->listSubmissions(12345);

// Create a submission
$submission = $service->createSubmission(12345, [
    'field_123456' => 'John Doe',
    'field_234567' => 'john@example.com',
]);

// List folders
$folders = $service->listFolders();

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
- A [Formstack](https://www.formstack.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
