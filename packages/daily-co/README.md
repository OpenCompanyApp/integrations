# Integration: Daily.co

Daily.co video API integration for OpenCompany agents. The package exposes the
REST API surface represented by Daily's official generated Ruby SDK.

## Installation

```console
composer require opencompanyapp/integration-daily-co
```

Laravel auto-discovers the service provider.

## Configuration

Configure a Daily API key. The default base URL is `https://api.daily.co/v1`.

```php
return [
    'daily-co' => [
        'api_key' => env('DAILY_CO_API_KEY'),
        'url' => env('DAILY_CO_URL', 'https://api.daily.co/v1'),
    ],
];
```

## Coverage

This package follows the endpoint list in Daily's official generated Ruby SDK
at `https://github.com/daily-co/daily-ruby` and currently exposes 54 tools.
Representative tools include:

| Tool | Type | Description |
|------|------|-------------|
| `daily_co_list_rooms` | read | List rooms |
| `daily_co_create_room` | write | Create a room |
| `daily_co_create_meeting_token` | write | Create a meeting token |
| `daily_co_get_meeting_participants` | read | Get meeting participants |
| `daily_co_room_recordings_start` | write | Start room recording |
| `daily_co_list_recordings` | read | List recordings |
| `daily_co_list_transcripts` | read | List transcripts |
| `daily_co_list_webhooks` | read | List webhooks |

## Usage

```php
use OpenCompany\Integrations\DailyCo\DailyCoService;
use OpenCompany\Integrations\DailyCo\Tools\DailyCoListRooms;

$tool = new DailyCoListRooms(app(DailyCoService::class));
$result = $tool->execute(['query' => ['limit' => 10]]);
```

The service also supports direct operation execution:

```php
use OpenCompany\Integrations\DailyCo\DailyCoService;

$service = app(DailyCoService::class);

$rooms = $service->call('daily_co_list_rooms', ['limit' => 10]);

$token = $service->call('daily_co_create_meeting_token', [
    'payload' => [
        'properties' => [
            'room_name' => 'team-sync',
            'is_owner' => true,
        ],
    ],
]);
```

## Tool Arguments

Path parameters are exposed as top-level snake_case arguments. Write operations
accept a `payload` object for the documented JSON body. Tools also accept
`query` for documented query parameters; unrecognized top-level arguments are
sent to the JSON body for write operations and to the query string for read
operations.

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- `opencompanyapp/integration-core`
- A Daily account with API access

## License

MIT. See [LICENSE](LICENSE).
