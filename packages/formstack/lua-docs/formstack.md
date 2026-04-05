# Formstack — Lua API Reference

## list_forms

List all forms in your Formstack account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of forms per page (default: 25, max: 200) |
| `search` | string | no | Search string to filter forms by name |

### Example

```lua
local result = app.integrations.formstack.list_forms({
  page = 1,
  per_page = 25
})

for _, form in ipairs(result.forms) do
  print(form.id .. ": " .. form.name)
end
```

---

## get_form

Get details and field structure of a specific form.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | integer | yes | The numeric ID of the form |

### Example

```lua
local form = app.integrations.formstack.get_form({
  form_id = 12345
})

print("Form: " .. form.name)
for _, field in ipairs(form.fields) do
  print("  " .. field.label .. " (" .. field.type .. ") = field key: " .. field.name)
end
```

---

## list_submissions

List submissions for a specific form.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | integer | yes | The numeric ID of the form |
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of submissions per page (default: 25, max: 200) |
| `expand_data` | boolean | no | Expand submission data with field labels (default: false) |

### Example

```lua
local result = app.integrations.formstack.list_submissions({
  form_id = 12345,
  per_page = 10,
  expand_data = true
})

for _, sub in ipairs(result.submissions) do
  print("Submission " .. sub.id .. " at " .. sub.timestamp)
end
```

---

## get_submission

Get details of a specific submission.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `submission_id` | integer | yes | The numeric ID of the submission |

### Example

```lua
local sub = app.integrations.formstack.get_submission({
  submission_id = 67890
})

print("Submission " .. sub.id)
for key, value in pairs(sub.data) do
  print("  " .. key .. " = " .. tostring(value))
end
```

---

## create_submission

Create a new submission for a form. Use `get_form` first to discover available field keys.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | integer | yes | The numeric ID of the form |
| `fields` | object | yes | Object with field keys and values, e.g. `{field_123456 = "John", field_234567 = "john@example.com"}` |

### Example

```lua
local result = app.integrations.formstack.create_submission({
  form_id = 12345,
  fields = {
    field_123456 = "Jane Doe",
    field_234567 = "jane@example.com",
    field_345678 = "Hello, I have a question..."
  }
})

print("Created submission: " .. result.id)
```

---

## delete_submission

Delete a submission permanently.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `submission_id` | integer | yes | The numeric ID of the submission to delete |

### Example

```lua
app.integrations.formstack.delete_submission({
  submission_id = 67890
})

print("Submission deleted")
```

---

## list_folders

List all folders in your Formstack account.

### Parameters

None.

### Example

```lua
local result = app.integrations.formstack.list_folders()

for _, folder in ipairs(result.folders) do
  print(folder.id .. ": " .. folder.name)
end
```

---

## get_current_user

Get the currently authenticated user's profile.

### Parameters

None.

### Example

```lua
local user = app.integrations.formstack.get_current_user({})

print("Logged in as: " .. user.first_name .. " " .. user.last_name .. " (" .. user.email .. ")")
```

---

## Multi-Account Usage

If you have multiple Formstack accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.formstack.function_name({...})

-- Explicit default (portable across setups)
app.integrations.formstack.default.function_name({...})

-- Named accounts
app.integrations.formstack.work.function_name({...})
app.integrations.formstack.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
