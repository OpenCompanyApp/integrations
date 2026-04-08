# Client for the HubSpot REST API v1 covering contacts, companies, and deals — Lua API Reference

## hubspot3_list_contacts

List HubSpot contacts.
Returns contact IDs, emails, names, and associated company IDs.
Use limit and offset for pagination, and properties to select specific fields.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of contacts to return (default 20, max 100). |
| `offset` | integer | no | Pagination offset (vid offset for continuing results). |
| `properties` | string | no | Comma-separated list of contact properties to include (e.g. "email,firstname,lastname,company"). |

### Example

```lua
local result = app.integrations.hubspot3.hubspot3_list_contacts({
  limit = 20
  offset = 0
  properties = "email,firstname,lastname,company"
})
```

## hubspot3_get_contact

Retrieve a HubSpot contact by its ID (vid).
Returns the full contact profile including all properties, form submissions, and lists.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | HubSpot contact ID (vid). |

### Example

```lua
local result = app.integrations.hubspot3.hubspot3_get_contact({
  contact_id = "12345"
})
```

## hubspot3_create_contact

Create a new HubSpot contact.
Requires an email address. Optionally set first name, last name, phone, company, and other properties.
Returns the created contact with its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Contact email address. |
| `first_name` | string | no | Contact first name. |
| `last_name` | string | no | Contact last name. |
| `phone` | string | no | Contact phone number. |
| `company` | string | no | Contact company name. |
| `properties` | object | no | Additional custom properties as key-value pairs. |

### Example

```lua
local result = app.integrations.hubspot3.hubspot3_create_contact({
  email = "jane@example.com"
  first_name = "Jane"
  last_name = "Smith"
  company = "Acme Corp"
})
```

## hubspot3_list_companies

List HubSpot companies.
Returns company IDs, names, domains, and other properties.
Use limit and offset for pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of companies to return (default 20, max 100). |
| `offset` | integer | no | Pagination offset (company ID offset for continuing results). |
| `properties` | string | no | Comma-separated list of company properties to include (e.g. "name,domain,industry"). |

### Example

```lua
local result = app.integrations.hubspot3.hubspot3_list_companies({
  limit = 20
  offset = 0
  properties = "name,domain,industry"
})
```

## hubspot3_get_company

Retrieve a HubSpot company by its ID.
Returns the full company profile including name, domain, industry, and other properties.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `company_id` | string | yes | HubSpot company ID. |

### Example

```lua
local result = app.integrations.hubspot3.hubspot3_get_company({
  company_id = "67890"
})
```

## hubspot3_list_deals

List HubSpot deals.
Returns deal IDs, names, stages, amounts, and associated contacts/companies.
Use limit and offset for pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of deals to return (default 20, max 100). |
| `offset` | integer | no | Pagination offset (deal ID offset for continuing results). |
| `properties` | string | no | Comma-separated list of deal properties to include (e.g. "dealname,amount,dealstage"). |

### Example

```lua
local result = app.integrations.hubspot3.hubspot3_list_deals({
  limit = 20
  offset = 0
  properties = "dealname,amount,dealstage"
})
```

## hubspot3_get_current_user

Retrieve the currently authenticated HubSpot user's information.
Returns the user's ID, email, name, and portal information.
Useful for identifying which account or token is in use.

### Example

```lua
local result = app.integrations.hubspot3.hubspot3_get_current_user({
})
```

---

## Multi-Account Usage

If you have multiple hubspot3 accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.hubspot3.function_name({...})

-- Explicit default (portable across setups)
app.integrations.hubspot3.default.function_name({...})

-- Named accounts
app.integrations.hubspot3.production.function_name({...})
app.integrations.hubspot3.sandbox.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
