# Freshworks CRM — Lua API Reference

## list_contacts

List contacts in Freshworks CRM with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 20, max: 100) |

### Example

```lua
local result = app.integrations.freshworks_crm.list_contacts({
  page = 1,
  per_page = 20
})

for _, contact in ipairs(result.contacts) do
  print(contact.first_name .. " " .. contact.last_name .. " - " .. (contact.email or "no email"))
end
```

---

## get_contact

Get a single contact by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The contact ID |

### Example

```lua
local result = app.integrations.freshworks_crm.get_contact({ id = 12345 })
local contact = result.contact
print(contact.first_name .. " " .. contact.last_name)
print("Email: " .. (contact.email or "N/A"))
```

---

## create_contact

Create a new contact in Freshworks CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | no | First name |
| `last_name` | string | no | Last name |
| `email` | string | no | Email address |
| `mobile_number` | string | no | Mobile phone number |

At least one field must be provided.

### Example

```lua
local result = app.integrations.freshworks_crm.create_contact({
  first_name = "Jane",
  last_name = "Smith",
  email = "jane@example.com",
  mobile_number = "+1234567890"
})

print("Created contact ID: " .. result.contact.id)
```

---

## list_deals

List deals with pagination and optional stage filter.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 20, max: 100) |
| `stage` | integer | no | Filter by deal stage ID |

### Example

```lua
local result = app.integrations.freshworks_crm.list_deals({
  page = 1,
  per_page = 20,
  stage = 5
})

for _, deal in ipairs(result.deals) do
  print(deal.name .. " - Amount: " .. deal.amount)
end
```

---

## get_deal

Get a single deal by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The deal ID |

### Example

```lua
local result = app.integrations.freshworks_crm.get_deal({ id = 67890 })
local deal = result.deal
print(deal.name .. " - " .. deal.amount .. " " .. deal.currency)
```

---

## list_accounts

List sales accounts with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 20, max: 100) |

### Example

```lua
local result = app.integrations.freshworks_crm.list_accounts({
  page = 1,
  per_page = 20
})

for _, account in ipairs(result.sales_accounts) do
  print(account.name .. " - " .. (account.domain or "no domain"))
end
```

---

## get_current_user

Get the currently authenticated Freshworks CRM user.

### Parameters

None.

### Example

```lua
local result = app.integrations.freshworks_crm.get_current_user({})
local user = result.user
print("Connected as: " .. user.first_name .. " " .. user.last_name .. " (" .. user.email .. ")")
```

---

## Multi-Account Usage

If you have multiple Freshworks CRM accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.freshworks_crm.function_name({...})

-- Explicit default (portable across setups)
app.integrations.freshworks_crm.default.function_name({...})

-- Named accounts
app.integrations.freshworks_crm.us_team.function_name({...})
app.integrations.freshworks_crm.eu_team.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
