# Tapfiliate — Lua API Reference

## list_affiliates

List all affiliates in your Tapfiliate account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Results per page (default: 25, max: 100) |
| `page` | integer | no | Page number (default: 1) |

### Example

```lua
local affiliates = app.integrations.tapfiliate.list_affiliates({ limit = 50, page = 1 })

for _, aff in ipairs(affiliates) do
  print(aff.id .. ": " .. (aff.email or "no email"))
end
```

---

## get_affiliate

Get details for a specific affiliate.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The affiliate ID |

### Example

```lua
local aff = app.integrations.tapfiliate.get_affiliate({ id = "aff_12345" })
print("Name: " .. (aff.first_name or "") .. " " .. (aff.last_name or ""))
print("Email: " .. (aff.email or ""))
print("Status: " .. (aff.status or ""))
```

---

## list_conversions

List conversions with optional filters and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `affiliate_id` | string | no | Filter by affiliate ID |
| `campaign_id` | string | no | Filter by campaign ID |
| `external_id` | string | no | Filter by external reference ID |
| `status` | string | no | Filter: `"approved"`, `"pending"`, or `"rejected"` |
| `from_date` | string | no | Start date (ISO 8601, e.g., `"2025-01-01"`) |
| `to_date` | string | no | End date (ISO 8601, e.g., `"2025-12-31"`) |
| `limit` | integer | no | Results per page (default: 25, max: 100) |
| `page` | integer | no | Page number (default: 1) |

### Example

```lua
-- Get approved conversions for a specific affiliate
local conversions = app.integrations.tapfiliate.list_conversions({
  affiliate_id = "aff_12345",
  status = "approved",
  from_date = "2025-01-01",
  to_date = "2025-12-31"
})

for _, conv in ipairs(conversions) do
  print(conv.id .. ": $" .. conv.amount .. " (" .. conv.status .. ")")
end
```

---

## create_conversion

Create a new conversion for an affiliate.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `affiliate_id` | string | yes | The affiliate to credit |
| `amount` | number | yes | Conversion amount (e.g., `29.99`) |
| `external_id` | string | yes | Unique external reference (e.g., order ID) |
| `campaign_id` | string | no | Campaign to associate with |
| `commission_type` | string | no | `"default"` or `"fixed"` |
| `commission_amount` | number | no | Override commission amount (if fixed type) |
| `meta_data` | object | no | Key-value metadata |

### Example

```lua
local conversion = app.integrations.tapfiliate.create_conversion({
  affiliate_id = "aff_12345",
  amount = 99.00,
  external_id = "order_67890",
  campaign_id = "camp_abc"
})
print("Created conversion: " .. conversion.id)
```

---

## get_current_user

Get the currently authenticated Tapfiliate user.

### Parameters

None.

### Example

```lua
local user = app.integrations.tapfiliate.get_current_user({})
print("Logged in as: " .. (user.email or "unknown"))
```

---

## Common Workflows

### Check top affiliates

```lua
local affiliates = app.integrations.tapfiliate.list_affiliates({ limit = 10 })

for _, aff in ipairs(affiliates) do
  local conversions = app.integrations.tapfiliate.list_conversions({
    affiliate_id = aff.id,
    status = "approved"
  })
  local total = 0
  for _, c in ipairs(conversions) do
    total = total + (c.amount or 0)
  end
  print(aff.email .. ": $" .. total .. " in conversions")
end
```

### Record a conversion from an order

```lua
app.integrations.tapfiliate.create_conversion({
  affiliate_id = "aff_12345",
  amount = 149.99,
  external_id = "ORD-2025-0042",
  meta_data = {
    product = "Pro Plan",
    customer_email = "customer@example.com"
  }
})
```

---

## Multi-Account Usage

If you have multiple Tapfiliate accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.tapfiliate.list_affiliates({})

-- Explicit default (portable across setups)
app.integrations.tapfiliate.default.list_affiliates({})

-- Named accounts
app.integrations.tapfiliate.work.list_affiliates({})
app.integrations.tapfiliate.partner.list_affiliates({})
```

All functions are identical across accounts — only the credentials differ.
