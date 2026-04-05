# BigCommerce — Lua API Reference

## list_products

List products from the BigCommerce catalog with filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of products per page (default: 50, max: 250) |
| `page` | integer | no | Page number for pagination (default: 1) |
| `keyword` | string | no | Filter by keyword (matches name or SKU) |
| `include` | string | no | Comma-separated related resources (e.g., "variants,images,custom_fields") |
| `categories` | string | no | Comma-separated category IDs to filter by |
| `is_visible` | boolean | no | Filter by visibility |
| `sort` | string | no | Sort field ("name", "price", "date_created", "id") |
| `direction` | string | no | Sort direction: "asc" or "desc" |

### Example

```lua
local result = app.integrations.bigcommerce.list_products({
  limit = 10,
  include = "variants,images",
  sort = "price",
  direction = "desc"
})

for _, product in ipairs(result) do
  print(product.name .. " - $" .. product.price)
end
```

---

## get_product

Get a single product by ID with full details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The product ID |
| `include` | string | no | Comma-separated related resources |

### Example

```lua
local product = app.integrations.bigcommerce.get_product({
  id = 123,
  include = "variants,images,custom_fields"
})

print(product.name)
print("Price: $" .. product.price)
print("SKU: " .. (product.sku or "N/A"))
```

---

## create_product

Create a new product in the BigCommerce catalog.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Product name |
| `price` | number | yes | Base price (e.g., 29.99) |
| `type` | string | yes | Product type: "physical", "digital", or "giftcertificate" |
| `sku` | string | no | Unique SKU |
| `description` | string | no | Product description (HTML allowed) |
| `weight` | number | no | Product weight (required for physical products) |
| `categories` | array | no | Array of category IDs |
| `brand_id` | integer | no | Brand ID |
| `inventory_tracking` | string | no | "none", "product", or "variant" |
| `inventory_level` | integer | no | Stock level |
| `is_visible` | boolean | no | Storefront visibility (default: true) |
| `custom_fields` | array | no | Array of {name, value} objects |
| `images` | array | no | Array of {image_url} objects |

### Example

```lua
local product = app.integrations.bigcommerce.create_product({
  name = "Premium Widget",
  price = 49.99,
  type = "physical",
  sku = "WDG-PREM-001",
  weight = 0.75,
  categories = {1, 5},
  inventory_tracking = "product",
  inventory_level = 100,
  description = "<p>A premium quality widget.</p>"
})

print("Created product ID: " .. product.id)
```

---

## update_product

Update an existing product. Only the fields you provide will be changed.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The product ID to update |
| `name` | string | no | Updated name |
| `price` | number | no | Updated price |
| `type` | string | no | Updated type |
| `sku` | string | no | Updated SKU |
| `description` | string | no | Updated description |
| `weight` | number | no | Updated weight |
| `categories` | array | no | Updated category IDs |
| `brand_id` | integer | no | Updated brand ID |
| `inventory_tracking` | string | no | Updated inventory tracking |
| `inventory_level` | integer | no | Updated stock level |
| `is_visible` | boolean | no | Updated visibility |
| `custom_fields` | array | no | Updated custom fields (replaces all) |

### Example

```lua
local product = app.integrations.bigcommerce.update_product({
  id = 123,
  price = 39.99,
  inventory_level = 75
})

print("Updated price: $" .. product.price)
```

---

## delete_product

Delete a product permanently.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The product ID to delete |

### Example

```lua
app.integrations.bigcommerce.delete_product({
  id = 123
})

print("Product deleted")
```

---

## list_orders

List orders with filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Orders per page (default: 50, max: 250) |
| `page` | integer | no | Page number (default: 1) |
| `status_id` | integer | no | Filter by status (0=Awaiting, 1=Awaiting Shipment, 2=Shipped, 3=Completed, 4=Cancelled) |
| `customer_id` | integer | no | Filter by customer |
| `min_date_created` | string | no | Minimum date (ISO 8601) |
| `max_date_created` | string | no | Maximum date (ISO 8601) |
| `sort` | string | no | Sort field |
| `direction` | string | no | Sort direction: "asc" or "desc" |

