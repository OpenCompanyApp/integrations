# Constant Contact — Lua API Reference

## list_contacts

List contacts from your Constant Contact account with optional status filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of contacts to return (max 500, default 100) |
| `status` | string | no | Filter by status: `"active"`, `"unconfirmed"`, `"opted_out"`, or `"pending"` |

### Example

```lua
local result = app.integrations.constantcontact.list_contacts({
  limit = 50,
  status = "active"
})

for _, contact in ipairs(result.contacts) do
  print(contact.first_name .. " " .. contact.last_name .. " — " .. contact.email_address)
end
```

---

## get_contact

Get details for a single contact by their Constant Contact contact ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | The Constant Contact contact ID |

### Example

```lua
local result = app.integrations.constantcontact.get_contact({
  contact_id = "abc123-def456"
})

print(result.contact.email_address)
print(result.contact.first_name)
print(result.contact.last_name)
```

---

## create_contact

Create a new contact in Constant Contact.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email_address` | string | yes | Contact email address |
| `first_name` | string | no | Contact first name |
| `last_name` | string | no | Contact last name |
| `list_ids` | array | no | Array of list IDs to add the contact to upon creation |

### Example

```lua
local result = app.integrations.constantcontact.create_contact({
  email_address = "alice@example.com",
  first_name = "Alice",
  last_name = "Smith"
})

print("Created contact: " .. result.contact.email_address)
```

### Create and add to lists

```lua
local result = app.integrations.constantcontact.create_contact({
  email_address = "bob@example.com",
  first_name = "Bob",
  last_name = "Jones",
  list_ids = { "list-001", "list-002" }
})
```

---

## update_contact

Update an existing contact's details in Constant Contact.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | The Constant Contact contact ID to update |
| `first_name` | string | no | Updated first name |
| `last_name` | string | no | Updated last name |
| `email_address` | string | no | Updated email address |

### Example

```lua
local result = app.integrations.constantcontact.update_contact({
  contact_id = "abc123-def456",
  first_name = "Alice",
  last_name = "Johnson"
})

print("Updated contact: " .. result.contact.email_address)
```

---

## delete_contact

Delete a contact from Constant Contact.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | The Constant Contact contact ID to delete |

### Example

```lua
local result = app.integrations.constantcontact.delete_contact({
  contact_id = "abc123-def456"
})

print(result.message)
```

---

## list_lists

List all contact lists in your Constant Contact account.

### Parameters

None.

### Example

```lua
local result = app.integrations.constantcontact.list_lists({})

for _, list in ipairs(result.lists) do
  print(list.list_id .. ": " .. list.name .. " (" .. list.membership_count .. " members)")
end
```

---

## get_list

Get details for a single contact list by its list ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The Constant Contact list ID |

### Example

```lua
local result = app.integrations.constantcontact.get_list({
  list_id = "list-001"
})

print(result.list.name)
print("Members: " .. result.list.membership_count)
```

---

## create_list

Create a new contact list in Constant Contact.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Name for the new contact list |

### Example

```lua
local result = app.integrations.constantcontact.create_list({
  name = "Newsletter Subscribers"
})

print("Created list: " .. result.list.name .. " (ID: " .. result.list.list_id .. ")")
```

---

## add_contact_to_list

Add one or more existing contacts to a contact list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_id` | string | yes | The list ID to add contacts to |
| `contact_ids` | array | yes | Array of contact IDs to add to the list |

### Example

```lua
local result = app.integrations.constantcontact.add_contact_to_list({
  list_id = "list-001",
  contact_ids = { "abc123-def456", "ghi789-jkl012" }
})

print("Contacts added to list")
```

---

## get_current_user

Get the current user account summary from Constant Contact.

### Parameters

None.

### Example

```lua
local result = app.integrations.constantcontact.get_current_user({})

print("Account: " .. (result.first_name or "") .. " " .. (result.last_name or ""))
print("Email: " .. (result.email or "N/A"))
print("Plan: " .. (result.plan_name or "N/A"))
```

---

## Multi-Account Usage

If you have multiple Constant Contact accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.constantcontact.list_contacts({...})

-- Explicit default (portable across setups)
app.integrations.constantcontact.default.list_contacts({...})

-- Named accounts
app.integrations.constantcontact.work.list_contacts({...})
app.integrations.constantcontact.personal.list_contacts({...})
```

All functions are identical across accounts — only the credentials differ.
