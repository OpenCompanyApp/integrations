# Client for the Zapier REST API — Lua API Reference

## zapier_list_zaps

List zaps in Zapier with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max number of zaps to return. |
| `page` | integer | no | Page number for pagination. |

### Example

```lua
local result = app.integrations.zapier.zapier_list_zaps({
  limit = 50
  page = 1
})
```

## zapier_get_zap

Get detailed information about a Zapier zap.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The zap ID. |

### Example

```lua
local result = app.integrations.zapier.zapier_get_zap({
  id = ""
})
```

## zapier_list_executions

List zap executions in Zapier with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `zap_id` | string | no | Filter executions by zap ID. |
| `limit` | integer | no | Max number of executions to return. |
| `page` | integer | no | Page number for pagination. |

### Example

```lua
local result = app.integrations.zapier.zapier_list_executions({
  zap_id = ""
  limit = 50
  page = 1
})
```

## zapier_get_execution

Get detailed information about a Zapier execution.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The execution ID. |

### Example

```lua
local result = app.integrations.zapier.zapier_get_execution({
  id = ""
})
```

## zapier_list_connections

List connections in Zapier with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max number of connections to return. |
| `page` | integer | no | Page number for pagination. |

### Example

```lua
local result = app.integrations.zapier.zapier_list_connections({
  limit = 50
  page = 1
})
```

## zapier_get_connection

Get detailed information about a Zapier connection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The connection ID. |

### Example

```lua
local result = app.integrations.zapier.zapier_get_connection({
  id = ""
})
```

## zapier_get_current_user

Get the currently authenticated Zapier user.

### Example

```lua
local result = app.integrations.zapier.zapier_get_current_user({
})
```

---

## Multi-Account Usage

If you have multiple zapier accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.zapier.function_name({...})

-- Explicit default (portable across setups)
app.integrations.zapier.default.function_name({...})

-- Named accounts
app.integrations.zapier.work.function_name({...})
app.integrations.zapier.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
