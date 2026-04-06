# Lemon Squeezy — Lua API Reference

## list_products

List all digital products in your Lemon Squeezy store.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of products per page (default: 10, max: 100) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```lua
local result = app.integrations["lemon-squeezy"].list_products({
  page_size = 20,
  page = 1
})

for _, product in ipairs(result.data) do
  print(product.attributes.name .. " - " .. product.attributes.price)
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
local result = app.integrations["lemon-squeezy"].get_product({
  id = "12345"
})

print(result.data.attributes.name)
print(result.data.attributes.status)
```

---

## list_orders

List all orders in your Lemon Squeezy store.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of orders per page (default: 10, max: 100) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```lua
local result = app.integrations["lemon-squeezy"].list_orders({
  page_size = 25,
  page = 1
})

for _, order in ipairs(result.data) do
  print(order.attributes.identifier .. ": " .. order.attributes.total .. " " .. order.attributes.currency)
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
local result = app.integrations["lemon-squeezy"].get_order({
  id = "67890"
})

print(result.data.attributes.identifier)
print(result.data.attributes.status_formatted)
print("Total: " .. result.data.attributes.total)
```

---

## list_customers

List all customers in your Lemon Squeezy store.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of customers per page (default: 10, max: 100) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```lua
local result = app.integrations["lemon-squeezy"].list_customers({
  page_size = 50
})

for _, customer in ipairs(result.data) do
  print(customer.attributes.name .. " (" .. customer.attributes.email .. ")")
end
```

---

## list_subscriptions

List all subscriptions in your Lemon Squeezy store.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of subscriptions per page (default: 10, max: 100) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Example

```lua
local result = app.integrations["lemon-squeezy"].list_subscriptions({
  page_size = 50
})

for _, sub in ipairs(result.data) do
  print(sub.attributes.user_email .. " - " .. sub.attributes.status_formatted)
end
```

---

## get_current_user

Get the currently authenticated Lemon Squeezy user profile.

### Parameters

None.

### Example

```lua
local result = app.integrations["lemon-squeezy"].get_current_user({})

print(result.data.attributes.name)
print(result.data.attributes.email)
```

---

## Multi-Account Usage

If you have multiple Lemon Squeezy accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["lemon-squeezy"].function_name({...})

-- Explicit default (portable across setups)
app.integrations["lemon-squeezy"].default.function_name({...})

-- Named accounts
app.integrations["lemon-squeezy"].work.function_name({...})
app.integrations["lemon-squeezy"].personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
