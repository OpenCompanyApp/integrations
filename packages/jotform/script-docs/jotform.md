# Jotform — Ruby API Reference

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

```ruby
result = app.integrations.jotform.list(limit: 10, orderby: "created_at")
result.each do |form|
  puts((form.title).to_s + " (ID: " + (form.id).to_s + ")")
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

```ruby
result = app.integrations.jotform.get(form_id: "231234567890123")
puts("Title: " + (result.title).to_s)
puts("URL: " + (result.url).to_s)
puts("Status: " + (result.status).to_s)
puts("Created (Unix seconds): " + (result.created_at).to_s)
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

```ruby
result = app.integrations.jotform.list_submissions(form_id: "231234567890123", limit: 10, orderby: "created_at")
result.each do |sub|
  puts("Submission " + (sub.id).to_s + " at " + (sub.created_at).to_s)
  sub.answers.to_a.each do |key, answer|
    puts("  " + (answer.name).to_s + ": " + ((answer.answer).to_s).to_s)
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

```ruby
result = app.integrations.jotform.get_submission(submission_id: "512345678901234567")
result.answers.to_a.each do |key, answer|
  puts((answer.name).to_s + ": " + ((answer.answer).to_s).to_s)
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

```ruby
result = app.integrations.jotform.create(title: "Contact Form", questions: [{type: "control_fullname", name: "Name", order: "1", required: "Yes"}, {type: "control_email", name: "Email", order: "2", required: "Yes"}, {type: "control_textarea", name: "Message", order: "3"}])
puts("Created form: " + (result.id).to_s)
puts("URL: " + (result.url).to_s)
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

```ruby
result = app.integrations.jotform.list_questions(form_id: "231234567890123")
result.to_a.each do |key, question|
  puts((question.type).to_s + ": " + (question.name).to_s + " (order: " + (question.order).to_s + ")")
end
```
---

## get_current_user

Get profile information for the authenticated user.

### Parameters

None.

### Example

```ruby
result = app.integrations.jotform.get_current_user()
puts("Username: " + (result.username).to_s)
puts("Email: " + (result.email).to_s)
puts("Account type: " + (result.account_type).to_s)
puts("Forms used: " + (result.usage.forms).to_s + " / " + (result.usage.form_limit).to_s)
```
---

## Multi-Account Usage

If you have multiple Jotform accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
