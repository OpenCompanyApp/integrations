# Autopilot — Lua API Reference

## list_contacts

List contacts in your Autopilot account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of contacts to return (default: 50, max: 100) |
| `bookmark` | string | no | Pagination bookmark from a previous response |

### Example

```lua
local result = app.integrations["autopilot"].list_contacts({
  limit = 50
})

for _, contact in ipairs(result.contacts) do
  print(contact.Email .. " - " .. (contact.FirstName or ""))
end
```

---

## get_contact

Get detailed information about a specific Autopilot contact.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | The contact ID or email address |

### Example

```lua
local result = app.integrations["autopilot"].get_contact({
  contact_id = "john@example.com"
})

print("Name: " .. (result.FirstName or "") .. " " .. (result.LastName or ""))
print("Email: " .. result.Email)
```

---

## create_contact

Create or update a contact in Autopilot.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The contact's email address |
| `first_name` | string | no | The contact's first name |
| `last_name` | string | no | The contact's last name |
| `phone` | string | no | The contact's phone number |
| `title` | string | no | The contact's job title |
| `company` | string | no | The contact's company name |
| `custom_fields` | object | no | Custom field key-value pairs |

### Example

```lua
local result = app.integrations["autopilot"].create_contact({
  email = "john@example.com",
  first_name = "John",
  last_name = "Doe",
  company = "Acme Inc"
})

print(result.message)
```

---

## list_lists

List all lists in your Autopilot account.

### Parameters

None.

### Example

```lua
local result = app.integrations["autopilot"].list_lists()

for _, list in ipairs(result.lists) do
  print(list.Title .. " (" .. list.list_id .. ")")
end
```

---

## get_list

Get detailed information about a specific Autopilot list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The list ID |

### Example

```lua
local result = app.integrations["autopilot"].get_list({
  list_id = "abc123"
})

print("List: " .. result.Title)
```

---

## list_journeys

List all journeys in your Autopilot account.

### Parameters

None.

### Example

```lua
local result = app.integrations["autopilot"].list_journeys()

for _, journey in ipairs(result.journeys) do
  print(journey.Name .. " (" .. journey.journey_id .. ")")
end
```

---

## get_current_user

Get the authenticated user's Autopilot account details.

### Parameters

None.

### Example

```lua
local result = app.integrations["autopilot"].get_current_user()

print("Account connected successfully")
```

---

## Multi-Account Usage

If you have multiple Autopilot accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["autopilot"].list_contacts({})

-- Explicit default (portable across setups)
app.integrations["autopilot"].default.list_contacts({})

-- Named accounts
app.integrations["autopilot"].marketing.list_contacts({})
app.integrations["autopilot"].sales.list_contacts({})
```

All functions are identical across accounts — only the credentials differ.
