# Outreach — Lua API Reference

## outreach_list_prospects

List prospects in Outreach with optional filtering, sorting, and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of prospects per page (default: 25, max: 100). |
| `page_number` | integer | no | Page number to retrieve (1-based). |
| `sort` | string | no | Sort field, prefix with `-` for descending (e.g., `"createdAt"`, `"-updatedAt"`). |
| `filter` | array | no | JSON:API filter parameters. |

### Example

```lua
local result = app.integrations.outreach.list_prospects({
  page_size = 10,
  page_number = 1,
  sort = "-createdAt"
})

for _, prospect in ipairs(result.data) do
  print(prospect.attributes.firstName .. " " .. prospect.attributes.lastName)
end
```

---

## outreach_get_prospect

Get a single prospect by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The prospect ID. |

### Example

```lua
local result = app.integrations.outreach.get_prospect({ id = 12345 })
local attrs = result.data.attributes
print(attrs.firstName .. " " .. attrs.lastName)
print("Emails: " .. table.concat(attrs.emails or {}, ", "))
```

---

## outreach_create_prospect

Create a new prospect in Outreach.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | no | The prospect's first name. |
| `last_name` | string | no | The prospect's last name. |
| `emails` | array | no | Array of email addresses. |
| `company` | string | no | The prospect's company name. |

### Example

```lua
local result = app.integrations.outreach.create_prospect({
  first_name = "Jane",
  last_name = "Doe",
  emails = { "jane@example.com" },
  company = "Acme Corp"
})

print("Created prospect ID: " .. result.data.id)
```

---

## outreach_list_sequences

List sales sequences in Outreach.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of sequences per page (default: 25, max: 100). |
| `page_number` | integer | no | Page number to retrieve (1-based). |

### Example

```lua
local result = app.integrations.outreach.list_sequences({
  page_size = 20,
  page_number = 1
})

for _, seq in ipairs(result.data) do
  print(seq.attributes.name)
end
```

---

## outreach_get_sequence

Get a single sequence by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The sequence ID. |

### Example

```lua
local result = app.integrations.outreach.get_sequence({ id = 42 })
print("Sequence: " .. result.data.attributes.name)
```

---

## outreach_list_accounts

List accounts (organizations) in Outreach.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of accounts per page (default: 25, max: 100). |
| `page_number` | integer | no | Page number to retrieve (1-based). |

### Example

```lua
local result = app.integrations.outreach.list_accounts({
  page_size = 50
})

for _, account in ipairs(result.data) do
  print(account.attributes.name .. " (" .. (account.attributes.domain or "no domain") .. ")")
end
```

---

## outreach_get_current_user

Get the currently authenticated Outreach user.

### Parameters

None.

### Example

```lua
local result = app.integrations.outreach.get_current_user({})
local user = result.data.attributes
print("Logged in as: " .. user.firstName .. " " .. user.lastName)
print("Email: " .. (user.email or "N/A"))
```

---

## Multi-Account Usage

If you have multiple Outreach accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.outreach.list_prospects({ page_size = 10 })

-- Explicit default (portable across setups)
app.integrations.outreach.default.list_prospects({ page_size = 10 })

-- Named accounts
app.integrations.outreach.production.list_prospects({ page_size = 10 })
app.integrations.outreach.staging.list_prospects({ page_size = 10 })
```

All functions are identical across accounts — only the credentials differ.
