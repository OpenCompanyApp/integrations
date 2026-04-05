# Salesforce — Lua API Reference

All tools are accessed via `app.integrations.salesforce.{tool_key}({params})`.

---

## salesforce_create_lead

Create a new lead in Salesforce. Supports standard lead fields plus arbitrary custom fields via `other_fields`. Returns the created lead ID and success status.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `last_name` | string | yes | Lead last name |
| `company` | string | yes | Lead company name |
| `first_name` | string | no | Lead first name |
| `email` | string | no | Lead email address |
| `phone` | string | no | Lead phone number |
| `title` | string | no | Lead job title |
| `website` | string | no | Lead website URL |
| `other_fields` | object | no | Additional custom fields as key-value pairs |

### Example

```lua
local result = app.integrations.salesforce.salesforce_create_lead({
  first_name = "Jane",
  last_name = "Smith",
  company = "Acme Corp",
  email = "jane@acme.com",
  phone = "+1-555-0123",
  title = "VP of Engineering"
})

print("Created lead: " .. result.id)
```

---

## salesforce_get_lead

Retrieve a Salesforce lead by its ID. Returns the lead's fields, attributes, and associated data.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Salesforce lead ID (18 or 15 character) |

### Example

```lua
local result = app.integrations.salesforce.salesforce_get_lead({
  id = "00Q5f00001ABCdEFGH"
})

print("Lead: " .. result.FirstName .. " " .. result.LastName)
print("Company: " .. result.Company)
```

---

## salesforce_update_lead

Update an existing Salesforce lead by ID. Supports standard lead fields plus arbitrary custom fields via `other_fields`. Returns success confirmation on completion.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Salesforce lead ID to update |
| `first_name` | string | no | Lead first name |
| `last_name` | string | no | Lead last name |
| `company` | string | no | Lead company name |
| `email` | string | no | Lead email address |
| `phone` | string | no | Lead phone number |
| `other_fields` | object | no | Additional custom fields as key-value pairs |

### Example

```lua
local result = app.integrations.salesforce.salesforce_update_lead({
  id = "00Q5f00001ABCdEFGH",
  phone = "+1-555-9999",
  email = "jane.smith@acme.com"
})

print("Updated: " .. tostring(result.updated))
```

---

## salesforce_create_contact

Create a new contact in Salesforce. Supports standard contact fields plus arbitrary custom fields via `other_fields`. Returns the created contact ID and success status.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `last_name` | string | yes | Contact last name |
| `first_name` | string | no | Contact first name |
| `email` | string | no | Contact email address |
| `phone` | string | no | Contact phone number |
| `account_id` | string | no | Salesforce Account ID to associate the contact with |
| `title` | string | no | Contact job title |
| `other_fields` | object | no | Additional custom fields as key-value pairs |

### Example

```lua
local result = app.integrations.salesforce.salesforce_create_contact({
  first_name = "John",
  last_name = "Doe",
  email = "john@example.com",
  phone = "+1-555-0456",
  account_id = "0015f00001ABCdEFGH"
})

print("Created contact: " .. result.id)
```

---

## salesforce_get_contact

Retrieve a Salesforce contact by its ID. Returns the contact's fields, attributes, and associated data.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Salesforce contact ID (18 or 15 character) |

### Example

```lua
local result = app.integrations.salesforce.salesforce_get_contact({
  id = "0035f00001ABCdEFGH"
})

print("Contact: " .. result.FirstName .. " " .. result.LastName)
print("Email: " .. result.Email)
```

---

## salesforce_create_account

Create a new account in Salesforce. Supports standard account fields plus arbitrary custom fields via `other_fields`. Returns the created account ID and success status.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Account name |
| `website` | string | no | Account website URL |
| `phone` | string | no | Account phone number |
| `industry` | string | no | Account industry (e.g. Technology, Finance) |
| `billing_city` | string | no | Billing address city |
| `billing_country` | string | no | Billing address country |
| `other_fields` | object | no | Additional custom fields as key-value pairs |

### Example

```lua
local result = app.integrations.salesforce.salesforce_create_account({
  name = "Acme Corp",
  website = "https://acme.com",
  phone = "+1-555-0789",
  industry = "Technology",
  billing_city = "San Francisco",
  billing_country = "US"
})

print("Created account: " .. result.id)
```

---

## salesforce_get_account

Retrieve a Salesforce account by its ID. Returns the account's fields, attributes, and associated data.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Salesforce account ID (18 or 15 character) |

### Example

```lua
local result = app.integrations.salesforce.salesforce_get_account({
  id = "0015f00001ABCdEFGH"
})

print("Account: " .. result.Name)
print("Industry: " .. (result.Industry or "N/A"))
```

---

## salesforce_update_account

Update an existing Salesforce account by ID. Supports standard account fields plus arbitrary custom fields via `other_fields`. Returns success confirmation on completion.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Salesforce account ID to update |
| `name` | string | no | Account name |
| `website` | string | no | Account website URL |
| `phone` | string | no | Account phone number |
| `other_fields` | object | no | Additional custom fields as key-value pairs |

### Example

```lua
local result = app.integrations.salesforce.salesforce_update_account({
  id = "0015f00001ABCdEFGH",
  phone = "+1-555-1111",
  website = "https://acme-new.com"
})

print("Updated: " .. tostring(result.updated))
```

---

## salesforce_create_opportunity

Create a new opportunity in Salesforce. Supports standard opportunity fields including name, amount, stage, close date, account, and probability. Returns the created opportunity ID and success status.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Opportunity name |
| `stage_name` | string | yes | Sales stage (e.g. Prospecting, Qualification, Closed Won) |
| `close_date` | string | yes | Expected close date (YYYY-MM-DD) |
| `amount` | number | no | Opportunity amount (numeric) |
| `account_id` | string | no | Salesforce Account ID to associate the opportunity with |
| `probability` | number | no | Win probability as a percentage (0-100) |

