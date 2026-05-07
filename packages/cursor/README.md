# Integration: Cursor

Cursor Admin API integration for the OpenCompany integration ecosystem. It exposes team members, usage, spending, spend limits, and repository blocklist management from the documented Cursor Admin API.

## Endpoint Coverage

- `GET /teams/members`
- `POST /teams/daily-usage-data`
- `POST /teams/spend`
- `POST /teams/filtered-usage-events`
- `POST /teams/user-spend-limit`
- `GET /settings/repo-blocklists/repos`
- `POST /settings/repo-blocklists/repos/upsert`
- `DELETE /settings/repo-blocklists/repos/{repoId}`

## Installation

```console
composer require opencompanyapp/integration-cursor
```

Laravel auto-discovers the service provider.

## Configuration

Cursor Admin API keys are created by team admins in Cursor Dashboard > Settings > Cursor Admin API Keys. Cursor uses Basic auth with the API key as the username and an empty password.

```php
return [
    'cursor' => [
        'api_key' => env('CURSOR_API_KEY'),
        'url' => env('CURSOR_API_URL', 'https://api.cursor.com'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `cursor_list_team_members` | read | List team members and roles |
| `cursor_get_daily_usage_data` | read | Get daily usage data for a date range |
| `cursor_get_spend` | read | Get current-cycle spend data |
| `cursor_get_usage_events` | read | Get detailed usage events |
| `cursor_set_user_spend_limit` | write | Set a whole-dollar user spend limit |
| `cursor_list_repo_blocklists` | read | List repository blocklists |
| `cursor_upsert_repo_blocklists` | write | Upsert repository blocklist patterns |
| `cursor_delete_repo_blocklist` | write | Delete a repository blocklist entry |

## Quick Start

```php
use OpenCompany\Integrations\Cursor\CursorService;

$service = app(CursorService::class);

$members = $service->listTeamMembers();
$spend = $service->getSpend(['page' => 1, 'pageSize' => 25]);
$blocklists = $service->listRepoBlocklists();
```

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- `opencompanyapp/integration-core`
- A Cursor team admin API key

## License

MIT - see [LICENSE](LICENSE)
