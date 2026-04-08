# Affinity CRM — Lua API Reference

## list_contacts

List contacts from Affinity CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of contacts to return (default: 100, max: 500) |
| `page` | integer | no | Page number for pagination (starts at 1) |

### Example

```lua
local result = app.integrations.affinity.list_contacts({
  limit = 50,
  page = 1
})

for _, contact in ipairs(result) do
  print(contact.first_name .. " " .. contact.last_name)
end
```

---

## get_contact

Get details for a specific contact by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Affinity contact ID |

### Example

```lua
local result = app.integrations.affinity.get_contact({
  id = 12345
})

print(result.first_name .. " " .. result.last_name)
if result.emails then
  for _, email in ipairs(result.emails) do
    print("  Email: " .. email.email)
  end
end
```

---

## create_contact

Create a new contact in Affinity.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | no* | The contact's first name |
| `last_name` | string | no* | The contact's last name |
| `emails` | array | no | List of email addresses, e.g. `{"john@example.com"}` |
| `organization_ids` | array | no | List of organization IDs to link |

*At least one of `first_name` or `last_name` is required.

### Example

```lua
local result = app.integrations.affinity.create_contact({
  first_name = "Jane",
  last_name = "Smith",
  emails = {"jane@example.com", "jane@company.com"},
  organization_ids = {42}
})

print("Created contact ID: " .. result.id)
```

---

## list_organizations

List organizations from Affinity CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of organizations to return (default: 100, max: 500) |
| `page` | integer | no | Page number for pagination (starts at 1) |

### Example

```lua
local result = app.integrations.affinity.list_organizations({
  limit = 50
})

for _, org in ipairs(result) do
  print(org.name .. " — " .. (org.domain or "no domain"))
end
```

---

## get_organization

Get details for a specific organization by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Affinity organization ID |

### Example

```lua
local result = app.integrations.affinity.get_organization({
  id = 42
})

print(result.name)
if result.domain then
  print("Domain: " .. result.domain)
end
```

---

## create_organization

Create a new organization in Affinity.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The organization's name |
| `domain` | string | no | Website domain (e.g., `"example.com"`) |

### Example

```lua
local result = app.integrations.affinity.create_organization({
  name = "Acme Corp",
  domain = "acme.com"
})

print("Created organization ID: " .. result.id)
```

---

## list_lists

List all lists in Affinity CRM.

### Parameters

None.

### Example

```lua
local result = app.integrations.affinity.list_lists()

for _, list in ipairs(result) do
  print(list.name .. " (type: " .. list.type .. ")")
end
```

---

## get_current_user

Get the currently authenticated Affinity user's profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.affinity.get_current_user()

print("Logged in as: " .. result.first_name .. " " .. result.last_name)
print("Email: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Affinity accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.affinity.list_contacts({})

-- Explicit default (portable across setups)
app.integrations.affinity.default.list_contacts({})

-- Named accounts
app.integrations.affinity.work.list_contacts({})
app.integrations.affinity.client.list_contacts({})
```

All functions are identical across accounts — only the credentials differ.
