# Hunter.io — Lua API Reference

## domain_search

Search for professional email addresses associated with a domain.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain` | string | yes | The domain to search (e.g., `"example.com"`) |
| `limit` | integer | no | Maximum number of results (default: 10, max: 100) |
| `offset` | integer | no | Number of results to skip for pagination |
| `type` | string | no | Filter by email type: `"personal"` or `"generic"` |

### Example

```lua
local result = app.integrations.hunter.domain_search({
  domain = "example.com",
  limit = 20
})

for _, email in ipairs(result.data.emails) do
  print(email.value .. " - " .. (email.first_name or "") .. " " .. (email.last_name or ""))
end
```

---

## email_finder

Find the most likely email address for a person based on their name and company domain.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain` | string | yes | The company domain (e.g., `"example.com"`) |
| `first_name` | string | no | The person's first name |
| `last_name` | string | no | The person's last name |

### Example

```lua
local result = app.integrations.hunter.email_finder({
  domain = "example.com",
  first_name = "John",
  last_name = "Doe"
})

print("Email: " .. result.data.email)
print("Confidence: " .. result.data.score .. "%")
```

---

## email_verifier

Verify the deliverability of an email address.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The email address to verify |

### Example

```lua
local result = app.integrations.hunter.email_verifier({
  email = "john@example.com"
})

print("Result: " .. result.data.result) -- deliverable, undeliverable, risky, unknown
print("Confidence: " .. result.data.score .. "%")
```

---

## email_count

Get the number of email addresses found for a domain. This endpoint does not consume API credits.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `domain` | string | yes | The domain to count emails for |

### Example

```lua
local result = app.integrations.hunter.email_count({
  domain = "example.com"
})

print("Total emails: " .. result.data.total)
print("Personal: " .. result.data.personal)
print("Generic: " .. result.data.generic)
```

---

## list_leads

List leads stored in your Hunter.io account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of leads to return (default: 20, max: 100) |
| `offset` | integer | no | Number of leads to skip for pagination |

### Example

```lua
local result = app.integrations.hunter.list_leads({
  limit = 50,
  offset = 0
})

for _, lead in ipairs(result.data.leads) do
  print(lead.id .. ": " .. lead.email .. " - " .. (lead.first_name or "") .. " " .. (lead.last_name or ""))
end
```

---

## get_lead

Retrieve a single lead by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The lead ID |

### Example

```lua
local result = app.integrations.hunter.get_lead({
  id = 12345
})

print("Email: " .. result.data.email)
print("Name: " .. (result.data.first_name or "") .. " " .. (result.data.last_name or ""))
```

---

## create_lead

Create a new lead in Hunter.io.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The lead's email address |
| `first_name` | string | no | The lead's first name |
| `last_name` | string | no | The lead's last name |
| `list_id` | integer | no | ID of the lead list to add this lead to |

### Example

```lua
local result = app.integrations.hunter.create_lead({
  email = "john@example.com",
  first_name = "John",
  last_name = "Doe",
  list_id = 42
})

print("Created lead: " .. result.data.id)
```

---

## get_current_user

Get account information and API usage for the authenticated Hunter.io user.

### Parameters

None.

### Example

```lua
local result = app.integrations.hunter.get_current_user({})

print("Account: " .. result.data.email)
print("Plan: " .. result.data.plan_name)
print("Requests used: " .. result.data.usage.requests.used .. " / " .. result.data.usage.requests.limit)
```

---

## Multi-Account Usage

If you have multiple Hunter.io accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.hunter.domain_search({domain = "example.com"})

-- Explicit default (portable across setups)
app.integrations.hunter.default.domain_search({domain = "example.com"})

-- Named accounts
app.integrations.hunter.work.domain_search({domain = "example.com"})
app.integrations.hunter.personal.domain_search({domain = "example.com"})
```

All functions are identical across accounts — only the credentials differ.
