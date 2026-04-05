# Shopify — Lua API Reference

## Overview

Interact with a Shopify store to manage products, orders, customers, inventory, and more. All tools are accessed via `app.integrations.shopify`.

## Authentication

Requires a Shopify **Access Token** and **Shop Name** configured in the integration settings.

---

## Products

### `app.integrations.shopify.create_product({ title, body_html, vendor, product_type, status, tags })`

Create a new Shopify product. Supports title, body_html (description), vendor, product_type, tags, and status (draft/active/archived). Returns the created product object with ID and variants.

```lua
local result = app.integrations.shopify.create_product({
  title = "Classic T-Shirt",
  body_html = "<p>A comfortable cotton t-shirt.</p>",
  vendor = "Acme Apparel",
  product_type = "Shirts",
  tags = "cotton, summer, unisex",
  status = "active"
})

print("Created product ID: " .. result.id)
```

### `app.integrations.shopify.get_product({ id })`

Retrieve a single Shopify product by its ID. Returns the full product object including variants, images, and options.

```lua
local result = app.integrations.shopify.get_product({
  id = "1234567890"
})

print("Product: " .. result.title)
```

### `app.integrations.shopify.update_product({ id, title, body_html, tags, status })`

Update an existing Shopify product. Only provided fields will be updated.

```lua
local result = app.integrations.shopify.update_product({
  id = "1234567890",
  title = "Updated T-Shirt Name",
  tags = "cotton, summer, sale",
  status = "active"
})

print("Updated product: " .. result.title)
```

### `app.integrations.shopify.list_products({ limit, status, product_type, vendor })`

List Shopify products with optional filters. Use `limit` to control page size (max 250).

```lua
local result = app.integrations.shopify.list_products({
  limit = 10,
  status = "active",
  product_type = "Shirts"
})

print("Found " .. result.count .. " products")
for _, product in ipairs(result.products) do
  print(product.title .. " (ID: " .. product.id .. ")")
end
```

### `app.integrations.shopify.delete_product({ id })`

Delete a Shopify product by its ID. This action is permanent and cannot be undone.

```lua
local result = app.integrations.shopify.delete_product({
  id = "1234567890"
})

print("Deleted: " .. tostring(result.deleted))
```

---

## Orders

### `app.integrations.shopify.create_order({ line_items, customer, financial_status, tags })`

Create a new Shopify order. Supports line_items (array of variant_id + quantity), customer, financial_status, and tags. Returns the created order object with ID and order number.

```lua
local result = app.integrations.shopify.create_order({
  line_items = {
    { variant_id = "9876543210", quantity = 2 }
  },
  customer = { email = "john@example.com" },
  financial_status = "paid",
  tags = "web-order, priority"
})

print("Order #" .. tostring(result.order_number) .. " — " .. result.total_price .. " " .. result.currency)
```

### `app.integrations.shopify.get_order({ id })`

Retrieve a single Shopify order by its ID. Returns the full order object including line items, customer, shipping, and fulfillment details.

```lua
local result = app.integrations.shopify.get_order({
  id = "5678901234"
})

print("Order: " .. result.name .. " — Status: " .. result.financial_status)
```

### `app.integrations.shopify.list_orders({ limit, status, financial_status, fulfillment_status })`

List Shopify orders with optional filters. Supports filtering by status (open, closed, cancelled, any), financial_status, and fulfillment_status. Use `limit` to control page size (max 250).

```lua
local result = app.integrations.shopify.list_orders({
  limit = 25,
  status = "open",
  financial_status = "paid",
  fulfillment_status = "unfulfilled"
})

print("Found " .. result.count .. " unfulfilled paid orders")
for _, order in ipairs(result.orders) do
  print(order.name .. " — " .. order.total_price)
end
```

### `app.integrations.shopify.update_order({ id, tags, note })`

Update an existing Shopify order. Only provided fields will be updated.

```lua
local result = app.integrations.shopify.update_order({
  id = "5678901234",
  tags = "vip, handled",
  note = "Customer contacted via email"
})

print("Updated order: " .. result.name)
```

### `app.integrations.shopify.cancel_order({ id, reason })`

Cancel a Shopify order by its ID. Optionally specify a cancellation reason (customer, inventory, fraud, other).

```lua
local result = app.integrations.shopify.cancel_order({
  id = "5678901234",
  reason = "customer"
})

print("Cancelled order: " .. result.name .. " at " .. tostring(result.cancelled_at))
```

---

## Customers

### `app.integrations.shopify.create_customer({ first_name, last_name, email, phone })`

Create a new Shopify customer. Returns the created customer object with ID.

```lua
local result = app.integrations.shopify.create_customer({
  first_name = "Jane",
  last_name = "Doe",
  email = "jane@example.com",
  phone = "+1234567890"
})

print("Created customer ID: " .. tostring(result.id))
```

