# Shopify — Lua API Reference

## list_products

List products from the Shopify store with filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of products per page (default: 50, max: 250) |
| `status` | string | no | Filter by status: "active", "draft", or "archived" |
| `product_type` | string | no | Filter by product type |
| `vendor` | string | no | Filter by vendor name |
| `collection_id` | string | no | Filter by collection ID |
| `page_info` | string | no | Cursor for pagination (from a previous response) |

### Example

```lua
local result = app.integrations.shopify.list_products({
  limit = 10,
  status = "active",
  sort = "price",
  direction = "desc"
})

for _, product in ipairs(result) do
  print(product.title .. " - $" .. product.price)
end
```

---

## get_product

Get a single product by ID with full details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The product ID |

### Example

```lua
local product = app.integrations.shopify.get_product({
  id = "1234567890"
})

print(product.title)
print("Price: $" .. product.price)
print("SKU: " .. (product.sku or "N/A"))
```

---

## create_product

Create a new product in the Shopify store.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | Product title |
| `body_html` | string | no | Product description (HTML allowed) |
| `vendor` | string | no | Product vendor |
| `product_type` | string | no | Product type (e.g., "Shirts", "Electronics") |
| `status` | string | no | Product status: "active", "draft", or "archived" |
| `tags` | string | no | Comma-separated tags (e.g., "cotton, summer") |
| `published` | boolean | no | Whether the product is published (default: true) |

### Example

```lua
local product = app.integrations.shopify.create_product({
  title = "Premium Widget",
  body_html = "<p>A premium quality widget.</p>",
  vendor = "Acme Corp",
  product_type = "Widgets",
  status = "active",
  tags = "premium, new"
})

print("Created product ID: " .. product.id)
```

---

## list_orders

List orders with filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Orders per page (default: 50, max: 250) |
| `status` | string | no | Filter by status: "open", "closed", "cancelled", or "any" |
| `financial_status` | string | no | Filter by financial status: "pending", "paid", "partially_paid", "refunded", "voided" |
| `fulfillment_status` | string | no | Filter by fulfillment status: "shipped", "partial", "unshipped", "any" |
| `page_info` | string | no | Cursor for pagination (from a previous response) |

### Example

```lua
local orders = app.integrations.shopify.list_orders({
  status = "open",
  financial_status = "paid",
  fulfillment_status = "unshipped",
  limit = 10
})

for _, order in ipairs(orders) do
  print("Order #" .. order.name .. " - $" .. order.total_price)
end
```

---

## get_order

Get a single order by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The order ID |

### Example

```lua
local order = app.integrations.shopify.get_order({
  id = "5678901234"
})

print("Order: " .. order.name)
print("Status: " .. order.financial_status)
print("Total: $" .. order.total_price)
```

---

## list_customers

List customers with filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Customers per page (default: 50, max: 250) |
| `email` | string | no | Filter by email address |
| `tag` | string | no | Filter by customer tag |
| `page_info` | string | no | Cursor for pagination (from a previous response) |

### Example

```lua
local customers = app.integrations.shopify.list_customers({
  limit = 10
})

for _, customer in ipairs(customers) do
  print(customer.first_name .. " " .. customer.last_name .. " - " .. customer.email)
end
```

---

## get_current_user

Get shop info and verify the API connection.

### Parameters

None.

### Example

```lua
local shop = app.integrations.shopify.get_current_user({})

print("Store: " .. shop.name)
```

---

## Multi-Account Usage

If you have multiple Shopify stores configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.shopify.list_products({limit = 10})

-- Explicit default (portable across setups)
app.integrations.shopify.default.list_products({limit = 10})

-- Named accounts (e.g., different stores)
app.integrations.shopify.us_store.list_products({limit = 10})
app.integrations.shopify.eu_store.list_products({limit = 10})
```

All functions are identical across accounts — only the credentials differ.
