# Integration: GetResponse

> GetResponse integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage contacts, campaigns, and newsletters. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to email marketing via [GetResponse](https://www.getresponse.com). Manage contacts, campaigns, and newsletters — all through the GetResponse API v3.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This GetResponse tool lets AI agents manage email contacts, create and organize campaigns, and review newsletter performance — giving agents marketing automation capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-getresponse
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a GetResponse API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'getresponse' => [
        'api_key' => env('GETRESPONSE_API_KEY'),
        'url'     => env('GETRESPONSE_URL', 'https://api.getresponse.com/v3'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `getresponse_list_contacts` | read | List contacts with pagination |
| `getresponse_get_contact` | read | Get details of a specific contact |
| `getresponse_create_contact` | write | Create a new contact |
| `getresponse_update_contact` | write | Update an existing contact |
| `getresponse_delete_contact` | write | Delete a contact permanently |
| `getresponse_list_campaigns` | read | List all campaigns |
| `getresponse_get_campaign` | read | Get details of a specific campaign |
| `getresponse_create_campaign` | write | Create a new campaign |
| `getresponse_list_newsletters` | read | List newsletters |
| `getresponse_get_current_user` | read | Get authenticated user account info |

## Quick Start

```php
use OpenCompany\Integrations\GetResponse\GetResponseService;
use OpenCompany\Integrations\GetResponse\Tools\GetResponseListContacts;
use OpenCompany\Integrations\GetResponse\Tools\GetResponseCreateContact;

// Create tools
$service = app(GetResponseService::class);
$tools = [
    new GetResponseListContacts($service),
    new GetResponseCreateContact($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List our GetResponse contacts and add jane@example.com');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 10 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('getresponse');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\GetResponse\Tools\GetResponseListContacts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\GetResponse\GetResponseService;

$service = app(GetResponseService::class);

// List contacts
$contacts = $service->listContacts(page: 1, perPage: 50);

// Get a contact
$contact = $service->getContact('contactId');

// Create a contact
$newContact = $service->createContact('john@example.com', 'John Doe', 'campaignId');

// Update a contact
$service->updateContact('contactId', 'New Name');

// Delete a contact
$service->deleteContact('contactId');

// List campaigns
$campaigns = $service->listCampaigns();

// Create a campaign
$campaign = $service->createCampaign('My Campaign');

// List newsletters
$newsletters = $service->listNewsletters();

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
- A [GetResponse](https://www.getresponse.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