### Example

```lua
local orders = app.integrations.bigcommerce.list_orders({
  status_id = 2,
  limit = 10,
  sort = "date_created",
  direction = "desc"
})

for _, order in ipairs(orders) do
  print("Order #" .. order.id .. " - $" .. order.total_inc_tax)
end
```

---

## get_order

Get a single order by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The order ID |

### Example

```lua
local order = app.integrations.bigcommerce.get_order({
  id = 456
})

print("Order #" .. order.id)
print("Status: " .. order.status)
print("Total: $" .. order.total_inc_tax)
```

---

## update_order

Update an existing order. Only the fields you provide will be changed.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The order ID |
| `status_id` | integer | no | Status ID (0-7) |
| `staff_notes` | string | no | Internal notes |
| `customer_message` | string | no | Customer message |
| `is_deleted` | boolean | no | Archive the order |

### Example

```lua
local order = app.integrations.bigcommerce.update_order({
  id = 456,
  status_id = 3,
  staff_notes = "Shipped via FedEx, tracking: 12345"
})

print("Order updated to status: " .. order.status_id)
```

---

## list_customers

List customers with filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Customers per page (default: 50) |
| `page` | integer | no | Page number (default: 1) |
| `name` | string | no | Filter by name |
| `email` | string | no | Filter by email |
| `sort` | string | no | Sort field |
| `direction` | string | no | Sort direction |

### Example

```lua
local customers = app.integrations.bigcommerce.list_customers({
  limit = 10,
  sort = "date_created",
  direction = "desc"
})

for _, customer in ipairs(customers) do
  print(customer.first_name .. " " .. customer.last_name .. " - " .. customer.email)
end
```

---

## get_customer

Get a single customer by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The customer ID |

### Example

```lua
local customer = app.integrations.bigcommerce.get_customer({
  id = 789
})

print(customer.first_name .. " " .. customer.last_name)
print("Email: " .. customer.email)
print("Orders: " .. customer.orders)
```

---

## create_customer

Create a new customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | yes | First name |
| `last_name` | string | yes | Last name |
| `email` | string | yes | Email address |
| `phone` | string | no | Phone number |
| `company` | string | no | Company name |
| `customer_group_id` | integer | no | Customer group |
| `addresses` | array | no | Array of address objects |

### Example

```lua
local customer = app.integrations.bigcommerce.create_customer({
  first_name = "Jane",
  last_name = "Smith",
  email = "jane@example.com",
  phone = "+1-555-0123",
  company = "Acme Corp"
})

print("Created customer ID: " .. customer.id)
```

---

## list_categories

List catalog categories.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Categories per page (default: 50) |
| `page` | integer | no | Page number (default: 1) |
| `parent_id` | integer | no | Filter by parent (0 for top-level) |
| `name` | string | no | Filter by name |
| `is_visible` | boolean | no | Filter by visibility |
| `sort` | string | no | Sort field |
| `direction` | string | no | Sort direction |

### Example

```lua
local categories = app.integrations.bigcommerce.list_categories({
  parent_id = 0,
  limit = 50
})

for _, cat in ipairs(categories) do
  print(cat.id .. ": " .. cat.name)
end
```

---

## get_current_user

Get storefront status and verify the API connection.

### Parameters

None.

### Example

```lua
local status = app.integrations.bigcommerce.get_current_user({})

print("Store status: " .. tostring(status))
```

---

## Multi-Account Usage

If you have multiple BigCommerce stores configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.bigcommerce.list_products({limit = 10})

-- Explicit default (portable across setups)
app.integrations.bigcommerce.default.list_products({limit = 10})

-- Named accounts (e.g., different stores)
app.integrations.bigcommerce.us_store.list_products({limit = 10})
app.integrations.bigcommerce.eu_store.list_products({limit = 10})
```

All functions are identical across accounts — only the credentials differ.
