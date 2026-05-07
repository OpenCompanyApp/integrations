# Modern Treasury Lua Docs

Modern Treasury tools are exposed under `app.integrations["modern-treasury"]`. This package is generated from Modern Treasury's official OpenAPI document and exposes all 177 operations found in that spec.

Configure `organization_id`, `api_key`, and optionally `url`. The default URL is `https://app.moderntreasury.com`.

Pass path, query, and header parameters as top-level snake_case arguments. Pass JSON request bodies under `body`. Header parameters such as `Idempotency-Key` are exposed as `idempotency_key`.

```lua
local accounts = app.integrations["modern-treasury"].modern_treasury_list_ledger_accounts({ per_page = 25 })
local account = app.integrations["modern-treasury"].modern_treasury_get_ledger_account({ id = "ledger_account_123" })
```

## Coverage Notes

The manifest `modern-treasury-openapi-manifest.json` records source URL, operation IDs, methods, paths, tool slugs, and classes.

## Representative Tools

- `modern_treasury_list_ledger_account_balance_monitors` - GET `/api/ledger_account_balance_monitors`
- `modern_treasury_create_ledger_account_balance_monitor` - POST `/api/ledger_account_balance_monitors`
- `modern_treasury_get_ledger_account_balance_monitor` - GET `/api/ledger_account_balance_monitors/{id}`
- `modern_treasury_update_ledger_account_balance_monitor` - PATCH `/api/ledger_account_balance_monitors/{id}`
- `modern_treasury_delete_ledger_account_balance_monitor` - DELETE `/api/ledger_account_balance_monitors/{id}`
- `modern_treasury_list_ledger_account_categories` - GET `/api/ledger_account_categories`
- `modern_treasury_create_ledger_account_category` - POST `/api/ledger_account_categories`
- `modern_treasury_get_ledger_account_category` - GET `/api/ledger_account_categories/{id}`
- `modern_treasury_update_ledger_account_category` - PATCH `/api/ledger_account_categories/{id}`
- `modern_treasury_delete_ledger_account_category` - DELETE `/api/ledger_account_categories/{id}`
- `modern_treasury_add_ledger_account_to_ledger_account_category` - PUT `/api/ledger_account_categories/{id}/ledger_accounts/{ledger_account_id}`
- `modern_treasury_remove_ledger_account_from_ledger_account_category` - DELETE `/api/ledger_account_categories/{id}/ledger_accounts/{ledger_account_id}`
- `modern_treasury_add_ledger_account_category_to_ledger_account_category` - PUT `/api/ledger_account_categories/{id}/ledger_account_categories/{sub_category_id}`
- `modern_treasury_delete_ledger_account_category_from_ledger_account_category` - DELETE `/api/ledger_account_categories/{id}/ledger_account_categories/{sub_category_id}`
- `modern_treasury_patch_ledger_account_settlement_entries` - PATCH `/api/ledger_account_settlements/{id}/ledger_entries`
- `modern_treasury_delete_ledger_account_settlement_entries` - DELETE `/api/ledger_account_settlements/{id}/ledger_entries`
- `modern_treasury_create_ledger_account_settlement` - POST `/api/ledger_account_settlements`
- `modern_treasury_list_ledger_account_settlements` - GET `/api/ledger_account_settlements`
