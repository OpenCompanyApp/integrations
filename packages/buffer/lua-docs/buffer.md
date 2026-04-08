# Buffer — Lua API Reference

## list_profiles

List all social media profiles connected to the Buffer account.

### Parameters

None.

### Example

```lua
local result = app.integrations.buffer.list_profiles()

for _, profile in ipairs(result) do
  print(profile.id .. ": " .. profile.service .. " (" .. profile.service_username .. ")")
end
```

---

## get_profile

Get details of a specific social profile.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `profileId` | string | yes | The social profile ID |

### Example

```lua
local result = app.integrations.buffer.get_profile({
  profileId = "4eb8572a512f7f621800004e"
})
print(result.service)
print(result.service_username)
```

---

## list_pending_updates

List scheduled (pending) updates for a profile.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `profileId` | string | yes | The social profile ID |
| `count` | integer | no | Number of updates to return per page |
| `page` | integer | no | Page number for pagination |

### Example

```lua
local result = app.integrations.buffer.list_pending_updates({
  profileId = "4eb8572a512f7f621800004e",
  count = 20,
  page = 1
})

for _, update in ipairs(result.updates) do
  print(update.id .. ": " .. update.text .. " @ " .. update.scheduled_at)
end
```

---

## create_update

Create and schedule a new social media update.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `text` | string | yes | The text content of the update |
| `profileIds` | array | yes | Profile IDs to publish to |
| `shorten` | boolean | no | Auto-shorten links (default true) |
| `now` | boolean | no | Post immediately instead of scheduling (default false) |
| `scheduledAt` | string | no | ISO 8601 timestamp (e.g., `"2025-02-01T09:00:00Z"`) |
| `media` | object | no | Media attachments (photo, link, etc.) |

### Example

```lua
local result = app.integrations.buffer.create_update({
  text = "Check out our latest blog post! https://example.com/blog",
  profileIds = {"4eb8572a512f7f621800004e", "4eb8572a512f7f6218000050"},
  scheduledAt = "2025-02-01T09:00:00Z"
})
print("Created update: " .. result.updates[1].id)
```

---

## list_sent_updates

List already posted (sent) updates for a profile.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `profileId` | string | yes | The social profile ID |
| `count` | integer | no | Number of updates to return per page |
| `page` | integer | no | Page number for pagination |

### Example

```lua
local result = app.integrations.buffer.list_sent_updates({
  profileId = "4eb8572a512f7f621800004e",
  count = 10
})

for _, update in ipairs(result.updates) do
  print(update.id .. ": " .. update.text)
end
```

---

## get_update

Get details of a specific update by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `updateId` | string | yes | The update ID to retrieve |

### Example

```lua
local result = app.integrations.buffer.get_update({
  updateId = "4eb8586e512f7f621800005d"
})
print(result.text)
print(result.scheduled_at or result.sent_at)
```

---

## get_current_user

Get the currently authenticated Buffer user profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.buffer.get_current_user()
print("Logged in as: " .. (result.name or ""))
print("Email: " .. (result.email or ""))
```

---

## Multi-Account Usage

If you have multiple Buffer accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.buffer.function_name({...})

-- Explicit default (portable across setups)
app.integrations.buffer.default.function_name({...})

-- Named accounts
app.integrations.buffer.client_acct.function_name({...})
app.integrations.buffer.agency.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
