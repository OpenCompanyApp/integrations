# Insightly CRM — Lua API Reference

## list_contacts

List contacts from Insightly CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `top` | integer | no | Maximum number of contacts to return |
| `skip` | integer | no | Number of contacts to skip for pagination |
| `order_by` | string | no | Field to order by (e.g., `"DATE_CREATED_UTC desc"`) |
| `filter` | string | no | Insightly filter expression (e.g., `"FIRST_NAME eq 'John'"`) |
| `brief` | boolean | no | Set to `true` for a reduced payload |

### Example

```lua
local result = app.integrations.insightly.list_contacts({
  top = 20,
  order_by = "DATE_CREATED_UTC desc"
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
| `title` | string | no | Job title |
| `background` | string | no | Background notes |
| `contact_type` | string | no | Contact type (e.g., "Customer") |
| `additional_fields` | object | no | Additional Insightly fields as key-value pairs |

### Example

```lua
local result = app.integrations.insightly.create_contact({
  first_name = "Jane",
  last_name = "Smith",
  email = "jane@example.com",
  phone = "+1-555-0100",
  title = "VP of Engineering"
})

print("Created contact ID: " .. result.CONTACT_ID)
```

---

## update_contact

Update an existing contact in Insightly.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Insightly contact ID to update |
| `first_name` | string | no | Updated first name |
| `last_name` | string | no | Updated last name |
| `email` | string | no | Updated email address |
| `phone` | string | no | Updated phone number |
| `title` | string | no | Updated job title |
| `background` | string | no | Updated background notes |
| `contact_type` | string | no | Updated contact type |
| `additional_fields` | object | no | Additional fields to update as key-value pairs |

### Example

```lua
local result = app.integrations.insightly.update_contact({
  id = 12345,
  title = "CTO",
  background = "Promoted to CTO in Q1 2026"
})

print("Updated contact: " .. result.FIRST_NAME .. " " .. result.LAST_NAME)
```

---

## list_deals

List deals (opportunities) from Insightly CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `top` | integer | no | Maximum number of deals to return |
| `skip` | integer | no | Number of deals to skip for pagination |
| `order_by` | string | no | Field to order by (e.g., `"DATE_CREATED_UTC desc"`) |
| `filter` | string | no | Insightly filter expression (e.g., `"OPPORTUNITY_STATE eq 'Open'"`) |
| `brief` | boolean | no | Set to `true` for a reduced payload |

### Example

```lua
local result = app.integrations.insightly.list_deals({
  top = 10,
  order_by = "BID_AMOUNT desc"
})

for _, deal in ipairs(result.deals) do
  print(deal.OPPORTUNITY_NAME .. " - $" .. (deal.BID_AMOUNT or 0))
end
```

---

## get_deal

Get a single deal (opportunity) by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Insightly opportunity ID |

### Example

```lua
local result = app.integrations.insightly.get_deal({ id = 67890 })
print(result.OPPORTUNITY_NAME)
print("Amount: $" .. (result.BID_AMOUNT or 0))
print("Stage: " .. (result.PIPELINE_NAME or "N/A"))
```

---

## create_deal

Create a new deal (opportunity) in Insightly.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `opportunity_name` | string | yes | Name of the deal |
| `bid_amount` | number | no | Deal value/amount |
| `bid_currency` | string | no | Currency code (e.g., "USD", "EUR") |
| `pipeline_id` | integer | no | ID of the pipeline |
| `stage_id` | integer | no | ID of the pipeline stage |
| `close_date` | string | no | Expected close date (e.g., "2026-06-30") |
| `category_id` | integer | no | ID of the opportunity category |
| `background` | string | no | Background notes |
| `additional_fields` | object | no | Additional fields as key-value pairs |

### Example

```lua
local result = app.integrations.insightly.create_deal({
  opportunity_name = "Enterprise License Deal",
  bid_amount = 50000,
  bid_currency = "USD",
  close_date = "2026-06-30",
  background = "Enterprise client interested in annual license"
})

print("Created deal ID: " .. result.OPPORTUNITY_ID)
```

---

## list_projects

List projects from Insightly CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `top` | integer | no | Maximum number of projects to return |
| `skip` | integer | no | Number of projects to skip for pagination |
| `order_by` | string | no | Field to order by (e.g., `"DATE_CREATED_UTC desc"`) |
| `filter` | string | no | Insightly filter expression (e.g., `"STATUS eq 'In Progress'"`) |
| `brief` | boolean | no | Set to `true` for a reduced payload |

### Example

```lua
local result = app.integrations.insightly.list_projects({
  top = 15,
  filter = "STATUS eq 'In Progress'"
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