### Example

```lua
local result = app.integrations.salesforce.salesforce_create_opportunity({
  name = "Acme Corp - New Deal",
  amount = 50000,
  stage_name = "Prospecting",
  close_date = "2026-06-30",
  account_id = "0015f00001ABCdEFGH",
  probability = 25
})

print("Created opportunity: " .. result.id)
```

---

## salesforce_get_opportunity

Retrieve a Salesforce opportunity by its ID. Returns the opportunity's fields, attributes, and associated data.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Salesforce opportunity ID (18 or 15 character) |

### Example

```lua
local result = app.integrations.salesforce.salesforce_get_opportunity({
  id = "0065f00001ABCdEFGH"
})

print("Opportunity: " .. result.Name)
print("Amount: " .. (result.Amount or "N/A"))
print("Stage: " .. result.StageName)
```

---

## salesforce_query

Execute a SOQL (Salesforce Object Query Language) query. Use SOQL to search records in Salesforce. Returns query results with total size and records.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `soql` | string | yes | SOQL query string (e.g. `SELECT Id, Name FROM Account LIMIT 10`) |

### Example

```lua
local result = app.integrations.salesforce.salesforce_query({
  soql = "SELECT Id, Name, Email FROM Contact WHERE LastName = 'Smith' LIMIT 10"
})

print("Total records: " .. result.totalSize)
for _, record in ipairs(result.records) do
  print(record.Name .. " - " .. (record.Email or "N/A"))
end
```

---

## salesforce_search

Execute a SOSL (Salesforce Object Search Language) search. Use SOSL for text-based searches across multiple object types. Returns search results grouped by object type.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sosl` | string | yes | SOSL search string (e.g. `FIND {test} IN ALL FIELDS RETURNING Account(Id, Name)`) |

### Example

```lua
local result = app.integrations.salesforce.salesforce_search({
  sosl = "FIND {Acme} IN ALL FIELDS RETURNING Account(Id, Name), Contact(Id, Name)"
})

for _, record in ipairs(result.searchRecords or {}) do
  print(record.attributes.type .. ": " .. record.Name)
end
```

---

## salesforce_describe_object

Get metadata for a Salesforce object type. Returns field definitions, relationships, record types, and other metadata.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `object_type` | string | yes | Salesforce object API name (e.g. Account, Contact, Lead) |

### Example

```lua
local result = app.integrations.salesforce.salesforce_describe_object({
  object_type = "Account"
})

for _, field in ipairs(result.fields or {}) do
  print(field.name .. " (" .. field.type .. ")")
end
```

---

## salesforce_list_objects

List all available Salesforce objects (standard and custom). Returns object names, labels, and key prefixes.

### Parameters

This tool takes no parameters.

### Example

```lua
local result = app.integrations.salesforce.salesforce_list_objects({})

for _, obj in ipairs(result.sobjects or {}) do
  print(obj.name .. " — " .. obj.label)
end
```

---

## salesforce_create_task

Create a new task in Salesforce. Supports subject, description, status, priority, and associations. Returns the created task ID and success status.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subject` | string | yes | Task subject/title |
| `description` | string | no | Task description or body |
| `status` | string | no | Task status (e.g. Not Started, In Progress, Completed) |
| `priority` | string | no | Task priority (e.g. Normal, High, Low) |
| `who_id` | string | no | ID of the related Contact or Lead |
| `what_id` | string | no | ID of the related Account, Opportunity, or other object |
| `activity_date` | string | no | Due date for the task (YYYY-MM-DD) |

### Example

```lua
local result = app.integrations.salesforce.salesforce_create_task({
  subject = "Follow up with client",
  description = "Discuss Q2 renewal terms",
  status = "Not Started",
  priority = "High",
  who_id = "0035f00001ABCdEFGH",
  what_id = "0015f00001ABCdEFGH",
  activity_date = "2026-04-15"
})

print("Created task: " .. result.id)
```

---

## salesforce_create_case

Create a new case in Salesforce. Supports subject, description, status, priority, origin, and associations. Returns the created case ID and success status.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subject` | string | yes | Case subject/title |
| `description` | string | no | Case description or details |
| `status` | string | no | Case status (e.g. New, Working, Escalated, Closed) |
| `priority` | string | no | Case priority (e.g. Low, Medium, High, Critical) |
| `origin` | string | no | Case origin (e.g. Web, Email, Phone) |
| `contact_id` | string | no | ID of the related Contact |
| `account_id` | string | no | ID of the related Account |

### Example

```lua
local result = app.integrations.salesforce.salesforce_create_case({
  subject = "Login issue reported",
  description = "Customer cannot log in to the portal since Monday",
  status = "New",
  priority = "High",
  origin = "Web",
  contact_id = "0035f00001ABCdEFGH",
  account_id = "0015f00001ABCdEFGH"
})

print("Created case: " .. result.id)
```

---

## salesforce_list_recent

List recently accessed items in Salesforce. Returns recently viewed or modified records across all object types.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of items to return (default 25) |

### Example

```lua
local result = app.integrations.salesforce.salesforce_list_recent({
  limit = 10
})

for _, item in ipairs(result) do
  print(item.attributes.type .. ": " .. (item.Name or item.Id))
end
```

---

## salesforce_get_user

Retrieve a Salesforce user by their ID. Returns the user's name, email, profile, role, and other fields.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Salesforce user ID (18 or 15 character) |

### Example

```lua
local result = app.integrations.salesforce.salesforce_get_user({
  id = "0055f00001ABCdEFGH"
})

print("User: " .. result.Name)
print("Email: " .. result.Email)
```
