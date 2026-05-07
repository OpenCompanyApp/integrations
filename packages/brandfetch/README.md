# Integration: Brandfetch

Brandfetch integration for the OpenCompany integration ecosystem. It wraps the
current Brandfetch Brand API, Brand Search API, Transaction API, and Logo API
URL format.

API reference: https://docs.brandfetch.com/reference

## Configuration

```php
return [
    'brandfetch' => [
        'access_token' => env('BRANDFETCH_ACCESS_TOKEN'),
        'client_id' => env('BRANDFETCH_CLIENT_ID'),
        'url' => env('BRANDFETCH_URL', 'https://api.brandfetch.io'),
        'cdn_url' => env('BRANDFETCH_CDN_URL', 'https://cdn.brandfetch.io'),
    ],
];
```

`access_token` is used for Brand API and Transaction API. `client_id` is used for
Brand Search API and Logo API CDN URLs.

## Tool Coverage

The provider exposes 15 tools:

- Brand API: generic identifier lookup plus explicit domain, ticker, ISIN, and crypto routes
- Brand Search API: search brands by name or domain with a client ID
- Transaction API: enrich raw payment transaction labels into merchant brand data
- Logo API: build CDN URLs with width, height, theme, fallback, type, and format options
- Convenience asset extractors: logos, colors, and fonts from Brand API payloads
- Raw helpers: `brandfetch_api_get` and `brandfetch_api_post`

## Notes

- `brandfetch_get_current_user` is retained as a compatibility tool but now verifies credentials with the free `brandfetch.com` test brand because Brandfetch's current public reference does not document a user-profile endpoint.
- Use `brandfetch_get_brand_by_domain`, `brandfetch_get_brand_by_ticker`, `brandfetch_get_brand_by_isin`, or `brandfetch_get_brand_by_crypto` when identifier collisions matter.

## License

MIT
