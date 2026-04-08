# Apollo.io — Lua API Reference

## search_contacts

Search for people in Apollo by name, email, or keyword.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `q` | string | yes | Search query — name, email, company name, or keyword |
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Results per page (default: 25, max: 100) |

### Response Fields

| Field | Type | Description |
|-------|------|-------------|
| `contacts` | array | List of matching contacts |
| `contacts[].id` | string | Apollo person ID |
| `contacts[].name` | string | Full name |
| `contacts[].email` | string | Email address |
| `contacts[].title` | string | Job title |
| `contacts[].organization` | string | Company name |
| `contacts[].phone` | string | Phone number |
| `contacts[].linkedin_url` | string | LinkedIn profile URL |
| `total` | integer | Total matching results |
| `page` | integer | Current page |
| `per_page` | integer | Results per page |
| `total_pages` | integer | Total number of pages |

### Example

```lua
local result = app.integrations.apollo.search_contacts({
  q = "john smith",
  per_page = 5
})

for _, contact in ipairs(result.contacts) do
  print(contact.name .. " — " .. (contact.title or "no title") .. " at " .. (contact.organization or "unknown"))
end
```

---

## get_contact

Retrieve full details for a specific contact by their Apollo person ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Apollo person ID |

### Example

```lua
local result = app.integrations.apollo.get_contact({
  id = "63f3b1c2XXXXXXXXXXXX"
})

print(result.name)
print(result.email)
print(result.title)
print("Organization: " .. (result.organization or "unknown"))

for _, job in ipairs(result.employment_history or {}) do
  print(job.title .. " at " .. (job.organization or "") .. (job.current and " (current)" or ""))
end
```

---

## enrich

Enrich a contact by matching on email and/or name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | no | Email address to match |
| `name` | string | no | Full name to match |

At least one of `email` or `name` must be provided.

### Example

```lua
local result = app.integrations.apollo.enrich({
  email = "john@example.com",
  name = "John Smith"
})

if result.found then
  print("Found: " .. result.person.name)
  print("Title: " .. (result.person.title or "unknown"))
  print("Company: " .. (result.person.organization or "unknown"))
else
  print("No matching contact found")
end
```

---

## list_organizations

List organizations from your Apollo account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 25, max: 100) |

### Example

```lua
local result = app.integrations.apollo.list_organizations({
  page = 1,
  per_page = 10
})

for _, org in ipairs(result.organizations) do
  print(org.name .. " — " .. (org.industry or "unknown industry") .. " (" .. (org.employee_count or "?") .. " employees)")
end
```

---

## get_organization

Retrieve full details for a specific organization by its Apollo ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Apollo organization ID |

### Example

```lua
local result = app.integrations.apollo.get_organization({
  id = "63f3b1c2XXXXXXXXXXXX"
})

print(result.name)
print("Website: " .. (result.website_url or "unknown"))
print("Industry: " .. (result.industry or "unknown"))
print("Employees: " .. (result.employee_count or "unknown"))
print("Technologies: " .. table.concat(result.technologies or {}, ", "))
```

---

## get_current_user

Retrieve the authenticated Apollo user's profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.apollo.get_current_user({})

print("User: " .. result.name)
print("Email: " .. result.email)
print("Plan: " .. (result.plan or "unknown"))
print("Credits remaining: " .. tostring(result.credits_remaining or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Apollo accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.apollo.search_contacts({ q = "john" })

-- Explicit default (portable across setups)
app.integrations.apollo.default.search_contacts({ q = "john" })

-- Named accounts
app.integrations.apollo.work.search_contacts({ q = "john" })
app.integrations.apollo.personal.search_contacts({ q = "john" })
```

All functions are identical across accounts — only the credentials differ.
