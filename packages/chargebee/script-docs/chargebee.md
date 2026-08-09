# Chargebee JavaScript API Reference

Namespace: `app.integrations.chargebee`

Use this integration to inspect and manage Chargebee API v2 billing records. Configure a Chargebee API key and site name before use.

## Return Shape

Tools return the decoded Chargebee JSON response. List endpoints usually return a `list` array and may include `next_offset`. Retrieve and write endpoints return resource objects such as `customer`, `subscription`, `invoice`, `transaction`, `hosted_page`, `estimate`, or `event`.

## Common Parameters

Read tools commonly accept:

| Name | Type | Required | Description |
| --- | --- | --- | --- |
| `limit` | integer | no | Maximum records to return. |
| `offset` | string | no | Pagination offset from `next_offset`. |
| `id[is]` | string | no | Exact ID filter where supported. |
| `status[is]` | string | no | Exact status filter where supported. |
| `customer_id[is]` | string | no | Exact customer filter where supported. |
| `subscription_id[is]` | string | no | Exact subscription filter where supported. |
| `updated_at[after]` | integer | no | Unix timestamp filter. |
| `created_at[after]` | integer | no | Unix timestamp filter. |

## Resource Coverage

The namespace includes list/get/create/update/delete style tools for customers, items, item prices and coupons, plus read tools for subscriptions, invoices, credit notes, transactions, events, hosted pages, orders, business entities and attached items.

Important workflow tools include:

| Tool | Purpose |
| --- | --- |
| `create_subscription_for_items` | Create an item-price subscription. |
| `create_subscription_for_customer` | Create a subscription under an existing customer. |
| `update_subscription_for_items` | Update a Product Catalog 2.0 subscription. |
| `cancel_subscription_for_items` | Cancel a subscription. |
| `close_invoice` | Finalize a pending invoice. |
| `collect_invoice_payment` | Collect payment for an invoice. |
| `record_invoice_payment` | Record an offline invoice payment. |
| `create_invoice_for_charge_items_and_charges` | Create a non-recurring invoice. |
| `record_refund_for_transaction` | Record an offline refund. |
| `checkout_new_for_items` | Create a hosted checkout page for a new subscription. |
| `checkout_existing_for_items` | Create a hosted checkout page for an existing subscription. |
| `estimate_create_subscription_for_items` | Preview a subscription create operation. |
| `estimate_update_subscription_for_items` | Preview a subscription update operation. |

## Payload Tools

Chargebee write endpoints use form-encoded parameter names. Pass those exact names inside `payload`, including bracketed array keys from the API docs.

```js
var result = app.integrations.chargebee.create_subscription_for_customer({
  customer_id: "customer_123",
  payload: {
    ["subscription_items[item_price_id][0]"]: "basic-USD",
    ["subscription_items[quantity][0]"]: 3,
    invoice_immediately: true,
  }
})
```
```js
var page = app.integrations.chargebee.checkout_new_for_items({
  payload: {
    ["subscription_items[item_price_id][0]"]: "basic-USD",
    redirect_url: "https://example.test/billing/success",
    cancel_url: "https://example.test/billing/cancel",
  }
})
```
```js
var payment = app.integrations.chargebee.record_invoice_payment({
  id: "inv_123",
  payload: {
    ["transaction[payment_method]"]: "bank_transfer",
    ["transaction[amount]"]: 5000,
    comment: "Wire received",
  }
})
```
## Pagination

```js
var first = app.integrations.chargebee.list_customers({ limit: 50 })

if (first.next_offset) {
  var second = app.integrations.chargebee.list_customers({
    limit: 50,
    offset: first.next_offset,
  })
}
```
## Multi-Account Usage

```js
app.integrations.chargebee.list_subscriptions({ limit: 25 })
app.integrations.chargebee.default.list_subscriptions({ limit: 25 })
app.integrations.chargebee.production.list_subscriptions({ limit: 25 })
```
All account namespaces expose the same tools; only credentials differ.
