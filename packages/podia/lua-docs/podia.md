# Podia — Lua API Reference

## list_products

List all online courses and digital downloads in your Podia account.

### Parameters

None.

### Examples

```lua
local result = app.integrations.podia.list_products()

for _, product in ipairs(result.products) do
  print(product.name .. " — " .. product.type .. " (" .. product.id .. ")")
end
```

---

## get_product

Get detailed information about a single Podia product.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `product_id` | string | yes | The ID of the product to retrieve |

### Example

```lua
local result = app.integrations.podia.get_product({
  product_id = "12345"
})

print(result.product.name)
print(result.product.description)
print(result.product.price)
```

---

## list_customers

List all customers in your Podia account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |

### Examples

#### All customers

```lua
local result = app.integrations.podia.list_customers()

for _, customer in ipairs(result.customers) do
  print(customer.email .. " — " .. customer.name)
end
```

#### Paginated

```lua
local result = app.integrations.podia.list_customers({
  page = 2
})
```

---

## get_customer

Get details for a single customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `customer_id` | string | yes | The ID of the customer |

### Example

```lua
local result = app.integrations.podia.get_customer({
  customer_id = "67890"
})

print(result.customer.email)
print(result.customer.name)
print(result.customer.total_spent)
```

---

## list_sales

List sales from your Podia account with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `product_id` | string | no | Filter by product ID |
| `before` | string | no | Only sales before this ISO 8601 timestamp |
| `after` | string | no | Only sales after this ISO 8601 timestamp |
| `page` | integer | no | Page number for pagination (default: 1) |

### Examples

#### All recent sales

```lua
local result = app.integrations.podia.list_sales()

for _, sale in ipairs(result.sales) do
  print(sale.email .. " — $" .. sale.amount .. " — " .. sale.product_name)
end
```

#### Sales for a specific product

```lua
local result = app.integrations.podia.list_sales({
  product_id = "12345"
})

print("Total sales: " .. result.totalCount)
```

#### Sales in a date range

```lua
local result = app.integrations.podia.list_sales({
  after = "2026-01-01T00:00:00Z",
  before = "2026-01-31T23:59:59Z"
})
```

---

## get_sale

Get details for a single sale.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sale_id` | string | yes | The ID of the sale |

### Example

```lua
local result = app.integrations.podia.get_sale({
  sale_id = "SALE123"
})

print(result.sale.email)
print(result.sale.amount)
print(result.sale.status)
print(result.sale.product_name)
```

---

## get_current_user

Get the profile of the currently authenticated Podia user.

### Parameters

None.

### Example

```lua
local result = app.integrations.podia.get_current_user()

print("Connected as: " .. result.user.name)
print("Email: " .. result.user.email)
```

---

## Multi-Account Usage

If you have multiple Podia accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.podia.function_name({...})

-- Explicit default (portable across setups)
app.integrations.podia.default.function_name({...})

-- Named accounts
app.integrations.podia.main_site.function_name({...})
app.integrations.podia.course_platform.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
