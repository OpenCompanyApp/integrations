# Lob — Lua API Reference

## send_postcard

Send a postcard via Lob direct mail API.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `to` | string | yes | Recipient — address ID (e.g., `"adr_..."`) or inline address object |
| `from` | string | no | Sender — address ID or inline address object |
| `front` | string | yes | HTML string or template ID for the front of the postcard |
| `back` | string | yes | HTML string or template ID for the back of the postcard |
| `merge_variables` | object | no | Key-value pairs for template personalization |

### Example

```lua
local result = app.integrations.lob.send_postcard({
  to = "adr_abc123",
  from = "adr_def456",
  front = "<html><body><h1>Hello {{name}}!</h1></body></html>",
  back = "<html><body><p>Return: 123 Main St</p></body></html>",
  merge_variables = { name = "Alice" }
})

print("Postcard ID: " .. result.id)
print("Status: " .. result.status)
```

### Using a template

```lua
local result = app.integrations.lob.send_postcard({
  to = "adr_abc123",
  from = "adr_def456",
  front = "tmpl_postcard_front",
  back = "tmpl_postcard_back",
  merge_variables = { name = "Bob", discount = "25%" }
})
```

---

## send_letter

Send a letter via Lob direct mail API.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `to` | string | yes | Recipient — address ID or inline address object |
| `from` | string | no | Sender — address ID or inline address object |
| `file` | string | yes | HTML string or template ID for the letter content |
| `color` | boolean | no | Print in color (default: `true`) |
| `double_sided` | boolean | no | Print double-sided (default: `true`) |

### Example

```lua
local result = app.integrations.lob.send_letter({
  to = "adr_abc123",
  from = "adr_def456",
  file = "<html><body><p>Dear {{name}}, welcome!</p></body></html>",
  color = true,
  double_sided = true
})

print("Letter ID: " .. result.id)
print("Expected delivery: " .. result.expected_delivery_date)
```

---

## get_postcard

Retrieve a postcard by its Lob ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The postcard ID (e.g., `"psc_abcdef123456"`) |

### Example

```lua
local result = app.integrations.lob.get_postcard({ id = "psc_abc123" })

print("Status: " .. result.status)
print("Tracking: " .. (result.tracking_number or "N/A"))
```

---

## list_postcards

List postcards with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Results per page (default: 10, max: 100) |
| `after` | string | no | Cursor — ID from previous page for pagination |

### Example

```lua
local result = app.integrations.lob.list_postcards({ limit = 25 })

for _, postcard in ipairs(result.data) do
  print(postcard.id .. " — " .. postcard.status)
end

-- Next page
if result.has_more then
  local next = app.integrations.lob.list_postcards({
    limit = 25,
    after = result.data[#result.data].id
  })
end
```

---

## verify_address

Verify a US mailing address.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `address` | string | yes | Primary address line (e.g., `"123 Main St"`) |
| `city` | string | yes | City name (e.g., `"San Francisco"`) |
| `state` | string | yes | Two-letter state code (e.g., `"CA"`) |
| `zip` | string | yes | ZIP code (5-digit or ZIP+4) |

### Example

```lua
local result = app.integrations.lob.verify_address({
  address = "185 Berry St Ste 6100",
  city = "San Francisco",
  state = "CA",
  zip = "94107"
})

print("Deliverable: " .. result.deliverability)
-- "deliverable", "deliverable_unnecessary_unit", "undeliverable", etc.
print("Normalized: " .. result.primary_line .. ", " .. result.city .. " " .. result.state .. " " .. result.zip_code)
```

---

## get_current_user

Retrieve the current Lob account info.

### Parameters

None.

### Example

```lua
local result = app.integrations.lob.get_current_user({})

print("Company: " .. result.company_name)
print("Balance: $" .. result.balance)
```

---

## Multi-Account Usage

If you have multiple Lob accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.lob.send_postcard({...})

-- Explicit default (portable across setups)
app.integrations.lob.default.send_postcard({...})

-- Named accounts
app.integrations.lob.marketing.send_postcard({...})
app.integrations.lob.billing.send_letter({...})
```

All functions are identical across accounts — only the credentials differ.
