# Integration: Memberstack

> Memberstack integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage members, plans, and authentication. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to membership management. Create and update members, assign plans, and manage authentication — all through the [Memberstack](https://memberstack.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Memberstack tool lets AI agents manage memberships, assign plans, and handle member authentication — enabling automated member lifecycle management.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-memberstack
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This tool requires a Memberstack access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'memberstack' => [
        'access_token' => env('MEMBERSTACK_ACCESS_TOKEN'),
        'url'          => env('MEMBERSTACK_URL', 'https://api.memberstack.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `memberstack_list_members` | read | List members with pagination |
| `memberstack_get_member` | read | Get a single member by ID |
| `memberstack_create_member` | write | Create a new member |
| `memberstack_update_member` | write | Update an existing member |
| `memberstack_delete_member` | write | Delete a member |
| `memberstack_list_plans` | read | List all available plans |
| `memberstack_get_current_user` | read | Get the currently authenticated user |

## Quick Start

```php
use OpenCompany\Integrations\Memberstack\MemberstackService;
use OpenCompany\Integrations\Memberstack\Tools\MemberstackListMembers;
use OpenCompany\Integrations\Memberstack\Tools\MemberstackCreateMember;

// Create tools
$service = app(MemberstackService::class);
$tools = [
    new MemberstackListMembers($service),
    new MemberstackCreateMember($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List all members on page 1');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('memberstack');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Memberstack\Tools\MemberstackListMembers::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Memberstack\MemberstackService;

$service = app(MemberstackService::class);

// List members
$members = $service->listMembers(limit: 50, page: 1);

// Get a member
$member = $service->getMember('mem_xxx');

// Create a member
$member = $service->createMember(
    email: 'user@example.com',
    password: 'secure-password',
    planId: 'pln_xxx',
    metadata: ['name' => 'John'],
);

// Update a member
$service->updateMember('mem_xxx', planId: 'pln_yyy');

// Delete a member
$service->deleteMember('mem_xxx');

// List plans
$plans = $service->listPlans();

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
- A [Memberstack](https://memberstack.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
