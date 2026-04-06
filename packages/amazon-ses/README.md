# Integration: Amazon SES

> Amazon SES integration for the [Laravel AI SDK](https://github.com/laravel/ai) — send emails, manage templates, list suppressions. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to transactional email via [Amazon Simple Email Service (SES)](https://aws.amazon.com/ses/). Send emails, manage email templates, and view suppression lists — all through the Amazon SES v2 API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Amazon SES tool lets AI agents send transactional emails, manage email templates, and monitor suppression lists — enabling agents to handle email workflows autonomously.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-amazon-ses
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Amazon SES access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'amazon-ses' => [
        'access_token' => env('AMAZON_SES_ACCESS_TOKEN'),
        'url'          => env('AMAZON_SES_URL', 'https://email.us-east-1.amazonaws.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `amazonses_send_email` | write | Send an email (simple or template-based) |
| `amazonses_get_template` | read | Get an email template by name |
| `amazonses_list_templates` | read | List all email templates |
| `amazonses_create_template` | write | Create a new email template |
| `amazonses_list_suppressions` | read | List suppressed addresses for a configuration set |
| `amazonses_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\AmazonSes\AmazonSesService;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesSendEmail;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesListTemplates;

// Create tools
$service = app(AmazonSesService::class);
$tools = [
    new AmazonSesSendEmail($service),
    new AmazonSesListTemplates($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Send a welcome email to john@example.com from hello@example.com');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('amazon-ses');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\AmazonSes\Tools\AmazonSesSendEmail::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\AmazonSes\AmazonSesService;

$service = app(AmazonSesService::class);

// Send a simple email
$service->sendEmail([
    'FromEmailAddress' => 'hello@example.com',
    'Destination' => ['ToAddresses' => ['user@example.com']],
    'Content' => [
        'Simple' => [
            'Subject' => ['Data' => 'Welcome!'],
            'Body' => ['Html' => ['Data' => '<h1>Hello!</h1>']],
        ],
    ],
]);

// List templates
$templates = $service->listTemplates();

// Get a template
$template = $service->getTemplate('welcome-email');

// Create a template
$service->createTemplate([
    'TemplateName' => 'welcome-email',
    'TemplateContent' => [
        'Subject' => 'Welcome, {{name}}!',
        'Html' => '<h1>Hello {{name}}</h1>',
        'Text' => 'Hello {{name}}',
    ],
]);

// List suppressions
$suppressions = $service->listSuppressions('my-config-set');
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
- An [Amazon SES](https://aws.amazon.com/ses/) account with API access

## License

MIT — see [LICENSE](LICENSE)
