# Google Ads

Namespace: `google-ads`

Enterprise Google Ads API integration for reporting, account discovery, campaign creation, campaign management, assets, recommendations, conversions, Customer Match, change tracking, billing, batch jobs, and raw versioned API access.

Official references:

- Google Ads API REST auth: https://developers.google.com/google-ads/api/rest/auth
- OAuth scope: `https://www.googleapis.com/auth/adwords`
- Current default API version in this package: `v24`
- Access levels and developer tokens: https://developers.google.com/google-ads/api/docs/api-policy/access-levels
- Required Minimum Functionality: https://developers.google.com/google-ads/api/docs/api-policy/rmf
- Quotas and rate limits: https://developers.google.com/google-ads/api/docs/best-practices/quotas
- Partial failures: https://developers.google.com/google-ads/api/docs/best-practices/partial-failures
- Performance Max: https://developers.google.com/google-ads/api/performance-max/getting-started
- Conversion uploads: https://developers.google.com/google-ads/api/docs/conversions/upload-clicks
- Customer Match: https://developers.google.com/google-ads/api/docs/remarketing/audience-segments/customer-match/get-started

## Authentication

Required credentials:

- `developer_token`: Google Ads API developer token.
- `access_token`: OAuth access token with the `adwords` scope, or a refresh-token credential set.

Recommended credentials:

- `refresh_token`: long-lived refresh token. For CLI-only setup, this can be used without a pre-seeded access token when `client_id` and `client_secret` are also configured.
- `client_id` and `client_secret`: required if the integration should refresh tokens automatically.
- `manager_customer_id`: MCC ID used as the `login-customer-id` header when operating through a manager account.
- `default_customer_id`: client customer ID used when a tool call omits `customer_id`.
- `api_version`: defaults to `v24`.

Customer IDs can include dashes in input; the service normalizes them to digits for headers and URLs.

## CLI setup for KosmoKrator

This integration supports manual refresh-token setup. A CLI host does not need to expose an OAuth redirect endpoint at runtime if credentials are generated externally and stored in the host credential resolver.

Use Google's OAuth Playground or a local OAuth helper to generate a refresh token with this scope:

```text
https://www.googleapis.com/auth/adwords
```

Store:

```text
google-ads.developer_token
google-ads.client_id
google-ads.client_secret
google-ads.access_token
google-ads.refresh_token
google-ads.expires_at
google-ads.manager_customer_id
google-ads.default_customer_id
google-ads.api_version
```

Hosted web apps should still use a redirect endpoint for user self-service connection and consent.

## Safety model

Write tools require one of these:

- `validate_only=true`: validate with Google Ads without applying changes.
- `confirm_execute=true`: apply a live change.

This is intentional. Campaign creation, budgets, criteria, recommendations, conversions, audience uploads, billing proposals, and user invitations can materially affect production accounts.

Use `validate_only=true` first for generated campaign specs. Use `confirm_execute=true` only after inspection.

## Read tools

`google_ads_diagnostics()`

Returns safe configuration status: configured flag, API version, whether refresh tokens and manager IDs exist, default customer ID, and OAuth scope.

`google_ads_list_accessible_customers()`

Lists customer resource names directly accessible to the OAuth user.

`google_ads_list_customer_clients({ customer_id, level, status, limit })`

Lists accounts under a manager or customer using the `customer_client` view.

`google_ads_search({ customer_id, query, page_token, page_size })`

Runs arbitrary GAQL through `GoogleAdsService.Search`.

`google_ads_search_stream({ customer_id, query })`

Runs streaming GAQL for larger reports.

Report helpers:

- `google_ads_campaign_report`
- `google_ads_ad_group_report`
- `google_ads_ad_report`
- `google_ads_keyword_report`
- `google_ads_search_term_report`
- `google_ads_asset_report`
- `google_ads_performance_max_report`

Common report parameters:

```lua
google_ads_campaign_report({
  customer_id = "1234567890",
  date_range = "LAST_30_DAYS",
  limit = 100
})
```

You can use `date_from` and `date_to` instead of `date_range`.

## Campaign creation

`google_ads_create_search_campaign`

Creates a complete Search campaign with:

- campaign budget
- paused Search campaign
- ad group
- keywords
- location and language criteria
- responsive search ad

Example dry run:

```lua
google_ads_create_search_campaign({
  customer_id = "1234567890",
  validate_only = true,
  spec = {
    name = "Example Search Campaign",
    daily_budget = 50,
    start_date = "20260601",
    locations = {"2840"},
    language_ids = {"1000"},
    keywords = {
      { text = "enterprise crm", match_type = "PHRASE" },
      { text = "crm software", match_type = "BROAD" }
    },
    responsive_search_ad = {
      final_urls = {"https://example.test"},
      headlines = {"Enterprise CRM", "Pipeline Software", "Book A Demo"},
      descriptions = {"Manage revenue workflows.", "Built for scaling teams."}
    }
  }
})
```

