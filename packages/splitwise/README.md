# Integration: Splitwise

> Splitwise integration for the [Laravel AI SDK](https://github.com/laravel/ai) — manage shared expenses, groups, and friends. Part of the [OpenCompany](https://github.com/OpenCompanyApp) integration ecosystem.

Give your AI agents access to shared expense tracking. Create and query expenses, manage groups, and view friend balances — all through the [Splitwise](https://splitwise.com) API.

## About OpenCompany

[OpenCompany](https://github.com/OpenCompanyApp) is an AI-powered workplace platform where teams deploy and coordinate multiple AI agents alongside human collaborators. It combines team messaging, document collaboration, task management, and intelligent automation in a single workspace — with built-in approval workflows and granular permission controls so organizations can adopt AI agents safely and transparently.

This Splitwise tool lets AI agents track shared expenses, query balances, and manage group finances — giving agents financial awareness of team expenses.

OpenCompany is built with Laravel, Vue 3, and Inertia.js. Learn more at [github.com/OpenCompanyApp](https://github.com/OpenCompanyApp).

## Installation

```console
composer require opencompanyapp/integration-splitwise
```

Laravel auto-discovers the service provider. No manual registration needed.

## Configuration

This integration requires a Splitwise OAuth access token.

**In OpenCompany**, credentials are managed through the Integrations UI.

**For standalone usage**, create `config/ai-tools.php`:

```php
return [
    'splitwise' => [
        'access_token' => env('SPLITWISE_ACCESS_TOKEN'),
        'url' => env('SPLITWISE_URL', 'https://secure.splitwise.com/api/v3.0'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `splitwise_list_expenses` | read | List shared expenses with optional filters |
| `splitwise_get_expense` | read | Get details of a specific expense |
| `splitwise_create_expense` | write | Create a new shared expense |
| `splitwise_list_groups` | read | List all groups the user belongs to |
| `splitwise_get_group` | read | Get details of a specific group |
| `splitwise_list_friends` | read | List all friends with balances |
| `splitwise_get_current_user` | read | Get the authenticated user's profile |

## Quick Start

```php
use OpenCompany\Integrations\Splitwise\SplitwiseService;
use OpenCompany\Integrations\Splitwise\Tools\SplitwiseListExpenses;
use OpenCompany\Integrations\Splitwise\Tools\SplitwiseCreateExpense;

// Create tools
$service = app(SplitwiseService::class);
$tools = [
    new SplitwiseListExpenses($service),
    new SplitwiseCreateExpense($service),
];

// Use with an AI agent
$response = Ai::agent()
    ->tools($tools)
    ->prompt('List my recent Splitwise expenses');
```

### Via ToolProvider (recommended)

If you have `integration-core` installed, all 7 tools auto-register with the `ToolProviderRegistry`:

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$registry = app(ToolProviderRegistry::class);
$provider = $registry->get('splitwise');

// Create any tool via the provider
$tool = $provider->createTool(
    \OpenCompany\Integrations\Splitwise\Tools\SplitwiseListExpenses::class
);
```

## Standalone Service Usage

```php
use OpenCompany\Integrations\Splitwise\SplitwiseService;

$service = app(SplitwiseService::class);

// List expenses
$expenses = $service->listExpenses(['limit' => 10]);

// Get a specific expense
$expense = $service->getExpense(12345);

// Create an expense
$expense = $service->createExpense([
    'cost' => '45.50',
    'description' => 'Dinner',
    'users' => [
        ['user_id' => 11111],
        ['user_id' => 22222],
    ],
]);

// List groups
$groups = $service->listGroups();

// Get a group
$group = $service->getGroup(12345);

// List friends
$friends = $service->listFriends();

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
- A [Splitwise](https://splitwise.com) account with API access

## License

MIT — see [LICENSE](LICENSE)
