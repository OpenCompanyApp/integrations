# Integration: Mailjet

> Mailjet integration for the [Laravel AI SDK](https://github.com/laravel/ai) — send emails, manage contacts, campaigns, and templates. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to email delivery and marketing automation through [Mailjet](https://www.mailjet.com/). Send transactional and marketing emails, manage contact lists, review campaigns, and track delivery statistics — all through the Mailjet REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Mailjet tool lets AI agents send emails, manage contact lists, and review campaign performance — giving agents full email capabilities within the workspace.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-mailjet
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Mailjet API key and API secret.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'mailjet' => [
        'api_key'    => env('MAILJET_API_KEY'),
        'api_secret' => env('MAILJET_API_SECRET'),
        'url'        => env('MAILJET_URL', 'https://api.mailjet.com/v3'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `mailjet_send_email` | write | Send an email (transactional or marketing) |
| `mailjet_list_contacts` | read | List contacts in the account |
| `mailjet_get_contact` | read | Get details for a single contact |
| `mailjet_create_contact` | write | Create a new contact |
| `mailjet_list_campaigns` | read | List email campaigns |
| `mailjet_get_campaign` | read | Get details for a single campaign |
| `mailjet_list_templates` | read | List email templates |
| `mailjet_get_stats` | read | Get email delivery statistics |
| `mailjet_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Mailjet\MailjetService;
use OpenCompany\Integrations\Mailjet\Tools\MailjetSendEmail;
use OpenCompany\Integrations\Mailjet\Tools\MailjetListContacts;

// Create tools
$service = app(MailjetService::class);
$tools = [
    new MailjetSendEmail($service),
    new MailjetListContacts($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Send a welcome email to newuser@example.com from hello@acme.com');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 9 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('mailjet');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Mailjet\Tools\MailjetSendEmail::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Mailjet\MailjetService;

$service = app(MailjetService::class);

// Send an email
$service->sendEmail([
    'From' => ['Email' => 'hello@example.com', 'Name' => 'Acme'],
    'To' => [['Email' => 'user@example.com']],
    'Subject' => 'Welcome!',
    'HTML' => '<h1>Welcome</h1>',
]);

// List contacts
$contacts = $service->listContacts();

// Create a contact
$service->createContact('newuser@example.com');

// Get statistics
$stats = $service->getStats(['FromTS' => '2026-01-01T00:00:00Z']);

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
- A [Mailjet](https://www.mailjet.com/) account with API access

## License

MIT — see [LICENSE](LICENSE)
