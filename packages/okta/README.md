# Integration: Okta

> Okta identity management integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage users, groups, and applications. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to Okta identity management. Manage users, groups, and applications — all through the [Okta API](https://developer.okta.com/docs/reference/api/).

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Okta tool lets AI agents manage users, groups, and applications — enabling identity-aware automation directly from agent workflows.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-okta
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires an Okta SSWS API token and your Okta domain.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'okta' => [
        'api_token' => env('OKTA_API_TOKEN'),
        'domain'    => env('OKTA_DOMAIN', 'example.okta.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `okta_list_users` | read | List users with optional search filter |
| `okta_get_user` | read | Get a specific user by ID or login |
| `okta_get_current_user` | read | Get the authenticated API token user |
| `okta_create_user` | write | Create a new user |
| `okta_update_user` | write | Update a user profile |
| `okta_deactivate_user` | write | Deactivate a user |
| `okta_list_groups` | read | List groups with optional search filter |
| `okta_get_group` | read | Get a specific group by ID |
| `okta_add_user_to_group` | write | Add a user to a group |
| `okta_list_applications` | read | List applications in the organization |

## Quick Start

```php
use OpenCompany\Integrations\Okta\OktaService;
use OpenCompany\Integrations\Okta\Tools\OktaListUsers;
use OpenCompany\Integrations\Okta\Tools\OktaGetUser;

// Create tools
$service = app(OktaService::class);
$tools = [
    new OktaListUsers($service),
    new OktaGetUser($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('Find all users in Okta named John');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 10 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('okta');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Okta\Tools\OktaListUsers::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Okta\OktaService;

$service = app(OktaService::class);

// List users
$users = $service->listUsers(limit: 50, q: 'john');

// Get a user
$user = $service->getUser('00u1a2b3c4d5e6f7g8h9');

// Create a user
$user = $service->createUser(
    profile: [
        'firstName' => 'Jane',
        'lastName' => 'Doe',
        'email' => 'jane.doe@example.com',
        'login' => 'jane.doe@example.com',
    ],
    activate: true,
);

// Update a user
$service->updateUser('00u1a2b3c4d5e6f7g8h9', [
    'title' => 'Senior Engineer',
]);

// Deactivate a user
$service->deactivateUser('00u1a2b3c4d5e6f7g8h9');

// Groups
$groups = $service->listGroups(q: 'Engineering');
$group = $service->getGroup('00g1a2b3c4d5e6f7g8h9');
$service->addUserToGroup('00g1a2b3c4d5e6f7g8h9', '00u1a2b3c4d5e6f7g8h9');

// Applications
$apps = $service->listApplications();
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
- An [Okta](https://www.okta.com) organization with an API token

## License

MIT — see [LICENSE](LICENSE)
