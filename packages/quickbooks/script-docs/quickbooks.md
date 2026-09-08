# QuickBooks — Ruby API Reference

## list_invoices

List QuickBooks invoices with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of invoices to return (default 10, max 1000) |

### Example

```ruby
result = app.integrations.quickbooks.list_invoices(limit: 10)
result.invoices.each do |invoice|
  puts((invoice.doc_number).to_s + " - $" + (invoice.total_amt).to_s)
end
```
---

## get_invoice

Retrieve a QuickBooks invoice by ID with full details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `invoice_id` | string | yes | QuickBooks invoice ID |

### Example

```ruby
invoice = app.integrations.quickbooks.get_invoice(invoice_id: "42")
puts("Invoice #" + (invoice.doc_number).to_s)
puts("Total: $" + (invoice.total_amt).to_s)
puts("Balance: $" + (invoice.balance).to_s)
```
---

## create_invoice

Create a new QuickBooks invoice for a customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `customer_id` | string | yes | QuickBooks customer ID to bill |
| `line_items` | array | yes | Array of line items. Each item should include DetailType, Amount, and SalesItemLineDetail with ItemRef |
| `due_date` | string | no | Due date for the invoice in YYYY-MM-DD format |

### Example

```ruby
invoice = app.integrations.quickbooks.create_invoice(customer_id: "42", line_items: [{DetailType: "SalesItemLineDetail", Amount: 150, SalesItemLineDetail: {ItemRef: {value: "1"}}}], due_date: "2026-05-01")
puts("Created invoice ID: " + (invoice.id).to_s)
```
---

## list_customers

List QuickBooks customers with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of customers to return (default 10, max 1000) |

### Example

```ruby
result = app.integrations.quickbooks.list_customers(limit: 10)
result.customers.each do |customer|
  puts((customer.display_name).to_s + " - " + ((customer.email || "N/A")).to_s)
end
```
---

## get_customer

Retrieve a QuickBooks customer by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `customer_id` | string | yes | QuickBooks customer ID |

### Example

```ruby
customer = app.integrations.quickbooks.get_customer(customer_id: "42")
puts(customer.display_name)
puts("Email: " + ((customer.email || "N/A")).to_s)
puts("Balance: $" + (customer.balance).to_s)
```
---

## list_accounts

List QuickBooks accounts (chart of accounts).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of accounts to return (default 10, max 1000) |

### Example

```ruby
result = app.integrations.quickbooks.list_accounts(limit: 20)
result.accounts.each do |account|
  puts((account.name).to_s + " (" + (account.classification).to_s + ") - $" + (account.current_balance).to_s)
end
```
---

## get_current_user

Get current user / company info and verify API connection.

### Parameters

None.

### Example

```ruby
info = app.integrations.quickbooks.get_current_user()
puts("Connected to QuickBooks")
```
---

## Multi-Account Usage

If you have multiple QuickBooks accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.quickbooks.list_invoices(limit: 10)
# Explicit default (portable across setups)
app.integrations.quickbooks.default.list_invoices(limit: 10)
# Named accounts (e.g., different companies)
app.integrations.quickbooks.us_company.list_invoices(limit: 10)
app.integrations.quickbooks.uk_company.list_invoices(limit: 10)
```
All functions are identical across accounts — only the credentials differ.
