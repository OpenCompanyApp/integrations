# Karbon — Lua API Reference

## list_contacts

List contacts in Karbon with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 100) |

### Example

```lua
local result = app.integrations.karbon.list_contacts({
  page = 1,
  limit = 20
})

for _, contact in ipairs(result) do
  print(contact.firstName .. " " .. contact.lastName)
end
```

---

## get_contact

Get a single contact by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique contact identifier |

### Example

```lua
local contact = app.integrations.karbon.get_contact({
  id = "contact-123"
})

print(contact.firstName .. " " .. contact.lastName)
print(contact.email)
print(contact.company)
```

---

## create_contact

Create a new contact in Karbon.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `firstName` | string | yes | First name |
| `lastName` | string | yes | Last name |
| `email` | string | no | Email address |
| `company` | string | no | Company or organization name |
| `phone` | string | no | Phone number |

### Example

```lua
local contact = app.integrations.karbon.create_contact({
  firstName = "Jane",
  lastName = "Doe",
  email = "jane@example.com",
  company = "Acme Corp",
  phone = "+1234567890"
})

print("Created contact: " .. contact.id)
```

---

## list_work_items

List work items with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 100) |
| `status` | string | no | Filter by status (e.g., "Open", "InProgress", "Completed") |
| `assignee` | string | no | Filter by assignee email or ID |

### Example

```lua
-- List open work items
local result = app.integrations.karbon.list_work_items({
  status = "Open",
  limit = 50
})

for _, item in ipairs(result) do
  print(item.title .. " - " .. item.status)
end

-- List work items assigned to a specific user
local assigned = app.integrations.karbon.list_work_items({
  assignee = "user@example.com",
  page = 1
})
```

---

## get_work_item

Get a single work item by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique work item identifier |

### Example

```lua
local item = app.integrations.karbon.get_work_item({
  id = "work-item-456"
})

print(item.title)
print(item.status)
print(item.dueDate)
```

---

## list_users

List users in the Karbon account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of users to return (default: 20) |

### Example

```lua
local users = app.integrations.karbon.list_users({
  limit = 50
})

for _, user in ipairs(users) do
  print(user.firstName .. " " .. user.lastName .. " - " .. user.email)
end
```

---

## get_current_user

Get the currently authenticated user.

### Parameters

None.

### Example

```lua
local me = app.integrations.karbon.get_current_user({})

print("Logged in as: " .. me.firstName .. " " .. me.lastName)
print("Email: " .. me.email)
```

---

## Multi-Account Usage

If you have multiple Karbon accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.karbon.function_name({...})

-- Explicit default (portable across setups)
app.integrations.karbon.default.function_name({...})

-- Named accounts
app.integrations.karbon.firm_a.function_name({...})
app.integrations.karbon.firm_b.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
