# ChartMogul

ChartMogul tools query subscription analytics data through the ChartMogul API.

## Namespace

`chartmogul`

## Authentication

ChartMogul uses HTTP Basic Auth. Configure `api_key`; the integration sends it
as the Basic Auth username with an empty password, matching ChartMogul's current
API-key documentation.

## Available Tools

- `chartmogul_list_customers` - List customers with cursor pagination and filters.
- `chartmogul_get_customer` - Retrieve one customer by ChartMogul customer UUID.
- `chartmogul_list_subscriptions` - List subscriptions for a required `customer_uuid`.
- `chartmogul_list_plans` - List billing plans with cursor pagination.
- `chartmogul_list_invoices` - List API-created invoices with customer or external-ID filters.
- `chartmogul_get_metrics` - Retrieve all key metrics for a date range.
- `chartmogul_get_current_user` - Backward-compatible tool name that calls `/v1/ping` and returns pong data. ChartMogul's public API does not expose a user-profile endpoint for this package.

## Pagination

List endpoints use ChartMogul cursor pagination:

- Pass `per_page` to control page size, up to 200.
- If a response has `has_more = true`, pass the returned `cursor` into the next
  request.
- Deprecated response fields such as `page` and `current_page` may appear, but
  new calls should use `cursor`.

## Examples

```lua
local customers = chartmogul.chartmogul_list_customers({
  per_page = 50,
  status = "Active",
  system = "Stripe"
})
```

```lua
local subscriptions = chartmogul.chartmogul_list_subscriptions({
  customer_uuid = "cus_de305d54-75b4-431b-adb2-eb6b9e546012",
  per_page = 100
})
```

```lua
local invoices = chartmogul.chartmogul_list_invoices({
  customer_uuid = "cus_de305d54-75b4-431b-adb2-eb6b9e546012",
  external_id = "inv_0001"
})
```

```lua
local metrics = chartmogul.chartmogul_get_metrics({
  start_date = "2026-01-01",
  end_date = "2026-03-31",
  interval = "month",
  geo = "US,GB",
  plans = "Gold Monthly"
})
```

Responses are returned in ChartMogul's upstream JSON shape.
