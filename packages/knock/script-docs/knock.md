# Knock — JavaScript API Reference

## list_workflows

List notification workflows from Knock.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of workflows to return (default: 25) |
| `page` | integer | no | Page number for pagination |

### Example

```js
var result = app.integrations.knock.list_workflows({
  limit: 10,
  page: 1,
})

for (const workflow of (result.data)) {
  console.log(workflow.id + ": " + workflow.name)
}
```
---

## get_workflow

Get details of a specific notification workflow.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The workflow ID |

### Example

```js
var result = app.integrations.knock.get_workflow({
  id: "welcome-flow",
})

console.log("Workflow: " + result.name)
console.log("Steps: " + result.steps.length)
```
---

## trigger_workflow

Trigger a notification workflow for one or more recipients.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The workflow ID to trigger |
| `recipients` | array | yes | Array of recipient identifiers (user IDs or emails) |
| `data` | object | no | Payload data for template merge variables |
| `cancellation_criteria` | object | no | Cancellation criteria for the workflow run |

### Example

```js
var result = app.integrations.knock.trigger_workflow({
  id: "welcome",
  recipients: [ "user-123", "user-456" ],
  data: {
    name: "John",
    company: "Acme",
  }
})

console.log("Workflow run ID: " + result.id)
```
### With cancellation criteria

```js
var result = app.integrations.knock.trigger_workflow({
  id: "order-confirmation",
  recipients: [ "user-123" ],
  data: {
    order_id: "ORD-001",
  },
  cancellation_criteria: {
    key: "order_id",
    criteria: "ORD-001",
  }
})
```
---

## list_messages

List notification messages, optionally filtered by status.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of messages to return (default: 25) |
| `page` | integer | no | Page number for pagination |
| `status` | string | no | Filter by status: sent, delivered, undelivered, opened |

### Example

```js
var result = app.integrations.knock.list_messages({
  limit: 10,
  status: "delivered",
})

for (const msg of (result.data)) {
  console.log(msg.id + " -> " + msg.status)
}
```
---

## get_message

Get details of a specific notification message.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The message ID |

### Example

```js
var result = app.integrations.knock.get_message({
  id: "msg-abc123",
})

console.log("Status: " + result.status)
console.log("Channel: " + result.channel_id)
```
---

## list_recipients

List notification recipients.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of recipients to return (default: 25) |
| `page` | integer | no | Page number for pagination |

### Example

```js
var result = app.integrations.knock.list_recipients({
  limit: 50,
})

for (const recipient of (result.data)) {
  console.log(recipient.id + ": " + (recipient.email || "no email"))
}
```
---

## get_current_user

Get the currently authenticated Knock user. Useful for verifying credentials.

### Parameters

None.

### Example

```js
var result = app.integrations.knock.get_current_user({})

console.log("User: " + result.name)
console.log("Email: " + result.email)
```
---

## Multi-Account Usage

If you have multiple Knock accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.knock.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.knock.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.knock.production.function_name({ /* parameters */ })
app.integrations.knock.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
