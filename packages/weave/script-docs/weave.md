# Weave — JavaScript API Reference

## list_patients

Search and list patients from the Weave platform.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of patients to return (default: 25) |
| `page` | integer | no | Page number for pagination, 1-based (default: 1) |
| `query` | string | no | Search query to filter patients by name, phone, or email |

### Example

```js
var result = app.integrations.weave.list_patients({
  query: "Smith",
  limit: 10,
})

for (const patient of (result.patients)) {
  console.log(patient.id + ": " + patient.name)
}
```
---

## get_patient

Retrieve a single patient by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique patient identifier |

### Example

```js
var result = app.integrations.weave.get_patient({
  id: "patient-123",
})

console.log(result.name + " — " + result.email)
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

```js
var result = app.integrations.weave.list_appointments({
  startDate: "2025-01-01",
  endDate: "2025-01-31",
  limit: 50,
})

for (const appt of (result.appointments)) {
  console.log(appt.id + ": " + appt.patient_name + " at " + appt.scheduled_at)
}
```
---

## get_appointment

Retrieve a single appointment by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique appointment identifier |

### Example

```js
var result = app.integrations.weave.get_appointment({
  id: "appt-456",
})

console.log(result.patient_name + " — " + result.scheduled_at + " (" + result.status + ")")
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

```js
var result = app.integrations.weave.list_messages({
  type: "sms",
  limit: 20,
})

for (const msg of (result.messages)) {
  console.log(msg.id + ": " + msg.preview)
}
```
---

## get_message

Retrieve a single message by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique message identifier |

### Example

```js
var result = app.integrations.weave.get_message({
  id: "msg-789",
})

console.log("From: " + result.sender + "\n" + result.body)
```
---

## get_current_user

Get the currently authenticated Weave user profile.

### Parameters

None.

### Example

```js
var result = app.integrations.weave.get_current_user({})

console.log("Logged in as: " + result.name + " (" + result.email + ")")
console.log("Role: " + result.role)
```
---

## Multi-Account Usage

If you have multiple Weave accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.weave.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.weave.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.weave.clinic_a.function_name({ /* parameters */ })
app.integrations.weave.clinic_b.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
