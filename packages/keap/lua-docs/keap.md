# Keap CRM — Lua API Reference

## list_contacts

List contacts from Keap CRM with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 200) |

### Example

```lua
local result = app.integrations.keap.list_contacts({
  page = 1,
  limit = 20
})

for _, contact in ipairs(result.contacts) do
  print(contact.given_name .. " " .. contact.family_name)
end
```

---

## get_contact

Retrieve a single contact by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Keap contact ID |

### Example

```lua
local result = app.integrations.keap.get_contact({ id = 12345 })
print(result.given_name .. " " .. result.family_name)
```

---

## create_contact

Create a new contact in Keap CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | no | First name |
| `last_name` | string | no | Last name |
| `email` | string | no | Primary email address |
| `company_name` | string | no | Company name |

At least one field is required.

### Example

```lua
local result = app.integrations.keap.create_contact({
  first_name = "Jane",
  last_name = "Doe",
  email = "jane@example.com",
  company_name = "Acme Corp"
})
print("Created contact ID: " .. result.id)
```

---

## list_opportunities

List sales opportunities with optional stage filter.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 200) |
| `stage` | string | no | Filter by stage (e.g., "New", "Appointment Scheduled", "Closed Won", "Closed Lost") |

### Example

```lua
local result = app.integrations.keap.list_opportunities({
  page = 1,
  limit = 20,
  stage = "New"
})

for _, opp in ipairs(result.opportunities) do
  print(opp.title .. " — $" .. opp.value)
end
```

---

## get_opportunity

Retrieve a single opportunity by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Keap opportunity ID |

### Example

```lua
local result = app.integrations.keap.get_opportunity({ id = 67890 })
print(result.title .. " — Stage: " .. result.stage)
```

---

## list_tags

List all tags in Keap.

### Parameters

None.

### Example

```lua
local result = app.integrations.keap.list_tags()

for _, tag in ipairs(result.tags) do
  print(tag.id .. ": " .. tag.name)
end
```

---

## get_current_user

Get the currently authenticated Keap user.

### Parameters

None.

### Example

```lua
local result = app.integrations.keap.get_current_user()
print("Connected as: " .. result.first_name .. " " .. result.last_name)
```

---

## Multi-Account Usage

If you have multiple Keap accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.keap.list_contacts({ page = 1 })

-- Explicit default (portable across setups)
app.integrations.keap.default.list_contacts({ page = 1 })

-- Named accounts
app.integrations.keap.production.list_contacts({ page = 1 })
app.integrations.keap.staging.list_contacts({ page = 1 })
```

All functions are identical across accounts — only the credentials differ.
