# Sellfy — Lua API Reference

## list_products

List all products in your Sellfy store.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of products per page (default: 10) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```lua
local result = app.integrations["sellfy"].list_products({
  page_size = 20,
  page = 1
})

for _, product in ipairs(result.products) do
  print(product.name .. " - " .. product.price)
end
```

---

## get_product

Get details for a specific product by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The product ID |

### Example

```lua
local result = app.integrations["sellfy"].get_product({
  id = "12345"
})

print(result.name)
print(result.status)
```

---

## create_product

Create a new product in your Sellfy store.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The product name |
| `price` | number | yes | The product price |
| `type` | string | no | Product type: "digital", "subscription", or "physical". Default: "digital" |
| `description` | string | no | Product description |
| `currency` | string | no | Currency code (e.g., "USD", "EUR") |

### Example

```lua
local result = app.integrations["sellfy"].create_product({
  name = "My eBook",
  price = 9.99,
  type = "digital",
  description = "A comprehensive guide to selling digital products",
  currency = "USD"
})

print("Created product: " .. result.id)
```

---

## list_orders

List all orders in your Sellfy store.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of orders per page (default: 10) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```lua
local result = app.integrations["sellfy"].list_orders({
  page_size = 25,
  page = 1
})

for _, order in ipairs(result.orders) do
  print(order.id .. ": " .. order.total .. " " .. order.currency)
end
```

---

## get_order

Get details for a specific order by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The order ID |

### Example

```lua
local result = app.integrations["sellfy"].get_order({
  id = "67890"
})

print(result.id)
print(result.status)
print("Total: " .. result.total)
```

---

## list_customers

List all customers in your Sellfy store.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of customers per page (default: 10) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```lua
local result = app.integrations["sellfy"].list_customers({
  page_size = 50
})

for _, customer in ipairs(result.customers) do
  print(customer.name .. " (" .. customer.email .. ")")
end
```

---

## get_current_user

Get the currently authenticated Sellfy user profile.

### Parameters

None.

### Example

```lua
local result = app.integrations["sellfy"].get_current_user({})

print(result.name)
print(result.email)
```

---

## Multi-Account Usage

If you have multiple Sellfy accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["sellfy"].function_name({...})

-- Explicit default (portable across setups)
app.integrations["sellfy"].default.function_name({...})

-- Named accounts
app.integrations["sellfy"].work.function_name({...})
app.integrations["sellfy"].personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
