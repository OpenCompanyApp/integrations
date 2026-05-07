# Ramp Lua Docs

Ramp tools are exposed under `app.integrations.ramp`. This package is generated from Ramp's official Developer API OpenAPI document and exposes all 228 operations found in that spec.

Configure `access_token` and optionally `url`. The default URL is `https://api.ramp.com`.

Pass path and query parameters as top-level snake_case arguments. Pass JSON request bodies under `body`.

```lua
local cards = app.integrations.ramp.ramp_get_card_list_resource({ limit = 25 })
local account = app.integrations.ramp.ramp_get_gl_account_resource({ gl_account_id = "acct_123" })
```

## Coverage Notes

The manifest `ramp-openapi-manifest.json` records source URL, operation IDs, methods, paths, tool slugs, and classes.

## Representative Tools

- `ramp_get_gl_account_list_resource` - GET `/developer/v1/accounting/accounts`
- `ramp_post_gl_account_list_resource` - POST `/developer/v1/accounting/accounts`
- `ramp_delete_gl_account_resource` - DELETE `/developer/v1/accounting/accounts/{gl_account_id}`
- `ramp_get_gl_account_resource` - GET `/developer/v1/accounting/accounts/{gl_account_id}`
- `ramp_patch_gl_account_resource` - PATCH `/developer/v1/accounting/accounts/{gl_account_id}`
- `ramp_get_accounting_all_connections_resource` - GET `/developer/v1/accounting/all-connections`
- `ramp_delete_accounting_connection_resource` - DELETE `/developer/v1/accounting/connection`
- `ramp_get_accounting_current_connection_resource_deprecated` - GET `/developer/v1/accounting/connection`
- `ramp_post_accounting_connection_resource` - POST `/developer/v1/accounting/connection`
- `ramp_get_accounting_connection_detail_resource` - GET `/developer/v1/accounting/connection/{connection_id}`
- `ramp_patch_accounting_connection_detail_resource` - PATCH `/developer/v1/accounting/connection/{connection_id}`
- `ramp_post_reactivate_connection_resource` - POST `/developer/v1/accounting/connection/{connection_id}/reactivate`
- `ramp_get_custom_field_option_list_resource` - GET `/developer/v1/accounting/field-options`
- `ramp_post_custom_field_option_list_resource` - POST `/developer/v1/accounting/field-options`
- `ramp_delete_custom_field_option_resource` - DELETE `/developer/v1/accounting/field-options/{field_option_id}`
- `ramp_get_custom_field_option_resource` - GET `/developer/v1/accounting/field-options/{field_option_id}`
- `ramp_patch_custom_field_option_resource` - PATCH `/developer/v1/accounting/field-options/{field_option_id}`
- `ramp_put_custom_field_option_resource` - PUT `/developer/v1/accounting/field-options/{field_option_id}`
