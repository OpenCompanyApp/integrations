# Client for the Xero Accounting REST API — JavaScript API Reference

## xero_list_invoices

List Xero invoices with pagination and filtering.
Returns invoice IDs, numbers, amounts, status, and dates.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default 1). |
| `pageSize` | integer | no | Number of invoices per page (default 100, max 2000). |
| `statuses` | string | no | Comma-separated filter: DRAFT, SUBMITTED, AUTHORISED, PAID, VOIDED, DELETED. |
| `where` | string | no | Xero where filter expression (e.g. Type=="ACCREC"). |
| `order` | string | no | Sort order (e.g. "Date DESC", "InvoiceNumber ASC"). |

### Example

```js
var result = app.integrations.xero.xero_list_invoices({
  page: 1,
  pageSize: 50,
  statuses: "AUTHORISED",
})
```
## xero_get_invoice

Retrieve a Xero invoice by its ID.
Returns the full invoice including line items, contact details, and totals.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `invoice_id` | string | yes | Xero invoice ID (UUID). |

### Example

```js
var result = app.integrations.xero.xero_get_invoice({
  invoice_id: "abc123-def456-...",
})
```
## xero_create_invoice

Create a new invoice in Xero.
Requires a contact_id and at least one line item with description and unit_amount.
Returns the created invoice with its ID and number.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | Xero contact ID (UUID) to invoice. |
| `type` | string | no | Invoice type: "ACCREC" or "ACCPAY". Default: ACCREC. |
| `date` | string | no | Invoice date (YYYY-MM-DD). Defaults to today. |
| `due_date` | string | no | Due date (YYYY-MM-DD). |
| `reference` | string | no | Reference text for the invoice. |
| `line_items` | array | yes | Array of line items, each with description, quantity, unit_amount, account_code. |
| `status` | string | no | Invoice status: "DRAFT" or "AUTHORISED". Default: DRAFT. |

### Example

```js
var result = app.integrations.xero.xero_create_invoice({
  contact_id: "abc123-def456-...",
  type: "ACCREC",
  date: "2026-04-07",
  due_date: "2026-05-07",
  reference: "Order #12345",
  line_items: [
    { description: "Consulting services", quantity: 10, unit_amount: 150.00, account_code: "200" },
    { description: "Software license", quantity: 1, unit_amount: 500.00, account_code: "400" }
  ],
  status: "AUTHORISED",
})
```
## xero_list_contacts

List Xero contacts with pagination.
Returns contact IDs, names, emails, and types.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default 1). |
| `where` | string | no | Xero where filter expression. |
| `order` | string | no | Sort order (e.g. "Name ASC"). |
| `include_archived` | boolean | no | Include archived contacts (default false). |

### Example

```js
var result = app.integrations.xero.xero_list_contacts({
  page: 1,
  order: "Name ASC",
})
```
## xero_get_contact

Retrieve a Xero contact by its ID.
Returns the contact's ID, name, email, phone, addresses, and status.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | string | yes | Xero contact ID (UUID). |

### Example

```js
var result = app.integrations.xero.xero_get_contact({
  contact_id: "abc123-def456-...",
})
```
## xero_list_accounts

List Xero chart of accounts.
Returns account codes, names, types, tax types, and statuses.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `where` | string | no | Xero where filter expression (e.g. Type=="BANK"). |
| `order` | string | no | Sort order (e.g. "Code ASC"). |

### Example

```js
var result = app.integrations.xero.xero_list_accounts({
  order: "Code ASC",
})
```
## xero_get_current_user

Retrieve the currently authenticated Xero user.
Returns the user's ID, name, and email.
Useful for identifying which Xero organisation or token is in use.

### Example

```js
var result = app.integrations.xero.xero_get_current_user({
})
```
---

## Multi-Account Usage

If you have multiple xero accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.xero.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.xero.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.xero.work.function_name({ /* parameters */ })
app.integrations.xero.personal.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
