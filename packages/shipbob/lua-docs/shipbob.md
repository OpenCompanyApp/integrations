# ShipBob — Lua API Reference

## list_orders

List fulfillment orders with pagination and optional status filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 25, max: 100) |
| `status` | string | no | Filter by status: `pending`, `processing`, `fulfilled`, `cancelled` |

### Examples

```lua
-- List pending orders
local result = app.integrations.shipbob.list_orders({
  status = "pending",
  limit = 10
})

for _, order in ipairs(result) do
  print("Order #" .. order.id .. " - " .. order.status)
end

-- Paginate through all orders
local page2 = app.integrations.shipbob.list_orders({
  page = 2,
  limit = 50
})
```

---

## get_order

Get details for a specific order by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ShipBob order ID |

### Example

```lua
local order = app.integrations.shipbob.get_order({ id = 12345 })
print("Order #" .. order.id)
print("Status: " .. order.status)
print("Tracking: " .. (order.tracking_number or "N/A"))
```

---

## create_order

Create a new fulfillment order.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `receiving_note` | string | yes | Note for the fulfillment center |
| `products` | array | yes | List of product line items (each with `id` and `quantity`) |
| `shipping_method` | string | no | Shipping method: `ground`, `expedited`, `overnight`, etc. |

### Example

```lua
local order = app.integrations.shipbob.create_order({
  receiving_note = "Priority shipment — handle with care",
  products = {
    { id = 101, quantity = 2 },
    { id = 205, quantity = 1 }
  },
  shipping_method = "expedited"
})

print("Created order #" .. order.id)
```

---

## list_products

List products in your ShipBob inventory.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 25, max: 100) |

### Example

```lua
local result = app.integrations.shipbob.list_products({
  page = 1,
  limit = 50
})

for _, product in ipairs(result) do
  print(product.name .. " (SKU: " .. product.sku .. ") — " .. product.quantity .. " in stock")
end
```

---

## get_product

Get details for a specific product by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ShipBob product ID |

### Example

```lua
local product = app.integrations.shipbob.get_product({ id = 678 })
print(product.name .. " — " .. product.quantity .. " units available")
```

---

## list_shipments

List shipments with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `limit` | integer | no | Results per page (default: 25, max: 100) |

### Example

```lua
local result = app.integrations.shipbob.list_shipments({
  page = 1,
  limit = 25
})

for _, shipment in ipairs(result) do
  print("Shipment #" .. shipment.id .. " — " .. shipment.status .. " (" .. shipment.carrier .. ")")
end
```

---

## get_current_user

Get the currently authenticated user profile.

### Parameters

None.

### Example

```lua
local user = app.integrations.shipbob.get_current_user({})
print("Logged in as: " .. user.email)
```

---

## Multi-Account Usage

If you have multiple ShipBob accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.shipbob.list_orders({})

-- Explicit default (portable across setups)
app.integrations.shipbob.default.list_orders({})

-- Named accounts
app.integrations.shipbob.production.list_orders({})
app.integrations.shipbob.staging.list_orders({})
```

All functions are identical across accounts — only the credentials differ.
