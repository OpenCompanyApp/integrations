# Tableau — Ruby API Reference

## list_workbooks

List workbooks available on the Tableau site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of workbooks per page (default: 100, max: 1000) |
| `page_number` | integer | no | Page number for pagination (1-based, default: 1) |

### Example

```ruby
result = app.integrations.tableau.list_workbooks(page_size: 50, page_number: 1)
(result.workbooks || []).each do |wb|
  puts((wb.name).to_s + " (id: " + (wb.id).to_s + ")")
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

```ruby
result = app.integrations.tableau.get_workbook(workbook_id: "abc-123-def")
puts("Workbook: " + (result.workbook.name).to_s)
puts("Project: " + ((result.workbook.project.name || "N/A")).to_s)
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

```ruby
result = app.integrations.tableau.list_views(page_size: 100)
(result.views || []).each do |view|
  puts((view.name).to_s + " in " + ((view.workbook.name || "unknown")).to_s)
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

```ruby
result = app.integrations.tableau.get_view(view_id: "xyz-456-ghi")
puts("View: " + (result.view.name).to_s)
puts("Workbook: " + ((result.view.workbook.name || "N/A")).to_s)
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

```ruby
result = app.integrations.tableau.list_projects()
(result.projects || []).each do |project|
  puts((project.name).to_s + " (id: " + (project.id).to_s + ")")
end
```
---

## get_current_user

Get information about the currently authenticated Tableau user.

### Parameters

None.

### Example

```ruby
result = app.integrations.tableau.get_current_user()
puts("User: " + (result.user.name).to_s)
puts("Email: " + ((result.user.email || "N/A")).to_s)
puts("Site role: " + (result.user.siteRole).to_s)
```
---

## Multi-Account Usage

If you have multiple Tableau accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.tableau.list_workbooks()
# Explicit default (portable across setups)
app.integrations.tableau.default.list_workbooks()
# Named accounts
app.integrations.tableau.production.list_workbooks()
app.integrations.tableau.staging.list_workbooks()
```
All functions are identical across accounts — only the credentials differ.
