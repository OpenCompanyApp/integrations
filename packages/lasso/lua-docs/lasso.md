# Lasso CRM — Lua API Reference

## list_contacts

List contacts (registrants) in Lasso CRM. Supports filtering by project and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | no | Filter contacts by project ID |
| `limit` | integer | no | Max results (default: 25) |
| `page` | integer | no | Page number for pagination |

### Example

```lua
local result = app.integrations.lasso.list_contacts({
  project_id = "proj_abc123",
  limit = 10
})

for _, contact in ipairs(result.contacts) do
  print(contact.id .. ": " .. (contact.first_name or "") .. " " .. (contact.last_name or ""))
end
```

---

## get_contact

Get full details for a single contact by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The contact ID |

### Example

```lua
local contact = app.integrations.lasso.get_contact({
  id = "contact_abc123"
})

print(contact.first_name .. " " .. contact.last_name)
print("Email: " .. (contact.email or "N/A"))
print("Phone: " .. (contact.phone or "N/A"))
```

---

## create_contact

Create a new contact (registrant) in Lasso CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | no | Contact first name |
| `last_name` | string | no | Contact last name |
| `email` | string | no | Primary email address |
| `phone` | string | no | Primary phone number |
| `project_id` | string | no | Project ID to associate with |
| `source` | string | no | Lead source (e.g., "Website", "Referral") |
| `notes` | string | no | Notes about the contact |

At least a `first_name` or `last_name` is required.

### Example

```lua
local contact = app.integrations.lasso.create_contact({
  first_name = "Jane",
  last_name = "Smith",
  email = "jane@example.com",
  phone = "+1234567890",
  project_id = "proj_abc123",
  source = "Website"
})

print("Created contact: " .. contact.id)
```

---

## list_deals

List deals (sales) in Lasso CRM with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | no | Filter deals by project ID |
| `status` | string | no | Filter by deal status |
| `limit` | integer | no | Max results (default: 25) |
| `page` | integer | no | Page number for pagination |

### Example

```lua
local result = app.integrations.lasso.list_deals({
  project_id = "proj_abc123",
  status = "Active",
  limit = 10
})

for _, deal in ipairs(result.deals) do
  print(deal.id .. ": " .. (deal.name or deal.id))
end
```

---

## get_deal

Get full details for a single deal by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The deal ID |

### Example

```lua
local deal = app.integrations.lasso.get_deal({
  id = "deal_abc123"
})

print("Deal: " .. (deal.name or deal.id))
print("Price: " .. (deal.price or "N/A"))
print("Status: " .. (deal.status or "N/A"))
```

---

## list_inventory

List available inventory (units/lots) in Lasso CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | no | Filter inventory by project ID |
| `status` | string | no | Filter by status (e.g., "Available", "Sold", "Reserved") |
| `limit` | integer | no | Max results (default: 25) |
| `page` | integer | no | Page number for pagination |

### Example

```lua
local result = app.integrations.lasso.list_inventory({
  project_id = "proj_abc123",
  status = "Available",
  limit = 10
})

for _, item in ipairs(result.inventory) do
  print(item.id .. ": " .. (item.name or item.unit_number or item.id))
end
```

---

## get_current_user

Get the authenticated user's profile.

### Parameters

None.

### Example

```lua
local user = app.integrations.lasso.get_current_user({})

print("Logged in as: " .. (user.first_name or "") .. " " .. (user.last_name or ""))
print("Email: " .. (user.email or "N/A"))

if user.organization then
  print("Organization: " .. (user.organization.name or "N/A"))
end
```

---

## Multi-Account Usage

If you have multiple Lasso CRM accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.lasso.function_name({...})

-- Explicit default (portable across setups)
app.integrations.lasso.default.function_name({...})

-- Named accounts
app.integrations.lasso.downtown_project.function_name({...})
app.integrations.lasso.suburb_project.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
