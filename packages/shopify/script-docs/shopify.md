# Shopify JavaScript Reference

Namespace: `app.integrations.shopify`

Shopify tools use the Admin REST API. Configure `access_token` and `shop_domain`; the service sends `X-Shopify-Access-Token` to `https://{shop_domain}/admin/api/{api_version}`. `base_url` is only for proxies or tests.

Most write tools accept a `payload` object containing the documented Shopify REST request body, including the expected root resource key when Shopify requires one, such as `{ product = {...} }`. Read tools accept common filters plus `query` for additional documented parameters.

## Examples

```js
var products = app.integrations.shopify.list_products({
  limit: 25,
  status: "active",
  query: { fields: "id,title,status" },
})

var product = app.integrations.shopify.create_product({
  payload: {
    product: {
      title: "Example Widget",
      status: "draft",
    }
  }
})

var orders = app.integrations.shopify.list_orders({
  status: "open",
  financial_status: "paid",
  limit: 10,
})

var refund_preview = app.integrations.shopify.calculate_order_refund({
  order_id: "1234567890",
  payload: { refund: { shipping: { full_refund: true } } },
})
```
## Coverage Notes

- Named tools cover shop metadata, products, product variants/images/metafields, orders, order transactions/refunds/fulfillments/risks/actions, fulfillment orders, customers, addresses, collections, collects, price rules, discount codes, inventory items/levels, fulfillment services, locations, webhooks, themes/assets, pages, blogs/articles, script tags, and shop metafields.
- `api_get`, `api_post`, `api_put`, and `api_delete` can call any Admin REST path such as `/products/count.json` or `/orders/{id}/events.json` when a less common endpoint is needed.
- Shopify REST responses are returned as decoded JSON exactly as Shopify sends them, usually with a root key such as `products`, `product`, `orders`, or `shop`.

## Multi-Account Usage

```js
app.integrations.shopify.list_products({ limit: 10 })
app.integrations.shopify.default.list_products({ limit: 10 })
app.integrations.shopify.us_store.list_products({ limit: 10 })
```