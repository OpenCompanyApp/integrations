# Client for the Zoho CRM REST API v7 covering leads, contacts, accounts, deals, and users — JavaScript API Reference

## zoho_crm_create_account

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `account_name` | string | no | Account (company) name. |
| `website` | string | no | Account website URL. |
| `phone` | string | no | Account phone number. |
| `industry` | string | no | Industry type (e.g. Technology, Finance). |

### Example

```js
var result = app.integrations["zoho-crm"].zoho_crm_create_account({
  account_name: "",
  website: "",
  phone: "",
})
```
## zoho_crm_create_contact

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | no | Contact first name. |
| `last_name` | string | no | Contact last name. |
| `email` | string | no | Contact email address. |
| `phone` | string | no | Contact phone number. |

### Example

```js
var result = app.integrations["zoho-crm"].zoho_crm_create_contact({
  first_name: "",
  last_name: "",
  email: "",
})
```
## zoho_crm_create_deal

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `deal_name` | string | no | Deal name. |
| `amount` | number | no | Deal amount. |
| `stage` | string | no | Deal stage (e.g. Qualification, Negotiation, Closed Won). |
| `closing_date` | string | no | Expected closing date (YYYY-MM-DD). |
| `account_id` | string | no | Zoho CRM account ID to associate with the deal. |

### Example

```js
var result = app.integrations["zoho-crm"].zoho_crm_create_deal({
  deal_name: "",
  amount: 0,
  stage: "",
})
```
## zoho_crm_create_lead

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | no | Lead first name. |
| `last_name` | string | no | Lead last name. |
| `company` | string | no | Lead company name. |
| `email` | string | no | Lead email address. |
| `phone` | string | no | Lead phone number. |

### Example

```js
var result = app.integrations["zoho-crm"].zoho_crm_create_lead({
  first_name: "",
  last_name: "",
  company: "",
})
```
## zoho_crm_get_account

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `account_id` | string | yes | Zoho CRM account ID. |

### Example

```js
var result = app.integrations["zoho-crm"].zoho_crm_get_account({
  account_id: "",
})
```
## zoho_crm_get_contact

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | Zoho CRM contact ID. |

### Example

```js
var result = app.integrations["zoho-crm"].zoho_crm_get_contact({
  contact_id: "",
})
```
## zoho_crm_get_current_user

No description.

### Example

```js
var result = app.integrations["zoho-crm"].zoho_crm_get_current_user({
})
```
## zoho_crm_get_deal

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `deal_id` | string | yes | Zoho CRM deal ID. |

### Example

```js
var result = app.integrations["zoho-crm"].zoho_crm_get_deal({
  deal_id: "",
})
```
## zoho_crm_get_lead

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `lead_id` | string | yes | Zoho CRM lead ID. |

### Example

```js
var result = app.integrations["zoho-crm"].zoho_crm_get_lead({
  lead_id: "",
})
```
## zoho_crm_list_deals

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default 1). |
| `per_page` | integer | no | Number of records per page (default 20, max 200). |

### Example

```js
var result = app.integrations["zoho-crm"].zoho_crm_list_deals({
  page: 0,
  per_page: 0,
})
```
## zoho_crm_list_users

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | no | User type filter (e.g. ActiveUsers, Admins, ActiveConfirmedAdmins). |
| `page` | integer | no | Page number (default 1). |

### Example

```js
var result = app.integrations["zoho-crm"].zoho_crm_list_users({
  type: "",
  page: 0,
})
```
## zoho_crm_search_contacts

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `criteria` | string | no | Search criteria expression, e.g. (Email:equals:john@example.com). |
| `email` | string | no | Email address to search for (shortcut for criteria). |

### Example

```js
var result = app.integrations["zoho-crm"].zoho_crm_search_contacts({
  criteria: "",
  email: "",
})
```
## zoho_crm_search_leads

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `criteria` | string | no | Search criteria expression, e.g. (Email:equals:john@example.com). |
| `email` | string | no | Email address to search for (shortcut for criteria). |

### Example

```js
var result = app.integrations["zoho-crm"].zoho_crm_search_leads({
  criteria: "",
  email: "",
})
```
## zoho_crm_update_contact

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | Zoho CRM contact ID. |
| `first_name` | string | no | Updated first name. |
| `last_name` | string | no | Updated last name. |
| `email` | string | no | Updated email address. |
| `phone` | string | no | Updated phone number. |

### Example

```js
var result = app.integrations["zoho-crm"].zoho_crm_update_contact({
  contact_id: "",
  first_name: "",
  last_name: "",
})
```
## zoho_crm_update_lead

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `lead_id` | string | yes | Zoho CRM lead ID. |
| `first_name` | string | no | Updated first name. |
| `last_name` | string | no | Updated last name. |
| `company` | string | no | Updated company name. |
| `email` | string | no | Updated email address. |
| `phone` | string | no | Updated phone number. |

### Example

```js
var result = app.integrations["zoho-crm"].zoho_crm_update_lead({
  lead_id: "",
  first_name: "",
  last_name: "",
})
```
---

## Multi-Account Usage

If you have multiple zoho-crm accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations["zoho-crm"].function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations["zoho-crm"].default.function_name({ /* parameters */ })

// Named accounts
app.integrations["zoho-crm"].work.function_name({ /* parameters */ })
app.integrations["zoho-crm"].personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
