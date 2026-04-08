# Pushbullet — Lua API Reference

## list_pushes

List recent pushes (notifications) from Pushbullet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of pushes to return (default: 10, max: 500) |
| `cursor` | string | no | Pagination cursor from a previous response to get the next page |

### Example

```lua
local result = app.integrations.pushbullet.list_pushes({
  limit = 20
})

for _, push in ipairs(result.pushes) do
  print(push.title .. ": " .. (push.body or ""))
end
```

### Paginated Example

```lua
local result = app.integrations.pushbullet.list_pushes({
  limit = 10,
  cursor = previous_cursor
})
```

---

## create_push

Send a push notification via Pushbullet. Supports "note" (text) and "link" (URL) types.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | yes | Push type: `"note"` or `"link"` |
| `title` | string | yes | Title of the push notification |
| `body` | string | yes | Body text of the push notification |
| `url` | string | no | Required for `"link"` type — the URL to include |
| `device_iden` | string | no | Target a specific device by its iden. Omit to send to all devices. |

### Examples

#### Send a note

```lua
local result = app.integrations.pushbullet.create_push({
  type = "note",
  title = "Build Complete",
  body = "The deployment finished successfully."
})
```

#### Send a link

```lua
local result = app.integrations.pushbullet.create_push({
  type = "link",
  title = "New Report Available",
  body = "Monthly analytics report is ready.",
  url = "https://example.com/reports/monthly"
})
```

#### Send to a specific device

```lua
local result = app.integrations.pushbullet.create_push({
  type = "note",
  title = "Alert",
  body = "Server CPU usage exceeded 90%.",
  device_iden = "ujpah71o0"
})
```

---

## delete_push

Delete a push notification by its unique identifier.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `push_iden` | string | yes | The unique identifier (iden) of the push to delete |

### Example

```lua
app.integrations.pushbullet.delete_push({
  push_iden = "ujpah71o0sjpoPriAz"
})
```

---

## list_devices

List all devices registered with the current user's Pushbullet account.

### Parameters

None.

### Example

```lua
local result = app.integrations.pushbullet.list_devices({})

for _, device in ipairs(result.devices) do
  print(device.nickname .. " (" .. device.kind .. ") - " .. device.iden)
end
```

---

## get_current_user

Get the authenticated Pushbullet user's profile information.

### Parameters

None.

### Example

```lua
local result = app.integrations.pushbullet.get_current_user({})
print("User: " .. result.name)
print("Email: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Pushbullet accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.pushbullet.function_name({...})

-- Explicit default (portable across setups)
app.integrations.pushbullet.default.function_name({...})

-- Named accounts
app.integrations.pushbullet.work.function_name({...})
app.integrations.pushbullet.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
