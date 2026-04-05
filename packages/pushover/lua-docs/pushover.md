# Pushover — Lua API Reference

## send_message

Send a push notification via Pushover.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `message` | string | yes | The notification message body |
| `title` | string | no | Optional title for the notification |
| `priority` | integer | no | Message priority (see table below) |
| `url` | string | no | Supplementary URL to include |
| `url_title` | string | no | Title for the supplementary URL |
| `sound` | string | no | Notification sound name (use `list_sounds` to discover) |
| `device` | string | no | Specific device name to target (omit for all devices) |
| `timestamp` | integer | no | Unix timestamp for scheduled delivery |
| `expire` | integer | no | Seconds until emergency messages expire (max 10800) |
| `retry` | integer | no | Seconds between retries for emergency messages (min 30) |

### Priority Levels

| Priority | Name | Behavior |
|----------|------|----------|
| -2 | No notification | No alert at all |
| -1 | Quiet | Delivered silently |
| 0 | Normal | Default priority |
| 1 | High | Bypasses quiet hours |
| 2 | Emergency | Requires acknowledgment; `expire` and `retry` are required |

### Emergency Priority

When using priority `2`, you **must** also provide:
- `retry` — seconds between re-alerts (minimum 30)
- `expire` — seconds until the alert expires (maximum 10800)

### Examples

#### Simple message

```lua
local result = app.integrations.pushover.send_message({
  message = "Deployment complete for example.com"
})

print(result.status) -- "sent"
```

#### Message with title and priority

```lua
local result = app.integrations.pushover.send_message({
  message = "Server CPU usage above 90%",
  title = "Server Alert",
  priority = 1
})
```

#### Emergency alert with retry

```lua
local result = app.integrations.pushover.send_message({
  message = "Database is unreachable!",
  title = "CRITICAL",
  priority = 2,
  retry = 60,
  expire = 3600
})
```

#### Message with URL and custom sound

```lua
local result = app.integrations.pushover.send_message({
  message = "New order received!",
  title = "Order #1234",
  sound = "cashregister",
  url = "https://example.com/orders/1234",
  url_title = "View Order"
})
```

---

## list_sounds

List available notification sounds in Pushover.

### Parameters

No parameters required.

### Example

```lua
local result = app.integrations.pushover.list_sounds()

for name, label in pairs(result.sounds) do
  print(name .. " — " .. label)
end
-- pushover — Pushover (default)
-- bike — Bike
-- bugle — Bugle
-- cashregister — Cash Register
-- ...
```

---

## get_current_user

Validate the current Pushover user credentials and retrieve account information.

### Parameters

No parameters required.

### Response Fields

| Field | Type | Description |
|-------|------|-------------|
| `valid` | boolean | Whether the credentials are valid |
| `devices` | array | List of registered device names |
| `license` | string or null | License information |

### Example

```lua
local result = app.integrations.pushover.get_current_user()

print("Valid: " .. tostring(result.valid))
print("Devices: " .. table.concat(result.devices, ", "))
```

---

## Multi-Account Usage

If you have multiple Pushover accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.pushover.send_message({ message = "Hello" })

-- Explicit default (portable across setups)
app.integrations.pushover.default.send_message({ message = "Hello" })

-- Named accounts
app.integrations.pushover.work.send_message({ message = "Work alert" })
app.integrations.pushover.personal.send_message({ message = "Personal note" })
```

All functions are identical across accounts — only the credentials differ.
