# Integration: Raindrop.io

Raindrop.io integration package for OpenCompany and compatible Laravel hosts.

This package exposes the official Raindrop.io REST API surface from the GitBook
API reference. It registers 50 operation tools for bookmarks, collections,
tags, highlights, filters, imports, exports, backups, and authenticated user
settings.

## Installation

```console
composer require opencompanyapp/integration-raindrop
```

Laravel auto-discovers the service provider.

## Configuration

```php
return [
    'raindrop' => [
        'access_token' => env('RAINDROP_ACCESS_TOKEN'),
        'url' => env('RAINDROP_API_URL', 'https://api.raindrop.io/rest/v1'),
    ],
];
```

Raindrop.io uses OAuth bearer tokens:

```text
Authorization: Bearer <token>
```

## Tool Coverage

The provider exposes one tool per documented operation. Tool arguments use
snake_case path parameters, `query` for query-string filters, and `payload` for
JSON or multipart request bodies.

Representative tools:

- `raindrop_raindrops_single_create_raindrop`
- `raindrop_raindrops_multiple_get_raindrops`
- `raindrop_collections_get_root_collections`
- `raindrop_tags_get_tags`
- `raindrop_filters_get_filters`
- `raindrop_export_export_in_format`
- `raindrop_backups_get_all`

See `lua-docs/raindrop.md` for the full tool list and method/path reference.

## License

MIT
