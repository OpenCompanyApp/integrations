# Podio — Lua API Reference

## list_spaces

List all workspaces (spaces) in a Podio organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | integer | yes | The Podio organization ID |

### Example

```lua
local result = app.integrations.podio.list_spaces({
  org_id = 12345
})

for _, space in ipairs(result.spaces) do
  print(space.name .. " (ID: " .. space.space_id .. ")")
end
```

---

## get_space

Get detailed information about a specific Podio workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `space_id` | integer | yes | The Podio space (workspace) ID |

### Example

```lua
local space = app.integrations.podio.get_space({
  space_id = 67890
})

print("Space: " .. space.name)
print("URL: " .. space.url)
```

---

## list_apps

List all apps in a Podio workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `space_id` | integer | yes | The Podio space (workspace) ID |

### Example

```lua
local result = app.integrations.podio.list_apps({
  space_id = 67890
})

for _, app in ipairs(result.apps) do
  print(app.name .. " (" .. app.item_count .. " items)")
end
```

---

## get_app

Get detailed information about a specific Podio app, including field definitions.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | integer | yes | The Podio app ID |

### Example

```lua
local app = app.integrations.podio.get_app({
  app_id = 11111
})

print("App: " .. app.name)
for _, field in ipairs(app.fields) do
  print("  Field: " .. field.external_id .. " (" .. field.type .. ")")
end
```

---

## list_items

List and filter items in a Podio app with sorting and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | integer | yes | The Podio app ID |
| `limit` | integer | no | Max items to return (default: 20, max: 500) |
| `offset` | integer | no | Offset for pagination (default: 0) |
| `sort_by` | string | no | Field to sort by (e.g., `"created_on"`, `"title"`, or a field external ID) |
| `sort_desc` | boolean | no | Sort descending (default: true) |
| `filters` | string | no | JSON-encoded filter object (keys are field external IDs) |

### Example

```lua
-- List recent items
local result = app.integrations.podio.list_items({
  app_id = 11111,
  limit = 10,
  sort_by = "created_on",
  sort_desc = true
})

for _, item in ipairs(result.items) do
  print(item.title .. " (ID: " .. item.item_id .. ")")
end

-- Filter items by field value
local result = app.integrations.podio.list_items({
  app_id = 11111,
  filters = '{"status":"active"}',
  limit = 50
})
```

---

## get_item

Get detailed information about a specific Podio item, including all field values.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `item_id` | integer | yes | The Podio item ID |

### Example

```lua
local item = app.integrations.podio.get_item({
  item_id = 22222
})

print("Item: " .. item.title)
for _, field in ipairs(item.fields) do
  print("  " .. field.external_id .. ": " .. vim.inspect(field.values))
end
```

---

## get_current_user

Get the status of the currently authenticated Podio user.

### Parameters

None.

### Example

```lua
local status = app.integrations.podio.get_current_user({})
print("Logged in as: " .. status.profile.name)
```

---

## Multi-Account Usage

If you have multiple Podio accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.podio.list_spaces({ org_id = 12345 })

-- Explicit default (portable across setups)
app.integrations.podio.default.list_spaces({ org_id = 12345 })

-- Named accounts
app.integrations.podio.work.list_spaces({ org_id = 12345 })
app.integrations.podio.personal.list_spaces({ org_id = 67890 })
```

All functions are identical across accounts — only the credentials differ.
