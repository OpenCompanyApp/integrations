# Jotform — Lua API Reference

## list_forms

List all forms owned by the authenticated Jotform user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of forms to return (default: 20, max: 1000) |
| `offset` | integer | no | Offset for pagination |
| `orderby` | string | no | Order field: `"created_at"`, `"title"`, `"id"`, `"updated_at"` |
| `status` | string | no | Filter by status: `"ENABLED"` or `"DISABLED"` |
| `title` | string | no | Filter by form title (partial match) |

### Example

```lua
local result = app.integrations.jotform.list_forms({
  limit = 10,
  orderby = "created_at"
})

for _, form in ipairs(result) do
  print(form.title .. " (ID: " .. form.id .. ")")
end
```

---

## get_form

Get detailed information about a specific form.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The form ID (e.g., `"231234567890123"`) |

### Example

```lua
local result = app.integrations.jotform.get_form({
  form_id = "231234567890123"
})

print("Title: " .. result.title)
print("URL: " .. result.url)
print("Status: " .. result.status)
print("Created: " .. result.created_at)
```

---

## list_submissions

List submissions for a specific form.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The form ID |
| `limit` | integer | no | Maximum number of submissions (default: 20, max: 1000) |
| `offset` | integer | no | Offset for pagination |
| `orderby` | string | no | Order field: `"created_at"` (default) or `"id"` |
| `created_at` | string | no | Filter by creation date (format: `"YYYY-MM-DD HH:mm:ss"` or date range) |
| `status` | string | no | Filter by status: `"ACTIVE"` or `"DELETED"` |

### Example

```lua
local result = app.integrations.jotform.list_submissions({
  form_id = "231234567890123",
  limit = 10,
  orderby = "created_at"
})

for _, sub in ipairs(result) do
  print("Submission " .. sub.id .. " at " .. sub.created_at)
  for key, answer in pairs(sub.answers) do
    print("  " .. answer.name .. ": " .. tostring(answer.answer))
  end
end
```

---

## get_submission

Get details for a specific submission.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `submission_id` | string | yes | The submission ID (e.g., `"512345678901234567"`) |

### Example

```lua
local result = app.integrations.jotform.get_submission({
  submission_id = "512345678901234567"
})

for key, answer in pairs(result.answers) do
  print(answer.name .. ": " .. tostring(answer.answer))
end
```

---

## create_form

Create a new form in Jotform.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | The title of the form |
| `questions` | array | no | Array of question definitions (see below) |
| `properties` | object | no | Additional form properties |

### Question Types

| Type | Description |
|------|-------------|
| `control_textbox` | Single-line text input |
| `control_textarea` | Multi-line text input |
| `control_email` | Email input |
| `control_dropdown` | Dropdown select |
| `control_radio` | Radio button group |
| `control_checkbox` | Checkbox group |
| `control_number` | Number input |
| `control_phone` | Phone number input |
| `control_datetime` | Date/time picker |
| `control_fileupload` | File upload |
| `control_scale` | Rating scale |
| `control_matrix` | Matrix / grid |
| `control_fullname` | Full name (first + last) |
| `control_address` | Address (street, city, state, zip, country) |
| `control_hidden` | Hidden field |
| `control_button` | Submit button |

### Example

```lua
local result = app.integrations.jotform.create_form({
  title = "Contact Form",
  questions = {
    {
      type = "control_fullname",
      name = "Name",
      order = "1",
      required = "Yes"
    },
    {
      type = "control_email",
      name = "Email",
      order = "2",
      required = "Yes"
    },
    {
      type = "control_textarea",
      name = "Message",
      order = "3"
    }
  }
})

print("Created form: " .. result.id)
print("URL: " .. result.url)
```

---

## list_questions

List all questions (form fields) for a specific form.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `form_id` | string | yes | The form ID |
| `offset` | integer | no | Offset for pagination |

### Example

```lua
local result = app.integrations.jotform.list_questions({
  form_id = "231234567890123"
})

for key, question in pairs(result) do
  print(question.type .. ": " .. question.name .. " (order: " .. question.order .. ")")
end
```

---

## get_current_user

Get profile information for the authenticated user.

### Parameters

None.

### Example

```lua
local result = app.integrations.jotform.get_current_user({})

print("Username: " .. result.username)
print("Email: " .. result.email)
print("Account type: " .. result.account_type)
print("Forms used: " .. result.usage.forms .. " / " .. result.usage.form_limit)
```

---

## Multi-Account Usage

If you have multiple Jotform accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.jotform.function_name({...})

-- Explicit default (portable across setups)
app.integrations.jotform.default.function_name({...})

-- Named accounts
app.integrations.jotform.work.function_name({...})
app.integrations.jotform.client.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
