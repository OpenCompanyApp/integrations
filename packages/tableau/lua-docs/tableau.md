# Tableau — Lua API Reference

## list_workbooks

List workbooks available on the Tableau site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of workbooks per page (default: 100, max: 1000) |
| `page_number` | integer | no | Page number for pagination (1-based, default: 1) |

### Example

```lua
local result = app.integrations.tableau.list_workbooks({
  page_size = 50,
  page_number = 1
})

for _, wb in ipairs(result.workbooks or {}) do
  print(wb.name .. " (id: " .. wb.id .. ")")
end
```

---

## get_workbook

Get detailed information about a specific workbook.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workbook_id` | string | yes | The workbook LUID (unique identifier) |

### Example

```lua
local result = app.integrations.tableau.get_workbook({
  workbook_id = "abc-123-def"
})

print("Workbook: " .. result.workbook.name)
print("Project: " .. (result.workbook.project.name or "N/A"))
```

---

## list_views

List views (dashboards and sheets) on the Tableau site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of views per page (default: 100, max: 1000) |
| `page_number` | integer | no | Page number for pagination (1-based, default: 1) |

### Example

```lua
local result = app.integrations.tableau.list_views({
  page_size = 100
})

for _, view in ipairs(result.views or {}) do
  print(view.name .. " in " .. (view.workbook.name or "unknown"))
end
```

---

## get_view

Get detailed information about a specific view.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `view_id` | string | yes | The view LUID (unique identifier) |

### Example

```lua
local result = app.integrations.tableau.get_view({
  view_id = "xyz-456-ghi"
})

print("View: " .. result.view.name)
print("Workbook: " .. (result.view.workbook.name or "N/A"))
```

---

## list_projects

List projects on the Tableau site. Projects organize workbooks and data sources.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of projects per page (default: 100, max: 1000) |
| `page_number` | integer | no | Page number for pagination (1-based, default: 1) |

### Example

```lua
local result = app.integrations.tableau.list_projects({})

for _, project in ipairs(result.projects or {}) do
  print(project.name .. " (id: " .. project.id .. ")")
end
```

---

## get_current_user

Get information about the currently authenticated Tableau user.

### Parameters

None.

### Example

```lua
local result = app.integrations.tableau.get_current_user({})

print("User: " .. result.user.name)
print("Email: " .. (result.user.email or "N/A"))
print("Site role: " .. result.user.siteRole)
```

---

## Multi-Account Usage

If you have multiple Tableau accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.tableau.list_workbooks({...})

-- Explicit default (portable across setups)
app.integrations.tableau.default.list_workbooks({...})

-- Named accounts
app.integrations.tableau.production.list_workbooks({...})
app.integrations.tableau.staging.list_workbooks({...})
```

All functions are identical across accounts — only the credentials differ.
