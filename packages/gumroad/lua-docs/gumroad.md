# Gumroad — Lua API Reference

## list_products

List all digital products in your Gumroad account.

### Parameters

None.

### Examples

```lua
local result = app.integrations.gumroad.list_products()

for _, product in ipairs(result.products) do
  print(product.name .. " — $" .. product.price .. " (" .. product.id .. ")")
end
```

---

## get_product

Get detailed information about a single Gumroad product.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `product_id` | string | yes | The ID of the product to retrieve |

### Example

```lua
local result = app.integrations.gumroad.get_product({
  product_id = "ABC123"
})

print(result.product.name)
print(result.product.description)
print(result.product.short_url)
```

---

## list_sales

List sales from your Gumroad account with optional filters.

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
local result = app.integrations.gumroad.list_sales()

for _, sale in ipairs(result.sales) do
  print(sale.email .. " — $" .. sale.price .. " — " .. sale.product_name)
end
```

#### Sales for a specific product

```lua
local result = app.integrations.gumroad.list_sales({
  product_id = "ABC123"
})

print("Total sales: " .. result.totalCount)
```

#### Sales in a date range

```lua
local result = app.integrations.gumroad.list_sales({
  after = "2026-01-01T00:00:00Z",
  before = "2026-01-31T23:59:59Z"
})
```

---

## list_subscribers

List all subscribers, optionally filtered by product.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `product_id` | string | no | Filter by product ID (e.g., a membership) |
| `page` | integer | no | Page number for pagination (default: 1) |

### Examples

#### All subscribers

```lua
local result = app.integrations.gumroad.list_subscribers()

for _, sub in ipairs(result.subscribers) do
  print(sub.email .. " — " .. sub.status .. " — " .. sub.product_id)
end
```

#### Subscribers for a specific membership

```lua
local result = app.integrations.gumroad.list_subscribers({
  product_id = "MEMBERSHIP123"
})
```

---

## get_subscriber

Get details for a single subscriber.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subscriber_id` | string | yes | The ID of the subscriber |

### Example

```lua
local result = app.integrations.gumroad.get_subscriber({
  subscriber_id = "SUB123"
})

print(result.subscriber.email)
print(result.subscriber.status)
print(result.subscriber.charged_price)
```

---

## list_offers

List all offers (discount codes) in your Gumroad account.

### Parameters

None.

### Example

```lua
local result = app.integrations.gumroad.list_offers()

for _, offer in ipairs(result.offers) do
  print(offer.name .. " — " .. offer.code .. " — " .. offer.amount_cents .. " cents off")
end
```

---

## get_current_user

Get the profile of the currently authenticated Gumroad user.

### Parameters

None.

### Example

```lua
local result = app.integrations.gumroad.get_current_user()

print("Connected as: " .. result.user.name)
print("Email: " .. result.user.email)
```

---

## Multi-Account Usage

If you have multiple Gumroad accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.gumroad.function_name({...})

-- Explicit default (portable across setups)
app.integrations.gumroad.default.function_name({...})

-- Named accounts
app.integrations.gumroad.main_store.function_name({...})
app.integrations.gumroad.side_project.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
