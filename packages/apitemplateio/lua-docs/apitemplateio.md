# API Template IO — Lua API Reference

## create_pdf

Generate a PDF document from a template.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `template_id` | string | yes | The template ID (e.g., `"tpl_abc123"`) |
| `data` | object | yes | Key-value pairs to merge into the template |
| `output_html` | boolean | no | If true, returns the rendered HTML alongside the PDF URL |
| `expire` | integer | no | Minutes until the generated file URL expires |
| `meta` | string | no | Optional metadata string for the generation request |

### Example

```lua
local result = app.integrations.apitemplateio.create_pdf({
  template_id = "tpl_abc123",
  data = {
    company_name = "Acme Corp",
    amount = "$500.00",
    invoice_number = "INV-001",
    due_date = "2026-04-30"
  }
})

print("PDF URL: " .. result.download_url)
print("Transaction ID: " .. result.transaction_id)
```

---

## create_image

Generate an image (PNG or JPEG) from a template.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `template_id` | string | yes | The template ID (e.g., `"tpl_xyz789"`) |
| `data` | object | yes | Key-value pairs to merge into the template |
| `output_format` | string | no | Image format: `"png"` (default) or `"jpeg"` |
| `output_html` | boolean | no | If true, returns the rendered HTML alongside the image URL |
| `expire` | integer | no | Minutes until the generated file URL expires |
| `meta` | string | no | Optional metadata string for the generation request |

### Example

```lua
local result = app.integrations.apitemplateio.create_image({
  template_id = "tpl_xyz789",
  data = {
    title = "Summer Sale",
    discount = "30% Off",
    tagline = "Limited time offer!"
  },
  output_format = "png"
})

print("Image URL: " .. result.download_url)
```

---

## list_templates

List available templates with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of templates per page (default: 50, max: 100) |
| `offset` | integer | no | Number of templates to skip for pagination (default: 0) |
| `filter` | string | no | Optional filter expression to narrow results |

### Example

```lua
-- First page
local result = app.integrations.apitemplateio.list_templates({
  limit = 10,
  offset = 0
})

for _, tpl in ipairs(result.templates) do
  print(tpl.id .. ": " .. tpl.name)
end

-- Next page
local page2 = app.integrations.apitemplateio.list_templates({
  limit = 10,
  offset = 10
})
```

---

## get_template

Get details for a specific template by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `template_id` | string | yes | The template ID to retrieve (e.g., `"tpl_abc123"`) |

### Example

```lua
local result = app.integrations.apitemplateio.get_template({
  template_id = "tpl_abc123"
})

print("Template: " .. result.name)
print("Format: " .. result.format)
print("Modified: " .. result.modified_at)
```

---

## get_current_user

Get the authenticated user's account information, including usage and subscription details.

### Parameters

This tool takes no parameters.

### Example

```lua
local result = app.integrations.apitemplateio.get_current_user({})

print("Account: " .. result.email)
print("Plan: " .. result.plan)
print("API calls used: " .. result.api_calls_used .. " / " .. result.api_calls_limit)
```

---

## Multi-Account Usage

If you have multiple API Template IO accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.apitemplateio.create_pdf({...})

-- Explicit default (portable across setups)
app.integrations.apitemplateio.default.create_pdf({...})

-- Named accounts
app.integrations.apitemplateio.production.create_pdf({...})
app.integrations.apitemplateio.staging.create_pdf({...})
```

All functions are identical across accounts — only the credentials differ.
