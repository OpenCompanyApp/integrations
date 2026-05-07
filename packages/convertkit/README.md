# Integration: Kit (ConvertKit)

Kit integration for the OpenCompany integration ecosystem. It exposes the
current Kit API V4 for creator email marketing, subscriber automation,
broadcasts, forms, sequences, tags, purchases, custom fields, snippets, posts,
segments, webhooks, and safe raw API access.

API reference: https://developers.kit.com/api-reference/overview

## Installation

```console
composer require opencompanyapp/integration-convertkit
```

Laravel auto-discovers the service provider.

## Configuration

Kit API V4 uses `X-Kit-Api-Key` for personal account automation. Some endpoints
in Kit's own documentation, including bulk operations and purchase creation, may
require OAuth. This package accepts an optional OAuth access token and prefers it
when present.

```php
return [
    'convertkit' => [
        'api_key' => env('CONVERTKIT_API_KEY'),
        'oauth_access_token' => env('CONVERTKIT_OAUTH_ACCESS_TOKEN'),
        'url' => env('CONVERTKIT_URL', 'https://api.kit.com'),
    ],
];
```

## Tool Coverage

The provider exposes 72 tools across the current V4 resources:

- Account: current account, creator profile, email stats, growth stats, colors
- Broadcasts: list, create, get, update, delete, stats, click reporting
- Subscribers: list, create/upsert, filter, get, update, unsubscribe, stats, tags
- Forms: list, list subscribers, add subscribers by ID or email, bulk add
- Tags: list, create, update, tag subscribers, remove tags, bulk operations
- Sequences: list, create, get, update, delete, subscribers, add subscribers
- Custom fields: list, create, update, delete, bulk create, bulk value updates
- Other V4 resources: email templates, posts, purchases, segments, snippets, webhooks
- Raw helpers: `convertkit_api_get`, `convertkit_api_post`, `convertkit_api_put`, `convertkit_api_delete`

Raw helpers only accept relative Kit API paths such as `/subscribers`; absolute
URLs and parent-directory paths are rejected by the service.

## Example

```php
use OpenCompany\Integrations\ConvertKit\ConvertKitService;
use OpenCompany\Integrations\ConvertKit\Tools\ConvertKitCreateSubscriber;

$service = app(ConvertKitService::class);
$tool = new ConvertKitCreateSubscriber($service);

$result = $tool->execute([
    'email_address' => 'reader@example.test',
    'first_name' => 'Ada',
]);
```

## Notes for Agents

- Use cursor pagination fields such as `after`, `before`, and `per_page` on list tools.
- Prefer dedicated tools for common workflows, then use raw helpers for newly released endpoints.
- Purchase creation and bulk endpoints may need OAuth credentials depending on the Kit account and endpoint.
- All examples in tests and docs use fake domains and dummy values.

## License

MIT
