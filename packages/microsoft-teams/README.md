# Integration: Microsoft Teams

> Microsoft Teams integration for the [Laravel AI SDK](https://github.com/laravel/ai) — list teams, channels, messages, send messages, and manage chats via the Microsoft Graph API. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Microsoft Teams. List teams and channels, read messages, send messages, browse chats, and look up user profiles — all through the [Microsoft Graph API](https://learn.microsoft.com/en-us/graph/overview).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Microsoft Teams tool lets AI agents interact with Teams conversations — reading channel messages, sending notifications, and browsing team structures — enabling agents to bridge between OpenCompany and Microsoft Teams.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-microsoft-teams
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Microsoft Graph API OAuth2 access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'microsoft-teams' => [
        'access_token' => env('MICROSOFT_GRAPH_ACCESS_TOKEN'),
        'base_url'     => env('MICROSOFT_GRAPH_BASE_URL', 'https://graph.microsoft.com/v1.0'),
    ],
];
```

### Required Permissions

The OAuth2 access token needs the following Microsoft Graph delegated permissions:

| Permission | Tools |
|-----------|-------|
| `Team.ReadBasic.All` | list_teams, get_team |
| `Channel.ReadBasic.All` | list_channels, get_channel |
| `ChannelMessage.Read.All` | list_messages |
| `ChannelMessage.Send` | send_message |
| `Chat.Read` | list_chats |
| `User.Read` | get_current_user |

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `microsoft_teams_list_teams` | read | List all teams the user has joined |
| `microsoft_teams_get_team` | read | Get details for a specific team |
| `microsoft_teams_list_channels` | read | List all channels in a team |
| `microsoft_teams_get_channel` | read | Get details for a specific channel |
| `microsoft_teams_list_messages` | read | List recent messages in a channel |
| `microsoft_teams_send_message` | write | Send a message to a channel |
| `microsoft_teams_list_chats` | read | List chats for the authenticated user |
| `microsoft_teams_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\MicrosoftTeams\MicrosoftTeamsService;
use OpenCompany\Integrations\MicrosoftTeams\Tools\MicrosoftTeamsListTeams;
use OpenCompany\Integrations\MicrosoftTeams\Tools\MicrosoftTeamsSendMessage;

// Create tools
$service = app(MicrosoftTeamsService::class);
$tools = [
    new MicrosoftTeamsListTeams($service),
    new MicrosoftTeamsSendMessage($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Send "Hello team!" to the General channel of the Marketing team');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 8 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('microsoft-teams');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\MicrosoftTeams\Tools\MicrosoftTeamsListTeams::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\MicrosoftTeams\MicrosoftTeamsService;

$service = app(MicrosoftTeamsService::class);

// List teams
$teams = $service->listTeams();

// List channels in a team
$channels = $service->listChannels($teamId);

// List messages in a channel
$messages = $service->listMessages($teamId, $channelId, limit: 10);

// Send a message
$result = $service->sendMessage($teamId, $channelId, 'Hello from the API!');

// List chats
$chats = $service->listChats();

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
- A [Microsoft 365](https://www.microsoft.com/en-us/microsoft-365) account with Teams access
- An Azure AD app registration with Microsoft Graph permissions

## License

MIT — see [LICENSE](LICENSE)
