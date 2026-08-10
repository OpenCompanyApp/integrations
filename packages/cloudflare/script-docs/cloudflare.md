# Cloudflare

Cloudflare tools are exposed under `app.integrations.cloudflare`. Use them to manage common Cloudflare account, zone, DNS, cache, ruleset, page-rule, and Workers KV namespace workflows.

The package includes first-class tools for frequent operations and raw API helpers for Cloudflare's much larger v4 API surface:

- `cloudflare_api_get`
- `cloudflare_api_post`
- `cloudflare_api_patch`
- `cloudflare_api_put`
- `cloudflare_api_delete`

Raw API helpers take a path relative to `https://api.cloudflare.com/client/v4`, for example `/zones/{zone_id}/settings`. Use first-class tools when one exists because they validate required identifiers and document the expected body shape.

## Discovery

Start with accounts and zones:

```js
var token = app.integrations.cloudflare.cloudflare_verify_token({})

var accounts = app.integrations.cloudflare.cloudflare_list_accounts({
  per_page: 20,
})

var zones = app.integrations.cloudflare.cloudflare_list_zones({
  name: "example.com",
  per_page: 20,
})
```
Use `cloudflare_get_account`, `cloudflare_list_account_members`, and `cloudflare_list_account_roles` for account access audits.

## DNS

DNS tools use `zone_id` and Cloudflare DNS record IDs. Use list first when only a hostname is known.

```js
var records = app.integrations.cloudflare.cloudflare_list_dns_records({
  zone_id: "zone_123",
  type: "A",
  name: "www.example.com",
})

var created = app.integrations.cloudflare.cloudflare_create_dns_record({
  zone_id: "zone_123",
  type: "A",
  name: "www.example.com",
  content: "192.0.2.10",
  ttl: 1,
  proxied: true,
})
```
Use `cloudflare_get_dns_record`, `cloudflare_update_dns_record`, `cloudflare_patch_dns_record`, and `cloudflare_delete_dns_record` for single-record lifecycle work. `update` uses Cloudflare's PUT replacement endpoint; `patch` sends partial changes.

Zone DNS support also includes:

- `cloudflare_export_dns_records`
- `cloudflare_import_dns_records`
- `cloudflare_scan_dns_records`
- `cloudflare_review_dns_record_scan`
- `cloudflare_get_dns_settings`
- `cloudflare_update_dns_settings`

## Zones, Cache, And Settings

Use `cloudflare_create_zone`, `cloudflare_get_zone`, `cloudflare_edit_zone`, and `cloudflare_delete_zone` for zone lifecycle operations.

```js
var ssl = app.integrations.cloudflare.cloudflare_get_zone_setting({
  zone_id: "zone_123",
  setting_id: "ssl",
})

var purge = app.integrations.cloudflare.cloudflare_purge_cache({
  zone_id: "zone_123",
  files: [
    "https://www.example.com/app.css"
  ]
})
```
For settings with non-string payloads, pass `body` using Cloudflare's exact API schema.

## Rules

Legacy page-rule tools are still available:

- `cloudflare_list_page_rules`
- `cloudflare_create_page_rule`
- `cloudflare_update_page_rule`
- `cloudflare_delete_page_rule`

For modern Cloudflare Ruleset Engine workflows, use:

- `cloudflare_list_zone_rulesets`
- `cloudflare_get_zone_ruleset`
- `cloudflare_create_zone_ruleset`
- `cloudflare_update_zone_ruleset`
- `cloudflare_delete_zone_ruleset`
- `cloudflare_list_account_rulesets`

Ruleset bodies are passed using Cloudflare's documented `name`, `kind`, `phase`, `description`, and `rules` fields, or as a raw `body`.

## Workers KV

This package includes namespace and key-list management:

- `cloudflare_list_kv_namespaces`
- `cloudflare_create_kv_namespace`
- `cloudflare_delete_kv_namespace`
- `cloudflare_list_kv_keys`

Workers KV value read/write endpoints can return or require non-JSON payloads, so use the raw API helpers only when the host can handle the needed body and response format.

## Output Shape

Most first-class tools return Cloudflare's parsed API envelope with `success`, `result`, `errors`, and `messages`. Older compact tools such as `cloudflare_list_zones`, `cloudflare_list_dns_records`, and `cloudflare_get_analytics` preserve their normalized response shape for compatibility.
