# Integration: Lemlist

> Lemlist integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage campaigns, leads, teams, and sub-accounts. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to email outreach campaigns. List and inspect campaigns, manage leads, view teams and sub-accounts — all through the [Lemlist](https://lemlist.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Lemlist tool lets AI agents manage outreach campaigns, add leads, and monitor engagement — enabling automated sales workflows within OpenCompany.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-lemlist
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration uses HTTP Basic authentication with your Lemlist credentials.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'lemlist' => [
        'username' => env('LEMLIST_USERNAME'),
        'password' => env('LEMLIST_API_KEY'),
        'url'      => env('LEMLIST_URL', 'https://api.lemlist.com/api'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `lemlist_list_campaigns` | read | List all outreach campaigns |
| `lemlist_get_campaign` | read | Get details of a specific campaign |
| `lemlist_list_leads` | read | List leads in a campaign |
| `lemlist_add_lead` | write | Add a lead to a campaign |
| `lemlist_list_teams` | read | List all teams in the account |
| `lemlist_list_subaccounts` | read | List all sub-accounts |
| `lemlist_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Lemlist\LemlistService;
use OpenCompany\Integrations\Lemlist\Tools\LemlistListCampaigns;
use OpenCompany\Integrations\Lemlist\Tools\LemlistAddLead;

// Create tools
$service = app(LemlistService::class);
$tools = [
    new LemlistListCampaigns($service),
    new LemlistAddLead($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all active campaigns and add john@example.com to the first one');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('lemlist');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Lemlist\Tools\LemlistListCampaigns::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Lemlist\LemlistService;

$service = app(LemlistService::class);

// List campaigns
$campaigns = $service->listCampaigns();

// Get a specific campaign
$campaign = $service->getCampaign('campaign_id_here');

// List leads in a campaign
$leads = $service->listLeads('campaign_id_here');

// Add a lead to a campaign
$lead = $service->addLead('campaign_id_here', [
    'email' => 'john@example.com',
    'firstName' => 'John',
    'lastName' => 'Doe',
    'companyName' => 'Acme Inc',
]);

// List teams
$teams = $service->listTeams();

// List sub-accounts
$subaccounts = $service->listSubaccounts();

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
- A [Lemlist](https://lemlist.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
