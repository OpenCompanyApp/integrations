# Bitly Integration

Bitly API v4 tools for OpenCompany and KosmoKrator agents.

## Tools

| Tool | Type | Notes |
|------|------|-------|
| `bitly_shorten_link` | write | Basic `POST /shorten`. |
| `bitly_create_bitlink` | write | Create a Bitlink with metadata. |
| `bitly_get_link` | read | Get Bitlink details. |
| `bitly_update_link` | write | Update Bitlink metadata or destination. |
| `bitly_expand_bitlink` | read | Expand a Bitlink to its long URL. |
| `bitly_add_custom_bitlink` | write | Add a custom back-half. |
| `bitly_get_clicks` | read | Time-series click metrics. |
| `bitly_get_click_summary` | read | Total click summary. |
| `bitly_get_click_countries` | read | Clicks by country. |
| `bitly_get_click_referrers` | read | Clicks by referrer. |
| `bitly_list_groups` | read | List groups. |
| `bitly_get_group` | read | Get group details. |
| `bitly_list_group_bitlinks` | read | List Bitlinks in a group. |
| `bitly_create_qr_code` | write | Create QR Code. |
| `bitly_get_qr_code` | read | Get QR Code by ID. |
| `bitly_list_organization_webhooks` | read | List organization webhooks. |
| `bitly_create_organization_webhook` | write | Create organization webhook. |
| `bitly_get_current_user` | read | `GET /user`. |
| `bitly_api_get` | read | Generic API v4 GET. |
| `bitly_api_post` | write | Generic API v4 POST. |
| `bitly_api_patch` | write | Generic API v4 PATCH. |
| `bitly_api_delete` | write | Generic API v4 DELETE. |

## Configuration

```php
return [
    'bitly' => [
        'access_token' => env('BITLY_ACCESS_TOKEN'),
    ],
];
```
