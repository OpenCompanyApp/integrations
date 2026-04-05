# Freshsales CRM — Lua API Reference

## list_contacts

List contacts from Freshsales CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of contacts per page (default: 20, max: 100) |
| `sort` | string | no | Field to sort by (e.g., "created_at", "updated_at", "first_name") |
| `sort_type` | string | no | Sort direction: "asc" or "desc" (default: "desc") |

### Example

```lua
local result = app.integrations.freshsales.list_contacts({
  per_page = 10,
  sort = "created_at",
  sort_type = "desc"
})

for _, contact in ipairs(result.contacts) do
  print(contact.first_name .. " " .. contact.last_name .. " - " .. (contact.email or "no email"))
end
```

---

## get_contact

Get details of a specific contact by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The contact ID |

### Example

```lua
local result = app.integrations.freshsales.get_contact({ id = 12345 })
local contact = result.contact
print(contact.display_name .. " (" .. (contact.email or "no email") .. ")")
```

---

## create_contact

Create a new contact in Freshsales. At least a first name or last name is required.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | no* | First name (*at least one name required) |
| `last_name` | string | no* | Last name (*at least one name required) |
| `email` | string | no | Primary email address |
| `work_number` | string | no | Work phone number |
| `mobile_number` | string | no | Mobile phone number |
| `job_title` | string | no | Job title |
| `sales_account_id` | integer | no | ID of the sales account to link |
| `address` | string | no | Street address |
| `city` | string | no | City |
| `state` | string | no | State or province |
| `zipcode` | string | no | Postal / ZIP code |
| `country` | string | no | Country name |

### Example

```lua
local result = app.integrations.freshsales.create_contact({
  first_name = "Jane",
  last_name = "Smith",
  email = "jane.smith@example.com",
  job_title = "VP of Engineering",
  company = "Acme Corp"
})

print("Created contact ID: " .. result.contact.id)
```

---

## update_contact

Update an existing contact. Provide the contact ID and any fields to change.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The contact ID to update |
| `first_name` | string | no | Updated first name |
| `last_name` | string | no | Updated last name |
| `email` | string | no | Updated email |
| `work_number` | string | no | Updated work phone |
| `mobile_number` | string | no | Updated mobile phone |
| `job_title` | string | no | Updated job title |
| `sales_account_id` | integer | no | Sales account to link |
| `address` | string | no | Updated address |
| `city` | string | no | Updated city |
| `state` | string | no | Updated state |
| `zipcode` | string | no | Updated ZIP code |
| `country` | string | no | Updated country |

### Example

```lua
local result = app.integrations.freshsales.update_contact({
  id = 12345,
  job_title = "CTO",
  email = "jane.cto@example.com"
})

print("Updated contact: " .. result.contact.display_name)
```

---

## delete_contact

Delete a contact permanently by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The contact ID to delete |

### Example

```lua
app.integrations.freshsales.delete_contact({ id = 12345 })
print("Contact deleted")
```

---

## list_deals

List deals from Freshsales CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of deals per page (default: 20, max: 100) |
| `sort` | string | no | Field to sort by (e.g., "created_at", "amount") |
| `sort_type` | string | no | Sort direction: "asc" or "desc" (default: "desc") |

### Example

```lua
local result = app.integrations.freshsales.list_deals({
  per_page = 10,
  sort = "amount",
  sort_type = "desc"
})

for _, deal in ipairs(result.deals) do
  print(deal.name .. " - $" .. (deal.amount or "0"))
end
```

---

## get_deal

Get details of a specific deal by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The deal ID |

### Example

```lua
local result = app.integrations.freshsales.get_deal({ id = 67890 })
local deal = result.deal
print(deal.name .. " | Amount: $" .. (deal.amount or "0") .. " | Stage: " .. (deal.deal_stage_id or "unknown"))
```

---

## create_deal

Create a new deal in Freshsales. A name is required.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Deal name |
| `amount` | number | no | Deal amount |
| `deal_stage_id` | integer | no | ID of the pipeline stage |
| `sales_account_id` | integer | no | Associated sales account ID |
| `contact_ids` | array | no | Array of contact IDs to link |
| `expected_close` | string | no | Expected close date (ISO 8601) |
| `probability` | integer | no | Win probability (0-100) |
| `notes` | string | no | Deal description / notes |

### Example

```lua
local result = app.integrations.freshsales.create_deal({
  name = "Enterprise License - Acme Corp",
  amount = 50000,
  expected_close = "2026-06-30",
  probability = 75
})

print("Created deal ID: " .. result.deal.id)
```

---

## list_accounts

List sales accounts from Freshsales.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of accounts per page (default: 20, max: 100) |
| `sort` | string | no | Field to sort by |
| `sort_type` | string | no | Sort direction: "asc" or "desc" (default: "desc") |

### Example

```lua
local result = app.integrations.freshsales.list_accounts({ per_page = 20 })

for _, account in ipairs(result.sales_accounts) do
  print(account.name .. " - " .. (account.industry or "no industry"))
end
```

---

## get_current_user

Get the currently authenticated Freshsales user. Useful for verifying the connection.

### Parameters

None.

### Example

```lua
local result = app.integrations.freshsales.get_current_user({})
local user = result.user
print("Connected as: " .. user.display_name .. " (" .. user.email .. ")")
```

---

## Multi-Account Usage

If you have multiple Freshsales accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.freshsales.function_name({...})

-- Explicit default (portable across setups)
app.integrations.freshsales.default.function_name({...})

-- Named accounts
app.integrations.freshsales.us_team.function_name({...})
app.integrations.freshsales.eu_team.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
