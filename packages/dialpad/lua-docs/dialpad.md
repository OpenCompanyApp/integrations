# Dialpad — Lua API Reference

## list_calls

List call history records from Dialpad.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `startTime` | integer | no | Unix timestamp for the start of the date range |
| `endTime` | integer | no | Unix timestamp for the end of the date range |
| `limit` | integer | no | Maximum number of records to return (default: 50) |
| `cursor` | string | no | Pagination cursor from a previous response |

### Examples

```lua
-- List recent calls
local result = app.integrations.dialpad.list_calls({
  limit = 20
})

for _, call in ipairs(result.items or {}) do
  print(call.direction .. " call from " .. (call.from_number or "unknown"))
end
```

```lua
-- List calls from the last 24 hours
local now = os.time()
local result = app.integrations.dialpad.list_calls({
  startTime = now - 86400,
  endTime = now,
  limit = 100
})
```

---

## get_call

Get details of a specific call record by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The call history record ID |

### Example

```lua
local result = app.integrations.dialpad.get_call({ id = "call_abc123" })
print("Duration: " .. (result.duration or 0) .. " seconds")
```

---

## list_sms

List SMS messages from Dialpad.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `startTime` | integer | no | Unix timestamp for the start of the date range |
| `endTime` | integer | no | Unix timestamp for the end of the date range |
| `limit` | integer | no | Maximum number of messages to return (default: 50) |
| `cursor` | string | no | Pagination cursor from a previous response |

### Example

```lua
local result = app.integrations.dialpad.list_sms({
  limit = 25
})

for _, msg in ipairs(result.items or {}) do
  print(msg.from .. " -> " .. msg.to .. ": " .. msg.text)
end
```

---

## send_sms

Send an SMS message via Dialpad.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `to` | string | yes | Recipient phone number in E.164 format (e.g., "+14155551234") |
| `from` | string | yes | Sender phone number or department ID in E.164 format |
| `text` | string | yes | The SMS message body |

### Example

```lua
local result = app.integrations.dialpad.send_sms({
  to = "+14155551234",
  from = "+14155559876",
  text = "Hello from Dialpad!"
})
print("Message sent, ID: " .. (result.id or "unknown"))
```

---

## list_users

List users in the Dialpad organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of users to return (default: 50) |
| `cursor` | string | no | Pagination cursor from a previous response |

### Example

```lua
local result = app.integrations.dialpad.list_users({ limit = 100 })

for _, user in ipairs(result.items or {}) do
  print(user.first_name .. " " .. user.last_name .. " - " .. (user.email or ""))
end
```

---

## get_user

Get details of a specific Dialpad user by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Dialpad user ID |

### Example

```lua
local result = app.integrations.dialpad.get_user({ id = "user_abc123" })
print(result.first_name .. " " .. result.last_name)
print("Email: " .. (result.email or "N/A"))
```

---

## get_current_user

Get the profile of the currently authenticated Dialpad user.

### Parameters

None.

### Example

```lua
local result = app.integrations.dialpad.get_current_user({})
print("Connected as: " .. result.first_name .. " " .. result.last_name)
print("Email: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Dialpad accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.dialpad.list_calls({ limit = 10 })

-- Explicit default (portable across setups)
app.integrations.dialpad.default.list_calls({ limit = 10 })

-- Named accounts
app.integrations.dialpad.work.list_calls({ limit = 10 })
app.integrations.dialpad.support.list_calls({ limit = 10 })
```

All functions are identical across accounts — only the credentials differ.
