# Kajabi — Lua API Reference

## list_offers

List all offers in your Kajabi account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of results per page (default: 25) |

### Examples

```lua
local result = app.integrations.kajabi.list_offers()

for _, offer in ipairs(result.offers) do
  print(offer.title .. " — " .. offer.id)
end
```

---

## get_offer

Get detailed information about a single Kajabi offer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `offer_id` | string | yes | The ID of the offer to retrieve |

### Example

```lua
local result = app.integrations.kajabi.get_offer({
  offer_id = "abc123"
})

print(result.title)
print(result.price)
```

---

## list_products

List all products (courses, coaching programs, memberships) in your Kajabi account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of results per page (default: 25) |

### Examples

#### All products

```lua
local result = app.integrations.kajabi.list_products()

for _, product in ipairs(result.products) do
  print(product.title .. " — " .. product.type .. " (" .. product.id .. ")")
end
```

#### Paginated results

```lua
local result = app.integrations.kajabi.list_products({
  page = 2,
  per_page = 10
})
```

---

## get_product

Get detailed information about a single Kajabi product.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `product_id` | string | yes | The ID of the product to retrieve |

### Example

```lua
local result = app.integrations.kajabi.get_product({
  product_id = "abc123"
})

print(result.title)
print(result.description)
print(result.type)
```

---

## list_members

List all members in your Kajabi account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of results per page (default: 25) |

### Examples

#### All members

```lua
local result = app.integrations.kajabi.list_members()

for _, member in ipairs(result.members) do
  print(member.name .. " — " .. member.email .. " — " .. member.status)
end
```

#### Paginated results

```lua
local result = app.integrations.kajabi.list_members({
  page = 2,
  per_page = 50
})

print("Total members on page: " .. result.totalCount)
```

---

## get_member

Get details for a single member.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `member_id` | string | yes | The ID of the member |

### Example

```lua
local result = app.integrations.kajabi.get_member({
  member_id = "abc123"
})

print(result.name)
print(result.email)
print(result.status)
```

---

## get_current_user

Get the profile of the currently authenticated Kajabi user.

### Parameters

None.

### Example

```lua
local result = app.integrations.kajabi.get_current_user()

print("Connected as: " .. result.name)
print("Email: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Kajabi accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.kajabi.function_name({...})

-- Explicit default (portable across setups)
app.integrations.kajabi.default.function_name({...})

-- Named accounts
app.integrations.kajabi.main_site.function_name({...})
app.integrations.kajabi.coaching.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
