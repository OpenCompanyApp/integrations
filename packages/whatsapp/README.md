# Integration: WhatsApp Business

WhatsApp Business Platform integration for OpenCompany agents. It covers Cloud
API messages, media, contact validation, message templates, phone numbers,
business profiles, webhook app subscriptions, and safe raw relative Graph API
helpers.

## Configuration

Credentials are managed by the host app through `CredentialResolver`.

```php
return [
    'whatsapp' => [
        'access_token' => env('WHATSAPP_ACCESS_TOKEN'),
        'phone_number_id' => env('WHATSAPP_PHONE_NUMBER_ID'),
        'whatsapp_business_account_id' => env('WHATSAPP_BUSINESS_ACCOUNT_ID'),
        'base_url' => env('WHATSAPP_BASE_URL', 'https://graph.facebook.com/v24.0'),
    ],
];
```

Use `phone_number_id` for message, media, contact, registration, and business
profile tools. Use `whatsapp_business_account_id` for template management,
phone-number listing, and webhook subscription tools.

## Available Tool Areas

| Area | Tools |
|------|-------|
| Messages | `send_message`, `send_template`, `send_message_payload`, `mark_message_read`, `get_message` |
| Contacts | `check_contacts`, `list_contacts` compatibility alias |
| Media | `upload_media`, `get_media`, `delete_media` |
| Templates | `list_templates`, `get_template`, `create_template`, `update_template`, `delete_template` |
| Phone numbers | `get_phone_number`, `list_phone_numbers`, `request_verification_code`, `verify_code`, `register_phone_number`, `deregister_phone_number` |
| Business profile | `get_business_profile`, `update_business_profile` |
| Webhooks | `list_subscribed_apps`, `subscribe_app`, `unsubscribe_app` |
| Raw Graph | `api_get`, `api_post`, `api_delete` |

## Service Usage

```php
use OpenCompany\Integrations\WhatsApp\WhatsAppService;

$service = app(WhatsAppService::class);

$service->sendMessage('15551234567', 'Hello from OpenCompany!');
$service->sendTemplate('15551234567', 'hello_world', 'en_US');
$service->checkContacts(['15551234567']);
$service->listTemplates(status: 'APPROVED');
$service->getBusinessProfile();
```

## ToolProvider Usage

```php
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

$provider = app(ToolProviderRegistry::class)->get('whatsapp');
$tool = $provider->createTool(
    \OpenCompany\Integrations\WhatsApp\Tools\WhatsAppSendMessage::class
);
```

## Notes

The Cloud API exposes contact validation as a POST endpoint. It does not expose
a general contact-listing edge, so the historical `whatsapp_list_contacts` slug
is retained as a compatibility alias for validation.

Raw API helpers reject full URLs and parent-directory path segments. Pass only
relative Graph API paths such as `/me` or `/{waba_id}/message_templates`.

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- A Meta app with WhatsApp Business Platform access
- A System User or app access token with the required WhatsApp permissions

## License

MIT, see [LICENSE](LICENSE).
