# Invoice Ninja Lua API Reference

Namespace: `app.integrations.invoiceninja`

Use this integration to inspect and manage Invoice Ninja v5 business records. The API token must be configured for the target Invoice Ninja account or self-hosted instance.

## Return Shape

Tools return the parsed Invoice Ninja JSON response. Most successful resource calls return a top-level `data` object or `data` array. Paginated list endpoints may include pagination metadata from Invoice Ninja. Binary endpoints such as PDF downloads are intentionally not exposed here because agent tools expect JSON-shaped results.

## Common List Parameters

Most list tools accept:

| Name | Type | Required | Notes |
| --- | --- | --- | --- |
| `per_page` | integer | no | Number of records per page. Invoice Ninja defaults to 20. |
| `page` | integer | no | Page number. |
| `sort` | string | no | Sort expression such as `name|desc`. |
| `include` | string | no | Comma-separated relations to include. |
| `search` | string | no | Search text or endpoint-supported filter. |
| `client_id` | string | no | Filter by client where supported. |
| `vendor_id` | string | no | Filter by vendor where supported. |
| `project_id` | string | no | Filter by project where supported. |

Invoice Ninja supports rich query filters such as `balance=gt:1000` on some endpoints. If a filter is not listed as a first-class parameter, use the closest specific tool only when the endpoint supports it in Invoice Ninja.

## Core Tools

The namespace exposes list/get/create/update/delete/blank/bulk tools for these resources:

| Resource | Tool prefix |
| --- | --- |
| Clients | `client`, `clients` |
| Invoices | `invoice`, `invoices` |
| Products | `product`, `products` |
| Payments | `payment`, `payments` |
| Quotes | `quote`, `quotes` |
| Credits | `credit`, `credits` |
| Projects | `project`, `projects` |
| Tasks | `task`, `tasks` |
| Vendors | `vendor`, `vendors` |
| Expenses | `expense`, `expenses` |
| Recurring invoices | `recurring_invoice`, `recurring_invoices` |
| Purchase orders | `purchase_order`, `purchase_orders` |
| Tax rates | `tax_rate`, `tax_rates` |

Examples:

```lua
local clients = app.integrations.invoiceninja.list_clients({
  per_page = 25,
  sort = "name|desc"
})

local quote = app.integrations.invoiceninja.create_quote({
  payload = {
    client_id = "client_123",
    line_items = {
      { product_key = "consulting", notes = "Planning call", quantity = 1, cost = 250 }
    }
  }
})

local task = app.integrations.invoiceninja.update_task({
  id = "task_123",
  payload = {
    description = "Follow up with client",
    project_id = "project_123"
  }
})
```

## Payload Tools

Generated create, update and bulk tools use a `payload` object. The payload is sent as the JSON body to the corresponding Invoice Ninja endpoint. Use Invoice Ninja field names exactly, for example `client_id`, `line_items`, `contacts`, `amount`, `due_date`, or `action`.

Client create/update calls require child contacts when contact data changes; Invoice Ninja does not modify client contacts in isolation.

Bulk tools expect the action payload shape supported by Invoice Ninja for that resource:

```lua
app.integrations.invoiceninja.bulk_invoices({
  payload = {
    action = "archive",
    ids = { "invoice_123" }
  }
})
```

## Payments

Payment tools include `list_payments`, `get_payment`, `create_payment`, `update_payment`, `delete_payment`, `refund_payment`, `blank_payment`, and `bulk_payments`.

```lua
local result = app.integrations.invoiceninja.refund_payment({
  id = "payment_123",
  payload = {
    amount = 25.00,
    reason = "Duplicate charge"
  }
})
```

## Reference And Health

Use these read tools for setup and lookup flows:

| Tool | Purpose |
| --- | --- |
| `get_current_user` | Verify the configured token and current user. |
| `list_users` / `get_user` | Inspect Invoice Ninja users. |
| `list_activities` / `get_activity` | Inspect activity feed entries. |
| `statics` | Fetch static selector data. |
| `ping` | Lightweight API ping. |
| `health_check` | Health-check endpoint for compatible hosts. |

## Multi-Account Usage

```lua
app.integrations.invoiceninja.list_invoices({ per_page = 20 })
app.integrations.invoiceninja.default.list_invoices({ per_page = 20 })
app.integrations.invoiceninja.production.list_invoices({ per_page = 20 })
```

All account namespaces expose the same tools; only credentials and base URL differ.
