# Zendesk Sell — Lua API Reference

## list_contacts

List contacts in Zendesk Sell with pagination and sorting.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (1-based). Defaults to 1. |
| `per_page` | integer | no | Contacts per page (max 100). Defaults to 25. |
| `sort_by` | string | no | Sort field (e.g. "created_at", "updated_at", "last_name"). |

### Example

```lua
local result = app.integrations["zendesk-sell"].list_contacts({
  page = 1,
  per_page = 25,
  sort_by = "created_at"
})

for _, contact in ipairs(result.data) do
  print(contact.first_name .. " " .. contact.last_name)
end
```

---

## get_contact

Get full details of a specific contact.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The contact ID. |

### Example

```lua
local result = app.integrations["zendesk-sell"].get_contact({
  id = 12345
})

print(result.data.first_name .. " " .. result.data.last_name)
print(result.data.email)
```

---

## create_contact

Create a new contact in Zendesk Sell.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | yes | Contact first name. |
| `last_name` | string | yes | Contact last name. |
| `email` | string | no | Contact email address. |
| `organization_id` | integer | no | ID of the organization to associate. |

### Example

```lua
local result = app.integrations["zendesk-sell"].create_contact({
  first_name = "Jane",
  last_name = "Doe",
  email = "jane@example.com",
  organization_id = 100
})

print("Created contact ID: " .. result.data.id)
```

---

## list_deals

List deals with pagination and optional status filter.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (1-based). Defaults to 1. |
| `per_page` | integer | no | Deals per page (max 100). Defaults to 25. |
| `status` | string | no | Filter by status: "open", "won", "lost", "abandoned". |

### Example

```lua
local result = app.integrations["zendesk-sell"].list_deals({
  page = 1,
  per_page = 25,
  status = "open"
})

for _, deal in ipairs(result.data) do
  print(deal.name .. ": $" .. deal.value)
end
```

---

## get_deal

Get full details of a specific deal.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The deal ID. |

### Example

```lua
local result = app.integrations["zendesk-sell"].get_deal({
  id = 67890
})

print(result.data.name)
print("Value: $" .. result.data.value)
print("Status: " .. result.data.status)
```

---

## list_leads

List leads with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (1-based). Defaults to 1. |
| `per_page` | integer | no | Leads per page (max 100). Defaults to 25. |

### Example

```lua
local result = app.integrations["zendesk-sell"].list_leads({
  page = 1,
  per_page = 25
})

for _, lead in ipairs(result.data) do
  print(lead.first_name .. " " .. lead.last_name .. " - " .. lead.status)
end
```

---

## get_current_user

Get the profile of the currently authenticated Zendesk Sell user.

### Parameters

None.

### Example

```lua
local result = app.integrations["zendesk-sell"].get_current_user({})

print("Connected as: " .. result.data.first_name .. " " .. result.data.last_name)
print("Email: " .. result.data.email)
```

---

## Multi-Account Usage

If you have multiple Zendesk Sell accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["zendesk-sell"].function_name({...})

-- Explicit default (portable across setups)
app.integrations["zendesk-sell"].default.function_name({...})

-- Named accounts
app.integrations["zendesk-sell"].work.function_name({...})
app.integrations["zendesk-sell"].personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
