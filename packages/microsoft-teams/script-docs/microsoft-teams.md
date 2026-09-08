# Microsoft Teams — Ruby API Reference

## list_teams

List all Microsoft Teams teams the authenticated user has joined.

### Parameters

None.

### Example

```ruby
result = app.call("integrations.microsoft-teams.list")
result.teams.each do |team|
  puts((team.displayName).to_s + " (id: " + (team.id).to_s + ")")
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

```ruby
result = app.call("integrations.microsoft-teams.get", team_id: "02bd9fd6-8f93-4758-87c3-1fb73740a320")
puts("Team: " + (result.displayName).to_s)
puts("Description: " + ((result.description || "none")).to_s)
puts("Visibility: " + ((result.visibility || "unknown")).to_s)
```
---

## list_channels

List all channels in a team.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | The unique identifier of the team |

### Example

```ruby
result = app.call("integrations.microsoft-teams.list_channels", team_id: "02bd9fd6-8f93-4758-87c3-1fb73740a320")
result.channels.each do |channel|
  puts((channel.displayName).to_s + " (" + (channel.membershipType).to_s + ")")
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

```ruby
result = app.call("integrations.microsoft-teams.get_channel", team_id: "02bd9fd6-8f93-4758-87c3-1fb73740a320", channel_id: "19:4b6d30ba8c6946c6930961cc94c7b31f@thread.tacv2")
puts("Channel: " + (result.displayName).to_s)
puts("Type: " + ((result.membershipType || "standard")).to_s)
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

```ruby
result = app.call("integrations.microsoft-teams.list_messages", team_id: "02bd9fd6-8f93-4758-87c3-1fb73740a320", channel_id: "19:4b6d30ba8c6946c6930961cc94c7b31f@thread.tacv2", limit: 10)
result.messages.each do |msg|
  sender = (msg.sender.displayName || "Unknown")
  puts("[" + (msg.createdDateTime).to_s + "] " + (sender).to_s + ": " + (msg.content).to_s)
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

```ruby
# Send a plain text message
result = app.call("integrations.microsoft-teams.send_message", team_id: "02bd9fd6-8f93-4758-87c3-1fb73740a320", channel_id: "19:4b6d30ba8c6946c6930961cc94c7b31f@thread.tacv2", content: "Hello from the integration!")
puts(result.message)
```
```ruby
# Send an HTML message
result = app.call("integrations.microsoft-teams.send_message", team_id: "02bd9fd6-8f93-4758-87c3-1fb73740a320", channel_id: "19:4b6d30ba8c6946c6930961cc94c7b31f@thread.tacv2", content: "<b>Important:</b> Deployment complete!", content_type: "html")
```
---

## list_chats

List chats for the authenticated user (one-to-one, group, and meeting chats).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of chats to return (default: 50, max: 50) |

### Example

```ruby
result = app.call("integrations.microsoft-teams.list_chats", limit: 10)
result.chats.each do |chat|
  label = (chat.topic || chat.chatType)
  puts((label).to_s + " (id: " + (chat.id).to_s + ")")
end
```
---

## get_current_user

Get the profile of the currently authenticated Microsoft Teams user.

### Parameters

None.

### Example

```ruby
result = app.call("integrations.microsoft-teams.get_current_user")
puts("Name: " + (result.displayName).to_s)
puts("Email: " + ((result.mail || result.userPrincipalName)).to_s)
puts("Job Title: " + ((result.jobTitle || "N/A")).to_s)
```
---

## Multi-Account Usage

If you have multiple Microsoft Teams accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
