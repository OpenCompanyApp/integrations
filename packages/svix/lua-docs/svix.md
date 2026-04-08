# Svix — Lua API Reference

## list_applications

List all Svix applications.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results (default: 50, max: 250) |
| `iterator` | string | no | Pagination cursor from a previous response |

### Example

```lua
local result = app.integrations.svix.list_applications({ limit = 50 })

for _, app in ipairs(result.data) do
  print(app.name .. " (" .. app.id .. ")")
end
```

---

## get_application

Get details of a specific Svix application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The application ID (e.g., `"app_xxxxxxxxx"`) |

### Example

```lua
local result = app.integrations.svix.get_application({ id = "app_xxxxxxxxx" })
print("Name: " .. result.name)
print("UID: " .. (result.uid or "none"))
print("Created: " .. result.created_at)
```

---

## create_application

Create a new Svix application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Application name (e.g., `"My App"`) |
| `uid` | string | no | Optional unique identifier |

### Example

```lua
local result = app.integrations.svix.create_application({
  name = "My New App",
  uid = "my-app-unique-id"
})
print("Created app: " .. result.id)
```

---

## list_messages

List messages for a Svix application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The application ID |
| `limit` | integer | no | Max results (default: 50, max: 250) |
| `iterator` | string | no | Pagination cursor from a previous response |

### Example

```lua
local result = app.integrations.svix.list_messages({
  app_id = "app_xxxxxxxxx",
  limit = 25
})

for _, msg in ipairs(result.data) do
  print(msg.event_type .. " -> " .. msg.id)
end
```

---

## list_endpoints

List webhook endpoints for a Svix application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The application ID |
| `limit` | integer | no | Max results (default: 50, max: 250) |
| `iterator` | string | no | Pagination cursor from a previous response |

### Example

```lua
local result = app.integrations.svix.list_endpoints({
  app_id = "app_xxxxxxxxx"
})

for _, ep in ipairs(result.data) do
  print(ep.url .. " (" .. ep.id .. ")")
end
```

---

## create_endpoint

Create a new webhook endpoint for a Svix application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The application ID |
| `url` | string | yes | The webhook URL (e.g., `"https://example.com/webhooks"`) |
| `version` | integer | yes | API version for the endpoint (e.g., `1`) |
| `description` | string | no | Optional endpoint description |

### Example

```lua
local result = app.integrations.svix.create_endpoint({
  app_id = "app_xxxxxxxxx",
  url = "https://example.com/webhooks",
  version = 1,
  description = "Production webhook receiver"
})
print("Created endpoint: " .. result.id)
```

---

## get_current_user

Get the current authenticated Svix user and dashboard usage information.

### Parameters

None.

### Example

```lua
local result = app.integrations.svix.get_current_user({})
print("User: " .. result.email)
print("Message count: " .. result.message_count)
```

---

## Multi-Account Usage

If you have multiple Svix accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.svix.function_name({...})

-- Explicit default (portable across setups)
app.integrations.svix.default.function_name({...})

-- Named accounts
app.integrations.svix.production.function_name({...})
app.integrations.svix.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
