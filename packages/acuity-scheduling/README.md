# Acuity Scheduling Integration

Acuity Scheduling API v1 tools for OpenCompany and KosmoKrator agents.

The package supports Acuity's documented Basic Auth mode (`user_id` + `api_key`)
and OAuth bearer tokens for multi-user applications.

## Tools

| Tool | Type | Notes |
|------|------|-------|
| `acuity_list_appointments` | read | List appointments with filters. |
| `acuity_get_appointment` | read | Get appointment details. |
| `acuity_create_appointment` | write | Create appointment. |
| `acuity_update_appointment` | write | Update editable appointment fields. |
| `acuity_reschedule_appointment` | write | Reschedule appointment. |
| `acuity_cancel_appointment` | write | Cancel appointment. |
| `acuity_list_appointment_payments` | read | List appointment payments. |
| `acuity_list_clients` | read | List/search clients. |
| `acuity_create_client` | write | Create client. |
| `acuity_update_client` | write | Update client by lookup parameters. |
| `acuity_list_calendars` | read | List calendars. |
| `acuity_list_appointment_types` | read | List appointment types. |
| `acuity_get_availability` | read | List available times. |
| `acuity_get_availability_dates` | read | List dates with availability. |
| `acuity_get_availability_classes` | read | List class availability. |
| `acuity_list_forms` | read | List intake forms. |
| `acuity_list_products` | read | List products and packages. |
| `acuity_list_orders` | read | List orders. |
| `acuity_get_order` | read | Get order details. |
| `acuity_create_certificate` | write | Create package/coupon certificate. |
| `acuity_list_blocks` | read | List blocked-off times. |
| `acuity_create_block` | write | Create blocked-off time. |
| `acuity_delete_block` | write | Delete blocked-off time. |
| `acuity_list_webhooks` | read | List dynamic webhooks. |
| `acuity_create_webhook` | write | Create dynamic webhook. |
| `acuity_delete_webhook` | write | Delete dynamic webhook. |
| `acuity_get_current_user` | read | `GET /me`. |
| `acuity_api_get` | read | Generic API v1 GET. |
| `acuity_api_post` | write | Generic API v1 POST. |
| `acuity_api_put` | write | Generic API v1 PUT. |
| `acuity_api_delete` | write | Generic API v1 DELETE. |

## Configuration

```php
return [
    'acuity-scheduling' => [
        'user_id' => env('ACUITY_USER_ID'),
        'api_key' => env('ACUITY_API_KEY'),
        'access_token' => env('ACUITY_ACCESS_TOKEN'),
        'url' => env('ACUITY_URL', 'https://acuityscheduling.com/api/v1'),
    ],
];
```

Use `user_id` + `api_key` for one Acuity account. Use `access_token` when the
host manages OAuth for multiple Acuity users.
