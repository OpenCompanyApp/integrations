# Checkout.com Integration

Use the `checkout-com` integration to manage Checkout.com payments, payouts, payment sessions, hosted payments, payment links, disputes, issuing cards and controls, platform entities, workflows, balances, transfers, reports, files, and authentication token requests.

All endpoint tools are generated from the official Checkout.com OpenAPI document at `https://api-reference.checkout.com/v1/swagger.json`. Configure a Checkout.com key or access token; authenticated runtime calls send `Authorization: Bearer <value>`. Checkout.com base URLs are unique per account, so set `url` and `access_url` to the sandbox or production URLs shown in your Checkout.com dashboard.

## Common Tools

- `checkout_com_request_a_payment_or_payout`, `checkout_com_get_payments_list`, `checkout_com_get_payment_details`, `checkout_com_capture_a_payment`, `checkout_com_refund_a_payment`, `checkout_com_cancel_a_payment`, and `checkout_com_void_a_payment` cover payment lifecycle operations.
- `checkout_com_create_payment_session`, `checkout_com_submit_payment_session`, and `checkout_com_create_and_submit_payment_session` cover payment sessions.
- Platform entity, payment instrument, dispute, issuing card, control, transfer, workflow, balance, report, file, and identity-verification tools map directly to the official API reference.
- `checkout_com_request_an_access_token` uses `access_url` and form-encoded `body` fields such as `grant_type`, `client_id`, `client_secret`, and `scope`.

## Request Shape

Path, query, and header parameters are exposed as snake_case tool parameters. JSON, form-encoded, and multipart request bodies are passed through the `body` object and should match the official Checkout.com schema for the endpoint. Header parameters such as `cko_idempotency_key` are mapped to their documented names.

## Return Shape

JSON responses are returned as decoded arrays/objects from Checkout.com. Empty successful responses return `{ success = true, status = <http_status> }`.

## Examples

```js
var methods = app.integrations["checkout-com"].get_payment_methods({})

var payment = app.integrations["checkout-com"].request_a_payment_or_payout({
  cko_idempotency_key: "example-payment-key-001",
  body: {
    source: { type: "token", token: "tok_example" },
    amount: 1299,
    currency: "USD",
    reference: "example-order-001",
  }
})

var token = app.integrations["checkout-com"].request_an_access_token({
  body: {
    grant_type: "client_credentials",
    client_id: "ack_example",
    client_secret: "example-secret",
    scope: "gateway",
  }
})
```
Use fake IDs, tokens, customers, disputes, cardholders, and metadata in tests and prompts. Never place real card data, customer data, payment IDs, account prefixes, API keys, access tokens, or files in fixtures or JavaScript examples.
