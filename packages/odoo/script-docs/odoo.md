# Odoo ERP — Ruby API Reference

## list_contacts

List contacts (customers, vendors) from Odoo with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 100) |
| `name` | string | no | Filter by name (partial match) |
| `email` | string | no | Filter by email (partial match) |
| `is_company` | boolean | no | `true` for companies only, `false` for individuals |

### Example

```ruby
result = app.integrations.odoo.list_contacts(page: 1, limit: 20, name: "Acme")
result.contacts.each do |contact|
  puts((contact.name).to_s + " — " + ((contact.email || "no email")).to_s)
end
```
---

## get_contact

Get full details of a specific Odoo contact by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Odoo contact ID |

### Example

```ruby
result = app.integrations.odoo.get_contact(id: 42)
puts(result.name)
puts(result.email)
puts(result.phone)
```
---

## create_contact

Create a new contact (customer or vendor) in Odoo.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Full name of the contact |
| `email` | string | no | Email address |
| `phone` | string | no | Phone number |
| `is_company` | boolean | no | Whether this is a company (default: false) |
| `company_type` | string | no | `"company"` or `"person"` (default: `"person"`) |
| `street` | string | no | Street address |
| `city` | string | no | City |
| `zip` | string | no | Postal / ZIP code |
| `country` | string | no | Country name or code |
| `website` | string | no | Website URL |
| `vat` | string | no | Tax ID / VAT number |
| `type` | string | no | Contact type: `"contact"`, `"invoice"`, `"delivery"`, `"other"` |
| `parent_id` | integer | no | Parent company ID |
| `function` | string | no | Job position / title |

### Example

```ruby
result = app.integrations.odoo.create_contact(name: "Acme Corp", email: "info@acme.com", is_company: true, country: "US", vat: "US123456789")
puts("Created contact ID: " + (result.id).to_s)
```
---

## list_sales_orders

List sales orders from Odoo with pagination and filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 100) |
| `status` | string | no | Filter by status: `"draft"`, `"sent"`, `"sale"`, `"done"`, `"cancel"` |
| `partner_id` | integer | no | Filter by customer (partner) ID |
| `date_from` | string | no | From date (ISO 8601, e.g., `"2025-01-01"`) |
| `date_to` | string | no | To date (ISO 8601, e.g., `"2025-12-31"`) |

### Example

```ruby
result = app.integrations.odoo.list_sales_orders(status: "sale", page: 1, limit: 10)
result.orders.each do |order|
  puts((order.name).to_s + " — " + (order.amount_total).to_s)
end
```
---

## list_invoices

List invoices from Odoo with pagination and filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 100) |
| `status` | string | no | Filter by status: `"draft"`, `"posted"`, `"cancel"` |
| `partner_id` | integer | no | Filter by customer (partner) ID |
| `date_from` | string | no | From date (ISO 8601) |
| `date_to` | string | no | To date (ISO 8601) |

### Example

```ruby
result = app.integrations.odoo.list_invoices(status: "posted", date_from: "2025-01-01", date_to: "2025-03-31")
result.invoices.each do |invoice|
  puts((invoice.name).to_s + " — " + (invoice.amount_total).to_s)
end
```
---

## list_products

List products from Odoo with pagination and filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 100) |
| `name` | string | no | Filter by name (partial match) |
| `category` | string | no | Filter by product category |
| `type` | string | no | Filter by type: `"consumable"`, `"service"`, `"product"` |
| `sale_ok` | boolean | no | Can be sold |
| `purchase_ok` | boolean | no | Can be purchased |

### Example

```ruby
result = app.integrations.odoo.list_products(category: "Software", limit: 50)
result.products.each do |product|
  puts((product.name).to_s + " — " + (product.list_price).to_s)
end
```
---

## list_leads

List CRM leads and opportunities from Odoo.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 100) |
| `type` | string | no | Filter by type: `"lead"` or `"opportunity"` |
| `stage` | string | no | Filter by stage: `"New"`, `"Qualified"`, `"Won"`, `"Lost"` |
| `user_id` | integer | no | Filter by assigned salesperson |
| `partner_id` | integer | no | Filter by customer (partner) ID |

### Example

```ruby
result = app.integrations.odoo.list_leads(type: "opportunity", stage: "Qualified")
result.leads.each do |lead|
  puts((lead.name).to_s + " — " + ((lead.expected_revenue || "0")).to_s)
end
```
---

## get_current_user

Get the currently authenticated Odoo user profile.

### Parameters

None.

### Example

```ruby
result = app.integrations.odoo.get_current_user()
puts("Logged in as: " + (result.name).to_s)
puts("Email: " + (result.email).to_s)
puts("Company: " + (result.company_id).to_s)
```
---

## Multi-Account Usage

If you have multiple Odoo instances configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.odoo.list_contacts()
# Explicit default (portable across setups)
app.integrations.odoo.default.list_contacts()
# Named accounts
app.integrations.odoo.production.list_contacts()
app.integrations.odoo.staging.list_contacts()
```
All functions are identical across accounts — only the credentials differ.
