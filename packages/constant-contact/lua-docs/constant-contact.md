# Constant Contact — Lua API Reference

## list_contacts

List contacts from Constant Contact with pagination and optional status filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum contacts per page (default: 50, max: 500) |
| `cursor` | string | no | Pagination cursor from a previous response |
| `status` | string | no | Filter by status: `"all"`, `"active"`, `"unconfirmed"`, `"opted_out"`, `"non_subscriber"` |

### Examples

```lua
-- List all active contacts
local result = app.integrations.constant_contact.list_contacts({
  status = "active",
  limit = 100
})

-- Paginate through contacts
local page1 = app.integrations.constant_contact.list_contacts({ limit = 50 })
if page1._links and page1._links.next then
  -- Extract cursor from the next link and fetch the next page
  local page2 = app.integrations.constant_contact.list_contacts({
    limit = 50,
    cursor = page1._links.next -- use the cursor value from the previous response
  })
end
```

---

## get_contact

Get detailed information for a single Constant Contact contact.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | The Constant Contact contact ID |

### Example

```lua
local contact = app.integrations.constant_contact.get_contact({
  contact_id = "abc123-def456-ghi789"
})
print(contact.first_name .. " " .. contact.last_name)
print(contact.email_address.address)
```

---

## create_contact

Create a new contact in Constant Contact.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Contact's email address |
| `first_name` | string | no | Contact's first name |
| `last_name` | string | no | Contact's last name |
| `list_ids` | array | no | Array of list UUIDs to assign the contact to |

### Examples

```lua
-- Create a contact with minimal info
local result = app.integrations.constant_contact.create_contact({
  email = "jane@example.com"
})

-- Create a contact with full details and list assignments
local result = app.integrations.constant_contact.create_contact({
  email = "john@example.com",
  first_name = "John",
  last_name = "Doe",
  list_ids = {
    "aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee",
    "11111111-2222-3333-4444-555555555555"
  }
})
```

**Tip:** Use `list_lists` to discover available list IDs before creating contacts.

---

## list_campaigns

List email campaigns from Constant Contact.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum campaigns per page (default: 50) |
| `cursor` | string | no | Pagination cursor from a previous response |

### Example

```lua
local campaigns = app.integrations.constant_contact.list_campaigns({
  limit = 20
})

for _, campaign in ipairs(campaigns.campaigns or {}) do
  print(campaign.name .. " — " .. (campaign.current_status or "unknown"))
end
```

---

## list_lists

List all contact lists in Constant Contact.

### Parameters

None.

### Example

```lua
local lists = app.integrations.constant_contact.list_lists()

for _, list in ipairs(lists.lists or {}) do
  print(list.name .. " (" .. list.membership_count .. " members) — ID: " .. list.list_id)
end
```

Use the `list_id` values when assigning contacts to lists via `create_contact`.

---

## get_current_user

Get the authenticated user's Constant Contact account information.

### Parameters

None.

### Example

```lua
local user = app.integrations.constant_contact.get_current_user()
print("Account: " .. (user.first_name or "") .. " " .. (user.last_name or ""))
print("Email: " .. (user.email or "N/A"))
print("Organization: " .. (user.organization_name or "N/A"))
```

---

## Multi-Account Usage

If you have multiple Constant Contact accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.constant_contact.list_contacts({})

-- Explicit default (portable across setups)
app.integrations.constant_contact.default.list_contacts({})

-- Named accounts
app.integrations.constant_contact.marketing.list_contacts({})
app.integrations.constant_contact.newsletter.list_contacts({})
```

All functions are identical across accounts — only the credentials differ.
