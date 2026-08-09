# Lemon Squeezy JavaScript API Reference

Namespace: `app.integrations.lemon-squeezy`

The Lemon Squeezy API uses JSON:API. Create and update tools accept `attributes` and optional `relationships`, then wrap them in a `data` object with the correct resource type.

## Catalog And Commerce

```js
var stores = app.integrations["lemon-squeezy"].list_stores({})
var products = app.integrations["lemon-squeezy"].list_products({ page_size: 50 })
var variants = app.integrations["lemon-squeezy"].list_variants({
  params: { ["filter[product_id]"]: "123" },
})
```
## Customers, Orders, And Subscriptions

```js
var orders = app.integrations["lemon-squeezy"].list_orders({
  page_size: 25,
  page: 1,
})

app.integrations["lemon-squeezy"].update_subscription({
  id: "456",
  attributes: { cancelled: true },
})
```
## Discounts, Licenses, Checkouts, And Webhooks

```js
app.integrations["lemon-squeezy"].create_checkout({
  attributes: {
    custom_price: 1200,
  },
  relationships: {
    store: { data: { type: "stores", id: "1" } },
    variant: { data: { type: "variants", id: "10" } },
  }
})

var licenses = app.integrations["lemon-squeezy"].list_license_keys({})
var webhooks = app.integrations["lemon-squeezy"].list_webhooks({})
```
## Raw API Helpers

Use `api_get`, `api_post`, `api_patch`, and `api_delete` for safe relative API paths. Full URLs and parent-directory paths are rejected.

```js
var response = app.integrations["lemon-squeezy"].api_get({
  path: "/v1/orders",
  query: { ["filter[store_id]"]: "1" },
})
```