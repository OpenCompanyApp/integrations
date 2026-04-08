# Integration: Zoho Mail

> Zoho Mail integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list messages, send email, manage folders and tasks. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Zoho Mail. List and read emails, send messages, browse folders, and manage tasks — all through the Zoho Mail REST API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Zoho Mail tool lets AI agents read and send email, browse folder structures, and manage tasks — enabling agents to handle communication workflows autonomously.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-zoho-mail
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Zoho Mail OAuth access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'zoho-mail' => [
        'access_token' => env('ZOHO_MAIL_ACCESS_TOKEN'),
        'url'          => env('ZOHO_MAIL_URL', 'https://mail.zoho.com/api/v1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `zohomail_list_messages` | read | List email messages in a folder |
| `zohomail_get_message` | read | Get a single email message by ID |
| `zohomail_send_message` | write | Send a new email message |
| `zohomail_list_folders` | read | List all email folders |
| `zohomail_list_tasks` | read | List tasks from Zoho Mail |
| `zohomail_get_current_user` | read | Get current user account info |

## Quick Start

```php
use OpenCompany\Integrations\ZohoMail\ZohoMailService;
use OpenCompany\Integrations\ZohoMail\Tools\ZohoMailListMessages;
use OpenCompany\Integrations\ZohoMail\Tools\ZohoMailSendMessage;

// Create tools
$service = app(ZohoMailService::class);
$tools = [
    new ZohoMailListMessages($service),
    new ZohoMailSendMessage($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my latest emails and summarize them');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('zoho-mail');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\ZohoMail\Tools\ZohoMailListMessages::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\ZohoMail\ZohoMailService;

$service = app(ZohoMailService::class);

// Get account info
$accounts = $service->getCurrentUser();

// List messages
$messages = $service->listMessages('12345678', [
    'folderId' => 'INBOX',
    'limit' => 10,
]);

// Get a specific message
$message = $service->getMessage('12345678', '9807654321');

// Send a message
$result = $service->sendMessage('12345678', [
    'toAddress' => 'user@example.com',
    'subject' => 'Hello from AI',
    'content' => '<p>This is a test email.</p>',
]);

// List folders
$folders = $service->listFolders('12345678');

// List tasks
$tasks = $service->listTasks('12345678');
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
- A [Zoho Mail](https://www.zoho.com/mail/) account with API access

## License

MIT — see [LICENSE](LICENSE)
