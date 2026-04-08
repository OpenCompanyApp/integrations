# OneSignal — Lua API Reference

## list_notifications

List push notifications sent through OneSignal.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | OneSignal app ID |
| `limit` | integer | no | Max notifications to return (default: 50, max: 50) |
| `offset` | integer | no | Pagination offset (default: 0) |

### Example

```lua
local result = app.integrations["one-signal"].list_notifications({
  app_id = "12345678-abcd-efgh-ijkl-1234567890ab",
  limit = 10,
  offset = 0
})

for _, notif in ipairs(result.notifications) do
  print(notif.id .. ": " .. (notif.headings and notif.headings.en or "No title"))
end
```

---

## get_notification

Get details of a specific push notification by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Notification ID |
| `app_id` | string | yes | OneSignal app ID |

### Example

```lua
local result = app.integrations["one-signal"].get_notification({
  id = "notif-abc-123",
  app_id = "12345678-abcd-efgh-ijkl-1234567890ab"
})

print("Successful: " .. result.successful .. " / " .. result.recipients)
```

---

## create_notification

Send a new push notification via OneSignal.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | OneSignal app ID |
| `contents` | object | yes | Message body per language, e.g. `{"en": "Hello!"}` |
| `headings` | object | no | Title per language, e.g. `{"en": "Update"}` |
| `included_segments` | array | no | Target segments, e.g. `{"All", "Active Users"}` |
| `url` | string | no | URL to open on notification tap |
| `data` | object | no | Custom data payload delivered to the app |

### Example

```lua
local result = app.integrations["one-signal"].create_notification({
  app_id = "12345678-abcd-efgh-ijkl-1234567890ab",
  contents = { en = "Check out our latest update!" },
  headings = { en = "New Feature" },
  included_segments = { "All" },
  url = "https://example.com/updates",
  data = { type = "feature_update", id = 42 }
})

print("Notification sent! ID: " .. result.id)
print("Recipients: " .. result.recipients)
```

---

## list_devices

List devices (players) registered in a OneSignal app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | OneSignal app ID |
| `limit` | integer | no | Max devices to return (default: 50, max: 300) |
| `offset` | integer | no | Pagination offset (default: 0) |

### Example

```lua
local result = app.integrations["one-signal"].list_devices({
  app_id = "12345678-abcd-efgh-ijkl-1234567890ab",
  limit = 10
})

for _, device in ipairs(result.players) do
  print(device.id .. ": " .. device.device_type .. " sessions=" .. device.session_count)
end
```

---

## get_device

Get details of a specific device (player) by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Device/player ID |
| `app_id` | string | yes | OneSignal app ID |

### Example

```lua
local result = app.integrations["one-signal"].get_device({
  id = "player-xyz-789",
  app_id = "12345678-abcd-efgh-ijkl-1234567890ab"
})

print("Platform: " .. result.device_type)
print("Sessions: " .. result.session_count)
print("Tags: " .. json.stringify(result.tags or {}))
```

---

## list_apps

List all OneSignal apps accessible with the configured API key.

### Parameters

None.

### Example

```lua
local result = app.integrations["one-signal"].list_apps()

for _, app in ipairs(result) do
  print(app.name .. " (" .. app.id .. ") — " .. app.players .. " players")
end
```

---

## get_current_app

Get details of a specific OneSignal app by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | OneSignal app ID |

### Example

```lua
local result = app.integrations["one-signal"].get_current_app({
  app_id = "12345678-abcd-efgh-ijkl-1234567890ab"
})

print("App: " .. result.name)
print("Site: " .. result.site_name)
print("Players: " .. result.players)
```

---

## Multi-Account Usage

If you have multiple OneSignal accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["one-signal"].function_name({...})

-- Explicit default (portable across setups)
app.integrations["one-signal"].default.function_name({...})

-- Named accounts
app.integrations["one-signal"].production.function_name({...})
app.integrations["one-signal"].staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
