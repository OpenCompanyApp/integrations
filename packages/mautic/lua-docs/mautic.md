# Mautic — Lua API Reference

## list_contacts

List contacts in Mautic with optional search, filtering, and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | string | no | Search query (e.g. `"email:john@example.com"` or a name) |
| `limit` | integer | no | Maximum contacts to return (default: 30, max: 100) |
| `start` | integer | no | Offset for pagination (default: 0) |
| `orderBy` | string | no | Field to sort by (e.g. `"email"`, `"firstName"`, `"id"`) |
| `orderByDir` | string | no | Sort direction: `"asc"` or `"desc"` |

### Example

```lua
local result = app.integrations.mautic.list_contacts({
  search = "example.com",
  limit = 10
})

for _, contact in ipairs(result.contacts) do
  print(contact.email .. " - " .. (contact.firstname or "") .. " " .. (contact.lastname or ""))
end
```

---

## get_contact

Get a single contact by ID, including all fields and tags.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Mautic contact ID |

### Example

```lua
local result = app.integrations.mautic.get_contact({ id = 42 })
print("Email: " .. result.email)
print("Name: " .. (result.firstname or "") .. " " .. (result.lastname or ""))
```

---

## create_contact

Create a new contact in Mautic.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Email address |
| `firstname` | string | no | First name |
| `lastname` | string | no | Last name |
| `phone` | string | no | Phone number |
| `company` | string | no | Company name |
| `position` | string | no | Job title |
| `tags` | array | no | Tags to assign (e.g. `{"lead", "newsletter"}`) |
| `owner` | integer | no | User ID of the contact owner |

Additional custom fields can be passed as extra parameters.

### Example

```lua
local result = app.integrations.mautic.create_contact({
  email = "john@example.com",
  firstname = "John",
  lastname = "Doe",
  company = "Acme Corp",
  tags = { "lead", "website-signup" }
})

print("Created contact ID: " .. result.contact.id)
```

---

## update_contact

Update an existing contact in Mautic.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The contact ID to update |
| `email` | string | no | Updated email address |
| `firstname` | string | no | Updated first name |
| `lastname` | string | no | Updated last name |
| `phone` | string | no | Updated phone number |
| `company` | string | no | Updated company name |
| `position` | string | no | Updated job title |
| `tags` | array | no | Tags to set (e.g. `{"customer"}`) |
| `owner` | integer | no | User ID of the contact owner |

Additional custom fields can be passed as extra parameters.

### Example

```lua
local result = app.integrations.mautic.update_contact({
  id = 42,
  firstname = "Jane",
  company = "New Corp",
  tags = { "customer", "vip" }
})

print("Updated contact: " .. result.contact.email)
```

---

## delete_contact

Delete a contact from Mautic by ID. This action is permanent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The contact ID to delete |

### Example

```lua
local result = app.integrations.mautic.delete_contact({ id = 42 })
print(result) -- "Contact 42 has been deleted from Mautic."
```

---

## list_emails

List marketing emails from Mautic.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | string | no | Search query to filter emails |
| `limit` | integer | no | Maximum emails to return (default: 30) |
| `start` | integer | no | Offset for pagination (default: 0) |
| `orderBy` | string | no | Field to sort by (e.g. `"subject"`, `"id"`) |
| `orderByDir` | string | no | Sort direction: `"asc"` or `"desc"` |

### Example

```lua
local result = app.integrations.mautic.list_emails({ limit = 10 })

for _, email in ipairs(result.emails) do
  print(email.name .. " - " .. (email.subject or "no subject"))
end
```

---

## list_segments

List contact segments (lists) from Mautic.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | string | no | Search query to filter segments |
| `limit` | integer | no | Maximum segments to return (default: 30) |
| `start` | integer | no | Offset for pagination (default: 0) |
| `orderBy` | string | no | Field to sort by (e.g. `"name"`, `"id"`) |
| `orderByDir` | string | no | Sort direction: `"asc"` or `"desc"` |

### Example

```lua
local result = app.integrations.mautic.list_segments({})

for _, segment in ipairs(result.segments) do
  print(segment.name .. " (" .. (segment.alias or "") .. ") - " .. (segment.contactCount or 0) .. " contacts")
end
```

---

## list_forms

List forms from Mautic.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | string | no | Search query to filter forms |
| `limit` | integer | no | Maximum forms to return (default: 30) |
| `start` | integer | no | Offset for pagination (default: 0) |
| `orderBy` | string | no | Field to sort by (e.g. `"name"`, `"id"`) |
| `orderByDir` | string | no | Sort direction: `"asc"` or `"desc"` |

### Example

```lua
local result = app.integrations.mautic.list_forms({})

for _, form in ipairs(result.forms) do
  print(form.name .. " - " .. (form.submissionCount or 0) .. " submissions")
end
```

---

## get_current_user

Get the currently authenticated Mautic user. Useful to verify credentials.

### Parameters

None.

### Example

```lua
local result = app.integrations.mautic.get_current_user({})
print("Authenticated as: " .. result.username .. " (" .. (result.email or "") .. ")")
```

---

## Multi-Account Usage

If you have multiple Mautic instances configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.mautic.function_name({...})

-- Explicit default (portable across setups)
app.integrations.mautic.default.function_name({...})

-- Named accounts
app.integrations.mautic.production.function_name({...})
app.integrations.mautic.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
