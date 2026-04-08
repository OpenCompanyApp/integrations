# Odoo ERP — Lua API Reference

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

```lua
local result = app.integrations.odoo.list_contacts({
  page = 1,
  limit = 20,
  name = "Acme"
})

for _, contact in ipairs(result.contacts) do
  print(contact.name .. " — " .. (contact.email or "no email"))
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

```lua
local result = app.integrations.odoo.get_contact({ id = 42 })
print(result.name)
print(result.email)
print(result.phone)
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

```lua
local result = app.integrations.odoo.create_contact({
  name = "Acme Corp",
  email = "info@acme.com",
  is_company = true,
  country = "US",
  vat = "US123456789"
})

print("Created contact ID: " .. result.id)
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

```lua
local result = app.integrations.odoo.list_sales_orders({
  status = "sale",
  page = 1,
  limit = 10
})

for _, order in ipairs(result.orders) do
  print(order.name .. " — " .. order.amount_total)
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

```lua
local result = app.integrations.odoo.list_invoices({
  status = "posted",
  date_from = "2025-01-01",
  date_to = "2025-03-31"
})

for _, invoice in ipairs(result.invoices) do
  print(invoice.name .. " — " .. invoice.amount_total)
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

```lua
local result = app.integrations.odoo.list_products({
  category = "Software",
  limit = 50
})

for _, product in ipairs(result.products) do
  print(product.name .. " — " .. product.list_price)
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

```lua
local result = app.integrations.odoo.list_leads({
  type = "opportunity",
  stage = "Qualified"
})

for _, lead in ipairs(result.leads) do
  print(lead.name .. " — " .. (lead.expected_revenue or "0"))
end
```

---

## get_current_user

Get the currently authenticated Odoo user profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.odoo.get_current_user({})
print("Logged in as: " .. result.name)
print("Email: " .. result.email)
print("Company: " .. result.company_id)
```

---

## Multi-Account Usage

If you have multiple Odoo instances configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.odoo.list_contacts({})

-- Explicit default (portable across setups)
app.integrations.odoo.default.list_contacts({})

-- Named accounts
app.integrations.odoo.production.list_contacts({})
app.integrations.odoo.staging.list_contacts({})
```

All functions are identical across accounts — only the credentials differ.
