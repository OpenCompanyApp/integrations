# Mindee — Lua API Reference

## parse_invoice

Parse an invoice document (PDF or image) and extract structured data including supplier, line items, totals, dates, and tax details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `document` | string | yes | File path or base64-encoded content of the invoice |
| `file_name` | string | no | Filename for the document (recommended for base64 uploads) |

### Response Fields

The parsed invoice typically includes:

| Field | Description |
|-------|-------------|
| `supplier_name` | Name of the invoice supplier |
| `invoice_number` | Invoice reference number |
| `invoice_date` | Date of the invoice |
| `due_date` | Payment due date |
| `total_amount` | Total invoice amount |
| `total_tax` | Total tax amount |
| `line_items` | Array of line items with description, quantity, unit price, total |
| `payment_details` | Bank/payment information |

### Example

```lua
local result = app.integrations.mindee.parse_invoice({
  document = "/tmp/invoice_2024.pdf"
})

print("Supplier: " .. result.supplier_name)
print("Total: " .. result.total_amount)
```

### Example (base64)

```lua
local result = app.integrations.mindee.parse_invoice({
  document = "<base64_encoded_content>",
  file_name = "invoice.pdf"
})
```

---

## parse_receipt

Parse an expense receipt (PDF or image) and extract structured data including merchant, line items, totals, dates, and category.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `document` | string | yes | File path or base64-encoded content of the receipt |
| `file_name` | string | no | Filename for the document (recommended for base64 uploads) |

### Response Fields

The parsed receipt typically includes:

| Field | Description |
|-------|-------------|
| `merchant_name` | Name of the merchant/restaurant |
| `receipt_date` | Date on the receipt |
| `total_amount` | Total receipt amount |
| `total_tax` | Tax amount |
| `category` | Expense category |
| `line_items` | Array of purchased items with description and price |

### Example

```lua
local result = app.integrations.mindee.parse_receipt({
  document = "/tmp/expense_receipt.jpg"
})

print("Merchant: " .. result.merchant_name)
print("Total: " .. result.total_amount)
```

---

## parse_passport

Parse a passport document (PDF or image) and extract structured data including full name, date of birth, nationality, passport number, and expiry date.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `document` | string | yes | File path or base64-encoded content of the passport |
| `file_name` | string | no | Filename for the document (recommended for base64 uploads) |

### Response Fields

The parsed passport typically includes:

| Field | Description |
|-------|-------------|
| `full_name` | Full name as shown on passport |
| `given_names` | First/given names |
| `surname` | Last name/surname |
| `birth_date` | Date of birth |
| `nationality` | Passport holder's nationality |
| `passport_number` | Passport document number |
| `expiry_date` | Passport expiration date |
| `gender` | Gender as shown on passport |
| `country` | Issuing country |

### Example

```lua
local result = app.integrations.mindee.parse_passport({
  document = "/tmp/passport_scan.png"
})

print("Name: " .. result.full_name)
print("Nationality: " .. result.nationality)
print("Expires: " .. result.expiry_date)
```

---

## parse_custom

Parse a document using a custom Mindee API endpoint. Requires an endpoint ID from your custom model trained in the Mindee API builder.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `endpoint_id` | string | yes | Custom endpoint ID (e.g., `"username/endpoint_name/v1"`) |
| `document` | string | yes | File path or base64-encoded content of the document |
| `file_name` | string | no | Filename for the document (recommended for base64 uploads) |

### Example

```lua
local result = app.integrations.mindee.parse_custom({
  endpoint_id = "mycompany/purchase_orders/v1",
  document = "/tmp/po_2024.pdf"
})

-- Fields depend on your custom model definition
```

---

## get_current_user

Get the current authenticated Mindee user's account information. Useful for verifying credentials and connection status.

### Parameters

None.

### Example

```lua
local result = app.integrations.mindee.get_current_user({})

print("Email: " .. result.email)
print("Plan: " .. result.plan)
```

---

## Multi-Account Usage

If you have multiple Mindee accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.mindee.function_name({...})

-- Explicit default (portable across setups)
app.integrations.mindee.default.function_name({...})

-- Named accounts
app.integrations.mindee.production.function_name({...})
app.integrations.mindee.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
