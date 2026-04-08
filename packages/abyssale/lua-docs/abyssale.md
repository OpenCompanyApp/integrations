# Abyssale — Lua API Reference

## list_generations

List image generation jobs with optional pagination and status filter.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (1-based, default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 100) |
| `status` | string | no | Filter by status: `"finished"`, `"processing"`, or `"failed"` |

### Example

```lua
local result = app.integrations.abyssale.list_generations({
  page = 1,
  limit = 10,
  status = "finished"
})

for _, gen in ipairs(result.generations) do
  print(gen.id .. ": " .. gen.status)
end
```

---

## get_generation

Get details of a specific image generation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The generation UUID |

### Example

```lua
local result = app.integrations.abyssale.get_generation({
  id = "gen_abc123"
})

print("Status: " .. result.status)
print("Outputs:")
for _, output in ipairs(result.outputs) do
  print("  " .. output.url)
end
```

---

## create_generation

Generate images from a template with custom modifications.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `template_id` | string | yes | The template UUID |
| `format_ids` | array | yes | Array of format UUIDs to generate |
| `modifications` | object | no | Element modifications (keys = element names, values = override objects) |

### Modifications Syntax

Each key in the modifications object corresponds to an element name in the template. The value defines the override:

```lua
modifications = {
  title = { payload = "New Headline" },
  subtitle = { payload = "Updated subtitle text" },
  background = { payload = "https://example.com/bg.jpg" }
}
```

### Example

```lua
local result = app.integrations.abyssale.create_generation({
  template_id = "tmpl_abc123",
  format_ids = { "fmt_facebook_post", "fmt_instagram_square" },
  modifications = {
    headline = { payload = "Summer Sale 50% Off" },
    cta_text = { payload = "Shop Now" },
    product_image = { payload = "https://example.com/product.jpg" }
  }
})

print("Generation ID: " .. result.id)
print("Status: " .. result.status)
```

---

## list_templates

List available design templates.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (1-based, default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 100) |

### Example

```lua
local result = app.integrations.abyssale.list_templates({
  page = 1,
  limit = 10
})

for _, tmpl in ipairs(result.templates) do
  print(tmpl.id .. ": " .. tmpl.name)
end
```

---

## get_template

Get details of a specific template, including its formats and editable elements.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The template UUID |

### Example

```lua
local result = app.integrations.abyssale.get_template({
  id = "tmpl_abc123"
})

print("Template: " .. result.name)
print("Formats:")
for _, fmt in ipairs(result.formats) do
  print("  " .. fmt.id .. " (" .. fmt.width .. "x" .. fmt.height .. ")")
end
```

---

## list_formats

List available output formats (sizes and dimensions).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (1-based, default: 1) |
| `limit` | integer | no | Results per page (default: 20, max: 100) |

### Example

```lua
local result = app.integrations.abyssale.list_formats({
  limit = 50
})

for _, fmt in ipairs(result.formats) do
  print(fmt.id .. ": " .. fmt.name .. " (" .. fmt.width .. "x" .. fmt.height .. ")")
end
```

---

## get_current_user

Get the profile of the currently authenticated user.

### Parameters

None.

### Example

```lua
local result = app.integrations.abyssale.get_current_user({})
print("User: " .. result.first_name .. " " .. result.last_name)
print("Email: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Abyssale accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.abyssale.function_name({...})

-- Explicit default (portable across setups)
app.integrations.abyssale.default.function_name({...})

-- Named accounts
app.integrations.abyssale.production.function_name({...})
app.integrations.abyssale.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
