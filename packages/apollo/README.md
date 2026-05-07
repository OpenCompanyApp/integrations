# Apollo.io Integration

Apollo.io REST API tools for OpenCompany and KosmoKrator agents.

This package targets the current Apollo developer docs at `https://docs.apollo.io/`.
Some endpoints require a master API key or plan-specific access; Apollo returns
`403` when the key is valid but the account cannot use that capability.

## Tools

| Tool | Type | Notes |
|------|------|-------|
| `apollo_search_people` | read | People API Search for net-new people in Apollo data. |
| `apollo_enrich` | read | People Enrichment for one person. |
| `apollo_bulk_enrich_people` | read | Bulk People Enrichment for up to 10 people. |
| `apollo_list_organizations` | read | Organization Search; legacy slug retained. |
| `apollo_enrich_organization` | read | Organization Enrichment by domain. |
| `apollo_bulk_enrich_organizations` | read | Bulk Organization Enrichment for up to 10 domains. |
| `apollo_list_organization_job_postings` | read | Current job postings for an organization. |
| `apollo_search_contacts` | read | Search contacts saved in your Apollo team account. |
| `apollo_get_contact` | read | View a saved contact by contact ID. |
| `apollo_create_contact` | write | Create a saved contact. |
| `apollo_update_contact` | write | Update a saved contact. |
| `apollo_bulk_create_contacts` | write | Create up to 100 contacts. |
| `apollo_list_contact_stages` | read | Contact stage IDs. |
| `apollo_search_accounts` | read | Search saved accounts. |
| `apollo_get_organization` | read | View a saved account; legacy slug retained. |
| `apollo_create_account` | write | Create a saved account. |
| `apollo_update_account` | write | Update a saved account. |
| `apollo_bulk_create_accounts` | write | Create up to 100 accounts. |
| `apollo_list_account_stages` | read | Account stage IDs. |
| `apollo_get_current_user` | read | Current user profile when available. |
| `apollo_list_users` | read | Team users. |
| `apollo_list_email_accounts` | read | Team email accounts. |
| `apollo_get_api_usage_stats` | read | API usage and rate-limit stats. |

## Configuration

```php
return [
    'apollo' => [
        'api_key' => env('APOLLO_API_KEY'),
        'url' => env('APOLLO_URL', 'https://api.apollo.io'),
    ],
];
```

The service uses bearer-token authentication:

```http
Authorization: Bearer <api-key>
```

## Service Notes

- Search and enrichment endpoints use Apollo's documented query parameters.
- Contact and account create/update endpoints send JSON request bodies.
- `apollo_search_people` searches Apollo's database. `apollo_search_contacts`
  searches contacts already saved in the team account.
- `apollo_list_organizations` maps to Apollo Organization Search. The slug is
  retained for compatibility with earlier package versions.
- `apollo_get_organization` maps to Apollo account view. The slug is retained
  for compatibility with earlier package versions.
