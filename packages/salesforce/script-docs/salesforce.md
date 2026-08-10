# Salesforce — JavaScript API Reference

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

```js
var result = app.integrations.salesforce.salesforce_create_lead({
  first_name: "Jane",
  last_name: "Smith",
  company: "Acme Corp",
  email: "jane@acme.com",
  phone: "+1-555-0123",
  title: "VP of Engineering",
})

console.log("Created lead: " + result.id)
```
---

## salesforce_get_lead

Retrieve a Salesforce lead by its ID. Returns the lead's fields, attributes, and associated data.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Salesforce lead ID (18 or 15 character) |

### Example

```js
var result = app.integrations.salesforce.salesforce_get_lead({
  id: "00Q5f00001ABCdEFGH",
})

console.log("Lead: " + result.FirstName + " " + result.LastName)
console.log("Company: " + result.Company)
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

```js
var result = app.integrations.salesforce.salesforce_update_lead({
  id: "00Q5f00001ABCdEFGH",
  phone: "+1-555-9999",
  email: "jane.smith@acme.com",
})

console.log("Updated: " + String(result.updated))
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

```js
var result = app.integrations.salesforce.salesforce_create_contact({
  first_name: "John",
  last_name: "Doe",
  email: "john@example.com",
  phone: "+1-555-0456",
  account_id: "0015f00001ABCdEFGH",
})

console.log("Created contact: " + result.id)
```
---

## salesforce_get_contact

Retrieve a Salesforce contact by its ID. Returns the contact's fields, attributes, and associated data.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Salesforce contact ID (18 or 15 character) |

### Example

```js
var result = app.integrations.salesforce.salesforce_get_contact({
  id: "0035f00001ABCdEFGH",
})

console.log("Contact: " + result.FirstName + " " + result.LastName)
console.log("Email: " + result.Email)
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

```js
var result = app.integrations.salesforce.salesforce_create_account({
  name: "Acme Corp",
  website: "https://acme.com",
  phone: "+1-555-0789",
  industry: "Technology",
  billing_city: "San Francisco",
  billing_country: "US",
})

console.log("Created account: " + result.id)
```
---

## salesforce_get_account

Retrieve a Salesforce account by its ID. Returns the account's fields, attributes, and associated data.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Salesforce account ID (18 or 15 character) |

### Example

```js
var result = app.integrations.salesforce.salesforce_get_account({
  id: "0015f00001ABCdEFGH",
})

console.log("Account: " + result.Name)
console.log("Industry: " + (result.Industry || "N/A"))
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

```js
var result = app.integrations.salesforce.salesforce_update_account({
  id: "0015f00001ABCdEFGH",
  phone: "+1-555-1111",
  website: "https://acme-new.com",
})

console.log("Updated: " + String(result.updated))
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

```js
var result = app.integrations.salesforce.salesforce_create_opportunity({
  name: "Acme Corp - New Deal",
  amount: 50000,
  stage_name: "Prospecting",
  close_date: "2026-06-30",
  account_id: "0015f00001ABCdEFGH",
  probability: 25,
})

console.log("Created opportunity: " + result.id)
```
---

## salesforce_get_opportunity

Retrieve a Salesforce opportunity by its ID. Returns the opportunity's fields, attributes, and associated data.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Salesforce opportunity ID (18 or 15 character) |

### Example

```js
var result = app.integrations.salesforce.salesforce_get_opportunity({
  id: "0065f00001ABCdEFGH",
})

console.log("Opportunity: " + result.Name)
console.log("Amount: " + (result.Amount || "N/A"))
console.log("Stage: " + result.StageName)
```
---

## salesforce_query

Execute a SOQL (Salesforce Object Query Language) query. Use SOQL to search records in Salesforce. Returns query results with total size and records.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `soql` | string | yes | SOQL query string (e.g. `SELECT Id, Name FROM Account LIMIT 10`) |

### Example

```js
var result = app.integrations.salesforce.salesforce_query({
  soql: "SELECT Id, Name, Email FROM Contact WHERE LastName = 'Smith' LIMIT 10",
})

console.log("Total records: " + result.totalSize)
for (const record of (result.records)) {
  console.log(record.Name + " - " + (record.Email || "N/A"))
}
```
---

## salesforce_search

Execute a SOSL (Salesforce Object Search Language) search. Use SOSL for text-based searches across multiple object types. Returns search results grouped by object type.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sosl` | string | yes | SOSL search string (e.g. `FIND {test} IN ALL FIELDS RETURNING Account(Id, Name)`) |

### Example

```js
var result = app.integrations.salesforce.salesforce_search({
  sosl: "FIND {Acme} IN ALL FIELDS RETURNING Account(Id, Name), Contact(Id, Name)",
})

for (const record of (result.searchRecords || [])) {
  console.log(record.attributes.type + ": " + record.Name)
}
```
---

## salesforce_describe_object

Get metadata for a Salesforce object type. Returns field definitions, relationships, record types, and other metadata.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `object_type` | string | yes | Salesforce object API name (e.g. Account, Contact, Lead) |

### Example

```js
var result = app.integrations.salesforce.salesforce_describe_object({
  object_type: "Account",
})

for (const field of (result.fields || [])) {
  console.log(field.name + " (" + field.type + ")")
}
```
---

## salesforce_list_objects

List all available Salesforce objects (standard and custom). Returns object names, labels, and key prefixes.

### Parameters

This tool takes no parameters.

### Example

```js
var result = app.integrations.salesforce.salesforce_list_objects({})

for (const obj of (result.sobjects || [])) {
  console.log(obj.name + " — " + obj.label)
}
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

```js
var result = app.integrations.salesforce.salesforce_create_task({
  subject: "Follow up with client",
  description: "Discuss Q2 renewal terms",
  status: "Not Started",
  priority: "High",
  who_id: "0035f00001ABCdEFGH",
  what_id: "0015f00001ABCdEFGH",
  activity_date: "2026-04-15",
})

console.log("Created task: " + result.id)
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

```js
var result = app.integrations.salesforce.salesforce_create_case({
  subject: "Login issue reported",
  description: "Customer cannot log in to the portal since Monday",
  status: "New",
  priority: "High",
  origin: "Web",
  contact_id: "0035f00001ABCdEFGH",
  account_id: "0015f00001ABCdEFGH",
})

console.log("Created case: " + result.id)
```
---

## salesforce_list_recent

List recently accessed items in Salesforce. Returns recently viewed or modified records across all object types.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of items to return (default 25) |

### Example

```js
var result = app.integrations.salesforce.salesforce_list_recent({
  limit: 10,
})

for (const item of (result)) {
  console.log(item.attributes.type + ": " + (item.Name || item.Id))
}
```
---

## salesforce_get_user

Retrieve a Salesforce user by their ID. Returns the user's name, email, profile, role, and other fields.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Salesforce user ID (18 or 15 character) |

### Example

```js
var result = app.integrations.salesforce.salesforce_get_user({
  id: "0055f00001ABCdEFGH",
})

console.log("User: " + result.Name)
console.log("Email: " + result.Email)
```
---

## Multi-Account Usage

If you have multiple salesforce accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.salesforce.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.salesforce.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.salesforce.work.function_name({ /* parameters */ })
app.integrations.salesforce.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
