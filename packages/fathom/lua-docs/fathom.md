# Fathom Analytics - Lua API Reference

Namespace: `app.integrations.fathom`

Use this integration to manage Fathom sites, events, milestones, account details, aggregation reports, and current visitor counts. The integration follows the documented Fathom API v1 paths and returns the API's JSON response objects with only request parameter normalization applied.

## Account

### get_account

Get the authenticated Fathom account profile from `/account`.

```lua
local account = app.integrations.fathom.get_account({})
print(account.name .. " <" .. account.email .. ">")
```

### get_current_user

Backward-compatible alias for account profile lookup. It also calls `/account`; prefer `get_account` in new workflows.

## Sites

### list_sites

List sites in cursor order.

Parameters:

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of sites, clamped to 1-100. Default: 10. |
| `starting_after` | string | no | Cursor object ID for forward pagination. |
| `ending_before` | string | no | Cursor object ID for reverse pagination. |

```lua
local result = app.integrations.fathom.list_sites({limit = 10})

for _, site in ipairs(result.data or {}) do
  print(site.id .. ": " .. site.name)
end
```

### get_site

Parameters:

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | Fathom site ID, such as `ABCDEF`. |

### create_site / update_site

`create_site` requires `name`. `update_site` requires `site_id` and accepts the same editable site settings.

Parameters:

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | update only | Fathom site ID. |
| `name` | string | create yes, update no | Site display name. |
| `sharing` | string | no | `none`, `private`, or `public`. |
| `share_password` | string | no | Required by Fathom when sharing is private. |

```lua
local site = app.integrations.fathom.create_site({
  name = "Example Site",
  sharing = "none"
})
```

### wipe_site / delete_site

Both require `site_id`. `wipe_site` deletes analytics data but keeps the site; `delete_site` removes the site.

## Events

Events are scoped to a site and use Fathom's nested `/sites/{site_id}/events` endpoints.

### list_events

Parameters:

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | Fathom site ID. |
| `limit` | integer | no | Number of events, clamped to 1-100. |
| `starting_after` | string | no | Cursor object ID for forward pagination. |
| `ending_before` | string | no | Cursor object ID for reverse pagination. |

### get_event / create_event / update_event / wipe_event / delete_event

`get_event`, `update_event`, `wipe_event`, and `delete_event` require `site_id` and `event_id`. `create_event` requires `site_id` and `name`.

```lua
local event = app.integrations.fathom.create_event({
  site_id = "ABCDEF",
  name = "Signup"
})
```

## Milestones

Milestones are site-scoped annotations. The integration exposes list, get, create, update, and delete.

Common parameters:

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | Fathom site ID. |
| `milestone_id` | string | get/update/delete | Fathom milestone ID. |
| `name` | string | create yes, update no | Milestone name. |
| `milestone_date` | string | create yes, update optional | Milestone date in `YYYY-MM-DD` format. |

```lua
local milestone = app.integrations.fathom.create_milestone({
  site_id = "ABCDEF",
  name = "Launch day",
  milestone_date = "2026-01-15"
})
```

## Reports

### get_aggregate

Generate an aggregation report using `/aggregations`. This helper defaults to `entity = "pageview"` and sends the provided `site_id` as `entity_id`.

Parameters:

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | Fathom site ID used as `entity_id`. |
| `date_from` | string | no | Start date or timestamp. |
| `date_to` | string | no | End date or timestamp. |
| `metrics` | string | no | Comma-separated Fathom aggregate names. Default: `pageviews,visits,uniques,bounce_rate`. |
| `group_by` | string | no | Sent as Fathom `field_grouping`, such as `pathname` or `country_code`. |
| `sort_by` | string | no | Sort expression accepted by Fathom. |
| `limit` | integer | no | Maximum grouped rows. |
| `date_grouping` | string | no | Date grouping accepted by Fathom, such as `day` or `month`. |
| `timezone` | string | no | IANA timezone for date grouping. |
| `filters` | string | no | JSON encoded Fathom filter array. |

```lua
local top_pages = app.integrations.fathom.get_aggregate({
  site_id = "ABCDEF",
  date_from = "2026-01-01",
  date_to = "2026-01-31",
  metrics = "pageviews,visits,uniques",
  group_by = "pathname",
  sort_by = "pageviews:desc",
  limit = 10
})
```

### get_current_visitors

Get current visitor counts for a site from `/current_visitors`.

Parameters:

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | Fathom site ID. |
| `detailed` | boolean | no | Include detailed current visitor breakdown when supported. |

```lua
local current = app.integrations.fathom.get_current_visitors({
  site_id = "ABCDEF",
  detailed = true
})
```

## Multi-Account Usage

If you have multiple Fathom accounts configured, use account-specific namespaces:

```lua
app.integrations.fathom.list_sites({})
app.integrations.fathom.default.list_sites({})
app.integrations.fathom.work.list_sites({})
```

The functions are identical across accounts; only credentials differ.
