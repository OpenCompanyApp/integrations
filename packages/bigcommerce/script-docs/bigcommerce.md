# BigCommerce JavaScript Reference

Namespace: `app.integrations.bigcommerce`

BigCommerce tools use the Admin REST API. Configure `access_token` and `store_hash`; the service sends `X-Auth-Token` and builds `https://api.bigcommerce.com/stores/{store_hash}`. `base_url` is only needed for proxies or tests.

Most write tools accept a `payload` object containing the documented BigCommerce request body. Most list/read tools accept common parameters such as `limit`, `page`, and `include`, plus a `query` object for additional documented filters.

## Common Examples

```js
var products = app.integrations.bigcommerce.list_products({
  limit: 25,
  include: "variants,images",
  query: { ["is_visible"]: true },
})

var created = app.integrations.bigcommerce.create_product({
  payload: {
    name: "Example Widget",
    type: "physical",
    price: 29.99,
    weight: 1,
    categories: [ 1 ],
  }
})

var orders = app.integrations.bigcommerce.list_orders({
  status_id: 2,
  limit: 10,
})

var customer = app.integrations.bigcommerce.get_customer({
  customer_id: 123,
})
```
## Coverage Notes

- Catalog tools cover products and nested variants, images, custom fields, modifiers, options, videos, plus categories, brands, category trees, price lists, and price list records.
- Order tools cover v2 order CRUD plus order products, shipping addresses, coupons, shipments, and v3 transactions.
- Customer tools use v3 bulk-style endpoints. `get_customer` maps `customer_id` to BigCommerce `id:in`; delete tools map comma-separated IDs to `id:in`.
- Cart and checkout tools cover cart CRUD, checkout lookup/update, billing addresses, and checkout consignments.
- Store operations cover store info, storefront status, channels, sites, webhooks, content pages, widgets, widget templates, redirects, and regions.

## Multi-Account Usage

```js
app.integrations.bigcommerce.list_products({ limit: 10 })
app.integrations.bigcommerce.default.list_products({ limit: 10 })
app.integrations.bigcommerce.us_store.list_products({ limit: 10 })
```
All account namespaces expose the same tool names; only credentials differ.
