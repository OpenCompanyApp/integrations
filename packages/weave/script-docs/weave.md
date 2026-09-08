# Weave — Ruby API Reference

## list_patients

Search and list patients from the Weave platform.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of patients to return (default: 25) |
| `page` | integer | no | Page number for pagination, 1-based (default: 1) |
| `query` | string | no | Search query to filter patients by name, phone, or email |

### Example

```ruby
result = app.integrations.weave.list_patients(query: "Smith", limit: 10)
result.patients.each do |patient|
  puts((patient.id).to_s + ": " + (patient.name).to_s)
end
```
---

## get_patient

Retrieve a single patient by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique patient identifier |

### Example

```ruby
result = app.integrations.weave.get_patient(id: "patient-123")
puts((result.name).to_s + " — " + (result.email).to_s)
```
---

## list_appointments

List appointments with optional date range filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `startDate` | string | no | Start date (ISO 8601, e.g. "2025-01-01") |
| `endDate` | string | no | End date (ISO 8601, e.g. "2025-01-31") |
| `limit` | integer | no | Maximum number of appointments to return (default: 25) |

### Example

```ruby
result = app.integrations.weave.list_appointments(start_date: "2025-01-01", end_date: "2025-01-31", limit: 50)
result.appointments.each do |appt|
  puts((appt.id).to_s + ": " + (appt.patient_name).to_s + " at " + (appt.scheduled_at).to_s)
end
```
---

## get_appointment

Retrieve a single appointment by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique appointment identifier |

### Example

```ruby
result = app.integrations.weave.get_appointment(id: "appt-456")
puts((result.patient_name).to_s + " — " + (result.scheduled_at).to_s + " (" + (result.status).to_s + ")")
```
---

## list_messages

List patient messages with optional type filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of messages to return (default: 25) |
| `page` | integer | no | Page number for pagination, 1-based (default: 1) |
| `type` | string | no | Filter by message type (e.g. "sms", "email") |

### Example

```ruby
result = app.integrations.weave.list_messages(type: "sms", limit: 20)
result.messages.each do |msg|
  puts((msg.id).to_s + ": " + (msg.preview).to_s)
end
```
---

## get_message

Retrieve a single message by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique message identifier |

### Example

```ruby
result = app.integrations.weave.get_message(id: "msg-789")
puts("From: " + (result.sender).to_s + "\n" + (result.body).to_s)
```
---

## get_current_user

Get the currently authenticated Weave user profile.

### Parameters

None.

### Example

```ruby
result = app.integrations.weave.get_current_user()
puts("Logged in as: " + (result.name).to_s + " (" + (result.email).to_s + ")")
puts("Role: " + (result.role).to_s)
```
---

## Multi-Account Usage

If you have multiple Weave accounts configured, use account-specific namespaces:

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
