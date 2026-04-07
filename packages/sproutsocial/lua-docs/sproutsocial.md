# Sprout Social — Lua API Reference

## list_profiles

List all social media profiles connected to the Sprout Social account.

### Parameters

None.

### Example

```lua
local result = app.integrations.sproutsocial.list_profiles()

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
local result = app.integrations.sproutsocial.get_profile({
  profileId = "123456"
})
print(result.service)
print(result.service_username)
```

---

## list_posts

List posts across social profiles with optional filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `count` | integer | no | Number of posts to return per page |
| `page` | integer | no | Page number for pagination |
| `status` | string | no | Filter by status: "sent", "scheduled", or "draft" |

### Example

```lua
local result = app.integrations.sproutsocial.list_posts({
  status = "scheduled",
  count = 20,
  page = 1
})

for _, post in ipairs(result.posts) do
  print(post.id .. ": " .. post.text .. " @ " .. post.scheduled_at)
end
```

---

## create_post

Create and schedule a new social media post.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `text` | string | yes | The text content of the post |
| `profileIds` | array | yes | Profile IDs to publish to |
| `scheduledAt` | string | no | ISO 8601 timestamp (e.g., `"2025-02-01T09:00:00Z"`) |
| `media` | object | no | Media attachments (photo, link, etc.) |

### Example

```lua
local result = app.integrations.sproutsocial.create_post({
  text = "Check out our latest blog post! https://example.com/blog",
  profileIds = {"123456", "789012"},
  scheduledAt = "2025-02-01T09:00:00Z"
})
print("Created post: " .. result.id)
```

---

## list_messages

List inbox messages and conversations.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `count` | integer | no | Number of messages to return per page |
| `page` | integer | no | Page number for pagination |

### Example

```lua
local result = app.integrations.sproutsocial.list_messages({
  count = 10
})

for _, msg in ipairs(result.messages) do
  print(msg.id .. ": " .. msg.sender .. " - " .. msg.snippet)
end
```

---

## get_message

Get details of a specific message by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `messageId` | string | yes | The message ID to retrieve |

### Example

```lua
local result = app.integrations.sproutsocial.get_message({
  messageId = "msg_abc123"
})
print(result.sender)
print(result.content)
```

---

## get_current_user

Get the currently authenticated Sprout Social user profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.sproutsocial.get_current_user()
print("Logged in as: " .. (result.name or ""))
print("Email: " .. (result.email or ""))
```

---

## Multi-Account Usage

If you have multiple Sprout Social accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.sproutsocial.function_name({...})

-- Explicit default (portable across setups)
app.integrations.sproutsocial.default.function_name({...})

-- Named accounts
app.integrations.sproutsocial.client_acct.function_name({...})
app.integrations.sproutsocial.agency.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
