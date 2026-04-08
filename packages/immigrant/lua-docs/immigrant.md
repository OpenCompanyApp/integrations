# Immigrant — Lua API Reference

## list_applications

List immigration applications.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of applications per page (default: 25, max: 100) |
| `page` | integer | no | Page number for pagination (1-based) |
| `status` | string | no | Filter by status (e.g. "pending", "approved", "rejected") |

### Examples

```lua
-- List pending applications
local result = app.integrations.immigrant.list_applications({
  status = "pending",
  limit = 10
})

for _, app in ipairs(result) do
  print(app.id .. ": " .. app.applicant_name .. " [" .. app.status .. "]")
end
```

```lua
-- Paginate through all applications
local page1 = app.integrations.immigrant.list_applications({ limit = 50, page = 1 })
local page2 = app.integrations.immigrant.list_applications({ limit = 50, page = 2 })
```

---

## get_application

Get details of a specific immigration application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Immigrant application ID |

### Examples

```lua
local application = app.integrations.immigrant.get_application({ id = "app_abc123" })
print(application.applicant_name)
print(application.type)
print("Status: " .. application.status)
```

---

## create_application

Create a new immigration application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | yes | Application type (e.g. "visa", "green_card", "citizenship") |
| `applicant_name` | string | yes | Full name of the applicant |
| `details` | object | no | Additional application details (key-value pairs) |

### Examples

```lua
-- Create a basic visa application
local application = app.integrations.immigrant.create_application({
  type = "visa",
  applicant_name = "Jane Doe"
})

print("Created application #" .. application.id)
```

```lua
-- Create an application with details
local application = app.integrations.immigrant.create_application({
  type = "green_card",
  applicant_name = "John Smith",
  details = {
    country_of_origin = "Canada",
    current_visa_type = "H1B",
    employer = "Acme Corp"
  }
})
```

---

## list_documents

List documents for a specific immigration application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `application_id` | string | yes | The Immigrant application ID |
| `limit` | integer | no | Number of documents per page (default: 25, max: 100) |
| `page` | integer | no | Page number for pagination (1-based) |

### Examples

```lua
-- List documents for an application
local docs = app.integrations.immigrant.list_documents({
  application_id = "app_abc123",
  limit = 20
})

for _, doc in ipairs(docs) do
  print(doc.id .. ": " .. doc.name .. " (" .. doc.status .. ")")
end
```

---

## get_document

Get details of a specific document.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Immigrant document ID |

### Examples

```lua
local doc = app.integrations.immigrant.get_document({ id = "doc_xyz789" })
print(doc.name)
print("Status: " .. doc.status)
print("Uploaded: " .. doc.uploaded_at)
```

---

## list_statuses

List all available application statuses.

### Parameters

None.

### Examples

```lua
local statuses = app.integrations.immigrant.list_statuses({})

for _, status in ipairs(statuses) do
  print(status.id .. ": " .. status.name .. " - " .. status.description)
end
```

---

## get_current_user

Get the currently authenticated Immigrant user's profile.

### Parameters

None.

### Examples

```lua
local user = app.integrations.immigrant.get_current_user({})
print("Logged in as: " .. user.first_name .. " " .. user.last_name)
print("Email: " .. user.email)
```

---

## Multi-Account Usage

If you have multiple Immigrant accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.immigrant.list_applications({})

-- Explicit default (portable across setups)
app.integrations.immigrant.default.list_applications({})

-- Named accounts
app.integrations.immigrant.production.list_applications({})
app.integrations.immigrant.staging.list_applications({})
```

All functions are identical across accounts — only the credentials differ.
