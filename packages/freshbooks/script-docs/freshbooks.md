# FreshBooks — Ruby API Reference

## list_invoices

List invoices from FreshBooks with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | object | no | Search filters (see below) |
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 15, max: 100) |

### Search Filter Keys

| Key | Description |
|-----|-------------|
| `status` | Invoice status: `draft`, `sent`, `viewed`, `paid`, `disputed`, `overdue` |
| `clientid` | Filter by client ID |
| `date_from` | Start date (YYYY-MM-DD) |
| `date_to` | End date (YYYY-MM-DD) |
| `invoice_number` | Filter by invoice number |

### Example

```ruby
result = app.integrations.freshbooks.list_invoices(search: {status: "sent"}, per_page: 25)
result.invoices.each do |invoice|
  puts((invoice.invoice_number).to_s + ": " + (invoice.amount.amount).to_s + " " + (invoice.status).to_s)
end
```
---

## get_invoice

Get full details of a specific invoice.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `invoice_id` | integer | yes | The FreshBooks invoice ID |

### Example

```ruby
result = app.integrations.freshbooks.get_invoice(invoice_id: 12345)
inv = result.invoice
puts((inv.invoice_number).to_s + " - " + (inv.status).to_s)
inv.lines.each do |line|
  puts("  " + (line.name).to_s + ": " + (line.unit_cost.amount).to_s)
end
```
---

## create_invoice

Create a new invoice in FreshBooks.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `client_id` | integer | yes | The client ID to bill |
| `lines` | array | yes | Array of line items (see below) |
| `date` | string | no | Invoice date (YYYY-MM-DD), defaults to today |
| `due_date` | string | no | Due date (YYYY-MM-DD) |
| `invoice_number` | string | no | Custom invoice number |
| `notes` | string | no | Notes displayed on the invoice |
| `terms` | string | no | Payment terms (e.g., "Net 30") |
| `discount_value` | number | no | Discount amount or percentage |
| `discount_type` | string | no | `percentage` or `amount` |

### Line Item Format

Each line item is an object with:

| Key | Type | Required | Description |
|-----|------|----------|-------------|
| `name` | string | yes | Line item name |
| `description` | string | no | Line item description |
| `qty` | number | yes | Quantity |
| `unit_cost` | object | yes | Object with `amount` (string) and `code` (currency code) |

### Example

```ruby
result = app.integrations.freshbooks.create_invoice(client_id: 100, lines: [{name: "Web Development", description: "Frontend development work", qty: 40, unit_cost: {amount: "150.00", code: "USD"}}], notes: "Thank you for your business!", terms: "Net 30")
puts("Created invoice: " + (result.invoice.invoice_number).to_s)
```
---

## list_clients

List clients from FreshBooks.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | object | no | Search filters (see below) |
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 15, max: 100) |

### Search Filter Keys

| Key | Description |
|-----|-------------|
| `email` | Filter by email address |
| `fname` | Filter by first name |
| `lname` | Filter by last name |
| `organization` | Filter by organization name |
| `state` | `active` or `archived` |

### Example

```ruby
result = app.integrations.freshbooks.list_clients(search: {organization: "Acme"}, per_page: 50)
result.clients.each do |client|
  puts((client.organization).to_s + " - " + (client.email).to_s)
end
```
---

## get_client

Get details of a specific client.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `client_id` | integer | yes | The FreshBooks client ID |

### Example

```ruby
result = app.integrations.freshbooks.get_client(client_id: 100)
client = result.client
puts((client.organization).to_s + " - Balance: " + (client.outstanding_balance.amount).to_s)
```
---

## list_projects

List projects from FreshBooks.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | object | no | Search filters (see below) |
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 15, max: 100) |

### Search Filter Keys

| Key | Description |
|-----|-------------|
| `title` | Filter by project title |
| `active` | `true` or `false` |
| `clientid` | Filter by client ID |

### Example

```ruby
result = app.integrations.freshbooks.list_projects(search: {active: true})
result.projects.each do |project|
  puts((project.title).to_s + " - " + (project.billing_method).to_s)
end
```
---

## list_payments

List payments from FreshBooks.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | object | no | Search filters (see below) |
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 15, max: 100) |

### Search Filter Keys

| Key | Description |
|-----|-------------|
| `clientid` | Filter by client ID |
| `invoiceid` | Filter by invoice ID |
| `date_from` | Start date (YYYY-MM-DD) |
| `date_to` | End date (YYYY-MM-DD) |
| `type` | Payment type: `check`, `credit`, `card`, `bank` |

### Example

```ruby
result = app.integrations.freshbooks.list_payments(search: {date_from: "2025-01-01", date_to: "2025-01-31"}, per_page: 50)
result.payments.each do |payment|
  puts((payment.date).to_s + ": " + (payment.amount.amount).to_s + " via " + (payment.type).to_s)
end
```
---

## get_current_user

Get the profile of the currently authenticated FreshBooks user.

### Parameters

None.

### Example

```ruby
result = app.integrations.freshbooks.get_current_user()
result.users.each do |user|
  puts((user.first_name).to_s + " " + (user.last_name).to_s + " - " + (user.email).to_s)
end
```
---

## Multi-Account Usage

If you have multiple FreshBooks accounts configured, use account-specific namespaces:

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
