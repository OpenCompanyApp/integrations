# Copper CRM — Lua API Reference

## copper_list_contacts

Search and list contacts in Copper CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of contacts per page (default: 25, max: 200) |
| `sort_by` | string | no | Field to sort by (e.g., `"name"`, `"created_at"`) |

### Examples

```lua
local result = app.integrations.copper.copper_list_contacts({
  page_size = 50,
  sort_by = "name"
})

for _, contact in ipairs(result) do
  print(contact.name .. " (ID: " .. contact.id .. ")")
end
```

---

## copper_get_contact

Get details of a specific contact by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Copper contact ID |

### Examples

```lua
local contact = app.integrations.copper.copper_get_contact({
  id = 12345
})

print(contact.name)
print(contact.emails[1].email)
```

---

## copper_create_contact

Create a new contact in Copper CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Full name of the contact |
| `email` | string | no | Email address |

### Examples

```lua
local contact = app.integrations.copper.copper_create_contact({
  name = "Jane Smith",
  email = "jane@example.com"
})

print("Created contact ID: " .. contact.id)
```

---

## copper_update_contact

Update an existing contact in Copper CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Copper contact ID to update |
| `name` | string | no | Updated full name |
| `email` | string | no | Updated email address |

### Examples

```lua
local contact = app.integrations.copper.copper_update_contact({
  id = 12345,
  name = "Jane Smith-Jones"
})

print("Updated: " .. contact.name)
```

---

## copper_delete_contact

Delete a contact from Copper CRM. This action cannot be undone.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Copper contact ID to delete |

### Examples

```lua
app.integrations.copper.copper_delete_contact({
  id = 12345
})
```

---

## copper_list_companies

Search and list companies in Copper CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of companies per page (default: 25, max: 200) |
| `sort_by` | string | no | Field to sort by (e.g., `"name"`, `"created_at"`) |

### Examples

```lua
local result = app.integrations.copper.copper_list_companies({
  page_size = 50
})

for _, company in ipairs(result) do
  print(company.name .. " (ID: " .. company.id .. ")")
end
```

---

## copper_get_company

Get details of a specific company by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Copper company ID |

### Examples

```lua
local company = app.integrations.copper.copper_get_company({
  id = 67890
})

print(company.name)
```

---

## copper_create_company

Create a new company in Copper CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Company name |

### Examples

```lua
local company = app.integrations.copper.copper_create_company({
  name = "Acme Corp"
})

print("Created company ID: " .. company.id)
```

---

## copper_list_opportunities

Search and list opportunities (deals) in Copper CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of opportunities per page (default: 25, max: 200) |
| `sort_by` | string | no | Field to sort by (e.g., `"name"`, `"created_at"`) |

### Examples

```lua
local result = app.integrations.copper.copper_list_opportunities({
  page_size = 50
})

for _, opp in ipairs(result) do
  print(opp.name .. " — $" .. (opp.monetary_value or 0))
end
```

---

## copper_get_opportunity

Get details of a specific opportunity by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Copper opportunity ID |

### Examples

```lua
local opp = app.integrations.copper.copper_get_opportunity({
  id = 54321
})

print(opp.name)
print("Value: $" .. (opp.monetary_value or 0))
```

---

## copper_create_opportunity

Create a new opportunity (deal) in Copper CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Opportunity name |
| `pipeline_id` | integer | yes | ID of the pipeline — use `copper_list_pipelines` to find available IDs |

### Examples

```lua
-- First, get available pipelines
local pipelines = app.integrations.copper.copper_list_pipelines({})

-- Create an opportunity in the first pipeline
local opp = app.integrations.copper.copper_create_opportunity({
  name = "New Deal",
  pipeline_id = pipelines[1].id
})

print("Created opportunity ID: " .. opp.id)
```

---

## copper_list_pipelines

List all sales pipelines in Copper CRM. Each pipeline contains stages that opportunities move through.

### Parameters

This function takes no parameters.

### Examples

```lua
local pipelines = app.integrations.copper.copper_list_pipelines({})

for _, pipeline in ipairs(pipelines) do
  print("Pipeline: " .. pipeline.name .. " (ID: " .. pipeline.id .. ")")
  for _, stage in ipairs(pipeline.stages or {}) do
    print("  Stage: " .. stage.name .. " (ID: " .. stage.id .. ")")
  end
end
```

---

## copper_get_current_user

Get the currently authenticated Copper CRM user. Useful for verifying the connection and account context.

### Parameters

This function takes no parameters.

### Examples

```lua
local user = app.integrations.copper.copper_get_current_user({})

print("Logged in as: " .. (user.first_name or "") .. " " .. (user.last_name or ""))
print("Email: " .. user.email)
```

---

## Multi-Account Usage

If you have multiple Copper accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.copper.function_name({...})

-- Explicit default (portable across setups)
app.integrations.copper.default.function_name({...})

-- Named accounts
app.integrations.copper.production.function_name({...})
app.integrations.copper.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
