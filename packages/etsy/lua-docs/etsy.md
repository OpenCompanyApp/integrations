# Etsy - Lua API Reference

Namespace: `app.integrations.etsy`

Use this integration for Etsy seller operations through Open API v3. Calls return the decoded Etsy response body with the integration's request routing normalized around the configured shop ID. Etsy requires an OAuth bearer token for private seller operations and an app keystring in the `x-api-key` header.

## Shop

### get_shop

Get the configured shop profile.

```lua
local shop = app.integrations.etsy.get_shop({})
print(shop.shop_id)
```

### list_shop_sections

List sections configured for the shop.

```lua
local sections = app.integrations.etsy.list_shop_sections({})
```

### list_shipping_profiles

List shipping profiles available for listing creation and updates.

```lua
local profiles = app.integrations.etsy.list_shipping_profiles({})
```

## Listings

### list_listings

List shop listings.

| Parameter | Type | Required | Notes |
|-----------|------|----------|-------|
| `state` | string | no | Common values include `active`, `draft`, `inactive`, `expired`, `removed`, and `sold_out`. |
| `limit` | integer | no | Results per page. |
| `offset` | integer | no | Pagination offset. |

```lua
local listings = app.integrations.etsy.list_listings({
  state = "active",
  limit = 25,
  offset = 0
})
```

### get_listing

Get one listing by ID.

```lua
local listing = app.integrations.etsy.get_listing({listing_id = 1234567890})
```

### create_listing

Create a draft listing in the configured shop.

| Parameter | Type | Required | Notes |
|-----------|------|----------|-------|
| `title` | string | yes | Listing title. |
| `description` | string | yes | Listing description. |
| `price` | number | yes | Listing price. |
| `quantity` | integer | yes | Initial quantity. |
| `shipping_profile_id` | integer | yes | Shipping profile ID. |
| `taxonomy_id` | integer | no | Seller taxonomy category ID. |
| `tags` | array | no | Listing tags. |
| `who_made` | string | no | Example: `i_did`. |
| `when_made` | string | no | Example: `made_to_order`. |
| `is_supply` | boolean | no | Whether the listing is a supply. |

```lua
local listing = app.integrations.etsy.create_listing({
  title = "Handmade Ceramic Mug",
  description = "A wheel-thrown mug with a blue glaze.",
  price = 28.00,
  quantity = 10,
  shipping_profile_id = 567890,
  taxonomy_id = 1234,
  who_made = "i_did",
  when_made = "made_to_order",
  is_supply = false,
  tags = {"ceramic", "mug"}
})
```

### update_listing

Update listing fields.

```lua
local updated = app.integrations.etsy.update_listing({
  listing_id = 1234567890,
  data = {
    title = "Updated Ceramic Mug",
    state = "active",
    section_id = 222222
  }
})
```

### delete_listing

Delete a listing from the configured shop.

```lua
local result = app.integrations.etsy.delete_listing({listing_id = 1234567890})
```

## Images And Inventory

### list_listing_images

List images attached to a listing.

```lua
local images = app.integrations.etsy.list_listing_images({listing_id = 1234567890})
```

### upload_listing_image

Upload a local image file to a listing.

```lua
local image = app.integrations.etsy.upload_listing_image({
  listing_id = 1234567890,
  image_path = "/tmp/example-listing.jpg",
  fields = {
    rank = 1,
    alt_text = "Blue ceramic mug on a white table"
  }
})
```

### get_listing_inventory

Get products, offerings, prices, quantities, and SKUs for a listing.

```lua
local inventory = app.integrations.etsy.get_listing_inventory({listing_id = 1234567890})
```

### update_listing_inventory

Update listing inventory. Etsy expects `products` with nested `offerings` and `property_values`; include the `*_on_property` arrays when price, quantity, or SKU varies by property.

```lua
local inventory = app.integrations.etsy.update_listing_inventory({
  listing_id = 1234567890,
  data = {
    products = {
      {
        sku = "MUG-BLUE",
        offerings = {
          {price = 28.00, quantity = 10, is_enabled = true}
        },
        property_values = {}
      }
    },
    price_on_property = {},
    quantity_on_property = {},
    sku_on_property = {}
  }
})
```

## Orders

### list_orders

List shop receipts/orders.

| Parameter | Type | Required | Notes |
|-----------|------|----------|-------|
| `limit` | integer | no | Results per page. |
| `offset` | integer | no | Pagination offset. |
| `was_paid` | boolean | no | Filter paid/unpaid receipts. |
| `was_shipped` | boolean | no | Filter shipped/unshipped receipts. |

```lua
local orders = app.integrations.etsy.list_orders({
  was_paid = true,
  was_shipped = false,
  limit = 10
})
```

### get_receipt

Get one receipt/order.

```lua
local receipt = app.integrations.etsy.get_receipt({receipt_id = 987654321})
```

### list_receipt_transactions

List transaction line items for a receipt.

```lua
local items = app.integrations.etsy.list_receipt_transactions({
  receipt_id = 987654321
})
```

## Taxonomy And User

### list_seller_taxonomy_nodes

List seller taxonomy nodes used for listing `taxonomy_id` values.

```lua
local taxonomy = app.integrations.etsy.list_seller_taxonomy_nodes({})
```

### get_current_user

Get the authenticated Etsy user.

```lua
local user = app.integrations.etsy.get_current_user({})
```

## Generic API Helpers

Use these only for documented Etsy Open API endpoints that do not have a dedicated tool yet. `path` must be relative to the configured `/v3/application` base URL; absolute URLs are rejected.

```lua
local result = app.integrations.etsy.api_get({
  path = "/seller-taxonomy/nodes",
  params = {}
})

local created = app.integrations.etsy.api_post({
  path = "/shops/12345678/listings",
  body = {
    title = "Draft Listing",
    description = "Safe example",
    price = 12.00,
    quantity = 1,
    shipping_profile_id = 111111
  }
})

local updated = app.integrations.etsy.api_put({
  path = "/listings/1234567890/inventory",
  body = {products = {}}
})

local deleted = app.integrations.etsy.api_delete({
  path = "/shops/12345678/listings/1234567890"
})
```

## Multi-Account Usage

```lua
app.integrations.etsy.list_listings({state = "active"})
app.integrations.etsy.default.list_listings({state = "active"})
app.integrations.etsy.my_shop.list_orders({was_paid = true})
```

The function names are identical across accounts; only credentials and shop IDs differ.
