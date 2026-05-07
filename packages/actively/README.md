# Integration: Actively

> Actively CRM integration for the [Laravel AI SDK](https://github.com/laravel/ai) - manage campaigns, contacts, and organizations. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to your Actively CRM data. List and create campaigns, browse contacts, manage organizations, and retrieve user profiles - all through the Actively API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace - with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Actively tool lets AI agents manage sales campaigns, look up contacts, and navigate organization hierarchies - giving agents CRM-awareness for sales workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-actively
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Actively API access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'actively' => [
        'access_token' => env('ACTIVELY_ACCESS_TOKEN'),
        'url'          => env('ACTIVELY_URL', 'https://api.actively.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `actively_list_organizations` | read | List organizations you have access to |
| `actively_get_current_user` | read | Get the authenticated user's profile |
| `actively_list_campaigns` | read | List campaigns for an organization |
| `actively_get_campaign` | read | Get details of a specific campaign |
| `actively_create_campaign` | write | Create a new campaign for an organization |
| `actively_list_contacts` | read | List contacts for an organization |
| `actively_get_contact` | read | Get details of a specific contact |

## Quick Start

```php
use OpenCompany\Integrations\Actively\ActivelyService;
use OpenCompany\Integrations\Actively\Tools\ActivelyListCampaigns;
use OpenCompany\Integrations\Actively\Tools\ActivelyListContacts;

// Create tools
$service = app(ActivelyService::class);
$tools = [
    new ActivelyListCampaigns($service),
    new ActivelyListContacts($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all campaigns for org_abc123');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('actively');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Actively\Tools\ActivelyListCampaigns::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Actively\ActivelyService;

$service = app(ActivelyService::class);

// Get current user
$user = $service->getCurrentUser();

// List organizations
$orgs = $service->listOrganizations();

// List campaigns
$campaigns = $service->listCampaigns('org_abc123');

// Get a specific campaign
$campaign = $service->getCampaign('org_abc123', 'camp_xyz789');

// Create a campaign
$new = $service->createCampaign('org_abc123', 'Q1 Launch', 'email', '2026-01-01', '2026-03-31');

// List contacts
$contacts = $service->listContacts('org_abc123');

// Get a specific contact
$contact = $service->getContact('org_abc123', 'cont_def456');
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
- An [Actively](https://actively.com) account with API access

## License

MIT - see [LICENSE](LICENSE)
