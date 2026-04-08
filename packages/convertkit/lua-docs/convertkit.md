# ConvertKit — Lua API Reference

## list_subscribers

List subscribers from your ConvertKit account with pagination and date filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (starts at 1, default: 1) |
| `per_page` | integer | no | Results per page (max 50, default: 50) |
| `from` | string | no | Filter subscribers added after this date (ISO 8601, e.g. "2025-01-01") |
| `to` | string | no | Filter subscribers added before this date (ISO 8601, e.g. "2025-12-31") |

### Example

```lua
local result = app.integrations.convertkit.list_subscribers({
  page = 1,
  per_page = 25,
  from = "2025-01-01",
  to = "2025-12-31"
})

for _, sub in ipairs(result.subscribers) do
  print(sub.email_address .. " — " .. (sub.first_name or "N/A"))
end
```

---

## get_subscriber

Get details for a single subscriber by their ConvertKit subscriber ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subscriber_id` | integer | yes | The ConvertKit subscriber ID |

### Example

```lua
local result = app.integrations.convertkit.get_subscriber({
  subscriber_id = 12345
})

print(result.subscriber.email_address)
print(result.subscriber.state)
```

---

## list_forms

List all forms in your ConvertKit account.

### Parameters

None.

### Example

```lua
local result = app.integrations.convertkit.list_forms({})

for _, form in ipairs(result.forms) do
  print(form.id .. ": " .. form.name)
end
```

---

## list_tags

List all tags in your ConvertKit account.

### Parameters

None.

### Example

```lua
local result = app.integrations.convertkit.list_tags({})

for _, tag in ipairs(result.tags) do
  print(tag.id .. ": " .. tag.name)
end
```

---

## create_tag

Create a new tag in ConvertKit.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Name for the new tag |

### Example

```lua
local result = app.integrations.convertkit.create_tag({
  name = "VIP Customer"
})

print("Created tag: " .. result.tag.name .. " (ID: " .. result.tag.id .. ")")
```

---

## list_broadcasts

List broadcasts (email blasts) from your ConvertKit account with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (starts at 1, default: 1) |
| `per_page` | integer | no | Results per page (default: 50) |

### Example

```lua
local result = app.integrations.convertkit.list_broadcasts({
  page = 1,
  per_page = 25
})

for _, broadcast in ipairs(result.broadcasts) do
  print(broadcast.id .. ": " .. broadcast.subject)
end
```

---

## get_current_user

Get the authenticated ConvertKit account information.

### Parameters

None.

### Example

```lua
local result = app.integrations.convertkit.get_current_user({})

print("Account: " .. result.name)
print("Email: " .. result.primary_email_address)
```

---

## Multi-Account Usage

If you have multiple ConvertKit accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.convertkit.list_subscribers({...})

-- Explicit default (portable across setups)
app.integrations.convertkit.default.list_subscribers({...})

-- Named accounts
app.integrations.convertkit.work.list_subscribers({...})
app.integrations.convertkit.personal.list_subscribers({...})
```

All functions are identical across accounts — only the credentials differ.
