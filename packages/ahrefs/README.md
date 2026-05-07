# Ahrefs Integration

Ahrefs API v3 tools for OpenCompany and KosmoKrator agents.

## Tools

| Tool | Type | Notes |
|------|------|-------|
| `ahrefs_list_backlinks` | read | `GET /v3/site-explorer/all-backlinks`. |
| `ahrefs_list_referring_domains` | read | `GET /v3/site-explorer/refdomains`. |
| `ahrefs_list_organic_keywords` | read | `GET /v3/site-explorer/organic-keywords`. |
| `ahrefs_list_pages` | read | `GET /v3/site-explorer/top-pages`. |
| `ahrefs_get_metrics` | read | Overview metrics. |
| `ahrefs_get_domain_rating` | read | Domain Rating and Ahrefs Rank. |
| `ahrefs_get_backlinks_stats` | read | Backlink statistics. |
| `ahrefs_list_broken_backlinks` | read | Broken backlinks. |
| `ahrefs_list_organic_competitors` | read | Organic competitors. |
| `ahrefs_list_paid_pages` | read | Paid-search pages. |
| `ahrefs_list_anchors` | read | Backlink anchors. |
| `ahrefs_list_linked_domains` | read | Outgoing linked domains. |
| `ahrefs_get_limits_and_usage` | read | Subscription limits and usage. |
| `ahrefs_api_get` | read | Generic API v3 GET. |

## Configuration

```php
return [
    'ahrefs' => [
        'api_key' => env('AHREFS_API_KEY'),
        'url' => env('AHREFS_URL', 'https://api.ahrefs.com'),
    ],
];
```

Ahrefs API v3 uses bearer API key authentication.
