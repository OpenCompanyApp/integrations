# Integration: Microsoft Outlook

> Microsoft Outlook integration for the [Laravel AI SDK](https://github.com/laravel/ai) — read and send email, manage calendars and events via the Microsoft Graph API. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Outlook email and calendars. Read and send messages, list and create calendar events — all through the [Microsoft Graph API](https://learn.microsoft.com/en-us/graph/api/overview).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Outlook integration lets AI agents read and send emails, check calendar availability, and create events — giving agents full communication and scheduling capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-microsoft-outlook
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Microsoft Graph OAuth2 access token with the following delegated scopes:

- `Mail.Read` — read messages
- `Mail.Send` — send messages
- `Calendars.Read` — read calendars and events
- `Calendars.ReadWrite` — create events
- `User.Read` — read the signed-in user's profile

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'microsoft-outlook' => [
        'access_token' => env('MICROSOFT_GRAPH_ACCESS_TOKEN'),
        'base_url'     => env('MICROSOFT_GRAPH_BASE_URL', 'https://graph.microsoft.com/v1.0'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `outlook_list_messages` | read | List email messages in the mailbox |
| `outlook_get_message` | read | Retrieve a single email message by id |
| `outlook_send_message` | write | Send an email message |
| `outlook_list_calendars` | read | List the user's calendars |
| `outlook_list_events` | read | List events on the default calendar |
| `outlook_create_event` | write | Create a new calendar event |
| `outlook_get_current_user` | read | Get the signed-in user's profile |

## Quick Start

```php
use OpenCompany\Integrations\MicrosoftOutlook\OutlookService;
use OpenCompany\Integrations\MicrosoftOutlook\Tools\OutlookListMessages;
use OpenCompany\Integrations\MicrosoftOutlook\Tools\OutlookSendMessage;

// Create tools
$service = app(OutlookService::class);
$tools = [
    new OutlookListMessages($service),
    new OutlookSendMessage($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my 5 most recent unread emails');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('microsoft-outlook');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\MicrosoftOutlook\Tools\OutlookListMessages::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\MicrosoftOutlook\OutlookService;

$service = app(OutlookService::class);

// List messages
$messages = $service->listMessages(['$top' => 10, '$filter' => 'isRead eq false']);

// Get a specific message
$message = $service->getMessage('AAMkAGI2...');

// Send a message
$service->sendMessage([
    'message' => [
        'subject' => 'Hello',
        'body'    => ['contentType' => 'Text', 'content' => 'Hello, world!'],
        'toRecipients' => [['emailAddress' => ['address' => 'alice@example.com']]],
    ],
    'saveToSentItems' => true,
]);

// List calendars
$calendars = $service->listCalendars();

// List events
$events = $service->listEvents(['$top' => 10, '$orderby' => 'start/dateTime']);

// Create an event
$event = $service->createEvent([
    'subject' => 'Team Meeting',
    'start'   => ['dateTime' => '2025-06-15T09:00:00', 'timeZone' => 'UTC'],
    'end'     => ['dateTime' => '2025-06-15T10:00:00', 'timeZone' => 'UTC'],
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
- A [Microsoft 365](https://www.microsoft.com/en-us/microsoft-365) account with Graph API access

## License

MIT — see [LICENSE](LICENSE)
