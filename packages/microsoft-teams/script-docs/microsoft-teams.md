# Microsoft Teams — JavaScript API Reference

## list_teams

List all Microsoft Teams teams the authenticated user has joined.

### Parameters

None.

### Example

```js
var result = app.integrations["microsoft-teams"].list_teams()

for (const team of (result.teams)) {
  console.log(team.displayName + " (id: " + team.id + ")")
}
```
---

## get_team

Get details for a specific team by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | The unique identifier of the team |

### Example

```js
var result = app.integrations["microsoft-teams"].get_team({
  team_id: "02bd9fd6-8f93-4758-87c3-1fb73740a320",
})

console.log("Team: " + result.displayName)
console.log("Description: " + (result.description || "none"))
console.log("Visibility: " + (result.visibility || "unknown"))
```
---

## list_channels

List all channels in a team.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | yes | The unique identifier of the team |

### Example

```js
var result = app.integrations["microsoft-teams"].list_channels({
  team_id: "02bd9fd6-8f93-4758-87c3-1fb73740a320",
})

for (const channel of (result.channels)) {
  console.log(channel.displayName + " (" + channel.membershipType + ")")
}
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

```js
var result = app.integrations["microsoft-teams"].get_channel({
  team_id: "02bd9fd6-8f93-4758-87c3-1fb73740a320",
  channel_id: "19:4b6d30ba8c6946c6930961cc94c7b31f@thread.tacv2",
})

console.log("Channel: " + result.displayName)
console.log("Type: " + (result.membershipType || "standard"))
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

```js
var result = app.integrations["microsoft-teams"].list_messages({
  team_id: "02bd9fd6-8f93-4758-87c3-1fb73740a320",
  channel_id: "19:4b6d30ba8c6946c6930961cc94c7b31f@thread.tacv2",
  limit: 10,
})

for (const msg of (result.messages)) {
  var sender = msg.sender.displayName || "Unknown"
  console.log("[" + msg.createdDateTime + "] " + sender + ": " + msg.content)
}
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

```js
// Send a plain text message
var result = app.integrations["microsoft-teams"].send_message({
  team_id: "02bd9fd6-8f93-4758-87c3-1fb73740a320",
  channel_id: "19:4b6d30ba8c6946c6930961cc94c7b31f@thread.tacv2",
  content: "Hello from the integration!",
})

console.log(result.message) // "Message sent successfully."
```
```js
// Send an HTML message
var result = app.integrations["microsoft-teams"].send_message({
  team_id: "02bd9fd6-8f93-4758-87c3-1fb73740a320",
  channel_id: "19:4b6d30ba8c6946c6930961cc94c7b31f@thread.tacv2",
  content: "<b>Important:</b> Deployment complete!",
  content_type: "html",
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

```js
var result = app.integrations["microsoft-teams"].list_chats({
  limit: 10,
})

for (const chat of (result.chats)) {
  var label = chat.topic || chat.chatType
  console.log(label + " (id: " + chat.id + ")")
}
```
---

## get_current_user

Get the profile of the currently authenticated Microsoft Teams user.

### Parameters

None.

### Example

```js
var result = app.integrations["microsoft-teams"].get_current_user()

console.log("Name: " + result.displayName)
console.log("Email: " + (result.mail || result.userPrincipalName))
console.log("Job Title: " + (result.jobTitle || "N/A"))
```
---

## Multi-Account Usage

If you have multiple Microsoft Teams accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations["microsoft-teams"].function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations["microsoft-teams"].default.function_name({ /* parameters */ })

// Named accounts
app.integrations["microsoft-teams"].work.function_name({ /* parameters */ })
app.integrations["microsoft-teams"].personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
