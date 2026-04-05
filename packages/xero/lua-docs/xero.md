# Xero API service for making requests to the Xero Accounting REST API — Lua API Reference

## xero_create_bank_transaction

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | yes | Transaction type: SPEND, RECEIVE, SPENDTRANSFER, or RECEIVETRANSFER. |
| `contact_id` | string | yes | Xero contact GUID. |
| `line_items` | array | yes | Array of line items, each with Description, Quantity, UnitAmount, AccountCode. |
| `bank_account_id` | string | yes | Xero bank account GUID. |
| `date` | string | no | Transaction date (YYYY-MM-DD). Defaults to today. |
| `reference` | string | no | Transaction reference text. |

### Example

```lua
local result = app.integrations.xero.xero_create_bank_transaction({
  type = ""
  contact_id = ""
  line_items = {}
})
```

## xero_create_contact

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Full name of the contact. |
| `email` | string | no | Contact email address. |
| `phone` | string | no | Contact phone number. |
| `first_name` | string | no | First name of the contact person. |
| `last_name` | string | no | Last name of the contact person. |

### Example

```lua
local result = app.integrations.xero.xero_create_contact({
  name = ""
  email = ""
  phone = ""
})
```

## xero_create_invoice

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | yes | Invoice type, e.g.  |
| `contact_id` | string | no | Xero contact ID. Either contact_id or contact_name is required. |
| `contact_name` | string | no | Contact name to use if contact_id is not provided. |
| `line_items` | array | yes | Array of line items, each with Description, Quantity, UnitAmount, AccountCode. |
| `date` | string | no | Invoice date (YYYY-MM-DD). Defaults to today. |
| `due_date` | string | no | Due date (YYYY-MM-DD). |
| `reference` | string | no | Reference text for the invoice. |
| `status` | string | no | Invoice status, e.g.  |

### Example

```lua
local result = app.integrations.xero.xero_create_invoice({
  type = ""
  contact_id = ""
  contact_name = ""
})
```

## xero_create_payment

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `invoice_id` | string | yes | Xero invoice GUID to pay. |
| `account_id` | string | yes | Xero bank account GUID for the payment. |
| `amount` | number | yes | Payment amount. |
| `date` | string | no | Payment date (YYYY-MM-DD). Defaults to today. |
| `reference` | string | no | Payment reference text. |

### Example

```lua
local result = app.integrations.xero.xero_create_payment({
  invoice_id = ""
  account_id = ""
  amount = 0
})
```

## xero_get_contact

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | Xero contact GUID. |

### Example

```lua
local result = app.integrations.xero.xero_get_contact({
  contact_id = ""
})
```

## xero_get_current_user

No description.

### Example

```lua
local result = app.integrations.xero.xero_get_current_user({
})
```

## xero_get_invoice

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `invoice_id` | string | yes | Xero invoice GUID. |

### Example

```lua
local result = app.integrations.xero.xero_get_invoice({
  invoice_id = ""
})
```

## xero_list_accounts

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `class_type` | string | no | Filter by account class: ASSET, LIABILITY, EQUITY, REVENUE, EXPENSE. |

### Example

```lua
local result = app.integrations.xero.xero_list_accounts({
  class_type = ""
})
```

## xero_list_bank_transactions

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default 1). |

### Example

```lua
local result = app.integrations.xero.xero_list_bank_transactions({
  page = 0
})
```

## xero_list_contacts

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | string | no | Search term to filter contacts by name. |
| `page` | integer | no | Page number for pagination (default 1). |
| `order` | string | no | Sort order, e.g.  |

### Example

```lua
local result = app.integrations.xero.xero_list_contacts({
  search = ""
  page = 0
  order = ""
})
```

## xero_list_invoices

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by status: DRAFT, SUBMITTED, AUTHORISED, PAID, VOIDED. |
| `contact_id` | string | no | Filter by Xero contact GUID. |
| `date_from` | string | no | Start date filter (YYYY-MM-DD). |
| `date_to` | string | no | End date filter (YYYY-MM-DD). |
| `page` | integer | no | Page number for pagination (default 1). |
| `order` | string | no | Sort order, e.g.  |

### Example

```lua
local result = app.integrations.xero.xero_list_invoices({
  status = ""
  contact_id = ""
  date_from = ""
})
```

## xero_list_organisations

No description.

### Example

```lua
local result = app.integrations.xero.xero_list_organisations({
})
```

## xero_list_payments

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by status: AUTHORISED, DELETED. |
| `date_from` | string | no | Start date filter (YYYY-MM-DD). |
| `date_to` | string | no | End date filter (YYYY-MM-DD). |
| `page` | integer | no | Page number for pagination (default 1). |

### Example

```lua
local result = app.integrations.xero.xero_list_payments({
  status = ""
  date_from = ""
  date_to = ""
})
```

## xero_update_contact

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | Xero contact GUID to update. |
| `name` | string | no | Updated contact name. |
| `email` | string | no | Updated email address. |
| `phone` | string | no | Updated phone number. |

### Example

```lua
local result = app.integrations.xero.xero_update_contact({
  contact_id = ""
  name = ""
  email = ""
})
```

## xero_update_invoice

No description.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `invoice_id` | string | yes | Xero invoice GUID to update. |
| `status` | string | no | New invoice status, e.g.  |
| `line_items` | array | no | Updated line items array. Each item needs Description, Quantity, UnitAmount, AccountCode. |

### Example

```lua
local result = app.integrations.xero.xero_update_invoice({
  invoice_id = ""
  status = ""
  line_items = {}
})
```

---

## Multi-Account Usage

If you have multiple xero accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.xero.function_name({...})

-- Explicit default (portable across setups)
app.integrations.xero.default.function_name({...})

-- Named accounts
app.integrations.xero.work.function_name({...})
app.integrations.xero.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
