# Integration: Elastic Email

> Elastic Email integration for the [Laravel AI SDK](https://github.com/laravel/ai) — send transactional emails, manage templates and contacts. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to transactional email delivery via [Elastic Email](https://elasticemail.com). Send emails, browse templates, and manage contacts — all through the Elastic Email API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Elastic Email tool lets AI agents send transactional emails and manage contact lists — enabling automated email workflows directly from conversations.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-elastic-email
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Elastic Email API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'elastic-email' => [
        'api_key' => env('ELASTIC_EMAIL_API_KEY'),
        'url'     => env('ELASTIC_EMAIL_URL', 'https://api.elasticemail.com/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `elasticemail_send_email` | write | Send a transactional email |
| `elasticemail_list_templates` | read | List email templates |
| `elasticemail_get_template` | read | Get details of a specific template |
| `elasticemail_list_contacts` | read | List contacts in the account |
| `elasticemail_create_contact` | write | Create or add a contact |
| `elasticemail_get_current_user` | read | Get authenticated user info |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\ElasticEmail\ElasticEmailService;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailSendEmail;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailListTemplates;

// Create tools
$service = app(ElasticEmailService::class);
$tools = [
    new ElasticEmailSendEmail($service),
    new ElasticEmailListTemplates($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Send a welcome email to john@example.com');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('elastic-email');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailSendEmail::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\ElasticEmail\ElasticEmailService;

$service = app(ElasticEmailService::class);

// Send an email
$result = $service->sendEmail(
    to: 'john@example.com',
    subject: 'Welcome!',
    body: '<h1>Welcome aboard!</h1><p>Thanks for signing up.</p>',
);

// List templates
$templates = $service->listTemplates();

// Get a specific template
$template = $service->getTemplate(123);

// Manage contacts
$contacts = $service->listContacts();
$service->createContact('jane@example.com', listName: 'Newsletter');

// Check account info
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
- An [Elastic Email](https://elasticemail.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
