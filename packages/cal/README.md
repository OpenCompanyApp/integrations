# Cal.com Integration

Cal.com API v2 tools for OpenCompany and KosmoKrator agents.

The package uses bearer tokens accepted by Cal.com API v2: API keys prefixed
with `cal_`, managed-user access tokens, or OAuth access tokens.

## Tools

| Tool | Type | Notes |
|------|------|-------|
| `cal_list_event_types` | read | List event types. |
| `cal_get_event_type` | read | Get event type by ID. |
| `cal_list_bookings` | read | List bookings. |
| `cal_get_booking` | read | Get booking by ID or UID. |
| `cal_create_booking` | write | Create booking. |
| `cal_cancel_booking` | write | Cancel booking by UID. |
| `cal_reschedule_booking` | write | Reschedule booking by UID. |
| `cal_get_current_user` | read | `GET /me`. |
| `cal_api_get` | read | Generic API v2 GET. |
| `cal_api_post` | write | Generic API v2 POST. |
| `cal_api_patch` | write | Generic API v2 PATCH. |
| `cal_api_delete` | write | Generic API v2 DELETE. |

## Configuration

```php
return [
    'cal' => [
        'access_token' => env('CAL_ACCESS_TOKEN'),
        'url' => env('CAL_API_URL', 'https://api.cal.com/v2'),
    ],
];
```

## Generic API

Generic paths are relative to the configured v2 base URL:

```php
$slots = $service->apiGet('/slots', [
    'eventTypeId' => 123,
    'start' => '2026-05-07T00:00:00Z',
    'end' => '2026-05-08T00:00:00Z',
]);
```

Refer to the Cal.com API v2 docs for endpoint-specific parameters and scopes.
