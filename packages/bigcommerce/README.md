# Integration: BigCommerce

> BigCommerce integration for OpenCompany agents - manage catalog, orders, customers, carts, checkouts, channels, sites, webhooks, and content through the BigCommerce Admin REST APIs.

## Configuration

Create a BigCommerce store API account and provide:

- `access_token` - the API access token used in the `X-Auth-Token` header.
- `store_hash` - the store hash used for `https://api.bigcommerce.com/stores/{store_hash}`.
- `base_url` - optional override for proxies or tests. Leave blank for normal BigCommerce stores.

The service normalizes base URLs that accidentally include `/v2` or `/v3`, then sends each tool to the documented endpoint version.

## Coverage

This package exposes 141 focused tools across:

- Catalog products, variants, images, custom fields, modifiers, options, videos, categories, brands, category trees, price lists, and price list records.
- Orders, order products, shipping addresses, coupons, transactions, and shipments.
- Customers, customer addresses, form field values, and customer groups.
- Carts, checkouts, billing addresses, and consignments.
- Store information, storefront status, channels, sites, webhooks, content pages, widgets, widget templates, redirects, and regions.

## Usage

```php
$provider = app(\OpenCompany\IntegrationCore\Support\ToolProviderRegistry::class)->get("bigcommerce");
$tool = $provider->createTool(\OpenCompany\Integrations\BigCommerce\Tools\BigCommerceListProducts::class);
$result = $tool->execute(["limit" => 25, "include" => "variants,images"]);
```

Write tools accept a `payload` object so agents can pass the documented BigCommerce request body without the integration hiding fields. Read tools accept common named filters plus a `query` object for less common documented query parameters.

## API Notes

BigCommerce Admin REST uses store-scoped URLs and the `X-Auth-Token` header. Some resources still live under `/v2` while newer catalog, customer, cart, channel, site, webhook, and content resources use `/v3`; this package preserves those endpoint versions per tool.

## License

MIT - see [LICENSE](LICENSE)
