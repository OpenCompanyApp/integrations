# Tableau — JavaScript API Reference

## list_workbooks

List workbooks available on the Tableau site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of workbooks per page (default: 100, max: 1000) |
| `page_number` | integer | no | Page number for pagination (1-based, default: 1) |

### Example

```js
var result = app.integrations.tableau.list_workbooks({
  page_size: 50,
  page_number: 1,
})

for (const wb of (result.workbooks || [])) {
  console.log(wb.name + " (id: " + wb.id + ")")
}
```
---

## get_workbook

Get detailed information about a specific workbook.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workbook_id` | string | yes | The workbook LUID (unique identifier) |

### Example

```js
var result = app.integrations.tableau.get_workbook({
  workbook_id: "abc-123-def",
})

console.log("Workbook: " + result.workbook.name)
console.log("Project: " + (result.workbook.project.name || "N/A"))
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

```js
var result = app.integrations.tableau.list_views({
  page_size: 100,
})

for (const view of (result.views || [])) {
  console.log(view.name + " in " + (view.workbook.name || "unknown"))
}
```
---

## get_view

Get detailed information about a specific view.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `view_id` | string | yes | The view LUID (unique identifier) |

### Example

```js
var result = app.integrations.tableau.get_view({
  view_id: "xyz-456-ghi",
})

console.log("View: " + result.view.name)
console.log("Workbook: " + (result.view.workbook.name || "N/A"))
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

```js
var result = app.integrations.tableau.list_projects({})

for (const project of (result.projects || [])) {
  console.log(project.name + " (id: " + project.id + ")")
}
```
---

## get_current_user

Get information about the currently authenticated Tableau user.

### Parameters

None.

### Example

```js
var result = app.integrations.tableau.get_current_user({})

console.log("User: " + result.user.name)
console.log("Email: " + (result.user.email || "N/A"))
console.log("Site role: " + result.user.siteRole)
```
---

## Multi-Account Usage

If you have multiple Tableau accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.tableau.list_workbooks({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.tableau.default.list_workbooks({ /* parameters */ })

// Named accounts
app.integrations.tableau.production.list_workbooks({ /* parameters */ })
app.integrations.tableau.staging.list_workbooks({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
