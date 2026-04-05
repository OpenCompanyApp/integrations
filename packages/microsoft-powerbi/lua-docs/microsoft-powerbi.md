# Microsoft Power BI — Lua API Reference

## list_reports

List all Power BI reports the authenticated user has access to.

### Parameters

None.

### Response

Returns an object with a `value` array containing report objects, each with fields like `id`, `name`, `embedUrl`, `datasetId`, and `workspaceId`.

## get_report

Get details of a specific Power BI report by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `report_id` | string | yes | The unique ID of the Power BI report (GUID format) |

## list_datasets

List all Power BI datasets the authenticated user has access to.

### Parameters

None.

### Response

Returns an object with a `value` array containing dataset objects, each with fields like `id`, `name`, `defaultMode`, and `workspaceId`.

## get_dataset

Get details of a specific Power BI dataset by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `dataset_id` | string | yes | The unique ID of the Power BI dataset (GUID format) |

## list_workspaces

List all Power BI workspaces (groups) the authenticated user has access to.

### Parameters

None.

### Response

Returns an object with a `value` array containing workspace objects, each with fields like `id`, `name`, `isReadOnly`, and `isOnDedicatedCapacity`.

## get_current_user

Get the profile of the currently authenticated Power BI user.

### Parameters

None.

### Response

Returns a user object with fields like `displayName`, `emailAddress`, `identifier`, and `objectId`.

## Examples

### List all reports

```lua
local result = app.integrations.microsoft_powerbi.list_reports({})

if result.value then
  for _, report in ipairs(result.value) do
    print(report.name .. " (ID: " .. report.id .. ")")
  end
end
```

### Get a specific report

```lua
local report = app.integrations.microsoft_powerbi.get_report({
  report_id = "a5f8b2c1-3d4e-5f6a-7b8c-9d0e1f2a3b4c"
})

print("Report: " .. report.name)
print("Embed URL: " .. report.embedUrl)
```

### List datasets and their details

```lua
local datasets = app.integrations.microsoft_powerbi.list_datasets({})

if datasets.value then
  for _, ds in ipairs(datasets.value) do
    print(ds.name .. " — mode: " .. (ds.defaultMode or "N/A"))
  end
end
```

### Get current user info

```lua
local user = app.integrations.microsoft_powerbi.get_current_user({})

print("Logged in as: " .. user.displayName)
print("Email: " .. (user.emailAddress or "N/A"))
```

### List workspaces

```lua
local workspaces = app.integrations.microsoft_powerbi.list_workspaces({})

if workspaces.value then
  for _, ws in ipairs(workspaces.value) do
    print(ws.name .. " (ID: " .. ws.id .. ")")
  end
end
```

---

## Multi-Account Usage

If you have multiple Power BI accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.microsoft_powerbi.list_reports({})

-- Explicit default (portable across setups)
app.integrations.microsoft_powerbi.default.list_reports({})

-- Named accounts
app.integrations.microsoft_powerbi.work.list_reports({})
app.integrations.microsoft_powerbi.personal.list_reports({})
```

All functions are identical across accounts — only the credentials differ.
