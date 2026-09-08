# FreeAgent — Ruby API Reference

## list_invoices

List invoices from FreeAgent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by status: `Draft`, `Sent`, `Cancelled`, `Late`, `Paid` |
| `from_date` | string | no | Start date (ISO 8601, e.g., `"2025-01-01"`) |
| `to_date` | string | no | End date (ISO 8601, e.g., `"2025-12-31"`) |
| `contact` | string | no | Filter by contact URL or ID |
| `project` | string | no | Filter by project URL or ID |
| `page` | integer | no | Page number for pagination |
| `per_page` | integer | no | Results per page (default: 30) |

### Example

```ruby
result = app.integrations.freeagent.list_invoices(status: "Sent", from_date: "2025-01-01", per_page: 50)
result.invoices.each do |invoice|
  puts((invoice.reference).to_s + ": " + (invoice.total).to_s + " " + (invoice.currency).to_s)
end
```
---

## get_invoice

Get full details of a specific invoice.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `invoice_id` | integer | yes | The ID of the invoice |

### Example

```ruby
result = app.integrations.freeagent.get_invoice(invoice_id: 12345)
puts("Invoice: " + (result.invoice.reference).to_s)
puts("Total: " + (result.invoice.total).to_s + " " + (result.invoice.currency).to_s)
puts("Status: " + (result.invoice.status).to_s)
result.invoice.invoice_items.each do |item|
  puts("  - " + (item.description).to_s + ": " + (item.price).to_s)
end
```
---

## create_invoice

Create a new invoice in FreeAgent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact` | string | yes | Contact URL or ID (e.g., `"https://api.freeagent.com/v2/contacts/123"`) |
| `dated_on` | string | yes | Invoice date (ISO 8601) |
| `invoice_items` | array | yes | Line items, each with `description`, `quantity`, `price` |
| `due_on` | string | no | Due date (ISO 8601) |
| `reference` | string | no | Reference number |
| `currency` | string | no | Currency code (`GBP`, `USD`, `EUR`) |
| `comments` | string | no | Invoice comments |
| `project` | string | no | Project URL to associate |

### Example

```ruby
result = app.integrations.freeagent.create_invoice(contact: "https://api.freeagent.com/v2/contacts/123", dated_on: "2025-04-01", due_on: "2025-04-30", reference: "INV-001", currency: "GBP", invoice_items: [{description: "Web development", quantity: 10, price: 75}, {description: "Hosting setup", quantity: 1, price: 150}])
puts("Created invoice: " + (result.invoice.reference).to_s)
```
---

## list_contacts

List contacts from FreeAgent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `view` | string | no | Filter: `all`, `customers`, `suppliers`, `active`, `inactive` |
| `order` | string | no | Sort: `name`, `created_at`, `updated_at`. Prefix `-` for descending |
| `created_since` | string | no | Only contacts created after this date |
| `updated_since` | string | no | Only contacts updated after this date |
| `page` | integer | no | Page number |
| `per_page` | integer | no | Results per page (default: 30) |

### Example

```ruby
result = app.integrations.freeagent.list_contacts(view: "customers", order: "name", per_page: 50)
result.contacts.each do |contact|
  puts((contact.organisation_name || (contact.first_name).to_s + " " + (contact.last_name).to_s))
end
```
---

## get_contact

Get full details of a specific contact.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `contact_id` | integer | yes | The ID of the contact |

### Example

```ruby
result = app.integrations.freeagent.get_contact(contact_id: 456)
c = result.contact
puts((c.organisation_name || (c.first_name).to_s + " " + (c.last_name).to_s))
puts("Email: " + ((c.email || "N/A")).to_s)
puts("Type: " + (c.contact_type).to_s)
```
---

## create_contact

Create a new contact in FreeAgent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | no | First name (for individuals) |
| `last_name` | string | no | Last name (for individuals) |
| `organisation_name` | string | no | Company name (for companies) |
| `email` | string | no | Primary email |
| `phone_number` | string | no | Phone number |
| `contact_type` | string | no | `Customer` (default) or `Supplier` |
| `billing_email` | string | no | Billing email |
| `address1` | string | no | Address line 1 |
| `address2` | string | no | Address line 2 |
| `town` | string | no | Town or city |
| `region` | string | no | State or province |
| `postcode` | string | no | Postal code |
| `country` | string | no | Country code (e.g., `GB`, `US`, `NL`) |

> At least one of `first_name`, `last_name`, or `organisation_name` is required.

### Example

```ruby
result = app.integrations.freeagent.create_contact(organisation_name: "Acme Corp", email: "billing@acme.com", contact_type: "Customer", country: "GB")
puts("Created contact: " + (result.contact.organisation_name).to_s)
```
---

## list_projects

List projects from FreeAgent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `view` | string | no | Filter: `all`, `active`, `completed`, `cancelled`, `unquoted` |
| `contact` | string | no | Filter by contact URL or ID |
| `page` | integer | no | Page number |
| `per_page` | integer | no | Results per page (default: 30) |

### Example

```ruby
result = app.integrations.freeagent.list_projects(view: "active")
result.projects.each do |project|
  puts((project.name).to_s + " (" + (project.status).to_s + ")")
  puts("  Budget: " + (project.budget).to_s + " " + (project.currency).to_s)
end
```
---

## list_expenses

List expenses from FreeAgent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from_date` | string | no | Start date (ISO 8601) |
| `to_date` | string | no | End date (ISO 8601) |
| `contact` | string | no | Filter by contact URL or ID |
| `project` | string | no | Filter by project URL or ID |
| `page` | integer | no | Page number |
| `per_page` | integer | no | Results per page (default: 30) |

### Example

```ruby
result = app.integrations.freeagent.list_expenses(from_date: "2025-01-01", to_date: "2025-03-31", per_page: 100)
result.expenses.each do |expense|
  puts((expense.description).to_s + ": " + (expense.total).to_s + " " + (expense.currency).to_s)
end
```
---

## get_current_user

Get the currently authenticated FreeAgent user.

### Parameters

None.

### Example

```ruby
result = app.integrations.freeagent.get_current_user()
user = result.user
puts("Name: " + (user.first_name).to_s + " " + (user.last_name).to_s)
puts("Email: " + (user.email).to_s)
puts("Role: " + (user.role).to_s)
```
---

## Multi-Account Usage

If you have multiple FreeAgent accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.freeagent.list_invoices()
# Explicit default (portable across setups)
app.integrations.freeagent.default.list_invoices()
# Named accounts
app.integrations.freeagent.uk.list_invoices()
app.integrations.freeagent.us.list_invoices()
```
All functions are identical across accounts — only the credentials differ.
