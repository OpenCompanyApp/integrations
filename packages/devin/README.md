# Integration: Devin

Devin integration for the OpenCompany integration ecosystem. It lets agents
create and inspect Devin sessions, send follow-up messages, manage session tags
and insights, and administer organization secrets through the current Devin API.

## Configuration

This package uses Devin API keys.

```php
return [
    'devin' => [
        'api_key'     => env('DEVIN_API_KEY'),
        'org_id'      => env('DEVIN_ORG_ID'),
        'url'         => env('DEVIN_URL', 'https://api.devin.ai'),
        'api_version' => env('DEVIN_API_VERSION', 'v3'),
    ],
];
```

Use `https://api.devin.ai` plus `org_id` for current v3 organization endpoints.
Existing hosts configured with a URL ending in `/v1` keep legacy session behavior
for create, get, list, message, terminate, and append-tags tools.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `devin_create_session` | write | Create a Devin session with task context |
| `devin_get_session` | read | Get session status and details |
| `devin_list_sessions` | read | List sessions with pagination and filters |
| `devin_send_message` | write | Send a message to a session |
| `devin_terminate_session` | write | Terminate an active session |
| `devin_list_session_messages` | read | List v3 session messages |
| `devin_list_session_attachments` | read | List v3 session attachments |
| `devin_get_session_tags` | read | Read v3 session tags |
| `devin_append_session_tags` | write | Append session tags |
| `devin_get_session_insights` | read | Read v3 session insights |
| `devin_generate_session_insights` | write | Generate v3 session insights |
| `devin_get_current_user` | read | Identify the authenticated API principal |
| `devin_list_secrets` | read | List v3 organization secrets |
| `devin_create_secret` | write | Create a v3 organization secret |
| `devin_delete_secret` | write | Delete a v3 organization secret |

## Standalone Service Usage

```php
use OpenCompany\Integrations\Devin\DevinService;

$service = new DevinService(
    apiKey: 'devin_test_key',
    baseUrl: 'https://api.devin.ai',
    orgId: 'org_example'
);

$session = $service->createSession('Fix the failing example.test billing specs', [
    'title' => 'Billing spec fix',
    'tags' => ['billing', 'tests'],
]);

$service->sendMessage($session['devin_id'] ?? $session['id'], 'Start by reading the failing assertion.');
$messages = $service->listSessionMessages($session['devin_id'] ?? $session['id']);
```

## Notes For Agents

Read `script-docs/devin.md` for agent-facing usage examples and return-shape notes.
Do not assume legacy v1 response fields match v3 response fields; this package
returns Devin's JSON with minimal normalization so agents can use the current
API semantics directly.

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- A Devin account with API access
- Devin organization ID for v3 organization tools

## License

MIT - see [LICENSE](LICENSE)
