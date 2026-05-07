# Unbounce Integration

Unbounce REST API integration for OpenCompany agents. It covers accounts,
sub-accounts, landing pages, domains, page groups, page form fields, leads, lead
deletion requests, current user details, and safe raw relative API calls.

## Configuration

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `access_token` | secret | yes | Unbounce OAuth bearer token |
| `url` | url | no | API base URL, default `https://api.unbounce.com` |

## Tool Areas

| Area | Tools |
|------|-------|
| Metadata and users | `get_api_metadata`, `get_current_user` |
| Accounts | `list_accounts`, `get_account`, `list_sub_accounts`, `get_sub_account` |
| Pages | `list_pages`, `list_account_pages`, `list_sub_account_pages`, `get_page`, `list_page_form_fields` |
| Leads | `list_leads`, `get_lead`, `create_lead`, `create_lead_deletion_request`, `get_lead_deletion_request` |
| Domains and groups | `list_domains`, `get_domain`, `list_domain_pages`, `list_page_groups`, `get_page_group`, `list_page_group_pages` |
| Raw API | `api_get`, `api_post`, `api_delete` |

## Usage

```php
use OpenCompany\Integrations\Unbounce\UnbounceService;

$service = app(UnbounceService::class);

$accounts = $service->listAccounts();
$pages = $service->listAccountPages('1456243', ['limit' => 25]);
$fields = $service->listPageFormFields('page-123');
$leads = $service->listLeads('page-123', 50, 0);
```

## Notes

Unbounce OAuth access tokens can be short-lived. Hosts should refresh or
provision tokens outside this package and store the resulting bearer token.
Raw helpers reject full URLs and parent-directory path segments.

## License

MIT, see [LICENSE](LICENSE).
