# Integration: Google Forms

> Google Forms integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list forms, manage responses, create forms. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Google Forms. List and create forms, collect and review responses, and manage survey submissions — all through the [Google Forms API](https://developers.google.com/forms/api).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Google Forms tool lets AI agents create surveys, collect responses, and analyze form data — enabling automated form management and data collection workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-google-forms
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Google OAuth 2.0 access token with the Forms API scope.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'google-forms' => [
        'access_token' => env('GOOGLE_FORMS_ACCESS_TOKEN'),
        'url'          => env('GOOGLE_FORMS_URL', 'https://forms.googleapis.com'),
    ],
];
```

### Required OAuth Scopes

- `https://www.googleapis.com/auth/forms` — Full access to forms and responses
- `https://www.googleapis.com/auth/forms.body` — Read/write form structure
- `https://www.googleapis.com/auth/forms.responses.readonly` — Read responses

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `gforms_list_forms` | read | List Google Forms owned by the authenticated user |
| `gforms_get_form` | read | Get details of a specific form (questions, settings) |
| `gforms_create_form` | write | Create a new Google Form |
| `gforms_list_responses` | read | List responses submitted to a form |
| `gforms_get_response` | read | Get a specific form response |
| `gforms_create_response` | write | Submit a response to a form |
| `gforms_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\GoogleForms\GoogleFormsService;
use OpenCompany\Integrations\GoogleForms\Tools\GFormsListForms;
use OpenCompany\Integrations\GoogleForms\Tools\GFormsCreateForm;

// Create tools
$service = app(GoogleFormsService::class);
$tools = [
    new GFormsListForms($service),
    new GFormsCreateForm($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all my Google Forms and show their titles');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('google-forms');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\GoogleForms\Tools\GFormsListForms::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\GoogleForms\GoogleFormsService;

$service = app(GoogleFormsService::class);

// List forms
$forms = $service->listForms();

// Get a specific form
$form = $service->getForm('FORM_ID');

// Create a form
$form = $service->createForm(
    info: [],
    title: 'Customer Survey',
    description: 'Please share your feedback.',
);

// List responses
$responses = $service->listResponses('FORM_ID');

// Get a specific response
$response = $service->getResponse('FORM_ID', 'RESPONSE_ID');

// Submit a response
$result = $service->createResponse('FORM_ID', [
    'QUESTION_ID' => [
        'textAnswers' => [
            'answers' => [['value' => 'My answer']],
        ],
    ],
]);

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
- A Google account with Forms API access enabled

## License

MIT — see [LICENSE](LICENSE)
