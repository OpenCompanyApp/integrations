# Integration: Gumroad

> Gumroad API v2 integration for OpenCompany agents - manage products, sales, subscribers, offer codes, license keys, and resource subscription webhooks.

## Configuration

Provide a Gumroad OAuth `access_token`. The default API base URL is `https://api.gumroad.com/v2`; `url` is only needed for tests or proxies.

## Coverage

This package exposes 27 focused tools across:

- Products, product custom fields, product variants, product offer codes, and product subscribers.
- Sales, sale lookup, shipping marking, and refunds.
- Subscribers and account-level offers.
- License verification and license enable, disable, and use-count adjustment.
- Resource subscription webhooks.
- Raw `api_get`, `api_post`, `api_put`, and `api_delete` escape hatches for less common v2 endpoints.

Write tools accept `payload` where Gumroad supports additional body fields.

## License

MIT - see [LICENSE](LICENSE)
