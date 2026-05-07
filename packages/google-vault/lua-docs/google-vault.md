# Google Vault

Google Vault tools are exposed under `app.integrations.google_vault`. This package is generated from Google's official Vault v1 Discovery document and exposes 33 REST methods.

Use it for compliance and eDiscovery workflows: matters, permissions, account counts, holds, held accounts, saved queries, exports, and long-running operations.

Each method-specific tool accepts Discovery path parameters as top-level arguments, known query parameters as top-level shortcuts or inside `query`, and request resources inside `body`. Resource path parameters preserve `/`, so pass full operation names like `operations/example` when using operation tools.

## Examples

```lua
local matters = app.integrations.google_vault.google_vault_matters_list({
  pageSize = 10,
  view = "BASIC"
})

local matter = app.integrations.google_vault.google_vault_matters_create({
  body = {
    name = "Example matter",
    description = "Created by an agent"
  }
})

local exports = app.integrations.google_vault.google_vault_matters_exports_list({
  matterId = "matter-123",
  pageSize = 10
})
```

Returned data is the parsed JSON response from the Vault API. Empty successful responses return `{ success = true, status = <http_status> }`.

Vault access is privilege-gated. The OAuth token must have Vault scopes, and the account must have the required Vault privileges and access to the target matter, hold, export, or operation.