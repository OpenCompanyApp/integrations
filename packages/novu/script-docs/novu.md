# Novu — Ruby API Reference

## list_notifications

List notifications from Novu with optional filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (1-based, default: 1) |
| `limit` | integer | no | Items per page (default: 10, max: 100) |
| `channel` | string | no | Filter by channel: `in_app`, `email`, `sms`, `chat`, `push` |

### Examples

```ruby
# List recent notifications
result = app.integrations.novu.list_notifications(page: 1, limit: 20)
# Filter by email channel
result = app.integrations.novu.list_notifications(channel: "email", limit: 50)
```
---

## get_notification

Get details of a specific notification.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The notification ID |

### Example

```ruby
result = app.integrations.novu.get_notification(id: "notification-id-here")
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

```ruby
result = app.integrations.novu.list_subscribers(page: 0, limit: 50)
result.data.each do |subscriber|
  puts(subscriber.email)
end
```
---

## get_subscriber

Get details of a specific subscriber.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The subscriber ID |

### Example

```ruby
result = app.integrations.novu.get_subscriber(id: "subscriber-id-here")
puts(result.email)
puts(result.first_name)
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

```ruby
result = app.integrations.novu.create_subscriber(email: "john@example.com", first_name: "John", last_name: "Doe", phone: "+1234567890")
puts("Created subscriber: " + (result.id).to_s)
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

```ruby
# Trigger to a single subscriber by email
result = app.integrations.novu.trigger_event(name: "onboarding-welcome", to: "john@example.com", payload: {name: "John", plan: "Pro"})
# Trigger to a single subscriber by ID
result = app.integrations.novu.trigger_event(name: "order-confirmation", to: "subscriber-id-here", payload: {orderNumber: "ORD-123", total: "$99.00"})
# Trigger to multiple recipients
result = app.integrations.novu.trigger_event(name: "team-update", to: "[\"alice@example.com\", \"bob@example.com\"]", payload: {message: "Sprint review tomorrow at 3pm"})
```
---

## get_current_user

Get the currently authenticated Novu user.

### Parameters

None.

### Example

```ruby
result = app.integrations.novu.get_current_user()
puts("Logged in as: " + (result.email).to_s)
puts("Organization: " + (result.organization.name).to_s)
```
---

## Multi-Account Usage

If you have multiple Novu accounts configured, use account-specific namespaces:

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
