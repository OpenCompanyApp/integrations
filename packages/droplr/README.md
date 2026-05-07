# Integration: Droplr

Droplr integration for the OpenCompany integration ecosystem. It exposes host bearer-token operations for drops, notes, boards, account profile data, and generic Droplr API calls.

## Configuration

```php
return [
    'droplr' => [
        'access_token' => env('DROPLR_ACCESS_TOKEN'),
        'url' => env('DROPLR_URL', 'https://api.droplr.com'),
    ],
];
```

Droplr's public documentation also describes an older signed-auth API with `/drops`, `/links`, `/notes`, `/files`, and `/account` paths. This package preserves the existing bearer-token host behavior and adds generic helpers so documented endpoints can be reached when the configured Droplr environment supports them.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `droplr_list_drops` | read | List drops with pagination, type, search, sort, and timestamp filters |
| `droplr_get_drop` | read | Get one drop |
| `droplr_create_drop` | write | Create a short-link drop |
| `droplr_create_note` | write | Create a note drop |
| `droplr_create_drop_raw` | write | Create a drop from a raw API payload |
| `droplr_update_drop` | write | Update one drop |
| `droplr_delete_drop` | write | Delete one drop |
| `droplr_list_boards` | read | List boards |
| `droplr_get_current_user` | read | Get current account/profile details |
| `droplr_update_current_user` | write | Update account fields supported by the host API |
| `droplr_api_get` | read | Call a Droplr GET endpoint |
| `droplr_api_post` | write | Call a Droplr POST endpoint |
| `droplr_api_put` | write | Call a Droplr PUT endpoint |
| `droplr_api_delete` | write | Call a Droplr DELETE endpoint |

## Service Usage

```php
use OpenCompany\Integrations\Droplr\DroplrService;

$service = app(DroplrService::class);

$drops = $service->listDrops([
    'type' => 'LINK',
    'sortBy' => 'CREATION',
    'order' => 'DESC',
    'limit' => 25,
]);

$drop = $service->createLinkDrop(
    link: 'https://example.test/docs',
    title: 'Documentation',
);

$note = $service->createNoteDrop(
    content: 'Release note text',
    title: 'Release note',
);
```

Generic helpers accept relative paths only:

```php
$service->apiGet('/v2/drops', ['limit' => 10]);
$service->apiPut('/v2/user', ['theme' => 'dark']);
```

## Notes

- Do not commit real Droplr tokens, account emails, drop codes, or private URLs in tests or docs.
- Public Droplr docs list legacy filters such as `offset`, `amount`, `sortBy`, `order`, `since`, and `until`; `droplr_list_drops` accepts those names as well as the package's existing `page` and `limit` parameters.
- Write tools make live changes in Droplr. Hosts should present approval flows before running them for agents.

## License

MIT
