# Mindee Integration

Mindee document OCR and data extraction tools for OpenCompany and KosmoKrator
agents.

This package targets Mindee's documented v1 REST API shape:

- `Authorization: Token <api-key>`
- `POST /products/{account}/{api_name}/{api_version}/predict`
- `POST /products/{account}/{api_name}/{api_version}/predict_async`
- `GET /products/{account}/{api_name}/{api_version}/documents/queue/{job_id}`

## Tools

| Tool | Type | Notes |
|------|------|-------|
| `mindee_predict_document` | write | Generic synchronous prediction for any Mindee product or custom model. |
| `mindee_predict_document_async` | write | Generic asynchronous prediction enqueue. |
| `mindee_get_async_prediction` | read | Poll asynchronous job status or receive completed redirect metadata. |
| `mindee_parse_invoice` | write | Convenience wrapper for `mindee/invoices/v4`. |
| `mindee_parse_receipt` | write | Convenience wrapper for `mindee/expense_receipts/v5`. |
| `mindee_parse_passport` | write | Convenience wrapper for `mindee/passport/v1`. |
| `mindee_parse_custom` | write | Convenience wrapper for an `account/api_name/api_version` endpoint ID. |

## Configuration

```php
return [
    'mindee' => [
        'api_key' => env('MINDEE_API_KEY'),
        'url' => env('MINDEE_URL', 'https://api.mindee.net/v1'),
    ],
];
```

## Document Input

Prediction tools accept a local file path, a URL, or a base64-encoded document
string in the `document` parameter. Local files are sent as multipart
`document` uploads. URL and base64 inputs are sent as JSON with a `document`
field.

Use the generic tools for additional off-the-shelf APIs or custom APIs:

```php
$service->predictProduct(
    account: 'mindee',
    apiName: 'expense_receipts',
    apiVersion: 'v5',
    document: '/tmp/receipt.jpg',
);
```

For custom APIs, pass endpoint IDs as `account/api_name/api_version`:

```php
$service->parseCustom('acme/purchase_orders/v1', '/tmp/po.pdf');
```

## Notes

Mindee's documented API is prediction-oriented, so connection testing verifies
that required setup values are present without calling an unrelated account
endpoint. Run a prediction tool with a safe sample document for a live API check.
