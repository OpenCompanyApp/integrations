# Gumroad JavaScript Reference

Namespace: `app.integrations.gumroad`

Gumroad tools use API v2 with OAuth bearer-token authentication. Configure `access_token`; leave `url` as `https://api.gumroad.com/v2` unless using a mock server.

## Examples

```js
var products = app.integrations.gumroad.list_products({})

var sales = app.integrations.gumroad.list_sales({
  product_id: "prod_123",
  after: "2026-01-01T00:00:00Z",
})

var verified = app.integrations.gumroad.verify_license({
  product_permalink: "my-product",
  license_key: "AAAA-BBBB-CCCC",
  increment_uses_count: true,
})

var webhook = app.integrations.gumroad.create_resource_subscription({
  resource_name: "sale",
  post_url: "https://example.test/gumroad/webhook",
})
```
## Coverage Notes

- Product tools cover list/get plus custom fields, variants, offer codes, and product subscribers.
- Sales tools cover list/get, refund, and mark-as-shipped actions.
- License tools cover verify, enable, disable, and decrement uses count.
- Resource subscription tools cover webhook list/create/delete for sale, refund, cancellation, dispute, and subscription events.
- Raw `api_get`, `api_post`, `api_put`, and `api_delete` accept a v2 path such as `/sales/{id}` when a niche endpoint is needed.

Responses are decoded Gumroad JSON exactly as returned by the API.
