# Freshchat — JavaScript API Reference

## list_conversations

List support conversations with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 50, max: 100) |
| `status` | string | no | Filter by status: `"new"`, `"open"`, `"pending"`, `"resolved"`, `"closed"` |
| `inbox_id` | string | no | Filter by inbox ID |

### Examples

```js
// List open conversations
var result = app.integrations.freshchat.list_conversations({
  status: "open",
  per_page: 20,
})

for (const conv of (result.conversations || [])) {
  console.log(conv.id + ": " + (conv.status || "unknown"))
}
```
```js
// Paginate through resolved conversations
var result = app.integrations.freshchat.list_conversations({
  status: "resolved",
  page: 1,
  per_page: 50,
})
```
---

## get_conversation

Get full details of a specific conversation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The conversation ID |

### Example

```js
var result = app.integrations.freshchat.get_conversation({
  id: "abc-123-def",
})
console.log("Status: " + result.status)
console.log("Created: " + result.created_time)
```
---

## create_conversation

Start a new support conversation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `user_id` | string | yes | ID of the user to associate with the conversation |
| `initial_message` | string | yes | First message in the conversation |
| `channel_id` | string | no | Optional channel ID for routing |

### Example

```js
var result = app.integrations.freshchat.create_conversation({
  user_id: "user-456",
  initial_message: "I need help with my subscription",
  channel_id: "channel-789",
})
console.log("Created conversation: " + result.conversation_id)
```
---

## list_agents

List support agents with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 50) |

### Example

```js
var result = app.integrations.freshchat.list_agents({
  page: 1,
  per_page: 25,
})

for (const agent of (result.agents || [])) {
  console.log(agent.first_name + " (" + agent.email + ") - " + (agent.status || "offline"))
}
```
---

## get_agent

Get details of a specific agent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The agent ID |

### Example

```js
var result = app.integrations.freshchat.get_agent({
  id: "agent-123",
})
console.log("Agent: " + result.first_name + " " + (result.last_name || ""))
console.log("Email: " + result.email)
```
---

## list_groups

List support groups (teams).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 50) |

### Example

```js
var result = app.integrations.freshchat.list_groups({
  page: 1,
  per_page: 50,
})

for (const group of (result.groups || [])) {
  console.log(group.id + ": " + group.name)
}
```
---

## get_current_user

Get the currently authenticated user profile.

### Parameters

None.

### Example

```js
var result = app.integrations.freshchat.get_current_user({})
console.log("Logged in as: " + (result.first_name || "") + " " + (result.last_name || ""))
console.log("Email: " + (result.email || "unknown"))
```
---

## Multi-Account Usage

If you have multiple Freshchat accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.freshchat.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.freshchat.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.freshchat.work.function_name({ /* parameters */ })
app.integrations.freshchat.support.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
