# GoCardless Integration

Use the `gocardless` integration to manage GoCardless payments, mandates, billing requests, customers, creditor bank accounts, subscriptions, instalment schedules, outbound payments, payouts, refunds, institutions, events, webhooks, and related actions.

All tools are generated from the official GoCardless OpenAPI document at `https://developer.gocardless.com/openapi-schema-public.json`. Configure a GoCardless access token; runtime calls send `Authorization: Bearer <access_token>` and `GoCardless-Version: 2015-07-06` by default.

## Common Tools

- `gocardless_list_payment`, `gocardless_create_payment`, `gocardless_get_payments`, `gocardless_update_payments`, `gocardless_cancel_payment`, and `gocardless_retry_payment` handle payment lifecycle operations.
- `gocardless_list_mandate`, `gocardless_create_mandate`, `gocardless_get_mandates`, `gocardless_update_mandates`, `gocardless_cancel_mandate`, and `gocardless_reinstate_mandate` manage mandates.
- `gocardless_list_billing_request`, `gocardless_create_billing_request`, and the `gocardless_*_billing_request` action tools manage billing request collection and fulfilment workflows.
- Customer, creditor, payout, refund, subscription, institution, event, export, webhook, and verification tools map directly to the official endpoints.

## Request Shape

Path and query parameters are exposed as snake_case tool parameters. JSON request bodies are passed through the `body` object and should match the official GoCardless schema for that endpoint. Write tools also accept `idempotency_key`, which is sent as the `Idempotency-Key` header for safe retries.

`gocardless_get_bank_account_details` also requires `gc_key_id`, which is sent as the `Gc-Key-Id` header for encrypted bank account detail access.

## Return Shape

JSON responses are returned as decoded arrays/objects from GoCardless. Empty successful responses return `{ success = true, status = <http_status> }`.

## Examples

```js
var payments = app.integrations.gocardless.list_payment({
  limit: 20,
  created_at_gte: "2026-01-01T00:00:00Z",
})

var payment = app.integrations.gocardless.create_payment({
  idempotency_key: "example-payment-key-001",
  body: {
    payments: {
      amount: 1299,
      currency: "GBP",
      links: { mandate: "MD000000000000" },
      metadata: { order_id: "example-order-001" },
    }
  }
})

var mandate = app.integrations.gocardless.get_mandates({ mandate_id: "MD000000000000" })
```
Use fake IDs and example metadata in tests and prompts. Do not place real customer names, bank details, mandate IDs, payment IDs, webhooks, emails, access tokens, or creditor data in fixtures or JavaScript examples.
