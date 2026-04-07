# Ko-fi — Lua API Reference

## list_supporters

List all supporters who have donated or subscribed to your Ko-fi page.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `limit` | integer | no | Number of results per page (default: 25) |

### Examples

```lua
local result = app.integrations["ko-fi"].list_supporters()

for _, supporter in ipairs(result.supporters) do
  print(supporter.name .. " — " .. supporter.email)
end
```

#### Paginated results

```lua
local result = app.integrations["ko-fi"].list_supporters({
  page = 2,
  limit = 10
})

print("Total supporters on page: " .. result.totalCount)
```

---

## get_supporter

Get detailed information about a single Ko-fi supporter.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The email address of the supporter to retrieve |

### Example

```lua
local result = app.integrations["ko-fi"].get_supporter({
  email = "fan@example.com"
})

print(result.name)
print(result.total_donated)
print(result.status)
```

---

## list_transactions

List all transactions including donations, subscriptions, and shop orders.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | no | Filter by type: `donation`, `subscription`, or `shop_order` |
| `page` | integer | no | Page number for pagination (default: 1) |
| `limit` | integer | no | Number of results per page (default: 25) |

### Examples

#### All recent transactions

```lua
local result = app.integrations["ko-fi"].list_transactions()

for _, tx in ipairs(result.transactions) do
  print(tx.type .. " — $" .. tx.amount .. " — " .. tx.supporter_name)
end
```

#### Filter by type

```lua
local result = app.integrations["ko-fi"].list_transactions({
  type = "donation"
})

print("Donation count: " .. result.totalCount)
```

---

## list_commissions

List all commission requests on your Ko-fi page.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by status: `pending`, `accepted`, `completed`, or `declined` |
| `page` | integer | no | Page number for pagination (default: 1) |
| `limit` | integer | no | Number of results per page (default: 25) |

### Examples

#### All commissions

```lua
local result = app.integrations["ko-fi"].list_commissions()

for _, commission in ipairs(result.commissions) do
  print(commission.title .. " — " .. commission.status .. " — $" .. commission.price)
end
```

#### Pending commissions only

```lua
local result = app.integrations["ko-fi"].list_commissions({
  status = "pending"
})
```

---

## get_commission

Get details for a single commission.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `commission_id` | string | yes | The ID of the commission to retrieve |

### Example

```lua
local result = app.integrations["ko-fi"].get_commission({
  commission_id = "COM123"
})

print(result.title)
print(result.description)
print(result.status)
print(result.requester_name)
```

---

## list_shop_items

List all items in your Ko-fi shop.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `limit` | integer | no | Number of results per page (default: 25) |

### Examples

```lua
local result = app.integrations["ko-fi"].list_shop_items()

for _, item in ipairs(result.items) do
  print(item.name .. " — $" .. item.price)
end
```

---

## get_current_user

Get the profile of the currently authenticated Ko-fi user.

### Parameters

None.

### Example

```lua
local result = app.integrations["ko-fi"].get_current_user()

print("Connected as: " .. result.name)
print("Email: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Ko-fi accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["ko-fi"].function_name({...})

-- Explicit default (portable across setups)
app.integrations["ko-fi"].default.function_name({...})

-- Named accounts
app.integrations["ko-fi"].main_page.function_name({...})
app.integrations["ko-fi"].side_project.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
