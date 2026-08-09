# Sprout Social — JavaScript API Reference

## list_profiles

List all social media profiles connected to the Sprout Social account.

### Parameters

None.

### Example

```js
var result = app.integrations.sproutsocial.list_profiles()

for (const profile of (result)) {
  console.log(profile.id + ": " + profile.service + " (" + profile.service_username + ")")
}
```
---

## get_profile

Get details of a specific social profile.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `profileId` | string | yes | The social profile ID |

### Example

```js
var result = app.integrations.sproutsocial.get_profile({
  profileId: "123456",
})
console.log(result.service)
console.log(result.service_username)
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

```js
var result = app.integrations.sproutsocial.list_posts({
  status: "scheduled",
  count: 20,
  page: 1,
})

for (const post of (result.posts)) {
  console.log(post.id + ": " + post.text + " @ " + post.scheduled_at)
}
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

```js
var result = app.integrations.sproutsocial.create_post({
  text: "Check out our latest blog post! https://example.com/blog",
  profileIds: ["123456", "789012"],
  scheduledAt: "2025-02-01T09:00:00Z",
})
console.log("Created post: " + result.id)
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

```js
var result = app.integrations.sproutsocial.list_messages({
  count: 10,
})

for (const msg of (result.messages)) {
  console.log(msg.id + ": " + msg.sender + " - " + msg.snippet)
}
```
---

## get_message

Get details of a specific message by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `messageId` | string | yes | The message ID to retrieve |

### Example

```js
var result = app.integrations.sproutsocial.get_message({
  messageId: "msg_abc123",
})
console.log(result.sender)
console.log(result.content)
```
---

## get_current_user

Get the currently authenticated Sprout Social user profile.

### Parameters

None.

### Example

```js
var result = app.integrations.sproutsocial.get_current_user()
console.log("Logged in as: " + (result.name || ""))
console.log("Email: " + (result.email || ""))
```
---

## Multi-Account Usage

If you have multiple Sprout Social accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.sproutsocial.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.sproutsocial.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.sproutsocial.client_acct.function_name({ /* parameters */ })
app.integrations.sproutsocial.agency.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
