# WooCommerce — Lua API Reference

## list_products

List products from the WooCommerce store.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of products per page (default: 10, max: 100) |
| `page` | integer | no | Current page number (1-based) |
| `search` | string | no | Search term to filter products by name |
| `status` | string | no | Filter by status: `publish`, `draft`, `pending`, `private`, `trash` |
| `category` | string | no | Filter by category ID or slug |
| `orderby` | string | no | Sort by: `date`, `id`, `title`, `slug`, `price`, `popularity` |
| `order` | string | no | Sort direction: `asc` or `desc` (default: `desc`) |

### Example

```lua
local result = app.integrations.woocommerce.list_products({
  per_page = 20,
  status = "publish",
  orderby = "date",
  order = "desc"
})

for _, product in ipairs(result) do
  print(product.id .. ": " .. product.name .. " — " .. (product.price or "N/A"))
end
```

---

## get_product

Get full details for a single product.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The product ID |

### Example

```lua
local product = app.integrations.woocommerce.get_product({ id = 123 })
print(product.name)
print(product.status)
print(product.regular_price)
print(product.stock_quantity)
```

---

## create_product

Create a new product in the store.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Product name |
| `type` | string | no | `simple`, `grouped`, `external`, `variable` (default: `simple`) |
| `status` | string | no | `publish`, `draft`, `pending`, `private` (default: `publish`) |
| `regular_price` | string | no | Regular price, e.g. `"19.99"` |
| `sale_price` | string | no | Sale price |
| `description` | string | no | Full HTML description |
| `short_description` | string | no | Short description |
| `sku` | string | no | Stock-keeping unit |
| `manage_stock` | boolean | no | Enable stock management |
| `stock_quantity` | integer | no | Stock quantity |
| `categories` | array | no | Category objects, e.g. `{{id = 42}}` |
| `images` | array | no | Image objects, e.g. `{{src = "https://..."}}` |

### Example

```lua
local product = app.integrations.woocommerce.create_product({
  name = "T-Shirt",
  type = "simple",
  regular_price = "29.99",
  description = "<p>A comfortable cotton t-shirt</p>",
  sku = "TSHIRT-001",
  manage_stock = true,
  stock_quantity = 100,
  categories = {{ id = 42 }}
})

print("Created product #" .. product.id)
```

---

## update_product

Update an existing product.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The product ID |
| `name` | string | no | New product name |
| `status` | string | no | New status |
| `regular_price` | string | no | New regular price |
| `sale_price` | string | no | New sale price |
| `description` | string | no | New description |
| `short_description` | string | no | New short description |
| `sku` | string | no | New SKU |
| `manage_stock` | boolean | no | Enable/disable stock management |
| `stock_quantity` | integer | no | New stock quantity |
| `categories` | array | no | New categories |
| `images` | array | no | New images |

### Example

```lua
local product = app.integrations.woocommerce.update_product({
  id = 123,
  regular_price = "24.99",
  stock_quantity = 75
})

print("Updated price to " .. product.regular_price)
```

---

## delete_product

Delete a product from the store.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The product ID |
| `force` | boolean | no | Set `true` for permanent deletion (default: trash) |

### Example

```lua
app.integrations.woocommerce.delete_product({ id = 123 })
print("Product deleted")
```

---

## list_orders

List orders from the store.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Orders per page (default: 10, max: 100) |
| `page` | integer | no | Page number (1-based) |
| `status` | string | no | Filter: `any`, `pending`, `processing`, `on-hold`, `completed`, `cancelled`, `refunded`, `failed`, `trash` |
| `customer` | integer | no | Filter by customer ID |
| `product` | integer | no | Filter by product ID |
| `after` | string | no | ISO 8601 date — only orders after |
| `before` | string | no | ISO 8601 date — only orders before |
| `orderby` | string | no | Sort by: `date`, `id`, `include`, `title`, `slug` |
| `order` | string | no | `asc` or `desc` (default: `desc`) |

### Example

```lua
local result = app.integrations.woocommerce.list_orders({
  per_page = 25,
  status = "processing",
  orderby = "date",
  order = "desc"
})

for _, order in ipairs(result) do
  print("Order #" .. order.id .. " — " .. order.status .. " — " .. order.total)
end
```

---

## get_order

Get full details for a single order.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The order ID |

### Example

```lua
local order = app.integrations.woocommerce.get_order({ id = 456 })
print("Order #" .. order.id)
print("Status: " .. order.status)
print("Total: " .. order.total .. " " .. order.currency)

for _, item in ipairs(order.line_items) do
  print("  - " .. item.name .. " x" .. item.quantity .. " = " .. item.total)
end
```

---

## update_order

Update an existing order.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The order ID |
| `status` | string | no | New status: `pending`, `processing`, `on-hold`, `completed`, `cancelled`, `refunded`, `failed` |
| `customer_note` | string | no | Note visible to the customer |
| `billing` | array | no | Billing address fields |
| `shipping` | array | no | Shipping address fields |
| `line_items` | array | no | Line items data |
| `shipping_lines` | array | no | Shipping lines data |
| `meta_data` | array | no | Custom meta data |

### Example

```lua
local order = app.integrations.woocommerce.update_order({
  id = 456,
  status = "completed"
})

print("Order #" .. order.id .. " is now " .. order.status)
```

---

## list_customers

List customers from the store.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Customers per page (default: 10, max: 100) |
| `page` | integer | no | Page number (1-based) |
| `search` | string | no | Search by name, email, or username |
| `email` | string | no | Filter by exact email |
| `role` | string | no | Filter by user role |
| `orderby` | string | no | Sort by: `id`, `include`, `name`, `registered_date` |
| `order` | string | no | `asc` or `desc` (default: `desc`) |

### Example

```lua
local result = app.integrations.woocommerce.list_customers({
  per_page = 20,
  search = "john"
})

for _, customer in ipairs(result) do
  print(customer.id .. ": " .. customer.first_name .. " " .. customer.last_name .. " <" .. customer.email .. ">")
end
```

---

## get_customer

Get full details for a single customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The customer ID |

### Example

```lua
local customer = app.integrations.woocommerce.get_customer({ id = 789 })
print(customer.first_name .. " " .. customer.last_name)
print(customer.email)
print("Orders: " .. customer.orders_count)
```

---

## create_customer

Create a new customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Customer email address |
| `first_name` | string | no | First name |
| `last_name` | string | no | Last name |
| `username` | string | no | Login username (auto-generated if omitted) |
| `password` | string | no | Login password (auto-generated if omitted) |
| `billing` | array | no | Billing address fields |
| `shipping` | array | no | Shipping address fields |

### Example

```lua
local customer = app.integrations.woocommerce.create_customer({
  email = "jane@example.com",
  first_name = "Jane",
  last_name = "Doe",
  billing = {
    first_name = "Jane",
    last_name = "Doe",
    address_1 = "123 Main St",
    city = "Springfield",
    country = "US"
  }
})

print("Created customer #" .. customer.id)
```

---

## get_current_user

Get WooCommerce system status — validates credentials and returns environment info.

### Parameters

None.

### Example

```lua
local status = app.integrations.woocommerce.get_current_user({})
print("WooCommerce version: " .. status.environment.version)
print("WordPress version: " .. status.environment.wp_version)
```

---

## Multi-Account Usage

If you have multiple WooCommerce stores configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.woocommerce.function_name({...})

-- Explicit default (portable across setups)
app.integrations.woocommerce.default.function_name({...})

-- Named stores
app.integrations.woocommerce.us_store.function_name({...})
app.integrations.woocommerce.eu_store.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
