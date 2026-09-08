# Zoho Invoice — Ruby API Reference

## Common Workflows

### Create an invoice for a customer

```ruby
# Step 1: Find the customer
contacts = app.call("integrations.zoho-invoice.zohoinvoice_list_contacts", search_text: "Acme Corp")
customer_id = contacts.contacts[0].contact_id
# Step 2: Find items to add
items = app.call("integrations.zoho-invoice.zohoinvoice_list_items", search_text: "Consulting")
item_id = items.items[0].item_id
# Step 3: Create the invoice
invoice = app.call("integrations.zoho-invoice.zohoinvoice_create", customer_id: customer_id, line_items: [{item_id: item_id, quantity: 10}], date: "2025-01-15", due_date: "2025-02-15", notes: "Thank you for your business!")
puts("Invoice created: " + (invoice.invoice.invoice_id).to_s)
puts("Total: " + (invoice.invoice.total).to_s)
```
### List overdue invoices

```ruby
result = app.call("integrations.zoho-invoice.zohoinvoice_list", status: "overdue", sort_column: "date", sort_order: "ascending")
result.invoices.each do |inv|
  puts((inv.invoice_number).to_s + " - " + (inv.customer_name).to_s + " - " + (inv.balance).to_s)
end
```
### Get payments for a date range

```ruby
payments = app.call("integrations.zoho-invoice.zohoinvoice_list_payments", date_start: "2025-01-01", date_end: "2025-01-31")
total = 0
payments.payments.each do |payment|
  total = (total + (payment.amount).to_f)
  puts((payment.date).to_s + " - " + (payment.customer_name).to_s + " - " + (payment.amount).to_s)
end
puts("Total received: " + (total).to_s)
```
### Check your connection

```ruby
user = app.call("integrations.zoho-invoice.zohoinvoice_get_current_user")
puts("Connected as: " + (user.user.name).to_s + " (" + (user.user.email).to_s + ")")
```
## Invoice Statuses

| Status | Description |
|--------|-------------|
| `draft` | Invoice is in draft state |
| `sent` | Invoice has been sent to the customer |
| `overdue` | Payment is past the due date |
| `paid` | Invoice has been fully paid |
| `void` | Invoice has been voided |
| `partially_paid` | Invoice has been partially paid |

## Contact Types

| Type | Description |
|------|-------------|
| `customer` | Customer contacts |
| `vendor` | Vendor contacts |

## Item Types

| Type | Description |
|------|-------------|
| `goods` | Physical products |
| `service` | Service items |

## Line Item Format

When creating invoices, each line item should include:

```ruby
example = {item_id: "1234567890", quantity: 1, rate: 100, description: "Custom description"}
```
Alternatively, create line items without an existing item:

```ruby
example = {name: "Custom Service", description: "One-time custom work", rate: 150, quantity: 5}
```
## Pagination

All list endpoints support `page` and `per_page` parameters:

```ruby
result = app.call("integrations.zoho-invoice.zohoinvoice_list", page: 2, per_page: 50)
```
## Multi-Account Usage

If you have multiple Zoho Invoice accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.call("integrations.zoho-invoice.zohoinvoice_list")
# Explicit default (portable across setups)
app.call("integrations.zoho-invoice.default.zohoinvoice_list")
# Named accounts
app.call("integrations.zoho-invoice.work.zohoinvoice_list")
app.call("integrations.zoho-invoice.personal.zohoinvoice_list")
```
All functions are identical across accounts — only the credentials differ.

## Notes

- The Organization ID is required for most API calls. Set it in the integration settings.
- Date formats use ISO 8601 (YYYY-MM-DD).
- The base URL varies by region — make sure to configure the correct one for your Zoho account.
- Rate limits: 100 requests per minute per organization.
