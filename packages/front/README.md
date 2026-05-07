# Integration: Front

Front integration for OpenCompany agents. It exposes typed tools for customer conversations, messages, comments, contacts, inboxes, tags, teams, and teammates through the Front Core API, with raw API helpers for newer or less common endpoints.

## Installation

```console
composer require opencompanyapp/integration-front
```

Laravel auto-discovers the service provider.

## Configuration

This package uses a Front API token or OAuth access token.

```php
return [
    'front' => [
        'access_token' => env('FRONT_ACCESS_TOKEN'),
        'url' => env('FRONT_API_URL', 'https://api2.frontapp.com'),
    ],
];
```

## Tool Coverage

The provider registers 64 tools, including:

- Raw helpers: `front_api_get`, `front_api_post`, `front_api_patch`, `front_api_put`, `front_api_delete`
- Conversations and comments: list, search, get, create discussion, update, reminders, inboxes, comments, add/remove tags
- Messages: list, get, reply, create outbound message, import message, create draft
- Inboxes and channels: list/get inboxes, inbox conversations, channels, access management, team inbox creation
- Contacts: company/team/teammate contacts, contact conversations, handles, create/update/delete
- Teams and teammates: list/get/update teammates, assigned conversations, inboxes, rules, teams, team inboxes
- Tags: global, company, team, and teammate tag listing and creation, update/delete, tagged conversations

Multipart file upload endpoints are intentionally not wrapped by the JSON helpers. Use host-specific upload handling or raw HTTP support that can send `multipart/form-data` when attachments or avatars are required.

## Service Usage

```php
use OpenCompany\Integrations\Front\FrontService;

$front = new FrontService(accessToken: 'token');

$conversations = $front->apiGet('/conversations', ['limit' => 10]);
$contact = $front->apiPost('/contacts', [
    'handles' => [
        ['source' => 'email', 'handle' => 'person@example.test'],
    ],
]);
```

## Agent Notes

List responses generally use Front's `_results` and `_pagination` shape. Prefer `page_token` pagination for current Front endpoints. Some older compatibility parameters remain available where previous host usage expected them, but new agent scripts should follow the Front Core API docs.

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- A Front account with Core API access

## License

MIT
