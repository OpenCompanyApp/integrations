# VBout — Lua API Reference

## list_contacts

List contacts from VBout with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of contacts to return (default: 20, max: 100) |
| `offset` | integer | no | Offset for pagination (default: 0) |

### Example

```lua
local result = app.integrations.vbout.list_contacts({
  limit = 50,
  offset = 0
})

for _, contact in ipairs(result.contacts or {}) do
  print(contact.email .. " - " .. (contact.first_name or ""))
end
```

---

## get_contact

Get details for a specific VBout contact by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The VBout contact ID |

### Example

```lua
local result = app.integrations.vbout.get_contact({
  id = "12345"
})

print("Email: " .. result.email)
print("Name: " .. (result.first_name or "") .. " " .. (result.last_name or ""))
```

---

## create_contact

Add a new contact to a VBout email list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The contact's email address |
| `list_id` | string | yes | The VBout list ID to add the contact to |
| `first_name` | string | no | Contact's first name |
| `last_name` | string | no | Contact's last name |
| `phone` | string | no | Contact's phone number |

### Example

```lua
local result = app.integrations.vbout.create_contact({
  email = "user@example.com",
  list_id = "list_abc123",
  first_name = "Jane",
  last_name = "Doe"
})

print("Created contact: " .. result.id)
```

---

## list_campaigns

List email campaigns from VBout with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of campaigns to return (default: 20, max: 100) |
| `offset` | integer | no | Offset for pagination (default: 0) |

### Example

```lua
local result = app.integrations.vbout.list_campaigns({
  limit = 10,
  offset = 0
})

for _, campaign in ipairs(result.campaigns or {}) do
  print(campaign.subject .. " - Status: " .. campaign.status)
end
```

---

## get_campaign

Get details for a specific VBout email campaign by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The VBout campaign ID |

### Example

```lua
local result = app.integrations.vbout.get_campaign({
  id = "camp_678"
})

print("Subject: " .. result.subject)
print("Status: " .. result.status)
```

---

## get_current_user

Get the currently authenticated VBout user profile. Useful for verifying API credentials.

### Parameters

None.

### Example

```lua
local result = app.integrations.vbout.get_current_user({})

print("User: " .. result.name)
print("Email: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple VBout accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.vbout.function_name({...})

-- Explicit default (portable across setups)
app.integrations.vbout.default.function_name({...})

-- Named accounts
app.integrations.vbout.work.function_name({...})
app.integrations.vbout.agency.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
