# Zoho Inventory — Lua API Reference

## list_items

List inventory items (products) from Zoho Inventory.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page, max 200 (default: 25) |
| `status` | string | no | Filter by status: `active`, `inactive`, `all` |

### Examples

```lua
-- List first page of active items
local result = app.integrations["zoho-inventory"].zoho_inventory_list_items({
  page = 1,
  per_page = 25,
  status = "active"
})

for _, item in ipairs(result.items or {}) do
  print(item.name .. " — " .. item.sku .. " — stock: " .. (item.actual_available_stock or "0"))
end
```

```lua
-- Paginate through all items
local page = 1
repeat
  local result = app.integrations["zoho-inventory"].zoho_inventory_list_items({ page = page, per_page = 200 })
  for _, item in ipairs(result.items or {}) do
    print(item.item_id .. ": " .. item.name)
  end
  page = (result.page_context or {}).page + 1
until not result.items or #result.items == 0
```

---

## get_item

Get details of a specific inventory item.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `item_id` | string | yes | The Zoho Inventory item ID |

### Example

```lua
local result = app.integrations["zoho-inventory"].zoho_inventory_get_item({ item_id = "4815162342" })
local item = result.item
print(item.name .. " — " .. item.unit .. " — $" .. item.rate)
```

---

## list_orders

List sales orders from Zoho Inventory.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page, max 200 (default: 25) |
| `status` | string | no | Filter by status: `draft`, `confirmed`, `void`, `open`, `invoiced`, `partially_invoiced`, `all` |

### Example

```lua
-- List open sales orders
local result = app.integrations["zoho-inventory"].zoho_inventory_list_orders({
  page = 1,
  per_page = 25,
  status = "open"
})

for _, order in ipairs(result.salesorders or {}) do
  print(order.salesorder_number .. " — " .. order.customer_name .. " — $" .. order.total)
end
```

---

## get_order

Get details of a specific sales order.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `order_id` | string | yes | The Zoho Inventory sales order ID |

### Example

```lua
local result = app.integrations["zoho-inventory"].zoho_inventory_get_order({ order_id = "4815162342" })
local order = result.salesorder
print("Order: " .. order.salesorder_number)
print("Customer: " .. order.customer_name)
print("Total: $" .. order.total)
for _, line in ipairs(order.line_items or {}) do
  print("  " .. line.name .. " x" .. line.quantity .. " = $" .. line.item_total)
end
```

---

## list_shipments

List shipments from Zoho Inventory.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page, max 200 (default: 25) |

### Example

```lua
local result = app.integrations["zoho-inventory"].zoho_inventory_list_shipments({ page = 1, per_page = 25 })

for _, shipment in ipairs(result.shipments or {}) do
  print(shipment.shipment_id .. " — " .. (shipment.status or "unknown"))
end
```

---

## list_packages

List packages from Zoho Inventory.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page, max 200 (default: 25) |

### Example

```lua
local result = app.integrations["zoho-inventory"].zoho_inventory_list_packages({ page = 1, per_page = 25 })

for _, pkg in ipairs(result.packages or {}) do
  print(pkg.package_id .. " — " .. (pkg.status or "unknown"))
end
```

---

## get_current_user

Get the currently authenticated Zoho Inventory user.

### Parameters

None.

### Example

```lua
local result = app.integrations["zoho-inventory"].zoho_inventory_get_current_user({})
local user = result.user
print("Logged in as: " .. user.name .. " (" .. user.email .. ")")
```

---

## Multi-Account Usage

If you have multiple Zoho Inventory accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["zoho-inventory"].zoho_inventory_list_items({...})

-- Explicit default (portable across setups)
app.integrations["zoho-inventory"].default.zoho_inventory_list_items({...})

-- Named accounts
app.integrations["zoho-inventory"].warehouse_us.zoho_inventory_list_items({...})
app.integrations["zoho-inventory"].warehouse_eu.zoho_inventory_list_orders({...})
```

All functions are identical across accounts — only the credentials differ.
