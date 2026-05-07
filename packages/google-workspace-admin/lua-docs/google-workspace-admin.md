# Google Workspace Admin

Google Workspace Admin tools are exposed under `app.integrations.google_workspace_admin`. This package is generated from Google's official Admin SDK Directory v1 Discovery document and exposes 128 REST methods.

Use it for domain administration workflows: users, groups, aliases, group members, org units, domains, customer resources, roles, role assignments, privileges, verification codes, ChromeOS devices, mobile devices, tokens, and custom user schemas.

Each method-specific tool accepts Discovery path parameters as top-level arguments, known query parameters as top-level shortcuts or inside `query`, and request resources inside `body`. Path parameters are URL-encoded, so pass emails and IDs directly, for example `person@example.test`, `my_customer`, or `groups/example@example.test`.

## Examples

```lua
local users = app.integrations.google_workspace_admin.google_workspace_admin_users_list({
  customer = "my_customer",
  maxResults = 10,
  projection = "basic"
})

local group = app.integrations.google_workspace_admin.google_workspace_admin_groups_insert({
  body = {
    email = "agents@example.test",
    name = "Agents"
  }
})

local aliases = app.integrations.google_workspace_admin.google_workspace_admin_users_aliases_list({
  userKey = "person@example.test"
})
```

Returned data is the parsed JSON response from the Admin SDK Directory API. Empty successful responses return `{ success = true, status = <http_status> }`.

Use read-only Admin SDK scopes for list/get workflows and write scopes only for tools that create, update, delete, or watch resources. Some endpoints are only available to Google Workspace administrator accounts with the corresponding domain privileges.