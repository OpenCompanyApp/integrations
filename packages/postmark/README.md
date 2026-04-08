# Integration: Postmark

> Postmark email integration for the [Laravel AI SDK](https://github.com/laravel/ai) — send emails, use templates, track delivery. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to reliable email delivery. Send emails (HTML and plain text), use templates, monitor delivery stats, and inspect outbound messages — all through the [Postmark](https://postmarkapp.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Postmark tool lets AI agents send transactional emails, manage email templates, and monitor delivery — enabling email-aware agent workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-postmark
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Postmark server token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'postmark' => [
        'server_token' => env('POSTMARK_SERVER_TOKEN'),
        'url'          => env('POSTMARK_URL', 'https://api.postmarkapp.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `postmark_send_email` | write | Send an email with HTML and/or plain text body |
| `postmark_send_template` | write | Send an email using a Postmark template |
| `postmark_get_delivery_stats` | read | Get email delivery statistics |
| `postmark_list_messages` | read | List outbound email messages |
| `postmark_get_message` | read | Get details of a specific email message |
| `postmark_list_templates` | read | List email templates |
| `postmark_get_current_user` | read | Get Postmark server information |

## Quick Start

```php
use Laravel\Ai\Facades\Ai;
use OpenCompany\Integrations\Postmark\PostmarkService;
use OpenCompany\Integrations\Postmark\Tools\PostmarkSendEmail;
use OpenCompany\Integrations\Postmark\Tools\PostmarkGetDeliveryStats;

// Create tools
$service = app(PostmarkService::class);
$tools = [
    new PostmarkSendEmail($service),
    new PostmarkGetDeliveryStats($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Send a welcome email to john@example.com and show delivery stats');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('postmark');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Postmark\Tools\PostmarkSendEmail::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Postmark\PostmarkService;

$service = app(PostmarkService::class);

// Send an email
$result = $service->sendEmail([
    'From' => 'sender@example.com',
    'To' => 'recipient@example.com',
    'Subject' => 'Hello',
    'HtmlBody' => '<h1>Welcome!</h1>',
    'TextBody' => 'Welcome!',
    'Tag' => 'welcome',
]);

// Send with a template
$result = $service->sendTemplateEmail([
    'From' => 'sender@example.com',
    'To' => 'recipient@example.com',
    'TemplateAlias' => 'welcome-email',
    'TemplateModel' => ['name' => 'John'],
]);

// Delivery stats
$stats = $service->getDeliveryStats();

// List messages
$messages = $service->listMessages(count: 25, status: 'sent');

// Get message details
$message = $service->getMessage('message-id-here');

// List templates
$templates = $service->listTemplates();

// Server info
$server = $service->getCurrentUser();
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
- A [Postmark](https://postmarkapp.com) account with a server token

## License

MIT — see [LICENSE](LICENSE)
