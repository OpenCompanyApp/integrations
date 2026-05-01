# X Ads — Lua API Reference

This integration is generated from the official X Ads Postman collection and exposes 190 Ads API operations.

## Authentication

Configure OAuth 1.0a user-context credentials:

- `api_key`
- `api_secret`
- `access_token`
- `access_token_secret`

X Ads API access must be approved by X. Tools are marked with `required_access_tier=approved_ads_api_access`.

## Runtime Notes

- Campaign, line item, creative, funding, and audience writes are marked `billing_sensitive`.
- Stats job endpoints are marked `runtime_mode=async_job`.
- If `account_id` is configured, tools with an `account_id` path parameter can omit it.

## Examples

```lua
local accounts = app.integrations.x_ads.x_ads_get_accounts({})
local campaigns = app.integrations.x_ads.x_ads_get_accounts_account_id_campaigns({
  account_id = "account-id",
  count = "25"
})
```
