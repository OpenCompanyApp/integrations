# Integration: Salesloft

Salesloft integration for OpenCompany agent tooling. It exposes Salesloft API
coverage for people, accounts, cadences, cadence memberships, tasks, calls,
emails, notes, users, legacy sequence/rule wrappers, and generic relative API
helpers.

## Configuration

This package uses a stored Salesloft OAuth access token or API token. In
OpenCompany and KosmoKrator, configure credentials through the integration
settings UI. For standalone usage, bind a `CredentialResolver` value for:

```php
[
    'salesloft' => [
        'access_token' => env('SALESLOFT_ACCESS_TOKEN'),
        'url' => env('SALESLOFT_API_URL', 'https://api.salesloft.com'),
    ],
]
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `salesloft_list_users` | read | List users |
| `salesloft_get_user` | read | Get one user |
| `salesloft_list_people` | read | List people |
| `salesloft_get_person` | read | Get one person |
| `salesloft_create_person` | write | Create a person |
| `salesloft_update_person` | write | Update a person |
| `salesloft_delete_person` | write | Delete a person |
| `salesloft_list_accounts` | read | List accounts |
| `salesloft_get_account` | read | Get one account |
| `salesloft_create_account` | write | Create an account |
| `salesloft_update_account` | write | Update an account |
| `salesloft_delete_account` | write | Delete an account |
| `salesloft_list_cadences` | read | List cadences |
| `salesloft_get_cadence` | read | Get one cadence |
| `salesloft_list_cadence_memberships` | read | List cadence memberships |
| `salesloft_create_cadence_membership` | write | Add a person to a cadence |
| `salesloft_list_tasks` | read | List tasks |
| `salesloft_get_task` | read | Get one task |
| `salesloft_update_task` | write | Update a task |
| `salesloft_list_calls` | read | List call activities |
| `salesloft_create_call` | write | Create a call activity |
| `salesloft_list_emails` | read | List email activities |
| `salesloft_list_notes` | read | List notes |
| `salesloft_create_note` | write | Create a note |
| `salesloft_get_current_user` | read | Get the authenticated user |
| `salesloft_list_sequences` | read | Legacy list call sequences |
| `salesloft_get_sequence` | read | Legacy get sequence |
| `salesloft_create_sequence` | write | Legacy create sequence |
| `salesloft_list_rules` | read | Legacy list rules |
| `salesloft_get_rule` | read | Legacy get rule |
| `salesloft_api_get` | read | Call a relative API GET endpoint |
| `salesloft_api_post` | write | Call a relative API POST endpoint |
| `salesloft_api_put` | write | Call a relative API PUT endpoint |
| `salesloft_api_delete` | write | Call a relative API DELETE endpoint |

## Service Usage

```php
use OpenCompany\Integrations\Salesloft\SalesloftService;

$service = app(SalesloftService::class);

$people = $service->listPeople(['per_page' => 25]);
$person = $service->getPerson(123);
$account = $service->createAccount(['name' => 'Example Corp']);
$cadences = $service->listCadences();
$tasks = $service->listTasks(['user_id' => 42]);
$call = $service->createCall(['person_id' => 123, 'user_id' => 42]);
```

## Notes For Agents

Use first-class tools for common Salesloft resources. Use generic API helpers
only for less common endpoints, passing relative paths such as `/v2/people`,
`/v2/tasks/123`, or `/v2/activities/calls`. Absolute URLs are rejected so hosts
control credentials and API base URL handling.

## Requirements

- PHP 8.2+
- `opencompanyapp/integration-core`
- A Salesloft account with API access

## License

MIT
