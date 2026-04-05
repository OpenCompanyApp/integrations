# Aircall — Lua API Reference

## list_calls

List calls from Aircall with optional filters and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of results per page (default: 20, max: 50) |
| `page` | integer | no | Page number for pagination (default: 1) |
| `order` | string | no | Sort order: `"asc"` or `"desc"` (default: `"desc"`) |
| `from` | string | no | Start date in ISO 8601 format (e.g., `"2026-01-01T00:00:00Z"`) |
| `to` | string | no | End date in ISO 8601 format (e.g., `"2026-01-31T23:59:59Z"`) |
| `direction` | string | no | Filter by direction: `"inbound"` or `"outbound"` |
| `user_id` | integer | no | Filter by user ID who handled the call |
| `number_id` | integer | no | Filter by Aircall phone number ID |
| `tags` | array | no | Filter by tags assigned to the call |

### Example

```lua
local result = app.integrations.aircall.list_calls({
  per_page = 10,
  order = "desc",
  direction = "inbound"
})

for _, call in ipairs(result.calls) do
  print(call.id .. ": " .. call.direction .. " from " .. (call.from or "unknown") .. " - " .. call.duration .. "s")
end
```

---

## get_call

Retrieve detailed information about a specific call.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `call_id` | integer | yes | The unique identifier of the call |

### Example

```lua
local result = app.integrations.aircall.get_call({
  call_id = 12345
})

local call = result.call
print("Call from " .. call.from .. " to " .. call.to)
print("Duration: " .. call.duration .. "s, Status: " .. call.status)
```

---

## list_contacts

List contacts from Aircall with optional search and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of results per page (default: 20, max: 50) |
| `page` | integer | no | Page number for pagination (default: 1) |
| `order` | string | no | Sort order: `"asc"` or `"desc"` (default: `"desc"`) |
| `q` | string | no | Search query — search by name, phone number, or email |

### Example

```lua
local result = app.integrations.aircall.list_contacts({
  q = "John",
  per_page = 10
})

for _, contact in ipairs(result.contacts) do
  print(contact.first_name .. " " .. contact.last_name)
  for _, phone in ipairs(contact.phone_numbers or {}) do
    print("  " .. phone.label .. ": " .. phone.value)
  end
end
```

---

## create_contact

Create a new contact in Aircall.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | no | First name of the contact |
| `last_name` | string | no | Last name of the contact |
| `company_name` | string | no | Company name |
| `information` | string | no | Additional notes or information |
| `phone_numbers` | array | no | Array of phone number objects with `label` and `value` |
| `emails` | array | no | Array of email objects with `label` and `value` |

### Phone Number Object

```json
{"label": "Work", "value": "+33612345678"}
```

### Email Object

```json
{"label": "Work", "value": "john@example.com"}
```

### Example

```lua
local result = app.integrations.aircall.create_contact({
  first_name = "Jane",
  last_name = "Smith",
  company_name = "Acme Corp",
  phone_numbers = {
    { label = "Work", value = "+33612345678" },
    { label = "Mobile", value = "+33698765432" }
  },
  emails = {
    { label = "Work", value = "jane@acme.com" }
  }
})

print("Created contact ID: " .. result.contact.id)
```

---

## update_contact

Update an existing contact in Aircall.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | integer | yes | The unique identifier of the contact to update |
| `first_name` | string | no | Updated first name |
| `last_name` | string | no | Updated last name |
| `company_name` | string | no | Updated company name |
| `information` | string | no | Updated notes |
| `phone_numbers` | array | no | Updated phone numbers (replaces all existing) |
| `emails` | array | no | Updated emails (replaces all existing) |

### Example

```lua
local result = app.integrations.aircall.update_contact({
  contact_id = 5678,
  company_name = "New Corp",
  information = "VIP client - priority support"
})

print("Updated contact: " .. result.contact.first_name .. " " .. result.contact.last_name)
```

---

## list_users

List all users in the Aircall account.

### Parameters

None.

### Example

```lua
local result = app.integrations.aircall.list_users({})

for _, user in ipairs(result.users) do
  print(user.id .. ": " .. user.first_name .. " " .. user.last_name .. " (" .. user.email .. ")")
end
```

---

## list_numbers

List all phone numbers in the Aircall account.

### Parameters

None.

### Example

```lua
local result = app.integrations.aircall.list_numbers({})

for _, number in ipairs(result.numbers) do
  print(number.id .. ": " .. number.name .. " - " .. number.number)
end
```

---

## get_current_user

Retrieve the currently authenticated Aircall user.

### Parameters

None.

### Example

```lua
local result = app.integrations.aircall.get_current_user({})

local user = result.user
print("Logged in as: " .. user.first_name .. " " .. user.last_name .. " (" .. user.email .. ")")
```

---

## Multi-Account Usage

If you have multiple Aircall accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.aircall.function_name({...})

-- Explicit default (portable across setups)
app.integrations.aircall.default.function_name({...})

-- Named accounts
app.integrations.aircall.sales.function_name({...})
app.integrations.aircall.support.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
