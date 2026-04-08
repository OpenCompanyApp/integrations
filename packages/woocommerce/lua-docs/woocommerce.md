# WooCommerce — Lua API Reference

## list_products

List products from the WooCommerce catalog with filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of products per page (default: 10, max: 100) |
| `page` | integer | no | Page number for pagination (default: 1) |
| `search` | string | no | Search products by name or description |
| `status` | string | no | Filter by status: "publish", "draft", "pending", "private", "trash" |
| `category` | string | no | Filter by category ID |
| `sku` | string | no | Filter by SKU |
| `orderby` | string | no | Sort field ("date", "id", "title", "slug", "price") |
| `order` | string | no | Sort direction: "asc" or "desc" |

### Example

```lua
local result = app.integrations.woocommerce.list_products({
  per_page = 10,
  orderby = "price",
  order = "desc"
})

for _, product in ipairs(result) do
  print(product.name .. " - $" .. product.regular_price)
end
```

---

## get_product

Get a single product by ID with full details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The product ID |

### Example

```lua
local product = app.integrations.woocommerce.get_product({
  id = 123
})

print(product.name)
print("Price: $" .. product.regular_price)
print("SKU: " .. (product.sku or "N/A"))
```

---

## create_product

Create a new product in the WooCommerce catalog.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Product name |
| `regular_price` | string | yes | Base price (e.g., "29.99") |
| `type` | string | no | Product type: "simple", "grouped", "external", "variable" (default: "simple") |
| `sku` | string | no | Unique SKU |
| `description` | string | no | Product description (HTML allowed) |
| `short_description` | string | no | Short description |
| `weight` | string | no | Product weight |
| `categories` | array | no | Array of {id} objects |
| `manage_stock` | boolean | no | Enable stock management |
| `stock_quantity` | integer | no | Stock level |
| `status` | string | no | "publish", "draft", "pending", "private" |
| `images` | array | no | Array of {src} objects |

### Example

```lua
local product = app.integrations.woocommerce.create_product({
  name = "Premium Widget",
  regular_price = "49.99",
  type = "simple",
  sku = "WDG-PREM-001",
  weight = "0.75",
  categories = {{id = 1}, {id = 5}},
  manage_stock = true,
  stock_quantity = 100,
  description = "<p>A premium quality widget.</p>"
})

print("Created product ID: " .. product.id)
```

---

## list_orders

List orders with filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Orders per page (default: 10, max: 100) |
| `page` | integer | no | Page number (default: 1) |
| `status` | string | no | Filter by status: "pending", "processing", "on-hold", "completed", "cancelled", "refunded", "failed" |
| `customer` | integer | no | Filter by customer ID |
| `after` | string | no | Orders created after this date (ISO 8601) |
| `before` | string | no | Orders created before this date (ISO 8601) |
| `orderby` | string | no | Sort field |
| `order` | string | no | Sort direction: "asc" or "desc" |

### Example

```lua
local orders = app.integrations.woocommerce.list_orders({
  status = "completed",
  per_page = 10,
  orderby = "date",
  order = "desc"
})

for _, order in ipairs(orders) do
  print("Order #" .. order.id .. " - $" .. order.total)
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
local order = app.integrations.woocommerce.get_order({
  id = 456
})

print("Order #" .. order.id)
print("Status: " .. order.status)
print("Total: $" .. order.total)
```

---

## list_customers

List customers with filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Customers per page (default: 10) |
| `page` | integer | no | Page number (default: 1) |
| `search` | string | no | Search by name or email |
| `orderby` | string | no | Sort field |
| `order` | string | no | Sort direction |

### Example

```lua
local customers = app.integrations.woocommerce.list_customers({
  per_page = 10,
  orderby = "registered_date",
  order = "desc"
})

for _, customer in ipairs(customers) do
  print(customer.first_name .. " " .. customer.last_name .. " - " .. customer.email)
end
```

---

## get_current_user

Get system status and verify the API connection.

### Parameters

None.

### Example

```lua
local status = app.integrations.woocommerce.get_current_user({})

print("Store: " .. (status.store_name or "N/A"))
```

---

## Multi-Account Usage

If you have multiple WooCommerce stores configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.woocommerce.list_products({per_page = 10})

-- Explicit default (portable across setups)
app.integrations.woocommerce.default.list_products({per_page = 10})

-- Named accounts (e.g., different stores)
app.integrations.woocommerce.us_store.list_products({per_page = 10})
app.integrations.woocommerce.eu_store.list_products({per_page = 10})
```

All functions are identical across accounts — only the credentials differ.
