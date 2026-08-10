# Novu — JavaScript API Reference

## list_notifications

List notifications from Novu with optional filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (1-based, default: 1) |
| `limit` | integer | no | Items per page (default: 10, max: 100) |
| `channel` | string | no | Filter by channel: `in_app`, `email`, `sms`, `chat`, `push` |

### Examples

```js
// List recent notifications
var result = app.integrations.novu.list_notifications({
  page: 1,
  limit: 20,
})

// Filter by email channel
var result = app.integrations.novu.list_notifications({
  channel: "email",
  limit: 50,
})
```
---

## get_notification

Get details of a specific notification.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The notification ID |

### Example

```js
var result = app.integrations.novu.get_notification({
  id: "notification-id-here",
})
```
---

## list_subscribers

List all notification subscribers.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (0-based, default: 0) |
| `limit` | integer | no | Items per page (default: 10, max: 100) |

### Example

```js
var result = app.integrations.novu.list_subscribers({
  page: 0,
  limit: 50,
})

for (const subscriber of (result.data)) {
  console.log(subscriber.email)
}
```
---

## get_subscriber

Get details of a specific subscriber.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The subscriber ID |

### Example

```js
var result = app.integrations.novu.get_subscriber({
  id: "subscriber-id-here",
})
console.log(result.email)
console.log(result.first_name)
```
---

## create_subscriber

Create a new notification subscriber.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Email address |
| `firstName` | string | no | First name |
| `lastName` | string | no | Last name |
| `phone` | string | no | Phone number (e.g., "+1234567890") |

### Example

```js
var result = app.integrations.novu.create_subscriber({
  email: "john@example.com",
  firstName: "John",
  lastName: "Doe",
  phone: "+1234567890",
})

console.log("Created subscriber: " + result.id)
```
---

## trigger_event

Trigger a notification event to one or more subscribers.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Workflow trigger key / template name |
| `to` | string | yes | Subscriber ID, email, or JSON array of recipients |
| `payload` | object | no | Key-value template variables |

### Examples

```js
// Trigger to a single subscriber by email
var result = app.integrations.novu.trigger_event({
  name: "onboarding-welcome",
  to: "john@example.com",
  payload: { name: "John", plan: "Pro" },
})

// Trigger to a single subscriber by ID
var result = app.integrations.novu.trigger_event({
  name: "order-confirmation",
  to: "subscriber-id-here",
  payload: { orderNumber: "ORD-123", total: "$99.00" },
})

// Trigger to multiple recipients
var result = app.integrations.novu.trigger_event({
  name: "team-update",
  to: '["alice@example.com", "bob@example.com"]',
  payload: { message: "Sprint review tomorrow at 3pm" },
})
```
---

## get_current_user

Get the currently authenticated Novu user.

### Parameters

None.

### Example

```js
var result = app.integrations.novu.get_current_user({})
console.log("Logged in as: " + result.email)
console.log("Organization: " + result.organization.name)
```
---

## Multi-Account Usage

If you have multiple Novu accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.novu.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.novu.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.novu.production.function_name({ /* parameters */ })
app.integrations.novu.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
