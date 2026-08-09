# Zoho Invoice — JavaScript API Reference

## Common Workflows

### Create an invoice for a customer

```js
// Step 1: Find the customer
var contacts = app.integrations["zoho-invoice"].zohoinvoice_list_contacts({
    search_text: "Acme Corp",
})
var customer_id = contacts.contacts[0].contact_id

// Step 2: Find items to add
var items = app.integrations["zoho-invoice"].zohoinvoice_list_items({
    search_text: "Consulting",
})
var item_id = items.items[0].item_id

// Step 3: Create the invoice
var invoice = app.integrations["zoho-invoice"].zohoinvoice_create_invoice({
    customer_id: customer_id,
    line_items: [
        {
            item_id: item_id,
            quantity: 10,
        }
    ],
    date: "2025-01-15",
    due_date: "2025-02-15",
    notes: "Thank you for your business!",
})

console.log("Invoice created: " + invoice.invoice.invoice_id)
console.log("Total: " + invoice.invoice.total)
```
### List overdue invoices

```js
var result = app.integrations["zoho-invoice"].zohoinvoice_list_invoices({
    status: "overdue",
    sort_column: "date",
    sort_order: "ascending",
})

for (const inv of (result.invoices)) {
    console.log(inv.invoice_number + " - " + inv.customer_name + " - " + inv.balance)
}
```
### Get payments for a date range

```js
var payments = app.integrations["zoho-invoice"].zohoinvoice_list_payments({
    date_start: "2025-01-01",
    date_end: "2025-01-31",
})

var total = 0
for (const payment of (payments.payments)) {
    total = total + Number(payment.amount)
    console.log(payment.date + " - " + payment.customer_name + " - " + payment.amount)
}
console.log("Total received: " + total)
```
### Check your connection

```js
var user = app.integrations["zoho-invoice"].zohoinvoice_get_current_user({})
console.log("Connected as: " + user.user.name + " (" + user.user.email + ")")
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

```js
const example = {
    item_id: "1234567890", // Required: use item_id from list_items, || provide name + rate,
    quantity: 1, // Quantity (default: 1),
    rate: 100.00, // Override rate (optional if item_id has a default rate),
    description: "Custom description" // Optional override,
}
```
Alternatively, create line items without an existing item:

```js
const example = {
    name: "Custom Service",
    description: "One-time custom work",
    rate: 150.00,
    quantity: 5,
}
```
## Pagination

All list endpoints support `page` and `per_page` parameters:

```js
var result = app.integrations["zoho-invoice"].zohoinvoice_list_invoices({
    page: 2,
    per_page: 50,
})
```
## Multi-Account Usage

If you have multiple Zoho Invoice accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations["zoho-invoice"].zohoinvoice_list_invoices({})

// Explicit default (portable across setups)
app.integrations["zoho-invoice"].default.zohoinvoice_list_invoices({})

// Named accounts
app.integrations["zoho-invoice"].work.zohoinvoice_list_invoices({})
app.integrations["zoho-invoice"].personal.zohoinvoice_list_invoices({})
```
All functions are identical across accounts — only the credentials differ.

## Notes

- The Organization ID is required for most API calls. Set it in the integration settings.
- Date formats use ISO 8601 (YYYY-MM-DD).
- The base URL varies by region — make sure to configure the correct one for your Zoho account.
- Rate limits: 100 requests per minute per organization.
