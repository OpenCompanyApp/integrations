# Brex JavaScript Docs

Brex tools are exposed under `app.integrations.brex`. This package combines 10 official Brex OpenAPI descriptions and exposes all 108 operations found in those specs.

Configure `access_token` and optionally `url`. The default URL is `https://api.brex.com`.

Pass path, query, and header parameters as top-level snake_case arguments. Pass JSON request bodies under `body`. Header parameters such as `Idempotency-Key` are exposed as `idempotency_key`.

```js
var cards = app.integrations.brex.brex_team_list_cards_by_user_id({ user_id: "user_123", limit: 20 })
var created = app.integrations.brex.brex_team_create_card({ idempotency_key: "example-key", body: { user_id: "user_123" } })
```
## Coverage Notes

The manifest `brex-openapi-manifest.json` records source URLs, API groups, operation IDs, methods, paths, tool slugs, and classes.

## Representative Tools

- `brex_accounting_create_integration` - POST `/v3/accounting/integration`
- `brex_accounting_disconnect_integration` - POST `/v3/accounting/integration/{integration_id}/disconnect`
- `brex_accounting_reactivate_integration` - POST `/v3/accounting/integration/{integration_id}/reactivate`
- `brex_accounting_get_accounting_record` - GET `/v3/accounting/records/{record_id}`
- `brex_accounting_query_accounting_records` - GET `/v3/accounting/records`
- `brex_accounting_report_accounting_export_results` - POST `/v3/accounting/records/export-results`
- `brex_budgets_list_budget_programs` - GET `/v1/budget_programs`
- `brex_budgets_get_budget_program_by_id` - GET `/v1/budget_programs/{id}`
- `brex_budgets_list_budgets` - GET `/v1/budgets`
- `brex_budgets_create_budget` - POST `/v1/budgets`
- `brex_budgets_get_budget_by_id` - GET `/v1/budgets/{id}`
- `brex_budgets_update_budget` - PUT `/v1/budgets/{id}`
- `brex_budgets_archive_budget` - POST `/v1/budgets/{id}/archive`
- `brex_budgets_list_spend_budgets` - GET `/v2/budgets`
- `brex_budgets_create_spend_budget` - POST `/v2/budgets`
- `brex_budgets_get_spend_budget_by_id` - GET `/v2/budgets/{id}`
- `brex_budgets_update_spend_budget` - PUT `/v2/budgets/{id}`
- `brex_budgets_archive_spend_budget` - POST `/v2/budgets/{id}/archive`
