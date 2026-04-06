# Loops — Lua API Reference

## list_contacts

List contacts from Loops with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of contacts to return (default: 50, max: 50) |
| `offset` | integer | no | Number of contacts to skip for pagination (default: 0) |

### Examples

```lua
-- List first 50 contacts
local result = app.integrations.loops.list_contacts({})

-- Get next page
local result = app.integrations.loops.list_contacts({
  limit = 50,
  offset = 50
})
```

---

## get_contact

Get a single contact by their unique ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | The unique contact ID |

### Examples

```lua
local result = app.integrations.loops.get_contact({
  contact_id = "abc123def456"
})
```

---

## create_contact

Create a new contact in Loops.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The contact's email address |
| `first_name` | string | no | The contact's first name |
| `last_name` | string | no | The contact's last name |

### Examples

```lua
local result = app.integrations.loops.create_contact({
  email = "jane@example.com",
  first_name = "Jane",
  last_name = "Doe"
})
```

---

## update_contact

Update an existing contact in Loops.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | The unique contact ID to update |
| `email` | string | no | Updated email address |
| `first_name` | string | no | Updated first name |
| `last_name` | string | no | Updated last name |
| `properties` | object | no | Custom properties as key-value pairs |

### Examples

```lua
-- Update a contact's name
local result = app.integrations.loops.update_contact({
  contact_id = "abc123def456",
  first_name = "Jane",
  last_name = "Smith"
})

-- Update with custom properties
local result = app.integrations.loops.update_contact({
  contact_id = "abc123def456",
  properties = {
    plan = "pro",
    company = "Acme Inc"
  }
})
```

---

## send_event

Send a custom event for a contact. Events can trigger automations and loops.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The contact's email address |
| `event_name` | string | yes | The event name (e.g., "signup", "purchase") |
| `properties` | object | no | Event properties as key-value pairs |

### Examples

```lua
-- Send a signup event
local result = app.integrations.loops.send_event({
  email = "jane@example.com",
  event_name = "signup"
})

-- Send a purchase event with properties
local result = app.integrations.loops.send_event({
  email = "jane@example.com",
  event_name = "purchase",
  properties = {
    product = "Pro Plan",
    amount = 99.00
  }
})
```

---

## get_current_user

Get the currently authenticated Loops user. Useful for verifying API connection.

### Parameters

None.

### Examples

```lua
local result = app.integrations.loops.get_current_user({})
```

---

## Multi-Account Usage

If you have multiple Loops accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.loops.function_name({...})

-- Explicit default (portable across setups)
app.integrations.loops.default.function_name({...})

-- Named accounts
app.integrations.loops.marketing.function_name({...})
app.integrations.loops.transactional.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
