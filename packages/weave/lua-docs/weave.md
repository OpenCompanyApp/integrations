# Weave — Lua API Reference

## list_patients

Search and list patients from the Weave platform.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of patients to return (default: 25) |
| `page` | integer | no | Page number for pagination, 1-based (default: 1) |
| `query` | string | no | Search query to filter patients by name, phone, or email |

### Example

```lua
local result = app.integrations.weave.list_patients({
  query = "Smith",
  limit = 10
})

for _, patient in ipairs(result.patients) do
  print(patient.id .. ": " .. patient.name)
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

```lua
local result = app.integrations.weave.get_patient({
  id = "patient-123"
})

print(result.name .. " — " .. result.email)
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

```lua
local result = app.integrations.weave.list_appointments({
  startDate = "2025-01-01",
  endDate = "2025-01-31",
  limit = 50
})

for _, appt in ipairs(result.appointments) do
  print(appt.id .. ": " .. appt.patient_name .. " at " .. appt.scheduled_at)
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

```lua
local result = app.integrations.weave.get_appointment({
  id = "appt-456"
})

print(result.patient_name .. " — " .. result.scheduled_at .. " (" .. result.status .. ")")
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

```lua
local result = app.integrations.weave.list_messages({
  type = "sms",
  limit = 20
})

for _, msg in ipairs(result.messages) do
  print(msg.id .. ": " .. msg.preview)
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

```lua
local result = app.integrations.weave.get_message({
  id = "msg-789"
})

print("From: " .. result.sender .. "\n" .. result.body)
```

---

## get_current_user

Get the currently authenticated Weave user profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.weave.get_current_user({})

print("Logged in as: " .. result.name .. " (" .. result.email .. ")")
print("Role: " .. result.role)
```

---

## Multi-Account Usage

If you have multiple Weave accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.weave.function_name({...})

-- Explicit default (portable across setups)
app.integrations.weave.default.function_name({...})

-- Named accounts
app.integrations.weave.clinic_a.function_name({...})
app.integrations.weave.clinic_b.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
