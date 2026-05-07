# Amazon SES Integration

Amazon SES v2 tools for OpenCompany and KosmoKrator agents.

This package uses AWS Signature Version 4. It does not use bearer tokens.
Configure AWS access keys with SES permissions and a region.

## Tools

| Tool | Type | Notes |
|------|------|-------|
| `amazonses_send_email` | write | Send simple or template email with SES v2. |
| `amazonses_get_account` | read | Account-level SES sending details. |
| `amazonses_get_template` | read | Get an email template. |
| `amazonses_list_templates` | read | List email templates. |
| `amazonses_create_template` | write | Create an email template. |
| `amazonses_update_template` | write | Update an email template. |
| `amazonses_delete_template` | write | Delete an email template. |
| `amazonses_list_suppressions` | read | List account-level suppressed email addresses. |
| `amazonses_list_identities` | read | List verified identities. |
| `amazonses_get_identity` | read | Get identity details. |
| `amazonses_list_configuration_sets` | read | List configuration sets. |
| `amazonses_api_get` | read | Generic signed SES v2 GET. |
| `amazonses_api_post` | write | Generic signed SES v2 POST. |
| `amazonses_api_put` | write | Generic signed SES v2 PUT. |
| `amazonses_api_delete` | write | Generic signed SES v2 DELETE. |

## Configuration

```php
return [
    'amazon-ses' => [
        'access_key_id' => env('AWS_ACCESS_KEY_ID'),
        'secret_access_key' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
        'session_token' => env('AWS_SESSION_TOKEN'),
        'url' => env('AMAZON_SES_URL'),
    ],
];
```

When `url` is empty, the service uses the regional endpoint
`https://email.{region}.amazonaws.com`.

## Generic API

Generic tools accept paths beginning with `/v2/` and sign the request with the
configured AWS credentials:

```php
$account = $service->apiGet('/v2/email/account');
$eventDestinations = $service->apiGet('/v2/email/configuration-sets/default/event-destinations');
```

Use the official SES v2 API reference for path-specific payloads and response
shapes.
