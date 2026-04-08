# Hootsuite — Lua API Reference

## list_messages

List scheduled and past messages in Hootsuite.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `startTime` | string | no | Start of time range (ISO 8601, e.g., `"2025-01-01T00:00:00Z"`) |
| `endTime` | string | no | End of time range (ISO 8601, e.g., `"2025-01-31T23:59:59Z"`) |
| `limit` | integer | no | Maximum number of messages to return |
| `socialProfileIds` | array | no | Array of social profile IDs to filter by |

### Example

```lua
local result = app.integrations.hootsuite.list_messages({
  startTime = "2025-01-01T00:00:00Z",
  endTime = "2025-01-31T23:59:59Z",
  limit = 20
})

for _, msg in ipairs(result.data) do
  print(msg.id .. ": " .. msg.text)
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
local result = app.integrations.hootsuite.get_message({
  messageId = "123456789"
})
print(result.data.text)
print(result.data.state)
```

---

## create_message

Schedule a new social media message.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `text` | string | yes | The message text content |
| `socialProfileIds` | array | yes | Social profile IDs to publish to |
| `scheduledSendTime` | string | yes | ISO 8601 timestamp (e.g., `"2025-02-01T09:00:00Z"`) |

### Example

```lua
local result = app.integrations.hootsuite.create_message({
  text = "Check out our latest blog post!",
  socialProfileIds = {"12345", "67890"},
  scheduledSendTime = "2025-02-01T09:00:00Z"
})
print("Created message: " .. result.data[1].id)
```

---

## list_social_profiles

List all social media profiles connected to the Hootsuite account.

### Parameters

None.

### Example

```lua
local result = app.integrations.hootsuite.list_social_profiles()

for _, profile in ipairs(result.data) do
  print(profile.id .. ": " .. profile.socialNetworkUsername .. " (" .. profile.type .. ")")
end
```

---

## get_social_profile

Get details of a specific social profile.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `profileId` | string | yes | The social profile ID |

### Example

```lua
local result = app.integrations.hootsuite.get_social_profile({
  profileId = "12345"
})
print(result.data.socialNetworkUsername)
print(result.data.type)
```

---

## list_members

List members of the Hootsuite organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of members to return |

### Example

```lua
local result = app.integrations.hootsuite.list_members({
  limit = 50
})

for _, member in ipairs(result.data) do
  print(member.id .. ": " .. (member.firstName or "") .. " " .. (member.lastName or ""))
end
```

---

## get_current_user

Get the currently authenticated Hootsuite user profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.hootsuite.get_current_user()
print("Logged in as: " .. (result.data.firstName or "") .. " " .. (result.data.lastName or ""))
print("Email: " .. (result.data.email or ""))
```

---

## Multi-Account Usage

If you have multiple Hootsuite accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.hootsuite.function_name({...})

-- Explicit default (portable across setups)
app.integrations.hootsuite.default.function_name({...})

-- Named accounts
app.integrations.hootsuite.client_acct.function_name({...})
app.integrations.hootsuite.agency.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
