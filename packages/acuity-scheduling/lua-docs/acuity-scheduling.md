# Acuity Scheduling — Lua API Reference

## list_appointments

List appointments with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `minDate` | string | no | Earliest appointment date (ISO 8601, e.g., `"2026-01-01"`) |
| `maxDate` | string | no | Latest appointment date (ISO 8601, e.g., `"2026-12-31"`) |
| `calendarID` | integer | no | Filter by calendar ID |
| `appointmentTypeID` | integer | no | Filter by appointment type ID |
| `max` | integer | no | Maximum number of results (default: 100) |
| `direction` | string | no | Sort direction: `"asc"` or `"desc"` (default: `"desc"`) |

### Example

```lua
local result = app.integrations["acuity-scheduling"].list_appointments({
  minDate = "2026-04-01",
  maxDate = "2026-04-30",
  direction = "asc"
})

for _, appt in ipairs(result) do
  print(appt.id .. ": " .. appt.firstName .. " " .. appt.lastName .. " on " .. appt.date .. " at " .. appt.time)
end
```

---

## get_appointment

Get full details of a specific appointment.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The appointment ID |

### Example

```lua
local result = app.integrations["acuity-scheduling"].get_appointment({
  id = 12345
})

print("Appointment: " .. result.name)
print("Date: " .. result.date .. " at " .. result.time)
print("Client: " .. result.firstName .. " " .. result.lastName)
print("Email: " .. result.email)
print("Status: " .. result.status)
```

---

## list_clients

List and search clients.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | string | no | Search by name, email, or phone |
| `email` | string | no | Filter by exact email address |
| `max` | integer | no | Maximum number of results |

### Example

```lua
local result = app.integrations["acuity-scheduling"].list_clients({
  search = "john"
})

for _, client in ipairs(result) do
  print(client.id .. ": " .. client.firstName .. " " .. client.lastName .. " (" .. client.email .. ")")
end
```

---

## list_calendars

List all calendars. No parameters required.

### Example

```lua
local result = app.integrations["acuity-scheduling"].list_calendars()

for _, cal in ipairs(result) do
  print(cal.id .. ": " .. cal.name .. " (timezone: " .. cal.timezone .. ")")
end
```

---

## list_appointment_types

List all appointment types (services). No parameters required.

### Example

```lua
local result = app.integrations["acuity-scheduling"].list_appointment_types()

for _, t in ipairs(result) do
  print(t.id .. ": " .. t.name .. " (" .. t.duration .. " min, $" .. t.price .. ")")
end
```

---

## cancel_appointment

Cancel an existing appointment.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The appointment ID to cancel |

### Example

```lua
local result = app.integrations["acuity-scheduling"].cancel_appointment({
  id = 12345
})

print(result.message)
```

---

## get_availability

Get available time slots for a given appointment type and date.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `appointmentTypeID` | integer | yes | The appointment type ID |
| `date` | string | yes | Date in `YYYY-MM-DD` format |
| `calendarID` | integer | no | Filter by specific calendar |
| `timezone` | string | no | Timezone (e.g., `"America/New_York"`) |

### Example

```lua
-- First, get appointment types to find the right ID
local types = app.integrations["acuity-scheduling"].list_appointment_types()
local typeID = types[1].id

-- Then check availability
local result = app.integrations["acuity-scheduling"].get_availability({
  appointmentTypeID = typeID,
  date = "2026-04-10",
  timezone = "America/New_York"
})

for _, slot in ipairs(result) do
  print(slot.time)
end
```

---

## get_current_user

Get the authenticated user's profile. No parameters required.

### Example

```lua
local result = app.integrations["acuity-scheduling"].get_current_user()

print("User: " .. result.name)
print("Email: " .. result.email)
print("Timezone: " .. result.timezone)
```

---

## Multi-Account Usage

If you have multiple Acuity Scheduling accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["acuity-scheduling"].list_appointments({...})

-- Explicit default (portable across setups)
app.integrations["acuity-scheduling"].default.list_appointments({...})

-- Named accounts
app.integrations["acuity-scheduling"].work.list_appointments({...})
app.integrations["acuity-scheduling"].personal.list_appointments({...})
```

All functions are identical across accounts — only the credentials differ.
