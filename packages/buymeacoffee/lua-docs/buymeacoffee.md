# Buy Me a Coffee — Lua API Reference

## list_supporters

List all supporters in your Buy Me a Coffee account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```lua
local result = app.integrations.buymeacoffee.list_supporters()

for _, supporter in ipairs(result.supporters) do
  print(supporter.supporter_name .. " — $" .. supporter.support_amount .. " (" .. supporter.support_id .. ")")
end
```

---

## get_supporter

Get detailed information about a single Buy Me a Coffee supporter.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `supporter_id` | string | yes | The ID of the supporter to retrieve |

### Example

```lua
local result = app.integrations.buymeacoffee.get_supporter({
  supporter_id = "12345"
})

print(result.supporter_name)
print(result.support_amount)
print(result.support_note)
```

---

## list_subscriptions

List all active recurring subscriptions.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```lua
local result = app.integrations.buymeacoffee.list_subscriptions()

for _, sub in ipairs(result.subscriptions) do
  print(sub.supporter_name .. " — $" .. sub.support_amount .. " — " .. sub.status)
end
```

---

## list_extras

List all extras (additional purchase options) in your Buy Me a Coffee account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```lua
local result = app.integrations.buymeacoffee.list_extras()

for _, extra in ipairs(result.extras) do
  print(extra.title .. " — $" .. extra.price .. " — " .. extra.purchases .. " purchases")
end
```

---

## get_extra

Get detailed information about a single extra.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `extra_id` | string | yes | The ID of the extra to retrieve |

### Example

```lua
local result = app.integrations.buymeacoffee.get_extra({
  extra_id = "67890"
})

print(result.title)
print(result.description)
print(result.price)
```

---

## list_shops

List all shop items in your Buy Me a Coffee account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```lua
local result = app.integrations.buymeacoffee.list_shops()

for _, item in ipairs(result.shops) do
  print(item.title .. " — $" .. item.price)
end
```

---

## get_current_user

Get the profile of the currently authenticated Buy Me a Coffee user.

### Parameters

None.

### Example

```lua
local result = app.integrations.buymeacoffee.get_current_user()

print("Connected as: " .. result.user_name)
print("Email: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Buy Me a Coffee accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.buymeacoffee.function_name({...})

-- Explicit default (portable across setups)
app.integrations.buymeacoffee.default.function_name({...})

-- Named accounts
app.integrations.buymeacoffee.main_page.function_name({...})
app.integrations.buymeacoffee.side_project.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
