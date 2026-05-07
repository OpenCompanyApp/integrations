# Chargify / Maxio Advanced Billing

Chargify is now Maxio Advanced Billing. These tools call the Advanced Billing
REST API for subscription billing, customers, products, invoices, and site
metadata.

## Namespace

`chargify`

## Authentication

The API uses HTTP Basic Auth. Configure:

- `api_key` - API key used as the Basic Auth username.
- `api_password` - Basic Auth password. Most legacy API-key credentials use
  `x`; leave this unset unless your site has a specific password.
- `subdomain` or `url` - either the site subdomain for
  `https://{subdomain}.chargify.com`, or a full custom base URL.

## Available Tools

- `chargify_list_subscriptions` - List subscriptions with `page`, `per_page`, and optional `state`.
- `chargify_get_subscription` - Get a subscription by `subscription_id`.
- `chargify_list_customers` - List customers with pagination.
- `chargify_get_customer` - Get a customer by `customer_id`.
- `chargify_list_products` - List products with pagination.
- `chargify_list_invoices` - List invoices with optional `status`.
- `chargify_get_invoice` - Get one invoice by UID, number, or ID.
- `chargify_get_current_user` - Reads `/site.json` as a lightweight authenticated site check. Advanced Billing does not rely on an agent-facing `/users/me` endpoint for this package.

## Examples

```lua
local subscriptions = chargify.chargify_list_subscriptions({
  page = 1,
  per_page = 50,
  state = "active"
})
```

```lua
local invoice = chargify.chargify_get_invoice({
  invoice_id = "inv_123"
})
```

```lua
local site = chargify.chargify_get_current_user({})
```

Responses are returned in the upstream Advanced Billing JSON shape, usually
wrapping records under keys such as `subscription`, `customer`, `product`,
`invoice`, or `site`.
