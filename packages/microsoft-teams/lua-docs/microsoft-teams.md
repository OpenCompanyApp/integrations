# Microsoft Teams — Lua API Reference

## list_teams

List all Microsoft Teams teams the authenticated user has joined.

### Parameters

None.

### Example

```lua
local result = app.integrations["microsoft-teams"].list_teams()

for _, team in ipairs(result.teams) do
  print(team.displayName .. " (id: " .. team.id .. ")")
end
```

---

## get_team

Get details for a specific team by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | The unique identifier of the team |

### Example

```lua
local result = app.integrations["microsoft-teams"].get_team({
  team_id = "02bd9fd6-8f93-4758-87c3-1fb73740a320"
})

print("Team: " .. result.displayName)
print("Description: " .. (result.description or "none"))
print("Visibility: " .. (result.visibility or "unknown"))
```

---

## list_channels

List all channels in a team.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | The unique identifier of the team |

### Example

```lua
local result = app.integrations["microsoft-teams"].list_channels({
  team_id = "02bd9fd6-8f93-4758-87c3-1fb73740a320"
})

for _, channel in ipairs(result.channels) do
  print(channel.displayName .. " (" .. channel.membershipType .. ")")
end
```

---

## get_channel

Get details for a specific channel.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | The unique identifier of the team |
| `channel_id` | string | yes | The unique identifier of the channel |

### Example

```lua
local result = app.integrations["microsoft-teams"].get_channel({
  team_id = "02bd9fd6-8f93-4758-87c3-1fb73740a320",
  channel_id = "19:4b6d30ba8c6946c6930961cc94c7b31f@thread.tacv2"
})

print("Channel: " .. result.displayName)
print("Type: " .. (result.membershipType or "standard"))
```

---

## list_messages

List recent messages in a channel.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | The unique identifier of the team |
| `channel_id` | string | yes | The unique identifier of the channel |
| `limit` | integer | no | Maximum number of messages to return (default: 50, max: 50) |

### Example

```lua
local result = app.integrations["microsoft-teams"].list_messages({
  team_id = "02bd9fd6-8f93-4758-87c3-1fb73740a320",
  channel_id = "19:4b6d30ba8c6946c6930961cc94c7b31f@thread.tacv2",
  limit = 10
})

for _, msg in ipairs(result.messages) do
  local sender = msg.sender.displayName or "Unknown"
  print("[" .. msg.createdDateTime .. "] " .. sender .. ": " .. msg.content)
end
```

---

## send_message

Send a message to a Teams channel.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | The unique identifier of the team |
| `channel_id` | string | yes | The unique identifier of the channel |
| `content` | string | yes | The message content to send |
| `content_type` | string | no | Content type: `"text"` or `"html"` (default: `"text"`) |

### Example

```lua
-- Send a plain text message
local result = app.integrations["microsoft-teams"].send_message({
  team_id = "02bd9fd6-8f93-4758-87c3-1fb73740a320",
  channel_id = "19:4b6d30ba8c6946c6930961cc94c7b31f@thread.tacv2",
  content = "Hello from the integration!"
})

print(result.message)  -- "Message sent successfully."
```

```lua
-- Send an HTML message
local result = app.integrations["microsoft-teams"].send_message({
  team_id = "02bd9fd6-8f93-4758-87c3-1fb73740a320",
  channel_id = "19:4b6d30ba8c6946c6930961cc94c7b31f@thread.tacv2",
  content = "<b>Important:</b> Deployment complete!",
  content_type = "html"
})
```

---

## list_chats

List chats for the authenticated user (one-to-one, group, and meeting chats).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of chats to return (default: 50, max: 50) |

### Example

```lua
local result = app.integrations["microsoft-teams"].list_chats({
  limit = 10
})

for _, chat in ipairs(result.chats) do
  local label = chat.topic or chat.chatType
  print(label .. " (id: " .. chat.id .. ")")
end
```

---

## get_current_user

Get the profile of the currently authenticated Microsoft Teams user.

### Parameters

None.

### Example

```lua
local result = app.integrations["microsoft-teams"].get_current_user()

print("Name: " .. result.displayName)
print("Email: " .. (result.mail or result.userPrincipalName))
print("Job Title: " .. (result.jobTitle or "N/A"))
```

---

## Multi-Account Usage

If you have multiple Microsoft Teams accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["microsoft-teams"].function_name({...})

-- Explicit default (portable across setups)
app.integrations["microsoft-teams"].default.function_name({...})

-- Named accounts
app.integrations["microsoft-teams"].work.function_name({...})
app.integrations["microsoft-teams"].personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
