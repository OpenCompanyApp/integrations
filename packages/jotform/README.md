# Integration: Jotform

> Jotform integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage forms, submissions, and questions. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Jotform's online form builder. List and create forms, retrieve submissions, inspect form questions, and manage user accounts — all through the [Jotform API](https://api.jotform.com/docs/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Jotform tool lets AI agents interact with forms, retrieve submission data, and create new forms — enabling automated form management and data collection workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-jotform
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Jotform API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'jotform' => [
        'api_key' => env('JOTFORM_API_KEY'),
        'url'     => env('JOTFORM_URL', 'https://api.jotform.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `jotform_list_forms` | read | List all forms owned by the authenticated user |
| `jotform_get_form` | read | Get details for a specific form |
| `jotform_list_submissions` | read | List submissions for a specific form |
| `jotform_get_submission` | read | Get details for a specific submission |
| `jotform_create_form` | write | Create a new form with questions and properties |
| `jotform_list_questions` | read | List all questions (fields) for a form |
| `jotform_get_current_user` | read | Get profile info for the authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\Jotform\JotformService;
use OpenCompany\Integrations\Jotform\Tools\JotformListForms;
use OpenCompany\Integrations\Jotform\Tools\JotformListSubmissions;

// Create tools
$service = app(JotformService::class);
$tools = [
    new JotformListForms($service),
    new JotformListSubmissions($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all my Jotform forms');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('jotform');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Jotform\Tools\JotformListForms::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Jotform\JotformService;

$service = app(JotformService::class);

// Get current user
$user = $service->getCurrentUser();

// List forms
$forms = $service->listForms(limit: 10);

// Get a specific form
$form = $service->getForm('231234567890123');

// List submissions
$submissions = $service->listSubmissions('231234567890123', limit: 5);

// Get a specific submission
$submission = $service->getSubmission('512345678901234567');

// List questions for a form
$questions = $service->listQuestions('231234567890123');

// Create a new form
$newForm = $service->createForm([
    'title' => 'Contact Form',
    'questions[1]' => ['type' => 'control_textbox', 'name' => 'Name'],
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
- A [Jotform](https://www.jotform.com/) account with API access

## License

MIT — see [LICENSE](LICENSE)
