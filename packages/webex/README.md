# Integration: Webex

Cisco Webex integration for OpenCompany agent tooling. It exposes Webex REST
coverage for rooms, messages, people, memberships, teams, meetings, webhooks,
current-user checks, and generic relative API helpers.

## Configuration

This package uses a stored Webex access token. In OpenCompany and KosmoKrator,
configure credentials through the integration settings UI. For standalone usage,
bind a `CredentialResolver` value for:

```php
[
    'webex' => [
        'access_token' => env('WEBEX_ACCESS_TOKEN'),
        'url' => env('WEBEX_API_URL', 'https://webexapis.com/v1'),
    ],
]
```

Webex personal access tokens can be created from the Webex developer console for
development. Production deployments should use an OAuth flow that stores the
resulting token in the host credential store.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `webex_list_rooms` | read | List rooms visible to the token |
| `webex_get_room` | read | Get one room |
| `webex_create_room` | write | Create a room |
| `webex_update_room` | write | Update room metadata |
| `webex_delete_room` | write | Delete a room |
| `webex_list_messages` | read | List room messages |
| `webex_create_message` | write | Post a room message |
| `webex_get_message` | read | Get one message |
| `webex_update_message` | write | Update a message |
| `webex_delete_message` | write | Delete a message |
| `webex_list_people` | read | List or search people |
| `webex_get_person` | read | Get one person profile |
| `webex_list_memberships` | read | List room memberships |
| `webex_create_membership` | write | Add a person to a room |
| `webex_delete_membership` | write | Remove a room membership |
| `webex_list_teams` | read | List teams |
| `webex_get_team` | read | Get one team |
| `webex_create_team` | write | Create a team |
| `webex_update_team` | write | Update a team |
| `webex_delete_team` | write | Delete a team |
| `webex_list_team_memberships` | read | List team memberships |
| `webex_list_meetings` | read | List meetings |
| `webex_get_meeting` | read | Get one meeting |
| `webex_create_meeting` | write | Create a meeting |
| `webex_update_meeting` | write | Update a meeting |
| `webex_delete_meeting` | write | Delete a meeting |
| `webex_list_webhooks` | read | List webhooks |
| `webex_get_webhook` | read | Get one webhook |
| `webex_create_webhook` | write | Create a webhook |
| `webex_update_webhook` | write | Update a webhook |
| `webex_delete_webhook` | write | Delete a webhook |
| `webex_get_current_user` | read | Get the authenticated Webex profile |
| `webex_api_get` | read | Call a relative Webex GET endpoint |
| `webex_api_post` | write | Call a relative Webex POST endpoint |
| `webex_api_put` | write | Call a relative Webex PUT endpoint |
| `webex_api_delete` | write | Call a relative Webex DELETE endpoint |

## Service Usage

```php
use OpenCompany\Integrations\Webex\WebexService;

$service = app(WebexService::class);

$rooms = $service->listRooms(max: 20);
$room = $service->getRoom('room_123');
$message = $service->createMessage('room_123', text: 'Hello from an agent.');
$people = $service->listPeople(['email' => 'person@example.test']);
$meeting = $service->createMeeting([
    'title' => 'Weekly sync',
    'start' => '2026-05-08T10:00:00Z',
    'end' => '2026-05-08T10:30:00Z',
]);
$webhooks = $service->listWebhooks();
```

## Notes For Agents

Use first-class tools for common Webex resources. Use generic API helpers only
for newer or less common Webex endpoints, and pass relative paths such as
`/rooms` or `/team/memberships`. Absolute URLs are rejected so hosts retain
control over credential and base URL handling.

Webex scopes determine what the token can see and modify. Bots may have narrower
message visibility than user tokens.

## Requirements

- PHP 8.2+
- `opencompanyapp/integration-core`
- A Cisco Webex token with scopes for the requested resources

## License

MIT
