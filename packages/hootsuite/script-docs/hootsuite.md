# Hootsuite — JavaScript API Reference

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

```js
var result = app.integrations.hootsuite.list_messages({
  startTime: "2025-01-01T00:00:00Z",
  endTime: "2025-01-31T23:59:59Z",
  limit: 20,
})

for (const msg of (result.data)) {
  console.log(msg.id + ": " + msg.text)
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
var result = app.integrations.hootsuite.get_message({
  messageId: "123456789",
})
console.log(result.data.text)
console.log(result.data.state)
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

```js
var result = app.integrations.hootsuite.create_message({
  text: "Check out our latest blog post!",
  socialProfileIds: ["12345", "67890"],
  scheduledSendTime: "2025-02-01T09:00:00Z",
})
console.log("Created message: " + result.data[0].id)
```
---

## list_social_profiles

List all social media profiles connected to the Hootsuite account.

### Parameters

None.

### Example

```js
var result = app.integrations.hootsuite.list_social_profiles()

for (const profile of (result.data)) {
  console.log(profile.id + ": " + profile.socialNetworkUsername + " (" + profile.type + ")")
}
```
---

## get_social_profile

Get details of a specific social profile.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `profileId` | string | yes | The social profile ID |

### Example

```js
var result = app.integrations.hootsuite.get_social_profile({
  profileId: "12345",
})
console.log(result.data.socialNetworkUsername)
console.log(result.data.type)
```
---

## list_members

List members of the Hootsuite organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of members to return |

### Example

```js
var result = app.integrations.hootsuite.list_members({
  limit: 50,
})

for (const member of (result.data)) {
  console.log(member.id + ": " + (member.firstName || "") + " " + (member.lastName || ""))
}
```
---

## get_current_user

Get the currently authenticated Hootsuite user profile.

### Parameters

None.

### Example

```js
var result = app.integrations.hootsuite.get_current_user()
console.log("Logged in as: " + (result.data.firstName || "") + " " + (result.data.lastName || ""))
console.log("Email: " + (result.data.email || ""))
```
---

## Multi-Account Usage

If you have multiple Hootsuite accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.hootsuite.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.hootsuite.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.hootsuite.client_acct.function_name({ /* parameters */ })
app.integrations.hootsuite.agency.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
