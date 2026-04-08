# Insightly CRM — Lua API Reference

## list_contacts

List contacts from Insightly CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `top` | integer | no | Maximum number of contacts to return |
| `skip` | integer | no | Number of contacts to skip for pagination |
| `search` | string | no | Search term to filter contacts by name or email |

### Example

```lua
local result = app.integrations.insightly.list_contacts({
  top = 20,
  search = "John"
})

for _, contact in ipairs(result.contacts) do
  print(contact.FIRST_NAME .. " " .. contact.LAST_NAME .. " - " .. (contact.EMAIL_ADDRESS or "no email"))
end
```

---

## get_contact

Get a single contact by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Insightly contact ID |

### Example

```lua
local result = app.integrations.insightly.get_contact({ id = 12345 })
print(result.FIRST_NAME .. " " .. result.LAST_NAME)
print("Email: " .. (result.EMAIL_ADDRESS or "N/A"))
print("Title: " .. (result.TITLE or "N/A"))
```

---

## create_contact

Create a new contact in Insightly.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | no | First name |
| `last_name` | string | no | Last name |
| `email` | string | no | Primary email address |
| `phone` | string | no | Primary phone number |

### Example

```lua
local result = app.integrations.insightly.create_contact({
  first_name = "Jane",
  last_name = "Smith",
  email = "jane@example.com",
  phone = "+1-555-0100"
})

print("Created contact ID: " .. result.CONTACT_ID)
```

---

## list_opportunities

List opportunities from Insightly CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `top` | integer | no | Maximum number of opportunities to return |
| `skip` | integer | no | Number of opportunities to skip for pagination |
| `status` | string | no | Filter by status (e.g., "Open", "Won", "Lost", "Suspended") |

### Example

```lua
local result = app.integrations.insightly.list_opportunities({
  top = 10,
  status = "Open"
})

for _, opp in ipairs(result.opportunities) do
  print(opp.OPPORTUNITY_NAME .. " - $" .. (opp.BID_AMOUNT or 0))
end
```

---

## get_opportunity

Get a single opportunity by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Insightly opportunity ID |

### Example

```lua
local result = app.integrations.insightly.get_opportunity({ id = 67890 })
print(result.OPPORTUNITY_NAME)
print("Amount: $" .. (result.BID_AMOUNT or 0))
print("Stage: " .. (result.PIPELINE_NAME or "N/A"))
```

---

## list_projects

List projects from Insightly CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `top` | integer | no | Maximum number of projects to return |
| `skip` | integer | no | Number of projects to skip for pagination |
| `status` | string | no | Filter by status (e.g., "In Progress", "Completed", "Scheduled") |

### Example

```lua
local result = app.integrations.insightly.list_projects({
  top = 15,
  status = "In Progress"
})

for _, project in ipairs(result.projects) do
  print(project.PROJECT_NAME .. " - " .. project.STATUS)
end
```

---

## get_current_user

Get the profile of the currently authenticated Insightly user.

### Parameters

None.

### Example

```lua
local result = app.integrations.insightly.get_current_user({})
print("User: " .. result.FIRST_NAME .. " " .. result.LAST_NAME)
print("Email: " .. (result.EMAIL or "N/A"))
```

---

## Multi-Account Usage

If you have multiple Insightly accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.insightly.function_name({...})

-- Explicit default (portable across setups)
app.integrations.insightly.default.function_name({...})

-- Named accounts
app.integrations.insightly.production.function_name({...})
app.integrations.insightly.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
