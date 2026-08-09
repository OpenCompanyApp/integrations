# Plaid JavaScript Docs

Plaid tools are exposed under `app.integrations.plaid`. This package is generated from Plaid's official OpenAPI document for API version `2020-09-14` and exposes all 330 operations found in that spec.

## Authentication

Configure `client_id`, `secret`, `plaid_version`, and `url`. Use `https://sandbox.plaid.com` for sandbox, `https://development.plaid.com` for development, and `https://production.plaid.com` for production.

The integration sends `PLAID-CLIENT-ID`, `PLAID-SECRET`, and `Plaid-Version` headers. Do not include credentials in tool bodies.

## Usage Pattern

Most Plaid endpoints are JSON `POST` calls. Pass the official request schema under `body`:

```js
var result = app.integrations.plaid.plaid_transactions_get({
  body: {
    access_token: "access-sandbox-example",
    start_date: "2026-01-01",
    end_date: "2026-01-31",
  }
})
```
For path-based FDX endpoints, pass path parameters as top-level arguments:

```js
var result = app.integrations.plaid.plaid_get_recipient({
  recipientId: "recipient-example",
})
```
Binary endpoints such as PDF report downloads return `{ body, status }` when Plaid returns non-JSON content. Agents should write `body` to a file only when the host workflow explicitly needs an artifact.

## Coverage Notes

The manifest file `plaid-openapi-manifest.json` records the OpenAPI source, API version, operation count, tool slug, class, method, and path for every generated operation. JavaScript examples should follow Plaid's official request schemas because this integration intentionally does not flatten all product-specific request bodies into top-level arguments.

## Representative Tools

- `plaid_asset_report_create` - POST `/asset_report/create`
- `plaid_asset_report_get` - POST `/asset_report/get`
- `plaid_asset_report_pdf_get` - POST `/asset_report/pdf/get`
- `plaid_asset_report_refresh` - POST `/asset_report/refresh`
- `plaid_asset_report_filter` - POST `/asset_report/filter`
- `plaid_asset_report_remove` - POST `/asset_report/remove`
- `plaid_asset_report_audit_copy_create` - POST `/asset_report/audit_copy/create`
- `plaid_asset_report_audit_copy_get` - POST `/asset_report/audit_copy/get`
- `plaid_asset_report_audit_copy_pdf_get` - POST `/asset_report/audit_copy/pdf/get`
- `plaid_asset_report_audit_copy_remove` - POST `/asset_report/audit_copy/remove`
- `plaid_cra_monitoring_insights_subscribe` - POST `/cra/monitoring_insights/subscribe`
- `plaid_cra_monitoring_insights_unsubscribe` - POST `/cra/monitoring_insights/unsubscribe`
- `plaid_cra_monitoring_insights_get` - POST `/cra/monitoring_insights/get`
- `plaid_credit_audit_copy_token_update` - POST `/credit/audit_copy_token/update`
- `plaid_cra_partner_insights_get` - POST `/cra/partner_insights/get`
- `plaid_cra_check_report_income_insights_get` - POST `/cra/check_report/income_insights/get`
- `plaid_cra_check_report_base_report_get` - POST `/cra/check_report/base_report/get`
- `plaid_cra_check_report_pdf_get` - POST `/cra/check_report/pdf/get`
- `plaid_cra_check_report_create` - POST `/cra/check_report/create`
- `plaid_cra_check_report_partner_insights_get` - POST `/cra/check_report/partner_insights/get`
