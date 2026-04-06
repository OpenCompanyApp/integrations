# Integration: VBout

> VBout integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage contacts and email campaigns. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to email marketing and CRM data. List and create contacts, browse email campaigns, and verify account credentials — all through the [VBout](https://vbout.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This VBout tool lets AI agents manage email contacts, review campaign performance, and interact with marketing data — giving agents marketing awareness and action capabilities.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-vbout
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a VBout API key.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'vbout' => [
        'api_key' => env('VBOUT_API_KEY'),
        'url'     => env('VBOUT_URL', 'https://api.vbout.com/1'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `vbout_list_contacts` | read | List contacts with pagination |
| `vbout_get_contact` | read | Get a specific contact by ID |
| `vbout_create_contact` | write | Add a new contact to a list |
| `vbout_list_campaigns` | read | List email campaigns with pagination |
| `vbout_get_campaign` | read | Get a specific campaign by ID |
| `vbout_get_current_user` | read | Get the authenticated user profile |

## Quick Start

```php
use OpenCompany\Integrations\Vbout\VboutService;
use OpenCompany\Integrations\Vbout\Tools\VboutListContacts;
use OpenCompany\Integrations\Vbout\Tools\VboutCreateContact;

// Create tools
$service = app(VboutService::class);
$tools = [
    new VboutListContacts($service),
    new VboutCreateContact($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all VBout contacts and show me the most recent campaign');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 6 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('vbout');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Vbout\Tools\VboutListContacts::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Vbout\VboutService;

$service = app(VboutService::class);

// List contacts
$contacts = $service->listContacts(limit: 50);

// Get a contact
$contact = $service->getContact('12345');

// Create a contact
$contact = $service->createContact('user@example.com', 'list_abc', [
    'first_name' => 'Jane',
    'last_name' => 'Doe',
]);

// List campaigns
$campaigns = $service->listCampaigns(limit: 10);

// Get a campaign
$campaign = $service->getCampaign('camp_678');

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
- A [VBout](https://vbout.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
