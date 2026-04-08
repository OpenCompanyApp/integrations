# Actively CRM — Lua API Reference

## list_organizations

List organizations you have access to in Actively.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max organizations to return (default: 25) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```lua
local result = app.integrations.actively.list_organizations({
  limit = 10,
  page = 1
})

for _, org in ipairs(result.data) do
  print(org.id .. ": " .. org.name)
end
```

---

## get_current_user

Get the authenticated user's profile from Actively.

### Parameters

None.

### Example

```lua
local user = app.integrations.actively.get_current_user({})
print("Logged in as: " .. user.name .. " (" .. user.email .. ")")
```

---

## list_campaigns

List campaigns for an organization in Actively.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | string | yes | The organization UUID |
| `limit` | integer | no | Max campaigns to return (default: 25) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```lua
local result = app.integrations.actively.list_campaigns({
  org_id = "org_abc123",
  limit = 10,
  page = 1
})

for _, campaign in ipairs(result.data) do
  print(campaign.title .. " (" .. campaign.type .. ") - " .. campaign.status)
end
```

---

## get_campaign

Get details of a specific campaign in Actively.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | string | yes | The organization UUID |
| `campaign_id` | string | yes | The campaign UUID |

### Example

```lua
local campaign = app.integrations.actively.get_campaign({
  org_id = "org_abc123",
  campaign_id = "camp_xyz789"
})

print(campaign.title)
print("Type: " .. campaign.type)
print("Period: " .. campaign.start_date .. " to " .. campaign.end_date)
```

---

## create_campaign

Create a new campaign for an organization in Actively.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | string | yes | The organization UUID |
| `title` | string | yes | The campaign title |
| `type` | string | yes | Campaign type (e.g., `"email"`, `"social"`, `"ads"`) |
| `start_date` | string | yes | Start date in ISO 8601 format (e.g., `"2026-01-01"`) |
| `end_date` | string | yes | End date in ISO 8601 format (e.g., `"2026-03-31"`) |

### Example

```lua
local campaign = app.integrations.actively.create_campaign({
  org_id = "org_abc123",
  title = "Q1 Product Launch",
  type = "email",
  start_date = "2026-01-15",
  end_date = "2026-03-31"
})

print("Created campaign: " .. campaign.id)
```

---

## list_contacts

List contacts for an organization in Actively.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | string | yes | The organization UUID |
| `limit` | integer | no | Max contacts to return (default: 25) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```lua
local result = app.integrations.actively.list_contacts({
  org_id = "org_abc123",
  limit = 50,
  page = 1
})

for _, contact in ipairs(result.data) do
  print(contact.name .. " - " .. contact.email)
end
```

---

## get_contact

Get details of a specific contact in Actively.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | string | yes | The organization UUID |
| `contact_id` | string | yes | The contact UUID |

### Example

```lua
local contact = app.integrations.actively.get_contact({
  org_id = "org_abc123",
  contact_id = "cont_def456"
})

print(contact.name)
print("Email: " .. contact.email)
print("Phone: " .. (contact.phone or "N/A"))
```

---

## Multi-Account Usage

If you have multiple Actively accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.actively.function_name({...})

-- Explicit default (portable across setups)
app.integrations.actively.default.function_name({...})

-- Named accounts
app.integrations.actively.work.function_name({...})
app.integrations.actively.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
