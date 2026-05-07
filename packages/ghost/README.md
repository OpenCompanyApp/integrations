# Integration: Ghost CMS

Expose Ghost Admin API operations to OpenCompany and KosmoKrator agents.

## Coverage

This package covers posts, pages, tags, authors, members, tiers, offers, newsletters, webhooks, site metadata, current user checks, and safe raw relative Admin API helpers.

## Configuration

```php
return [
    'ghost' => [
        'api_key' => env('GHOST_ADMIN_API_KEY'),
        'url' => env('GHOST_ADMIN_API_URL'),
    ],
];
```

`api_key` must be a Ghost Admin API key in `id:secret` format. `url` should end in `/ghost/api/admin`.

## Documentation

See the official Ghost Admin API documentation at <https://ghost.org/docs/admin-api/>.

## License

MIT
