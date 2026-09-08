# Client for the Zoho CRM REST API v7 covering leads, contacts, accounts, deals, and users — Ruby API Reference

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

```ruby
result = app.call("integrations.zoho-crm.create_account", account_name: "", website: "", phone: "")
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

```ruby
result = app.call("integrations.zoho-crm.create_contact", first_name: "", last_name: "", email: "")
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

```ruby
result = app.call("integrations.zoho-crm.create_deal", deal_name: "", amount: 0, stage: "")
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

```ruby
result = app.call("integrations.zoho-crm.create_lead", first_name: "", last_name: "", company: "")
```
## zoho_crm_get_account

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `account_id` | string | yes | Zoho CRM account ID. |

### Example

```ruby
result = app.call("integrations.zoho-crm.get_account", account_id: "")
```
## zoho_crm_get_contact

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | Zoho CRM contact ID. |

### Example

```ruby
result = app.call("integrations.zoho-crm.get_contact", contact_id: "")
```
## zoho_crm_get_current_user

No description.

### Example

```ruby
result = app.call("integrations.zoho-crm.get_current_user")
```
## zoho_crm_get_deal

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `deal_id` | string | yes | Zoho CRM deal ID. |

### Example

```ruby
result = app.call("integrations.zoho-crm.get_deal", deal_id: "")
```
## zoho_crm_get_lead

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `lead_id` | string | yes | Zoho CRM lead ID. |

### Example

```ruby
result = app.call("integrations.zoho-crm.get_lead", lead_id: "")
```
## zoho_crm_list_deals

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default 1). |
| `per_page` | integer | no | Number of records per page (default 20, max 200). |

### Example

```ruby
result = app.call("integrations.zoho-crm.list_deals", page: 0, per_page: 0)
```
## zoho_crm_list_users

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | no | User type filter (e.g. ActiveUsers, Admins, ActiveConfirmedAdmins). |
| `page` | integer | no | Page number (default 1). |

### Example

```ruby
result = app.call("integrations.zoho-crm.list_users", type: "", page: 0)
```
## zoho_crm_search_contacts

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `criteria` | string | no | Search criteria expression, e.g. (Email:equals:john@example.com). |
| `email` | string | no | Email address to search for (shortcut for criteria). |

### Example

```ruby
result = app.call("integrations.zoho-crm.search_contacts", criteria: "", email: "")
```
## zoho_crm_search_leads

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `criteria` | string | no | Search criteria expression, e.g. (Email:equals:john@example.com). |
| `email` | string | no | Email address to search for (shortcut for criteria). |

### Example

```ruby
result = app.call("integrations.zoho-crm.search_leads", criteria: "", email: "")
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

```ruby
result = app.call("integrations.zoho-crm.update_contact", contact_id: "", first_name: "", last_name: "")
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

```ruby
result = app.call("integrations.zoho-crm.update_lead", lead_id: "", first_name: "", last_name: "")
```
---

## Multi-Account Usage

If you have multiple zoho-crm accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
