# Etsy — Lua API Reference

## list_listings

List all listings in the Etsy shop with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `state` | string | no | Filter by state: `"active"`, `"draft"`, `"inactive"`, `"expired"`, `"sold_out"` |
| `limit` | integer | no | Results per page (1–100, default: 25) |
| `offset` | integer | no | Pagination offset from previous response |

### Examples

```lua
-- List active listings
local result = app.integrations.etsy.list_listings({state = "active"})

-- Paginate through draft listings
local result = app.integrations.etsy.list_listings({
  state = "draft",
  limit = 50,
  offset = 0
})
```

---

## get_listing

Get full details for a specific listing by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `listing_id` | integer | yes | The Etsy listing ID |

### Examples

```lua
local result = app.integrations.etsy.get_listing({listing_id = 1234567890})
print(result.title .. " - $" .. result.price.amount)
```

---

## create_listing

Create a new listing in the Etsy shop.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | Listing title (max 140 characters) |
| `description` | string | yes | Listing description |
| `price` | number | yes | Price (must be > 0) |
| `quantity` | integer | yes | Stock quantity (must be ≥ 1) |
| `shipping_profile_id` | integer | yes | Shipping profile to assign |
| `taxonomy_id` | integer | no | Etsy category taxonomy ID |
| `tags` | array | no | Up to 13 tags (max 20 chars each) |
| `who_made` | string | no | `"i_did"`, `"collective"`, or `"someone_else"` |
| `when_made` | string | no | e.g. `"made_to_order"`, `"2020_2024"` |
| `is_supply` | boolean | no | Supply (true) or finished product (false) |

### Examples

```lua
local result = app.integrations.etsy.create_listing({
  title = "Handmade Ceramic Mug",
  description = "A beautiful hand-thrown ceramic mug with a unique glaze.",
  price = 28.00,
  quantity = 10,
  shipping_profile_id = 567890,
  who_made = "i_did",
  when_made = "made_to_order",
  is_supply = false,
  tags = {"ceramic", "mug", "handmade", "pottery"}
})
print("Created listing: " .. result.listing_id)
```

---

## list_orders

List orders (receipts) for the Etsy shop with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Results per page (1–100, default: 25) |
| `offset` | integer | no | Pagination offset |
| `was_paid` | boolean | no | Filter to paid (`true`) or unpaid (`false`) |
| `was_shipped` | boolean | no | Filter to shipped (`true`) or unshipped (`false`) |

### Examples

```lua
-- Get recent paid, unshipped orders
local result = app.integrations.etsy.list_orders({
  was_paid = true,
  was_shipped = false,
  limit = 10
})

for _, order in ipairs(result.results) do
  print("Order " .. order.receipt_id .. ": " .. order.total .. " from " .. order.buyer_id)
end
```

---

## get_listing_inventory

Get the inventory (products, offerings, pricing) for a listing.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `listing_id` | integer | yes | The Etsy listing ID |

### Examples

```lua
local result = app.integrations.etsy.get_listing_inventory({listing_id = 1234567890})
for _, product in ipairs(result.products) do
  print("Product: " .. product.product_id .. " - " .. product.offering_id)
end
```

---

## get_current_user

Get the currently authenticated Etsy user profile.

### Parameters

None.

### Examples

```lua
local result = app.integrations.etsy.get_current_user({})
print("User ID: " .. result.user_id)
```

---

## Multi-Account Usage

If you have multiple Etsy shops configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.etsy.list_listings({state = "active"})

-- Explicit default (portable across setups)
app.integrations.etsy.default.list_listings({state = "active"})

-- Named accounts
app.integrations.etsy.my_shop.list_listings({state = "active"})
app.integrations.etsy.other_shop.list_listings({state = "active"})
```

All functions are identical across accounts — only the credentials differ.

---

## Common Workflows

### Check unshipped orders and get listing details

```lua
local orders = app.integrations.etsy.list_orders({was_paid = true, was_shipped = false})

for _, order in ipairs(orders.results) do
  for _, item in ipairs(order.transactions) do
    local listing = app.integrations.etsy.get_listing({listing_id = item.listing_id})
    print("Order " .. order.receipt_id .. ": " .. listing.title .. " x" .. item.quantity)
  end
end
```

### Create a listing and check its inventory

```lua
local listing = app.integrations.etsy.create_listing({
  title = "New Product",
  description = "Product description here.",
  price = 19.99,
  quantity = 5,
  shipping_profile_id = 12345
})

local inventory = app.integrations.etsy.get_listing_inventory({listing_id = listing.listing_id})
print("Created with " .. #inventory.products .. " product variants")
```