Live create:

```lua
google_ads_create_search_campaign({
  customer_id = "1234567890",
  confirm_execute = true,
  spec = { ... }
})
```

The default created campaign and ad group status is `PAUSED` unless you explicitly provide another status.

`google_ads_create_performance_max_campaign`

Creates a Performance Max campaign with budget, paused campaign, asset group, text assets, existing assets, and campaign criteria.

Example dry run:

```lua
google_ads_create_performance_max_campaign({
  customer_id = "1234567890",
  validate_only = true,
  spec = {
    name = "Example PMax",
    daily_budget = 100,
    final_urls = {"https://example.test"},
    locations = {"2840"},
    language_ids = {"1000"},
    text_assets = {
      headline = {"Enterprise Analytics", "Scale Growth"},
      description = {"Turn first-party data into better campaigns."},
      long_headline = {"Enterprise analytics for revenue teams"}
    },
    existing_assets = {
      { resource_name = "customers/1234567890/assets/111", field_type = "MARKETING_IMAGE" },
      { resource_name = "customers/1234567890/assets/222", field_type = "LOGO" }
    }
  }
})
```

## Management tools

Use resource-specific managers for standard lifecycle operations:

- `google_ads_create_campaign_budget`
- `google_ads_manage_campaign`
- `google_ads_manage_ad_group`
- `google_ads_manage_keyword`
- `google_ads_manage_ad`
- `google_ads_manage_campaign_criteria`
- `google_ads_upload_image_asset`
- `google_ads_link_asset`

The manager tools accept:

- `action`: `create`, `update`, `pause`, `enable`, or `remove`
- `fields`: Google Ads REST JSON shape for create/update
- `resource_id` or `resource_name` for existing resources
- `update_mask` for update operations

Example pause:

```lua
google_ads_manage_campaign({
  customer_id = "1234567890",
  action = "pause",
  resource_id = "987654321",
  confirm_execute = true
})
```

## Recommendations

`google_ads_list_recommendations({ customer_id, type, limit })`

Lists available optimization recommendations.

`google_ads_apply_recommendations({ customer_id, operations, confirm_execute = true })`

Applies recommendations. Always inspect recommendation details first.

## Conversions and audiences

`google_ads_upload_click_conversions`

Uploads click conversions. Maximum 2,000 conversions per request.

`google_ads_upload_call_conversions`

Uploads call conversions. Maximum 2,000 conversions per request.

`google_ads_create_customer_match_list`

Creates a CRM-based user list.

`google_ads_run_customer_match_job`

Creates an OfflineUserDataJob, adds user data operations, and runs it. If `members` are provided with raw emails or phone numbers, the tool normalizes and SHA-256 hashes them before sending. Do not log raw PII in agent prompts or test fixtures.

Example:

```lua
google_ads_run_customer_match_job({
  customer_id = "1234567890",
  user_list = "customers/1234567890/userLists/111",
  confirm_execute = true,
  members = {
    { email = "person@example.test" },
    { phone = "+15550101010" }
  }
})
```

For larger first-party data workflows, prefer the separate `google_data_manager` integration when the destination supports Google Data Manager ingestion.

## Change tracking, billing, and raw coverage

`google_ads_get_change_status`

Lists changed resources for incremental sync.

`google_ads_get_change_events`

Lists field-level change events. Google Ads imposes freshness and date-window restrictions on change event queries.

`google_ads_list_billing_setups`

Lists billing setup resources.

`google_ads_account_budget_proposal`

Creates account budget proposal operations for monthly invoicing accounts.

`google_ads_create_batch_job`

Creates a batch job and can append operations and run it. A single `addOperations` request is limited to 5,000 mutate operations. Do not pass `sequence_token` for the first append; use the previous `nextSequenceToken` only for later append calls.

`google_ads_mutate`

Governed escape hatch for resource-specific or mixed mutate operations.

`google_ads_raw_request`

Low-level request escape hatch for endpoints not yet covered by typed tools. Non-GET raw requests require `confirm_execute=true`.

## Production notes

- The Google Ads API has strict quotas and per-request operation limits. Keep batch sizes modest and implement host-level retry/backoff for transient quota errors.
- API versions sunset regularly. Keep `api_version` configurable and test migrations before Google sunsets a version.
- Ad creation and management must satisfy Google's Required Minimum Functionality and API policy requirements if exposed to end users.
- Use test accounts for destructive validation.
- Store tokens only through the host credential resolver. Do not hard-code tokens in Lua scripts, docs, tests, or fixtures.
