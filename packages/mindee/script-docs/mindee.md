# Mindee JavaScript Reference

Namespace: `mindee`

Mindee tools return the raw Mindee JSON response. Prediction data is normally
under `document.inference.prediction`; asynchronous enqueue responses include a
`job` object.

## Generic Prediction

Use generic prediction for any off-the-shelf or custom Mindee API.

```js
var result = app.integrations.mindee.predict_document({
  account: "mindee",
  api_name: "expense_receipts",
  api_version: "v5",
  document: "/tmp/receipt.jpg",
})
```
Parameters:

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `account` | string | yes | Account name. Use `mindee` for off-the-shelf APIs. |
| `api_name` | string | yes | API name such as `invoices` or `expense_receipts`. |
| `api_version` | string | yes | API version such as `v4`, `v5`, or `v1`. |
| `document` | string | yes | File path, URL, or base64 document content. |
| `file_name` | string | no | Filename for multipart or base64 uploads. |
| `options` | object | no | Additional endpoint query parameters. |

## Async Prediction

```js
var queued = app.integrations.mindee.predict_document_async({
  account: "mindee",
  api_name: "invoices",
  api_version: "v4",
  document: "/tmp/invoice.pdf",
})

var status = app.integrations.mindee.get_async_prediction({
  account: "mindee",
  api_name: "invoices",
  api_version: "v4",
  job_id: queued.job.id,
})
```
When a job is complete, Mindee may return a redirect to the completed document.
The tool reports redirect responses as `{ status = 302, location = "..." }`.

## Convenience Tools

```js
var invoice = app.integrations.mindee.parse_invoice({
  document: "/tmp/invoice.pdf",
})

var receipt = app.integrations.mindee.parse_receipt({
  document: "/tmp/receipt.jpg",
})

var passport = app.integrations.mindee.parse_passport({
  document: "/tmp/passport.png",
})

var custom = app.integrations.mindee.parse_custom({
  endpoint_id: "acme/purchase_orders/v1",
  document: "/tmp/purchase_order.pdf",
})
```
Convenience tools accept `document`, optional `file_name`, and optional
`options`.

## Input Notes

Local file paths are sent as multipart `document` uploads. URL and base64 inputs
are sent as JSON with a `document` field. Use fake or non-sensitive documents in
tests and examples.

## Multi-Account Usage

```js
app.integrations.mindee.default.parse_receipt({ document: "/tmp/receipt.jpg" })
app.integrations.mindee.production.predict_document({
  account: "mindee",
  api_name: "invoices",
  api_version: "v4",
  document: "/tmp/invoice.pdf",
})
```