### `app.integrations.shopify.get_customer({ id })`

Retrieve a single Shopify customer by their ID. Returns the full customer object including addresses and orders count.

```lua
local result = app.integrations.shopify.get_customer({
  id = "3456789012"
})

print("Customer: " .. result.first_name .. " " .. result.last_name .. " (" .. result.email .. ")")
```

### `app.integrations.shopify.list_customers({ limit })`

List Shopify customers. Use `limit` to control page size (max 250).

```lua
local result = app.integrations.shopify.list_customers({
  limit = 25
})

print("Found " .. result.count .. " customers")
for _, customer in ipairs(result.customers) do
  print(customer.first_name .. " " .. customer.last_name .. " — " .. customer.email)
end
```

### `app.integrations.shopify.update_customer({ id, first_name, last_name, email, phone })`

Update an existing Shopify customer. Only provided fields will be updated.

```lua
local result = app.integrations.shopify.update_customer({
  id = "3456789012",
  email = "newemail@example.com",
  phone = "+1987654321"
})

print("Updated customer: " .. result.first_name .. " — " .. result.email)
```

---

## Inventory & Other

### `app.integrations.shopify.create_draft_order({ line_items, customer })`

Create a Shopify draft order. Supports line_items (array of variant_id + quantity or title + price) and customer. Draft orders can be later sent as an invoice or completed into an order.

```lua
local result = app.integrations.shopify.create_draft_order({
  line_items = {
    { variant_id = "9876543210", quantity = 1 },
    { title = "Custom Item", price = "49.99", quantity = 1 }
  },
  customer = { id = "3456789012" }
})

print("Draft order: " .. result.name .. " — " .. result.total_price .. " " .. result.currency)
```

### `app.integrations.shopify.list_inventory_items({ limit })`

List Shopify inventory items. Use `limit` to control page size (max 250).

```lua
local result = app.integrations.shopify.list_inventory_items({
  limit = 50
})

print("Found " .. result.count .. " inventory items")
for _, item in ipairs(result.inventory_items) do
  print("Item ID: " .. item.id .. " — SKU: " .. (item.sku or "N/A"))
end
```

### `app.integrations.shopify.update_inventory_level({ inventory_item_id, location_id, available })`

Set the available inventory level for a specific item at a specific location. Use `list_locations` to find location IDs and `list_inventory_items` for item IDs.

```lua
local result = app.integrations.shopify.update_inventory_level({
  inventory_item_id = "111222333",
  location_id = "444555666",
  available = 150
})

print("Updated inventory: " .. result.available .. " units at location " .. result.location_id)
```

### `app.integrations.shopify.list_locations({})`

List all Shopify locations (fulfillment locations / warehouses). Returns location IDs, names, and addresses needed for inventory management.

```lua
local result = app.integrations.shopify.list_locations({})

print("Found " .. result.count .. " locations")
for _, location in ipairs(result.locations) do
  print(location.id .. ": " .. location.name)
end
```

### `app.integrations.shopify.create_custom_collection({ title, body_html, collects })`

Create a Shopify custom collection. Supports title and body_html (description). Products can be added to the collection after creation.

```lua
local result = app.integrations.shopify.create_custom_collection({
  title = "Summer Collection 2026",
  body_html = "<p>Our hottest items for summer 2026.</p>"
})

print("Created collection: " .. result.title .. " (ID: " .. tostring(result.id) .. ")")
```

### `app.integrations.shopify.list_fulfillments({ order_id })`

List all fulfillments for a specific Shopify order. Returns tracking numbers, tracking URLs, shipment status, and line items for each fulfillment.

```lua
local result = app.integrations.shopify.list_fulfillments({
  order_id = "5678901234"
})

print("Found " .. result.count .. " fulfillments")
for _, fulfillment in ipairs(result.fulfillments) do
  print("Tracking: " .. (fulfillment.tracking_number or "N/A"))
end
```

---

## Pagination

List endpoints support cursor-based pagination. Pass `page_info` from a previous response to fetch the next page. Use `limit` to control page size (max 250 per request).

## Notes

- All IDs are strings — always pass them as quoted values.
- Optional parameters can be omitted; only provided fields are sent in the request.
- Tags are comma-separated strings (e.g. `"vip, wholesale"`).
- Financial status values: `pending`, `paid`, `partially_paid`, `refunded`, `voided`.
- Product status values: `active`, `draft`, `archived`.
- Cancellation reasons: `customer`, `inventory`, `fraud`, `other`.

---

## Multi-Account Usage

If you have multiple shopify accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.shopify.function_name({...})

-- Explicit default (portable across setups)
app.integrations.shopify.default.function_name({...})

-- Named accounts
app.integrations.shopify.work.function_name({...})
app.integrations.shopify.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
