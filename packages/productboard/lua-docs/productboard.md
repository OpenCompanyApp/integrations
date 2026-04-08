# Productboard — Lua API Reference

## list_features

List features from Productboard with cursor-based pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageSize` | integer | no | Number of features per page (max 100, default 100) |
| `cursor` | string | no | Pagination cursor from a previous response |

### Examples

```lua
-- List all features
local result = app.integrations.productboard.list_features({})

for _, feature in ipairs(result.data or {}) do
  print(feature.name .. " — " .. (feature.status or "no status"))
end

-- Paginate through results
local cursor = nil
repeat
  local result = app.integrations.productboard.list_features({
    pageSize = 50,
    cursor = cursor,
  })

  for _, feature in ipairs(result.data or {}) do
    print(feature.id .. ": " .. feature.name)
  end

  cursor = result.meta and result.meta.next_cursor or nil
until not cursor
```

---

## get_feature

Get detailed information about a specific feature.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The feature ID |

### Examples

```lua
local result = app.integrations.productboard.get_feature({ id = "feature_abc123" })
local feature = result.data

print("Name: " .. feature.name)
print("Status: " .. (feature.status or "none"))
print("Description: " .. (feature.description or "no description"))
```

---

## create_feature

Create a new feature in Productboard.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The feature name |
| `description` | string | no | Detailed description of the feature |
| `product_id` | string | no | ID of the product to assign this feature to |
| `status` | string | no | Feature status (e.g., "in_discovery", "in_design", "in_development", "shipped") |
| `owner_ids` | array | no | Array of user IDs to assign as feature owners |

### Examples

```lua
-- Create a simple feature
local result = app.integrations.productboard.create_feature({
  name = "Dark Mode Support",
  description = "Add a dark mode theme option for the application",
})

print("Created feature: " .. result.data.id)

-- Create a feature with product and status
local result = app.integrations.productboard.create_feature({
  name = "API Rate Limiting",
  description = "Implement rate limiting on public API endpoints",
  product_id = "product_xyz789",
  status = "in_discovery",
})
```

---

## list_notes

List notes (customer feedback) from Productboard.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageSize` | integer | no | Number of notes per page (max 100, default 100) |
| `cursor` | string | no | Pagination cursor from a previous response |

### Examples

```lua
-- List recent notes
local result = app.integrations.productboard.list_notes({
  pageSize = 20,
})

for _, note in ipairs(result.data or {}) do
  print(note.title .. " by " .. (note.owner and note.owner.name or "unknown"))
end
```

---

## create_note

Create a new note (customer feedback) in Productboard.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | The note title |
| `content` | string | no | The note content (plain text or HTML) |
| `owner_id` | string | no | User ID of the note owner |
| `feature_ids` | array | no | Array of feature IDs to link this note to |
| `company_ids` | array | no | Array of company IDs associated with this note |

### Examples

```lua
-- Create a feedback note
local result = app.integrations.productboard.create_note({
  title = "Customer Request: Bulk Export",
  content = "Enterprise customer needs bulk export functionality for monthly reporting",
  feature_ids = { "feature_abc123" },
  company_ids = { "company_def456" },
})

print("Created note: " .. result.data.id)
```

---

## list_products

List products from Productboard.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageSize` | integer | no | Number of products per page (max 100, default 100) |
| `cursor` | string | no | Pagination cursor from a previous response |

### Examples

```lua
local result = app.integrations.productboard.list_products({})

for _, product in ipairs(result.data or {}) do
  print(product.id .. ": " .. product.name)
end
```

---

## list_companies

List companies from Productboard.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageSize` | integer | no | Number of companies per page (max 100, default 100) |
| `cursor` | string | no | Pagination cursor from a previous response |

### Examples

```lua
local result = app.integrations.productboard.list_companies({})

for _, company in ipairs(result.data or {}) do
  print(company.id .. ": " .. company.name .. " (" .. (company.domain or "no domain") .. ")")
end
```

---

## get_current_user

Get the currently authenticated Productboard user profile.

### Parameters

None.

### Examples

```lua
local result = app.integrations.productboard.get_current_user({})

print("Authenticated as: " .. result.data.firstName .. " " .. result.data.lastName)
print("Email: " .. result.data.email)
```

---

## Multi-Account Usage

If you have multiple Productboard workspaces configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.productboard.list_features({})

-- Explicit default (portable across setups)
app.integrations.productboard.default.list_features({})

-- Named accounts
app.integrations.productboard.workspace_a.list_features({})
app.integrations.productboard.workspace_b.list_features({})
```

All functions are identical across accounts — only the credentials differ.
