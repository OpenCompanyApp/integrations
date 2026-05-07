# Integration: Manychat

> Manychat Account Public API integration for Laravel agents. Manage page info, flows, tags, custom fields, bot fields, sending, and subscribers.

This package exposes first-class tools for the documented Manychat `/fb/page`, `/fb/sending`, and `/fb/subscriber` endpoints, plus guarded generic helpers for less common documented API calls.

## Installation

```console
composer require opencompanyapp/integration-manychat
```

Laravel auto-discovers the service provider.

## Configuration

Manychat Account Public API keys are used as bearer tokens.

```php
return [
    'manychat' => [
        'api_key' => env('MANYCHAT_API_KEY'),
        'profile_api_key' => env('MANYCHAT_PROFILE_API_KEY'),
        'url' => env('MANYCHAT_URL', 'https://api.manychat.com'),
    ],
];
```

`profile_api_key` is optional and only needed for Profile API/template endpoints.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `manychat_get_page_info` | read | Get page/account information. |
| `manychat_get_current_user` | read | Compatibility alias for page/account information. |
| `manychat_list_flows` | read | List flows from `/fb/page/getFlows`. |
| `manychat_get_flow` | read | Find one flow client-side from the documented getFlows response. |
| `manychat_list_tags` | read | List tags. |
| `manychat_create_tag` | write | Create a tag. |
| `manychat_remove_tag` | write | Remove a tag by ID. |
| `manychat_remove_tag_by_name` | write | Remove a tag by name. |
| `manychat_list_growth_tools` | read | List growth tools. |
| `manychat_list_custom_fields` | read | List custom user fields. |
| `manychat_create_custom_field` | write | Create a custom user field. |
| `manychat_list_bot_fields` | read | List bot fields. |
| `manychat_set_bot_field` | write | Set a bot field by ID. |
| `manychat_send_message` | write | Compatibility alias for sendContent. |
| `manychat_send_content` | write | Send content to a subscriber. |
| `manychat_send_flow` | write | Send a flow to a subscriber. |
| `manychat_get_subscriber_info` | read | Get subscriber information by ID. |
| `manychat_find_subscriber_by_name` | read | Find subscribers by name. |
| `manychat_add_subscriber_tag` | write | Add a tag to a subscriber. |
| `manychat_remove_subscriber_tag` | write | Remove a tag from a subscriber. |
| `manychat_set_subscriber_custom_field` | write | Set one subscriber custom field. |
| `manychat_create_subscriber` | write | Create a subscriber. |
| `manychat_update_subscriber` | write | Update a subscriber. |
| `manychat_api_get` | read | Call a documented Manychat GET endpoint. |
| `manychat_api_post` | write | Call a documented Manychat POST endpoint. |

## Service Usage

```php
use OpenCompany\Integrations\ManyChat\ManyChatService;

$service = app(ManyChatService::class);

$page = $service->getPageInfo();
$flows = $service->listFlows();
$tags = $service->listTags();
$fields = $service->listCustomFields();

$service->sendContent([
    'subscriber_id' => 123456,
    'data' => [
        'version' => 'v2',
        'content' => [
            'type' => 'text',
            'messages' => [
                ['type' => 'text', 'text' => 'Hello from an agent'],
            ],
        ],
    ],
]);

$service->addSubscriberTag(123456, 111);
$service->setSubscriberCustomField(123456, 222, 'qualified');
```

## Generic Helpers

Use generic helpers only for documented Manychat endpoints that do not yet have a named wrapper:

```php
$topics = $service->apiGet('/fb/page/getOtnTopics');
$result = $service->apiPost('/fb/subscriber/addTagByName', [
    'subscriber_id' => 123456,
    'tag_name' => 'VIP',
]);
```

Absolute URLs are rejected so agents cannot bypass the configured Manychat API host.

## Notes

Manychat does not document a single-flow read endpoint. `manychat_get_flow` uses the documented `getFlows` endpoint and performs a client-side lookup by common flow namespace or ID fields.

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- `opencompanyapp/integration-core`
- A Manychat paid plan with API access

## License

MIT - see [LICENSE](LICENSE).
